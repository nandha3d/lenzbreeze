<?php

namespace App\Http\Controllers\SalePro;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Keygen\Keygen;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\Unit;
use App\Models\Tax;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\Product_Warehouse;
use App\Models\Product_Supplier;
use App\Models\CustomField;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use DB;
use App\Models\Variant;
use App\Models\ProductVariant;
use App\Models\Barcode;
use App\Models\Purchase;
use App\Models\ProductPurchase;
use App\Models\Payment;
use App\Traits\TenantInfo;
use App\Traits\CacheForget;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use File;
use App\Services\ImageService;

class ProductController extends Controller
{
    use CacheForget;
    use TenantInfo;

    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    public function index(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('products-index')){
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();

            if($request->input('warehouse_id'))
                $warehouse_id = $request->input('warehouse_id');
            else
                $warehouse_id = 0;

            $permissions = Role::findByName($role->name)->permissions;

            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            $role_id = $role->id;
            $numberOfProduct = DB::table('products')->where('is_active', true)->count();
            $custom_fields = CustomField::where([
                                ['belongs_to', 'product'],
                                ['is_table', true]
                            ])->pluck('name');
            $field_name = [];
            foreach($custom_fields as $fieldName) {
                $field_name[] = str_replace(" ", "_", strtolower($fieldName));
            }

            $brand_list = Brand::where('is_active', true)->get();
            $category_list = Category::where('is_active', true)->get();
            $product_type_list = ProductType::where('is_active', true)->get();


            return view('backend.product.index', compact('warehouse_id','all_permission', 'role_id', 'numberOfProduct', 'custom_fields', 'field_name','lims_warehouse_list', 'brand_list', 'category_list', 'product_type_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function productData(Request $request)
    {
        ini_set('memory_limit', '1G');
        ini_set('display_errors', 0);
        error_reporting(0);
        try {
            $columns = array(
                1 => 'name',
                2 => 'code',
                3 => 'brand_id',
                4 => 'category_id',
                5 => 'product_type_id',
                6 => 'qty',
                7 => 'base',
                8 => 'addition',
                9 => 'price',
                10 => 'cost'
            );

        $warehouse_id = $request->input('warehouse_id');

        $totalData = DB::table('products')->where('is_active', true)->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $orderColumn = $request->input('order.0.column');
        $order = 'products.' . ($columns[$orderColumn] ?? 'id');
        $dir = $request->input('order.0.dir', 'desc');
        //fetching custom fields data
        $custom_fields = CustomField::where([
                        ['belongs_to', 'product'],
                        ['is_table', true]
                    ])->pluck('name');
        $field_names = [];
        foreach($custom_fields as $fieldName) {
            $field_names[] = str_replace(" ", "_", strtolower($fieldName));
        }
        if(empty($request->input('search.value'))){
            $products = Product::with('category', 'brand', 'unit', 'productType')
                        ->offset($start)
                        ->where('is_active', true)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        }
        else
        {
            $search = $request->input('search.value');
            $q = Product::select('products.*')
                ->with('category', 'brand', 'unit', 'productType')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->leftjoin('product_purchases','product_purchases.product_id','=', 'products.id')
                ->leftjoin('brands', 'products.brand_id', '=', 'brands.id')
                ->leftjoin('product_variants', 'products.id', '=', 'product_variants.product_id')
                ->where([
                    ['products.name', 'LIKE', "%{$search}%"],
                    ['products.is_active', true]
                ])
                ->orWhere([
                    ['products.code', 'LIKE', "%{$search}%"],
                    ['products.is_active', true]
                ])
                ->orWhere([
                    ['product_variants.item_code', 'LIKE', "%{$search}%"],
                    ['products.is_active', true]
                ])
                ->orWhere([
                    ['categories.name', 'LIKE', "%{$search}%"],
                    ['categories.is_active', true],
                    ['products.is_active', true]
                ])
                ->orWhere([
                    ['brands.title', 'LIKE', "%{$search}%"],
                    ['brands.is_active', true],
                    ['products.is_active', true]
                ])
                ->orWhere([
                    ['product_purchases.imei_number', 'LIKE', "%{$search}%"],
                    ['products.is_active', true]
                ]);
            //searching with custom field
            foreach ($field_names as $key => $field_name) {
                $q = $q->orwhere('products.' . $field_name, 'LIKE', "%{$search}%");
            }

            // ->where([
            //     ['products.brand_id', $request->brand],
            //     ['products.category_id', $request->category],
            //     ['products.product_type_id', $request->product_type],
            // ])

            if ($request->input('brand_id')) {
                $q = $q->where('products.brand_id', $request->input('brand_id'));
            }
            // foreach ($field_names as $key => $field_name) {
            //     $q = $q->orwhere('products.' . $field_name, 'LIKE', "%{$search}%");
            // }
            // foreach ($field_names as $key => $field_name) {
            //     $q = $q->orwhere('products.' . $field_name, 'LIKE', "%{$search}%");
            // }

            $q = $q->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir);

            $products = $q->groupBy('products.id')->get();
            $totalFiltered = $q->groupBy('products.id')->count();
            /*$totalFiltered = Product::
                            join('categories', 'products.category_id', '=', 'categories.id')
                            ->leftjoin('brands', 'products.brand_id', '=', 'brands.id')
                            ->where([
                                ['products.name','LIKE',"%{$search}%"],
                                ['products.is_active', true]
                            ])
                            ->orWhere([
                                ['products.code', 'LIKE', "%{$search}%"],
                                ['products.is_active', true]
                            ])
                            ->orWhere([
                                ['categories.name', 'LIKE', "%{$search}%"],
                                ['categories.is_active', true],
                                ['products.is_active', true]
                            ])
                            ->orWhere([
                                ['brands.title', 'LIKE', "%{$search}%"],
                                ['brands.is_active', true],
                                ['products.is_active', true]
                            ])
                            ->count();*/
        }
        // Load permissions server-side (never trust client-sent permissions)
        $all_permission = $request['all_permission'] ?? [];
        if (empty($all_permission)) {
            $user = Auth::user();
            if ($user) {
                $role = Role::find($user->role_id);
                if ($role) {
                    $all_permission = $role->permissions->pluck('name')->toArray();
                }
            }
        }
        if (!is_array($all_permission)) {
            $all_permission = [];
        }

        $data = array();
        if(!empty($products))
        {
            // Eagerly pre-calculate warehouse quantities if a warehouse is given
            $warehouse_qtys = [];
            if ($warehouse_id > 0) {
                $productIds = $products->pluck('id')->toArray();
                $warehouse_qtys = Product_Warehouse::whereIn('product_id', $productIds)
                                    ->where('warehouse_id', $warehouse_id)
                                    ->selectRaw('product_id, SUM(qty) as total_qty')
                                    ->groupBy('product_id')
                                    ->pluck('total_qty', 'product_id')->toArray();
            }

            foreach ($products as $key=>$product)
            {
                $nestedData['id'] = $product->id;
                $nestedData['key'] = $key;
                $nestedData['base'] = $product->base;
                $nestedData['addition'] = $product->addition;
                $nestedData['product_type'] = $product->productType ? $product->productType->name : 'N/A';

                $product_image = explode(",", $product->image);
                $product_image = htmlspecialchars($product_image[0]);
                if($product_image && $product_image != 'zummXD2dvAtI.avif') {
                    if(file_exists(public_path("images/product/small/". $product_image)))
                        $nestedData['image'] = '<img src="'.url('images/product/small', $product_image).'" height="80" width="80">';
                    else
                        $nestedData['image'] = '<img src="'.url('images/product', $product_image).'" height="80" width="80">';
                }
                else
                    $nestedData['image'] = '<img src="'.url('images/zummXD2dvAtI.avif').'" height="80" width="80">';
                
                $nestedData['name'] = $product->name;
                $nestedData['code'] = $product->code;
                if($product->brand)
                    $nestedData['brand'] = $product->brand->title;
                else
                    $nestedData['brand'] = "N/A";
                
                $nestedData['category'] = $product->category ? $product->category->name : 'N/A';
                
                if($warehouse_id > 0 && $product->type == 'standard') {
                    $nestedData['qty'] = $warehouse_qtys[$product->id] ?? 0;
                }
                elseif($product->type == 'standard') {
                    // If no warehouse specified, use the aggregate qty on the product model itself
                    $nestedData['qty'] = $product->qty;
                }
                else
                    $nestedData['qty'] = $product->qty;

                if($product->unit)
                    $nestedData['unit'] = $product->unit->unit_name;
                else
                    $nestedData['unit'] = 'N/A';

                $nestedData['price'] = $product->price;
                $nestedData['cost'] = $product->cost;

                if(config('currency_position') == 'prefix')
                    $nestedData['stock_worth'] = config('currency').' '.number_format(($nestedData['qty'] * $product->price), 2).' / '.config('currency').' '.number_format(($nestedData['qty'] * $product->cost), 2);
                else
                    $nestedData['stock_worth'] = number_format(($nestedData['qty'] * $product->price), 2).' '.config('currency').' / '.number_format(($nestedData['qty'] * $product->cost), 2).' '.config('currency');

                //fetching custom fields data
                foreach($field_names as $field_name) {
                    $nestedData[$field_name] = $product->$field_name;
                }

                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            <li>
                                <button type="button" class="btn btn-link view"><i class="fa fa-eye"></i> '.trans('file.View').'</button>
                            </li>';

                if(in_array("products-edit", $all_permission))
                    $nestedData['options'] .= '<li>
                            <a href="'.route('products.edit', $product->id).'" class="btn btn-link"><i class="fa fa-edit"></i> '.trans('file.edit').'</a>
                        </li>';
                if(in_array("product_history", $all_permission))
                    $nestedData['options'] .= \Form::open(["route" => "products.history", "method" => "GET"] ).'
                            <li>
                                <input type="hidden" name="product_id" value="'.$product->id.'" />
                                <button type="submit" class="btn btn-link"><i class="dripicons-checklist"></i> '.trans("file.Product History").'</button>
                            </li>'.\Form::close();
                if(in_array("print_barcode", $all_permission)) {
                    $product_info = $product->code.' ('.$product->name.')';
                    $nestedData['options'] .= \Form::open(["route" => "product.printBarcode", "method" => "GET"] ).'
                        <li>
                            <input type="hidden" name="data" value="'.$product_info.'" />
                            <button type="submit" class="btn btn-link"><i class="dripicons-print"></i> '.trans("file.print_barcode").'</button>
                        </li>'.\Form::close();
                }
                if(in_array("products-delete", $all_permission))
                    $nestedData['options'] .= \Form::open(["route" => ["products.destroy", $product->id], "method" => "DELETE"] ).'
                            <li>
                              <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="fa fa-trash"></i> '.trans("file.delete").'</button>
                            </li>'.\Form::close().'
                        </ul>
                    </div>';
                // data for product details by one click
                if($product->tax_id)
                    $tax = Tax::find($product->tax_id)->name;
                else
                    $tax = "N/A";

                if($product->tax_method == 1)
                    $tax_method = trans('file.Exclusive');
                else
                    $tax_method = trans('file.Inclusive');

                $nestedData['product'] = array( '[ "'.$product->type.'"', ' "'.$product->name.'"', ' "'.$product->code.'"', ' "'.$nestedData['brand'].'"', ' "'.$nestedData['category'].'"', ' "'.$nestedData['unit'].'"', ' "'.$product->cost.'"', ' "'.$product->price.'"', ' "'.$tax.'"', ' "'.$tax_method.'"', ' "'.$product->alert_quantity.'"', ' "'.preg_replace('/\s+/S', " ", $product->product_details).'"', ' "'.$product->id.'"', ' "'.$product->product_list.'"', ' "'.$product->variant_list.'"', ' "'.$product->qty_list.'"', ' "'.$product->price_list.'"', ' "'.$nestedData['qty'].'"', ' "'.$product->image.'"', ' "'.$product->is_variant.'"]'
                );

                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return response()->json($json_data);
      } catch (\Throwable $e) {
        \Log::error('DataTables Error (Product): ' . $e->getMessage(), ['exception' => $e]);
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'error' => $e->getMessage()
        ], 500);
      }
    }

    public function create()
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('products-add')){
            $lims_product_list_without_variant = collect([]);
            $lims_product_list_with_variant = collect([]);
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $numberOfProduct = Product::where('is_active', true)->count();
            $custom_fields = CustomField::where('belongs_to', 'product')->get();
            $lims_product_type_list = ProductType::where('is_active', true)->get();

            return view('backend.product.create',compact('lims_product_list_without_variant', 'lims_product_list_with_variant', 'lims_brand_list', 'lims_category_list', 'lims_unit_list', 'lims_tax_list', 'lims_warehouse_list', 'numberOfProduct', 'custom_fields', 'lims_product_type_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        //return $request;
        $data['type'] = 'standard';
        $this->validate($request, [
            'code' => [
                'max:255',
                    Rule::unique('products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
            'name' => [
                'max:255',
                    Rule::unique('products')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ]
        ]);
        $data = $request->except('image', 'file');

        if(isset($data['is_variant'])) {
            $data['variant_option'] = json_encode(array_unique($data['variant_option']));
            $data['variant_value'] = json_encode(array_unique($data['variant_value']));
        }
        else {
            $data['variant_option'] = $data['variant_value'] = null;
        }

        $data['name'] = preg_replace('/[\n\r]/', "<br>", htmlspecialchars(trim($data['name']), ENT_QUOTES));

        if(in_array('ecommerce', explode(',',config('addons')))) {
            $data['slug'] = Str::slug($data['name'], '-');
            $data['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']);
            $data['slug'] = str_replace( '\/', '/', $data['slug'] );
        }

        $data['type']  = 'standard';

        if($data['type'] == 'combo') {
            $data['product_list'] = implode(",", $data['product_id']);
            $data['variant_list'] = implode(",", $data['variant_id']);
            $data['qty_list'] = implode(",", $data['product_qty']);
            $data['price_list'] = implode(",", $data['unit_price']);
            //$data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
        }
        elseif($data['type'] == 'digital' || $data['type'] == 'service')
            $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;

        $data['product_details'] = str_replace('"', '@', $data['product_details']);

        if($data['starting_date'])
            $data['starting_date'] = date('Y-m-d', strtotime($data['starting_date']));
        if($data['last_date'])
            $data['last_date'] = date('Y-m-d', strtotime($data['last_date']));
        $data['is_active'] = true;
        $images = $request->image;
        $image_names = [];
        if ($images) {
            // Ensure the necessary directories exist using public_path()
            if (!file_exists(public_path("images/product/xlarge")) && !is_dir(public_path("images/product/xlarge"))) {
                mkdir(public_path("images/product/xlarge"), 0755, true);
            }
            if (!file_exists(public_path("images/product/large")) && !is_dir(public_path("images/product/large"))) {
                mkdir(public_path("images/product/large"), 0755, true);
            }
            if (!file_exists(public_path("images/product/medium")) && !is_dir(public_path("images/product/medium"))) {
                mkdir(public_path("images/product/medium"), 0755, true);
            }
            if (!file_exists(public_path("images/product/small")) && !is_dir(public_path("images/product/small"))) {
                mkdir(public_path("images/product/small"), 0755, true);
            }

            foreach ($images as $key => $image) {
                $baseName = date("Ymdhis") . ($key + 1);

                // Handle multi-tenant logic
                if (config('database.connections.saleprosaas_landlord')) {
                    $baseName = $this->getTenantId() . '_' . $baseName;
                }

                $sizes = [
                    'xlarge' => [1000, 1250],
                    'large' => [500, 500],
                    'medium' => [250, 250],
                    'small' => [100, 100],
                ];

                $imageName = $this->imageService->saveAsAvif($image, 'images/product', $baseName, $sizes);

                // Collect image names for saving in the database
                $image_names[] = $imageName;
            }

            // Save the image names in the database
            $data['image'] = implode(",", $image_names);
        }

        else {
            $data['image'] = 'zummXD2dvAtI.avif';
        }
        $file = $request->file;
        if ($file) {
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = strtotime(date('Y-m-d H:i:s'));
            $fileName = $fileName . '.' . $ext;
            $file->move(public_path('product/files'), $fileName);
            $data['file'] = $fileName;
        }
        if(!isset($data['is_sync_disable']) && \Schema::hasColumn('products', 'is_sync_disable'))
                $data['is_sync_disable'] = null;
        //return $data;
        $data["type"] = "standard";

        $data["unit_id"] = 1;
        $data["unit"] = 1;
        $data["sale_unit_id"] = 1;
        $data["sale_unit"] = 1;
        $data["purchase_unit_id"] = 1;
        $data["purchase_unit"] = 1;
        $data['product_type_id'] = $data['product_type'];


        $lims_product_data = Product::create($data);
        //inserting custom field data
        $custom_field_data = [];
        $custom_fields = CustomField::where('belongs_to', 'product')->select('name', 'type')->get();
        foreach ($custom_fields as $type => $custom_field) {
            $field_name = str_replace(' ', '_', strtolower($custom_field->name));
            if(isset($data[$field_name])) {
                if($custom_field->type == 'checkbox' || $custom_field->type == 'multi_select')
                    $custom_field_data[$field_name] = implode(",", $data[$field_name]);
                else
                    $custom_field_data[$field_name] = $data[$field_name];
            }
        }
        if(count($custom_field_data))
            DB::table('products')->where('id', $lims_product_data->id)->update($custom_field_data);
        //dealing with initial stock and auto purchase
        $initial_stock = 0;
        if(isset($data['is_initial_stock']) && !isset($data['is_variant']) && !isset($data['is_batch'])) {
            foreach ($data['stock_warehouse_id'] as $key => $warehouse_id) {
                $stock = $data['stock'][$key];
                if($stock > 0) {
                    $this->autoPurchase($lims_product_data, $warehouse_id, $stock);
                    $initial_stock += $stock;
                }
            }
        }
        if($initial_stock > 0) {
            $lims_product_data->qty += $initial_stock;
            $lims_product_data->save();
        }
        //dealing with product variant
        if(!isset($data['is_batch']))
            $data['is_batch'] = null;
        $variant_ids = [];
        if(isset($data['is_variant'])) {
            foreach ($data['variant_name'] as $key => $variant_name) {
                $lims_variant_data = Variant::firstOrCreate(['name' => $data['variant_name'][$key]]);
                $variant_ids[] = $lims_variant_data->id;
                $product_variant = ProductVariant::firstOrNew([
                    'product_id' => $lims_product_data->id,
                    'variant_id' => $lims_variant_data->id,
                    'item_code' => $data['item_code'][$key],
                    'additional_cost' => $data['additional_cost'][$key],
                    'additional_price' => $data['additional_price'][$key],
                    'qty' => 0,
                ]);
                $product_variant->position = $key + 1;
                $product_variant->save();
            }
        }
        if(isset($data['is_diffPrice'])) {
            foreach ($data['diff_price'] as $key => $diff_price) {
                if($diff_price) {
                    Product_Warehouse::firstOrCreate([
                        "product_id" => $lims_product_data->id,
                        "warehouse_id" => $data["warehouse_id"][$key],
                        "qty" => 0,
                        "price" => $diff_price
                    ]);
                }
            }
        }
        elseif(!isset($data['is_initial_stock']) && !isset($data['is_batch']) && config('without_stock') == 'yes') {
            $warehouse_ids = Warehouse::where('is_active', true)->pluck('id');
            foreach ($warehouse_ids as $warehouse_id) {
                if(count($variant_ids)) {
                    foreach ($variant_ids as $variant_id) {
                        Product_Warehouse::firstOrCreate([
                            "product_id" => $lims_product_data->id,
                            "variant_id" => $variant_id,
                            "warehouse_id" => $warehouse_id,
                            "qty" => 0,
                        ]);
                    }
                }
                else {
                    Product_Warehouse::firstOrCreate([
                        "product_id" => $lims_product_data->id,
                        "warehouse_id" => $warehouse_id,
                        "qty" => 0,
                    ]);
                }
            }
        }
        $this->cacheForget('product_list');
        $this->cacheForget('product_list_with_variant');
        \Session::flash('create_message', 'Product created successfully');
    }

    public function autoPurchase($product_data, $warehouse_id, $stock)
    {
        $data['reference_no'] = 'pr-' . date("Ymd") . '-'. date("his");
        $data['user_id'] = Auth::id();
        $data['warehouse_id'] = $warehouse_id;
        $data['item'] = 1;
        $data['total_qty'] = $stock;
        $data['total_discount'] = 0;
        $data['status'] = 1;
        $data['payment_status'] = 2;
        if($product_data->tax_id) {
            $tax_data = DB::table('taxes')->select('rate')->find($product_data->tax_id);
            if($product_data->tax_method == 1) {
                $net_unit_cost = number_format($product_data->cost, 2, '.', '');
                $tax = number_format($product_data->cost * $stock * ($tax_data->rate / 100), 2, '.', '');
                $cost = number_format(($product_data->cost * $stock) + $tax, 2, '.', '');
            }
            else {
                $net_unit_cost = number_format((100 / (100 + $tax_data->rate)) * $product_data->cost, 2, '.', '');
                $tax = number_format(($product_data->cost - $net_unit_cost) * $stock, 2, '.', '');
                $cost = number_format($product_data->cost * $stock, 2, '.', '');
            }
            $tax_rate = $tax_data->rate;
            $data['total_tax'] = $tax;
            $data['total_cost'] = $cost;
        }
        else {
            $data['total_tax'] = 0.00;
            $data['total_cost'] = number_format($product_data->cost * $stock, 2, '.', '');
            $net_unit_cost = number_format($product_data->cost, 2, '.', '');
            $tax_rate = 0.00;
            $tax = 0.00;
            $cost = number_format($product_data->cost * $stock, 2, '.', '');
        }

        $product_warehouse_data = Product_Warehouse::select('id', 'qty')
                                ->where([
                                    ['product_id', $product_data->id],
                                    ['warehouse_id', $warehouse_id]
                                ])->first();
        if($product_warehouse_data) {
            $product_warehouse_data->qty += $stock;
            $product_warehouse_data->save();
        }
        else {
            $lims_product_warehouse_data = new Product_Warehouse();
            $lims_product_warehouse_data->product_id = $product_data->id;
            $lims_product_warehouse_data->warehouse_id = $warehouse_id;
            $lims_product_warehouse_data->qty = $stock;
            $lims_product_warehouse_data->save();
        }
        $data['order_tax'] = 0;
        $data['grand_total'] = $data['total_cost'];
        $data['paid_amount'] = $data['grand_total'];
        //insetting data to purchase table
        $purchase_data = Purchase::create($data);
        //inserting data to product_purchases table
        ProductPurchase::create([
            'purchase_id' => $purchase_data->id,
            'product_id' => $product_data->id,
            'qty' => $stock,
            'recieved' => $stock,
            'purchase_unit_id' => $product_data->unit_id,
            'net_unit_cost' => $net_unit_cost,
            'discount' => 0,
            'tax_rate' => $tax_rate,
            'tax' => $tax,
            'total' => $cost
        ]);
        //inserting data to payments table
        Payment::create([
            'payment_reference' => 'ppr-' . date("Ymd") . '-'. date("his"),
            'user_id' => Auth::id(),
            'purchase_id' => $purchase_data->id,
            'account_id' => 0,
            'amount' => $data['grand_total'],
            'change' => 0,
            'paying_method' => 'Cash'
        ]);
    }

    public function history(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('product_history')) {
            if($request->input('warehouse_id'))
                $warehouse_id = $request->input('warehouse_id');
            else
                $warehouse_id = 0;

            if($request->input('starting_date')) {
                $starting_date = $request->input('starting_date');
                $ending_date = $request->input('ending_date');
            }
            else {
                $starting_date = date("Y-m-d", strtotime(date('Y-m-d', strtotime('-1 year', strtotime(date('Y-m-d') )))));
                $ending_date = date("Y-m-d");
            }
            $product_id = $request->input('product_id');
            $product_data = Product::select('name', 'code')->find($product_id);
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            return view('backend.product.history',compact('starting_date', 'ending_date', 'warehouse_id', 'product_id', 'product_data', 'lims_warehouse_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function saleHistoryData(Request $request)
    {
        $columns = array(
            1 => 'created_at',
            2 => 'reference_no',
        );

        $product_id = $request->input('product_id');
        $warehouse_id = $request->input('warehouse_id');

        $q = DB::table('sales')
            ->join('product_sales', 'sales.id', '=', 'product_sales.sale_id')
            ->where('product_sales.product_id', $product_id)
            ->whereDate('sales.created_at', '>=' ,$request->input('starting_date'))
            ->whereDate('sales.created_at', '<=' ,$request->input('ending_date'));
        if($warehouse_id)
            $q = $q->where('warehouse_id', $warehouse_id);
        if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
            $q = $q->where('sales.user_id', Auth::id());

        $totalData = $q->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'sales.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $q = $q->join('customers', 'sales.customer_id', '=', 'customers.id')
                ->join('warehouses', 'sales.warehouse_id', '=', 'warehouses.id')
                ->select('sales.id', 'sales.reference_no', 'sales.created_at', 'customers.name as customer_name', 'customers.phone_number as customer_number', 'warehouses.name as warehouse_name', 'product_sales.qty', 'product_sales.sale_unit_id', 'product_sales.total')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
        if(empty($request->input('search.value'))) {
            $sales = $q->get();
        }
        else
        {
            $search = $request->input('search.value');
            $q = $q->whereDate('sales.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))));
            if(Auth::user()->role_id > 2 && config('staff_access') == 'own') {
                $sales =  $q->orwhere([
                                ['sales.reference_no', 'LIKE', "%{$search}%"],
                                ['sales.user_id', Auth::id()]
                            ])
                            ->get();
                $totalFiltered = $q->orwhere([
                                    ['sales.reference_no', 'LIKE', "%{$search}%"],
                                    ['sales.user_id', Auth::id()]
                                ])
                                ->count();
            }
            else {
                $sales =  $q->orwhere('sales.reference_no', 'LIKE', "%{$search}%")->get();
                $totalFiltered = $q->orwhere('sales.reference_no', 'LIKE', "%{$search}%")->count();
            }
        }
        $data = array();
        if(!empty($sales))
        {
            foreach ($sales as $key => $sale)
            {
                $nestedData['id'] = $sale->id;
                $nestedData['key'] = $key;
                $nestedData['date'] = date(config('date_format'), strtotime($sale->created_at));
                $nestedData['reference_no'] = $sale->reference_no;
                $nestedData['warehouse'] = $sale->warehouse_name;
                $nestedData['customer'] = $sale->customer_name.' ['.($sale->customer_number).']';
                $nestedData['qty'] = number_format($sale->qty, config('decimal'));
                if($sale->sale_unit_id) {
                    $unit_data = DB::table('units')->select('unit_code')->find($sale->sale_unit_id);
                    $nestedData['qty'] .= ' '.$unit_data->unit_code;
                }
                $nestedData['unit_price'] = number_format(($sale->total / $sale->qty), config('decimal'));
                $nestedData['sub_total'] = number_format($sale->total, config('decimal'));
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function purchaseHistoryData(Request $request)
    {
        $columns = array(
            1 => 'created_at',
            2 => 'reference_no',
        );

        $product_id = $request->input('product_id');
        $warehouse_id = $request->input('warehouse_id');

        $q = DB::table('purchases')
            ->join('product_purchases', 'purchases.id', '=', 'product_purchases.purchase_id')
            ->where('product_purchases.product_id', $product_id)
            ->whereDate('purchases.created_at', '>=' ,$request->input('starting_date'))
            ->whereDate('purchases.created_at', '<=' ,$request->input('ending_date'));
        if($warehouse_id)
            $q = $q->where('warehouse_id', $warehouse_id);
        if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
            $q = $q->where('purchases.user_id', Auth::id());

        $totalData = $q->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'purchases.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $q = $q->leftJoin('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                ->join('warehouses', 'purchases.warehouse_id', '=', 'warehouses.id')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
        if(empty($request->input('search.value'))) {
            $purchases = $q->select('purchases.id', 'purchases.reference_no', 'purchases.created_at', 'purchases.supplier_id', 'suppliers.name as supplier_name', 'suppliers.phone_number as supplier_number', 'warehouses.name as warehouse_name', 'product_purchases.qty', 'product_purchases.purchase_unit_id', 'product_purchases.total')->get();
        }
        else
        {
            $search = $request->input('search.value');
            $q = $q->whereDate('purchases.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))));
            if(Auth::user()->role_id > 2 && config('staff_access') == 'own') {
                $purchases =  $q->select('purchases.id', 'purchases.reference_no', 'purchases.created_at', 'purchases.supplier_id', 'suppliers.name as supplier_name', 'suppliers.phone_number as supplier_number', 'warehouses.name as warehouse_name', 'product_purchases.qty', 'product_purchases.purchase_unit_id', 'product_purchases.total')
                            ->orwhere([
                                ['purchases.reference_no', 'LIKE', "%{$search}%"],
                                ['purchases.user_id', Auth::id()]
                            ])->get();
                $totalFiltered = $q->orwhere([
                                    ['purchases.reference_no', 'LIKE', "%{$search}%"],
                                    ['purchases.user_id', Auth::id()]
                                ])->count();
            }
            else {
                $purchases =  $q->select('purchases.id', 'purchases.reference_no', 'purchases.created_at', 'purchases.supplier_id', 'suppliers.name as supplier_name', 'suppliers.phone_number as supplier_number', 'warehouses.name as warehouse_name', 'product_purchases.qty', 'product_purchases.purchase_unit_id', 'product_purchases.total')
                            ->orwhere('purchases.reference_no', 'LIKE', "%{$search}%")
                            ->get();
                $totalFiltered = $q->orwhere('purchases.reference_no', 'LIKE', "%{$search}%")->count();
            }
        }
        $data = array();
        if(!empty($purchases))
        {
            foreach ($purchases as $key => $purchase)
            {
                $nestedData['id'] = $purchase->id;
                $nestedData['key'] = $key;
                $nestedData['date'] = date(config('date_format'), strtotime($purchase->created_at));
                $nestedData['reference_no'] = $purchase->reference_no;
                $nestedData['warehouse'] = $purchase->warehouse_name;
                if($purchase->supplier_id)
                    $nestedData['supplier'] = $purchase->supplier_name.' ['.($purchase->supplier_number).']';
                else
                    $nestedData['supplier'] = 'N/A';
                $nestedData['qty'] = number_format($purchase->qty, config('decimal'));
                if($purchase->purchase_unit_id) {
                    $unit_data = DB::table('units')->select('unit_code')->find($purchase->purchase_unit_id);
                    $nestedData['qty'] .= ' '.$unit_data->unit_code;
                }
                $nestedData['unit_cost'] = number_format(($purchase->total / $purchase->qty), config('decimal'));
                $nestedData['sub_total'] = number_format($purchase->total, config('decimal'));
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function saleReturnHistoryData(Request $request)
    {
        $columns = array(
            1 => 'created_at',
            2 => 'reference_no',
        );

        $product_id = $request->input('product_id');
        $warehouse_id = $request->input('warehouse_id');

        $q = DB::table('returns')
            ->join('product_returns', 'returns.id', '=', 'product_returns.return_id')
            ->where('product_returns.product_id', $product_id)
            ->whereDate('returns.created_at', '>=' ,$request->input('starting_date'))
            ->whereDate('returns.created_at', '<=' ,$request->input('ending_date'));
        if($warehouse_id)
            $q = $q->where('warehouse_id', $warehouse_id);
        if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
            $q = $q->where('returns.user_id', Auth::id());

        $totalData = $q->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'returns.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $q = $q->join('customers', 'returns.customer_id', '=', 'customers.id')
                ->join('warehouses', 'returns.warehouse_id', '=', 'warehouses.id')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
        if(empty($request->input('search.value'))) {
            $returnss = $q->select('returns.id', 'returns.reference_no', 'returns.created_at', 'customers.name as customer_name', 'customers.phone_number as customer_number', 'warehouses.name as warehouse_name', 'product_returns.qty', 'product_returns.sale_unit_id', 'product_returns.total')->get();
        }
        else
        {
            $search = $request->input('search.value');
            $q = $q->whereDate('returns.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))));
            if(Auth::user()->role_id > 2 && config('staff_access') == 'own') {
                $returnss =  $q->select('returns.id', 'returns.reference_no', 'returns.created_at', 'customers.name as customer_name', 'customers.phone_number as customer_number', 'warehouses.name as warehouse_name', 'product_returns.qty', 'product_returns.sale_unit_id', 'product_returns.total')
                            ->orwhere([
                                ['returns.reference_no', 'LIKE', "%{$search}%"],
                                ['returns.user_id', Auth::id()]
                            ])
                            ->get();
                $totalFiltered = $q->orwhere([
                                    ['returns.reference_no', 'LIKE', "%{$search}%"],
                                    ['returns.user_id', Auth::id()]
                                ])
                                ->count();
            }
            else {
                $returnss =  $q->select('returns.id', 'returns.reference_no', 'returns.created_at', 'customers.name as customer_name', 'customers.phone_number as customer_number', 'warehouses.name as warehouse_name', 'product_returns.qty', 'product_returns.sale_unit_id', 'product_returns.total')
                            ->orwhere('returns.reference_no', 'LIKE', "%{$search}%")
                            ->get();
                $totalFiltered = $q->orwhere('returns.reference_no', 'LIKE', "%{$search}%")->count();
            }
        }
        $data = array();
        if(!empty($returnss))
        {
            foreach ($returnss as $key => $returns)
            {
                $nestedData['id'] = $returns->id;
                $nestedData['key'] = $key;
                $nestedData['date'] = date(config('date_format'), strtotime($returns->created_at));
                $nestedData['reference_no'] = $returns->reference_no;
                $nestedData['warehouse'] = $returns->warehouse_name;
                $nestedData['customer'] = $returns->customer_name.' ['.($returns->customer_number).']';
                $nestedData['qty'] = number_format($returns->qty, config('decimal'));
                if($returns->sale_unit_id) {
                    $unit_data = DB::table('units')->select('unit_code')->find($returns->sale_unit_id);
                    $nestedData['qty'] .= ' '.$unit_data->unit_code;
                }
                $nestedData['unit_price'] = number_format(($returns->total / $returns->qty), config('decimal'));
                $nestedData['sub_total'] = number_format($returns->total, config('decimal'));
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function purchaseReturnHistoryData(Request $request)
    {
        $columns = array(
            1 => 'created_at',
            2 => 'reference_no',
        );

        $product_id = $request->input('product_id');
        $warehouse_id = $request->input('warehouse_id');

        $q = DB::table('return_purchases')
            ->join('purchase_product_return', 'return_purchases.id', '=', 'purchase_product_return.return_id')
            ->where('purchase_product_return.product_id', $product_id)
            ->whereDate('return_purchases.created_at', '>=' ,$request->input('starting_date'))
            ->whereDate('return_purchases.created_at', '<=' ,$request->input('ending_date'));
        if($warehouse_id)
            $q = $q->where('warehouse_id', $warehouse_id);
        if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
            $q = $q->where('return_purchases.user_id', Auth::id());

        $totalData = $q->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = 'return_purchases.'.$columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $q = $q->leftJoin('suppliers', 'return_purchases.supplier_id', '=', 'suppliers.id')
                ->join('warehouses', 'return_purchases.warehouse_id', '=', 'warehouses.id')
                ->select('return_purchases.id', 'return_purchases.reference_no', 'return_purchases.created_at', 'return_purchases.supplier_id', 'suppliers.name as supplier_name', 'suppliers.phone_number as supplier_number', 'warehouses.name as warehouse_name', 'purchase_product_return.qty', 'purchase_product_return.purchase_unit_id', 'purchase_product_return.total')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
        if(empty($request->input('search.value'))) {
            $return_purchases = $q->get();
        }
        else
        {
            $search = $request->input('search.value');
            $q = $q->whereDate('return_purchases.created_at', '=' , date('Y-m-d', strtotime(str_replace('/', '-', $search))));

            if(Auth::user()->role_id > 2 && config('staff_access') == 'own') {
                $return_purchases =  $q->orwhere([
                                        ['return_purchases.reference_no', 'LIKE', "%{$search}%"],
                                        ['return_purchases.user_id', Auth::id()]
                                    ])
                                    ->get();
                $totalFiltered = $q->orwhere([
                                    ['return_purchases.reference_no', 'LIKE', "%{$search}%"],
                                    ['return_purchases.user_id', Auth::id()]
                                ])
                                ->count();
            }
            else {
                $return_purchases =  $q->orwhere('return_purchases.reference_no', 'LIKE', "%{$search}%")->get();
                $totalFiltered = $q->orwhere('return_purchases.reference_no', 'LIKE', "%{$search}%")->count();
            }
        }
        $data = array();
        if(!empty($return_purchases))
        {
            foreach ($return_purchases as $key => $return_purchase)
            {
                $nestedData['id'] = $return_purchase->id;
                $nestedData['key'] = $key;
                $nestedData['date'] = date(config('date_format'), strtotime($return_purchase->created_at));
                $nestedData['reference_no'] = $return_purchase->reference_no;
                $nestedData['warehouse'] = $return_purchase->warehouse_name;
                if($return_purchase->supplier_id)
                    $nestedData['supplier'] = $return_purchase->supplier_name.' ['.($return_purchase->supplier_number).']';
                else
                    $nestedData['supplier'] = 'N/A';
                $nestedData['qty'] = number_format($return_purchase->qty, config('decimal'));
                if($return_purchase->purchase_unit_id) {
                    $unit_data = DB::table('units')->select('unit_code')->find($return_purchase->purchase_unit_id);
                    $nestedData['qty'] .= ' '.$unit_data->unit_code;
                }
                $nestedData['unit_cost'] = number_format(($return_purchase->total / $return_purchase->qty), config('decimal'));
                $nestedData['sub_total'] = number_format($return_purchase->total, config('decimal'));
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function variantData($id)
    {
        if(Auth::user()->role_id > 2) {
            return ProductVariant::join('variants', 'product_variants.variant_id', '=', 'variants.id')
                ->join('product_warehouse', function($join) {
                    $join->on('product_variants.product_id', '=', 'product_warehouse.product_id');
                    $join->on('product_variants.variant_id', '=', 'product_warehouse.variant_id');
                })
                ->select('variants.name', 'product_variants.item_code', 'product_variants.additional_cost', 'product_variants.additional_price', 'product_warehouse.qty')
                ->where([
                    ['product_warehouse.product_id', $id],
                    ['product_warehouse.warehouse_id', Auth::user()->warehouse_id]
                ])
                ->orderBy('product_variants.position')
                ->get();
        }
        else {
            return ProductVariant::join('variants', 'product_variants.variant_id', '=', 'variants.id')
                ->select('variants.name', 'product_variants.item_code', 'product_variants.additional_cost', 'product_variants.additional_price', 'product_variants.qty')
                ->orderBy('product_variants.position')
                ->where('product_id', $id)
                ->get();
        }
    }

    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('products-edit')) {
            $lims_product_list_without_variant = collect([]);
            $lims_product_list_with_variant = collect([]);
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_product_type_list = ProductType::where('is_active', true)->get();

            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_product_data = Product::where('id', $id)->first();
            if($lims_product_data->variant_option) {
                $lims_product_data->variant_option = json_decode($lims_product_data->variant_option);
                $lims_product_data->variant_value = json_decode($lims_product_data->variant_value);
            }
            $lims_product_variant_data = $lims_product_data->variant()->orderBy('position')->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $noOfVariantValue = 0;
            $custom_fields = CustomField::where('belongs_to', 'product')->get();

            if(in_array('ecommerce', explode(',',config('addons')))) {
                $product_arr = explode(',',$lims_product_data->related_products);
                $related_products = DB::table('products')->whereIn('id',$product_arr)->get();
                return view('backend.product.edit',compact('related_products','lims_product_list_without_variant', 'lims_product_list_with_variant', 'lims_brand_list', 'lims_category_list', 'lims_unit_list', 'lims_tax_list', 'lims_product_data', 'lims_product_variant_data', 'lims_warehouse_list', 'noOfVariantValue', 'custom_fields', 'lims_product_type_list'));
            }
            return view('backend.product.edit',compact('lims_product_list_without_variant', 'lims_product_list_with_variant', 'lims_brand_list', 'lims_category_list', 'lims_unit_list', 'lims_tax_list', 'lims_product_data', 'lims_product_variant_data', 'lims_warehouse_list', 'noOfVariantValue', 'custom_fields', 'lims_product_type_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function updateProduct(Request $request)
    {
        if(!env('USER_VERIFIED')) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }
        else {
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('products')->ignore($request->input('id'))->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],

                'code' => [
                    'max:255',
                    Rule::unique('products')->ignore($request->input('id'))->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ]
            ]);

            $lims_product_data = Product::findOrFail($request->input('id'));
            $data = $request->except('image', 'file', 'prev_img');
            $data['name'] = htmlspecialchars(trim($data['name']), ENT_QUOTES);

            $data['type']  = 'standard';

            if(in_array('ecommerce', explode(',',config('addons')))) {
                $data['slug'] = Str::slug($data['name'], '-');
                $data['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '', $data['slug']);
                $data['slug'] = str_replace( '\/', '/', $data['slug'] );
                $data['related_products'] = rtrim($request->products, ",");

                if(isset($request->in_stock))
                    $data['in_stock'] = $request->input('in_stock');
                else
                    $data['in_stock'] = 0;

                if(isset($request->is_online))
                    $data['is_online'] = $request->input('is_online');
                else
                    $data['is_online'] = 0;
            }

            if($data['type'] == 'combo') {
                $data['product_list'] = implode(",", $data['product_id']);
                $data['variant_list'] = implode(",", $data['variant_id']);
                $data['qty_list'] = implode(",", $data['product_qty']);
                $data['price_list'] = implode(",", $data['unit_price']);
                //$data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;
            }
            elseif($data['type'] == 'digital' || $data['type'] == 'service')
                $data['cost'] = $data['unit_id'] = $data['purchase_unit_id'] = $data['sale_unit_id'] = 0;

            if(!isset($data['featured']))
                $data['featured'] = 0;

            if(!isset($data['is_embeded']))
                $data['is_embeded'] = 0;

            if(!isset($data['promotion']))
                $data['promotion'] = null;

            if(!isset($data['is_batch']))
                $data['is_batch'] = null;

            if(!isset($data['is_imei']))
                $data['is_imei'] = null;

            if(!isset($data['is_sync_disable']) && \Schema::hasColumn('products', 'is_sync_disable'))
                $data['is_sync_disable'] = null;

            if(isset($data['short_description']))
                $data['short_description'] = $data['short_description'];
            $data['product_details'] = str_replace('"', '@', $data['product_details']);
            if($data['starting_date'])
                $data['starting_date'] = date('Y-m-d', strtotime($data['starting_date']));
            if($data['last_date'])
                $data['last_date'] = date('Y-m-d', strtotime($data['last_date']));

            $previous_images = [];
            //dealing with previous images
            if($request->prev_img) {
                foreach ($request->prev_img as $key => $prev_img) {
                    if(!in_array($prev_img, $previous_images))
                        $previous_images[] = $prev_img;
                }
                $lims_product_data->image = implode(",", $previous_images);
                $lims_product_data->save();
            }
            else {
                $lims_product_data->image = null;
                $lims_product_data->save();
            }

            //dealing with new images
            if ($request->image) {
                // Ensure the necessary directories exist using public_path()
                if (!file_exists(public_path("images/product/xlarge")) && !is_dir(public_path("images/product/xlarge"))) {
                    mkdir(public_path("images/product/xlarge"), 0755, true);
                }
                if (!file_exists(public_path("images/product/large")) && !is_dir(public_path("images/product/large"))) {
                    mkdir(public_path("images/product/large"), 0755, true);
                }
                if (!file_exists(public_path("images/product/medium")) && !is_dir(public_path("images/product/medium"))) {
                    mkdir(public_path("images/product/medium"), 0755, true);
                }
                if (!file_exists(public_path("images/product/small")) && !is_dir(public_path("images/product/small"))) {
                    mkdir(public_path("images/product/small"), 0755, true);
                }

                $images = $request->image;
                $image_names = [];
                $length = count(explode(",", $lims_product_data->image));

                foreach ($images as $key => $image) {
                    $baseName = date("Ymdhis") . ($length + $key + 1);

                    // Handle multi-tenant logic
                    if (config('database.connections.saleprosaas_landlord')) {
                        $baseName = $this->getTenantId() . '_' . $baseName;
                    }

                    $sizes = [
                        'xlarge' => [1000, 1250],
                        'large' => [500, 500],
                        'medium' => [250, 250],
                        'small' => [100, 100],
                    ];

                    $imageName = $this->imageService->saveAsAvif($image, 'images/product', $baseName, $sizes);

                    $image_names[] = $imageName;
                }

                // Append or set the image field with the new image names
                if($lims_product_data->image)
                    $data['image'] = $lims_product_data->image. ',' . implode(",", $image_names);
                else
                    $data['image'] = implode(",", $image_names);
            }
            else
                $data['image'] = $lims_product_data->image;

            $file = $request->file;
            if ($file) {
                $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $fileName = strtotime(date('Y-m-d H:i:s'));
                $fileName = $fileName . '.' . $ext;
                $file->move(public_path('product/files'), $fileName);
                $data['file'] = $fileName;
            }

            $old_product_variant_ids = ProductVariant::where('product_id', $request->input('id'))->pluck('id')->toArray();
            $new_product_variant_ids = [];
            //dealing with product variant
            if(isset($data['is_variant'])) {
                if(isset($data['variant_option']) && isset($data['variant_value'])) {
                    $data['variant_option'] = json_encode(array_unique($data['variant_option']));
                    $data['variant_value'] = json_encode(array_unique($data['variant_value']));
                }
                foreach ($data['variant_name'] as $key => $variant_name) {
                    $lims_variant_data = Variant::firstOrCreate(['name' => $data['variant_name'][$key]]);
                    $lims_product_variant_data = ProductVariant::where([
                                                    ['product_id', $lims_product_data->id],
                                                    ['variant_id', $lims_variant_data->id]
                                                ])->first();
                    if($lims_product_variant_data) {
                        $lims_product_variant_data->update([
                            'position' => $key+1,
                            'item_code' => $data['item_code'][$key],
                            'additional_cost' => $data['additional_cost'][$key],
                            'additional_price' => $data['additional_price'][$key]
                        ]);
                    }
                    else {
                        $lims_product_variant_data = ProductVariant::firstOrNew([
                            'product_id' => $lims_product_data->id,
                            'variant_id' => $lims_variant_data->id,
                            'item_code' => $data['item_code'][$key],
                            'additional_cost' => $data['additional_cost'][$key],
                            'additional_price' => $data['additional_price'][$key],
                            'qty' => 0,
                        ]);
                        $lims_product_variant_data->position = $key + 1;
                        $lims_product_variant_data->save();
                    }
                    $new_product_variant_ids[] = $lims_product_variant_data->id;
                }
            }
            else {
                $data['is_variant'] = null;
                $data['variant_option'] = null;
                $data['variant_value'] = null;
            }
            //deleting old product variant if not exist
            foreach ($old_product_variant_ids as $key => $product_variant_id) {
                if (!in_array($product_variant_id, $new_product_variant_ids))
                    ProductVariant::find($product_variant_id)->delete();
            }
            if(isset($data['is_diffPrice'])) {
                foreach ($data['diff_price'] as $key => $diff_price) {
                    if($diff_price) {
                        $lims_product_warehouse_data = Product_Warehouse::FindProductWithoutVariant($lims_product_data->id, $data['warehouse_id'][$key])->first();
                        if($lims_product_warehouse_data) {
                            $lims_product_warehouse_data->price = $diff_price;
                            $lims_product_warehouse_data->save();
                        }
                        else {
                            Product_Warehouse::firstOrCreate([
                                "product_id" => $lims_product_data->id,
                                "warehouse_id" => $data["warehouse_id"][$key],
                                "qty" => 0,
                                "price" => $diff_price
                            ]);
                        }
                    }
                }
            }
            else {
                $data['is_diffPrice'] = false;
                if(isset($data['warehouse_id'])){
                    foreach ($data['warehouse_id'] as $key => $warehouse_id) {
                        $lims_product_warehouse_data = Product_Warehouse::FindProductWithoutVariant($lims_product_data->id, $warehouse_id)->first();
                        if($lims_product_warehouse_data) {
                            $lims_product_warehouse_data->price = null;
                            $lims_product_warehouse_data->save();
                        }
                    }
                }
            }
            $lims_product_data->update($data);
            //inserting data for custom fields
            $custom_field_data = [];
            $custom_fields = CustomField::where('belongs_to', 'product')->select('name', 'type')->get();
            foreach ($custom_fields as $type => $custom_field) {
                $field_name = str_replace(' ', '_', strtolower($custom_field->name));
                if(isset($data[$field_name])) {
                    if($custom_field->type == 'checkbox' || $custom_field->type == 'multi_select')
                        $custom_field_data[$field_name] = implode(",", $data[$field_name]);
                    else
                        $custom_field_data[$field_name] = $data[$field_name];
                }
            }
            if(count($custom_field_data))
                DB::table('products')->where('id', $lims_product_data->id)->update($custom_field_data);
            $this->cacheForget('product_list');
            $this->cacheForget('product_list_with_variant');
            \Session::flash('edit_message', 'Product updated successfully');
        }
    }

    public function generateCode()
    {
        $id = Keygen::numeric(8)->generate();
        return $id;
    }

    public function search(Request $request)
    {
        $product_code = explode(" (", $request['data']);
        $lims_product_data = Product::where('code', $product_code[0])->first();

        $product[] = $lims_product_data->name;
        $product[] = $lims_product_data->code;
        $product[] = $lims_product_data->qty;
        $product[] = $lims_product_data->price;
        $product[] = $lims_product_data->id;
        return $product;
    }

    public function saleUnit($id)
    {
        $unit = Unit::where("base_unit", $id)->orWhere('id', $id)->pluck('unit_name','id');
        return json_encode($unit);
    }

    public function getData($id, $variant_id)
    {
        if($variant_id) {
            $data = Product::join('product_variants', 'products.id', 'product_variants.product_id')
                ->select('products.name', 'product_variants.item_code')
                ->where([
                    ['products.id', $id],
                    ['product_variants.variant_id', $variant_id]
                ])->first();
            $data->code = $data->item_code;
        }
        else
            $data = Product::select('name', 'code')->find($id);
        return $data;
    }

    public function productWarehouseData($id)
    {
        $warehouse = [];
        $qty = [];
        $batch = [];
        $expired_date = [];
        $imei_number = [];
        $warehouse_name = [];
        $variant_name = [];
        $variant_qty = [];
        $product_warehouse = [];
        $product_variant_warehouse = [];
        $lims_product_data = Product::select('id', 'is_variant')->find($id);
        if($lims_product_data->is_variant) {
            $lims_product_variant_warehouse_data = Product_Warehouse::where('product_id', $lims_product_data->id)->orderBy('warehouse_id')->get();
            $lims_product_warehouse_data = Product_Warehouse::select('warehouse_id', DB::raw('sum(qty) as qty'))->where('product_id', $id)->groupBy('warehouse_id')->get();
            foreach ($lims_product_variant_warehouse_data as $key => $product_variant_warehouse_data) {
                $lims_warehouse_data = Warehouse::find($product_variant_warehouse_data->warehouse_id);
                $lims_variant_data = Variant::find($product_variant_warehouse_data->variant_id);
                $warehouse_name[] = $lims_warehouse_data->name;
                $variant_name[] = $lims_variant_data->name;
                $variant_qty[] = $product_variant_warehouse_data->qty;
            }
        }
        else {
            $lims_product_warehouse_data = Product_Warehouse::where('product_id', $id)->orderBy('warehouse_id', 'asc')->get();
        }
        foreach ($lims_product_warehouse_data as $key => $product_warehouse_data) {
            $lims_warehouse_data = Warehouse::find($product_warehouse_data->warehouse_id);
            if($product_warehouse_data->product_batch_id) {
                $product_batch_data = ProductBatch::select('batch_no', 'expired_date')->find($product_warehouse_data->product_batch_id);
                $batch_no = $product_batch_data->batch_no;
                $expiredDate = date(config('date_format'), strtotime($product_batch_data->expired_date));
            }
            else {
                $batch_no = 'N/A';
                $expiredDate = 'N/A';
            }
            $warehouse[] = $lims_warehouse_data->name;
            $batch[] = $batch_no;
            $expired_date[] = $expiredDate;
            $qty[] = $product_warehouse_data->qty;
            if($product_warehouse_data->imei_number && !str_contains($product_warehouse_data->imei_number, 'null'))
                $imei_number[] = $product_warehouse_data->imei_number;
            else
                $imei_number[] = 'N/A';
        }

        $product_warehouse = [$warehouse, $qty, $batch, $expired_date, $imei_number];
        $product_variant_warehouse = [$warehouse_name, $variant_name, $variant_qty];
        return ['product_warehouse' => $product_warehouse, 'product_variant_warehouse' => $product_variant_warehouse];
    }

    public function printBarcode(Request $request)
    {
        //return $request;
        if($request->input('data')) {
            $preLoadedproducts = $this->limsProductSearch($request);
            //return $this->limsProductSearch($request);
        }
        else
            $preLoadedproducts = [];

        $lims_product_list_without_variant = collect([]);
        $lims_product_list_with_variant = collect([]);

        $barcode_settings = Barcode::select(DB::raw('CONCAT(name, ", ", COALESCE(description, "")) as name, id, is_default'))->get();
        $default = $barcode_settings->where('is_default', 1)->first();
        $barcode_settings = $barcode_settings->pluck('name', 'id');

        return view('backend.product.print_barcode', compact('barcode_settings','lims_product_list_without_variant', 'lims_product_list_with_variant', 'preLoadedproducts'));
    }

    public function productWithoutVariant()
    {
        return Product::ActiveStandard()->select('id', 'name', 'code')
                ->whereNull('is_variant')->get();
    }

    public function productWithVariant()
    {
        return Product::join('product_variants', 'products.id', 'product_variants.product_id')
                ->ActiveStandard()
                ->whereNotNull('is_variant')
                ->select('products.id', 'products.name', 'product_variants.item_code')
                ->orderBy('position')->get();
    }

    public function searchAutocomplete(Request $request)
    {
        $term = $request->input('term');
        $warehouse_id = $request->input('warehouse_id');
        $brand_id = $request->input('brand_id');
        $category_id = $request->input('category_id');
        $product_type_id = $request->input('product_type_id');
        
        // Search standard products
        $query = Product::where('products.is_active', true)
            ->where(function($q) use ($term) {
                $q->where('products.name', 'LIKE', "%$term%")
                  ->orWhere('products.code', 'LIKE', "%$term%");
            });

        if($brand_id && $brand_id != 'null') {
            $query->where('products.brand_id', $brand_id);
        }
        if($category_id && $category_id != 'null') {
            $query->where('products.category_id', $category_id);
        }
        if($product_type_id && $product_type_id != 'null') {
            $query->where('products.product_type_id', $product_type_id);
        }

        $products = $query->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->leftJoin('product_types', 'product_types.id', '=', 'products.product_type_id')
            ->select('products.id', 'products.name', 'products.code', 'products.price', 'categories.name as category_name', 'brands.title as brand_title', 'product_types.name as type_name')
            ->limit(15)
            ->get();

        $results = [];
        foreach ($products as $product) {
            // Format: code|name|category|type|price|brand
            $value = $product->code . '|' . $product->name . '|' . $product->category_name . '|' . ($product->type_name ?? 'standard') . '|' . $product->price . '|' . ($product->brand_title ?? 'N/A');
            $results[] = [
                'id' => $product->id,
                'value' => $value,
                'label' => $product->code . ' (' . $product->name . ')',
            ];
        }

        // Search variants
        $vQuery = ProductVariant::join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.is_active', true)
            ->where('product_variants.item_code', 'LIKE', "%$term%");

        if($brand_id && $brand_id != 'null') {
            $vQuery->where('products.brand_id', $brand_id);
        }
        if($category_id && $category_id != 'null') {
            $vQuery->where('products.category_id', $category_id);
        }

        $variants = $vQuery->select('products.id', 'products.name', 'product_variants.item_code', 'products.price', 'categories.name as category_name', 'brands.title as brand_title')
            ->limit(10)
            ->get();

        foreach ($variants as $variant) {
            $value = $variant->item_code . '|' . $variant->name . '|' . $variant->category_name . '|standard|' . $variant->price . '|' . ($variant->brand_title ?? 'N/A');
            $results[] = [
                'id' => $variant->id,
                'value' => $value,
                'label' => $variant->item_code . ' (' . $variant->name . ')',
            ];
        }

        return response()->json(array_values($results));
    }

    public function limsProductSearch(Request $request)
    {
        $product_code = explode("(", $request['data']);
        $product_code[0] = rtrim($product_code[0], " ");
        $lims_product_list = Product::where([
            ['code', $product_code[0] ],
            ['is_active', true]
        ])->get();

        if(count($lims_product_list) == 0) {
            $lims_product_list = Product::join('product_variants', 'products.id', 'product_variants.product_id')
                ->select('products.*', 'product_variants.item_code', 'product_variants.variant_id', 'product_variants.additional_price')
                ->where('product_variants.item_code', $product_code[0])
                ->get();
        }
        elseif($lims_product_list[0]->is_variant) {
            $lims_product_list = Product::join('product_variants', 'products.id', 'product_variants.product_id')
                ->select('products.*', 'product_variants.item_code', 'product_variants.variant_id', 'product_variants.additional_price')
                ->where('product_variants.product_id', $lims_product_list[0]->id)
                ->get();
        }
        //return $lims_product_list;
        foreach($lims_product_list as $lims_product_data) {
        if($lims_product_data->is_variant) {
            $item_code = $lims_product_data->item_code;
            $variant_id = $lims_product_data->variant_id;
            $additional_price = $lims_product_data->additional_price;
        }
        else {
            $item_code = $lims_product_data->code;
            $variant_id = '';
            $additional_price = 0;
        }

        // Use Picqer Barcode Generator
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode_image = base64_encode($generator->getBarcode($item_code, $generator::TYPE_CODE_128));

        $products[] = [
            'name' => $lims_product_data->name,
            'code' => $item_code,
            'price' => $lims_product_data->price + $additional_price,
            'barcode_image' => $barcode_image,
            'promotion_price' => $lims_product_data->promotion_price,
            'currency' => config('currency'),
            'currency_position' => config('currency_position'),
            'qty' => $lims_product_data->qty,
            'id' => $lims_product_data->id,
            'variant_id' => $variant_id,
            'cost' => $lims_product_data->cost,
        ];
    }
    return $products;
    }

    /*public function getBarcode()
    {
        return DNS1D::getBarcodePNG('72782608', 'C128');
    }*/

    public function checkBatchAvailability($product_id, $batch_no, $warehouse_id)
    {
        $product_batch_data = ProductBatch::where([
            ['product_id', $product_id],
            ['batch_no', $batch_no]
        ])->first();
        if($product_batch_data) {
            $product_warehouse_data = Product_Warehouse::select('qty')
            ->where([
                ['product_batch_id', $product_batch_data->id],
                ['warehouse_id', $warehouse_id]
            ])->first();
            if($product_warehouse_data) {
                $data['qty'] = $product_warehouse_data->qty;
                $data['product_batch_id'] = $product_batch_data->id;
                $data['expired_date'] = date(config('date_format'), strtotime($product_batch_data->expired_date));
                $data['message'] = 'ok';
            }
            else {
                $data['qty'] = 0;
                $data['message'] = 'This Batch does not exist in the selected warehouse!';
            }
        }
        else {
            $data['message'] = 'Wrong Batch Number!';
        }
        return $data;
    }

    public function importProduct(Request $request)
    {
        // Reset memory limit; shared hosting proxies (Nginx/Apache) enforce
        // their own hard timeout - we fight that with per-chunk commits below.
        @ini_set('memory_limit', '512M');
        ignore_user_abort(true);

        // Get file
        $upload = $request->file('file');
        $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
        if ($ext != 'csv') {
            return redirect()->back()->with('message', 'Please upload a valid CSV file.');
        }

        $filePath = $upload->getRealPath();
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);
        if (!$header) {
            fclose($file);
            return redirect()->back()->with('message', 'CSV file is empty or invalid.');
        }

        $escapedHeader = [];
        foreach ($header as $key => $value) {
            $lheader = strtolower(trim($value));
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            $escapedHeader[] = $escapedItem;
        }

        // Pre-fetch ALL invariant data ONCE (never inside the loop)
        $lims_unit_data = Unit::where('unit_code', 1)->first();
        if (!$lims_unit_data) {
            fclose($file);
            return redirect()->back()->with('not_permitted', 'Default Unit (code 1) does not exist in the database.');
        }

        $warehouse_ids = Warehouse::where('is_active', true)->pluck('id')->toArray();
        $addons = explode(',', config('addons'));
        $hasEcommerce = in_array('ecommerce', $addons);
        $withoutStock = config('without_stock') === 'yes';

        // In-memory cache for repeated lookups (avoid querying same brand/category/type again)
        $brandCache = [];
        $categoryCache = [];
        $productTypeCache = [];

        // ----------------------------------------------------------------
        // KEY FIX: each chunk of rows is its OWN independent transaction.
        // A single wrapping transaction held until the entire file was
        // processed caused the proxy (Nginx/Apache) to time out (503)
        // before a response was ever sent.
        // ----------------------------------------------------------------
        $chunkSize     = 25;  // rows per independent transaction
        $rowCount      = 0;   // rows processed (including skipped)
        $totalImported = 0;   // rows actually saved
        $errors        = [];  // skipped-row messages

        // Start the first chunk transaction
        DB::beginTransaction();

        try {
            while ($columns = fgetcsv($file)) {
                // Reset PHP execution timer every chunk so large files
                // do not hit PHP's own max_execution_time limit.
                if ($rowCount % $chunkSize === 0) {
                    @set_time_limit(120);
                }

                if (count($escapedHeader) !== count($columns)) {
                    // Bad row — skip it, do not abort the whole import
                    $errors[] = 'Row ' . ($rowCount + 2) . ' skipped: column count mismatch.';
                    $rowCount++;
                    continue;
                }

                $data = array_combine($escapedHeader, $columns);

                // Validate and sanitize input
                $data['name'] = htmlspecialchars(trim($data['name'] ?? ''));
                if (empty($data['name'])) {
                    $rowCount++;
                    continue; // Skip rows with empty names
                }
                $data['cost']  = (isset($data['cost'])  && is_numeric($data['cost']))  ? str_replace(',', '', $data['cost'])  : 0;
                $data['price'] = (isset($data['price']) && is_numeric($data['price'])) ? str_replace(',', '', $data['price']) : 0;

                // Handle brand (with in-memory cache)
                $brand_id  = null;
                $brandName = $data['brand'] ?? '';
                if ($brandName !== '' && $brandName !== 'N/A') {
                    if (!isset($brandCache[$brandName])) {
                        $brandCache[$brandName] = Brand::firstOrCreate(['title' => $brandName, 'is_active' => true])->id;
                    }
                    $brand_id = $brandCache[$brandName];
                }

                // Handle category (with in-memory cache)
                $categoryName = $data['category'] ?? 'General';
                if (!isset($categoryCache[$categoryName])) {
                    $categoryCache[$categoryName] = Category::firstOrCreate(['name' => $categoryName, 'is_active' => true])->id;
                }
                $category_id = $categoryCache[$categoryName];

                // Handle product type (with in-memory cache)
                $typeName = $data['type'] ?? 'standard';
                if (!isset($productTypeCache[$typeName])) {
                    $productTypeCache[$typeName] = ProductType::firstOrCreate(['name' => $typeName, 'is_active' => true])->id;
                }
                $product_type_id = $productTypeCache[$typeName];

                // Create or update product
                $product = Product::firstOrNew([
                    'name'      => $data['name'],
                    'is_active' => true,
                ]);

                $product->fill([
                    'code'              => $data['code'] ?? '',
                    'type'              => 'standard',
                    'product_type_id'   => $product_type_id,
                    'barcode_symbology' => 'C128',
                    'brand_id'          => $brand_id,
                    'category_id'       => $category_id,
                    'unit_id'           => $lims_unit_data->id,
                    'purchase_unit_id'  => $lims_unit_data->id,
                    'sale_unit_id'      => $lims_unit_data->id,
                    'cost'              => $data['cost'],
                    'price'             => $data['price'],
                    'tax_method'        => 1,
                    'qty'               => 0,
                    'product_details'   => $data['productdetails'] ?? '',
                    'is_active'         => true,
                    'image'             => $data['image'] ?? 'zummXD2dvAtI.avif',
                    'base'              => $data['base']     ?? '',
                    'addition'          => $data['addition'] ?? '',
                    'lr'                => $data['lr']       ?? '',
                ]);

                if ($hasEcommerce) {
                    $product->slug     = preg_replace('/[^A-Za-z0-9\-]/', '', Str::slug($data['name'], '-'));
                    $product->in_stock = true;
                }

                $product->save();

                // Handle variants
                if (!empty($data['variantvalue']) && !empty($data['variantname'])) {
                    $variant_option = [];
                    $variant_value  = [];
                    $variantInfo    = explode(',', $data['variantvalue']);
                    $validVariant   = true;

                    foreach ($variantInfo as $key => $info) {
                        if (!strpos($info, '[')) {
                            $validVariant = false;
                            break;
                        }
                        $variant_option[] = strtok($info, '[');
                        $variant_value[]  = str_replace('/', ',', substr($info, strpos($info, '[') + 1, (strpos($info, ']') - strpos($info, '[') - 1)));
                    }

                    if ($validVariant) {
                        $product->variant_option = json_encode($variant_option);
                        $product->variant_value  = json_encode($variant_value);
                        $product->is_variant     = true;
                        $product->save();

                        $variant_names     = explode(',', $data['variantname']);
                        $item_codes        = isset($data['itemcode'])        ? explode(',', $data['itemcode'])        : [];
                        $additional_costs  = isset($data['additionalcost'])  ? explode(',', $data['additionalcost'])  : [];
                        $additional_prices = isset($data['additionalprice']) ? explode(',', $data['additionalprice']) : [];

                        $productVariants   = [];
                        $productWarehouses = [];

                        foreach ($variant_names as $key => $variant_name) {
                            $variant = Variant::firstOrCreate(['name' => $variant_name]);

                            $productVariants[] = [
                                'product_id'       => $product->id,
                                'variant_id'       => $variant->id,
                                'position'         => $key + 1,
                                'item_code'        => $item_codes[$key] ?? $variant_name . '-' . ($data['code'] ?? ''),
                                'additional_cost'  => $additional_costs[$key]  ?? 0,
                                'additional_price' => $additional_prices[$key] ?? 0,
                                'qty'              => 0,
                            ];

                            foreach ($warehouse_ids as $warehouse_id) {
                                $productWarehouses[] = [
                                    'product_id'   => $product->id,
                                    'variant_id'   => $variant->id,
                                    'warehouse_id' => $warehouse_id,
                                    'qty'          => 0,
                                ];
                            }
                        }

                        if (!empty($productVariants)) {
                            ProductVariant::insert($productVariants);
                        }
                        if ($withoutStock && !empty($productWarehouses)) {
                            Product_Warehouse::insert($productWarehouses);
                        }
                    }
                } elseif ($withoutStock) {
                    $productWarehouses = [];
                    foreach ($warehouse_ids as $warehouse_id) {
                        $productWarehouses[] = [
                            'product_id'   => $product->id,
                            'warehouse_id' => $warehouse_id,
                            'qty'          => 0,
                        ];
                    }
                    if (!empty($productWarehouses)) {
                        Product_Warehouse::insert($productWarehouses);
                    }
                }

                $rowCount++;
                $totalImported++;

                // --------------------------------------------------------
                // Commit this chunk and immediately open a NEW transaction.
                // This releases DB locks and gives the server a heartbeat
                // so the proxy does not treat the connection as idle/dead.
                // --------------------------------------------------------
                if ($totalImported % $chunkSize === 0) {
                    DB::commit();
                    DB::beginTransaction();
                }
            }

            // Commit any rows remaining in the last (partial) chunk
            DB::commit();

        } catch (\Exception $e) {
            // Only the CURRENT chunk is rolled back; all previously committed
            // chunks are already safely saved in the database.
            DB::rollBack();
            fclose($file);
            \Log::error('Product Import Error: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            return redirect()->back()->with('message',
                'Import stopped at row ' . ($rowCount + 2) . ': ' . $e->getMessage() .
                ' (' . $totalImported . ' records were saved before the error.)');
        }

        fclose($file);
        $this->cacheForget('product_list');
        $this->cacheForget('product_list_with_variant');

        $msg = $totalImported . ' products imported successfully!';
        if (!empty($errors)) {
            $msg .= ' (' . count($errors) . ' rows skipped due to errors.)';
        }
        return redirect('admin/products')->with('import_message', $msg);
    }

    /**
     * AJAX endpoint: import a small chunk of product rows (JSON).
     * Called repeatedly by the browser with batches of ~25 rows.
     * Each request completes in a few seconds — no proxy timeout.
     */
    public function importProductChunk(Request $request)
    {
        @ini_set('memory_limit', '512M');
        @set_time_limit(120);

        $rows = $request->input('rows', []);
        if (empty($rows)) {
            return response()->json(['success' => false, 'message' => 'No rows received.']);
        }

        // Pre-fetch invariant data once per chunk
        $lims_unit_data = Unit::where('unit_code', 1)->first();
        if (!$lims_unit_data) {
            return response()->json(['success' => false, 'message' => 'Default Unit (code 1) does not exist.']);
        }

        $warehouse_ids = Warehouse::where('is_active', true)->pluck('id')->toArray();
        $addons        = explode(',', config('addons'));
        $hasEcommerce  = in_array('ecommerce', $addons);
        $withoutStock  = config('without_stock') === 'yes';

        $brandCache       = [];
        $categoryCache    = [];
        $productTypeCache = [];
        $totalImported    = 0;
        $errors           = [];

        DB::beginTransaction();
        try {
            foreach ($rows as $index => $data) {
                $data['name'] = htmlspecialchars(trim($data['name'] ?? ''));
                if (empty($data['name'])) {
                    $errors[] = 'Row skipped: empty name.';
                    continue;
                }
                $data['cost']  = (isset($data['cost'])  && is_numeric($data['cost']))  ? str_replace(',', '', $data['cost'])  : 0;
                $data['price'] = (isset($data['price']) && is_numeric($data['price'])) ? str_replace(',', '', $data['price']) : 0;

                // Brand
                $brand_id  = null;
                $brandName = $data['brand'] ?? '';
                if ($brandName !== '' && $brandName !== 'N/A') {
                    if (!isset($brandCache[$brandName])) {
                        $brandCache[$brandName] = Brand::firstOrCreate(['title' => $brandName, 'is_active' => true])->id;
                    }
                    $brand_id = $brandCache[$brandName];
                }

                // Category
                $categoryName = $data['category'] ?? 'General';
                if (!isset($categoryCache[$categoryName])) {
                    $categoryCache[$categoryName] = Category::firstOrCreate(['name' => $categoryName, 'is_active' => true])->id;
                }
                $category_id = $categoryCache[$categoryName];

                // Product type
                $typeName = $data['type'] ?? 'standard';
                if (!isset($productTypeCache[$typeName])) {
                    $productTypeCache[$typeName] = ProductType::firstOrCreate(['name' => $typeName, 'is_active' => true])->id;
                }
                $product_type_id = $productTypeCache[$typeName];

                // Create or update product
                $product = Product::firstOrNew([
                    'name'      => $data['name'],
                    'is_active' => true,
                ]);

                $product->fill([
                    'code'              => $data['code'] ?? '',
                    'type'              => 'standard',
                    'product_type_id'   => $product_type_id,
                    'barcode_symbology' => 'C128',
                    'brand_id'          => $brand_id,
                    'category_id'       => $category_id,
                    'unit_id'           => $lims_unit_data->id,
                    'purchase_unit_id'  => $lims_unit_data->id,
                    'sale_unit_id'      => $lims_unit_data->id,
                    'cost'              => $data['cost'],
                    'price'             => $data['price'],
                    'tax_method'        => 1,
                    'qty'               => 0,
                    'product_details'   => $data['productdetails'] ?? '',
                    'is_active'         => true,
                    'image'             => $data['image'] ?? 'zummXD2dvAtI.avif',
                    'base'              => $data['base']     ?? '',
                    'addition'          => $data['addition'] ?? '',
                    'lr'                => $data['lr']       ?? '',
                ]);

                if ($hasEcommerce) {
                    $product->slug     = preg_replace('/[^A-Za-z0-9\-]/', '', Str::slug($data['name'], '-'));
                    $product->in_stock = true;
                }

                $product->save();

                // Handle variants
                if (!empty($data['variantvalue']) && !empty($data['variantname'])) {
                    $variant_option = [];
                    $variant_value  = [];
                    $variantInfo    = explode(',', $data['variantvalue']);
                    $validVariant   = true;

                    foreach ($variantInfo as $key => $info) {
                        if (strpos($info, '[') === false) {
                            $validVariant = false;
                            break;
                        }
                        $variant_option[] = strtok($info, '[');
                        $variant_value[]  = str_replace('/', ',', substr($info, strpos($info, '[') + 1, (strpos($info, ']') - strpos($info, '[') - 1)));
                    }

                    if ($validVariant) {
                        $product->variant_option = json_encode($variant_option);
                        $product->variant_value  = json_encode($variant_value);
                        $product->is_variant     = true;
                        $product->save();

                        $variant_names     = explode(',', $data['variantname']);
                        $item_codes        = isset($data['itemcode'])        ? explode(',', $data['itemcode'])        : [];
                        $additional_costs  = isset($data['additionalcost'])  ? explode(',', $data['additionalcost'])  : [];
                        $additional_prices = isset($data['additionalprice']) ? explode(',', $data['additionalprice']) : [];

                        $productVariants   = [];
                        $productWarehouses = [];

                        foreach ($variant_names as $key => $variant_name) {
                            $variant = Variant::firstOrCreate(['name' => $variant_name]);

                            $productVariants[] = [
                                'product_id'       => $product->id,
                                'variant_id'       => $variant->id,
                                'position'         => $key + 1,
                                'item_code'        => $item_codes[$key] ?? $variant_name . '-' . ($data['code'] ?? ''),
                                'additional_cost'  => $additional_costs[$key]  ?? 0,
                                'additional_price' => $additional_prices[$key] ?? 0,
                                'qty'              => 0,
                            ];

                            foreach ($warehouse_ids as $warehouse_id) {
                                $productWarehouses[] = [
                                    'product_id'   => $product->id,
                                    'variant_id'   => $variant->id,
                                    'warehouse_id' => $warehouse_id,
                                    'qty'          => 0,
                                ];
                            }
                        }

                        if (!empty($productVariants)) {
                            ProductVariant::insert($productVariants);
                        }
                        if ($withoutStock && !empty($productWarehouses)) {
                            Product_Warehouse::insert($productWarehouses);
                        }
                    }
                } elseif ($withoutStock) {
                    $productWarehouses = [];
                    foreach ($warehouse_ids as $warehouse_id) {
                        $productWarehouses[] = [
                            'product_id'   => $product->id,
                            'warehouse_id' => $warehouse_id,
                            'qty'          => 0,
                        ];
                    }
                    if (!empty($productWarehouses)) {
                        Product_Warehouse::insert($productWarehouses);
                    }
                }

                $totalImported++;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product Chunk Import Error: ' . $e->getMessage() . ' | File: ' . $e->getFile() . ' | Line: ' . $e->getLine());
            return response()->json([
                'success'  => false,
                'imported' => $totalImported,
                'message'  => $e->getMessage(),
                'errors'   => $errors,
            ]);
        }

        $this->cacheForget('product_list');
        $this->cacheForget('product_list_with_variant');

        return response()->json([
            'success'  => true,
            'imported' => $totalImported,
            'errors'   => $errors,
        ]);
    }


    public function allProductInStock()
    {
        if(!in_array('ecommerce',explode(',', config('addons'))))
            return redirect()->back()->with('not_permitted', 'Please install the ecommerce addon!');
        Product::where('is_active', true)->update(['in_stock' => true]);
        return redirect()->back()->with('create_message', 'All Products set to in stock successfully!');
    }

    public function showAllProductOnline()
    {
        if(!in_array('ecommerce',explode(',', config('addons'))))
            return redirect()->back()->with('not_permitted', 'Please install the ecommerce addon!');
        Product::where('is_active', true)->update(['is_online' => true]);
        return redirect()->back()->with('create_message', 'All Products will be showed to online!');
    }

    public function deleteBySelection(Request $request)
    {
        $product_id = $request['productIdArray'];
        foreach ($product_id as $id) {
            $lims_product_data = Product::findOrFail($id);
            $lims_product_data->is_active = false;
            $lims_product_data->save();

            if($lims_product_data->image) {
                $images = explode(",", $lims_product_data->image);
                foreach ($images as $image) {
                    $this->imageService->deleteImage('images/product', $image, ['xlarge', 'large', 'medium', 'small']);
                }
            }
        }
        $this->cacheForget('product_list');
        $this->cacheForget('product_list_with_variant');
        return 'Product deleted successfully!';
    }

    public function destroy($id)
    {
        if(!env('USER_VERIFIED')) {
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        }
        else {
            $lims_product_data = Product::findOrFail($id);
            $lims_product_data->is_active = false;
            if($lims_product_data->image != 'zummXD2dvAtI.avif') {
                $images = explode(",", $lims_product_data->image);
                foreach ($images as $key => $image) {
                    $this->imageService->deleteImage('images/product', $image, ['xlarge', 'large', 'medium', 'small']);
                }
            }
            $lims_product_data->save();
            $this->cacheForget('product_list');
            $this->cacheForget('product_list_with_variant');
            return redirect('admin/products')->with('message', 'Product deleted successfully');
        }
    }
}

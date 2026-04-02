<?php

namespace App\Http\Controllers\SalePro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\Warehouse;
use App\Models\Biller;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Account;
use App\Models\User;
use App\Models\CustomerBill;
use App\Models\CustomerBillOrder;

use App\Models\CustomerBillMonthly;

use App\Models\Courier;
use DB;
use Cache;
use App\Models\GeneralSetting;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\SaleDetails;
use App\Mail\LogMessage;
use App\Mail\PaymentDetails;
use Mail;

use GeniusTS\HijriDate\Date;
use Illuminate\Support\Facades\Validator;
use App\Models\Currency;
use App\SMSProviders\TonkraSms;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;
use App\Services\BillService;


class BillController extends Controller
{
    use \App\Traits\TenantInfo;
    use \App\Traits\MailInfo;

    private $_smsModel;

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('sales-index')) {

            if($request->input('starting_date')) {
                $starting_date = $request->input('starting_date');
                $ending_date = $request->input('ending_date');
            }
            else {
                $starting_date = "";
                $ending_date = "";
            }

            $customer_id = '';
            if($request->input('customer_id')) {
                $customer_id = $request->input('customer_id');
            }

            $lims_customer_list = Customer::where('is_active', true)->get();

            $lims_warehouse_list = Warehouse::where('is_active', true)->get();

            $numberOfInvoice = Sale::count();

             return view('backend.bill.index', compact('starting_date', 'ending_date', 'numberOfInvoice','customer_id', 'lims_customer_list', 'lims_warehouse_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function billData(Request $request)
    {

        $columns = array(
            1 => 'id',
            2 => 'date',
            3 => 'reference_no',
        );

        $warehouse_id = $request->input('warehouse_id');
        $customer_id = $request->input('customer_id');
        $bill_type_id = $request->input('bill_type_id');


        if($request->input('starting_date')){

            $start = date('Y-m-d', strtotime($request->input('starting_date')));
            $end = date('Y-m-d', strtotime($request->input('starting_date')));

            $q = CustomerBill::whereDate('date', '>=' ,$start)->whereDate('date', '<=' ,$end);
        }else{
            $q = CustomerBill::select("*");
        }


        if($bill_type_id){
            if($bill_type_id == 1){
                $q = $q->where('order_tax_rate', 0);
            }else{
                $q = $q->where('order_tax_rate', $bill_type_id);
            }

        }

        $search = $request->input('search.value');

        if($search){
            $q = $q->where('customer_bills.reference_no', 'LIKE', "%{$search}%");
         }



        if($customer_id && $customer_id != 'all'){
            $q = $q->where('customer_id', $customer_id);
        }
        if($warehouse_id && $warehouse_id != 'all'){
            $q = $q->where('warehouse_id', $warehouse_id);
        }

        $totalData = $q->count();
        $totalFiltered = $totalData;


        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;


        $order = $columns[$request->input('order.0.column')];

        $dir = $request->input('order.0.dir');

        $offset = $request->input('start');

        $q = $q
        ->offset($offset)
        ->limit($limit)
        ->orderBy($order, $dir);


        // echo $start;exit;

        // print_r($q->toSql());exit;
        $bills = $q->get();

        $data = [];
        if(!empty($bills))
        {
            foreach ($bills as $key=>$bill)
            {
                $data[] = [
                    'id'    => $bill->id,
                    'reference_no'      => $bill->reference_no .'<br><div class="badge badge-info">'.strtoupper($bill->bill_type).'</div>',
                    'customer'          => $bill->customer->name .'<br>'.$bill->customer->city,
                    'total_qty'         => $bill->total_qty,
                    'total_order'       => $bill->total_order,
                    'grand_total'       => $bill->grand_total,
                    'returned_amount'   => $bill->returned_amount,
                    'paid_amount'       => $bill->paid_amount,
                    'due'               => '',
                    'date'              => date('d-m-Y', strtotime($bill->date)),
                     'options'          => '<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                        <li><a href="'.route('bill.print', ['id' => $bill->id]).'" class="btn btn-link"><i class="fa fa-copy"></i> Print Invoice</a></li>
                    </ul>
                    </div>'

                ];
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


    public function billGenerate(Request $request)
    {
        $warehouse_id = $request->input('warehouse_id');
        $customer_id = $request->input('customer_id');
        $bill_date = date('Y-m-d',  strtotime($request->input('bill_date')));
        $tax_rate = $request->input('tax_rate');

        //check if any bill date is missing in between

        // $start = date('Y-m-d', strtotime($request->input('starting_date')));
        // $end = date('Y-m-d', strtotime($request->input('ending_date')));

        // $q = CustomerBill::whereDate('date', '>=' ,$start)->whereDate('date', '<=' ,$end);

        $billService = new BillService();
        $billService->customerBillUpdate($bill_date, $customer_id);

            return response()->json([
                'code' => 'success',
                'message' => "Bill Generated",
            ]);

    }


    function printInvoice(Request $request){
        $bill_date = $request->input('bill_date');
        $tax_rate = $request->input('tax_rate');
        $warehouse_id = $request->input('warehouse');

        if(!$bill_date){
            $bill_date = date('Y-m-d');
        }

        $date = date('Y-m-d', strtotime($bill_date));

        $lims_warehouse_data = Warehouse::find(1);


        if($request->input('id')){
            $bills_data = CustomerBill::where(['id' => $request->input('id') ])->get();

            if(!empty($bills_data)){
                return view('backend.bill.a4_invoice', compact("bills_data", "lims_warehouse_data"));
            }

        }


        $where = [
            'date'  => $date
        ];

        if($warehouse_id && $warehouse_id != 'all'){
            $where['warehouse_id'] = $warehouse_id;
        }

        if(!$tax_rate){
            $where['order_tax_rate'] = 0;
            $bills_data = CustomerBill::where($where)->get();
        }else{
            $bills_data = CustomerBill::where($where)->where('order_tax_rate',">" , 0 )->get();
        }

        return view('backend.bill.a4_invoice', compact("bills_data", "lims_warehouse_data"));
     }

    function billByDate(){

        return view('backend.bill.date');
    }

    function billByDateData(Request $request){


        $columns = array(
            1 => 'date',
            2 => 'date',
            3 => 'reference_no',
        );

        $q = CustomerBill::select(DB::raw("

        SUM(total_order) AS total_order,  SUM(total_qty) AS total_qty, COUNT( CASE WHEN  order_tax_rate > 0 THEN 1 END) AS gst_bills,
         COUNT( CASE WHEN  order_tax_rate = 0 THEN 1 END) AS estimate_bills, SUM(grand_total) AS grand_total, date

        "))->groupBy('date');



        $totalData = $q->count();
        $totalFiltered = $totalData;


        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;


        $order = $columns[$request->input('order.0.column')];

        $dir = $request->input('order.0.dir');

        $offset = $request->input('start');

        $q = $q
        ->offset($offset)
        ->limit($limit)
        ->orderBy($order, $dir);


        // echo $start;exit;

        // print_r($q->toSql());exit;
        $bills = $q->get();;

        $data = [];
        if(!empty($bills))
        {
            foreach ($bills as $key=>$bill)
            {
                $data[] = [
                    'id'    => $bill->id,
                    'date'      => date('d-m-Y', strtotime($bill->date)),
                    'gst_bills'         => $bill->gst_bills,
                    'total_order'       => $bill->total_order,
                    'total_qty'       => $bill->total_qty,
                    'grand_total'       => $bill->grand_total,
                    'gst_bills'   => $bill->gst_bills,
                    'estimate_bills'       => $bill->estimate_bills,
                    'options'               => '',


                ];
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


     function customerTotalDue($id, $date){


        $returned_amount = DB::table('sales')
            ->join('returns', 'sales.id', '=', 'returns.sale_id')
            ->where([
                ['sales.customer_id', $id],
                ['sales.payment_status', '!=', 4],
                ['sales.created_at', '<=', $date]
            ])
            ->sum('returns.grand_total');

        $saleData = DB::table('sales')->where([
            ['customer_id', $id],
            ['payment_status', '!=', 4],
            ['sales.created_at', '<=', $date]
            ])
            ->selectRaw('SUM(grand_total) as grand_total,SUM(paid_amount) as paid_amount')
            ->first();

        return $saleData->grand_total - $returned_amount - $saleData->paid_amount;
     }


    function generateReferenceNo($tax_rate){
            $bill_q = CustomerBill::select('reference_no')->orderBy('id', 'desc');
            if($tax_rate > 0){
                $data = 'INV-';
                $bill_q = $bill_q->where('order_tax_rate', '<>', 0);
            }else{
                $bill_q = $bill_q->where('order_tax_rate', false);
                $data = 'EST-';
            }

            $bill_q = $bill_q->orderBy('id', 'desc')->first();

            if($bill_q){
                $reference_no = $bill_q->reference_no;
                $removedchar = substr($reference_no, 9);
                $last_number = str_pad($removedchar + 1, 5, "0", STR_PAD_LEFT);
            }else{
                $last_number  = str_pad(1000, 5, "0", STR_PAD_LEFT);
            }

            return $data .date("ym").'-'. $last_number;


    }


    public static function NumberToWords($amount){

        $numberToWords = new NumberToWords();

        $numberTransformer = $numberToWords->getNumberTransformer('en');

        return $numberTransformer->toWords($amount);

    }


    public function billMonthly(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('sales-index')) {

            if($request->input('starting_date')) {
                $starting_date = $request->input('starting_date');
                $ending_date = $request->input('ending_date');
            }
            else {
                $starting_date = "";
                $ending_date = "";
            }

            $customer_id = '';
            if($request->input('customer_id')) {
                $customer_id = $request->input('customer_id');
            }

            $lims_customer_list = Customer::where('is_active', true)->get();


            $numberOfInvoice = Sale::count();

             return view('backend.bill.monthly', compact('starting_date', 'ending_date', 'numberOfInvoice','customer_id', 'lims_customer_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function billMonthlyGenerate(Request $request){
        $billService = new BillService();
        $billService->billMonthlyGenerate($request->input('date'), $request->input('customer_id'));
        return response()->json([
            'code' => 'success',
            'message' => "Monthly Bill Generated",
        ]);

    }

    public function billMonthlyData(Request $request)
    {

        $columns = array(
            1 => 'id',
            2 => 'date',
            3 => 'reference_no',
        );

        $warehouse_id = $request->input('warehouse_id');
        $customer_id = $request->input('customer_id');
        $bill_type_id = $request->input('bill_type_id');


        if($request->input('starting_date')){

            $year = date('Y', strtotime($request->input('starting_date')));
            $month = date('m', strtotime($request->input('starting_date')));

            $q = CustomerBillMonthly::where('year', $year)->where('month', $month);
        }else{
            $q = CustomerBillMonthly::select("*");
        }

        if($customer_id && $customer_id != 'all'){
            $q = $q->where('customer_id', $customer_id);
        }

        $totalData = $q->count();
        $totalFiltered = $totalData;


        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;


        $order = $columns[$request->input('order.0.column')];

        $dir = $request->input('order.0.dir');

        $offset = $request->input('start');

        $q = $q
        ->offset($offset)
        ->limit($limit)
        ->orderBy("year", "desc")
        ->orderBy("month", "desc");
        $bills = $q->get();

        $data = [];
        if(!empty($bills))
        {
            foreach ($bills as $key=>$bill)
            {
                $date = date('M-Y', strtotime($bill->year.'-'.$bill->month.'-01' ));
                $data[] = [
                    'id'    => $bill->id,
                    'customer'          => $bill->customer->name .'<br>'.$bill->customer->city,
                    'total_qty'         => $bill->total_qty ? $bill->total_qty : "",
                    'total_bill'        => $bill->total_bill ? $bill->total_bill : "",
                    'total_order'       => $bill->total_order ? $bill->total_order : "",
                    'grand_total'       => $bill->grand_total ? $bill->grand_total : "",
                    'total_return'      => $bill->total_return ? $bill->total_return : "",
                    'total_payment'     => $bill->total_payment ? $bill->total_payment : "",
                    'open_bal'          => $bill->open_bal != 0 ? $bill->open_bal : "",
                    'bill_discount'     => $bill->bill_discount ? $bill->bill_discount : "",
                    'date'              => $date,
                    'is_locked'              => $bill->is_locked ? '<div class="badge badge-success">Yes</div>' : '<div class="badge badge-warning">No</div>',
                    'due'               => $bill->bal_amount != 0 ? $bill->bal_amount : "",
                     'options'          => '<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                        <li><a href="'.route('report.customer_print', ['customer_id' => $bill->customer_id, 'start_date' => $date]).'" class="btn btn-link"><i class="fa fa-copy"></i> Print Invoice</a></li>
                    </ul>
                    </div>'

                ];
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


}




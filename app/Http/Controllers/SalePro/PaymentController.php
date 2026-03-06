<?php

namespace App\Http\Controllers\SalePro;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\Sale;
use App\Models\Payment;
use App\Models\CustomerBillMonthly;
use App\Services\BillService;


class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('sales-index')) {

            $starting_date = date('d-m-Y');

            $customer_id = '';
            if($request->input('customer_id')) {
                $customer_id = $request->input('customer_id');
            }

            $lims_customer_list = Customer::where('is_active', true)->get();

            $numberOfInvoice = Sale::count();

            return view('backend.payment.index', compact('starting_date', 'lims_customer_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function data(Request $request)
    {
        ini_set('memory_limit', '1G');
        ini_set('display_errors', 0);
        error_reporting(0);
        try {
            $columns = array(
            1 => 'date',
            2 => 'customer_id',
            3 => 'amount',
        );

        $warehouse_id = $request->input('warehouse_id');
        $customer_id = $request->input('customer_id');
        $type_id = $request->input('type_id');

        $q = Payment::select("*")->where('is_deleted', "!=", 1)->orWhereNull('is_deleted');

        if($request->input('starting_date')){
            $start = date('Y-m-01', strtotime($request->input('starting_date')));
            $end = date('Y-m-t', strtotime($request->input('starting_date')));

            $q = $q->whereDate('date', '>=' ,$start)->whereDate('date', '<=' ,$end);
        }


        if( $type_id){
            $q = $q->where('type_id', $type_id);
        }

        if($customer_id && $customer_id != 'all'){
            $q = $q->where('customer_id', $customer_id);
        }else{
            $q = $q->whereNotNull('customer_id' );

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
        $payment = $q->get();

        $data = [];
        if(!empty($payment))
        {
            foreach ($payment as $key=> $row)
            {
                $data[] = [
                    'id'                    => $row->id,
                    'reference_no'          => $row->reference_no,
                    'customer'              => $row->customer->name .'<br>'.$row->customer->city,
                    'paying_method'         => $this->paymentMethod($row->paying_method, $row->type_id ),
                    'payment_note'          => $row->payment_note,
                    'type_id'               => $row->type_id,
                    'amount'                => $row->amount,
                    'receipt_no'            => $row->receipt_no,
                    'date'                  => date('d-m-Y', strtotime($row->date)),
                    'user'                  => $row->user->name,
                    'options'               => '<div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                        <li><a href="javascript:void(0)" data-href="'.route('payment.edit', $row->id).'" data-id="'.$row->id.'" class="btn btn-link btn-edit"><i class="fa fa-copy"></i> Edit</a></li>
                        <li><a href="javascript:void(0)" data-href="'.route('payment.delete', $row->id).'" data-id="'.$row->id.'" class="btn btn-link btn-delete"><i class="fa fa-trash"></i> Delete</a></li>
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
        return response()->json($json_data);
        } catch (\Throwable $e) {
            \Log::error('DataTables Error (Payment): ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'draw'            => intval($request->input('draw')),
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => [],
                'error'           => $e->getMessage()
            ], 500);
        }
    }


    function paymentMethod($id, $type){

        if(strtolower($type) != 'payment'){
            return '';
        }

        switch ($id) {
            case '1':
                return 'Cash';
                break;
            case '2':
                return 'Gpay';
                break;

            case '3':
                return 'Cheque';
                break;

            case '4':
                return 'Bank transfer';
                break;
            default:
                return 'Cash';
                break;
        }
    }


    public function save(Request $request)
    {

        $year = date('Y', strtotime($request->input('date')));
        $month = date('m', strtotime($request->input('date')));

        $bill_data = CustomerBillMonthly::where([
            'year' => $year, 'month' => $month,
            'customer_id' => $request->input('customer_id'), 'is_locked' => 1
        ])->first();

        if($bill_data){
            return response()->json([
                'code' => 'error',
                'message' => "Customer bill data is locked for given month",
            ]);
        }

        $billService = new BillService();

        $warehouse_id = $request->input('warehouse_id');
        $id = $request->input('id');

        $data = $request->all();

        $data['date'] = date('Y-m-d',  strtotime($request->input('date')));


        $data = [
            'payment_reference' => 'ppr-' . date("Ymd") . '-'. date("his"),
            'user_id' => Auth::id(),
            'purchase_id' => 0,
            'account_id' => 0,
            'amount' => $request->input('amount'),
            'change' => 0,
            'paying_method' => $request->input('type_id') == "Discount" ? "" : $request->input('payment_mode'),
            'date' => date('Y-m-d',  strtotime($request->input('date'))),
            "receipt_no"    =>  $request->input('type_id') == "Discount" ? "" :$request->input('receipt_no'),
            "customer_id"   =>  $request->input('customer_id'),
            "type_id"       =>  $request->input('type_id'),
            "payment_note"  =>  $request->input('payment_note')
        ];

        if($id){
            $payment = Payment::where('id', $id)->first();
            Payment::where('id', $id)->update($data);

            if($payment->customer_id != $data['customer_id']){
                $billService->billMonthlyGenerate($payment->date, $payment->customer_id);
            }else if(date('m', strtotime($payment->date)) != date('m', strtotime($data['date']))){
                $billService->billMonthlyGenerate($payment->date, $data['customer_id']);
            }

            $billService->billMonthlyGenerate($data['date'], $data['customer_id']);
            $payment->update($data);

        }else{
            Payment::create($data);

            $billService->billMonthlyGenerate($data['date'], $data['customer_id']);
        }

        return response()->json([
            'code' => 'success',
            'message' => "Payment saved",
        ]);

    }


    public function edit($id){
        $data = Payment::where('id', $id)->get();
        return response()->json(
            isset($data[0]) ? $data[0]: [],
        );
    }


    public function delete($id){
        $data = Payment::where('id', $id)->update(
            [

            "is_deleted" => true,
            'updated_by' => Auth::id(),

            ]
        );

        $billService = new BillService();
        $billService->billMonthlyGenerate($data->date, $data->customer_id);

        return response()->json(
            TRUE
        );
    }

}

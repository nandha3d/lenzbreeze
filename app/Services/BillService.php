<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\CustomerBill;
use App\Models\CustomerBillMonthly;
use App\Models\CustomerBillOrder;
use DB;
use App\Models\Customer;


class BillService
{

    public function __construct()
    {
    }

    public function initialize($data)
    {

    }


    public function customerBillUpdate($date, $customer_id){

        $date = is_object($date) ? $date->toDateString() : $date;

        $q = Sale::whereDate('created_at', '=',  $date )
                 ->select('id', 'order_no', 'customer_id', 'total_qty', 'total_discount', 'order_tax', 'order_tax_rate', 'total_price', 'grand_total', 'shipping_cost', 'warehouse_id');

        if( $customer_id  && $customer_id != 'all'){
            $q = $q->where('customer_id', $customer_id);
        }

        $sales = $q->get();

        $bills = [];
        if(!empty($sales))
        {
            $customer_no = [];
            foreach ($sales as $key => $sale){
                $id = $sale->customer_id;
                $key = $id.'-'.$sale->order_tax_rate;
                $bills[$key]  = [
                     'warehouse_id'   => isset($sale['warehouse_id']) ? $sale['warehouse_id'] : null,
                     'total_qty'      => isset($bills[$key]) ? ($bills[$key]['total_qty'] + $sale->total_qty ) : $sale->total_qty,
                     'total_discount' => isset($bills[$key]) ? ($bills[$key]['total_discount'] + $sale->total_discount) : $sale->total_discount,
                     'order_discount' => isset($bills[$key]) ? ($bills[$key]['order_discount'] + $sale->order_discount) : $sale->order_discount,
                     'order_tax'      => isset($bills[$key]) ? ($bills[$key]['order_tax'] + $sale->order_tax ) : $sale->order_tax,
                     'shipping_cost'  => isset($bills[$key]) ? ($bills[$key]['shipping_cost'] + $sale->shipping_cost ) : $sale->shipping_cost,
                     'order_tax_rate' => $sale->order_tax_rate,
                     'total_price'    => isset($bills[$key]) ? ($bills[$key]['total_price'] + $sale->total_price ) : $sale->total_price,
                     'grand_total'    => isset($bills[$key]) ? ($bills[$key]['grand_total'] + $sale->grand_total ) : $sale->grand_total,
                     'customer_id'    => $id,
                     'total_order'      => isset($bills[$key]) ? ($bills[$key]['total_order'] + 1 ) : 1,

                ];

                $customer_no[$id] = $id;
            }

            foreach ($bills as $id => $bill){
                $bill_data = CustomerBill::where(['date' => $date, 'customer_id' => $bill['customer_id'], 'order_tax_rate' => $bill['order_tax_rate']])->first();
                // $bill['total_due']   = $this->customerTotalDue($bill['customer_id'], $date);

                $customer_data = Customer::find($bill['customer_id']);
                $bill['bill_type'] = $customer_data && strlen($customer_data->tax_no) > 5 ? 'b2b' : 'b2c';

                if(!$bill_data){
                    $bill['customer_id']    = $bill['customer_id'];
                    $bill['date']           = $date;
                    $bill['reference_no']   = $this->generateReferenceNo($bill['order_tax_rate']);
                    $bill_data = CustomerBill::create($bill);

                }else{
                    $bill['reference_no'] = $bill_data->reference_no;
                    CustomerBill::where('id', $bill_data->id)->update($bill);
                    // CustomerBillOrder::where(["customer_bill_id" => $bill_data->id])->delete();
                }

                Sale::where('customer_id', $bill['customer_id'])
                        ->where('order_tax_rate', $bill['order_tax_rate'])
                        ->whereDate('created_at', $date)
                        ->update(['reference_no' => $bill['reference_no']]);



            }

            $this->customerBillCheck($date, $customer_id);
            $this->billMonthlyGenerate($date, $customer_id);

            return true;

        }

    }


    public function customerBillCheck($date, $customer_id){
        try {
            $query = "
            select distinct cb.id as id, cb.customer_id, cb.order_tax_rate, cb.date
            from customer_bills as cb
            left join sales on
                (cb.customer_id = sales.customer_id and cb.order_tax_rate = sales.order_tax_rate and date(sales.created_at) = '$date')
            where cb.date = '$date' and sales.id is null ";

            if($customer_id && $customer_id != 'all'){
                $query .= " AND cb.customer_id = $customer_id ";
            }

            $bills = DB::select($query);

            if(!empty($bills))
            {
                foreach ($bills as $key => $bill){
                $sq =  Sale::whereDate('created_at', '=',  $date )
                        ->where('customer_id', '=', $bill->customer_id)
                        ->where('order_tax_rate', '=', $bill->order_tax_rate);
                    $saleBill = $sq->count();


                    if(!$saleBill){
                        CustomerBill::where('id', $bill->id)->delete();
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('customerBillCheck error: ' . $e->getMessage());
        }
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



    //Monthly bill
    function billMonthlyGenerate($date, $customer_id)
    {
        $start = date('Y-m-01', strtotime($date));
        $end = date('Y-m-t', strtotime($date));

        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        //Start of Find pervious month balance
        $previousMonth =  date('Y-m', strtotime($date." -1 month"));
        $pYear = date('Y', strtotime($previousMonth));
        $pMonth = date('m', strtotime($previousMonth));

        $prevMonthly = CustomerBillMonthly::select("bal_amount", "customer_id")
        ->where(['year' => $pYear, 'month' => $pMonth]);
        // ->where("bal_amount", ">", 0);
        if($customer_id && $customer_id != 'all'){
            $prevMonthly = $prevMonthly->where('customer_id', $customer_id);
        }
        $prevMonthly  = $prevMonthly->get();

        $prevBal = [];

        if(!empty($prevMonthly))
        {
            foreach ($prevMonthly as $id => $pBill){
                $prevBal[$pBill->customer_id] = $pBill->bal_amount;
            }
        }
        //End of Find pervious month balance


        $query  = "select c.id, t.* from  customers c left join (
            select
            b.customer_id,
            SUM(b.total_qty) as total_qty,
            SUM(b.total_discount) as total_discount,
            SUM(b.shipping_cost) as shipping_cost,
            SUM(b.grand_total) as grand_total,
            SUM(b.total_price) as total_price,
            SUM(b.total_order) as total_order,
            COUNT(b.id) as total_bill

            from customer_bills b where b.date >= '$start' and b.date <= '$end'
             group by b.customer_id ) t   on   c.id = t.customer_id
        where c.is_active = 1 ";

        if($customer_id && $customer_id != 'all'){
           $query .= " AND c.id =  $customer_id  ";
        }
        $sales = DB::select($query);

        $bills = [];
        if(!empty($sales))
        {
            foreach ($sales as $key => $sale){
                $id = $sale->id;
                $key = $id;
                $bills[$key]  = [
                     'total_qty'      => isset($bills[$key]) ? ($bills[$key]['total_qty'] + $sale->total_qty ) : $sale->total_qty,
                     'total_discount' => isset($bills[$key]) ? ($bills[$key]['total_discount'] + $sale->total_discount) : $sale->total_discount,
                     'shipping_cost'  => isset($bills[$key]) ? ($bills[$key]['shipping_cost'] + $sale->shipping_cost ) : $sale->shipping_cost,
                     'grand_total'    => isset($bills[$key]) ? ($bills[$key]['grand_total'] + $sale->grand_total ) : $sale->grand_total,
                     'total_price'    => isset($bills[$key]) ? ($bills[$key]['total_price'] + $sale->total_price ) : $sale->total_price,
                     'customer_id'    => $id,
                     'total_order'    => isset($bills[$key]) ? ($bills[$key]['total_order'] + $sale->total_order ) : $sale->total_order,
                     'total_bill'     => isset($bills[$key]) ? ($bills[$key]['total_bill'] + $sale->total_bill ) : $sale->total_bill
                ];
             }


            foreach ($bills as $id => $bill){

                $total = $this->customerTotalPaid($bill['customer_id'], $start, $end);

                $bill_data = CustomerBillMonthly::where(['year' => $year, 'month' => $month, 'customer_id' => $bill['customer_id']])->first();

                if(isset($bill_data->is_locked) && $bill_data->is_locked ){
                    $bill['open_bal']   = $bill_data->open_bal;
                }else{
                    $bill['open_bal']   = isset($prevBal[$bill['customer_id']]) ? $prevBal[$bill['customer_id']] : 0;
                }

                $bill['bill_discount']  = isset($total->bill_discount) ? $total->bill_discount : 0 ;
                $bill['total_paid']     = isset($total->total_paid ) ? $total->total_paid : 0;
                $bill['total_return']   = isset($total->total_return ) ? $total->total_return : 0;
                $bill['total_payment']  = isset($total->total_payment) ? $total->total_payment : 0;
                $bill['total_less']  = isset($total->total_less) ? $total->total_less : 0;
                $bill['bal_amount']     = ($bill['grand_total'] + $bill['open_bal'] ) - ($bill['total_return'] + $bill['total_payment'] + $bill['bill_discount'] + $bill['total_less']);


                if((isset($bill_data->open_bal) && $bill_data->open_bal != 0)
                || $bill['open_bal']  != 0 ||  $bill['grand_total'] != 0 || $bill['total_paid'] != 0 || $bill['bal_amount'] != 0){

                    // if($bill_data ){
                    //     $bill_data->update($bill);
                    // }else{
                    //     $bill['customer_id']    = $bill['customer_id'];
                    //     $bill['year']           = $year;
                    //     $bill['month']          = $month;
                    //     CustomerBillMonthly::create($bill);
                    // }

                    CustomerBillMonthly::updateOrCreate(
                        [
                            "customer_id" => $bill['customer_id'],
                            "year"         => $year,
                            "month"        => $month,
                        ],
                        $bill
                    );

                }else{
                    CustomerBillMonthly::where([
                        'year' => $year,
                        'month' => $month,
                        'customer_id' => $bill['customer_id'],
                        'is_locked'    => NULL
                    ])->delete();
                }

            }

            return true;

        }

        return false;

    }

    function customerTotalPaid($id, $start, $end){

         $saleData = DB::table('payments')->where('customer_id', $id)
            ->whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end )
            ->selectRaw('SUM(amount) as total_paid,
                    SUM(CASE WHEN type_id = "Discount" THEN amount  ELSE 0 END) bill_discount,
                    SUM(CASE WHEN type_id = "Return" THEN amount  ELSE 0 END) total_return,
                    SUM(CASE WHEN type_id = "Payment" THEN amount  ELSE 0 END) total_payment,
                    SUM(CASE WHEN type_id = "Less" THEN amount  ELSE 0 END) total_less
                     ')
                     ->groupBy("customer_id")
            ->first();
        return $saleData;
     }

}

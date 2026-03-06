<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
        {{-- <title>{{$lims_sale_data->customer->name.'_Sale_'.$lims_sale_data->reference_no}}</title> --}}
        <style type="text/css">

        .container{
            width: 70%;
            margin: auto;
        }
         .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }
            span,td {
                font-size: 13px;
                line-height: 1.4;
            }
            @media print {
                .hidden-print {
                    display: none !important;
                }
                tr.table-header {
                    -webkit-print-color-adjust: exact;
                }
                td.td-text {

                    -webkit-print-color-adjust: exact;
                }

                .upi-rq{
                    width: 400px;
                }

                .container{
                    width: 100%;
                }
            }
            table,tr,td {font-family: sans-serif;border-collapse: collapse;}
        </style>
    </head>
    <body>
        <div class="container">

        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{url("")}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Home</a> </td>
                    <td><a href="{{url()->previous()}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
                </tr>
            </table>
            <br>
        </div>


        <?php



        foreach($data as $i => $customer){
            $customer_order = 0;
            $lims_customer_data = \App\Models\Customer::find($customer['customer_id']);

            $lims_month_data = \App\Models\CustomerBillMonthly::where("year", $year)
                ->where("month", $month)
                ->where("customer_id", $customer['customer_id'])
                ->first();

        ?>
        <table style="width: 100%;border-collapse: collapse;">

            <tr>
                <td colspan="3" style="padding:9px 0;width:40%;text-align:center">
                    <h2 style="margin:0">Lenz Breeze</h2>
                </td>


            </tr>

            <tr>
                <td  style="padding:9px 0;width:40%; font-weight:bold; text-align:center">
                    Period From {{$start}} To {{$end}}
                </td>


        </table>
        <table style="width: 100%;border-collapse: collapse; margin-top: 4px;">
            <tr>

                <td width="40%" style="padding:4px 0;width:30%;vertical-align:top">
                    <div style="padding:0; margin:0"><b>Bill To</b></div>
                    <div style="margin-top: 6px;">
                        <span>{{$lims_customer_data->name}}</span>
                    </div>

                    <div style="">
                        {{-- <span>Address:</span>&nbsp;&nbsp; --}}
                        <span>{{$lims_customer_data->address}},</span>&nbsp;
                        <span>{{$lims_customer_data->place}}</span></br>
                        <span>{{$lims_customer_data->city}}</span>&nbsp;&nbsp;
                    </div>
                    <div style="margin-bottom: 10px">
                        <span>Phone:</span>&nbsp;&nbsp;
                        <span>{{$lims_customer_data->phone_number}}</span>
                    </div>

                </td>


                <td  width="2%" style="text-align: right">
                    {{-- Area --}}
                </td>
            </tr>
        </table>


        <table  style="width: 100%;border-collapse: collapse;">
            <tr class="table-header" style="">
                <td style="border:1px solid #222;padding:1px 3px;width:10%;text-align:center">Date</td>
                <td style="border:1px solid #222;padding:1px 3px;width:25%;text-align:center">Particulars</td>
                <td style="border:1px solid #222;padding:1px 3px;width:8%;text-align:center">Debit</td>
                <td style="border:1px solid #222;padding:1px 3px;width:5%;text-align:center">Credit</td>
                <td style="border:1px solid #222;padding:1px 3px;width:6%;text-align:center">Cl. Bal</td>
            </tr>

            <?php $cl_bal = isset($lims_month_data->open_bal) ? $lims_month_data->open_bal :  0;   ?>

            <tr>
                <td style=" border-right:1px solid #222;border-left:1px solid #222;padding:6px 3px;text-align: center;"></td>
                <td style="border-right:1px solid #222;padding:1px 3px;font-size: 15px;line-height: 1.2;">
                    Opening Balance
                </td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center"></td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center"></td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($cl_bal, $general_setting->decimal, '.', ',')}}</td>
            </tr>


            @foreach($customer['data'] as $key => $bill)

            <?php
                ++$customer_order;
                if($bill['type'] == 'sale' ){
                    $cl_bal +=  (float)$bill['grand_total'];
                }else{
                    $cl_bal -=  (float)$bill['paid'];
                }
            ?>

            <tr>
                <td style=" border-right:1px solid #222;border-left:1px solid #222;padding:6px 3px;text-align: center;">{{$bill['date']}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;font-size: 15px;line-height: 1.2;">

                    @if($bill['type'] == 'sale' )
                    To Credit Sale
                    <br>
                    <span>Bill No: {{$bill['reference_no']}} </span>
                    @else
                    {{$bill['type']}}
                    @endif

                </td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($bill['grand_total'], $general_setting->decimal, '.', ',')}}</td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($bill['paid'], $general_setting->decimal, '.', ',')}}</td>
               <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($cl_bal, $general_setting->decimal, '.', ',')}}</td>
            </tr>
            @endforeach


            <tr style="height:{{400 - (($customer_order) * 20) }}px">
                <td  style="border-bottom: 1px solid #222;border-left: 1px solid #222;border-right: 1px solid #222"></td>
                <td  style="border-bottom: 1px solid #222;border-left: 1px solid #222;border-right: 1px solid #222"></td>
                <td  style="border-bottom: 1px solid #222;border-left: 1px solid #222;border-right: 1px solid #222"></td>
                <td  style="border-bottom: 1px solid #222;border-left: 1px solid #222;border-right: 1px solid #222"></td>
                <td  style="border-bottom: 1px solid #222;border-left: 1px solid #222;border-right: 1px solid #222"></td>
           </tr>

        </table>


        <table style="margin-top: 30px;width:15%; margin: 0 auto" >
            <tr>
                <td style="border-bottom: 1px solid #222">Total</td>
                <td style="border-bottom: 1px solid #222;text-align:center">{{number_format($cl_bal, $general_setting->decimal, '.', ',')}}</td>
           </tr>
        </table>



        <div class="hidden-print" style="margin-bottom: 50px"></div>
            <div style="break-after:page"></div>
        <?php } ?>

        </div>


        <script type="text/javascript">
            localStorage.clear();
            function auto_print() {
                window.print();

            }
            //setTimeout(auto_print, 1000);
        </script>
    </body>
</html>


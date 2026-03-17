<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
        {{-- <title>{{$lims_sale_data->customer->name.'_Sale_'.$lims_sale_data->reference_no}}</title> --}}
        <style type="text/css">
        html, body{
                        width: 148.5mm;
                        height: 190mm;
                        /* margin: 30mm 45mm 30mm 45mm; */
                        /* change the margins as you want them to be. */
                }
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
                    /* background-color:rgb(1, 75, 148) !important; */
                    -webkit-print-color-adjust: exact;
                }
                td.td-text {
                    /* background-color:rgb(205, 218, 235) !important; */
                    -webkit-print-color-adjust: exact;
                }

                html, body{
                        width: 190mm;
                        height: 148.5mm;
                        /* margin: 30mm 45mm 30mm 45mm; */
                        /* change the margins as you want them to be. */
                }

                .print-content{
                    /* width: 100%; */
                    /* transform: rotate(270deg) translate(-276mm, 0); */
                    transform: rotate(90deg);
                    margin-right:0;
                    padding-top:0;

                    transform-origin: 70% 50%;
                }

                @page {
                    /* size: 190mm 148.5mm; */

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
                    <td><a href="{{route('bill.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
                </tr>
            </table>
            <br>
        </div>





        <?php

        foreach($bills_data as $i => $bill){

            $lims_customer_data = \App\Models\Customer::find($bill->customer_id);

        ?>

        <div class="print-content">
        <table style="width: 100%;border-collapse: collapse;">
            <tr>
                {{-- <td style="padding:9px 0;width:40%"> --}}
                    {{-- <h1 style="margin:0">{{$lims_biller_data->company_name}}</h1> --}}
                    <div>
                        {{-- <span>Address:</span>&nbsp;&nbsp;<span>{{$lims_warehouse_data->address}}</span> --}}
                    </div>
                    <div>
                        {{-- <span>Phone:</span>&nbsp;&nbsp;<span>{{$lims_warehouse_data->phone}}</span> --}}
                    </div>
                    {{-- @if($general_setting->vat_registration_number) --}}
                    <div>
                        {{-- <span>{{trans('file.VAT Number')}}:</span>&nbsp;&nbsp;<span>{{$general_setting->vat_registration_number}}</span> --}}
                    </div>
                    {{-- @endif --}}

                {{-- </td> --}}
                <td colspan="2"  style="width:30%; text-align: middle; vertical-align: top; font-size: 14px; font-bold:bold">
                    <h3> Estimate </h3>
                </td>
                <td style="padding:5px -19px;width:20%;text-align:right;">
                    <div style="display: flex;justify-content: space-between">
                        <span>EST NO:</span> <span>{{$bill->reference_no}}</span>
                    </div>
                    <div style="display: flex;justify-content: space-between">
                        <span>DATE:</span> <span>{{date(config('date_format'), strtotime($bill->date)) }}</span>
                    </div>

                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse: collapse;">
            <tr>
                <td style="padding:4px 0;width:60%;vertical-align:top">
                    <h4 style="padding:3px 10px; margin-bottom:0">To</h4>
                    <div style="margin-top: 10px;margin-left: 10px">

                        <span>{{$lims_customer_data->name}}</span>
                    </div>
                    <div style="margin-left: 10px">
                        {{-- <span>VAT Number:</span>&nbsp;&nbsp;<span>{{$lims_customer_data->tax_no}}</span> --}}
                    </div>
                    <div style="margin-left: 10px">

                        <span>Address:</span>&nbsp;&nbsp;
                        {{-- @if($lims_sale_data->sale_type == 'online')
                        <span>{{$lims_sale_data->shipping_name}}, {{$lims_sale_data->shipping_address}}, {{$lims_sale_data->shipping_city}}, {{$lims_sale_data->shipping_country}}, {{$lims_sale_data->shipping_zip}}</span>
                        @else --}}
                        <span>{{$lims_customer_data->address}}</span>
                        {{-- @endif --}}
                    </div>
                    {{-- @if(isset($lims_customer_data->phone_number) || isset($lims_sale_data->shipping_phone)) --}}
                    <div style="margin-bottom: 10px;margin-left: 10px">
                        {{-- <span>Phone:</span>&nbsp;&nbsp;
                        @if($lims_sale_data->sale_type == 'online')
                        <span>{{$lims_sale_data->shipping_phone}}
                        @else --}}
                        <span>{{$lims_customer_data->phone_number}}</span>
                        {{-- @endif --}}
                    </div>
                    {{-- @endif --}}
                </td>
                {{-- <td style="width:60%">

                </td> --}}
            </tr>
        </table>
        <table style="width: 100%;border-collapse: collapse;">
            <tr class="table-header" style="">
                <td style="border:1px solid #222;padding:1px 3px;width:4%;text-align:center">No</td>
                <td style="border:1px solid #222;padding:1px 3px;width:20%;text-align:center">{{trans('file.Description')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:6%;text-align:center">{{trans('file.Qty')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:9%;text-align:center">{{trans('file.Unit Price')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:7%;text-align:center">Discount</td>
                <td style="border:1px solid #222;padding:1px 2px;width:13%;text-align:center;">{{trans('file.Subtotal')}}</td>
            </tr>
            <?php
                $total_product_tax = 0;
                $totalPrice = 0;

                $bill_order_data = \App\Models\CustomerBillOrder::where(["customer_bill_id" => $bill->id])->get();
             ?>

            @foreach($bill_order_data as $key => $order)
                <?php
                    $lims_sale_data = \App\Models\Sale::find($order->sale_id);
                    $lims_product_sale_data = \App\Models\Product_Sale::where(["sale_id" => $order->sale_id])->get();
                ?>

                @foreach($lims_product_sale_data as $key => $product_sale_data)
                <?php
                    $lims_product_data = \App\Models\Product::find($product_sale_data->product_id);

                    // $totalPrice += $product_sale_data->net_unit_price * $product_sale_data->qty;

                ?>
                <tr style="">
                    <td style=" border-right:1px solid #222;border-left:1px solid #222;padding:1px 3px;text-align: center;">{{$lims_sale_data->order_no}}</td>
                    <td style="border-right:1px solid #222;padding:1px 3px;font-size: 15px;line-height: 1.2;">
                        {!!$lims_product_data->name!!}
                        <br>
                        <span>Base: {{$lims_product_data->base}} </span>
                        <span style="margin-left:5px">Add: {{$product_sale_data->addition}} </span>
                        <br>
                        <span>SPH: {{$product_sale_data->sph}} </span>
                        <span style="margin-left:5px">CYL: {{$product_sale_data->cyl}} </span>
                        <span style="margin-left:5px">AXIS: {{$product_sale_data->axis}} </span>
                        <span style="margin-left:5px">{{$product_sale_data->lr}} </span>
                    </td>
                    <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{$product_sale_data->qty}}</td>
                    <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($product_sale_data->net_unit_price, $general_setting->decimal, '.', ',')}}</td>
                    <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format(($product_sale_data->discount * $product_sale_data->qty), $general_setting->decimal, '.', ',')}}</td>
                    <td style="border-right:1px solid #222;padding:1px 3px;text-align:center;font-size: 15px;">{{number_format($product_sale_data->total, $general_setting->decimal, '.', ',')}}</td>
                </tr>
                @endforeach
            @endforeach

            {{-- adding extra space --}}
            @if(($bill->total_qty * 60) < 350)
            <tr style="height:{{350 - ($bill->total_qty * 60) }}px">
                 <td style="border-right:1px solid #222; border-left:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
            </tr>
            @endif

            <tr>
                <td style="border: 1px solid #222"></td>
                <td style="border: 1px solid #222">Total</td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_qty}}</td>
                <td style="border: 1px solid #222;text-align:center">{{($bill->total_price  + $bill->total_discount)}}</td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_discount}}</td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_price}}</td>
           </tr>

            <tr>
                <td colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center; vertical-align: top;">
                    {{-- {{trans('file.Note')}}<br>{{$lims_sale_data->sale_note}} --}}
                </td>
                <td class="td-text" colspan="2" style="border:1px solid #222;padding:1px 3px;">
                    Total
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format((float)($bill->total_price ) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>

            <tr>
                 <td class="td-text" colspan="2" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Discount')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->total_discount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>
            <tr>
                {{-- @if($general_setting->currency_position == 'prefix')
                    <td class="td-text" colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top;">
                        {{trans('file.In Words')}}<br>{{$currency_code}} <span style="text-transform:capitalize;font-size: 15px;">{{str_replace("-"," ",$numberInWords)}}</span> only
                    </td>
                @else --}}
                    {{--  --}}
                    <td class="td-text" colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top;">
                        {{trans('file.In Words')}}:<br><span style="text-transform:capitalize;font-size: 15px;">
                            {{str_replace("-"," ",  App\Http\Controllers\SalePro\BillController::NumberToWords($bill->grand_total)
                        )}}</span> INR only
                    </td>
                {{-- @endif --}}
                <td class="td-text" colspan="2" style="border:1px solid #222;padding:1px 3px;">Shipping</td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">{{number_format((float)$bill->shipping_cost ,$general_setting->decimal, '.', ',')}}</td>
            </tr>
            <tr>
                <td class="td-text" colspan="2" style="border:1px solid #222;padding:1px 3px;">{{trans('file.grand total')}}</td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">{{number_format((float)$bill->grand_total ,$general_setting->decimal, '.', ',')}}</td>
            </tr>
        </table>

        <div class="hidden-print" style="margin-bottom: 50px"></div>
    </div>
            @if(count($bills_data)-1 != $i)
                <div style="break-after:page"></div>
            @endif

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


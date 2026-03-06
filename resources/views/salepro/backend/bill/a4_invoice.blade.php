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
        <table style="width: 100%;border-collapse: collapse;">
            <tr>
                <td colspan="2" style="padding:9px 0;width:40%">
                    <h2 style="margin:0">Lenz Breeze</h2>
                </td>
                <td style="width:30%; text-align: middle; vertical-align: top;">
                    <img src="{{url('logo', $general_setting->site_logo)}}" height="80" width="150">
                </td>
                <td style="padding:5px -19px;width:30%;text-align:right;">
                    <div style="display: flex;justify-content: space-between;">
                        <span>Invoice No:</span> <span>{{$bill->reference_no}}</span>
                    </div>
                    <div style="display: flex;justify-content: space-between;">
                        <span>Date:</span> <span>{{date(config('date_format'), strtotime($bill->date)) }}</span>
                    </div>
                    {{-- @if($paid_by_info)
                        <div style="display: flex;justify-content: space-between;border-bottom:1px solid #aaa">
                            <span>Paid By:</span> <span>{{$paid_by_info}}</span>
                        </div>
                    @endif --}}
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-collapse: collapse; margin-top: 4px;">
            <tr>
                <td colspan="3" style="padding:4px 0;width:30%;vertical-align:top">
                    <div>
                        <span><b>Head Office:</b></span>&nbsp;&nbsp;<span>{{$lims_warehouse_data->address}}</span>
                    </div>
                    <div>
                        <span>Phone:</span>&nbsp;&nbsp;<span>{{$lims_warehouse_data->phone}}</span>
                    </div>
                    @if($general_setting->vat_registration_number)
                    <div>
                        <span>GST:</span>&nbsp;&nbsp;<span>{{$general_setting->vat_registration_number}}</span>
                    </div>
                    @endif
                </td>
                <td colspan="3" style="padding:4px 0;width:30%;vertical-align:top">
                    <div>
                        <span><b>Branch Office:</b></span>&nbsp;&nbsp;<span>34/1735(A1, LA2), Gokul Chambers, Kannanthadath Lane, Near Chamgampuzha park, Edapally, Ernakulam-682026</span>
                    </div>
                    <div>
                        <span>Phone:</span>&nbsp;&nbsp;<span>0484-4503243, 8891218423</span>
                    </div>

                </td>
                <td  width="2%">
                </td>
                <td width="40%" style="padding:4px 0;width:30%;vertical-align:top">
                    <div style="padding:0; margin:0"><b>Bill To</b></div>
                    <div style="margin-top: 10px;">
                        <span>{{$lims_customer_data->name}}</span>
                    </div>
                    <div style="">
                        <span>GST:</span>&nbsp;&nbsp;<span>{{$lims_customer_data->tax_no}}</span>
                    </div>
                    <div style="">
                        <span>Address:</span>&nbsp;&nbsp;
                        <span>{{$lims_customer_data->address}}</span>
                    </div>
                    <div style="margin-bottom: 10px">
                        <span>Phone:</span>&nbsp;&nbsp;
                        <span>{{$lims_customer_data->phone_number}}</span>
                    </div>

                </td>
            </tr>
        </table>
        <table dir="" style="width: 100%;border-collapse: collapse;">
            <tr class="table-header" style="">
                <td style="border:1px solid #222;padding:1px 3px;width:10%;text-align:center">Order No</td>
                <td style="border:1px solid #222;padding:1px 3px;width:25%;text-align:center">{{trans('file.Description')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:8%;text-align:center">HSN</td>
                <td style="border:1px solid #222;padding:1px 3px;width:5%;text-align:center">{{trans('file.Qty')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:6%;text-align:center">Rate</td>
                <td style="border:1px solid #222;padding:1px 3px;width:6%;text-align:center">Discount</td>
                {{-- <td style="border:1px solid #222;padding:1px 3px;width:8%;text-align:center">Amount</td> --}}
                <td style="border:1px solid #222;padding:1px 2px;width:11%;text-align:center;">{{trans('file.Subtotal')}}</td>
            </tr>
            <?php
            $total_product_tax = 0;
            $totalPrice = 0;

            $bill_order_data = \App\Models\Sale::where(["customer_id" => $bill->customer_id, "order_tax_rate" => $bill->order_tax_rate])
                        ->whereDate("created_at",  $bill->date)->get();
            ?>

            @foreach($bill_order_data as $key => $order)
                <?php
                    $lims_sale_data = $order;
                    $lims_product_sale_data = \App\Models\Product_Sale::where(["sale_id" => $order->id])->get();
                ?>

            @foreach($lims_product_sale_data as $key => $product_sale_data)
            <?php
                $lims_product_data = \App\Models\Product::find($product_sale_data->product_id);
                if($product_sale_data->sale_unit_id) {
                    $unit = \App\Models\Unit::select('unit_code')->find($product_sale_data->sale_unit_id);
                    $unit_code = $unit->unit_code;
                }
                else
                    $unit_code = '';

                if($product_sale_data->variant_id) {
                    $variant = \App\Models\Variant::select('name')->find($product_sale_data->variant_id);
                    $variant_name = $variant->name;
                }
                else
                    $variant_name = '';
                $totalPrice += $product_sale_data->net_unit_price * $product_sale_data->qty;
            ?>
            <tr>
                <td style="border-right:1px solid #222;border-left:1px solid #222;padding:1px 3px;text-align: center;">{{$lims_sale_data->order_no}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;font-size: 15px;line-height: 1.2;">
                    {!!$lims_product_data->name!!}
                    <br>
                    {{-- <span>Base: {{$lims_product_data->base}} </span> --}}
                    <span >Add: {{$product_sale_data->addition}} </span>
                    <br>
                    <span>SPH: {{$product_sale_data->sph}} </span>
                    <span style="margin-left:5px">CYL: {{$product_sale_data->cyl}} </span>
                    <span style="margin-left:5px">AXIS: {{$product_sale_data->axis}} </span>
                    <span style="margin-left:5px">{{$product_sale_data->lr}} </span>

                </td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">9001</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{$product_sale_data->qty}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($product_sale_data->net_unit_price, $general_setting->decimal, '.', ',')}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($product_sale_data->discount, $general_setting->decimal, '.', ',')}}</td>
                {{-- <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format(($product_sale_data->net_unit_price - $product_sale_data->discount), $general_setting->decimal, '.', ',')}}</td> --}}
                <td style="border-right:1px solid #222;border-right:1px solid #222;padding:1px 3px;text-align:center;font-size: 15px;">{{number_format($product_sale_data->total, $general_setting->decimal, '.', ',')}}</td>
            </tr>
            @endforeach
            @endforeach
            {{-- adding extra space --}}
            @if(($bill->total_qty * 70) < 300)
            <tr style="height:{{300 - (($bill->total_qty) * 70) }}px">
                 <td style="border-right:1px solid #222; border-left:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
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
                <td style="border: 1px solid #222"></td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_qty}}</td>
                <td style="border: 1px solid #222;text-align:center">{{($bill->total_price  + $bill->total_discount)}}</td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_discount}}</td>
                <td style="border: 1px solid #222;text-align:center">{{$bill->total_price}}</td>
           </tr>

            <tr>
                <td colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center; vertical-align: top;">
                    {{trans('file.Note')}}<br>{{$bill->sale_note}}
                </td>

                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Tax')}} (5%)
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->total_tax+$bill->order_tax) ,$general_setting->decimal, '.', ',')}}
                </td>

                {{-- <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Discount')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->total_discount) ,$general_setting->decimal, '.', ',')}}
                </td> --}}
            </tr>



            {{-- <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Total Before Tax')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format($bill->total_price ,$general_setting->decimal, '.', ',')}}
                </td>
            <tr> --}}

            </tr>
            {{-- @if($general_setting->invoice_format == 'gst' && $general_setting->state == 1)
                <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                        IGST
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format((float)($lims_sale_data->total_tax+$lims_sale_data->order_tax) ,$general_setting->decimal, '.', ',')}}
                    </td>
                </tr>
            @elseif($general_setting->invoice_format == 'gst' && $general_setting->state == 2)
                <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                        SGST
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format( ($lims_sale_data->total_tax+$lims_sale_data->order_tax) / 2 , $general_setting->decimal, '.', ',')}}
                    </td>
                </tr>
                <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                        CGST
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format( ($lims_sale_data->total_tax+$lims_sale_data->order_tax) / 2 , $general_setting->decimal, '.', ',')}}
                    </td>
                </tr>
            @else --}}
                {{-- <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                        {{trans('file.Tax')}} (5%)
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format((float)($bill->total_tax+$bill->order_tax) ,$general_setting->decimal, '.', ',')}}
                    </td>
                </tr> --}}
            {{-- @endif --}}

            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                   Special Discount
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->order_discount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>

            <tr>
                @if($general_setting->currency_position == 'prefix')
                <td class="td-text" colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top;">
                    {{trans('file.In Words')}}<br>INR <span style="text-transform:capitalize;font-size: 15px;">{{str_replace("-"," ", App\Http\Controllers\BillController::NumberToWords($bill->grand_total))}}</span> only
                </td>
                @else
                    <td class="td-text" colspan="3" rowspan="2" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top;">
                        {{trans('file.In Words')}}:<br><span style="text-transform:capitalize;font-size: 15px;">{{str_replace("-"," ", App\Http\Controllers\BillController::NumberToWords($bill->grand_total))}}</span> INR only
                    </td>
                @endif

                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                   Shipping Charge
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->shipping_cost) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>

            <tr>


                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">{{trans('file.grand total')}}</td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">{{number_format((float)$bill->grand_total ,$general_setting->decimal, '.', ',')}}</td>
            </tr>
            {{-- <tr>

            </tr> --}}
            {{-- <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Paid')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)$bill->paid_amount ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>
            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Due')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($bill->grand_total - $bill->paid_amount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>
            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Total Due')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format($bill->total_due ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr> --}}
            <tr>
                <td colspan="2" style="border:1px solid #222">
                    <table>
                        <tr>
                            <td width=40%>Bank Details</td>
                            <td>: Lenz Breeze</td>
                        </tr>
                        <tr>
                            <td>Bank & Branch</td>
                            <td>: STATE BANK OF INDIA, KANNUMAMOODU </td>
                        </tr>
                        <tr>
                            <td>Account No</td>
                            <td>: 42522406574</td>
                        </tr>
                        <tr>
                            <td>IFS Code</td>
                            <td>: SBIN0070287</td>
                        </tr>
                    </table>
                </td>
                <td colspan="3"  style="border:1px solid #222">
                    <table>
                        <tr>
                            <td style="text-align: left;width:30"><h4>Scan for UPI Payment</h4></td>
                            <td style="width: 60%; margin-left:10%; padding:10px" >
                                <?php
                                    $upiText = "upi://pay?pa=9633625630@ptsbi&pn=Lens Breeze&cu=INR&am=".$bill->total_due."&invoiceNo=".$bill->reference_no;
                                    echo '<img class="upi-rq" style="width:100%" src="data:image/png;base64,' . DNS2D::getBarcodePNG($upiText, 'QRCODE') . '" alt="barcode"   />';?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" style="border:1px solid #222">
                    <table>
                        <tbody style="height:90px;display: flex; flex-direction:column; justify-content:space-between">
                        <tr>
                            <td>
                                For Lenz Breeze
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Authorised Signatory
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </td>
            <tr>





            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;margin-top:-9px;">
            <tr>
                <td style="width: 100%; text-align: center">
                    <br>
                    <?php echo '<img style="max-width:100%" src="data:image/png;base64,' . DNS1D::getBarcodePNG($bill->reference_no, 'C128') . '" alt="barcode"   />';?>
                </td>
            </tr>
        </table>

        <div class="hidden-print" style="margin-bottom: 50px"></div>
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


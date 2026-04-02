<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
        <title>{{$lims_sale_data->customer->name.'_Sale_'.$lims_sale_data->reference_no}}</title>
        <style type="text/css">
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
                @page { margin: 0; }
                body { margin: 1.6cm; }
                .hidden-print {
                    display: none !important;
                }
                tr.table-header {
                    -webkit-print-color-adjust: exact;
                }
                td.td-text {
                    -webkit-print-color-adjust: exact;
                }

                .container{
                    width: 100%;
                }
            }
            table,tr,td {font-family: sans-serif;border-collapse: collapse;}
        </style>
    </head>
    <body>
        @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
        @else
            @php $url = url()->previous(); @endphp
        @endif
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{route('sales.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
                </tr>
            </table>
            <br>
        </div>
        <table style="width: 100%;border-collapse: collapse;">
            <tr>
                <td colspan="2" style="padding:9px 0;width:40%">
                    <h2 style="margin:0">{{$lims_biller_data->company_name}}</h2>

                    <?php
                        foreach($sale_custom_fields as $key => $fieldName) {
                            $field_name = str_replace(" ", "_", strtolower($fieldName));
                            echo '<div><span>'.$fieldName.': ' . $lims_sale_data->$field_name.'</span></div>';
                        }
                        foreach($customer_custom_fields as $key => $fieldName) {
                            $field_name = str_replace(" ", "_", strtolower($fieldName));
                            echo '<div><span>'.$fieldName.': ' . $lims_customer_data->$field_name.'</span></div>';
                        }
                    ?>
                </td>
                <td style="width:30%; text-align: middle; vertical-align: top;">
                    <img src="{{url('logo', $general_setting->site_logo)}}" style="max-height:80px; width:auto;">
                </td>
                <td style="padding:5px -19px;width:30%;text-align:right;">
                    <div style="display: flex;justify-content: space-between;">
                        <span>Invoice No:</span> <span>{{$lims_sale_data->reference_no}}</span>
                    </div>
                    <div style="display: flex;justify-content: space-between;">
                        <span>Date:</span> <span>{{date(config('date_format'), strtotime($lims_sale_data->created_at)) }}</span>
                    </div>
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
                        @if($lims_sale_data->sale_type == 'online')
                        <span>{{$lims_sale_data->shipping_name}}, {{$lims_sale_data->shipping_address}}, {{$lims_sale_data->shipping_city}}, {{$lims_sale_data->shipping_country}}, {{$lims_sale_data->shipping_zip}}</span>
                        @else
                        <span>{{$lims_customer_data->address}}</span>
                        @endif
                    </div>
                    @if(isset($lims_customer_data->phone_number) || isset($lims_sale_data->shipping_phone))
                    <div style="margin-bottom: 10px">
                        <span>Phone:</span>&nbsp;&nbsp;
                        @if($lims_sale_data->sale_type == 'online')
                        <span>{{$lims_sale_data->shipping_phone}}
                        @else
                        <span>{{$lims_customer_data->phone_number}}</span>
                        @endif
                    </div>
                    @endif

                    <!-- Display Info Extras -->
                    @foreach($order_extras as $extra)
                        @if($extra->type == 'info')
                        <div style="margin-bottom: 5px">
                            <span><b>{{$extra->name}}:</b></span>&nbsp;&nbsp;
                            <span>{{$extra->value}}</span>
                        </div>
                        @endif
                    @endforeach

                </td>
            </tr>
        </table>
        @php
            // Extract customer order no from order_extras for display in the new column
            $customer_order_no = '';
            if(isset($order_extras)) {
                foreach($order_extras as $extra) {
                    if($extra->type == 'info') {
                        $customer_order_no = $extra->value;
                    }
                }
            }
        @endphp
        <table dir="@if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl){{'rtl'}}@endif" style="width: 100%;border-collapse: collapse;">
            <tr class="table-header" style="">
                <td style="border:1px solid #222;padding:1px 3px;width:13%;text-align:center">Order No</td>
                <td style="border:1px solid #222;padding:1px 3px;width:13%;text-align:center">Customer Order No.</td>
                <td style="border:1px solid #222;padding:1px 3px;width:30%;text-align:center">{{trans('file.Description')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:10%;text-align:center">HSN</td>
                <td style="border:1px solid #222;padding:1px 3px;width:6%;text-align:center">{{trans('file.Qty')}}</td>
                <td style="border:1px solid #222;padding:1px 3px;width:8%;text-align:center">Rate</td>
                <td style="border:1px solid #222;padding:1px 3px;width:8%;text-align:center">Discount</td>
                <td style="border:1px solid #222;padding:1px 2px;width:12%;text-align:center;">{{trans('file.Subtotal')}}</td>
            </tr>
            <?php
                $total_product_tax = 0;
                $totalPrice = 0;
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
                <td style="border-right:1px solid #222;padding:1px 3px;text-align: center;">{{$customer_order_no}}</td>
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
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">9001</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{$product_sale_data->qty}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($product_sale_data->net_unit_price, $general_setting->decimal, '.', ',')}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($product_sale_data->discount, $general_setting->decimal, '.', ',')}}</td>
                <td style="border-right:1px solid #222;padding:1px 3px;text-align:center;font-size: 15px;">{{number_format($product_sale_data->total, $general_setting->decimal, '.', ',')}}</td>
            </tr>
            @endforeach
            {{-- adding extra space --}}
            @if((count($lims_product_sale_data) * 70) < 350)
            <tr style="height:{{350 - (count($lims_product_sale_data) * 70) }}px">
                 <td style="border-right:1px solid #222; border-left:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
                 <td style="border-right:1px solid #222"></td>
            </tr>
            @endif

            @php
                $feeExtrasCount = isset($order_extras) ? $order_extras->where('type', 'fee')->count() : 0;
            @endphp
            <tr>
                <td colspan="4" rowspan="{{ 6 + $feeExtrasCount }}" style="border:1px solid #222;padding:1px 3px;text-align: center; vertical-align: top; width: 66%;">
                    {{trans('file.Note')}}<br>{{$lims_sale_data->sale_note}}
                </td>

                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px; width: 22%;">
                    {{trans('file.Discount')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px; width: 12%;">
                    {{number_format((float)($lims_sale_data->order_discount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>



            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                    {{trans('file.Total Before Tax')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format($lims_sale_data->total_price ,$general_setting->decimal, '.', ',')}}
                </td>
            <tr>

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
                <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                        {{trans('file.Tax')}} (5%)
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format((float)($lims_sale_data->total_tax+$lims_sale_data->order_tax) ,$general_setting->decimal, '.', ',')}}
                    </td>
                </tr>
            {{-- @endif --}}

            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                   Special Discount
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($lims_sale_data->order_discount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>

            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                   Shipping Charge
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                    {{number_format((float)($lims_sale_data->shipping_cost) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>

            <!-- Display Fee Extras -->
            @foreach($order_extras as $extra)
                @if($extra->type == 'fee')
                <tr>
                    <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">
                       {{$extra->name}}
                    </td>
                    <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">
                        {{number_format((float)($extra->value) ,$general_setting->decimal, '.', ',')}}
                    </td>
                </tr>
                @endif
            @endforeach

            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px;">{{trans('file.grand total')}}</td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px;">{{number_format((float)$lims_sale_data->grand_total ,$general_setting->decimal, '.', ',')}}</td>
            </tr>
            <tr>
                @if($general_setting->currency_position == 'prefix')
                    <td class="td-text" colspan="4" rowspan="3" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top; width: 66%;">
                        {{trans('file.In Words')}}<br>{{$currency_code}} <span style="text-transform:capitalize;font-size: 15px;">{{str_replace("-"," ",$numberInWords)}}</span> only
                    </td>
                @else
                    <td class="td-text" colspan="4" rowspan="3" style="border:1px solid #222;padding:1px 3px;text-align: center;vertical-align: bottom;font-size: 15px; vertical-align: top; width: 66%;">
                        {{trans('file.In Words')}}:<br><span style="text-transform:capitalize;font-size: 15px;">{{str_replace("-"," ",$numberInWords)}}</span> {{$currency_code}} only
                    </td>
                @endif
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px; width: 22%;"></td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px; width: 12%;"></td>
            </tr>
            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px; width: 22%;">
                    {{trans('file.Paid')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px; width: 12%;">
                    {{number_format((float)$lims_sale_data->paid_amount ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>
            <tr>
                <td class="td-text" colspan="3" style="border:1px solid #222;padding:1px 3px; width: 22%;">
                    {{trans('file.Due')}}
                </td>
                <td class="td-text" style="border:1px solid #222;padding:1px 3px;text-align: center;font-size: 15px; width: 12%;">
                    {{number_format((float)($lims_sale_data->grand_total - $lims_sale_data->paid_amount) ,$general_setting->decimal, '.', ',')}}
                </td>
            </tr>
            {{-- Removed historical balance row to avoid confusion --}}
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
                                    $upiText = "upi://pay?pa=9633625630@ptsbi&pn=Lens Breeze&cu=INR&am=".$totalDue."&invoiceNo=".$lims_sale_data->reference_no;
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
                                For {{$lims_biller_data->company_name}}
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
                    <?php 
                        $barcodeData = $lims_sale_data->reference_no ? $lims_sale_data->reference_no : $lims_sale_data->order_no;
                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($barcodeData, 'C128', 2, 40) . '" alt="barcode"   />';
                    ?>
                </td>
            </tr>
        </table>
        <script type="text/javascript">
            localStorage.clear();
            function auto_print() {
                window.print();

            }
            //setTimeout(auto_print, 1000);
        </script>
    </body>
</html>


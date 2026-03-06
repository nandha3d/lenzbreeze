<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        body{
            width: 320px;
         }
        .company_name{
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: inherit;
            max-width: 335px;

        }
        * {
            font-size: 17px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
            font-weight: bold
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
        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }
        tr {border-bottom: 1px dotted #ddd;}
        td,th {padding: 7px 0;}

        table {width: 100%;}
        tfoot tr th:first-child {text-align: left;}

        .centered {
            text-align: center;
            align-content: center;
        }
        small{font-size:11px;}

        @media print {
            body{
                margin: 0;
            }
            body *{
                visibility: hidden;
            }
            * {
                font-size:12px;
                line-height: 20px;
            }
            td,th {padding: 0px 0;}
            .hidden-print {
                display: none !important;
            }
            @page {
                size: 100mm auto;
                margin: 0mm 3mm;
            }
            /* @page:first { margin-top: 0.5cm; } */
            /*tbody::after {
                content: ''; display: block;
                page-break-after: always;
                page-break-inside: avoid;
                page-break-before: avoid;
            }*/

            #receipt-data, #receipt-data * {
                visibility: visible;
                /* width: 72mm; */
                margin: 0 auto;
                font-size: 12px
            }
            #receipt-data {
                /* position : absolute; */
                left: 0;
                top: 0;

                /* position: static; */
                /* page-break-after: always; */
            }
        }
    </style>
  </head>
<body>

<div >

    <div class="hidden-print">
        <table>
            <tr>
                <td><a href="{{route('sales.index')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>

    <div id="receipt-data" style="">

                <?php $total_product_tax = 0;?>
                @foreach($lims_product_sale_data as $key => $product_sale_data)
                <?php
                    $lims_product_data = \App\Models\Product::find($product_sale_data->product_id);
                    if($product_sale_data->variant_id) {
                        $variant_data = \App\Models\Variant::find($product_sale_data->variant_id);
                        $product_name = $lims_product_data->name.' ['.$variant_data->name.']';
                    }
                    elseif($product_sale_data->product_batch_id) {
                        $product_batch_data = \App\Models\ProductBatch::select('batch_no')->find($product_sale_data->product_batch_id);
                        $product_name = $lims_product_data->name.' ['.trans("file.Batch No").':'.$product_batch_data->batch_no.']';
                    }
                    else
                        $product_name = $lims_product_data->name;

                    if($product_sale_data->imei_number && !str_contains($product_sale_data->imei_number, "null") ) {
                        $product_name .= '<br>'.trans('IMEI or Serial Numbers').': '.$product_sale_data->imei_number;
                    }

                    $product_type = \App\Models\ProductType::find($lims_product_data->product_type_id);

                ?>
                <table class="table-data" style="margin-top: 15px">
                <tbody>
                <tr>
                    <td colspan="3" >
                        <div class="company_name">
                        {{$lims_customer_data->name}} ({{$lims_customer_data->place}})
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Ord No. {{$lims_sale_data->order_no}}
                    </td>
                    <td >
                        Dt. {{date($general_setting->date_format, strtotime($lims_sale_data->created_at->toDateString()))}}
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <span>SPH: {{$product_sale_data->sph}} </span>
                        <span style="margin: 0px 10px">CYL: {{$product_sale_data->cyl}} </span>
                        <span>AXIS: {{$product_sale_data->axis}}</span>
                        <span style="margin-left:5px">{{$product_sale_data->lr}} </span>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <span> TYPE: {{$product_type->name}}</span>
                        {{-- <span style="margin:0px 10px"> BASE: {{$product_sale_data->base}} </span> --}}
                        <span style="margin-left:5px"> ADD: {{$product_sale_data->addition}}  </span>
                    </td>
                </tr>

                </tbody>
            </table>

                @if(count($lims_product_sale_data)-1 != $key)
                    <br>
                @endif

                @endforeach

            <!-- <tfoot> -->







    </div>
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


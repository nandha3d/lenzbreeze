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
                    <td><a href="{{route('report.customer_group')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{trans('file.Back')}}</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{trans('file.Print')}}</button></td>
                </tr>
            </table>
            <br>
        </div>

        <table style="width: 100%;border-collapse: collapse;margin-bottom: 20px">

            <tr>
                <td colspan="3" style="padding:9px 0;width:40%;text-align:center">
                    <h2 style="margin:0">Lenz Breeze</h2>
                </td>
            </tr>

            <tr>
                <td  style="padding:9px 0;width:40%; font-weight:bold; text-align:center; font-size:16px">
                    Period From {{$start}} To {{$end}}
                </td>
            </tr>

            <tr>
                <td  style="padding:9px 0;width:40%; font-weight:bold; text-align:left; font-size:16px">
                    Group : {{$customer_group_name ? $customer_group_name : 'All'}}
                </td>
            </tr>

        </table>

        <table  style="width: 100%;border-collapse: collapse;">
            <tr class="table-header" style="">
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:10px 3px;width:5%;text-align:center">Sl No</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:10px 3px;width:5%;text-align:center">Cust ID</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:25%;text-align:left">Client Name</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:8%;text-align:right">Pre Bal</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;width:5%;text-align:right">Debit</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;width:6%;text-align:right">Credit</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:6%;text-align:right">Cl. Bal</td>
            </tr>

            <?php
                $preBal = 0;
                $debit = 0;
                $credit = 0;
                $clBal = 0;
            ?>

            @foreach($data as $key => $c)

            <?php
                $preBal += (float)$c['pre_bal'];
                $debit += (float)$c['grand_total'];
                $credit += (float)$c['credit'];
                $clBal += (float)$c['cl_bal']
            ?>
            <tr>
                <td style="border:none;padding:1px 3px;text-align:center">
                    {{$key + 1}}
                </td>
                 <td style="border:none;padding:1px 3px;text-align:center; ">
                    {{$c['customer_id']}}
                </td>
                <td style="border:none;padding:1px 3px;font-size: 15px;line-height: 1.2;">
                  {{$c['customer']}}
                  </td>
               <td style="border:none;padding:1px 3px;text-align:right">{{number_format($c['pre_bal'] ,$general_setting->decimal, '.', ',')}}</td>
               <td style="border:none;padding:1px 3px;text-align:right">{{number_format($c['grand_total'] ,$general_setting->decimal, '.', ',')}}</td>
               <td style="border:none;padding:1px 3px;text-align:right">{{number_format($c['credit'] ,$general_setting->decimal, '.', ',')}}</td>
               <td style="border:none;padding:1px 3px;text-align:right">{{number_format($c['cl_bal'] ,$general_setting->decimal, '.', ',')}}</td>
               {{-- <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($c['credit'], $general_setting->decimal, '.', ',')}}</td> --}}
               {{-- <td style="border-right:1px solid #222;padding:1px 3px;text-align:center">{{number_format($c['cl_bal'], $general_setting->decimal, '.', ',')}}</td> --}}

            </tr>



            @endforeach


            <tr style="padding-top:15px">
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:10px 3px;width:5%;text-align:center"></td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:10px 3px;width:5%;text-align:center"></td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:25%;text-align:left">Total</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:8%;text-align:right">{{number_format($preBal ,$general_setting->decimal, '.', ',')}}</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;width:5%;text-align:right">{{number_format($debit ,$general_setting->decimal, '.', ',')}}</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;width:6%;text-align:right">{{number_format($credit ,$general_setting->decimal, '.', ',')}}</td>
                <td style="border-top:1px dashed #222;border-bottom:1px dashed #222;padding:1px 3px;width:6%;text-align:right">{{number_format($clBal ,$general_setting->decimal, '.', ',')}}</td>
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

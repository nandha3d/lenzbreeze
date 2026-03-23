
@extends('backend.layout.main')
@section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif


<style>

[data-toggle="collapse"] .fa:before {
  content: "\f139";
}

[data-toggle="collapse"].collapsed .fa:before {
  content: "\f13a";
}
</style>

<section>
    <div class="container-fluid">

        <div class="card mt-3">
            <h3 class="mt-3 text-center collapsed" style="cursor: pointer"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Generate Monthly Bills
                    <i class="fa"></i>
            </h3>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="row mt-2 text-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>{{trans('file.Date')}}</strong></label>
                                <input type="text" class="date form-control" name="bill_date" value="{{$starting_date}}" required id="bill_date" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group">
                                <label><strong>Customer</strong></label>
                                <select name="bill_customer_id" id="bill_customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer..." style="width: 100px">
                                    <option value="all">All</option>
                                    @foreach($lims_customer_list as $customer)
                                        @php
                                        $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                        $points[$customer->id] = $customer->points;
                                        @endphp
                                        <option value="{{$customer->id}}">{{$customer->name . ' (' .$customer->place .'-'. $customer->city . ')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><strong>&nbsp;</strong></label>
                                <div>
                                <button class="btn btn-primary" id="bill_gen_btn" type="button">Generate Bills</button>
                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- <div class="row mt-2">
                        <div class="col-md-12 mt-3 d-flex justify-content-center">
                            <div class="form-group">
                                <button class="btn btn-primary print-btn" data-rate-type="12" type="button">Print GST Bills</button>
                                <button class="btn btn-primary print-btn" data-rate-type="0" type="button">Print Estimate Bills</button>

                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <h3 class="mt-3 text-center">Filter Bills</h3>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-3">

                        <div class="form-group">
                            <label><strong>{{trans('file.Date')}}</strong></label>

                            <input type="text" id="starting_date" class="date form-control" name="starting_date" value="{{$starting_date}}"  autocomplete="off"/>

                            {{-- <input type="text" class="daterangepicker-field form-control" value="{{$starting_date}} To {{$ending_date}}" required /> --}}
                            {{-- <input type="hidden" name="starting_date" value="{{$starting_date}}" /> --}}
                            <input type="hidden" name="ending_date" value="{{$ending_date}}" />
                        </div>
                    </div>


                    <div class="col-md-3 ">
                        <div class="form-group">
                            <label><strong>Customer</strong></label>

                            <select name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer..." style="width: 100px">
                                <option value="all">All</option>
                                @foreach($lims_customer_list as $customer)
                                    @php
                                    $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                    $points[$customer->id] = $customer->points;
                                    @endphp
                                    <option value="{{$customer->id}}">{{$customer->name . ' (' .$customer->place .'-'. $customer->city . ')'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="col-md-3 ">
                        <div class="form-group">
                            <label><strong>Bill Type</strong></label>

                            <select name="bill_type_id" id="bill_type_id" class="selectpicker form-control" data-live-search="true" title="Select Bill Type..." style="width: 100px">
                                <option value=""></option>
                                <option value="12">GST</option>
                                <option value="1">Estimate</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-md-3">
                        <div class="form-group">
                            <label><strong>&nbsp;</strong></label>
                            <div>
                                <button class="btn btn-primary" id="filter-btn" type="button">{{trans('file.submit')}}</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="sale-table" class="table sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>Opening Bal</th>
                    <th>Total Bill</th>
                    <th>Total Bill Amount</th>
                    <th>{{trans('file.Returned Amount')}}</th>
                    <th>Bill Discount</th>
                    <th>Payment</th>
                    <th>{{trans('file.Due')}}</th>
                    <th>Locked</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>

            <tfoot class="tfoot active">
                <th></th>
                <th></th>
                <th>{{trans('file.Total')}}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tfoot>
        </table>
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">

    $('.date').datepicker({
        format: "M-yyyy",
        startView: "year",
        minViewMode: "months",
        autoclose: true,
        minDate:  "+1M",
        startDate: new Date(01,05,2025),
    });

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-list-menu").addClass("active");

    var sale_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;
    var ending_date = <?php echo json_encode($ending_date); ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#bill_gen_btn").on("click", function(){
        var bill_date = $("#bill_date").val();
        if(!bill_date){
            alert("Please select date!!!");
            return;
        }
        $("#loader").show();
        $.ajax({
            url: "{{ route('bill.monthly.generate') }}",
            data: {'date': bill_date, 'customer_id': $('#bill_customer_id').val() },
            dataType: 'json',
            context: this,
        }).done(function(data) {
            $("#loader").hide();
            alert(data.message)
        });
    });

    $(".print-btn").on("click", function(){
        var rate_type = $(this).data('rate-type');
        var bill_date = $("#bill_date").val();

        location.href = "{{route('bill.print')}}?bill_date="+bill_date+"&tax_rate="+rate_type;

    });


    $("#filter-btn").on('click', function (e) {
        $("#loader").show();
        oTable.api().draw();
    });

    var columns = [{"data": "id"}, {"data": "date"}, {"data": "customer"},{"data": "open_bal"}, {"data": "total_bill"}, {"data": "grand_total"}, {"data": "total_return"}, {"data": "bill_discount"}, {"data": "total_payment"},{"data": "due"},{"data": "is_locked"}, {"data": "options"}];

    var oTable = $('#sale-table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url:"{{ route('bill.monthly.data') }}",
            data:function(d) {
                d.starting_date = $("#starting_date").val();
                d.ending_date = ending_date;
                d.customer_id = $("#customer_id").val();
                d.bill_type_id = $("#bill_type_id").val();
            },
            dataType: "json",
            type:"POST"
        },
        /*rowId: function(data) {
              return 'row_'+data['id'];
        },*/
        "createdRow": function( row, data, dataIndex ) {
            $(row).addClass('sale-link');
            $(row).attr('data-sale', data['sale']);
        },
        "columns": columns,
        'language': {

            'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
             "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
            "search":  '{{trans("file.Search")}}',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        order:[['1', 'desc']],
        // 'columnDefs': [
        //     {
        //         "orderable": false,
        //         'targets': [0, 3, 4, 5, 6, 7, 10, 11, 12]
        //     },
        //     {
        //         'render': function(data, type, row, meta){
        //             if(type === 'display'){
        //                 data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
        //             }

        //            return data;
        //         },
        //         'checkboxes': {
        //            'selectRow': true,
        //            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
        //         },
        //         'targets': [0]
        //     }
        // ],
        // 'select': { style: 'multi',  selector: 'td:first-child'},
        // 'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // dom: '<"row"lfB>rtip',
        // rowId: 'ObjectID',
        buttons: [
            {
                extend: 'pdf',
                text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'excel',
                text: '<i title="export to excel" class="dripicons-document-new"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: function(e, dt, button, config) {
                    datatable_sum(dt, true);
                    $.fn.dataTable.ext.buttons.print.action.call(this, e, dt, button, config);
                    datatable_sum(dt, false);
                },
                footer:true
            }
        ],
        //     {
        //         text: '<i title="delete" class="dripicons-cross"></i>',
        //         className: 'buttons-delete',
        //         action: function ( e, dt, node, config ) {
        //             if(user_verified == '1') {
        //                 sale_id.length = 0;
        //                 $(':checkbox:checked').each(function(i){
        //                     if(i){
        //                         var sale = $(this).closest('tr').data('sale');
        //                         if(sale)
        //                             sale_id[i-1] = sale[13];
        //                     }
        //                 });
        //                 if(sale_id.length && confirm("Are you sure want to delete?")) {
        //                     $.ajax({
        //                         type:'POST',
        //                         url:'sales/deletebyselection',
        //                         data:{
        //                             saleIdArray: sale_id
        //                         },
        //                         success:function(data){
        //                             alert(data);
        //                             //dt.rows({ page: 'current', selected: true }).deselect();
        //                             dt.rows({ page: 'current', selected: true }).remove().draw(false);
        //                         }
        //                     });
        //                 }
        //                 else if(!sale_id.length)
        //                     alert('Nothing is selected!');
        //             }
        //             else
        //                 alert('This feature is disable for demo!');
        //         }
        //     },
        //     {
        //         extend: 'colvis',
        //         text: '<i title="column visibility" class="fa fa-eye"></i>',
        //         columns: ':gt(0)'
        //     },
        // ],
        drawCallback: function () {
            var api = this.api();
            $("#loader").hide();

            // datatable_sum(api, false);
        },
        // "serverData": function (sSource, aoData, fnCallback, oSettings) {
        //     aoData.push({"name": "test", "value": "test"});

        //     if (oSettings.jqXHR != null) {
        //         oSettings.jqXHR.abort();
        //     }
        //     oSettings.jqXHR = $.ajax({
        //         "dataType": 'json',
        //         "type": "GET",
        //         "url": sSource,
        //         "data": aoData,
        //         "success": fnCallback,
        //         "complete": function (json) {
        //         }
        //     });
        // }


    } );

    function datatable_sum(dt_selector, is_calling_first) {
        if (dt_selector.rows( '.selected' ).any() && is_calling_first) {
            var rows = dt_selector.rows( '.selected' ).indexes();

            $( dt_selector.column( 8 ).footer() ).html(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 9 ).footer() ).html(dt_selector.cells( rows, 9, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 10 ).footer() ).html(dt_selector.cells( rows, 10, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 11 ).footer() ).html(dt_selector.cells( rows, 11, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
        }
        else {
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.cells( rows, 8, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 9 ).footer() ).html(dt_selector.cells( rows, 9, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 10 ).footer() ).html(dt_selector.cells( rows, 10, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
            $( dt_selector.column( 11 ).footer() ).html(dt_selector.cells( rows, 11, { page: 'current' } ).data().sum().toFixed({{$general_setting->decimal}}));
        }
    }



</script>
// <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
@endpush

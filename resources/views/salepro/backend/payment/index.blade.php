@extends('backend.layout.main')
@section('content')
@if(session()->has('message'))
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message') !!}</div>
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif

<style>
    .form-horizontal > [class*="col-"]{
        margin-bottom: 20px
    }
</style>

<section>
    <div class="container-fluid">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#add-payment" class="btn btn-info add-sale-btn"><i class="dripicons-plus"></i> Add Payment</a>&nbsp;

        <div class="card mt-3">
            <h3 class="mt-3 text-center">Filter Payments</h3>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md-3">

                        <div class="form-group">
                            <label><strong>{{trans('file.Date')}}</strong></label>
                            <input type="text" id="starting_date" class="date form-control" name="starting_date" value=""  autocomplete="off"/>
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

                    <div class="col-md-3 ">
                        <div class="form-group">
                            <label><strong>Type</strong></label>

                            <select name="type_id" id="type_id" class="selectpicker form-control" data-live-search="true" title="Select Bill Type..." style="width: 100px">
                                <option value="">All</option>
                                <option value="Payment">Payment</option>
                                <option value="Return">Return</option>
                                <option value="Discount">Discount</option>
                                <option value="Less">Less</option>
                            </select>
                        </div>
                    </div>

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
        <table id="payment-table" class="table sale-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.date')}}</th>
                    <th>{{trans('file.customer')}}</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Payment Method</th>
                    <th>Receipt No</th>
                    <th>Note</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
            </thead>

            <tfoot class="tfoot active">
                <th></th>
                <th>{{trans('file.Total')}}</th>
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



<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="max-width: 500px; margin: 30% auto;">
        <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Do you want delete this record ?</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="delete">Yes</button>
          <button type="button" class="btn btn-default" id="no">No</button>
        </div>
      </div>
    </div>
  </div>

<div id="add-payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Add Payment</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
                    <form class="form-horizontal form-payment"  action="javascript:void(o)">
                            <input type="hidden"  class="id" name="id" value=""  autocomplete="off"/>

                            <div class="col-md-12">
                                <label class="control-label">Customer  *</label>

                                <select name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer..." style="width: 100%">
                                    @foreach($lims_customer_list as $customer)
                                        @php
                                        $deposit[$customer->id] = $customer->deposit - $customer->expense;
                                        $points[$customer->id] = $customer->points;
                                        @endphp
                                        <option value="{{$customer->id}}">{{$customer->name . ' (' .$customer->place .'-'. $customer->city . ')'}}</option>
                                    @endforeach
                                </select>
                            </div>


                        <div class="col-md-12">
                            <label>Date *</label>
                            <input type="text"  class="date-add form-control" name="date" value="{{$starting_date}}"  autocomplete="off"/>
                        </div>

                        <div class="col-md-12">
                            <label>Type  *</label>
                            <select name="type_id" id="type_id" class="selectpicker form-control" data-live-search="true" title="Select type..." style="width: 100px">
                                <option value="Payment" selected>Payment</option>
                                <option value="Return">Return</option>
                                <option value="Discount">Discount</option>
                                <option value="Less">Less</option>

                            </select>
                        </div>

                        {{-- <div class="col-md-12 discount_type_col">
                            <label>Discount Type  *</label>

                            <div class="input-group-prepend">
                                <select  name="discount_type" class="form-control discount_type update_discount"  width="20px" style="width:10px !important;padding: 6px;">
                                    <option value="Percentage">%</option>
                                    <option value="Flat">F</option>
                                </select>
                                <input style="width:60px" type=" text" class="form-control discount_value update_discount" name="discount_value" value=""/>
                            </div>

                        </div> --}}





                        <div class="col-md-12">
                            <label>Amount *</label>
                            <input type="text" id="amount" name="amount" class="form-control"  step="any" required autocomplete="off">
                        </div>

                        <div class="col-md-12 receipt_no_col">
                            <label>Receipt No</label>
                            <input type="text" id="receipt_no" name="receipt_no" class="form-control"  autocomplete="off">
                        </div>


                        <div class="col-md-12 payment_mode_col">
                            <label>Payment Mode</label>
                                 <select  name="payment_mode" class="form-control payment_mode"  width="20px" style="width:10px !important;padding: 6px;">
                                    <option value="1">Cash</option>
                                    <option value="2">Gpay</option>
                                    <option value="3">Cheque</option>
                                    <option value="4">Bank transfer</option>
                                </select>
                        </div>

                    <div class="col-md-12">
                        <label>Note</label>
                        <textarea rows="3" class="form-control" name="payment_note" id="payment_note"></textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="save-payment">Save</button>
                    </div>
                </form>
         </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #payment-data-menu").addClass("active");

    var sale_id = [];
    var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.date').datepicker({
        format: "M-yyyy",
        startView: "year",
        minViewMode: "months",
        autoclose: true,
        startDate: new Date("01-04-2025")
    });

    $('.date-add').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",

        startDate: new Date("01-04-2025")
    });

    $('#add-payment').on('hidden.bs.modal', function (e) {
        $(".form-payment")[0].reset();
        console.log($(e.relatedTarget)); // You will get the element you want! Cheers
        console.log($(e.target)); // You will get the element you want! Cheers
        $modal = $(e.target);
        $modal.find('.modal-title').html('Add Payment');
        $modal.find('.id').val('');
        $modal.find('input').val('');
        $modal.find('select').val('');

        $('.selectpicker').selectpicker('refresh');

    });

    $("#payment-table").on('click', ".btn-edit", function(e){
        $target = $(e.target);
        var id = $target.data('id');
        var url = $target.data('href');
        $("#loader").show();

        $.ajax({
            url: url,
            type: "GET",
            data: $(this).serialize(),
            success:function(data) {
                $("#loader").hide();

                $form = $(".form-payment");
                $modal = $('#add-payment');

                var date  = new Date(data.date);

                $form.find(".id").val(data.id);
                $form.find("#customer_id").val(data.customer_id);
                $form.find(".date-add").datepicker("setDate", date);

                //.val(date).datepicker("update");                ;
                $form.find("#type_id").val(data.type_id);
                $form.find("#amount").val(data.amount);
                $form.find(".payment_mode").val(data.paying_method);
                $form.find("#receipt_no").val(data.receipt_no);
                $form.find("#payment_note").val(data.payment_note);


                $modal.find('.modal-title').html('Update Payment');
                $modal.modal('show');

                $('.selectpicker').selectpicker('refresh');

            }
        })

    });

    $(".form-payment").on("submit", function(){
        let data = $(this).serializeArray();
        $("#loader").show();

        $.ajax({
            url: '{{route('payment.save')}}',
            type: "POST",
            data: $(this).serialize(),
            success:function(data) {

                if(data.code = "success"){
                    $("#loader").hide();
                    $('#add-payment').modal('hide');
                    oTable.api().draw();
                }else{
                    alert(data.message);
                }

            }
        })
    });


    $('#confirm-modal').off().on('show.bs.modal', function (e) {
        var $target = $(e.target);
        var $relatedTarget = $(e.relatedTarget);

        var id = $relatedTarget.data('id');
        var url = $target.data('href');

        $target.off('click', '#delete');
        $target.on('click', '#delete', function () {
            $target.modal('hide');

            $("#loader").show();

            $.ajax({
                url: url,
                type: "GET",
                data: $(this).serialize(),
                success:function(data) {
                    oTable.api().draw();
                }
            })

        });

        $target.off('click', '#no');
        $target.on('click', '#no', function () {
            $target.modal('hide');
        });

    })


    $("#payment-table").on('click', ".btn-delete", function(e){
        var $target = $(e.target);
        var href = $target.data('href');
        $("#confirm-modal").data('href', href);
        $("#confirm-modal").modal('show');
    });

    $("#type_id").on("change", function(){
        if($(this).val() == 'Discount' || $(this).val() == 'Return'){
            $(".discount_type_col").show();
            $('.payment_mode_col').hide();
            $('.receipt_no_col').hide();

        }else{
            $(".discount_type_col").hide();
            $('.payment_mode_col').show();
            $('.receipt_no_col').show();
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
            url: "bill/bill-generate",
            data: {'bill_date': bill_date},
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

    var columns = [{"data": "id"}, {"data": "date"},{"data": "customer"},{"data": "amount"}, {"data": "type_id"}, {"data": "paying_method"},{"data": "receipt_no"}, {"data": "payment_note"}, {"data": "options"}];

    var oTable = $('#payment-table').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
            url:"payment/data",
            data:function(d) {
                d.starting_date = $("#starting_date").val();
                d.customer_id = $("#customer_id").val();
                d.type_id = $("#type_id").val();
            },
            dataType: "json",
            type:"POST"
        },

        @include('salepro.backend.report._export_helper')

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
                action: newexportaction,
                footer:true
            },
            {
                extend: 'excel',
                text: '<i title="export to excel" class="dripicons-document-new"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: newexportaction,
                footer:true
            },
            {
                extend: 'csv',
                text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: newexportaction,
                footer:true
            },
            {
                extend: 'print',
                text: '<i title="print" class="fa fa-print"></i>',
                exportOptions: {
                    columns: ':visible:not(.not-exported)',
                    rows: ':visible'
                },
                action: newexportaction,
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
        }
        else {
            $( dt_selector.column( 8 ).footer() ).html(dt_selector.column( 8, {page:'current'} ).data().sum().toFixed({{$general_setting->decimal}}));
        }
    }



</script>

@endpush

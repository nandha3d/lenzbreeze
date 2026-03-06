@extends('backend.layout.main') @section('content')
@push('css')
<style>
    @media print {
        .hidden-print {
            display: none !important;
        }
    }

    .amt{
        padding-top: 20px !important;
    }

    .order-list input[type="text"]{
        padding: 5px 6px;
    }
</style>
@endpush
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div>
@endif
@if(session()->has('error'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('error') }}</div>
@endif
<section id="pos-layout" class="forms hidden-print">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Create Order</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        {!! Form::open(['route' => 'sales.store', 'method' => 'post', 'files' => true, 'class' => 'payment-form']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Date')}}</label>
                                            <div><b>{{$date}}</b></div>
                                            {{-- <input type="text" name="created_at" class="form-control date" placeholder="Choose date" value="" autocomplete="off" readonly=true/> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                {{trans('file.Reference No')}}
                                            </label>
                                            <input type="text" name="reference_no" class="form-control" />
                                        </div>
                                        @if($errors->has('reference_no'))
                                       <span>
                                           <strong>{{ $errors->first('reference_no') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.customer')}} *</label>
                                            <div class="input-group pos">
                                                <?php
                                                  $deposit = [];
                                                  $points = [];
                                                  $customer_active = DB::connection('salepro')->table('permissions')
                                                  ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                                  ->where([
                                                    ['permissions.name', 'customers-add'],
                                                    ['role_id', \Auth::user()->role_id] ])->first();
                                                ?>
                                                @if($customer_active)
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer..." style="width: 100px">
                                                @foreach($lims_customer_list as $customer)
                                                    @php
                                                      $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                                      $points[$customer->id] = $customer->points;
                                                    @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' .$customer->place .'-'. $customer->city . ')'}}</option>
                                                @endforeach
                                                </select>
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#addCustomer"><i class="dripicons-plus"></i></button>
                                                @else
                                                <select required name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true" title="Select customer...">
                                                @foreach($lims_customer_list as $customer)
                                                    @php
                                                      $deposit[$customer->id] = $customer->deposit - $customer->expense;

                                                      $points[$customer->id] = $customer->points;
                                                    @endphp
                                                    <option value="{{$customer->id}}">{{$customer->name . ' (' .$customer->place .'-'. $customer->city . ')'}}</option>
                                                @endforeach
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset(auth()->user()->warehouse_id))
                                    <input type="hidden" name="warehouse_id" id="warehouse_id" value="{{auth()->user()->warehouse_id}}" />
                                    @else
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Warehouse')}} *</label>
                                            <select required name="warehouse_id" id="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                                                <option value="all">All</option>
                                                @foreach($lims_warehouse_list as $warehouse)
                                                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if(isset(auth()->user()->biller_id))
                                    <input type="hidden" name="biller_id" id="biller_id" value="{{auth()->user()->biller_id}}" />
                                    @else
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Biller')}} *</label>
                                            <select required id="biller_id" name="biller_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Biller...">
                                                @foreach($lims_biller_list as $biller)
                                                <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->company_name . ')'}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand *</label>
                                            <select required name="brand_id" id="brand_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Brand...">
                                                @foreach($brand_list as $brand)
                                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category *</label>
                                            <select required name="category_id" id="category_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Category...">
                                                @foreach($category_list as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Type *</label>
                                            <select required name="product_type_id" id="product_type_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Product Type...">
                                                @foreach($product_type_list as $type)
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12  d-none product-loading ">
                                        <div class="alert alert-info" role="alert">
                                            Product list is loading.... Please wait...
                                          </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>{{trans('file.Select Product')}}</label>
                                        <div class="search-box input-group">
                                            <button type="button" class="btn btn-secondary btn-lg"><i class="fa fa-barcode"></i></button>
                                            <input type="text" name="product_code_name" id="lims_productcodeSearch" placeholder="Please type product code and select..." class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5>{{trans('file.Order Table')}} *</h5>
                                        <div class="table-responsive mt-3">
                                            <table id="myTable" class="table table-hover order-list">
                                                <thead>
                                                    <tr>
                                                        <th>{{trans('file.name')}}</th>
                                                        <th style="width:5%">{{trans('file.Code')}}</th>
                                                        <th style="width:8%">SPH</th>
                                                        <th style="width:8%">CYL</th>
                                                        <th style="width:8%">AXIS</th>
                                                        <th style="width:8%">ADD</th>
                                                        <th style="width:8%">L/R</th>
                                                        <th style="width:5%">{{trans('file.Quantity')}}</th>
                                                        <th style="width:8%">{{trans('file.Net Unit Price')}}</th>
                                                        <th style="width:10%">Discount Type</th>
                                                        <th style="width:5%">{{trans('file.Discount')}}</th>
                                                        <th style="width:5%">{{trans('file.Subtotal')}}</th>
                                                        <th style="width:5%"><i class="dripicons-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot class="tfoot active">
                                                    <th colspan="2">{{trans('file.Total')}}</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="total-qty">0</th>
                                                    <th id="total-rate">{{number_format(0, $general_setting->decimal, '.', '')}}</th>
                                                    <th></th>
                                                    <th id="total-discount">{{number_format(0, $general_setting->decimal, '.', '')}}</th>
                                                    {{-- <th id="total-tax">{{number_format(0, $general_setting->decimal, '.', '')}}</th> --}}
                                                    <th id="total">{{number_format(0, $general_setting->decimal, '.', '')}}</th>
                                                    <th><i class="dripicons-trash"></i></th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_qty" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_discount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="total_price" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="item" />
                                            <input type="hidden" name="order_tax" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="hidden" name="grand_total" />
                                            <input type="hidden" name="used_points" />
                                            <input type="hidden" name="pos" value="0" />
                                            <input type="hidden" name="coupon_active" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Order Tax')}}</label>
                                            <select class="form-control" name="order_tax_rate">
                                                <option value="0">No Tax</option>
                                                @foreach($lims_tax_list as $tax)
                                                <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Order Discount Type')}}</label>
                                            <select id="order-discount-type" name="order_discount_type" class="form-control">
                                              <option value="Flat">{{trans('file.Flat')}}</option>
                                              <option value="Percentage">{{trans('file.Percentage')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Value')}}</label>
                                            <input type="text" name="order_discount_value" class="form-control numkey" id="order-discount-val">
                                            <input type="hidden" name="order_discount" class="form-control" id="order-discount">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                {{trans('file.Shipping Cost')}}
                                            </label>
                                            <input type="number" name="shipping_cost" class="form-control" step="any"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Attach Document')}}</label> <i class="dripicons-question" data-toggle="tooltip" title="Only jpg, jpeg, png, gif, pdf, csv, docx, xlsx and txt file is supported"></i>
                                            <input type="file" name="document" class="form-control" />
                                            @if($errors->has('extension'))
                                                <span>
                                                   <strong>{{ $errors->first('extension') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @foreach($custom_fields as $field)
                                        @if(!$field->is_admin || \Auth::user()->role_id == 1)
                                            <div class="{{'col-md-'.$field->grid_value}}">
                                                <div class="form-group">
                                                    <label>{{$field->name}}</label>
                                                    @if($field->type == 'text')
                                                        <input type="text" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif>
                                                    @elseif($field->type == 'number')
                                                        <input type="number" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif>
                                                    @elseif($field->type == 'textarea')
                                                        <textarea rows="5" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control" @if($field->is_required){{'required'}}@endif></textarea>
                                                    @elseif($field->type == 'checkbox')
                                                        <br>
                                                        <?php $option_values = explode(",", $field->option_value); ?>
                                                        @foreach($option_values as $value)
                                                            <label>
                                                                <input type="checkbox" name="{{str_replace(' ', '_', strtolower($field->name))}}[]" value="{{$value}}" @if($value == $field->default_value){{'checked'}}@endif @if($field->is_required){{'required'}}@endif> {{$value}}
                                                            </label>
                                                            &nbsp;
                                                        @endforeach
                                                    @elseif($field->type == 'radio_button')
                                                        <br>
                                                        <?php $option_values = explode(",", $field->option_value); ?>
                                                        @foreach($option_values as $value)
                                                            <label class="radio-inline">
                                                                <input type="radio" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$value}}" @if($value == $field->default_value){{'checked'}}@endif @if($field->is_required){{'required'}}@endif> {{$value}}
                                                            </label>
                                                            &nbsp;
                                                        @endforeach
                                                    @elseif($field->type == 'select')
                                                        <?php $option_values = explode(",", $field->option_value); ?>
                                                        <select class="form-control" name="{{str_replace(' ', '_', strtolower($field->name))}}" @if($field->is_required){{'required'}}@endif>
                                                            @foreach($option_values as $value)
                                                                <option value="{{$value}}" @if($value == $field->default_value){{'selected'}}@endif>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($field->type == 'multi_select')
                                                        <?php $option_values = explode(",", $field->option_value); ?>
                                                        <select class="form-control" name="{{str_replace(' ', '_', strtolower($field->name))}}[]" @if($field->is_required){{'required'}}@endif multiple>
                                                            @foreach($option_values as $value)
                                                                <option value="{{$value}}" @if($value == $field->default_value){{'selected'}}@endif>{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($field->type == 'date_picker')
                                                        <input type="text" name="{{str_replace(' ', '_', strtolower($field->name))}}" value="{{$field->default_value}}" class="form-control date" @if($field->is_required){{'required'}}@endif>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Status')}} *</label>
                                            <select name="sale_status" class="form-control">
                                                <option value="2">{{trans('file.Pending')}}</option>
                                                <option value="1">{{trans('file.Completed')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('file.Payment Status')}} *</label>
                                            <select name="payment_status" class="form-control">
                                                <option value="1">{{trans('file.Pending')}}</option>
                                                <option value="2">{{trans('file.Due')}}</option>
                                                <option value="3">{{trans('file.Partial')}}</option>
                                                <option value="4">{{trans('file.Paid')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Paid By')}}</label>
                                                <select name="paid_by_id[]" class="form-control">
                                                    @if(in_array("cash",$options))
                                                    <option value="1">Cash</option>
                                                    @endif
                                                    @if(in_array("gift_card",$options))
                                                    <option value="2">Gift Card</option>
                                                    @endif
                                                    @if(in_array("card",$options))
                                                    <option value="3">Credit Card</option>
                                                    @endif
                                                    @if(in_array("cheque",$options))
                                                    <option value="4">Cheque</option>
                                                    @endif
                                                    @if(in_array("deposit",$options))
                                                    <option value="6">Deposit</option>
                                                    @endif
                                                    @if($lims_reward_point_setting_data && $lims_reward_point_setting_data->is_active)
                                                    <option value="7">Points</option>
                                                    @endif
                                                    @if(in_array("pesapal",$options))
                                                    <option value="8">Pesapal</option>
                                                    @endif
                                                    @foreach($options as $option)
                                                        @if($option !== 'cash' && $option !== 'card' && $option !== 'card' && $option !== 'cheque' && $option !== 'gift_card' && $option !== 'deposit' && $option !== 'paypal' && $option !== 'pesapal')
                                                            <option value="{{$option}}">{{$option}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Recieved Amount')}} *</label>
                                                <input type="number" name="paying_amount[]" class="form-control" id="paying-amount" step="any" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Paying Amount')}} *</label>
                                                <input type="number" name="paid_amount[]" class="form-control" id="paid-amount" step="any"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Payment Receiver')}}</label>
                                                <input type="text" name="payment_receiver" class="form-control" id="payment-receiver"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>{{trans('file.Change')}}</label>
                                                <p id="change" class="ml-2">{{number_format(0, $general_setting->decimal, '.', '')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="card-element" class="form-control">
                                                </div>
                                                <div class="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="gift-card">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{trans('file.Gift Card')}} *</label>
                                                <select id="gift_card_id" name="gift_card_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Gift Card..."></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="cheque">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{trans('file.Cheque Number')}} *</label>
                                                <input type="text" name="cheque_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>{{trans('file.Payment Note')}}</label>
                                            <textarea rows="3" class="form-control" name="payment_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Sale Note')}}</label>
                                            <textarea rows="5" class="form-control" name="sale_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('file.Staff Note')}}</label>
                                            <textarea rows="5" class="form-control" name="staff_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{-- <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary" id="submit-button"> --}}
                                    <button id="submit-button" type="button" class="btn btn-primary">{{trans('file.submit')}}</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-condensed totals">
            <td><strong>{{trans('file.Items')}}</strong>
                <span class="pull-right" id="item">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Total')}}</strong>
                <span class="pull-right" id="subtotal">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Order Tax')}}</strong>
                <span class="pull-right" id="order_tax">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Order Discount')}}</strong>
                <span class="pull-right" id="order_discount">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.Shipping Cost')}}</strong>
                <span class="pull-right" id="shipping_cost">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
            <td><strong>{{trans('file.grand total')}}</strong>
                <span class="pull-right" id="grand_total">{{number_format(0, $general_setting->decimal, '.', '')}}</span>
            </td>
        </table>
    </div>

    <div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_header" class="modal-title"></h5>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row modal-element">
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Quantity')}}</label>
                                <input type="number" step="any" name="edit_qty" class="form-control numkey">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Unit Discount')}}</label>
                                <input type="number" name="edit_discount" class="form-control numkey">
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Price Option')}}</strong> </label>
                                    <div class="input-group">
                                      <select class="form-control selectpicker" name="price_option" class="price-option">
                                      </select>
                                  </div>
                                </div>
                            </div> --}}
                            <div class="col-md-4 form-group">
                                <label>{{trans('file.Unit Price')}}</label>
                                <input type="number" name="edit_unit_price" class="form-control numkey" step="any">
                            </div>
                            <?php
                                $tax_name_all[] = 'No Tax';
                                $tax_rate_all[] = 0;
                                foreach($lims_tax_list as $tax) {
                                    $tax_name_all[] = $tax->name;
                                    $tax_rate_all[] = $tax->rate;
                                }
                            ?>

                            {{-- <input type="hidden" name="edit_tax_rate" value="0"> --}}
                            {{-- <div class="col-md-4 form-group">
                                <label>{{trans('file.Tax Rate')}}</label>
                                <select name="edit_tax_rate" class="form-control selectpicker">
                                    @foreach($tax_name_all as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div id="edit_unit" class="col-md-4 form-group">
                                <label>{{trans('file.Product Unit')}}</label>
                                <select name="edit_unit" class="form-control selectpicker">
                                </select>
                            </div>
                            {{-- <div class="col-md-4 form-group">
                                <label>{{trans('file.Cost')}}</label>
                                <p id="product-cost"></p>
                            </div> --}}
                        </div>
                        <button type="button" name="update_btn" class="btn btn-primary">{{trans('file.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- add customer modal -->
    <div id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'customer.store', 'method' => 'post', 'files' => true, 'id' => 'customer-form']) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Customer')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="form-group">
                    <label>{{trans('file.Customer Group')}} *</strong> </label>
                    <select required class="form-control selectpicker" name="customer_group_id">
                        @foreach($lims_customer_group_all as $customer_group)
                            <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('file.name')}} *</strong> </label>
                    <input type="text" name="customer_name" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Email')}}</label>
                    <input type="text" name="email" placeholder="example@example.com" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Phone Number')}} *</label>
                    <input type="text" name="phone_number" required class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.Address')}}</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('file.City')}}</label>
                    <input type="text" name="city" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="pos" value="1">
                    <button type="button" class="btn btn-primary customer-submit-btn">{{trans('file.submit')}}</button>
                </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>
    <!-- add cash register modal -->
    <div id="cash-register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            {!! Form::open(['route' => 'cashRegister.store', 'method' => 'post']) !!}
            <div class="modal-header">
              <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Cash Register')}}</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            </div>
            <div class="modal-body">
              <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                <div class="row">
                  <div class="col-md-6 form-group warehouse-section">
                      <label>{{trans('file.Warehouse')}} *</strong> </label>
                      <select required name="warehouse_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select warehouse...">
                          @foreach($lims_warehouse_list as $warehouse)
                          <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>{{trans('file.Cash in Hand')}} *</strong> </label>
                      <input type="number" step="any" name="cash_in_hand" required class="form-control">
                  </div>
                  <div class="col-md-12 form-group">
                      <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
                  </div>
                </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>
</section>

<section id="print-layout">
</section>

@endsection

@push('scripts')
<script type="text/javascript">
var lims_product_array = [];
var product_code = [];
var product_name = [];
var product_qty = [];
var product_type = [];
var product_id = [];
var product_list = [];
var variant_list = [];
var qty_list = [];
var product_price = [];
var wholesale_price = [];
var product_warehouse_price  = [];



var rowindex;
var customer_group_rate;
var row_product_price;
var pos;
var role_id = <?php echo json_encode(Auth::user()->role_id)?>;

$('select[name="warehouse_id"]').on('change', function() {
    var warehouse_id = $(this).val();
    getProduct(warehouse_id);
    // isCashRegisterAvailable(warehouse_id);
});

$('select[name="brand_id"]').on('change', function() {
    var warehouse_id = $("#warehouse_id").val();
    getProduct(warehouse_id);
});

$('select[name="category_id"]').on('change', function() {
    var warehouse_id = $("#warehouse_id").val();
    getProduct(warehouse_id);
});

$('select[name="product_type_id"]').on('change', function() {
    var warehouse_id = $("#warehouse_id").val();
    getProduct(warehouse_id);
});

function getProduct(warehouse_id){
    // Refactored to avoid loading entire product list
    lims_product_array = [];
}

var lims_productcodeSearch = $('#lims_productcodeSearch');
lims_productcodeSearch.autocomplete({
    source: function(request, response) {
        $.ajax({
            url: "{{ route('products.search_autocomplete') }}",
            type: "GET",
            data: {
                term: request.term,
                warehouse_id: $("#warehouse_id").val(),
                brand_id: $("#brand_id").val(),
                category_id: $("#category_id").val()
            },
            success: function(data) {
                response(data);
            }
        });
    },
    response: function(event, ui) {
        if (ui.content.length == 1) {
            var data = ui.content[0].value;
            $(this).autocomplete( "close" );
            $(".ui-helper-hidden-accessible").css('display', 'none');
            productSearch(data);
        }
    },
    select: function(event, ui) {
        var data = ui.item.value;
        $(".ui-helper-hidden-accessible").css('display', 'none');
        productSearch(data);
    }
});



    $("ul#sale").siblings('a').attr('aria-expanded','true');
    $("ul#sale").addClass("show");
    $("ul#sale #sale-create-menu").addClass("active");

    @if(config('database.connections.saleprosaas_landlord'))
        numberOfInvoice = <?php echo json_encode($numberOfInvoice)?>;
        $.ajax({
            type: 'GET',
            async: false,
            url: '{{route("package.fetchData", $general_setting->package_id)}}',
            success: function(data) {
                if(data['number_of_invoice'] > 0 && data['number_of_invoice'] <= numberOfInvoice) {
                    localStorage.setItem("message", "You don't have permission to create another invoice as you already exceed the limit! Subscribe to another package if you wants more!");
                    location.href = "{{route('sales.index')}}";
                }
            }
        });
    @endif


    var currency = <?php echo json_encode($currency) ?>;
    var currencyChange = false;
    var without_stock = <?php echo json_encode($general_setting->without_stock) ?>;

    $('#currency').val(currency['id']);

    $('#currency').change(function(){
        var rate = $(this).find(':selected').data('rate');
        var currency_id = $(this).val();
        $('#exchange_rate').val(rate);
        currency['exchange_rate'] = rate;
        $("table.order-list tbody .qty").each(function(index) {
            rowindex = index;
            currencyChange = true;
            checkDiscount($(this).val(), true);
        });
    });

    $('.customer-submit-btn').on("click", function() {
        $.ajax({
            type:'POST',
            url:'{{route('customer.store')}}',
            data: $("#customer-form").serialize(),
            success:function(response) {
                key = response['id'];
                value = response['name']+' ['+response['phone_number']+']';
                $('select[name="customer_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                $('select[name="customer_id"]').val(key);
                $('.selectpicker').selectpicker('refresh');
                $("#addCustomer").modal('hide');
                setCustomerGroupRate(key);
            }
        });
    });

    function setCustomerGroupRate(id) {
        $.get('getcustomergroup/' + id, function(data) {
            customer_group_rate = (data / 100);
        });
    }

$("#payment").hide();
$(".card-element").hide();
$("#gift-card").hide();
$("#cheque").hide();

// array data depend on warehouse
var product_code = [];
var product_name = [];
var product_qty = [];
var product_type = [];
var product_id = [];
var product_list = [];
var variant_list = [];
var qty_list = [];

// array data with selection
var product_price = [];
var wholesale_price = [];
var cost = [];
var product_discount = [];
var tax_rate = [];
var tax_name = [];
var tax_method = [];
var unit_name = [];
var unit_operator = [];
var unit_operation_value = [];
var is_imei = [];
var is_variant = [];
var gift_card_amount = [];
var gift_card_expense = [];
// temporary array
var temp_unit_name = [];
var temp_unit_operator = [];
var temp_unit_operation_value = [];

var deposit = <?php echo json_encode($deposit) ?>;
var points = <?php echo json_encode($points) ?>;
@if($lims_reward_point_setting_data)
var reward_point_setting = <?php echo json_encode($lims_reward_point_setting_data) ?>;
@endif

function productSearch(data) {
    var customer_id = $('#customer_id').val();
    $.ajax({
        type: 'GET',
        url: "{{route('product_sale.search_new')}}",
        data: {
            data: data + '?' + customer_id
        },
        success: function(data) {
            var flag = 1;
            $(".product_code").each(function(i) {
                if ($(this).val() == data[1]) {
                    rowindex = i;
                    var qty = parseFloat($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val()) + 1;
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
                    checkQuantity(String(qty), true);
                    flag = 0;
                }
            });
            if (flag) {
                var newRow = $("<tr>");
                var cols = '';
                
                // Add to data arrays for global access
                product_code.push(data[1]);
                product_name.push(data[0]);
                product_price.push(parseFloat(data[2]));
                wholesale_price.push(parseFloat(data[3]));
                tax_rate.push(parseFloat(data[4]));
                tax_name.push(data[5]);
                tax_method.push(data[6]);
                unit_name.push(data[7]);
                unit_operator.push(data[8]);
                unit_operation_value.push(data[9]);
                product_id.push(data[10]);
                is_variant.push(data[12]);
                is_imei.push(data[18]);
                product_discount.push(0);

                cols += '<td>' + data[0] +
                    ' <br> ' +
                    ' <span>Base: '+data[20]+' </span> '+
                    ' <span style="margin-left:5px">Add: '+data[19]+' </span> '+
                    ' <span style="margin-left:5px">'+data[21]+' </span> ' + '</td>';
                cols += '<td>' + data[1] + '</td>';
                cols += '<td><input type="text" class="form-control sph" name="sph[]" value="" required/></td>';
                cols += '<td><input type="text" class="form-control cyl" name="cyl[]" value="" required/></td>';
                cols += '<td><input type="text" class="form-control axis" name="axis[]" value="" required/></td>';
                cols += '<td><input type="text" class="form-control addition" name="addition[]" value="'+data[19]+'" required/></td>';
                cols += '<td><input type="text" class="form-control lr" name="lr[]" value="'+data[21]+'" required/></td>';
                cols += '<td><input type="text" class="form-control qty update_product" name="qty[]" value="1" required/></td>';
                cols += '<td><input type="text" class="form-control net_unit_price update_product" name="net_unit_price[]" value="'+data[2]+'" required/></td>';
                cols += `<td>
                    <div class="input-group-prepend">
                    <select  name="discount_type[]" class="form-control discount_type update_product" style="width:60px;padding: 6px;">
                        <option value="Percentage">%</option>
                        <option value="Flat">F</option>
                    </select>
                    <input style="width:60px" type=" text" class="form-control discount_value update_product" name="discount_value[]" value=""/>
                    </div>
                    </td>`;
                cols += '<td class="discount amt">0.00</td>';
                cols += '<td class="sub-total amt">0.00</td>';
                cols += '<td><button type="button" class="ibtnDel btn btn-md btn-danger">{{trans("file.delete")}}</button></td>';
                cols += '<input type="hidden" class="product_code" name="product_code[]" value="' + data[1] + '"/>';
                cols += '<input type="hidden" class="product-id" name="product_id[]" value="' + data[10] + '"/>';
                cols += '<input type="hidden" class="discount-value" name="discount[]" />';
                cols += '<input type="hidden" class="tax-rate" name="tax_rate[]" value="'+data[4]+'"/>';
                cols += '<input type="hidden" class="tax-value" name="tax[]" />';
                cols += '<input type="hidden" class="subtotal-value" name="subtotal[]" />';

                newRow.append(cols);
                $("table.order-list tbody").prepend(newRow);
                rowindex = newRow.index();
                
                checkQuantity(1, true);
            }
        }
    });
}


$('.selectpicker').selectpicker({
    style: 'btn-link',
});

$('[data-toggle="tooltip"]').tooltip();

$('select[name="customer_id"]').on('change', function() {
    setCustomerGroupRate($(this).val());
});

var warehouse_id = $("#warehouse_id").val();
if(warehouse_id.length){
    getProduct(warehouse_id);
    isCashRegisterAvailable(warehouse_id);
}

$('#lims_productcodeSearch').on('input', function(){
    var customer_id = $('#customer_id').val();
    var warehouse_id = $('#warehouse_id').val();
    temp_data = $('#lims_productcodeSearch').val();
    var brand_id = $('#brand_id').val();
    var category_id = $('#category_id').val();
    if(!customer_id){
        $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
        alert('Please select Customer!');
    }
    else if(!warehouse_id){
        $('#lims_productcodeSearch').val(temp_data.substring(0, temp_data.length - 1));
        alert('Please select Warehouse!');
    }else if(!brand_id){
        alert('Please select brand!');
    }else if(!category_id){
        alert('Please select category!');
    }

});

//Change quantity
// $("#myTable").on('input', '.qty', function() {
//     rowindex = $(this).closest('tr').index();

//     if($(this).val() < 0 && $(this).val() != '') {
//       $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(1);
//       alert("Quantity can't be less than 0");
//     }
//     if(is_variant[rowindex])
//         checkQuantity($(this).val(), true);
//     else
//         checkDiscount($(this).val(), true);
//     //checkQuantity($(this).val(), true);
// });


//Delete product
$("table.order-list tbody").on("click", ".ibtnDel", function(event) {
    rowindex = $(this).closest('tr').index();
    product_price.splice(rowindex, 1);
    wholesale_price.splice(rowindex, 1);
    product_discount.splice(rowindex, 1);
    tax_rate.splice(rowindex, 1);
    tax_name.splice(rowindex, 1);
    tax_method.splice(rowindex, 1);
    unit_name.splice(rowindex, 1);
    unit_operator.splice(rowindex, 1);
    unit_operation_value.splice(rowindex, 1);
    is_imei.splice(rowindex, 1);
    $(this).closest("tr").remove();
    calculateTotal();
});

//Edit product
$("table.order-list").on("click", ".edit-product", function() {
    rowindex = $(this).closest('tr').index();
    edit();
});

//Update product
$('.order-list').on("input", '.update_product', function() {
    rowindex = $(this).closest('tr').index();
    updateRow();
});

$("select[name=price_option]").on("change", function () {
    $("#editModal input[name=edit_unit_price]").val($(this).val());
});

$("#myTable").on("change", ".batch-no", function () {
    rowindex = $(this).closest('tr').index();
    var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-id').val();
    var warehouse_id = $('#warehouse_id').val();
    $.get('../check-batch-availability/' + product_id + '/' + $(this).val() + '/' + warehouse_id, function(data) {
        if(data['message'] != 'ok') {
            alert(data['message']);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.batch-no').val('');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val('');
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.expired-date').text('');
        }
        else {
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-batch-id').val(data['product_batch_id']);
            $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.expired-date').text(data['expired_date']);
            code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.product-code').val();
            pos = product_code.indexOf(code);
            product_qty[pos] = data['qty'];
        }
    });
});

function updateRow(){
        let $tr = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')');

        var discount_value = $tr.find('.discount_value').val() || 0;
        var qty = $tr.find('.qty').val();
        var unit_price = $tr.find('.net_unit_price').val();


        let discountType  = $tr.find('select[name="discount_type[]"]').val();
        let discount = 0;
        if(discountType == 'Flat') {
            discount = parseFloat(discount_value);
        } else{
            discount = parseFloat(unit_price * (discount_value / 100));
        }


        if (parseFloat(discount) > parseFloat(unit_price)) {
            discountType.val("");
            alert('Invalid Discount Input!');
            return;
        }

        if(qty < 0) {
            $tr.find('.qty').val(1);
            qty = 1;
            alert("Quantity can't be less than 0");
        }

        var tax_rate_all = <?php echo json_encode($tax_rate_all) ?>;
        tax_rate[rowindex] = parseFloat(tax_rate_all[0]);
        tax_name[rowindex] = 'No Tax';

        product_price[rowindex] = unit_price;


        product_discount[rowindex] = discount;
        checkDiscount(qty, false);
    }

function isCashRegisterAvailable(warehouse_id) {
    $.ajax({
        url: '../cash-register/check-availability/'+warehouse_id,
        type: "GET",
        success:function(data) {
            if(data == 'false') {
                $('#cash-register-modal select[name=warehouse_id]').val(warehouse_id);
                $('.selectpicker').selectpicker('refresh');
                if(role_id <= 2){
                    $("#cash-register-modal .warehouse-section").removeClass('d-none');
                }
                else {
                    $("#cash-register-modal .warehouse-section").addClass('d-none');
                }
                $("#cash-register-modal").modal('show');
            }
        }
    });
}


function populatePriceOption() {
    $('#editModal select[name=price_option]').empty();
    $('#editModal select[name=price_option]').append('<option value="'+ product_price[rowindex] +'">'+ product_price[rowindex] +'</option>');
    if(wholesale_price[rowindex] > 0)
        $('#editModal select[name=price_option]').append('<option value="'+ wholesale_price[rowindex] +'">'+ wholesale_price[rowindex] +'</option>');
    $('.selectpicker').selectpicker('refresh');
}

function edit()
{
    $(".imei-section").remove();
    if(is_imei[rowindex]) {
        var imeiNumbers = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.imei-number').val();
        if(imeiNumbers.length) {
            imeiArrays = imeiNumbers.split(",");
            htmlText = `<div class="col-md-8 form-group imei-section">
                        <label>IMEI or Serial Numbers</label>
                        <div class="table-responsive ml-2">
                            <table id="imei-table" class="table table-hover">
                                <tbody>`;
            for (var i = 0; i < imeiArrays.length; i++) {
                htmlText += `<tr>
                                <td>
                                    <input type="text" class="form-control imei-numbers" name="imei_numbers[]" value="`+imeiArrays[i]+`" />
                                </td>
                                <td>
                                    <button type="button" class="imei-del btn btn-sm btn-danger">X</button>
                                </td>
                            </tr>`;
            }
            htmlText += `</tbody>
                            </table>
                        </div>
                    </div>`;
            $("#editModal .modal-element").append(htmlText);
        }
    }
    populatePriceOption();
    $("#product-cost").text(cost[rowindex]);
    var row_product_name = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(1)').text();
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    $('#modal_header').text(row_product_name + '(' + row_product_code + ')');

    var qty = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val();
    $('input[name="edit_qty"]').val(qty);

    $('input[name="edit_discount"]').val(parseFloat(product_discount[rowindex]).toFixed({{$general_setting->decimal}}));

    var tax_name_all = <?php echo json_encode($tax_name_all) ?>;
    pos = tax_name_all.indexOf(tax_name[rowindex]);
    $('select[name="edit_tax_rate"]').val(pos);

    pos = product_code.indexOf(row_product_code);
    if(product_type[pos] == 'standard'){
        unitConversion();
        temp_unit_name = (unit_name[rowindex]).split(',');
        temp_unit_name.pop();
        temp_unit_operator = (unit_operator[rowindex]).split(',');
        temp_unit_operator.pop();
        temp_unit_operation_value = (unit_operation_value[rowindex]).split(',');
        temp_unit_operation_value.pop();
        $('select[name="edit_unit"]').empty();
        $.each(temp_unit_name, function(key, value) {
            $('select[name="edit_unit"]').append('<option value="' + key + '">' + value + '</option>');
        });
        $("#edit_unit").show();
    }
    else{
        row_product_price = product_price[rowindex];
        $("#edit_unit").hide();
    }
    $('input[name="edit_unit_price"]').val(row_product_price.toFixed({{$general_setting->decimal}}));
    $('.selectpicker').selectpicker('refresh');
}

//Delete imei
$(document).on("click", "table#imei-table tbody .imei-del", function() {
    $(this).closest("tr").remove();
    //decreaing qty
    var edit_qty = parseFloat($('input[name="edit_qty"]').val());
    $('input[name="edit_qty"]').val(edit_qty-1);
});

function checkDiscount(qty, flag) {
    var customer_id = $('#customer_id').val();
    var warehouse_id = $('#warehouse_id').val();
    var product_id = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-id').val();
    if(flag) {
        $.ajax({
            type: 'GET',
            async: false,
            url: '../sales/check-discount?qty='+qty+'&customer_id='+customer_id+'&product_id='+product_id+'&warehouse_id='+warehouse_id,
            success: function(data) {
                pos = product_code.indexOf($('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .product-code').val());
                product_price[rowindex] = parseFloat(data[0] * currency['exchange_rate']) + parseFloat(data[0] * currency['exchange_rate'] * customer_group_rate);
            }
        });
    }
    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ') .qty').val(qty);
    checkQuantity(String(qty), flag);
}

function checkQuantity(sale_qty, flag) {
    var row_product_code = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('td:nth-child(2)').text();
    pos = product_code.indexOf(row_product_code);
    if(without_stock == 'no') {
        // if(product_type[pos] == 'standard' || product_type[pos] == 'combo'){
            var operator = unit_operator[rowindex].split(',');
            var operation_value = unit_operation_value[rowindex].split(',');
            if(operator[0] == '*')
                total_qty = sale_qty * operation_value[0];
            else if(operator[0] == '/')
                total_qty = sale_qty / operation_value[0];
            if (total_qty > parseFloat(product_qty[pos])) {
                alert('Quantity exceeds stock quantity!');
                if (flag) {
                    sale_qty = sale_qty.substring(0, sale_qty.length - 1);
                    $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
                }
                else {
                    edit();
                    return;
                }
            }
        // }
        // else if(product_type[pos] == 'combo'){
        //     child_id = product_list[pos].split(',');
        //     child_qty = qty_list[pos].split(',');
        //     $(child_id).each(function(index) {
        //         var position = product_id.indexOf(parseInt(child_id[index]));
        //         if( position == -1 || parseFloat(sale_qty * child_qty[index]) > product_qty[position] ) {
        //             alert('Quantity exceeds stock quantity!');
        //             if (flag) {
        //                 sale_qty = sale_qty.substring(0, sale_qty.length - 1);
        //                 $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
        //             }
        //             else {
        //                 edit();
        //                 flag = true;
        //                 return false;
        //             }
        //         }
        //     });
        // }
    }

    if(!flag){
        $('#editModal').modal('hide');
        $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.qty').val(sale_qty);
    }
    calculateRowProductData(sale_qty);
}

function calculateRowProductData(quantity) {
    if(product_type[pos] == 'standard')
        unitConversion();
    else
        row_product_price = product_price[rowindex];

    let $row = $('table.order-list tbody tr:nth-child(' + (rowindex + 1) + ')');

    $row.find('.discount').text((product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
    $row.find('.discount-value').val((product_discount[rowindex] * quantity).toFixed({{$general_setting->decimal}}));
    $row.find('.tax-rate').val(tax_rate[rowindex].toFixed({{$general_setting->decimal}}));

    if (tax_method[rowindex] == 1) {
        var net_unit_price = row_product_price - product_discount[rowindex];
        var tax = net_unit_price * quantity * (tax_rate[rowindex] / 100);
        var sub_total = (net_unit_price * quantity) + tax;

        // $row.find('.net_unit_price').text(net_unit_price.toFixed({{$general_setting->decimal}}));
        // $row.find('.net_unit_price').val(net_unit_price.toFixed({{$general_setting->decimal}}));
        $row.find('.tax').text(tax.toFixed({{$general_setting->decimal}}));
        $row.find('.tax-value').val(tax.toFixed({{$general_setting->decimal}}));
        $row.find('.sub-total').text(sub_total.toFixed({{$general_setting->decimal}}));
        $row.find('.subtotal-value').val(sub_total.toFixed({{$general_setting->decimal}}));
    } else {
        var sub_total_unit = row_product_price - product_discount[rowindex];
        var net_unit_price = (100 / (100 + tax_rate[rowindex])) * sub_total_unit;
        var tax = (sub_total_unit - net_unit_price) * quantity;
        var sub_total = sub_total_unit * quantity;

        // $row.find('.net_unit_price').text(net_unit_price.toFixed({{$general_setting->decimal}}));
        // $row.find('.net_unit_price').val(net_unit_price.toFixed({{$general_setting->decimal}}));
        $row.find('.tax').text(tax.toFixed({{$general_setting->decimal}}));
        $row.find('.tax-value').val(tax.toFixed({{$general_setting->decimal}}));
        $row.find('.sub-total').text(sub_total.toFixed({{$general_setting->decimal}}));
        $row.find('.subtotal-value').val(sub_total.toFixed({{$general_setting->decimal}}));
    }

    calculateTotal();
}

function unitConversion() {
    var row_unit_operator = unit_operator[rowindex].slice(0, unit_operator[rowindex].indexOf(","));
    var row_unit_operation_value = unit_operation_value[rowindex].slice(0, unit_operation_value[rowindex].indexOf(","));

    if (row_unit_operator == '*') {
        row_product_price = product_price[rowindex] * row_unit_operation_value;
    } else {
        row_product_price = product_price[rowindex] / row_unit_operation_value;
    }
}

function calculateTotal() {
    //Sum of quantity
    var total_qty = 0;
    $(".qty").each(function() {
        if ($(this).val() == '') {
            total_qty += 0;
        } else {
            total_qty += parseFloat($(this).val());
        }
    });
    $("#total-qty").text(total_qty);
    $('input[name="total_qty"]').val(total_qty);

    //Sum of discount
    var total_discount = 0;
    $(".discount").each(function() {
        total_discount += parseFloat($(this).text());
    });
    $("#total-discount").text(total_discount.toFixed({{$general_setting->decimal}}));
    $('input[name="total_discount"]').val(total_discount.toFixed({{$general_setting->decimal}}));

    //Sum of tax
    var total_tax = 0;
    $(".tax").each(function() {
        total_tax += parseFloat($(this).text());
    });
    $("#total-tax").text(total_tax.toFixed({{$general_setting->decimal}}));
    $('input[name="total_tax"]').val(total_tax.toFixed({{$general_setting->decimal}}));

    //Sum of subtotal
    var total = 0;
    $(".sub-total").each(function() {
        total += parseFloat($(this).text());
    });
    $("#total").text(total.toFixed({{$general_setting->decimal}}));
    $('input[name="total_price"]').val(total.toFixed({{$general_setting->decimal}}));

    calculateGrandTotal();
}

function calculateGrandTotal() {

    var item = $('table.order-list tbody tr:last').index();
    var total_qty = parseFloat($('#total-qty').text());
    var subtotal = parseFloat($('#total').text());
    var order_tax = parseFloat($('select[name="order_tax_rate"]').val());
    if(!currencyChange)
        var shipping_cost = parseFloat($('input[name="shipping_cost"]').val());
    else
        var shipping_cost = parseFloat($('input[name="shipping_cost"]').val()*currency['exchange_rate']);
    var order_discount_type = $('select[name="order_discount_type"]').val();
    var order_discount_value = parseFloat($('input[name="order_discount_value"]').val());
    if (!order_discount_value)
        order_discount_value = {{number_format(0, $general_setting->decimal, '.', '')}};

    if(order_discount_type == 'Flat') {
        if(!currencyChange)
            var order_discount = parseFloat(order_discount_value);
        else
            var order_discount = parseFloat(order_discount_value*currency['exchange_rate']);
    }
    else
        var order_discount = parseFloat(subtotal * (order_discount_value / 100));

    if (!shipping_cost)
        shipping_cost = {{number_format(0, $general_setting->decimal, '.', '')}};

    item = ++item + '(' + total_qty + ')';
    order_tax = (subtotal - order_discount) * (order_tax / 100);
    var grand_total = (subtotal + order_tax + shipping_cost) - order_discount;

    $('input[name="order_discount"]').val(order_discount);
    $('input[name="shipping_cost"]').val(shipping_cost);
    $('#item').text(item);
    $('input[name="item"]').val($('table.order-list tbody tr:last').index() + 1);
    $('#subtotal').text(subtotal.toFixed({{$general_setting->decimal}}));
    $('#order_tax').text(order_tax.toFixed({{$general_setting->decimal}}));
    $('input[name="order_tax"]').val(order_tax.toFixed({{$general_setting->decimal}}));
    $('#order_discount').text(order_discount.toFixed({{$general_setting->decimal}}));
    $('#shipping_cost').text(shipping_cost.toFixed({{$general_setting->decimal}}));
    $('#grand_total').text(grand_total.toFixed({{$general_setting->decimal}}));
    if( $('select[name="payment_status"]').val() == 4 ){
        $('#paying-amount').val('');
        $('#paid-amount').val(grand_total.toFixed({{$general_setting->decimal}}));
    }
    $('input[name="grand_total"]').val(grand_total.toFixed({{$general_setting->decimal}}));
    currencyChange = false;
}

function cancel(rownumber) {
    while(rownumber >= 0) {
        product_price.pop();
        wholesale_price.pop();
        product_discount.pop();
        tax_rate.pop();
        tax_name.pop();
        tax_method.pop();
        unit_name.pop();
        unit_operator.pop();
        unit_operation_value.pop();
        $('table.order-list tbody tr:last').remove();
        rownumber--;
    }
    $('input[name="shipping_cost"]').val('');
    $('input[name="order_discount_value"]').val('');
    $('select[name="order_tax_rate_select"]').val(0);
    calculateTotal();
}

$('select[name="order_discount_type"]').on("change", function() {
    calculateGrandTotal();
});

$('input[name="order_discount_value"]').on("input", function() {
    calculateGrandTotal();
});

$('input[name="shipping_cost"]').on("input", function() {
    calculateGrandTotal();
});

$('select[name="order_tax_rate"]').on("change", function() {
    calculateGrandTotal();
});

$('select[name="payment_status"]').on("change", function() {
    var payment_status = $(this).val();
    if (payment_status == 3 || payment_status == 4) {
        $("#paid-amount").prop('disabled',false);
        $("#payment").show();
        $("#paying-amount").prop('required',true);
        $("#paid-amount").prop('required',true);
        if(payment_status == 4){
            $("#paid-amount").prop('disabled',true);
            $('input[name="paying_amount[]"]').val($('input[name="grand_total"]').val());
            $('input[name="paid_amount[]"]').val($('input[name="grand_total"]').val());
        }
    }
    else{
        $("#paying-amount").prop('required',false);
        $("#paid-amount").prop('required',false);
        $('input[name="paying_amount[]"]').val('');
        $('input[name="paid_amount[]"]').val('');
        $("#payment").hide();
    }
});

$('select[name="paid_by_id[]"]').on("change", function() {
    var id = $(this).val();
    $(".payment-form").off("submit");
    $('input[name="cheque_no"]').attr('required', false);
    $('select[name="gift_card_id"]').attr('required', false);
    if(id == 2) {
        $("#gift-card").show();
        $.ajax({
            url: 'get_gift_card',
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('select[name="gift_card_id"]').empty();
                $.each(data, function(index) {
                    gift_card_amount[data[index]['id']] = data[index]['amount'];
                    gift_card_expense[data[index]['id']] = data[index]['expense'];
                    $('select[name="gift_card_id"]').append('<option value="'+ data[index]['id'] +'">'+ data[index]['card_no'] +'</option>');
                });
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".card-element").hide();
        $("#cheque").hide();
        $('select[name="gift_card_id"]').attr('required', true);
    }
    else if (id == 3) {

        $("#gift-card").hide();
        $("#cheque").hide();
    }
    else if (id == 4) {
        $("#cheque").show();
        $("#gift-card").hide();
        $(".card-element").hide();
        $('input[name="cheque_no"]').attr('required', true);
    }
    else {
        $("#gift-card").hide();
        $(".card-element").hide();
        $("#cheque").hide();
        if (id == 6) {
            if($('input[name="paid_amount[]"]').val() > deposit[$('#customer_id').val()]){
                alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
            }
        }
        else if (id == 7) {
            pointCalculation();
        }
    }
});

function pointCalculation() {
    paid_amount = $('input[name=paid_amount[]]').val();
    required_point = Math.ceil(paid_amount / reward_point_setting['per_point_amount']);
    if(required_point > points[$('#customer_id').val()]) {
      alert('Customer does not have sufficient points. Available points: '+points[$('#customer_id').val()]);
    }
    else {
      $("input[name=used_points]").val(required_point);
    }
}

$('select[name="gift_card_id"]').on("change", function() {
    var balance = gift_card_amount[$(this).val()] - gift_card_expense[$(this).val()];
    if($('input[name="paid_amount[]"]').val() > balance){
        alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
});

$('input[name="paid_amount[]"]').on("input", function() {
    if( $(this).val() > parseFloat($('input[name="paying_amount[]"]').val()) ) {
        alert('Paying amount cannot be bigger than recieved amount');
        $(this).val('');
    }
    else if( $(this).val() > parseFloat($('#grand_total').text()) ){
        alert('Paying amount cannot be bigger than grand total');
        $(this).val('');
    }

    $("#change").text( parseFloat($("#paying-amount").val() - $(this).val()).toFixed({{$general_setting->decimal}}) );
    var id = $('select[name="paid_by_id[]"]').val();
    if(id == 2){
        var balance = gift_card_amount[$("#gift_card_id").val()] - gift_card_expense[$("#gift_card_id").val()];
        if($(this).val() > balance)
            alert('Amount exceeds card balance! Gift Card balance: '+ balance);
    }
    else if(id == 6){
        if( $('input[name="paid_amount[]"]').val() > deposit[$('#customer_id').val()] )
            alert('Amount exceeds customer deposit! Customer deposit : '+ deposit[$('#customer_id').val()]);
    }
});

$('input[name="paying_amount[]"]').on("input", function() {
    $("#change").text( parseFloat( $(this).val() - $("#paid-amount").val()).toFixed({{$general_setting->decimal}}));
});

$(window).keydown(function(e){
    if (e.which == 13) {
        var $targ = $(e.target);
        if (!$targ.is("textarea") && !$targ.is(":button,:submit")) {
            var focusNext = false;
            $(this).find(":input:visible:not([disabled],[readonly]), a").each(function(){
                if (this === e.target) {
                    focusNext = true;
                }
                else if (focusNext){
                    $(this).focus();
                    return false;
                }
            });
            return false;
        }
    }
});

$("#submit-button").on("click", function() {
    $('.payment-form').submit();
});

$(document).on('submit', '.payment-form', function(e) {
    var rownumber = $('table.order-list tbody tr:last').index();
    $("table.order-list tbody .qty").each(function(index) {
        if ($(this).val() == '') {
            alert('One of products has no quantity!');
            e.preventDefault();
        }
    });
    if ( rownumber < 0 ) {
        alert("Please insert product to order table!")
        e.preventDefault();
    }
    else if(parseFloat($('input[name="total_qty"]').val()) <= 0) {
        alert('Product quantity is 0');
        e.preventDefault();
    }
    else if( parseFloat($("#paying-amount").val()) < parseFloat($("#paid-amount").val()) ){
        alert('Paying amount cannot be bigger than recieved amount');
        e.preventDefault();
    }
    else if( $('select[name="payment_status"]').val() == 3 && parseFloat($("#paid-amount").val()) == parseFloat($('input[name="grand_total"]').val()) ) {
        alert('Paying amount equals to grand total! Please change payment status.');
        e.preventDefault();
    }
    else if(!$('#biller_id').val()) {
        alert('Please select a biller');
        e.preventDefault();
    }
    else {
        $("#submit-button").prop('disabled', true);
        $("#paid-amount").prop('disabled',false);
        $(".batch-no").prop('disabled', false);

        e.preventDefault(); // Prevents the default form submission behavior
        $.ajax({
            url: $('.payment-form').attr('action'),
            type: $('.payment-form').attr('method'),
            data: $('.payment-form').serialize(),
            success: function(response) {

                if (response.payment_method === 'pesapal' && response.redirect_url) {
                    // Redirect to the URL returned for Pesapal payment method
                    location.href = response.redirect_url;
                } else if ($('select[name="sale_status"]').val() == 1 && response !== 'pesapal') {
                    let link = "{{url('sales/gen_invoice/')}}" + '/' + response;
                    $('#print-layout').load(link, function() {
                        setTimeout(function() {
                            window.print();
                        }, 50);
                    });

                    $("#submit-button").prop('disabled', false);
                    $('#add-payment').modal('hide');
                    cancel($('table.order-list tbody tr:last').index());

                    setTimeout(function() {
                        window.onafterprint = function(){
                            $('#print-layout').html('');
                        }
                    }, 100);
                }
                else if($('select[name="sale_status"]').val() != 1){
                    localStorage.clear();
                    location.href = "{{route('sales.index')}}";
                }
                else {
                    localStorage.clear();
                    location.href = response;
                }
            },
            error: function(xhr) {
                console.log('Form submission failed.');
            }
        });

    }
});
</script>
// <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
@endpush

{{-- Unified Sidebar - Shared between LenzBreeze admin.blade.php and SalePro main.blade.php --}}
@php
    $currentUrl = request()->url();
    // Check if SalePro permission data is available (set by Common middleware)
    $hasSaleProPerms = isset($role_has_permissions_list);
    $isAdmin = Auth::check() && Auth::user()->role_id <= 2;
@endphp

<ul id="unified-side-menu" class="unified-sidebar-nav">
    {{-- ═══════════════════════════════════════════ --}}
    {{-- MAIN DASHBOARD --}}
    {{-- ═══════════════════════════════════════════ --}}
    <li class="nav-item {{ str_contains($currentUrl, '/admin/dashboard') || (str_contains($currentUrl, '/admin') && request()->is('admin')) ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}"><i class="dripicons-meter"></i><span>Dashboard</span></a>
    </li>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- LENZBREEZE CONTROLS --}}
    {{-- ═══════════════════════════════════════════ --}}
    <li class="nav-section-header">Lenzbreeze Controls</li>

    <li class="nav-item {{ request()->routeIs('admin.web_products*') ? 'active' : '' }}">
        <a href="{{ route('admin.web_products') }}"><i class="dripicons-list"></i><span>Web Products</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.web_inquiries*') ? 'active' : '' }}">
        <a href="{{ route('admin.web_inquiries') }}"><i class="dripicons-message"></i><span>Inquiries</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.warranties*') ? 'active' : '' }}">
        <a href="{{ route('admin.warranties') }}"><i class="dripicons-checkmark"></i><span>Warranties</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.qrcodes*') ? 'active' : '' }}">
        <a href="{{ route('admin.qrcodes') }}"><i class="dripicons-preview"></i><span>QR Codes</span></a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.web_pages*') ? 'active' : '' }}">
        <a href="{{ route('admin.web_pages') }}"><i class="dripicons-document"></i><span>Pages</span></a>
    </li>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- STORE MANAGEMENT SECTION --}}
    {{-- ═══════════════════════════════════════════ --}}
    <li class="nav-section-header">Store Management</li>

    @if($hasSaleProPerms)
    {{-- ── Product ── --}}
    @php
        $sp_product_index = $role_has_permissions_list->where('name', 'products-index')->first();
        $sp_category = $role_has_permissions_list->where('name', 'category')->first();
        $sp_print_barcode = $role_has_permissions_list->where('name', 'print_barcode')->first();
        $sp_stock_count = $role_has_permissions_list->where('name', 'stock_count')->first();
        $sp_adjustment = $role_has_permissions_list->where('name', 'adjustment')->first();
    @endphp
    @if($sp_category || $sp_product_index || $sp_print_barcode || $sp_stock_count || $sp_adjustment)
    @php 
        $isProductActive = str_contains($currentUrl, '/admin/category') || str_contains($currentUrl, '/admin/product_type') || str_contains($currentUrl, '/admin/products') || str_contains($currentUrl, '/admin/qty_adjustment') || str_contains($currentUrl, '/admin/stock-count');
    @endphp
    <li class="nav-item has-submenu {{ $isProductActive ? 'active' : '' }}">
        <a href="#sp-product" data-toggle="collapse" aria-expanded="{{ $isProductActive ? 'true' : 'false' }}"><i class="dripicons-list"></i><span>Store Products</span></a>
        <ul id="sp-product" class="collapse submenu {{ $isProductActive ? 'show' : '' }}">
            @if($sp_category)
            <li class="{{ str_contains($currentUrl, '/admin/category') ? 'active' : '' }}"><a href="{{ url('/admin/category') }}">Category</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/product_type') ? 'active' : '' }}"><a href="{{ url('/admin/product_type') }}">Type</a></li>
            @endif
            @if($sp_product_index)
            <li class="{{ request()->is('admin/products') ? 'active' : '' }}"><a href="{{ url('/admin/products') }}">Product List</a></li>
            @php $sp_product_add = $role_has_permissions_list->where('name', 'products-add')->first(); @endphp
            @if($sp_product_add)
            <li class="{{ request()->is('admin/products/create') ? 'active' : '' }}"><a href="{{ url('/admin/products/create') }}">Add Product</a></li>
            @endif
            @endif
            @if($sp_print_barcode)
            <li class="{{ str_contains($currentUrl, '/admin/products/print_barcode') ? 'active' : '' }}"><a href="{{ url('/admin/products/print_barcode') }}">Print Barcode</a></li>
            @endif
            @if($sp_adjustment)
            <li class="{{ str_contains($currentUrl, '/admin/qty_adjustment') ? 'active' : '' }}"><a href="{{ url('/admin/qty_adjustment') }}">Adjustment List</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/qty_adjustment/create') ? 'active' : '' }}"><a href="{{ url('/admin/qty_adjustment/create') }}">Add Adjustment</a></li>
            @endif
            @if($sp_stock_count)
            <li class="{{ str_contains($currentUrl, '/admin/stock-count') ? 'active' : '' }}"><a href="{{ url('/admin/stock-count') }}">Stock Count</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Purchase ── --}}
    @php $sp_purchase_index = $role_has_permissions_list->where('name', 'purchases-index')->first(); @endphp
    @if($sp_purchase_index)
    @php $isPurchaseActive = str_contains($currentUrl, '/admin/purchases'); @endphp
    <li class="nav-item has-submenu {{ $isPurchaseActive ? 'active' : '' }}">
        <a href="#sp-purchase" data-toggle="collapse" aria-expanded="{{ $isPurchaseActive ? 'true' : 'false' }}"><i class="dripicons-card"></i><span>Purchase</span></a>
        <ul id="sp-purchase" class="collapse submenu {{ $isPurchaseActive ? 'show' : '' }}">
            <li class="{{ request()->is('admin/purchases') ? 'active' : '' }}"><a href="{{ url('/admin/purchases') }}">Purchase List</a></li>
            @php $sp_purchase_add = $role_has_permissions_list->where('name', 'purchases-add')->first(); @endphp
            @if($sp_purchase_add)
            <li class="{{ request()->is('admin/purchases/create') ? 'active' : '' }}"><a href="{{ url('/admin/purchases/create') }}">Add Purchase</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/purchases/purchase_by_csv') ? 'active' : '' }}"><a href="{{ url('/admin/purchases/purchase_by_csv') }}">Import By CSV</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Sale ── --}}
    @php
        $sp_sale_index = $role_has_permissions_list->where('name', 'sales-index')->first();
        $sp_sale_add = $role_has_permissions_list->where('name', 'sales-add')->first();
        $sp_packing = $role_has_permissions_list->where('name', 'packing_slip_challan')->first();
        $sp_gift_card = $role_has_permissions_list->where('name', 'gift_card')->first();
        $sp_coupon = $role_has_permissions_list->where('name', 'coupon')->first();
        $sp_delivery = $role_has_permissions_list->where('name', 'delivery')->first();
    @endphp
    @if($sp_sale_index || $sp_packing || $sp_gift_card || $sp_coupon || $sp_delivery)
    @php 
        $isSaleActive = str_contains($currentUrl, '/admin/sales') || str_contains($currentUrl, '/admin/bill') || str_contains($currentUrl, '/admin/payment') || str_contains($currentUrl, '/admin/packing-slips') || str_contains($currentUrl, '/admin/challans') || str_contains($currentUrl, '/admin/delivery') || str_contains($currentUrl, '/admin/coupons') || str_contains($currentUrl, '/admin/gift_cards');
    @endphp
    <li class="nav-item has-submenu {{ $isSaleActive ? 'active' : '' }}">
        <a href="#sp-sale" data-toggle="collapse" aria-expanded="{{ $isSaleActive ? 'true' : 'false' }}"><i class="dripicons-cart"></i><span>Sale</span></a>
        <ul id="sp-sale" class="collapse submenu {{ $isSaleActive ? 'show' : '' }}">
            @if($sp_sale_index)
            <li class="{{ str_contains($currentUrl, '/admin/payment') ? 'active' : '' }}"><a href="{{ url('/admin/payment') }}">Payment</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/bill/bill-date') ? 'active' : '' }}"><a href="{{ url('/admin/bill/bill-date') }}">Bill Data</a></li>
            <li class="{{ request()->is('admin/bill') ? 'active' : '' }}"><a href="{{ url('/admin/bill') }}">Daily Bill</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/bill/bill-monthly') ? 'active' : '' }}"><a href="{{ url('/admin/bill/bill-monthly') }}">Monthly Bill</a></li>
            <li class="{{ request()->is('admin/sales') ? 'active' : '' }}"><a href="{{ url('/admin/sales') }}">Order List</a></li>
            @endif
            @if($sp_sale_add)
            <li class="{{ request()->is('admin/sales/create') ? 'active' : '' }}"><a href="{{ url('/admin/sales/create') }}">Create Order</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/sales/sale_by_csv') ? 'active' : '' }}"><a href="{{ url('/admin/sales/sale_by_csv') }}">Import By CSV</a></li>
            @endif
            @if($sp_packing)
            <li class="{{ str_contains($currentUrl, '/admin/packing-slips') ? 'active' : '' }}"><a href="{{ url('/admin/packing-slips') }}">Packing Slip List</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/challans') ? 'active' : '' }}"><a href="{{ url('/admin/challans') }}">Challan List</a></li>
            @endif
            @if($sp_delivery)
            <li class="{{ str_contains($currentUrl, '/admin/delivery') ? 'active' : '' }}"><a href="{{ url('/admin/delivery') }}">Delivery List</a></li>
            @endif
            @if($sp_gift_card)
            <li class="{{ str_contains($currentUrl, '/admin/gift_cards') ? 'active' : '' }}"><a href="{{ url('/admin/gift_cards') }}">Gift Card List</a></li>
            @endif
            @if($sp_coupon)
            <li class="{{ str_contains($currentUrl, '/admin/coupons') ? 'active' : '' }}"><a href="{{ url('/admin/coupons') }}">Coupon List</a></li>
            @endif
            <li class="{{ str_contains($currentUrl, '/admin/couriers') ? 'active' : '' }}"><a href="{{ url('/admin/couriers') }}">Courier List</a></li>
        </ul>
    </li>
    @endif

    {{-- ── Expense ── --}}
    @php $sp_expense_index = $role_has_permissions_list->where('name', 'expenses-index')->first(); @endphp
    @if($sp_expense_index)
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/admin/expense_categories') || str_contains($currentUrl, '/admin/expenses') ? 'active' : '' }}">
        <a href="#sp-expense" data-toggle="collapse" aria-expanded="{{ str_contains($currentUrl, '/admin/expense_categories') || str_contains($currentUrl, '/admin/expenses') ? 'true' : 'false' }}"><i class="dripicons-wallet"></i><span>Expense</span></a>
        <ul id="sp-expense" class="collapse submenu {{ str_contains($currentUrl, '/admin/expense_categories') || str_contains($currentUrl, '/admin/expenses') ? 'show' : '' }}">
            <li class="{{ str_contains($currentUrl, '/admin/expense_categories') ? 'active' : '' }}"><a href="{{ url('/admin/expense_categories') }}">Expense Category</a></li>
            <li class="{{ str_contains($currentUrl, '/admin/expenses') ? 'active' : '' }}"><a href="{{ url('/admin/expenses') }}">Expense List</a></li>
        </ul>
    </li>
    @endif

    {{-- ── Transfer ── --}}
    @php $sp_transfer_index = $role_has_permissions_list->where('name', 'transfers-index')->first(); @endphp
    @if($sp_transfer_index)
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/admin/transfers') ? 'active' : '' }}">
        <a href="#sp-transfer" data-toggle="collapse" aria-expanded="{{ str_contains($currentUrl, '/admin/transfers') ? 'true' : 'false' }}"><i class="dripicons-export"></i><span>Transfer</span></a>
        <ul id="sp-transfer" class="collapse submenu {{ str_contains($currentUrl, '/admin/transfers') ? 'show' : '' }}">
            <li><a href="{{ url('/admin/transfers') }}">Transfer List</a></li>
            @php $sp_transfer_add = $role_has_permissions_list->where('name', 'transfers-add')->first(); @endphp
            @if($sp_transfer_add)
            <li><a href="{{ url('/admin/transfers/create') }}">Add Transfer</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Return ── --}}
    @php
        $sp_sale_return = $role_has_permissions_list->where('name', 'returns-index')->first();
        $sp_purchase_return = $role_has_permissions_list->where('name', 'purchase-return-index')->first();
    @endphp
    @if($sp_sale_return || $sp_purchase_return)
    @php $isReturnActive = str_contains($currentUrl, '/admin/return-sale') || str_contains($currentUrl, '/admin/return-purchase'); @endphp
    <li class="nav-item has-submenu {{ $isReturnActive ? 'active' : '' }}">
        <a href="#sp-return" data-toggle="collapse" aria-expanded="{{ $isReturnActive ? 'true' : 'false' }}"><i class="dripicons-return"></i><span>Return</span></a>
        <ul id="sp-return" class="collapse submenu {{ $isReturnActive ? 'show' : '' }}">
            @if($sp_sale_return)
            <li class="{{ str_contains($currentUrl, '/admin/return-sale') ? 'active' : '' }}"><a href="{{ url('/admin/return-sale') }}">Sale</a></li>
            @endif
            @if($sp_purchase_return)
            <li class="{{ str_contains($currentUrl, '/admin/return-purchase') ? 'active' : '' }}"><a href="{{ url('/admin/return-purchase') }}">Purchase</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Accounting ── --}}
    @php
        $sp_account_index = $role_has_permissions_list->where('name', 'account-index')->first();
        $sp_money_transfer = $role_has_permissions_list->where('name', 'money-transfer')->first();
        $sp_balance_sheet = $role_has_permissions_list->where('name', 'balance-sheet')->first();
        $sp_account_statement = $role_has_permissions_list->where('name', 'account-statement')->first();
    @endphp
    @if($sp_account_index || $sp_balance_sheet || $sp_account_statement || $sp_money_transfer)
    @php $isAccountActive = str_contains($currentUrl, '/admin/accounts') || str_contains($currentUrl, '/admin/money-transfers') || str_contains($currentUrl, '/admin/balancesheet'); @endphp
    <li class="nav-item has-submenu {{ $isAccountActive ? 'active' : '' }}">
        <a href="#sp-accounting" data-toggle="collapse" aria-expanded="{{ $isAccountActive ? 'true' : 'false' }}"><i class="dripicons-briefcase"></i><span>Accounting</span></a>
        <ul id="sp-accounting" class="collapse submenu {{ $isAccountActive ? 'show' : '' }}">
            @if($sp_account_index)
            <li><a href="{{ url('/admin/accounts') }}">Account List</a></li>
            @endif
            @if($sp_money_transfer)
            <li><a href="{{ url('/admin/money-transfers') }}">Money Transfer</a></li>
            @endif
            @if($sp_balance_sheet)
            <li><a href="{{ url('/admin/balancesheet') }}">Balance Sheet</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── HRM ── --}}
    @php
        $sp_department = $role_has_permissions_list->where('name', 'department')->first();
        $sp_employee = $role_has_permissions_list->where('name', 'employees-index')->first();
        $sp_attendance = $role_has_permissions_list->where('name', 'attendance')->first();
        $sp_payroll = $role_has_permissions_list->where('name', 'payroll')->first();
        $sp_holiday = $role_has_permissions_list->where('name', 'holiday')->first();
    @endphp
    @if($sp_department || $sp_employee || $sp_attendance || $sp_payroll || $sp_holiday)
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/salepro/departments') || str_contains($currentUrl, '/salepro/employees') || str_contains($currentUrl, '/salepro/attendance') || str_contains($currentUrl, '/salepro/payroll') || str_contains($currentUrl, '/salepro/holidays') ? 'active' : '' }}">
        <a href="#sp-hrm" data-toggle="collapse" aria-expanded="false"><i class="dripicons-user-group"></i><span>HRM</span></a>
        <ul id="sp-hrm" class="collapse submenu">
            @if($sp_department)
            <li><a href="{{ url('/admin/departments') }}">Department</a></li>
            @endif
            @if($sp_employee)
            <li><a href="{{ url('/admin/employees') }}">Employee</a></li>
            @endif
            @if($sp_attendance)
            <li><a href="{{ url('/admin/attendance') }}">Attendance</a></li>
            @endif
            @if($sp_payroll)
            <li><a href="{{ url('/admin/payroll') }}">Payroll</a></li>
            @endif
            @if($sp_holiday)
            <li><a href="{{ url('/admin/holidays') }}">Holiday</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── People ── --}}
    @php
        $sp_user_index = $role_has_permissions_list->where('name', 'users-index')->first();
        $sp_customer_index = $role_has_permissions_list->where('name', 'customers-index')->first();
        $sp_biller_index = $role_has_permissions_list->where('name', 'billers-index')->first();
        $sp_supplier_index = $role_has_permissions_list->where('name', 'suppliers-index')->first();
    @endphp
    @if($sp_user_index || $sp_customer_index || $sp_biller_index || $sp_supplier_index)
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/salepro/user') || str_contains($currentUrl, '/salepro/customer') || str_contains($currentUrl, '/salepro/biller') || str_contains($currentUrl, '/salepro/supplier') ? 'active' : '' }}">
        <a href="#sp-people" data-toggle="collapse" aria-expanded="false"><i class="dripicons-user"></i><span>People</span></a>
        <ul id="sp-people" class="collapse submenu">
            @if($sp_user_index)
            <li><a href="{{ url('/admin/user') }}">User List</a></li>
            @endif
            @if($sp_customer_index)
            <li><a href="{{ url('/admin/customer') }}">Customer List</a></li>
            @endif
            @if($sp_biller_index)
            <li><a href="{{ url('/admin/biller') }}">Biller List</a></li>
            @endif
            @if($sp_supplier_index)
            <li><a href="{{ url('/admin/supplier') }}">Supplier List</a></li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Reports ── --}}
    @php
        $profit_loss_active = $role_has_permissions_list->where('name', 'profit-loss')->first();
        $best_seller_active = $role_has_permissions_list->where('name', 'best-seller')->first();
        $warehouse_report_active = $role_has_permissions_list->where('name', 'warehouse-report')->first();
        $warehouse_stock_report_active = $role_has_permissions_list->where('name', 'warehouse-stock-report')->first();
        $product_report_active = $role_has_permissions_list->where('name', 'product-report')->first();
        $daily_sale_active = $role_has_permissions_list->where('name', 'daily-sale')->first();
        $monthly_sale_active = $role_has_permissions_list->where('name', 'monthly-sale')->first();
        $daily_purchase_active = $role_has_permissions_list->where('name', 'daily-purchase')->first();
        $monthly_purchase_active = $role_has_permissions_list->where('name', 'monthly-purchase')->first();
        $purchase_report_active = $role_has_permissions_list->where('name', 'purchase-report')->first();
        $sale_report_active = $role_has_permissions_list->where('name', 'sale-report')->first();
        $sale_report_chart_active = $role_has_permissions_list->where('name', 'sale-report-chart')->first();
        $payment_report_active = $role_has_permissions_list->where('name', 'payment-report')->first();
        $product_expiry_report_active = $role_has_permissions_list->where('name', 'product-expiry-report')->first();
        $product_qty_alert_active = $role_has_permissions_list->where('name', 'product-qty-alert')->first();
        $dso_report_active = $role_has_permissions_list->where('name', 'dso-report')->first();
        $user_report_active = $role_has_permissions_list->where('name', 'user-report')->first();
        $biller_report_active = $role_has_permissions_list->where('name', 'biller-report')->first();
        $customer_report_active = $role_has_permissions_list->where('name', 'customer-report')->first();
        $supplier_report_active = $role_has_permissions_list->where('name', 'supplier-report')->first();
        $due_report_active = $role_has_permissions_list->where('name', 'due-report')->first();
        $supplier_due_report_active = $role_has_permissions_list->where('name', 'supplier-due-report')->first();
    @endphp
    @if($profit_loss_active || $best_seller_active || $warehouse_report_active || $warehouse_stock_report_active || $product_report_active || $daily_sale_active || $monthly_sale_active || $daily_purchase_active || $monthly_purchase_active || $purchase_report_active || $sale_report_active || $sale_report_chart_active || $payment_report_active || $product_expiry_report_active || $product_qty_alert_active || $dso_report_active || $user_report_active || $biller_report_active || $customer_report_active || $supplier_report_active || $due_report_active || $supplier_due_report_active)
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/report') ? 'active' : '' }}">
        <a href="#sp-report" data-toggle="collapse" aria-expanded="false"><i class="dripicons-document-remove"></i><span>Reports</span></a>
        <ul id="sp-report" class="collapse submenu">
            @if($profit_loss_active)
            <li id="profit-loss-report-menu">
            {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}
            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
            <a id="profitLoss-link" href="">{{trans('file.Summary Report')}}</a>
            {!! Form::close() !!}
            </li>
            @endif
            @if($best_seller_active)
            <li id="best-seller-report-menu">
            <a href="{{url('admin/report/best_seller')}}">{{trans('file.Best Seller')}}</a>
            </li>
            @endif
            @if($product_report_active)
            <li id="product-report-menu">
            {!! Form::open(['route' => 'report.product', 'method' => 'get', 'id' => 'product-report-form']) !!}
            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
            <input type="hidden" name="warehouse_id" value="0" />
            <a id="report-link" href="">{{trans('file.Product Report')}}</a>
            {!! Form::close() !!}
            </li>
            @endif
            @if($daily_sale_active)
            <li id="daily-sale-report-menu">
            <a href="{{url('admin/report/daily_sale/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Sale')}}</a>
            </li>
            @endif
            @if($monthly_sale_active)
            <li id="monthly-sale-report-menu">
            <a href="{{url('admin/report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>
            </li>
            @endif
            @if($daily_purchase_active)
            <li id="daily-purchase-report-menu">
            <a href="{{url('admin/report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Purchase')}}</a>
            </li>
            @endif
            @if($monthly_purchase_active)
            <li id="monthly-purchase-report-menu">
            <a href="{{url('admin/report/monthly_purchase/'.date('Y'))}}">{{trans('file.Monthly Purchase')}}</a>
            </li>
            @endif
            @if($sale_report_active)
            <li id="sale-report-menu">
            {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}
            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
            <input type="hidden" name="warehouse_id" value="0" />
            <a id="sale-report-link" href="">{{trans('file.Sale Report')}}</a>
            {!! Form::close() !!}
            </li>
            @endif
            <li id="challan-report-menu"><a href="{{route('report.challan')}}"> {{trans('file.Challan Report')}}</a></li>
            @if($sale_report_chart_active)
            <li id="sale-report-chart-menu">
                {!! Form::open(['route' => 'report.saleChart', 'method' => 'post', 'id' => 'sale-report-chart-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <input type="hidden" name="warehouse_id" value="0" />
                <input type="hidden" name="time_period" value="weekly" />
                <a id="sale-report-chart-link" href="">{{trans('file.Sale Report Chart')}}</a>
                {!! Form::close() !!}
            </li>
            @endif
            @if($payment_report_active)
            <li id="payment-report-menu">
            {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}
            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
            <a id="payment-report-link" href="">{{trans('file.Payment Report')}}</a>
            {!! Form::close() !!}
            </li>
            @endif
            @if($purchase_report_active)
            <li id="purchase-report-menu">
            {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}
            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
            <input type="hidden" name="warehouse_id" value="0" />
            <a id="purchase-report-link" href="">{{trans('file.Purchase Report')}}</a>
            {!! Form::close() !!}
            </li>
            @endif
            @if($customer_report_active)
            <li id="customer-report-menu">
            <a href="{{route('report.customer')}}">{{trans('file.Customer Report')}}</a>
            </li>
            @endif
            @if($customer_report_active)
            <li id="customer-report-menu">
                <a href="{{route('report.customer_group')}}" href="">{{trans('file.Customer Group Report')}}</a>
            </li>
            @endif
            @if($due_report_active)
            <li id="due-report-menu">
                {!! Form::open(['route' => 'report.customerDueByDate', 'method' => 'post', 'id' => 'customer-due-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m-d', strtotime('-1 year'))}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="due-report-link" href="">{{trans('file.Customer Due Report')}}</a>
                {!! Form::close() !!}
            </li>
            @endif
            @if($supplier_report_active)
            <li id="supplier-report-menu">
                <a id="supplier-report-link" href="">{{trans('file.Supplier Report')}}</a>
            </li>
            @endif
            @if($supplier_due_report_active)
            <li id="supplier-due-report-menu">
                {!! Form::open(['route' => 'report.supplierDueByDate', 'method' => 'post', 'id' => 'supplier-due-report-form']) !!}
                <input type="hidden" name="start_date" value="{{date('Y-m-d', strtotime('-1 year'))}}" />
                <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />
                <a id="supplier-due-report-link" href="">{{trans('file.Supplier Due Report')}}</a>
                {!! Form::close() !!}
            </li>
            @endif
            @if($warehouse_report_active)
            <li id="warehouse-report-menu">
            <a id="warehouse-report-link" href="">{{trans('file.Warehouse Report')}}</a>
            </li>
            @endif
            @if($warehouse_stock_report_active)
            <li id="warehouse-stock-report-menu">
            <a href="{{route('report.warehouseStock')}}">{{trans('file.Warehouse Stock Chart')}}</a>
            </li>
            @endif
            @if($product_expiry_report_active)
            <li id="productExpiry-report-menu">
            <a href="{{route('report.productExpiry')}}">{{trans('file.Product Expiry Report')}}</a>
            </li>
            @endif
            @if($product_qty_alert_active)
            <li id="qtyAlert-report-menu">
            <a href="{{route('report.qtyAlert')}}">{{trans('file.Product Quantity Alert')}}</a>
            </li>
            @endif
            @if($dso_report_active)
            <li id="daily-sale-objective-menu">
                <a href="{{route('report.dailySaleObjective')}}">{{trans('file.Daily Sale Objective Report')}}</a>
            </li>
            @endif
            @if($user_report_active)
            <li id="user-report-menu">
            <a id="user-report-link" href="">{{trans('file.User Report')}}</a>
            </li>
            @endif
            @if($biller_report_active)
            <li id="biller-report-menu">
                <a id="biller-report-link" href="">{{trans('file.Biller Report')}}</a>
            </li>
            @endif
        </ul>
    </li>
    @endif

    {{-- ── Settings ── --}}
    <li class="nav-item has-submenu {{ str_contains($currentUrl, '/salepro/setting') || str_contains($currentUrl, '/salepro/warehouse') || str_contains($currentUrl, '/salepro/role') ? 'active' : '' }}">
        <a href="#sp-settings" data-toggle="collapse" aria-expanded="false"><i class="dripicons-gear"></i><span>Store Settings</span></a>
        <ul id="sp-settings" class="collapse submenu">
            @if($isAdmin)
            <li><a href="{{ url('/admin/role') }}">Role Permission</a></li>
            @endif
            @php $sp_warehouse = $role_has_permissions_list->where('name', 'warehouse')->first(); @endphp
            @if($sp_warehouse)
            <li><a href="{{ url('/admin/warehouse') }}">Warehouse</a></li>
            @endif
            @php $sp_brand = $role_has_permissions_list->where('name', 'brand')->first(); @endphp
            @if($sp_brand)
            <li><a href="{{ url('/admin/brand') }}">Brand</a></li>
            @endif
            @php $sp_unit = $role_has_permissions_list->where('name', 'unit')->first(); @endphp
            @if($sp_unit)
            <li><a href="{{ url('/admin/unit') }}">Unit</a></li>
            @endif
            @php $sp_currency = $role_has_permissions_list->where('name', 'currency')->first(); @endphp
            @if($sp_currency)
            <li><a href="{{ url('/admin/currency') }}">Currency</a></li>
            @endif
            @php $sp_tax = $role_has_permissions_list->where('name', 'tax')->first(); @endphp
            @if($sp_tax)
            <li><a href="{{ url('/admin/tax') }}">Tax</a></li>
            @endif
            @php $sp_general_setting = $role_has_permissions_list->where('name', 'general_setting')->first(); @endphp
            @if($sp_general_setting)
            <li><a href="{{ url('/admin/setting/general_setting') }}">General Setting</a></li>
            @endif
            <li><a href="{{ url('/admin/user/profile/' . Auth::id()) }}">User Profile</a></li>
        </ul>
    </li>
    @else
    {{-- Fallback when SalePro permissions are not loaded (LenzBreeze-only pages) --}}
    <li class="nav-item">
        <a href="{{ url('/admin/dashboard') }}"><i class="dripicons-meter"></i><span>Store Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/sales') }}"><i class="dripicons-cart"></i><span>Sales</span></a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/purchases') }}"><i class="dripicons-card"></i><span>Purchases</span></a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/customer') }}"><i class="dripicons-user"></i><span>Customers</span></a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/setting/general_setting') }}"><i class="dripicons-gear"></i><span>Store Settings</span></a>
    </li>
    @endif
</ul>

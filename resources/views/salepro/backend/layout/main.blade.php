<!DOCTYPE html>
<html dir="@if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl){{'rtl'}}@endif">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @if(!config('database.connections.saleprosaas_landlord'))
  <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.avif') }}" />
  <title>{{$general_setting->site_title}}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
  <link rel="preload" href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
  <!-- Drip icon font-->
  <link rel="stylesheet" href="<?php echo asset('vendor/dripicons/webfont.css') ?>" type="text/css">


  <!-- jQuery Circle-->
  <link rel="preload" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- Custom Scrollbar-->
  <link rel="preload" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" rel="stylesheet">
  </noscript>

  @if(Route::current()->getName() != '/')
  <!-- date range stylesheet-->
  <link rel="preload" href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- table sorter stylesheet-->
  <link rel="preload" href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  </noscript>
  <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet">
  </noscript>
  @endif

  <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('css/dropzone.css') ?>">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?php echo asset('css/custom-' . $general_setting->theme) ?>" type="text/css" id="custom-style">

  @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
  <!-- RTL css -->
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-rtl.min.css') ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('css/custom-rtl.css') ?>" type="text/css" id="custom-style">
  @endif

  <style>
    :root {
      --theme-color: #009688; /* Premium Teal */
    }

    /* Darken Sidebar Scrollbar */
    .side-navbar::-webkit-scrollbar {
      width: 6px;
    }
    .side-navbar::-webkit-scrollbar-track {
      background: #141b2e;
    }
    .side-navbar::-webkit-scrollbar-thumb {
      background: #3b4253;
      border-radius: 10px;
    }
    .side-navbar::-webkit-scrollbar-thumb:hover {
      background: #4a546d;
    }

    /* Standardize Scrollbar for other elements */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    .dark-mode ::-webkit-scrollbar-track {
      background: #141b2e;
    }
    ::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 10px;
    }
    .dark-mode ::-webkit-scrollbar-thumb {
      background: #3b4253;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #bbb;
    }
    .dark-mode ::-webkit-scrollbar-thumb:hover {
      background: #4a546d;
    }

    /* Force Teal Theme and Remove Lavender */
    :root {
      --theme-color: #009688 !important;
      --primary-color: #009688 !important;
    }

    /* Buttons */
    .btn-primary, .btn-pos, .btn-pos:hover, .btn-default.btn-primary:active, .btn-primary.active {
      background-color: var(--theme-color) !important;
      border-color: var(--theme-color) !important;
      color: #fff !important;
    }
    .btn-pos {
      border: 1px solid var(--theme-color) !important;
      color: var(--theme-color) !important;
    }
    .btn-pos:hover {
      background-color: var(--theme-color) !important;
      color: #fff !important;
    }

    /* Badges */
    .badge-primary, .badge-success {
      background-color: var(--theme-color) !important;
      color: #fff !important;
    }

    /* Dashboard Elements */
    .brand-text h3, .brand-text h3 span, .dashboard-header h2, .statistics h2, .details-header {
      color: var(--theme-color) !important;
    }
    .filter-toggle .date-btn.active, .filter-toggle .daterangepicker-field.active {
      background-color: var(--theme-color) !important;
      border-color: var(--theme-color) !important;
      color: #fff !important;
    }
    .count-title .icon i, .dashboard-counts .count-title i {
      color: var(--theme-color) !important;
    }
    .nav-tabs .nav-link.active {
      border-bottom: 2px solid var(--theme-color) !important;
      color: var(--theme-color) !important;
    }

    /* Sidebar Logo Fix */
    .lz-logo-icon {
      background: var(--theme-color) !important;
    }
    .lz-logo-text {
      color: #fff !important; /* Ensure logo text is white */
    }

    /* Chart Overrides */
    .daterangepicker .apply-btn {
      background-color: var(--theme-color) !important;
      border-color: var(--theme-color) !important;
    }
  </style>
  @else
  <link rel="icon" type="image/png" href="{{ asset('images/logo-icon.avif') }}" />
  <title>{{$general_setting->site_title}}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
  <link rel="preload" href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
  <!-- Drip icon font-->
  <link rel="stylesheet" href="<?php echo asset('vendor/dripicons/webfont.css') ?>" type="text/css">

  <!-- jQuery Circle-->
  <link rel="preload" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- Custom Scrollbar-->
  <link rel="preload" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" rel="stylesheet">
  </noscript>

  @if(Route::current()->getName() != '/')
  <!-- date range stylesheet-->
  <link rel="preload" href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" rel="stylesheet">
  </noscript>
  <!-- table sorter stylesheet-->
  <link rel="preload" href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  </noscript>
  <link rel="preload" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  </noscript>
  <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet">
  </noscript>
  @endif

  <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('css/dropzone.css') ?>">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?php echo asset('css/custom-' . $general_setting->theme) ?>" type="text/css" id="custom-style">

  @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
  <!-- RTL css -->
  <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-rtl.min.css') ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo asset('css/custom-rtl.css') ?>" type="text/css" id="custom-style">
  @endif
  @endif
  <!-- Google fonts - Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap" rel="stylesheet">

  @stack('css')

  <style>
    /* ═══════════════════════════════════════════════════════════ */
    /* LenzBreeze Unified Theme for SalePro                       */
    /* ═══════════════════════════════════════════════════════════ */

    /* --- Reset SalePro default layout --- */
    body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important; margin: 0; background-color: #f3f4f6 !important; }

    /* Hide old SalePro nav/header/footer - we replace with LenzBreeze shell */
    nav.side-navbar, header.container-fluid, footer.main-footer, .page { display: none !important; }

    /* --- Unified Sidebar --- */
    .lz-sidebar {
      position: fixed; top: 0; left: 0; bottom: 0; width: 256px; z-index: 40;
      background: #ffffff; color: #374151; overflow-y: auto;
      border-right: 1px solid #e5e7eb;
      display: flex; flex-direction: column;
      scrollbar-width: thin;
      scrollbar-color: rgba(0,0,0,0.1) transparent;
    }
    .lz-sidebar::-webkit-scrollbar { width: 5px; }
    .lz-sidebar::-webkit-scrollbar-track { background: transparent; }
    .lz-sidebar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
    .lz-sidebar::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.2); }
    .lz-sidebar-logo {
      height: 64px; display: flex; align-items: center; padding: 0 20px;
      border-bottom: 1px solid #e5e7eb; flex-shrink: 0;
    }
    .lz-sidebar-logo a { display: flex; align-items: center; gap: 12px; text-decoration: none !important; }
    .lz-sidebar-logo .lz-logo-icon {
      width: 36px; height: 36px; border-radius: 8px; background: var(--color-logo-bg, #00afb0);
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .lz-sidebar-logo .lz-logo-icon span { font-weight: 700; font-size: 13px; color: var(--color-logo-text, #ffffff); }
    .lz-sidebar-logo .lz-logo-text { font-weight: 700; font-size: 17px; color: #111827; }
    .lz-sidebar-nav { flex: 1; overflow-y: auto; }
    .lz-sidebar-bottom {
      border-top: 1px solid #e5e7eb; padding: 12px; flex-shrink: 0;
    }
    .lz-sidebar-bottom a, .lz-sidebar-bottom button {
      display: flex; align-items: center; gap: 12px; padding: 9px 12px;
      border-radius: 8px; font-size: 13px; font-weight: 500;
      color: #6b7280 !important; text-decoration: none !important;
      border: none; background: none; width: 100%; cursor: pointer;
      transition: all 0.15s ease;
    }
    .lz-sidebar-bottom a:hover { background: #f3f4f6; color: #111827 !important; }
    .lz-sidebar-bottom button:hover { background: rgba(239,68,68,0.1); color: #ef4444 !important; }

    /* Unified sidebar nav styles */
    .unified-sidebar-nav { list-style: none; padding: 12px 16px; margin: 0; }
    .unified-sidebar-nav .nav-section-header {
      color: #9ca3af; font-size: 10px; font-weight: 700;
      text-transform: uppercase; letter-spacing: 1.2px; padding: 24px 12px 8px; margin-top: 8px;
    }
    .unified-sidebar-nav .nav-item > a {
      display: flex; align-items: center; gap: 14px; padding: 12px 16px;
      color: #4b5563 !important; text-decoration: none !important;
      border-radius: 10px; font-size: 13.5px; font-weight: 500;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      margin-bottom: 2px;
    }
    /* Submenu li also needs active state */
    .unified-sidebar-nav .submenu li.active a {
      color: var(--color-accent-600, #009494) !important;
      background: rgba(0, 175, 176, 0.1) !important;
      font-weight: 600;
    }
    .unified-sidebar-nav .nav-item > a i { font-size: 18px; width: 22px; text-align: center; color: #9ca3af; }
    .unified-sidebar-nav .nav-item.has-submenu > a { position: relative; padding-right: 40px; }
    .unified-sidebar-nav .nav-item.has-submenu > a::after {
      content: "\f105"; font-family: "FontAwesome" !important; position: absolute; right: 20px;
      font-size: 12px; color: #9ca3af; transition: transform 0.2s ease;
    }
    .unified-sidebar-nav .nav-item.has-submenu > a[aria-expanded="true"]::after { transform: rotate(90deg); color: var(--color-accent-500, #00afb0); }
    .unified-sidebar-nav .nav-item > a:hover { background: rgba(0, 175, 176, 0.08) !important; color: var(--color-accent-600, #009494) !important; }
    .unified-sidebar-nav .nav-item > a:hover i { color: var(--color-accent-600, #009494); }
    .unified-sidebar-nav .nav-item.active > a { background: rgba(0, 175, 176, 0.1) !important; color: var(--color-accent-600, #009494) !important; font-weight: 600; }
    .unified-sidebar-nav .nav-item.active > a i { color: var(--color-accent-600, #009494); }
    .unified-sidebar-nav .submenu { list-style: none; padding: 4px 0 8px 36px; margin: 0; }
    .unified-sidebar-nav .submenu li a {
      display: block; padding: 7px 14px; color: #6b7280 !important;
      font-size: 12.8px; text-decoration: none !important; border-radius: 8px;
      transition: all 0.15s ease;
    }
    .unified-sidebar-nav .submenu li a:hover { color: var(--color-accent-600, #009494) !important; background: rgba(0, 175, 176, 0.05) !important; }

    /* --- Top Bar --- */
    .lz-topbar {
      height: 64px; background: #fff; border-bottom: 1px solid #e5e7eb;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 24px; position: sticky; top: 0; z-index: 30;
    }
    .lz-topbar-left { display: flex; align-items: center; gap: 16px; }
    .lz-topbar-left h1 { font-family: 'Outfit', 'Inter', sans-serif; font-weight: 600; font-size: 16px; color: #374151; margin: 0; }
    .lz-topbar-right { display: flex; align-items: center; gap: 12px; }
    .lz-topbar-right .lz-user-name { font-size: 14px; color: #9ca3af; }
    .lz-topbar-right .lz-avatar {
      width: 32px; height: 32px; border-radius: 50%; background: var(--color-accent-500, #00afb0);
      color: #fff; font-size: 12px; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
    }
    .lz-topbar .lz-toggle { border: none; background: none; padding: 8px; border-radius: 8px; color: #9ca3af; cursor: pointer; }
    .lz-topbar .lz-toggle:hover { background: #f3f4f6; }

    /* --- Main Content Wrapper --- */
    .lz-main { margin-left: 256px; min-height: 100vh; display: flex; flex-direction: column; }
    .lz-content { flex: 1; padding: 32px; max-width: 100%; width: 100%; margin: 0 auto; box-sizing: border-box; }

    /* --- Cards --- */
    .card, .wrapper {
      border-radius: 12px !important; border: 1px solid #e5e7eb !important;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04) !important; background: #fff;
    }
    .card-header {
      background: #fff !important; border-bottom: 1px solid #e5e7eb !important;
      border-radius: 12px 12px 0 0 !important; font-weight: 600;
    }

    /* --- Buttons --- */
    .btn-primary, .btn-info {
      background: linear-gradient(135deg, var(--color-accent-500, #00afb0), var(--color-accent-600, #009494)) !important;
      border-color: var(--color-accent-600, #009494) !important; color: #fff !important;
      border-radius: 8px !important; font-weight: 500;
    }
    .btn-primary:hover, .btn-info:hover {
      background: linear-gradient(135deg, var(--color-accent-600, #009494), var(--color-accent-700, #007a7a)) !important;
      border-color: var(--color-accent-700, #007a7a) !important;
    }
    .btn-danger { border-radius: 8px !important; }
    .btn-default, .btn-light { border-radius: 8px !important; border: 1px solid #d1d5db !important; }
    .btn-pos { background: var(--color-accent-500, #00afb0) !important; border-color: var(--color-accent-600, #009494) !important; color: #fff !important; border-radius: 6px !important; }

    /* --- Tables --- */
    .table thead th {
      background-color: #f9fafb !important; border-bottom: 2px solid #e5e7eb !important;
      color: #374151 !important; font-size: 12px !important; font-weight: 600 !important;
      text-transform: uppercase; letter-spacing: 0.5px;
    }
    .table td { vertical-align: middle !important; }

    /* --- Badges --- */
    .badge { border-radius: 6px !important; font-weight: 500 !important; padding: 4px 10px !important; font-size: 11px !important; }

    /* --- Miscellaneous --- */
    .content-inner {
      min-height: calc(100vh - 60px);
    }
    .breadcrumb { border-radius: 8px !important; }
    .form-group { margin-bottom: 1.25rem; }
    .form-group label { margin-bottom: 0.5rem; display: inline-block; font-weight: 600; font-size: 13px; color: #374151; }
    .form-control {
      border-radius: 8px !important;
      border: 1px solid #d1d5db !important;
    }
    .form-control:focus {
      border-color: var(--color-accent-500, #00afb0) !important;
      box-shadow: 0 0 0 3px rgba(0, 175, 176, 0.15) !important;
    }
    select.form-control, .bootstrap-select .btn {
      border-radius: 8px !important;
    }select.form-control { height: 38px !important; }
    .form-group { margin-bottom: 12px !important; }
    .form-group label { font-size: 13px !important; font-weight: 600 !important; color: #374151 !important; margin-bottom: 4px !important; }
    
    /* Modern Input Groups (Barcode fields, etc.) */
    .input-group-text, .input-group .btn { 
      background: var(--color-accent-50, #e6fafa) !important; border: 1px solid #d1d5db !important; color: var(--color-accent-700, #007a7a) !important;
      font-size: 13px !important; padding: 6px 12px !important; border-radius: 0 8px 8px 0 !important;
    }
    .input-group .form-control { border-radius: 8px 0 0 8px !important; border-right: none !important; }
    .input-group .form-control:focus + .input-group-append .btn, .input-group .form-control:focus + .input-group-append .input-group-text { border-color: var(--color-accent-500, #00afb0) !important; }
    .input-group-prepend .input-group-text, .input-group-prepend .btn { border-radius: 8px 0 0 8px !important; border-right: solid 1px #d1d5db !important; border-left: solid 1px #d1d5db !important; }
    .input-group-prepend + .form-control { border-radius: 0 8px 8px 0 !important; border-left: none !important; }

    /* --- Bootstrap Select (Selectpicker) --- */
    .bootstrap-select .btn {
      border-radius: 8px !important; border: 1px solid #d1d5db !important;
      height: 38px !important; padding: 6px 12px !important; font-size: 13px !important;
      background: #fff !important; color: #374151 !important; line-height: 1.5 !important;
    }
    .bootstrap-select .dropdown-toggle::after { margin-top: 0 !important; }
    .bootstrap-select .dropdown-menu {
      border-radius: 8px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.12) !important;
      border: 1px solid #e5e7eb !important; max-height: 250px !important; padding: 4px !important;
    }
    .bootstrap-select .dropdown-menu .inner { max-height: 220px !important; }
    .bootstrap-select .dropdown-menu li a {
      padding: 6px 12px !important; font-size: 13px !important; border-radius: 4px !important;
    }
    .bootstrap-select .dropdown-menu li a:hover { background: #f3f4f6 !important; }
    .bootstrap-select .dropdown-menu li.selected a { background: rgba(0, 175, 176, 0.1) !important; color: var(--color-accent-600, #009494) !important; }
    .bootstrap-select .bs-searchbox .form-control { height: 34px !important; }
    .breadcrumb { border-radius: 8px !important; }

    /* --- Modals --- */
    .modal-content { border-radius: 12px !important; border: none !important; box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important; }
    .modal-header { border-bottom: 1px solid #e5e7eb !important; border-radius: 12px 12px 0 0 !important; }
    .modal-footer { border-top: 1px solid #e5e7eb !important; }

    /* --- Dashboard Widgets --- */
    .widget-3 { border-radius: 12px !important; }
    /* Fix chart containers being too tall */
    .chart-container, .myChart, #revenueChart, #profitChart, #cashFlowChart {
      max-height: 350px !important;
    }
    canvas { max-height: 350px !important; }

    /* --- Fix Dropdown Overlaps --- */
    .dropdown-menu, .bootstrap-select .dropdown-menu { z-index: 9999 !important; }
    .bootstrap-select.show { z-index: 9999 !important; }

    /* --- Modernize Dashboard Widget Icons (Override inline colors) --- */
    .wrapper.count-title { 
      display: flex !important; align-items: center !important; padding: 24px !important; 
      background: #fff !important; border-radius: 12px !important; 
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05) !important; 
      margin-bottom: 20px !important; transition: transform 0.2s ease, box-shadow 0.2s ease !important; 
      border: 1px solid #f3f4f6 !important; 
    }
    .wrapper.count-title:hover { 
      transform: translateY(-3px) !important; 
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1) !important; 
    }
    .wrapper.count-title .icon { 
      width: 48px !important; height: 48px !important; border-radius: 12px !important; 
      display: flex !important; align-items: center !important; justify-content: center !important; 
      font-size: 24px !important; margin-right: 16px !important; 
      background: var(--color-accent-50, #e6fafa) !important; border: 1px solid var(--color-accent-100, #b3f0f0) !important; color: var(--color-accent-600, #009494) !important; 
    }
    .wrapper.count-title .icon i { color: var(--color-accent-600, #009494) !important; font-size: 22px !important; }
    .wrapper.count-title .count-number { font-size: 24px !important; font-weight: 700 !important; color: #111827 !important; line-height: 1.2 !important; }
    .wrapper.count-title .name strong { color: #6b7280 !important; font-size: 13px !important; font-weight: 500 !important; text-transform: uppercase !important; letter-spacing: 0.5px !important; }

    /* --- Responsive Dashboard Squeeze Fix --- */
    .dashboard-counts .count-title { min-height: auto !important; }
    @media (max-width: 1400px) { .dashboard-counts .col-sm-3 { flex: 0 0 50% !important; max-width: 50% !important; } }
    @media (max-width: 768px) { .dashboard-counts .col-sm-3 { flex: 0 0 100% !important; max-width: 100% !important; } }

    /* --- Modernize DataTable Action Buttons & Export Icons --- */
    .dt-buttons .btn { 
      background: #f9fafb !important; border: 1px solid #e5e7eb !important; 
      color: #4b5563 !important; border-radius: 6px !important; 
      margin-right: 8px !important; padding: 6px 14px !important; 
      transition: all 0.2s ease !important; font-size: 13px !important; 
    }
    .dt-buttons .btn:hover { background: var(--color-accent-50, #e6fafa) !important; border-color: var(--color-accent-400, #26d1d2) !important; color: var(--color-accent-700, #007a7a) !important; }
    .dt-buttons .btn i { color: inherit !important; margin-right: 4px !important; }

    .container-fluid { padding: 0 !important; }
    .content-inner { min-height: calc(100vh - 64px); }

    /* --- DataTable --- */
    .dataTables_wrapper { font-size: 13px !important; }
    table.dataTable thead th { font-size: 11px !important; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700 !important; color: #6b7280 !important; padding: 10px 12px !important; }
    table.dataTable tbody td { padding: 8px 12px !important; vertical-align: middle !important; font-size: 13px !important; }
    table.dataTable tbody tr:hover { background: rgba(0, 175, 176, 0.04) !important; }
    .dataTables_length select { height: 32px !important; font-size: 12px !important; padding: 2px 8px !important; }
    .dataTables_filter input { height: 34px !important; font-size: 13px !important; border-radius: 8px !important; }
    .dataTables_info { font-size: 12px !important; color: #9ca3af !important; }
    .dataTables_paginate .paginate_button { border-radius: 6px !important; font-size: 12px !important; }
    .dataTables_paginate .paginate_button.current { background: var(--color-accent-500, #00afb0) !important; color: #fff !important; border-color: var(--color-accent-500, #00afb0) !important; }
    div.dt-buttons { margin-bottom: 8px !important; }
    div.dt-buttons .dt-button { border-radius: 6px !important; font-size: 12px !important; padding: 4px 10px !important; }

    /* --- Filter Section --- */
    .filter-toggle { margin-bottom: 25px !important; }
    .card-body .row { display: flex !important; flex-wrap: wrap !important; align-items: stretch !important; margin-left: -10px !important; margin-right: -10px !important; }
    .card-body [class^="col-"] { 
        padding-left: 10px !important; padding-right: 10px !important; margin-bottom: 15px !important; 
        min-height: 70px !important; display: flex !important; flex-direction: column !important; justify-content: flex-end !important;
    }
    .bootstrap-select { width: 100% !important; display: block !important; }
    .bootstrap-select .btn { background: #fff !important; border-color: #d1d5db !important; width: 100% !important; }
    
    h5.mb-3, h5.mb-4 { font-size: 14px !important; font-weight: 600 !important; color: #6b7280 !important; margin-bottom: 10px !important; }

    /* --- Global Icon Fix --- */
    [class^="dripicons-"], [class*=" dripicons-"] {
      font-family: "dripicons-v2" !important;
      line-height: normal !important;
      vertical-align: middle !important;
      display: inline-block !important;
      color: inherit !important;
    }
    .fa, .fas, .far {
      font-family: "FontAwesome" !important; /* FA4 font-family */
      line-height: normal !important;
      vertical-align: middle !important;
      display: inline-block !important;
      color: inherit !important;
    }
    .dt-buttons .btn i { color: #4b5563 !important; font-size: 16px !important; }


    /* --- Page Header h1 on content pages --- */
    .page h1, section h1 { font-size: 18px !important; font-weight: 600 !important; }
    .page h2, section h2 { font-size: 16px !important; }

    /* --- Responsive sidebar toggle --- */
    @media (max-width: 1199px) { /* Adjust to 1199px which is common for laptops with scaling */
      .lz-sidebar { transform: translateX(-100%); transition: transform 0.2s ease; }
      .lz-sidebar.open { transform: translateX(0); box-shadow: 4px 0 20px rgba(0,0,0,0.5); }
      .lz-main { margin-left: 0 !important; }
      .lz-toggle-btn { display: flex !important; }
    }
    .lz-toggle-btn { 
        display: none; align-items: center; justify-content: center;
        background: transparent; border: none; font-size: 24px; color: #374151;
        cursor: pointer; padding: 4px; margin-right: 12px;
    }
    .lz-toggle-btn:hover { color: var(--color-accent-600, #009494); }

    /* --- Quick Action Dropdown in topbar --- */
    .lz-topbar .dropdown-menu { border-radius: 8px !important; box-shadow: 0 10px 40px rgba(0,0,0,0.12) !important; border: 1px solid #e5e7eb !important; }
    .lz-topbar .dropdown-item { font-size: 13px; padding: 8px 16px; }

    /* --- Print --- */
    @media print { .lz-sidebar, .lz-topbar { display: none !important; } .lz-main { margin-left: 0 !important; } }
  </style>
</head>

<body class="@if($theme == 'dark')dark-mode @endif" onload="myFunction()">
  <div id="loader"></div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- LenzBreeze Admin Shell                                  --}}
  {{-- ═══════════════════════════════════════════════════════ --}}

  {{-- Sidebar --}}
  <div class="lz-sidebar d-print-none">
    <div class="lz-sidebar-logo">
      <a href="{{ route('admin.dashboard') }}">
        <div class="lz-logo-icon"><span>LB</span></div>
        <span class="lz-logo-text">Admin</span>
      </a>
    </div>
    <div class="lz-sidebar-nav">
      @include('partials.unified-sidebar')
    </div>
    <div class="lz-sidebar-bottom">
      <a href="{{ route('home') }}" target="_blank">
        <i class="dripicons-web" style="font-size:16px;width:20px;text-align:center"></i>
        <span>View Website</span>
      </a>
      <form action="{{ route('logout') }}" method="POST" style="margin:0">
        @csrf
        <button type="submit">
          <i class="dripicons-power" style="font-size:16px;width:20px;text-align:center"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>

  {{-- Main --}}
  <div class="lz-main">
    {{-- Top Bar --}}
    @if(Route::current()->getName() != 'sale.pos')
    <div class="lz-topbar d-print-none">
      <div class="lz-topbar-left">
        <button type="button" class="lz-toggle-btn" onclick="document.querySelector('.lz-sidebar').classList.toggle('open')">
            <i class="dripicons-menu"></i>
        </button>
        <h1>@yield('page_title', 'Store Management')</h1>
      </div>
      <div class="lz-topbar-right">
        @php
          $category_permission_active = $role_has_permissions_list->where('name', 'category')->first();
          $add_permission_active = $role_has_permissions_list->where('name', 'products-add')->first();
          $purchase_add_permission_active = $role_has_permissions_list->where('name', 'purchases-add')->first();
          $sale_add_permission_active = $role_has_permissions_list->where('name', 'sales-add')->first();
          $expense_add_permission_active = $role_has_permissions_list->where('name', 'expenses-add')->first();
          $quotation_add_permission_active = $role_has_permissions_list->where('name', 'quotes-add')->first();
          $transfer_add_permission_active = $role_has_permissions_list->where('name', 'transfers-add')->first();
          $return_add_permission_active = $role_has_permissions_list->where('name', 'returns-add')->first();
          $purchase_return_add_permission_active = $role_has_permissions_list->where('name', 'purchase-return-add')->first();
          $user_add_permission_active = $role_has_permissions_list->where('name', 'users-add')->first();
          $customer_add_permission_active = $role_has_permissions_list->where('name', 'customers-add')->first();
          $biller_add_permission_active = $role_has_permissions_list->where('name', 'billers-add')->first();
          $supplier_add_permission_active = $role_has_permissions_list->where('name', 'suppliers-add')->first();
        @endphp
        {{-- Quick Add "+" Dropdown --}}
        <div class="dropdown" style="margin-right: 8px;">
          <a class="btn btn-sm btn-pos" type="button" data-toggle="dropdown" aria-expanded="false">
            <i class="dripicons-plus"></i>
          </a>
          <ul class="dropdown-menu">
            @if($category_permission_active)
            <li class="dropdown-item"><a data-toggle="modal" data-target="#category-modal">{{__('file.Add Category')}}</a></li>
            @endif
            @if($add_permission_active)
            <li class="dropdown-item"><a href="{{route('products.create')}}">{{__('file.add_product')}}</a></li>
            @endif
            @if($purchase_add_permission_active)
            <li class="dropdown-item"><a href="{{route('purchases.create')}}">{{trans('file.Add Purchase')}}</a></li>
            @endif
            @if($sale_add_permission_active)
            <li class="dropdown-item"><a href="{{route('sales.create')}}">Create Order</a></li>
            @endif
            @if($expense_add_permission_active)
            <li class="dropdown-item"><a data-toggle="modal" data-target="#expense-modal">{{trans('file.Add Expense')}}</a></li>
            @endif
            @if($quotation_add_permission_active)
            <li class="dropdown-item"><a href="{{route('quotations.create')}}">{{trans('file.Add Quotation')}}</a></li>
            @endif
            @if($transfer_add_permission_active)
            <li class="dropdown-item"><a href="{{route('transfers.create')}}">{{trans('file.Add Transfer')}}</a></li>
            @endif
            @if($return_add_permission_active)
            <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#add-sale-return">{{trans('file.Add Return')}}</a></li>
            @endif
            @if($purchase_return_add_permission_active)
            <li class="dropdown-item"><a href="#" data-toggle="modal" data-target="#add-purchase-return">{{trans('file.Add Purchase Return')}}</a></li>
            @endif
            @if($user_add_permission_active)
            <li class="dropdown-item"><a href="{{route('user.create')}}">{{trans('file.Add User')}}</a></li>
            @endif
            @if($customer_add_permission_active)
            <li class="dropdown-item"><a href="{{route('customer.create')}}">{{trans('file.Add Customer')}}</a></li>
            @endif
            @if($biller_add_permission_active)
            <li class="dropdown-item"><a href="{{route('biller.create')}}">{{trans('file.Add Biller')}}</a></li>
            @endif
            @if($supplier_add_permission_active)
            <li class="dropdown-item"><a href="{{route('supplier.create')}}">{{trans('file.Add Supplier')}}</a></li>
            @endif
          </ul>
        </div>
        @if($sale_add_permission_active)
        <a href="{{route('payment.index')}}" class="btn btn-sm btn-pos"><i class="dripicons-card"></i> Payment</a>
        <a href="{{route('sales.index')}}" class="btn btn-sm btn-pos"><i class="dripicons-shopping-bag"></i> Order List</a>
        <a href="{{route('sales.create')}}" class="btn btn-sm btn-pos"><i class="dripicons-cart"></i> Create Order</a>
        @endif
        <span class="lz-user-name">{{ ucfirst(Auth::user()->name) }}</span>
        <div class="lz-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
      </div>
    </div>
    @endif

    {{-- Page Content --}}
    <div class="lz-content">
      <div style="display:none" id="content" class="animate-bottom">
        @yield('content')
      </div>
    </div>
  </div>{{-- end .lz-main --}}

    <!-- notification modal -->
    <div id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Send Notification')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'notifications.store', 'method' => 'post', 'files'=> true]) !!}
            <div class="row">
              <?php
              $lims_user_list = DB::connection('salepro')->table('users')->where([
                ['is_active', true],
                ['id', '!=', \Auth::user()->id]
              ])->get();
              ?>
              <div class="col-md-4 form-group">
                <input type="hidden" name="sender_id" value="{{\Auth::id()}}">
                <label>{{trans('file.User')}} *</label>
                <select name="receiver_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select user...">
                  @foreach($lims_user_list as $user)
                  <option value="{{$user->id}}">{{$user->name . ' (' . $user->email. ')'}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label>{{trans('file.Reminder Date')}}</label>
                <input type="text" name="reminder_date" class="form-control date" value="{{date('d-m-Y')}}">
              </div>
              <div class="col-md-4 form-group">
                <label>{{trans('file.Attach Document')}}</label>
                <input type="file" name="document" class="form-control">
              </div>
              <div class="col-md-12 form-group">
                <label>{{trans('file.Message')}} *</label>
                <textarea rows="5" name="message" class="form-control" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary ">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end notification modal -->

    <!-- Category Modal -->
    <div id="category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          {!! Form::open(['route' => 'category.store', 'method' => 'post', 'files' => true, 'id' => 'category-form']) !!}
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Category')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>{{trans('file.name')}} *</label>
                {{Form::text('name',null,array('required' => 'required', 'class' => 'form-control', 'placeholder' => 'Type category name...'))}}
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Image')}}</label>
                <input type="file" name="image" class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Parent Category')}}</label>
                <select name="parent_id" class="form-control selectpicker" id="parent">
                  <option value="">No {{trans('file.parent')}}</option>
                  @foreach($categories_list as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              @if (\Schema::hasColumn('categories', 'woocommerce_category_id'))
              <div class="col-md-6 form-group mt-4">
                <input class="mt-3" name="is_sync_disable" type="checkbox" id="is_sync_disable" value="1">&nbsp; {{trans('file.Disable Woocommerce Sync')}}
              </div>
              @endif

              @if(in_array('ecommerce',explode(',',$general_setting->modules)))
              <div class="col-md-12 mt-3">
                <h6><strong>{{ __('For Website') }}</strong></h6>
                <hr>
              </div>

              <div class="col-md-6 form-group">
                <label>{{ __('Icon') }}</label>
                <input type="file" name="icon" class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <input class="mt-5" type="checkbox" name="featured" id="featured" value="1"> <label>{{ __('List on category dropdown') }}</label>
              </div>
              @endif
            </div>

            @if(in_array('ecommerce',explode(',',$general_setting->modules)))
            <div class="row">
              <div class="col-md-12 mt-3">
                <h6><strong>{{ __('For SEO') }}</strong></h6>
                <hr>
              </div>
              <div class="col-md-12 form-group">
                <label>{{ __('Meta Title') }}</label>
                {{Form::text('page_title',null,array('class' => 'form-control', 'placeholder' => 'Meta Title...'))}}
              </div>
              <div class="col-md-12 form-group">
                <label>{{ __('Meta Description') }}</label>
                {{Form::text('short_description',null,array('class' => 'form-control', 'placeholder' => 'Meta Description...'))}}
              </div>
            </div>
            @endif

            <div class="form-group">
              <input type="hidden" class="category-ajax-check" name="ajax" value="0">
              <button type="submit" class="btn btn-primary category-submit-btn">{{trans('file.submit')}}</button>
            </div>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    <!-- Category Modal -->

    <!-- expense modal -->
    <div id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Expense')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'expenses.store', 'method' => 'post']) !!}
            <?php
            $lims_expense_category_list = DB::connection('salepro')->table('expense_categories')->where('is_active', true)->get();
            if (Auth::user()->role_id > 2)
              $lims_warehouse_list = DB::connection('salepro')->table('warehouses')->where([
                ['is_active', true],
                ['id', Auth::user()->warehouse_id]
              ])->get();
            else
              $lims_warehouse_list = DB::connection('salepro')->table('warehouses')->where('is_active', true)->get();
            $lims_account_list = \App\Models\Account::where('is_active', true)->get();
            ?>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>{{trans('file.Date')}}</label>
                <input type="text" name="created_at" class="form-control date" placeholder="Choose date" />
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Expense Category')}} *</label>
                <select name="expense_category_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Expense Category...">
                  @foreach($lims_expense_category_list as $expense_category)
                  <option value="{{$expense_category->id}}">{{$expense_category->name . ' (' . $expense_category->code. ')'}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Warehouse')}} *</label>
                <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                  @foreach($lims_warehouse_list as $warehouse)
                  <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Amount')}} *</label>
                <input type="number" name="amount" step="any" required class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label> {{trans('file.Account')}}</label>
                <select class="form-control selectpicker" name="account_id">
                  @foreach($lims_account_list as $account)
                  @if($account->is_default)
                  <option selected value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                  @else
                  <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>{{trans('file.Note')}}</label>
              <textarea name="note" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end expense modal -->
    <!-- income modal start -->
    <div id="income-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Income')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'incomes.store', 'method' => 'post']) !!}
            <?php
            $lims_income_category_list = DB::connection('salepro')->table('income_categories')->where('is_active', true)->get();
            if (Auth::user()->role_id > 2)
              $lims_warehouse_list = DB::connection('salepro')->table('warehouses')->where([
                ['is_active', true],
                ['id', Auth::user()->warehouse_id]
              ])->get();
            else
              $lims_warehouse_list = DB::connection('salepro')->table('warehouses')->where('is_active', true)->get();
            $lims_account_list = \App\Models\Account::where('is_active', true)->get();
            ?>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>{{trans('file.Date')}}</label>
                <input type="text" name="created_at" class="form-control date" placeholder="Choose date" />
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Income Category')}} *</label>
                <select name="income_category_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Income Category...">
                  @foreach($lims_income_category_list as $income_category)
                  <option value="{{$income_category->id}}">{{$income_category->name . ' (' . $income_category->code. ')'}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Warehouse')}} *</label>
                <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" data-live-search-style="begins" title="Select Warehouse...">
                  @foreach($lims_warehouse_list as $warehouse)
                  <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('file.Amount')}} *</label>
                <input type="number" name="amount" step="any" required class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label> {{trans('file.Account')}}</label>
                <select class="form-control selectpicker" name="account_id">
                  @foreach($lims_account_list as $account)
                  @if($account->is_default)
                  <option selected value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                  @else
                  <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>{{trans('file.Note')}}</label>
              <textarea name="note" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- income modal end -->

    <!-- sale return modal -->
    <div id="add-sale-return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          {!! Form::open(['route' => 'return-sale.create', 'method' => 'get']) !!}
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Add Sale Return</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{trans('file.Sale Reference')}} *</label>
                  <input type="text" name="reference_no" class="form-control">
                </div>
              </div>
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end sale return modal -->

    <!-- purchase return modal -->
    <div id="add-purchase-return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          {!! Form::open(['route' => 'return-purchase.create', 'method' => 'get']) !!}
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">Add Purchase Return</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{trans('file.Purchase Reference')}} *</label>
                  <input type="text" name="reference_no" class="form-control">
                </div>
              </div>
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end purchase return modal -->

    <!-- account modal -->
    <div id="account-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Add Account')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'accounts.store', 'method' => 'post']) !!}
            <div class="form-group">
              <label>{{trans('file.Account No')}} *</label>
              <input type="text" name="account_no" required class="form-control">
            </div>
            <div class="form-group">
              <label>{{trans('file.name')}} *</label>
              <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
              <label>{{trans('file.Initial Balance')}}</label>
              <input type="number" name="initial_balance" step="any" class="form-control">
            </div>
            <div class="form-group">
              <label>{{trans('file.Note')}}</label>
              <textarea name="note" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end account modal -->

    <!-- account statement modal -->
    <div id="account-statement-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Account Statement')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'accounts.statement', 'method' => 'post']) !!}
            <div class="row">
              <div class="col-md-6 form-group">
                <label> {{trans('file.Account')}}</label>
                <select class="form-control selectpicker" name="account_id">
                  @foreach($lims_account_list as $account)
                  <option value="{{$account->id}}">{{$account->name}} [{{$account->account_no}}]</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label> {{trans('file.Type')}}</label>
                <select class="form-control selectpicker" name="type">
                  <option value="0">{{trans('file.All')}}</option>
                  <option value="1">{{trans('file.Debit')}}</option>
                  <option value="2">{{trans('file.Credit')}}</option>
                </select>
              </div>
              <div class="col-md-12 form-group">
                <label>{{trans('file.Choose Your Date')}}</label>
                <div class="input-group">
                  <input type="text" class="account-statement-daterangepicker-field form-control" required />
                  <input type="hidden" name="start_date" />
                  <input type="hidden" name="end_date" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end account statement modal -->

    <!-- warehouse modal -->
    <div id="warehouse-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Warehouse Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'report.warehouse', 'method' => 'post']) !!}

            <div class="form-group">
              <label>{{trans('file.Warehouse')}} *</label>
              <select name="warehouse_id" class="selectpicker form-control" required data-live-search="true" id="warehouse-id" data-live-search-style="begins" title="Select warehouse...">
                @foreach($lims_warehouse_list as $warehouse)
                <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end warehouse modal -->

    <!-- user modal -->
    <div id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.User Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'report.user', 'method' => 'post']) !!}
            <?php
            $lims_user_list = DB::connection('salepro')->table('users')->where('is_active', true)->get();
            ?>
            <div class="form-group">
              <label>{{trans('file.User')}} *</label>
              <select name="user_id" class="selectpicker form-control" required data-live-search="true" id="user-id" data-live-search-style="begins" title="Select user...">
                @foreach($lims_user_list as $user)
                <option value="{{$user->id}}">{{$user->name . ' (' . $user->phone. ')'}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end user modal -->

    <!-- biller modal -->
    <div id="biller-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Biller Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            <?php
            $lims_biller_list = DB::connection('salepro')->table('billers')->where('is_active', true)->get();
            ?>
            <div class="form-group">
              <label>{{trans('file.Biller')}} *</label>
              <select name="biller_id" class="selectpicker form-control" required data-live-search="true" id="user-id" data-live-search-style="begins" title="Select biller...">
                @foreach($lims_biller_list as $biller)
                <option value="{{$biller->id}}">{{$biller->name . ' (' . $biller->phone_number. ')'}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end biller modal -->

    <!-- customer modal -->
    <div id="customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Customer Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'report.customer', 'method' => 'post']) !!}
            <?php
            $lims_customer_list = DB::connection('salepro')->table('customers')->where('is_active', true)->get();
            ?>
            <div class="form-group">
              <label>{{trans('file.customer')}} *</label>
              <select name="customer_id" class="selectpicker form-control" required data-live-search="true" id="customer-id" data-live-search-style="begins" title="Select customer...">
                @foreach($lims_customer_list as $customer)
                <option value="{{$customer->id}}">{{$customer->name . ' (' . $customer->phone_number. ')'}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end customer modal -->

    <!-- customer group modal -->
    <div id="customer-group-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Customer Group Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'report.customer_group', 'method' => 'post']) !!}
            <?php
            $lims_customer_group_list = DB::connection('salepro')->table('customer_groups')->where('is_active', true)->get();
            ?>
            <div class="form-group">
              <label>{{trans('file.Customer Group')}} *</label>
              <select name="customer_group_id" class="selectpicker form-control" required data-live-search="true" id="customer-group-id" data-live-search-style="begins" title="Select customer group...">
                @foreach($lims_customer_group_list as $customer_group)
                <option value="{{$customer_group->id}}">{{$customer_group->name}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end customer group modal -->

    <!-- supplier modal -->
    <div id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
      <div role="document" class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="exampleModalLabel" class="modal-title">{{trans('file.Supplier Report')}}</h5>
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true"><i class="dripicons-cross"></i></span></button>
          </div>
          <div class="modal-body">
            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
            {!! Form::open(['route' => 'report.supplier', 'method' => 'post']) !!}
            <?php
            $lims_supplier_list = DB::connection('salepro')->table('suppliers')->where('is_active', true)->get();
            ?>
            <div class="form-group">
              <label>{{trans('file.Supplier')}} *</label>
              <select name="supplier_id" class="selectpicker form-control" required data-live-search="true" id="supplier-id" data-live-search-style="begins" title="Select Supplier...">
                @foreach($lims_supplier_list as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name . ' (' . $supplier->phone_number. ')'}}</option>
                @endforeach
              </select>
            </div>

            <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />
            <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{trans('file.submit')}}</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- end supplier modal -->
  </div>
  @if(!config('database.connections.saleprosaas_landlord'))
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
  @if(Route::current()->getName() == 'sale.pos')
  <script type="text/javascript" src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js') ?>"></script>
  @endif
  <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/charts-custom.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
  @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
  <script type="text/javascript" src="<?php echo asset('js/front_rtl.js') ?>"></script>
  @else
  <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
  @endif

  @if(Route::current()->getName() != '/')
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/moment.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/daterangepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/dropzone.js') ?>"></script>

  <!-- table sorter js-->
  @if( Config::get('app.locale') == 'ar')
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake_arabic.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts_arabic.js') ?>"></script>
  @else
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts.js') ?>"></script>
  @endif
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.buttons.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/jszip.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.bootstrap4.min.js') ?>">
    ">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.colVis.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.html5.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.printnew.js') ?>"></script>

  <script type="text/javascript" src="<?php echo asset('vendor/datatable/sum().js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  @endif
  @else
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>

  <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/charts-custom.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
  @if( Config::get('app.locale') == 'ar' || $general_setting->is_rtl)
  <script type="text/javascript" src="<?php echo asset('js/front_rtl.js') ?>"></script>
  @else
  <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
  @endif

  @if(Route::current()->getName() != '/')
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/moment.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/daterangepicker.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('js/dropzone.js') ?>"></script>

  <!-- table sorter js-->
  @if( Config::get('app.locale') == 'ar')
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake_arabic.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts_arabic.js') ?>"></script>
  @else
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts.js') ?>"></script>
  @endif
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/jquery.dataTables.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.buttons.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/jszip.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.bootstrap4.min.js') ?>">
    ">
  </script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.colVis.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.html5.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.printnew.js') ?>"></script>

  <script type="text/javascript" src="<?php echo asset('vendor/datatable/sum().js') ?>"></script>
  <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  @endif
  @endif
  @stack('scripts')

  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var theme = <?php echo json_encode($theme); ?>;
    if (theme == 'dark') {
      $('body').addClass('dark-mode');
      $('#switch-theme i').addClass('dripicons-brightness-low');
    } else {
      $('body').removeClass('dark-mode');
      $('#switch-theme i').addClass('dripicons-brightness-max');
    }
    $('#switch-theme').click(function() {
      if (theme == 'light') {
        theme = 'dark';
        var url = <?php echo json_encode(route('switchTheme', 'dark')); ?>;
        $('body').addClass('dark-mode');
        $('#switch-theme i').addClass('dripicons-brightness-low');
      } else {
        theme = 'light';
        var url = <?php echo json_encode(route('switchTheme', 'light')); ?>;
        $('body').removeClass('dark-mode');
        $('#switch-theme i').addClass('dripicons-brightness-max');
      }

      $.get(url, function(data) {
        console.log('theme changed to ' + theme);
      });
    });

    var alert_product = <?php echo json_encode($alert_product) ?>;

    if ($(window).outerWidth() > 1199) {
      $('nav.side-navbar').removeClass('shrink');
    }

    function myFunction() {
      setTimeout(showPage, 100);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("content").style.display = "block";
    }

    // $("div.alert").delay(4000).slideUp(30000);

    function confirmDelete() {
      if (confirm("Are you sure want to delete?")) {
        return true;
      }
      return false;
    }

    $("li#notification-icon").on("click", function(argument) {
      $.get('notifications/mark-as-read', function(data) {
        $("span.notification-number").text(alert_product);
      });
    });

    $("a#add-expense").click(function(e) {
      e.preventDefault();
      $('#expense-modal').modal();
    });

    $("a#add-income").click(function(e) {
      e.preventDefault();
      $('#income-modal').modal();
    });

    $("a#send-notification").click(function(e) {
      e.preventDefault();
      $('#notification-modal').modal();
    });

    $("a#add-account").click(function(e) {
      e.preventDefault();
      $('#account-modal').modal();
    });

    $("a#account-statement").click(function(e) {
      e.preventDefault();
      $('#account-statement-modal').modal();
    });

    $("a#profitLoss-link").click(function(e) {
      e.preventDefault();
      $("#profitLoss-report-form").submit();
    });

    $("a#report-link").click(function(e) {
      e.preventDefault();
      $("#product-report-form").submit();
    });

    $("a#purchase-report-link").click(function(e) {
      e.preventDefault();
      $("#purchase-report-form").submit();
    });

    $("a#sale-report-link").click(function(e) {
      e.preventDefault();
      $("#sale-report-form").submit();
    });
    $("a#sale-report-chart-link").click(function(e) {
      e.preventDefault();
      $("#sale-report-chart-form").submit();
    });

    $("a#payment-report-link").click(function(e) {
      e.preventDefault();
      $("#payment-report-form").submit();
    });

    $("a#warehouse-report-link").click(function(e) {
      e.preventDefault();
      $('#warehouse-modal').modal();
    });

    $("a#user-report-link").click(function(e) {
      e.preventDefault();
      $('#user-modal').modal();
    });

    $("a#biller-report-link").click(function(e) {
      e.preventDefault();
      $('#biller-modal').modal();
    });

    $("a#customer-report-link").click(function(e) {
      e.preventDefault();
      $('#customer-modal').modal();
    });

    $("a#customer-group-report-link").click(function(e) {
      e.preventDefault();
      $('#customer-group-modal').modal();
    });

    $("a#supplier-report-link").click(function(e) {
      e.preventDefault();
      $('#supplier-modal').modal();
    });

    $("a#due-report-link").click(function(e) {
      e.preventDefault();
      $("#customer-due-report-form").submit();
    });

    $("a#supplier-due-report-link").click(function(e) {
      e.preventDefault();
      $("#supplier-due-report-form").submit();
    });

    $(".account-statement-daterangepicker-field").daterangepicker({
      callback: function(startDate, endDate, period) {
        var start_date = startDate.format('YYYY-MM-DD');
        var end_date = endDate.format('YYYY-MM-DD');
        var title = start_date + ' To ' + end_date;
        $(this).val(title);
        $('#account-statement-modal input[name="start_date"]').val(start_date);
        $('#account-statement-modal input[name="end_date"]').val(end_date);
      }
    });

    $('.date').datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
      todayHighlight: true
    });

    $('.selectpicker').selectpicker({
      style: 'btn-link',
    });


    setInterval(function() {
      $.ajax({
        url: "{{route('session')}}",
        type: "POST",
        success: function(response) {
          //alert('session alive');
        },
      });
    }, 5000);

    // Auto-expand active submenus using Bootstrap's native collapse API
    $('.unified-sidebar-nav .nav-item.active .submenu.collapse').collapse('show');
  </script>
</body>

</html>


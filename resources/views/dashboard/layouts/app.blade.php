<!DOCTYPE html>
<html class="loading" class="loading" lang="{{app()->getLocale()}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title', trans('site.Awamer System'))</title>
    <link rel="apple-touch-icon" href="@if(isset($setting['favicon'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{ asset('assets/dashboard//app-assets/images/ico/favicon.ico') }} @endif">
    <link rel="shortcut icon" type="image/x-icon" href="@if(isset($setting['logo'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{ asset('assets/dashboard//app-assets/images/ico/favicon.ico') }} @endif">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">


@yield('before-styles')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/vendors/css/vendors'.appDirection().'.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/vendors/css/tables/ag-grid/ag-grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/vendors/css/tables/ag-grid/ag-theme-material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/pages/app-user.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/pages/aggrid.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css'.appDirection().'/custom'.appDirection().'.css') }}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/assets/css/style'.appDirection().'.css') }}">
    <!-- END: Custom CSS-->


@yield('styles')

</head>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<!-- BEGIN: Header-->
@include('dashboard.layouts.header')
<!-- END: Header-->


<!-- BEGIN: Side bar-->
@include('dashboard.layouts.side-bar')
<!-- END: Side bar-->

<!-- Main Content -->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/dashboard/app-assets/js/scripts/components.js')}}"></script>
<!-- END: Theme JS-->

<!-- SweetAlert js -->
<script src="{{asset('assets/dashboard//app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
<!-- End of SweetAlert js -->

<!-- toastr js -->
<script src="{{ asset('assets/web/scripts/includes/toastr.min.js') }}"></script>
<!-- End of toastr js -->

@if(session()->has('success'))
    toastr.success( "{{ session()->get('success') }}" )
@elseif(session()->has('error'))
    toastr.error("{{ session()->get('error') }}")
@endif
<!-- Request Errors -->
{{--@if($errors->any())--}}
{{--    toastr.error("{{ $errors->first() }}")--}}
{{--@endif--}}

@yield('scripts')

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/dashboard/app-assets/js/scripts/pages/app-user.js')}}"></script>
<!-- END: Page JS-->
</body>
</html>

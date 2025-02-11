<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Ticket Kenya') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.ts'])
    @yield('styles')
</head>

<body>
    <x-messages />
    <div class="wrapper">
        @include('includes.admin.main-header')
        @include('includes.admin.mainSidebar')
        {{-- Main content --}}
        <div class="main-panel">
            @yield('content')
            @include('includes.admin.main-footer')
        </div>
    </div>
    </div>

</body>
<script src="{{ asset('admin_assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/ready.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/demo.js') }}"></script>

@yield('scripts')

</html>

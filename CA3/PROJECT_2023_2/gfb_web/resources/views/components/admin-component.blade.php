<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gcit Facility Booking</title>
        <link href="{{ asset('welcome_assets/img/logo.png') }}" rel="icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('admin_assets/css/animate.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/jquery.mCustomScrollbar.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}"/>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/animate.css') }}"/>
        <link rel="stylesheet" href="{{ asset('admin_assets/css/sweetalert2.css') }}" />
        <link href="{{ asset('welcome_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('welcome_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/nav_style.css') }}">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.adminNav')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

 
    
   
    <!-- admin -->
    <script src="{{ asset('welcome_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_assets/js/apexcharts.js') }}"></script> --}}
   
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>
    {{-- <script src="{{ asset('admin_assets/js/chart-init.js') }}"></script> --}}
    <script src="{{ asset('admin_assets/js/sweetalert.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_assets/js/toastify-js.js') }}"></script>
    <script src="{{ asset('admin_assets/js/toastify-init.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    



</body>
</html>

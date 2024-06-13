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


        <link href="{{ asset('welcome_assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('user_dashboard/style.css') }}" rel="stylesheet">
        <link href="{{ asset('welcome_assets/css/style.css') }}" rel="stylesheet">
       
       
    </head>
    <body>
        
            @include('layouts.navigation')
            <!-- Page Content -->
            <main  id="main">
                {{ $slot }}
            </main>
    

        <!-- Vendor JS Files -->
    <script src="{{ asset('welcome_assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('welcome_assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('welcome_assets/js/main.js') }}"></script>
    </body>
</html>

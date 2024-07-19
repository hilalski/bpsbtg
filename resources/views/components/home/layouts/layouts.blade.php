<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicons Start -->
        <link href={{ asset('assets/img/favicon.png') }} rel="icon">
        <link href={{ asset('assets/img/favicon.png') }} rel="apple-touch-icon">
        <!-- Favicon End -->
      
        <title>PKL Politeknik Statistika STIS T.A 2023/2024</title>
        <meta content="" name="description">
      
        <meta content="" name="keywords">

        <!-- CSS Start -->
            <!-- Vendor CSS Start -->
            <link href={{ asset('assets/vendor/aos/aos.css') }} rel="stylesheet">
            <link href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }} rel="stylesheet">
            <link href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }} rel="stylesheet">
            <link href={{ asset('assets/vendor/glightbox/css/glightbox.min.css') }} rel="stylesheet">
            <link href={{ asset('assets/vendor/remixicon/remixicon.css') }} rel="stylesheet">
            <link href={{ asset('assets/vendor/swiper/swiper-bundle.min.css') }} rel="stylesheet">
            <!-- Vendor CSS End -->

            <!-- Main CSS Start -->
            <link href={{ asset("assets/css/palet.css")}} rel="stylesheet">
            <link href={{ asset('assets/css/home/style.css') }} rel="stylesheet">
            {{ $css ?? '' }} <!-- Slot CSS -->
            <!-- Main CSS End -->
        <!-- CSS End -->

        <!-- JS Start -->
        <!-- SweetAlert2 JS Start -->
        <script src={{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}></script>
        <!-- SweetAlert2 JS Start -->
        {{ $js_head ?? '' }} <!-- Slot JS Head -->
        <!-- JS End -->
      </head>

  
  <body>
    <x-home.partials.navbar />

    {{ $slot }} <!-- Slot -->

    <x-home.partials.footer />

    
    <!-- JavaScript Start -->
        <script src={{ asset('assets/vendor/aos/aos.js') }}></script>
        <script src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
        <script src={{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}></script>
        <script src={{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}></script>
        <script src={{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}></script>
        <script src={{ asset('assets/vendor/php-email-form/validate.js') }}></script>
        
        @if(session('status.success'))
            <x-elements.alert type="success" title="Berhasil" text="{{ session('status.success') }}"/>
        @endif

        @if(session('status.error'))
            <x-elements.alert type="error" title="Gagal" text="{{ session('status.error') }}"/>
        @endif
        <!-- Main JS Start -->
        <script src={{ asset('assets/js/home/main.js') }}></script>
        {{ $js ?? '' }} <!-- Slot JS -->
        <!-- Main JS End -->
    <!-- JavaScript End -->
  </body>
</html>
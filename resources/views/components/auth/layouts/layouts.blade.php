<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAGA-U</title>

    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <!-- CSS Start -->
        <!-- Bootstrap 5.3.2 CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}>
        <!-- Bootstrap 5.3.2 CSS End -->

        <!-- Fontawesome 6.4.2 CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/vendor/fontawesome/css/all.min.css') }}></link>
        <!-- Fontawesome 6.4.2 CSS End -->

        <!-- Main CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/css/auth/login.css') }}>
        {{ $css ?? '' }} <!-- Slot CSS -->
        <!-- Main CSS End -->

        <!-- Bootstrap Icons v1.11.1 CSS Start -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
        <!-- Bootstrap Icons v1.11.1 CSS End -->

        <!-- Vanilla CSS Start -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        {{ $css ?? '' }} <!-- Slot CSS -->
        <!-- Vanilla CSS End -->
    <!-- CSS End -->
  </head>

  
  <body>
    {{ $slot }} <!-- Slot -->
    
    <!-- JavaScript Start -->
        <!-- Fontawesome 6.4.2 JS Start -->
        <script type="text/javascript" src="{{ asset('assets/js/all.min.js') }}"></script>
        <!-- Fontawesome 6.4.2 JS End -->

        <!-- JQuery 3.7.1 JS Start -->
        <script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery-3.7.1.min.js') }}"></script>
        <!-- JQuery 3.7.1 JS End -->

        <!-- Bootstrap 5.3.2 JS Start -->
        <script type="text/javascript" src={{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
        <!-- Bootstrap 5.3.2 JS End -->

        <!-- Sweetalert JS Start -->
        <script type="text/javascript" src={{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}></script>
        <!-- Sweetalert JS End -->

        @if(session('status.success'))
            <x-elements.alert type="success" title="Berhasil" text="{{ session('status.success') }}"/>
        @endif

        @if(session('status.error'))
            <x-elements.alert type="error" title="Gagal" text="{{ session('status.error') }}"/>
        @endif
        <!-- Vanilla JS Start -->
        {{ $js ?? '' }} <!-- Slot JS -->
        <!-- Vanilla JS End -->
    <!-- JavaScript End -->
  </body>
</html>
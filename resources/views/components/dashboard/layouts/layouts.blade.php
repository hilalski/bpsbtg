<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem-3325 | Dashboard</title>

    <link href={{ asset('assets/img/logo2.png') }} rel="icon">
    <!-- CSS Start -->
        <!-- Bootstrap 5.3.2 CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}>
        <!-- Bootstrap 5.3.2 CSS End -->

        <!-- Select2 CSS Start -->
        <link href={{ asset('assets/vendor/select2/css/select2.min.css') }} rel="stylesheet" />
        <!-- Select2 CSS End -->

        <!-- Fontawesome 6.4.2 CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/vendor/fontawesome/css/all.min.css') }}></link>
        <!-- Fontawesome 6.4.2 CSS End -->

        <!-- Bootstrap Icons v1.11.1 CSS Start -->
        <link rel="stylesheet" type="text/css" href={{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}>
        <!-- Bootstrap Icons v1.11.1 CSS End -->

        <!-- Bootstrap Toggle CSS Start -->
        <link rel="stylesheet" href={{ asset('assets/vendor/bootstrap5-toggle/css/bootstrap5-toggle.min.css') }}>
        <!-- Bootstrap Icons v1.11.1 CSS End -->

        <!-- Datatables CSS Start -->
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
        <!-- Datatables CSS End -->

        <!-- Datepicker CSS Start -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Datepicker CSS End -->


        <!-- Vanilla CSS Start -->
        <link rel="stylesheet" href={{ asset("assets/css/palet.css")}}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets/css/style.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets/css/dashboard/dashboard.css') }}>
        <link rel="stylesheet" type="text/css" href={{ asset('assets/css/dashboard/main.css') }}>
        {{ $css ?? '' }} <!-- Slot CSS -->
        <!-- Vanilla CSS End -->
    <!-- CSS End -->

    <!-- JS Start -->
        <!-- Datatables JS Start -->
        <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script defer src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
        <script defer src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <!-- Datatables JS Start -->

        <!-- JQuery 3.7.1 JS Start -->
        <script type="text/javascript" src={{ asset('assets/vendor/jquery/jquery-3.7.1.min.js') }}></script>
        <!-- JQuery 3.7.1 JS End -->

        <script type="text/javascript" src={{ asset('assets/vendor/select2/js/select2.min.js') }}></script>
        {{ $js_head ?? '' }} <!-- Slot JS Head -->

        <script defer src="{{ asset('assets/js/dashboard/table.js') }}"></script>
        {{ $js_head ?? '' }} <!-- Slot JS Head -->
    <!-- JS End -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body>
    <x-dashboard.partials.navbar />
    <x-dashboard.partials.sidebar :menu="$menu"/>

    <main id="main-dashboard-siagau" class="min-vh-100">
        <x-dashboard.partials.breadcrumb :menu="$menu" />
        {{ $slot }} <!-- Slot -->
    </main>
    
    <x-dashboard.partials.footer />

    <!-- JavaScript Start -->
        <!-- Fontawesome 6.4.2 JS Start -->
        <script type="text/javascript" src={{ asset('assets/vendor/fontawesome/js/all.min.js') }}></script>
        <!-- Fontawesome 6.4.2 JS End -->

        {{-- Popper JS Start (untuk Popovers) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- Popper JS End --}}

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

        <!-- Bootstrap Toggle JS Start -->
        <script src={{ asset('assets/vendor/bootstrap5-toggle/js/bootstrap5-toggle.jquery.min.js') }}></script>
        <!-- Bootstrap Toggle JS End -->

        <!-- Sorting Datetime Moment JS Start -->
        <script type="text/javascript" src={{ asset('assets/vendor/moment/moment-with-locales.js') }}></script>
        <!-- Sorting Datetime Moment JS End -->

        <!-- Sorting Datetime Moment JS Start -->
        <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.13.7/sorting/datetime-moment.js"></script>
        <!-- Sorting Datetime Moment JS End -->

        <!-- Datepicker JS Start -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Datepicker JS End -->

        <!-- Vanilla JS Start -->
        <script type="text/javascript" src={{ asset('assets/js/dashboard/dashboard.js') }}></script>
        <script type="text/javascript" src={{ asset('assets/js/preloader.js') }}></script>
        <script type="text/javascript" src={{ asset('assets/js/rapat/rapat.js') }}></script>
        {{ $js_body ?? '' }} <!-- Slot JS Body -->

        {{-- <script>
            // Loader & Modal Poster Start
              /*
                  Loader Page
              */
              const loader = $("#preloader");
    
              $(window).on("load", function () {
                  loader.css("opacity", "0");
    
                  loader.on("transitionend", function () {
                      loader.css("display", "none");
                  }, { once: true });
              });
    
              /* 
                  Modal Poster
              */
    
              $(document).ready(function () {
    
                  // Cek session
                  const isSessionExist = false;
                  let isVisited = sessionStorage.getItem('firstVisit');
    
                  if (!isSessionExist && isVisited != 1) {
                      const modalPoster = document.getElementById('modal-poster');
                      const modal = new bootstrap.Modal(modalPoster);
                      modal.show();
                      sessionStorage.setItem('firstVisit', 1);
                  }
    
                  const images = ['/assets/img/home/poster1.png', '/assets/img/home/poster2.png', '/assets/img/home/poster3.png'];
                  let currentPhotoIndex = 0;
    
                  function updateImage() {
                      $("#modal-image").attr("src", images[currentPhotoIndex]);
                  }
    
                  $(".prev-btn").click(function () {
                      currentPhotoIndex = (currentPhotoIndex - 1 + images.length) % images.length;
                      updateImage();
                  });
    
                  $(".next-btn").click(function () {
                      currentPhotoIndex = (currentPhotoIndex + 1) % images.length;
                      updateImage();
                  });
              });
            // Loader & Modal Poster End
          </script> --}}
        {{ $js_body ?? '' }} <!-- Slot JS Body -->
        <!-- Vanilla JS End -->
    <!-- JavaScript End -->


  </body>
</html>

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href={{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }} rel="stylesheet">

    <!-- Fontawesome 6.4.2 CSS Start -->
    <link rel="stylesheet" href={{ asset('assets/vendor/fontawesome/css/all.min.css') }}></link>
    <!-- Fontawesome 6.4.2 CSS End -->


    <link href={{ asset("assets/img/logo-63.png")}} rel="icon">
    <!-- Template Main CSS File -->
    <link href={{ asset("assets/css/palet.css")}} rel="stylesheet">
    <link href={{ asset("assets/css/home/style-template.css")}} rel="stylesheet">
    <link href={{ asset("assets/css/home/style.css")}} rel="stylesheet">
    <title>Not Found</title>
    </head>

    <body>
        <main>
            <div class="container">
        
              <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <h1>Error 404</h1>
                <h2>Halaman Tidak Ditemukan.</h2>
                <button class="btn btn-info">
                    <a class="text-decoration-none text-light fw-semibold d-flex align-items-center justify-content-center gap-1"
                    href="/dashboard">
                        <i class="bi bi-arrow-left-square-fill"></i>
                        <span id="text-action-table-bau fw-bold">Kembali ke Beranda</span>
                    </a>
                </button>
              </section>
        
            </div>
          </main><!-- End #main -->

        <!-- JavaScript Start -->
            <!-- Fontawesome 6.4.2 JS Start -->
            <script type="text/javascript" src={{ asset('assets/vendor/fontawesome/js/all.min.js') }}></script>
            <!-- Fontawesome 6.4.2 JS End -->
        <!-- JavaScript End -->
    </body>
</html>

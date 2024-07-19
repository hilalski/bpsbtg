<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a class="navbar-brand d-flex align-items-center" href={{ route('home.index') }}>
            <img class="logo" src={{ asset('assets/img/favicon.png') }} width="55" height="55" alt="">
            <span class="ml-2 keterangan-logo d-flex flex-column">
            <span><strong>PKL POLSTAT STIS</strong></span>
            <span class="small">T.A. 2023/2024</span>
            </span>
        </a>
  
        <nav id="navbar" class="navbar">
            <ul>
            <li class="">
                <a class="nav-link scrollto {{ Request::is('/') ? 'active' : ''}}" href={{ route('home.index') }}>Beranda</a>
            </li>
            <li class="">
                <a class="nav-link scrollto {{ Request::is('berita') ? 'active' : ''}}" href={{ route('home.berita') }}>Berita</a>
            </li>
            <li class="">
                <a class="nav-link scrollto {{ Request::is('galeri') ? 'active' : ''}}" href={{ route('home.galeri') }}>Galeri</a>
            </li>
            <li class="">
                <a class="nav-link scrollto {{ Request::is('timeline') ? 'active' : ''}}" href={{ route('home.timeline') }}>Timeline</a>
            </li>
            <li class="">
                <a class="nav-link scrollto {{ Request::is('struktur') ? 'active' : ''}}" href={{ route('home.struktur') }}>Struktur</a>
            </li>
            <li class="not">
                <a class="getstarted scrollto" href={{ route('login') }}>SIKOKO</a>
            </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header>
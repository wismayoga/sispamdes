<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISPAM-Des</title>

    <!-- CSS FILES -->
    <link href="{{ asset('assets/landing/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/landing/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/landing/css/templatemo-kind-heart-charity.css') }}" rel="stylesheet">
    <style>
        .nav-item-visible {
            display: none;
            /* Initially hide the navigation element */
        }

        @media screen and (min-width: 992px) {
            .nav-item-visible {
                display: block;
                /* Show the navigation element on screens wider than 992px */
            }
        }

        .nav-items-visible2 {
            display: none;
            /* Initially hide the navigation elements */
        }

        @media screen and (max-width: 992px) {
            .nav-items-visible2 {
                display: block;
                /* Show the navigation elements on screens 992px or below */
            }
        }
    </style>
    <!--

TemplateMo 581 Kind Heart Charity

https://templatemo.com/tm-581-kind-heart-charity

-->

</head>

<body id="section_1">

    <header class="site-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12 d-flex flex-wrap">
                    <p class="d-flex me-4 mb-0">
                        <i class="bi-geo-alt me-2"></i>
                        Desa Kayuputih, Kecamatan Banjar, Kabupaten Buleleng, Bali 81152
                    </p>

                    <p class="d-flex mb-0">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:desakayuputih17@gmail.com">
                            desakayuputih17@gmail.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="https://web.facebook.com/pemerintahan.desakayuputih.14"  target="_blank" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="https://youtube.com/"  target="_blank" class="social-icon-link bi-youtube"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="https://wa.me/+6285892376114" target="_blank" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/landing/images/icon.png') }}" class="logo img-fluid p-3"
                    alt="Kind Heart Charity">
                <span>
                    SISPAM-DES
                    <small>Sistem Pendataan SPAM</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#top">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_2">Tentang Kami</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_4">Aplikasi Mobile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_6">Kontak</a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <div class="nav-items-visible2">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('dashboard') }}"><b>Dashboard</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </div>
                            <div class="nav-item-visible">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('dashboard') }}"><b>Dashboard</b></a>
                                </li>
                            </div>
                            <div class="nav-item-visible">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('logout') }}">Logout</a>
                                </li>
                            </div>
                        @else
                            <div class="nav-items-visible2">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('login') }}"><b>Login</b></a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('register') }}"><b>Registrasi</b></a>
                                </li> --}}
                            </div>
                            <div class="nav-item-visible">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('login') }}"><b>Login</b></a>
                                </li>
                            </div>
                            <div class="nav-item-visible">
                                {{-- <li class="nav-item">
                                    <a class="nav-link click-scroll" href="{{ route('register') }}"><b>Registrasi</b></a>
                                </li> --}}
                            </div>

                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <section class="hero-section hero-section-full-height">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 col-12 p-0">
                        <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/landing/images/slide') }}/01.jpeg"
                                        class="carousel-image" alt="...">

                                    {{-- <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Mudah1</h1>

                                        <p>Scan, Input, Upload semudah itu</p>
                                    </div> --}}
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/landing/images/slide') }}/03.jpeg"
                                        class="carousel-image" alt="...">

                                    {{-- <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Cepat</h1>

                                        <p>Langsung beres ditangan petugas pendata</p>
                                    </div> --}}
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/landing/images/slide') }}/04.jpeg"
                                        class="carousel-image" alt="...">

                                    {{-- <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Modern</h1>

                                        <p>Pendataan air menggunakan Mobile App</p>
                                    </div> --}}
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#hero-slide"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 text-center mx-auto">
                        <h2 class="mb-5">Selamat Datang di Website SISPAM-DES</h2>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="#" class="d-block">
                                <img src="{{ asset('assets/landing/images/icons') }}/mudah.png"
                                    class="featured-block-image img-fluid" alt="" width="128px">

                                <p class="featured-block-text"><strong>Mudah</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="#" class="d-block">
                                <img src="{{ asset('assets/landing/images/icons') }}/cepat.png"
                                    class="featured-block-image img-fluid" alt="" width="128px">

                                <p class="featured-block-text"><strong>Cepat</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="#" class="d-block">
                                <img src="{{ asset('assets/landing/images/icons') }}/modern.png"
                                    class="featured-block-image img-fluid" alt="" width="128px">

                                <p class="featured-block-text"><strong>Modern</strong></p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding section-bg" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="{{ asset('assets/landing/images') }}/image3.jpeg"
                            class="custom-text-box-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">Tentang Kami</h2>

                            <h5 class="mb-3">Sistem Pengelolaan Air Minum (SPAM)</h5>

                            <p class="mb-0">Merupakan Unit BUMDes Desa Kayuputih yang melakukan pengelolaan dan pelayanan air minum sudah berdiri sejak 2013 sampai sekarang. Unit yang menjamin ketersediaan pelayanan air minum yang memenuhi standar
                                kualitas air minum bagi masyarakat yang dikelola secara mandiri oleh Desa dan untuk Desa Kayuputih.</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box mb-lg-0">
                                    <h5 class="mb-3">Visi & Misi</h5>
                                    <ul class="custom-list mt-3 pb-5">
                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Menyediakan air bersih
                                        </li>

                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Mengelola sistem air
                                        </li>
                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Melayani masyarakat
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                                    <div class="counter-thumb">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="{{$users}}"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Total Pelanggan</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="{{$tahunBerdiri}}"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Tahun Berdiri</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="section-padding" id="section_3">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>Aplikasi Mobile</h2>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="https://drive.google.com/file/d/1Wm7NuxvDAPyx4Pu9brBjYU-7RemTGJqD/view?usp=drive_link">
                                <img src="{{ asset('assets/landing/images') }}/causes/petugas3.jpg"
                                class="custom-block-image img-fluid" alt="">
                            </a>
                            

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Petugas</h5>
                                    <p>Pendataan air minum dilakukan setiap bulan oleh petugas menggunakan Mobile App
                                        SISPAM-DES</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <a href="https://drive.google.com/file/d/1kQ1BZyy3FuN7dny1g2lRp7vlpQCnu3c3/view?usp=drive_link">
                                <img src="{{ asset('assets/landing/images') }}/causes/pengguna3.jpg"
                                    class="custom-block-image img-fluid" alt="">
                            </a>
                    
                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Pelanggan</h5>
                                    <p>Melihat jumlah tagihan dan melihat riwayat penggunaan air dapat dengan mudah dilihat di Mobile App SISPAM-DES</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </section>

        <section class="contact-section section-padding" id="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>Kontak</h2>
                    </div>
                    <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                        <div class="contact-info-wrap">
                            <h2>Informasi Pengelola</h2>

                            <div class="contact-image-wrap d-flex flex-wrap">
                                <img src="{{ asset('assets/landing/images') }}/slide/03.jpeg" class="img-fluid avatar-image"
                                    alt="">

                                <div class="d-flex flex-column justify-content-center ms-3">
                                    <p class="mb-0">Sistem Pengelola Air Minum BUMDes</p>
                                    <p class="mb-0"><strong>Manik Amerta Sari Desa Kayuputih</strong></p>
                                </div>
                            </div>

                            <div class="contact-info">
                                <h5 class="mb-3">Informasi Kontak</h5>

                                <p class="d-flex mb-2">
                                    <i class="bi-geo-alt me-2"></i>
                                    Desa Kayuputih, Kecamatan Banjar, Kabupaten Buleleng, Bali 81152
                                </p>

                                <p class="d-flex mb-2">
                                    <i class="bi-telephone me-2"></i>

                                    <a href="tel: +6285892376114">
                                        +62 858-9237-6114
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>

                                    <a href="mailto:desakayuputih17@gmail.com">
                                        desakayuputih17@gmail.com
                                    </a>
                                </p>

                                <a href="https://maps.app.goo.gl/G8T3zEvR1cXt24vB7" target="_blank" class="custom-btn btn mt-3">Google Map</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto">
                        <div class="news-block-body">

                            <blockquote>
                                Air adalah anugerah alam yang tak ternilai harganya, jadi simpanlah untuk masa depan.
                            </blockquote>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4">
                    <img src="{{ asset('assets/landing/images') }}/icon.png" class="logo img-fluid p-2"
                        alt="">
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <h5 class="site-footer-title mb-3">Pintasan</h5>

                    <ul class="footer-menu">
                        {{-- <li class="footer-menu-item"><i class="bi-journal-text me-2 text-white"></i><a
                                href="{{ route('register') }}" class="footer-menu-link">Registrasi</a></li> --}}

                        <li class="footer-menu-item"><i class="bi-box-arrow-in-right me-2 text-white"></i><a
                                href="{{ route('login') }}" class="footer-menu-link">Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Informasi Kontak</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        <a href="tel: +6285892376114" class="site-footer-link">
                            +62 858-9237-6114
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:desakayuputih17@gmail.com" class="site-footer-link">
                            desakayuputih17@gmail.com
                        </a>
                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        Desa Kayuputih, Kecamatan Banjar, Kabupaten Buleleng, Bali 81152
                    </p>

                    <a href="https://maps.app.goo.gl/G8T3zEvR1cXt24vB7" target="_blank" class="custom-btn btn mt-3">Google Map</a>
                </div>
            </div>
        </div>

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-7 col-12">
                        <p class="copyright-text mb-0">
                            SISPAM-DES © 2023
                            <br>
                            Sistem Pengelolaan Air Minum (SPAM)
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="https://web.facebook.com/pemerintahan.desakayuputih.14" target="_blank" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://youtube.com/" target="_blank" class="social-icon-link bi-youtube"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://wa.me/+6285892376114" target="_blank" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('assets/landing/js') }}/jquery.min.js"></script>
    <script src="{{ asset('assets/landing/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('assets/landing/js') }}/jquery.sticky.js"></script>
    <script src="{{ asset('assets/landing/js') }}/click-scroll.js"></script>
    <script src="{{ asset('assets/landing/js') }}/counter.js"></script>
    <script src="{{ asset('assets/landing/js') }}/custom.js"></script>

</body>

</html>

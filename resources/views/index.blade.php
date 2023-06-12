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

                        <a href="mailto:info@company.com">
                            Desakayuputih17@gmail.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube"></a>
                        </li>

                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
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
                        <a class="nav-link click-scroll" href="#section_4">Mobile App</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_6">Kontak</a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <div class="dropdown mt-2 pt-1">
                                    <button class="btn btn-primary-outline dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Halo, <b>{{ auth()->user()->nama }}</b>!
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <div class="dropdown mt-2 pt-1">
                                    <button class="btn btn-primary-outline dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <b>Masuk</b>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                        <a class="dropdown-item" href="{{ route('register') }}">Registrasi</a>
                                    </div>
                                </div>
                            </li>
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
                                    <img src="{{ asset('assets/landing/images/slide') }}/mudah.jpg"
                                        class="carousel-image" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Mudah</h1>

                                        <p>Scan, Input, Upload semudah itu</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/landing/images/slide') }}/cepat.jpg"
                                        class="carousel-image" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Cepat</h1>

                                        <p>Langsung beres ditangan petugas pendata</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="{{ asset('assets/landing/images/slide') }}/modern.jpg"
                                        class="carousel-image" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Modern</h1>

                                        <p>Pendataan air menggunakan Mobile App</p>
                                    </div>
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
                        <img src="{{ asset('assets/landing/images') }}/image1.jpg"
                            class="custom-text-box-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">Tentang Kami</h2>

                            <h5 class="mb-3">Sistem Pengelolaan Air Minum (SPAM)</h5>

                            <p class="mb-0">Unit yang menjamin ketersediaan pelayanan air minum yang memenuhi standar
                                kualitas air minum bagi masyarakat Desa Kayuputih</p>
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
                                            <span class="counter-number" data-from="1" data-to="846"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Total Pelanggan</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="10"
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
                        <h2>Mobile App</h2>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="custom-block-wrap">
                            <img src="{{ asset('assets/landing/images') }}/causes/petugas.jpg"
                                class="custom-block-image img-fluid" alt="">

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
                            <img src="{{ asset('assets/landing/images') }}/causes/pengguna.jpg"
                                class="custom-block-image img-fluid" alt="">

                            <div class="custom-block">
                                <div class="custom-block-body">
                                    <h5 class="mb-3">Pelanggan</h5>
                                    <p>Melihat jumlah tagihan dan melihat riwayat penggunaan air dapat dengan mudah
                                        dilihat di Mobile App SISPAM-DES</p>
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
                                <img src="https://i.pravatar.cc/150?img=3" class="img-fluid avatar-image"
                                    alt="">

                                <div class="d-flex flex-column justify-content-center ms-3">
                                    <p class="mb-0">Sistem Pengelola Air Minum</p>
                                    <p class="mb-0"><strong>Badan Usaha Milik Desa Kayuputih</strong></p>
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

                                    <a href="tel: 305-240-9671">
                                        305-240-9671
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>

                                    <a href="mailto:desakayuputih17@gmail.com">
                                        sesakayuputih17@gmail.com
                                    </a>
                                </p>

                                <a href="#" class="custom-btn btn mt-3">Google Map</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto">
                        <div class="news-block-body">

                            <blockquote>
                                Di dalam tetesan air terdapat kehidupan yang tak ternilai harganya. Jadikanlah setiap
                                tetesnya sebagai pengingat betapa berharganya sumber kehidupan ini, dan jaga air dengan
                                penuh kasih sayang.
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
                        <li class="footer-menu-item"><i class="bi-journal-text me-2 text-white"></i><a
                                href="{{ route('register') }}" class="footer-menu-link">Registrasi</a></li>

                        <li class="footer-menu-item"><i class="bi-box-arrow-in-right me-2 text-white"></i><a
                                href="{{ route('login') }}" class="footer-menu-link">Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Informasi Kontak</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        <a href="tel: 305-240-9671" class="site-footer-link">
                            305-240-9671
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:desakayuputih17@gmail.com" class="site-footer-link">
                            Desakayuputih17@gmail.com
                        </a>
                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        Desa Kayuputih, Kecamatan Banjar, Kabupaten Buleleng, Bali 81152
                    </p>

                    <a href="#" class="custom-btn btn mt-3">Google Map</a>
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
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-linkedin"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://youtube.com/templatemo" class="social-icon-link bi-youtube"></a>
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

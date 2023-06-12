<!DOCTYPE html>
<!--
Jampack
Author: Hencework
Contact: contact@hencework.com
-->
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="description" content="login" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .navbar-brands {
            color: var(--primary-color);
            font-size: var(--h6-font-size);
            font-weight: var(--font-weight-bold);
        }
    
        .navbar-brands span {
            display: inline-block;
            vertical-align: middle;
        }
    
        .logos {
            width: 40px;
            height: auto;
        }
    
        .navbar-brands small {
            color: var(--secondary-color);
            display: block;
            font-size: 10px;
            line-height: normal;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <!-- Wrapper -->
    <div class="hk-wrapper hk-pg-auth" data-footer="simple">
        <!-- Top Navbar -->
        <nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
            <div class="container-xxl">
                <!-- Start Nav -->
                <div class="nav-start-wrap">
                    <a class="navbar-brands" href="/">
                        <img src="{{ asset('assets/landing/images/icon.png') }}" class="logos img-fluid me-2" alt="Kind Heart Charity">
                        <span>
                            <b>SISPAM-DES</b>
                            <small>Sistem Pendataan SPAM</small>
                        </span>
                    </a>
                </div>
                <!-- /Start Nav -->

                <!-- End Nav -->
                <div class="nav-end-wrap">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item nav-link py-0">

                        </li>
                    </ul>
                </div>
                <!-- /End Nav -->
            </div>

        </nav>
        <!-- /Top Navbar -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Page Body -->
            <div class="hk-pg-body">
                <!-- Container -->
                <div class="container-xxl">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none v-separator separator-sm">
                            <div class="auth-content py-md-0 py-8">
                                <div class="row">
                                    <div class="col-xxl-9 col-xl-8 col-lg-11 text-center mx-auto">
                                        <img src="{{ asset('assets/landing/images/login.png') }}" class="img-fluid w-sm-40 w-50 mb-3"
                                            alt="login" />
                                        <h3 class="mb-2">Belum memiliki akun?</h3>
                                        <p class="w-xxl-65 w-100 mx-auto">Hubungi admin pengelola air minum desa dengan mengklik tombol dibawah. Ataupun anda bisa datang ke kantor BUMDes Desa Kayuputih untuk mendapatkan akun SISPAM-Des anda.</p>
                                        <a href="https://wa.me/6281338903870" target="_blank" class="btn btn-sm btn-primary btn-uppercase mt-4"><i class="bi-telephone me-2"></i> Hubungi Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-10 position-relative mx-auto">
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-wth-icon alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-icon-wrap">
                                        <i class="zmdi zmdi-bug"></i></i>
                                    </span> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="auth-content py-md-0 py-8">
                                <form class="w-100" action="{{ route('login.action') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-10 mx-auto">
                                            <h4 class="mb-4">Masuk menggunakan akun anda</h4>
                                            <div class="row gx-3">
                                                <div class="form-group col-lg-12">
                                                    <div class="form-label-group">
                                                        <label>Email</label>
                                                    </div>
                                                    <input class="form-control" placeholder="Masukan email anda"
                                                        value="" type="text" name="email">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div class="form-label-group">
                                                        <label>Password</label>
                                                    </div>
                                                    <div class="input-group password-check">
                                                        <span class="input-affix-wrapper">
                                                            <input class="form-control"
                                                                placeholder="Enter your password" value=""
                                                                type="password" name="password">
                                                            <a href="#" class="input-suffix text-muted">
                                                                <span class="feather-icon"><i class="form-icon"
                                                                        data-feather="eye"></i></span>
                                                                <span class="feather-icon d-none"><i class="form-icon"
                                                                        data-feather="eye-off"></i></span>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-uppercase btn-block mt-3">Login</button>
                                            <p class="p-xs mt-2 text-center">Silahkan tekan tombol login</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
                </div>
                <!-- /Container -->
            </div>
            <!-- /Page Body -->

            <!-- Page Footer -->
            <div class="hk-footer">
                <footer class="container-xxl footer">
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="footer-text"><span class="copy-text">SISPAM-DES © 2023 All rights reserved.</span>
                            </p>
                        </div>
                      
                    </div>
                </footer>
            </div>
            <!-- / Page Footer -->

        </div>
        <!-- /Main Content -->
    </div>
    <!-- /Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FeatherIcons JS -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Simplebar JS -->
    <script src="vendors/simplebar/dist/simplebar.min.js"></script>

    <!-- Init JS -->
    <script src="dist/js/init.js"></script>
</body>

</html>

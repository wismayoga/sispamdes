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
    <title>Register</title>
    <meta name="description"
        content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap." />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .navbar-brands {
            color: var(rgb(39, 39, 39)000);
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

        .btn-primary {
            background-color: #19A7CE;
            color: #fff;
            /* Set the text color for better contrast */
        }

        .button:hover {
            background-color: #146C94;
            /* transition: 0.7s; */
        }
    </style>
</head>

<body>
    <!-- Wrapper -->
    <div class="hk-wrapper hk-pg-auth" data-footer="simple">
        <!-- Main Content -->
        <div class="hk-pg-wrapper py-0">
            <div class="hk-pg-body py-0">
                <!-- Container -->
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row auth-split">
                        <div
                            class="col-xl-5 col-lg-6 col-md-5 d-md-block d-none bg-dark-20 bg-opacity-50 position-relative">
                            <img class="bg-img" src="{{ asset('assets/img') }}/registerBg.jpg" alt="bg-img">
                            <p class="p-xs text-white credit-text opacity-55">Created with <i class="bi-heart me-1"></i>
                                by <a target="blank" href="https://www.instagram.com/pergihari/">@pergihari</a> 2023
                            </p>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-7 col-sm-10 position-relative mx-auto">
                            <div class="auth-content flex-column pt-8 pb-md-8 pb-13">
                                <div class="text-center mb-7">
                                    <div class="nav-start-wrap">
                                        <a class="navbar-brands" href="/">
                                            <img src="{{ asset('assets/landing/images/icon.png') }}"
                                                class="logos img-fluid me-2" alt="Kind Heart Charity">
                                            <span>
                                                <b style="color: #29313E">SISPAM-DES</b>
                                                <small style="color: #728196">Sistem Pendataan SPAM</small>
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <form class="w-100" action="{{ route('register.action') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xxl-5 col-xl-7 col-lg-10 mx-auto">
                                            <h5 class="text-center mb-2" style="color: #909090">Form Registrasi</h5>
                                            <div class="row gx-3">
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Nama</label>
                                                    <input class="form-control" placeholder="Masukan nama"
                                                        value="" type="text" name="nama">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" placeholder="Masukan email"
                                                        value="" type="text" name="email">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Nomor HP</label>
                                                    <input class="form-control" placeholder="Masukan nomor HP"
                                                        value="" type="number" name="nomor_hp">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Email</label>
                                                    <textarea class="form-control" placeholder="Masukan alamat" value="" rows="3" name="alamat"></textarea>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Password</label>
                                                    <div class="input-group password-check">
                                                        <span class="input-affix-wrapper affix-wth-text">
                                                            <input autocomplete="new-password" class="form-control"
                                                                placeholder="Masukan password" value=""
                                                                type="password" name="password">
                                                            <a href="#"
                                                                class="input-suffix text-primary text-uppercase fs-8 fw-medium">
                                                                <span>Lihat</span>
                                                                <span class="d-none">Sembunyikan</span>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label class="form-label">Ulang Password</label>
                                                    <div class="input-group password-check">
                                                        <span class="input-affix-wrapper affix-wth-text">
                                                            <input autocomplete="new-password" class="form-control"
                                                                placeholder="Masukan ulang password" value=""
                                                                type="password" name="password_confirm">
                                                            <a href="#"
                                                                class="input-suffix text-primary text-uppercase fs-8 fw-medium">
                                                                <span>Lihat</span>
                                                                <span class="d-none">Sembunyikan</span>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button
                                                class="btn btn-primary btn-rounded btn-uppercase btn-block mt-3">Buat
                                                Akun</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Page Footer -->
                            <div class="hk-footer border-0">
                                <footer class="container-xxl footer">
                                    <div class="row">
                                        <div class="col-xl-8 text-center">
                                            <p class="footer-text pb-0"><span class="copy-text">SISPAM-DES ©
                                                    2023</span>
                                            </p>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                            <!-- / Page Footer -->
                        </div>
                    </div>
                    <!-- /Row -->
                </div>
                <!-- /Container -->
            </div>
            <!-- /Page Body -->
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

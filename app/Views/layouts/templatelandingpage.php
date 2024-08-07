<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title><?= $title; ?></title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/templates/assets2/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/templates/assets2/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/templates/assets2/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="/templates/assets2/img/favicons/favicon.ico">
    <link rel="manifest" href="/templates/assets2/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/templates/assets2/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="stylesheet" href="/templates/vendors/swiper/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&amp;family=Rubik:ital,wght@0,300..900;1,300..900family=Rubik:ital,wght@0,300..900;1,300..900&amp;display=swap" rel="stylesheet">
    <link href="/templates/assets2/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="/templates/assets2/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="/templates/assets2/css/user.min.css" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>
    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="content">
            <nav class="navbar navbar-expand-md fixed-top" id="navbar" data-navbar-soft-on-scroll="data-navbar-soft-on-scroll">
                <div class="container-fluid px-0"><a href="/"><img class="navbar-brand w-75 d-md-none" src="/templates/assets2/img/logos/logo.svg" alt="logo" /></a><a class="navbar-brand fw-bold d-none d-md-block" href="/">Inventory Unit Umum</a><button class="navbar-toggler border-0 pe-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-md-end" id="navbar-content" data-navbar-collapse="data-navbar-collapse">

                    </div>
                </div>
            </nav>
            <div data-bs-target="#navbar" data-bs-spy="scroll" tabindex="0">
                <section class="hero-section overflow-hidden position-relative z-0 mb-4 mb-lg-0" id="home">
                    <div class="hero-background">
                        <div class="container">
                            <div class="row gy-4 gy-md-8 pt-9 pt-lg-0">
                                <div class="col-lg-6 text-center text-lg-start">
                                    <h1 class="fs-2 fs-lg-1 text-white fw-bold mb-2 mb-lg-x1 lh-base mt-3 mt-lg-0">
                                        Kelola dan Ajukan <span class="text-nowrap">Inventory</span> dengan Mudah
                                    </h1>
                                    <p class="fs-8 text-white mb-3 mb-lg-4 lh-lg">
                                        Sistem kami memudahkan admin dalam mengelola stok barang dan memonitor persediaan secara real-time. Guest user juga dapat dengan mudah mengajukan permintaan barang yang dibutuhkan. Optimalkan pengelolaan inventaris Anda dan pastikan semua kebutuhan terpenuhi dengan cepat dan efisien.
                                    </p>

                                    <div class="d-flex justify-content-center justify-content-lg-start"><a class="btn btn-primary btn-lg lh-xl mb-4 mb-md-5 mb-lg-7" href="#!">Get Started</a></div>


                                </div>
                                <div class="col-lg-6 position-lg-relative">
                                    <div class="position-lg-absolute z-1 text-center"><img class="img-fluid chat-image" src="/templates/assets2/img/Hero/Landing page-amico.png" alt="" />
                                        <div class="position-absolute dots d-none d-md-block"> <img class="img-fluid w-50 w-lg-75" src="/templates/assets2/img/illustrations/Dots.webp" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 end-0 z-1"><img class="wave mb-md-n2" src="/templates/assets2/img/illustrations/Wave.svg" alt="" />
                        <div class="bg-white py-2 py-md-5"></div>
                    </div>
                </section>
                <section class="container border-bottom mb-8 mb-lg-10">
                    <div class="row pb-6 pb-lg-8 g-3 g-lg-8 px-3">
                        <div class="col-12 col-md-4">
                            <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":6,"prefix":"0"}'>0</h2>
                            <h6 class="fs-8 fw-normal lh-lg mb-0 opacity-70 text-center">Offices are available on different countries</h6>
                        </div>
                        <div class="col-12 col-md-4">
                            <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":238}'>0</h2>
                            <h6 class="opacity-70 fs-8 fw-normal lh-lg mb-0 text-center">Seats are available right now with support</h6>
                        </div>
                        <div class="col-12 col-md-4">
                            <h2 class="fs-3 fw-bold lh-sm mb-2 text-center" data-countup='{"endValue":1395,"autoIncreasing":true}'>0</h2>
                            <h5 class="opacity-70 fs-8 fw-normal lh-lg mb-0 text-center">People are using our co-work spaces right now</h5>
                        </div>
                    </div>
                </section>
            </div><button class="btn scroll-to-top text-white rounded-circle d-flex justify-content-center align-items-center bg-primary" data-scroll-top="data-scroll-top"><span class="uil uil-angle-up"></span></button>
        </div>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">NiceAdmin</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </main><!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->



    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="/templates/vendors/popper/popper.min.js"></script>
    <script src="/templates/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="/templates/vendors/is/is.min.js"></script>
    <script src="/templates/vendors/countup/countUp.umd.js"></script>
    <script src="/templates/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/templates/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/templates/assets2/js/theme.js"></script>
</body>

</html>
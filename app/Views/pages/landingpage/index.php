<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title><?= $title; ?></title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="/templates/assets/img/polibatam-logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/templates/assets/img/polibatam-logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/templates/assets/img/polibatam-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="/templates/assets/img/polibatam-logo.png">
    <link rel="manifest" href="/templates/assets2/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="/templates/assets/img/polibatam-logo.png">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <style>
        .dropdown-menu-left {
            left: 0 !important;
            right: auto !important;
        }

        .custom-btn {
            background-color: #007bff;
            /* Warna latar belakang */
            color: white;
            /* Warna teks */
        }

        .custom-btn:hover {
            background-color: #0056b3;
            /* Warna latar belakang saat hover, opsional */
            color: white;
            /* Warna teks saat hover, opsional */
        }
    </style>
    <style>
        .hero-section {
            position: relative;
        }

        .hero-section .btn {
            position: relative;
            z-index: 10;
            display: inline-block;
            /* or block if needed */
        }

        .text {
            color: white;
        }
    </style>

    <!-- ===============================================--><!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <div class="content">
            <nav class="navbar navbar-expand-md fixed-top" id="navbar" data-navbar-soft-on-scroll="data-navbar-soft-on-scroll">
                <div class="container-fluid px-0"><a href="/"><img class="navbar-brand w-75 d-md-none" src="/templates/assets2/img/logos/logo.svg" alt="logo" /></a><a class="navbar-brand fw-bold d-none d-md-block animate__animated animate__bounceIn" href="/">Inventory Unit Umum</a><button class="navbar-toggler border-0 pe-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-md-end" id="navbar-content" data-navbar-collapse="data-navbar-collapse">
                        <ul class="navbar-nav gap-md-2 gap-lg-3 pt-x1 pb-1 pt-md-0 pb-md-0" data-navbar-nav="data-navbar-nav">
                            <div class="d-grid gap-2 col-12 ms-auto">
                                <a class="btn btn-sm btn-primary" href="/auth/login">Login as Admin</a></li>

                                </li>
                            </div>
                        </ul>

                    </div>
                </div>
            </nav>

            <section class="hero-section overflow-hidden position-relative z-0 mb-4 mb-lg-0">
                <div class="hero-background">
                    <div class="container">
                        <div class="row gy-4 gy-md-8 pt-9 pt-lg-0">
                            <div class="col-lg-6 text-center text-lg-start">
                                <h1 class="fs-2 fs-lg-1 text-white fw-bold mb-2 mb-lg-x1 lh-base mt-3 mt-lg-0 animate__animated animate__backInDown">
                                    Kelola dan Ajukan <span class="text-nowrap">Inventory</span> dengan Mudah
                                </h1>
                                <p class="fs-8 text-white mb-3 mb-lg-4 lh-lg animate__animated animate__backInUp">
                                    Sistem kami memudahkan admin dalam mengelola stok barang dan memonitor persediaan secara real-time. Guest user juga dapat dengan mudah mengajukan permintaan barang yang dibutuhkan. Optimalkan pengelolaan inventaris Anda dan pastikan semua kebutuhan terpenuhi dengan cepat dan efisien.
                                </p>
                                <p class="text">Ingin Mengajukan Permintaan / Borang Barang? Silahkan
                                    <a class="btn btn-primary text-white" href="/permintaan/index" style="position: relative; z-index: 10;">Klik Disini</a>
                                </p>

                            </div>
                            <div class="col-lg-6 position-lg-relative">
                                <div class="position-lg-absolute z-1 text-center animate__animated animate__backInRight"><img class="img-fluid chat-image" src="/templates/assets2/img/Hero/Landing page-amico.png" alt="" />
                                    <div class="position-absolute dots d-none d-md-block"> <img class="img-fluid w-50 w-lg-75" src="/templates/assets2/img/illustrations/Dots.webp" alt="" /></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute bottom-0 start-0 end-0 z-1"><img class="wave mb-md-n2" src="/templates/assets2/img/illustrations/Wave.svg" alt="" />
                        <div class="bg-white py-2 py-md-5"></div>
                    </div>
            </section>
        </div><button class="btn scroll-to-top text-white rounded-circle d-flex justify-content-center align-items-center bg-primary" data-scroll-top="data-scroll-top"><span class="uil uil-angle-up"></span></button>
        </div>
        </section>
        <section class="bg-300" id="pricing">
            <div class="container py-8 py-lg-10">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7">
                        <h3 class="fs-4 fs-lg-3 fw-bold text-center mb-2 mb-lg-x1 lh-sm">Tentang Website </h3>
                    </div>
                    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                        <div class="card-body">
                            <p>
                                Selamat datang di Sistem E-Inventory Unit Umum Politeknik Negeri Batam!
                                Kami adalah tim yang berdedikasi untuk menyediakan solusi pengelolaan inventaris yang efisien dan akurat
                                melalui teknologi berbasis web. Sistem E-Inventory kami dirancang untuk memudahkan administrasi dan pengawasan stok barang, meminimalkan kesalahan pencatatan, dan memastikan ketersediaan informasi secara real-time.
                            </p>
                            <p>Terciptanya Sistem E-Inventory ini, Unit Umum Politeknik Negeri Batam dapat mengelola persediaan barang dengan lebih efisien, memastikan akurasi data, dan mendukung pengambilan keputusan yang lebih baik. Kami percaya bahwa dengan teknologi yang tepat, pengelolaan inventaris dapat menjadi lebih sederhana dan efektif, memungkinkan fokus yang lebih besar pada tugas-tugas inti lainnya.

                                Terima kasih telah mempercayakan kebutuhan inventaris Anda kepada kami. Kami siap membantu Anda mencapai efisiensi dan keakuratan dalam pengelolaan inventaris.</p>


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
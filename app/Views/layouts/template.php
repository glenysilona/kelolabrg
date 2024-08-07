<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/templates/assets/img/polibatam-logo.png" rel="icon">
    <link href="/templates/assets/img/polibatam-logo.png">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/templates/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/templates/assets/vendor/boxicons/css/boxicons.min.css" rel=" stylesheet">
    <link href="/templates/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/templates/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/templates/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/templates/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/templates/assets/css/style.css" rel="stylesheet">
    <style>
        .scrollable {
            max-height: 300px;
            /* Atur ketinggian maksimum sesuai kebutuhan */
            overflow-y: auto;
            /* Aktifkan overflow vertical jika konten melebihi ketinggian maksimum */
        }
    </style>

    <style>
        .nav-tabs-bordered .nav-link.active {
            background-color: #fff;
            color: #4154f1;
            border-bottom: 2px solid #4154f1;

        }

        .nav-link.active {
            background-color: #fff;
            color: #4154f1;
            border-bottom: 2px solid #4154f1;
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block text-center">Inventory UM</span>

            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                <?php if (session()->get('level') == '1') { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span id="stok-count" class="badge bg-primary badge-number">
                                <?php
                                $response = json_decode((new \App\Controllers\Notifikasi())->jumlahnotif());


                                if ($response && property_exists($response, 'count')) {
                                    $jumlahisinotif = $response->count;
                                    echo $jumlahisinotif;
                                } else {

                                    echo "Error: Invalid response format";
                                }
                                ?>
                            </span>

                        </a><!-- End Notification Icon -->
                    <?php } ?>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications scrollable " style="min-width: 300px;">
                        <li class="dropdown-header">
                            Notifications Stok Barang
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php
                        // panggil untuk fungsi method checkstocknotification() dari controller
                        $notif = (new \App\Controllers\Notifikasi())->checkStockNotification();
                        echo $notif; // tampilkan notifikasi 
                        ?>


                    </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->



                    <li class="nav-item dropdown pe-3">
                        <?php if (session()->get('level') == '1') { ?>
                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                                <img src="/imgdashboard/potouser.jpg" alt="Profile" class="rounded-circle">
                                <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('nama_user') ?></span>
                            </a><!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <h6><?= session()->get('nama_user') ?></h6>
                                    <span><?= session()->get('role') ?></span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/identitas/index"><i class="bi bi-person"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>


                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/auth/logout') ?>">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </li>
                            <?php } ?>

                            </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <?php if (session()->get('level') == '1') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed " href="/dashboard_admin/index">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/pages/barang/index">
                    <i class="bi bi-bag"></i>
                    <span>Barang</span>
                </a>
            </li>

            <?php if (session()->get('level') == '1') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/pages/satuan/index">
                        <i class="bi bi-grid-3x2-gap"></i>
                        <span>Satuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/pages/stokin/index">
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Stok In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/permintaan/index">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Stok Out</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed " href="/pages/pengajuan/index">
                        <i class="bi bi-cart-plus"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/laporan/index">
                        <i class="bi bi-journal-text"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                </li>

            <?php } ?>
            </li>
            <?php if (session()->get('level') !== '1') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/permintaan/index">
                        <i class="bi bi-filter-square"></i>
                        <span>Form Permintaan Barang</span>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/ajukanbrg/index">
                    <i class="bi bi-bag-plus"></i>
                    <span>Ajukan Barang</span>
                </a>
        </ul>
    </aside>


    <!-- End Sidebar-->
    <?= $this->renderSection('content') ?>
    <!-- ======= Footer ======= -->
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 83%;
            background-color: #f8f9fa;
        }
    </style>
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Inventory Umum</span></strong>. Developed by <strong>Glenys</strong>
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/templates/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/templates/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/templates/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/templates/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/templates/assets/vendor/quill/quill.min.js"></script>
    <script src="/templates/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/templates/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/templates/assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="/templates/assets/js/main.js"></script>
    <!-- Di dalam halaman HTML Anda -->
    <script>
        const evtSource = new EventSource("/barang/sse");

        evtSource.onmessage = function(event) {
            // Tampilkan pesan notifikasi ke pengguna
            alert(event.data);
        };
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: "<?php echo site_url('/Notifikasi/checkStockNotification'); ?>",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var notification = response.notification;
                        if (notification !== '') {
                            $('#stok-count').text(notification);
                        }
                    }
                });
            }, 5000);
        });
    </script>

    <!-- Di dalam tag <script> -->
    <!-- Di dalam tag <script> -->
    <!-- Di dalam tag <script> -->
    <script>
        // Fungsi untuk memperbarui jumlah notifikasi di dalam badge
        function updateNotificationCount() {
            // Panggil endpoint di controller Anda untuk mengambil jumlah notifikasi
            // Anda mungkin perlu menyesuaikan ini tergantung pada framework atau platform yang Anda gunakan
            fetch('/Notifikasi/checkStockNotification')
                .then(response => response.json())
                .then(data => {
                    // Update nilai dalam badge dengan jumlah notifikasi baru
                    document.getElementById('stok-count').textContent = data.count;
                })
                .catch(error => console.error('Error updating notification count:', error));
        }

        // Panggil fungsi updateNotificationCount() saat halaman dimuat
        window.onload = updateNotificationCount;
    </script>


</body>

</html>
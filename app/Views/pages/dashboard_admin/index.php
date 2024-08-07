<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <!-- <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav> -->
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SELAMAT DATANG DI WEBSITE INVENTORY <span class="text-primary text-bold fs-5"> <?= session()->get('nama_user') ?></span></h5>

                    </div>

                </div>
            </div>
            <div class="row">
                <div>
                    <div class="card mb-3" style="max-width: 100rem;">
                        <div class="row g-0">
                            <p class="card-header">Profile Pegawai Admin</p>
                            <div class="col-md-4 d-flex align-items-center">
                                <div style="width: 100%; max-width: 200px; height: auto; overflow: hidden; margin: 0 auto; margin-bottom: 10px;">
                                    <img class="img-fluid" src="/imgdashboard/potouser.jpg" alt="profile" style="width: 75%; height: 75%; object-fit: cover;" width="80" height="80">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div>
                                        <h4 class="mt-2 mt-md-0 display-6"> <?= session()->get('nama_user') ?></h4>
                                    </div>
                                    <h4 class="mt-3 h5"><?= session()->get('id_user') ?></h4>
                                    <h4 class="mt-3 h5"><?= session()->get('email') ?></h4>
                                    <h4 class="mt-3 h5"><?= session()->get('Unit') ?></h4>
                                    <h4 class="mt-3 h5"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>
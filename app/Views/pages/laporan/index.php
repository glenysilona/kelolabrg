<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan</h1>
        <!-- <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav> -->
    </div>
    <!-- End Page Title -->

    <section class="section" style="height: 100vh;  align-items: center; justify-content: center;">
        <div class="row" style="width: 100%;">
            <div class="col-lg-12 d-flex justify-content-center">
                <div>
                    <h5 class="card-title text-center">Cetak laporan</h5>
                    <div class="card" style="width: 25rem; height: 15rem;">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                            <h5 class="card-title">Pilih Laporan :</h5>
                            <p class="card-text">
                                <a type="button" class="btn btn-success mt-2" href="/laporan/cetakstokin">Laporan Stock In</a>
                            </p>
                            <p class="card-text">
                                <a type="button" class="btn btn-success mt-2" href="/laporan/cetaksisabarang">Laporan Sisa Barang</a>
                            </p>
                            <p class="card-text">
                                <a type="button" class="btn btn-success mt-2" href="/laporan/cetakstokout">Laporan Stock Out</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</main>
<?= $this->endSection(); ?>
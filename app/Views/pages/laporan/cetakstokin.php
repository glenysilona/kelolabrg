<?= helper('form'); ?>
<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cetak laporan Stock In</h5>
                        <div class="container text-center">
                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header bg-primary text-white">Pilih Periode</div>
                                <div class="card-body bg-white">
                                    <p class="card-text">
                                        <?php echo form_open('/laporan/cetak_stok_in_periode', ['target' => '_blank']); ?>
                                    <div class="form-group">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" name="tglawal" id="tglawal" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="tglakhir" id="tglakhir" class="form-control" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-printer"></i> Cetak Laporan Barang Masuk</button>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </p>
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
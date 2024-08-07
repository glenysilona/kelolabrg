<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Menambahkan Satuan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br />

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Table with stripped rows -->
                        <form action="/satuan/save" class="row g-3" method="POST">
                            <?= csrf_field(); ?>

                            <div class="col-12">
                                <label for="nama_barang" class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/satuan/index" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>


            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>
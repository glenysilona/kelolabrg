<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Edit / Update Data Satuan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">


                        <!-- Table with stripped rows -->
                        <form action="/satuan/update/<?= $satuanbrg['satuid']; ?>" class="row g-3" method="POST">
                            <?= csrf_field(); ?>

                            <div class="col-12">
                                <label for="nama_barang" class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control" name="nama_satuan" id="nama_satuan" value="<?= $satuanbrg['nama_satuan']; ?>">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/satuan" class="btn btn-secondary">Reset</a>
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
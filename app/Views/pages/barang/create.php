<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Barang </h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <br />
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <form action="/barang/save" class="row g-3" method="POST">
                            <?= csrf_field(); ?>


                            <div class="col-12">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="col-12">
                                <label for="total" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga" required>
                            </div>
                            <!-- <div class="col-12">
                                <label for="total" class="form-label">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" id="jumlah">
                            </div> -->
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="country">
                                <i class="dropdown icon"></i>

                                <div class="col-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" required></textarea>

                                </div>
                                <div class="col-12">
                                    <label for="satuid" class="form-label">Satuan</label>
                                    <select class="form-select" aria-label="Default select example" name="satuid" id="satuid" required>
                                        <option value="">Pilih Satuan</option>
                                        <?php foreach ($satuanbrg as $key => $value) { ?>
                                            <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>">
                                                <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    <a type="button" href="/pages/barang/index" class="btn btn-secondary mt-3">Kembali</a>
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
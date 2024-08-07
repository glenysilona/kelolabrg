<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Tambah Stok Out </h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= site_url('/permintaan/proses') ?>" class="row g-3" method="POST">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label class="form-label">Nama Barang</label>
                                <select class="form-control" name="id" id="id">
                                    <option>Pilih</option>
                                    <?php foreach ($barang as $value) { ?>
                                        <option value="<?= isset($value['id']) ? $value['id'] : '' ?>" aria-required="true">
                                            <?= isset($value['nama']) ? $value['nama'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty" value="<?= old('qty', $stok_keluar['qty'] ?? ''); ?>">

                            </div>

                            <div class="col-12">
                                <label for="tglkeluar" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control" name="tglkeluar" id="tglkeluar">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="out_stok">Submit</button>
                                <a type="button" href="/stokout/index" class="btn btn-warning">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>
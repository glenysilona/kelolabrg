<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Pengajuan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <br />
                        <?php if (session()->getFlashdata('pesan')) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>
                        <!-- Table with stripped rows -->
                        <form action="<?= base_url('/pengajuan/update/' . $pengajuan['kode_pengajuan']) ?>" method="post">
                            <?= csrf_field(); ?>

                            <div class="col-12">
                                <label for="inputNama" class="form-label">Nama Barang</label>
                                <select class="form-control" name="id" id="id">
                                    <?php
                                    $selectedId = isset($pengajuan['id']) ? $pengajuan['id'] : '';
                                    foreach ($barang as $key => $data) {
                                    ?>
                                        <option value="<?= $data['id'] ?>" <?= $data['id'] == $selectedId ? 'selected' : '' ?>>
                                            <?= $data['nama'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty" value="<?= $pengajuan['qty'] ?>" />
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pengajuan/index" class="btn btn-warning">Kembali</a>
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
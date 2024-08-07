<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Stok In</h1>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Stok In</h5>
                            <?php if (session()->get('level') == '1') {  ?>
                                <a type="button" class="btn btn-primary" href="/stokin/tambah/"> + Tambah Stok In</a>
                            <?php } ?>

                            <br />
                            <br />
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php endif; ?>
                            <?php if (session()->getFlashdata('pesan1')) : ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('pesan1') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('pesan2')) : ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('pesan2') ?>
                                </div>
                            <?php endif; ?>


                            <table class="table datatable table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            ID Masuk
                                        </th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($stok_masuk as $data) : ?>
                                        <tr>
                                            <td><?= $counter++; ?></td>
                                            <td><?= $data->id_stokin ?></td>
                                            <td><?= $data->nama ?></td>
                                            <td><?= $data->qty ?></td>
                                            <td><?= $data->nama_satuan ?></td>
                                            <td><?= $data->tglmasuk ?></td>

                                            <td>

                                                <a type="button" class="btn btn-danger" href="<?= site_url('/stokin/stokin_del/' . $data->id_stokin . '/' . $data->id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"> Hapus</a>

                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
</main>
<?= $this->endSection(); ?>
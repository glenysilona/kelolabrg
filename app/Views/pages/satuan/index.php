<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Satuan</h1>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Satuan</h5>
                            <a type="button" class="btn btn-primary" href="/pages/satuan/create"> + Tambah Satuan</a>
                            <br />

                            <br />
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <!-- Table with stripped rows -->
                            <table class="table datatable table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>
                                            Kode Satuan
                                        </th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($satuanbrg as $data) : ?>
                                        <tr>
                                            <td><?= $counter++; ?></td>
                                            <td><?= $data['satuid'] ?></td>
                                            <td><?= $data['nama_satuan'] ?></td>
                                            <td>
                                                <a type="button" href="/satuan/edit_satuan/<?= $data['satuid'] ?>" class="btn btn-info">Edit Data</a>
                                                <a type="button" href="/satuan/delete/<?= $data['satuid'] ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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
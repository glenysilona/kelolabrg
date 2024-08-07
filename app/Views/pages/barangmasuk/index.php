<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Barang Masuk</h1>
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
                        <h5 class="card-title">Data Barang Masuk</h5>
                        <a href="/barangmasuk/create" type="button" class="btn btn-primary mb-3"> + Tambah Barang</a>
                        <!-- Table with stripped rows -->
                        <br />
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                        <?php endif; ?>


                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>
                                        Kode Barang
                                    </th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                    <th data-type="date" data-format="YYYY/MM/DD">Tanggal</th>
                                    <th>Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($barangmasuk as $key => $data) : ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><?= $data->kode_barang ?></td>
                                        <td><?= $data->nama_barang ?></td>
                                        <td><?= $data->jumlah ?></td>
                                        <td><?= $data->nama_satuan ?></td>

                                        <td><?= $data->harga ?></td>
                                        <td><?= $data->total ?></td>
                                        <td><?= $data->keterangan ?></td>
                                        <td><?= $data->tanggal ?></td>

                                        <td>
                                            <a href="/barangmasuk/edit_masuk/<?= $data->kode_barang ?>" class="btn btn-info">Edit Data</a>
                                            <a href="/barangmasuk/delete/<?= $data->kode_barang ?>" type="button" class="btn btn-danger">HAPUS</a>
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
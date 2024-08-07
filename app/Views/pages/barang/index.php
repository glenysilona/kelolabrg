<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>


<main id="main" class="main">
    <div class="pagetitle">
        <h1>Barang </h1>
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
                        <h5 class="card-title">Data Barang </h5>
                        <?php if (session()->get('level')  == '1') { ?>
                            <a href="/barang/create" type="button" class="btn btn-primary mb-3"> + Tambah Barang</a>
                            <!-- Table with stripped rows -->
                            <br />
                        <?php } ?>
                        <?php if (session()->get('level') == '1') { ?>
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('pesan'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php endif; ?>
                        <?php } ?>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>
                                        ID Barang
                                    </th>
                                    <th>Nama Barang</th>

                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Jumlah</th>
                                    <th>satuan</th>
                                    <th>Keterangan</th>
                                    <?php if (session()->get('level') == '1') { ?>
                                        <th>Aksi</th>
                                    <?php } ?>
                                </tr>

                            </thead>
                            <tbody>

                                <?php $counter = 1; ?>
                                <?php foreach ($barang as $key => $data) : ?>
                                    <tr key="<?= $key; ?>">
                                        <td><?= $counter++; ?></td>
                                        <td>
                                            <?= $data->id ?>
                                        </td>
                                        <td><?= $data->nama ?></td>
                                        <td>Rp.<?= number_format((float)$data->harga, 0, ',', '.') ?></td> <!-- Format harga -->
                                        <td>Rp.<?= number_format((float)$data->harga * (int)$data->jumlah, 0, ',', '.') ?></td> <!-- Hitung dan format total -->
                                        <td><?= $data->jumlah ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                                        <td><?= $data->keterangan ?></td>


                                        <?php if (session()->get('level') == '1') { ?>
                                            <td>
                                                <a type="button" href="/barang/edit/<?= $data->id ?>" class="btn btn-info">Edit Data</a>
                                                <a href="/barang/delete/<?= $data->id ?>" type="button" class="btn btn-danger mt-2" onclick="return confirm('Apakah Boss yakin ingin menghapus data ini ?');">HAPUS</a>
                                            </td>
                                        <?php } ?>
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
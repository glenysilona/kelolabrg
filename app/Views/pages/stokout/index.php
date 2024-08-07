<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Stok Out</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Stok Out</h5>

                        <a href="/stokout/tambah" type="button" class="btn btn-primary mb-3"> + Tambah Borang Barang</a>

                        <br />
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <?php
                            $warnaalert = 'success'; //default warnalert
                            if (session()->getFlashdata('warnaalert')) {
                                $warnaalert = session()->getFlashdata('warnaalert');
                            }
                            ?>
                            <div class="alert alert-<?= $warnaalert ?> alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->has('pesan')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('warnaalert') ?>" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>

                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Permintaan</th>
                                    <th>Nama Unit</th>
                                    <th>Ketua Unit</th>
                                    <th>Nama Penerima</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Uraian</th>
                                    <th data-type="date" data-format="YYYY/MM/DD">Tanggal Keluar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permintaan as $data) : ?>
                                    <tr>
                                        <td><?= $data->id_minta ?></td>
                                        <td>
                                            <?= $data->nama_bagian ?>
                                        </td>
                                        <td><?= $data->ketua_bagian ?></td>
                                        <td><?= $data->nama_penerima ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->qty ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                                        <td><?= $data->uraian ?></td>
                                        <td><?= $data->tglminta ?></td>

                                        <td>
                                            <a type="button" class="btn btn-danger" href="<?= site_url('/permintaan/permintaan_del/' . $data->id_minta . '/' . $data->id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"> Hapus</a>
                                            P
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?= $this->endSection(); ?>
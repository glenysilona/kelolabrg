<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <?php if (session()->get('level') == '1') { ?>
            <h1>Stok Out</h1>
        <?php } else { ?>
            <h1>Permintaan</h1>
        <?php } ?>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php if (session()->get('level') == '1') { ?>
                            <h5 class="card-title">Data Stok Out</h5>
                        <?php } else { ?>
                            <h5 class="card-title">Data Permintaan</h5>
                        <?php } ?>



                        <a href="/permintaan/create" type="button" class="btn btn-primary mb-3"> + Tambah Borang Barang</a>

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
                                    <th data-type="date" data-format="YYYY/MM/DD">Tanggal Pengajuan</th>
                                    <?php if (session()->get('level') == '1') : ?>
                                        <th>Status</th>
                                    <?php endif; ?>
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
                                        <?php if (session()->get('level') == '1') : ?>
                                            <td>
                                                <?php if ($data->status == 0) : ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi" data-permintaan="<?= $data->id_minta ?>">
                                                        Konfirmasi Status
                                                    </button>
                                                <?php elseif ($data->status == 1) : ?>
                                                    <span class="badge bg-success">Sudah Diambil</span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php if (session()->get('level') == '1') : ?>
                                                <?php if ($data->status == 0) : ?>
                                                    <a type="button" class="btn btn-info" href="<?= site_url('/permintaan/edit/' . $data->id_minta . '/' . $data->id) ?>"> Edit Data</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($data->status == 0) : ?>
                                                <a type="button" class="btn btn-danger mt-2" href="<?= site_url('/permintaan/permintaan_del/' . $data->id_minta . '/' . $data->id) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"> Hapus</a>
                                            <?php elseif ($data->status == 1) : ?>
                                                <span class="badge bg-success">Borang Barang Selesai </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (session()->get('level') != 1) { ?>
                            <p>*Jika ingin mengajukan permintaan barang baru, Silahkan Hubungi Helpdesk BMN </p>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="/permintaan/konfirmasi" method="post">
        <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalKonfirmasiLabel">Konfirmasi Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_minta" id="id_minta" value="">

                        <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="1">Sudah Terpenuhi</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('modalKonfirmasi').addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var kodepermintaan = button.getAttribute('data-permintaan');

            var modal = this;
            modal.querySelector('.modal-body #id_minta').value = kodepermintaan;
        });
    </script>
</main>

<?= $this->endSection(); ?>
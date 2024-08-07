<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Ajukan Barang</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Ajukan Barang</h5>
                        <a type="button" class="btn btn-primary" href="/ajukanbrg/create"> + Tambah Barang</a>
                        <br />
                        <br />
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Table with stripped rows -->
                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Ajukan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Alasan</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                                    <th>Asal Unit</th>
                                    <th>Status</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($ajukanbrg as $data) : ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><?= $data->id_ajukan ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->qty ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                                        <td><?= $data->alasan ?></td>
                                        <td><?= $data->tgl_ajukan ?></td>
                                        <td><?= $data->nama_bagian ?></td>
                                        <td>
                                            <?php if (session()->get('level') == '1') : ?>
                                                <?php if ($data->status == 0) : ?>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi" data-kode-pengajuan="<?= $data->id_ajukan ?>">
                                                        Konfirmasi Status
                                                    </button>
                                                <?php endif; ?>
                                                <?php if ($data->status == 1) : ?>
                                                    <span class="badge bg-success">Barang Sudah Tersedia</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (session()->get('level') !== '1') : ?>
                                                <?php if ($data->status == 0) : ?>
                                                    <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                                <?php elseif ($data->status == 1) : ?>
                                                    <span class="badge bg-success">Sudah terpenuhi, Silahkan Borang Barang</span>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if ($data->status == 1) : ?>
                                                <span class="badge bg-primary">Pengajuan Selesai</span>
                                            <?php elseif ($data->status == 2) : ?>
                                                <span class="badge bg-danger">Jika masih dibutuhkan, Silahkan Mengajukan Kembali</span>
                                            <?php endif; ?>
                                            <?php if ($data->status == 0) : ?>
                                                <a type="button" href="/ajukanbrg/edit/<?= $data->id_ajukan ?>" class="btn btn-info">Edit Data</a>
                                                <a type="button" href="/ajukanbrg/delete/<?= $data->id_ajukan ?>" class="btn btn-danger mt-2">Hapus</a>
                                            <?php endif; ?>
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

    <!-- Modal -->
    <form action="/pengajuan/konfirmasi" method="post">
        <div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalKonfirmasiLabel">Konfirmasi Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_ajukan" id="id_ajukan" value="">

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
            var kodePengajuan = button.getAttribute('data-kode-pengajuan');

            var modal = this;
            modal.querySelector('.modal-body #id_ajukan').value = kodePengajuan;
        });
    </script>

</main>
<?= $this->endSection(); ?>
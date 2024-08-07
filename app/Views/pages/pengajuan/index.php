<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pengajuan</h1>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pengajuan</h5>
                        <a type="button" class="btn btn-primary" href="/pengajuan/create"> + Tambah Barang</a>
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
                                    <th>Kode Pengajuan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                                    <th>Status</th>

                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = 1; ?>
                                <?php foreach ($pengajuan as $data) : ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><?= $data->kode_pengajuan ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->qty ?></td>
                                        <td><?= $data->nama_satuan ?></td>
                                        <td>Rp.<?= number_format((float)$data->harga, 0, ',', '.') ?></td> <!-- Format harga -->
                                        <td>Rp.<?= number_format((float)$data->harga * (int)$data->qty, 0, ',', '.') ?></td> <!-- Hitung dan format total -->
                                        <td><?= $data->tanggal ?></td>
                                        <td>
                                            <?php if ($data->status_pengajuan == 0) : ?>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi" data-kode-pengajuan="<?= $data->kode_pengajuan ?>">
                                                    Konfirmasi Status
                                                </button>
                                            <?php elseif ($data->status_pengajuan == 1) : ?>
                                                <span class="badge bg-success">Sudah Terpenuhi</span>
                                            <?php elseif ($data->status_pengajuan == 2) : ?>
                                                <span class="badge bg-danger">Tidak Terpenuhi</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($data->status_pengajuan == 1) : ?>
                                                <span class="badge bg-primary">Pengajuan Selesai</span>
                                            <?php elseif ($data->status_pengajuan == 2) : ?>
                                                <span class="badge bg-danger">Jika masih dibutuhkan, Silahkan Mengajukan Kembali</span>
                                            <?php endif; ?>
                                            <?php if ($data->status_pengajuan == 0) : ?>
                                                <a type="button" href="/pengajuan/edit_pengajuan/<?= $data->kode_pengajuan ?>" class="btn btn-info">Edit Data</a>
                                                <a type="button" href="/pengajuan/delete/<?= $data->kode_pengajuan ?>" class="btn btn-danger">Hapus</a>
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
                        <input type="hidden" name="kode_pengajuan" id="kode_pengajuan" value="">

                        <select class="form-select" aria-label="Default select example" name="status_pengajuan" id="status_pengajuan" required>
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
            modal.querySelector('.modal-body #kode_pengajuan').value = kodePengajuan;
        });
    </script>

</main>
<?= $this->endSection(); ?>
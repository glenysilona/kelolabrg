<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Ajukan Barang</h1>
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
                        <form action="<?= base_url('/ajukanbrg/update/' . $ajukanbrg['id_ajukan']) ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label for="inputNama" class="form-label">Asal Unit</label>
                                <select class="form-control" name="id_bagian" id="id_bagian">
                                    <?php
                                    $selectedId = isset($ajukanbrg['id_bagian']) ? $ajukanbrg['id_bagian'] : '';
                                    foreach ($bagian as $key => $data) {
                                    ?>
                                        <option value="<?= $data['id_bagian'] ?>" <?= $data['id_bagian'] == $selectedId ? 'selected' : '' ?>>
                                            <?= $data['nama_bagian'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputNama" class="form-label">Nama Barang</label>
                                <select class="form-control" name="id" id="id">
                                    <?php
                                    $selectedId = isset($ajukanbrg['id']) ? $ajukanbrg['id'] : '';
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
                                <input type="number" class="form-control" name="qty" id="qty" value="<?= $ajukanbrg['qty'] ?>" />
                            </div>

                            <div class="col-12">
                                <label for="uraian" class="form-label">Alasan</label>
                                <textarea type="text" class="form-control" name="alasan" id="alasan" rows="3"><?= $ajukanbrg['alasan'] ?></textarea>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/ajukanbrg/index" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<script>
    // Ketika halaman dimuat, atur nilai input tanggal menjadi tanggal sekarang
    window.onload = function() {
        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth() + 1; // Ingat bahwa bulan dimulai dari 0 (Januari)
        var year = today.getFullYear();

        // Format tanggal menjadi 'YYYY-MM-DD'
        if (day < 10) {
            day = '0' + day;
        }
        if (month < 10) {
            month = '0' + month;
        }

        var formattedDate = year + '-' + month + '-' + day;

        document.getElementById('tglminta').value = formattedDate;
    };
</script>
<?= $this->endSection(); ?>
<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data Permintaan</h1>
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
                        <form action="<?= base_url('/permintaan/update/' . $permintaan['id_minta']) ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label for="inputNama" class="form-label">Nama Barang</label>
                                <select class="form-control" name="id" id="id">
                                    <?php
                                    $selectedId = isset($permintaan['id']) ? $permintaan['id'] : '';
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
                                <input type="number" class="form-control" name="qty" id="qty" value="<?= $permintaan['qty'] ?>" />
                            </div>

                            <div class="col-12">
                                <label for="uraian" class="form-label">Uraian</label>
                                <input type="text" class="form-control" name="uraian" id="uraian" value="<?= $permintaan['uraian'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal Keluar</label>
                                <input type="date" class="form-control" name="tglminta" id="tglminta" value="<?= $permintaan['tglminta'] ?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/permintaan/index" class="btn btn-secondary">Reset</a>
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
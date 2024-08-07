<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Stok In </h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= site_url('/stokin/process') ?>" class="row g-3" method="POST">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label class="form-label">Nama Barang</label>
                                <select class="form-select" aria-label="Default select example" name="id" id="id" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($barang as $value) { ?>
                                        <option value="<?= isset($value['id']) ? $value['id'] : '' ?>">
                                            <?= isset($value['nama']) ? $value['nama'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" id="qty" value="<?= old('qty', $stok_masuk['qty'] ?? ''); ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Satuan</label>
                                <select class="form-select" name="satuid" id="satuid" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($satuanbrg as $value) { ?>
                                        <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>" aria-required="true">
                                            <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tglmasuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tglmasuk" id="tglmasuk" value="<?= date('Y-m-d'); ?> " required>
                            </div>
                            <!-- Tambahkan input hidden dengan nilai id -->
                            <div class=" text-center">
                                <button type="submit" class="btn btn-primary" name="in_add">Submit</button>
                                <a type="button" href="/pages/stokin/index" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    </section>
</main>
<script>
    // Tambahkan event listener untuk perubahan pada select option barang
    document.getElementById('id').addEventListener('change', function() {
        var barangId = this.value;
        if (barangId) {
            fetch('<?= site_url('/StokIn/getSatuanByBarangId') ?>/' + barangId)
                .then(response => response.json())
                .then(data => {
                    // Kosongkan select option satuan
                    var satuanSelect = document.getElementById('satuid');
                    satuanSelect.innerHTML = '';

                    // Tambahkan option baru untuk satuan berdasarkan data yang diterima
                    var option = document.createElement('option');
                    option.value = data.satuid;
                    option.textContent = data.nama_satuan;
                    satuanSelect.appendChild(option);
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

<!-- Load CSS nya -->
<?= $this->endSection(); ?>
<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Ajukan Barang</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <a type="btn btn-primary" href="/ajukanbrg/create"></a>
                        <!-- Table with stripped rows -->
                        <form action="/ajukanbrg/save" class="row g-3" method="POST">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label class="form-label">Asal Unit</label>
                                <select class="form-select" aria-label="Default select example" name="id_bagian" id="id_bagian" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($bagian as $value) { ?>
                                        <option value="<?= isset($value['id_bagian']) ? $value['id_bagian'] : '' ?>" aria-required="true">
                                            <?= isset($value['nama_bagian']) ? $value['nama_bagian'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Nama Barang</label>
                                <select class="form-select" aria-label="Default select example" name="id" id="id" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($barang as $key => $data) { ?>
                                        <option value="<?= isset($data['id']) ? $data['id'] : '' ?>">
                                            <?= isset($data['nama']) ? $data['nama'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="qty" id="qty" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" name="satuid" id="satuid" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($satuanbrg as $value) { ?>
                                        <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>" aria-required="true">
                                            <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tgl_ajukan" id="tgl_ajukan" required>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Alasan</label>
                                <textarea type="text" class="form-control" name="alasan" id="alasan" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/ajukanbrg" class="btn btn-warning">Kembali</a>
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
    document.getElementById('id').addEventListener('change', function() {
        var barangId = this.value;
        if (barangId) {
            fetch('<?= site_url('/ajukanbrg/getSatuanByBarangId') ?>/' + barangId)
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
<?= $this->endSection(); ?>
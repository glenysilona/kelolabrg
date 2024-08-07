<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Pengajuan</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <br />
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Table with stripped rows -->
                        <form action="/pengajuan/save" class="row g-3" method="POST">
                            <?= csrf_field(); ?>
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
                                <label for="inputNanme4" class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" name="satuid" id="satuid" required>
                                    <option>Pilih</option>
                                    <?php foreach ($satuanbrg as $key => $data) { ?>
                                        <option value="<?= isset($data['satuid']) ? $data['satuid'] : '' ?>">
                                            <?= isset($data['nama_satuan']) ? $data['nama_satuan'] : '' ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>" readonly>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/pengajuan" class="btn btn-secondary">Reset</a>
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
            fetch('<?= site_url('/pengajuan/getSatuanByBarangId') ?>/' + barangId)
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
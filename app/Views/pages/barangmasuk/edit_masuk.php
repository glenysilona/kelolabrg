<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Ubah Barang Masuk</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">


                        <!-- Table with stripped rows -->
                        <form action="/barangmasuk/update/<?= $barangmasuk['kode_barang']; ?>" class="row g-3" method="post">

                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label type="hidden" for=" inputNanme4" class="form-label">Kode Barang</label>
                                <input type="text" id="kode_bareng" class="form-control" name="kode_barang" value="<?= $barangmasuk['kode_barang']; ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= $barangmasuk['nama_barang']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= $barangmasuk['jumlah']; ?>" oninput="hitungTotal()">
                            </div>
                            <div class="col-12">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" value="<?= $barangmasuk['harga']; ?>" oninput="hitungTotal()">
                            </div>
                            <div class="col-12">
                                <label for="satuid" class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" name="satuid" id="satuid">
                                    <option selected>Pilih Satuan</option>
                                    <?php foreach ($nama_satuan as $key => $value) { ?>
                                        <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>" <?= $barangmasuk['satuid'] == $value['satuid'] ? 'selected' : '' ?> <?= $value['satuid'] == $barangmasuk['satuid'] ?>> <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-12">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control" name="total" id="total" value="<?= $barangmasuk['total']; ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" id="keterangan"><?= $barangmasuk['keterangan']; ?>"</textarea>

                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $barangmasuk['tanggal']; ?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/barangmasuk" class="btn btn-secondary">Reset</a>
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
    function hitungTotal() {
        var jumlah = document.getElementById('jumlah').value;
        var harga = document.getElementById('harga').value;

        // Hilangkan karakter non-numerik, termasuk tanda koma
        var hargaClean = harga.replace(/[^\d.-]/g, '');

        // Pastikan nilai jumlah dan harga tidak kosong
        if (jumlah !== "" && hargaClean !== "") {
            // Parse harga ke float
            var hargaFloat = parseFloat(hargaClean);

            // Pastikan harga yang di-parse tidak mengandung karakter non-numeric seperti simbol mata uang
            if (!isNaN(hargaFloat)) {
                var total = parseInt(jumlah) * hargaFloat;
                // Format total menggunakan toLocaleString()
                document.getElementById('total').value = total.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            } else {
                document.getElementById('total').value = "";
            }
        } else {
            document.getElementById('total').value = "";
        }
    }
</script>

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

        document.getElementById('tanggal').value = formattedDate;
    };
</script>





<?= $this->endSection(); ?>
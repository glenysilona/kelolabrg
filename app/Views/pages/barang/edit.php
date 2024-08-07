<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Ubah Data Barang</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">


                        <!-- Table with stripped rows -->
                        <form action="/barang/update/<?= $barang['id']; ?>" class="row g-3" method="post">

                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label type="hidden" for=" inputNanme4" class="form-label"> ID Barang</label>
                                <input type="text" id="id" class="form-control" name="id" value="<?= $barang['id']; ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $barang['nama']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" value="<?= $barang['jumlah']; ?>" disabled>
                            </div>
                            <div class="col-12">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" value="<?= $barang['harga']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="satuid" class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" name="satuid" id="satuid">
                                    <option selected>Pilih Satuan</option>
                                    <?php foreach ($nama_satuan as $key => $value) { ?>
                                        <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>" <?= $barang['satuid'] == $value['satuid'] ? 'selected' : '' ?> <?= $value['satuid'] == $barang['satuid'] ?>>
                                            <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="col-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" id="keterangan"><?= $barang['keterangan']; ?>"</textarea>

                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="button" href="/pages/barang/index" class="btn btn-secondary">Reset</a>
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
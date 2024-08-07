<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Barang Masuk</h1>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <a type="btn btn-primary" href="/barangmasuk/create"></a>
                        <!-- Table with stripped rows -->
                        <form action="/barangmasuk/save" class="row g-3" method="POST">
                            <?= csrf_field(); ?>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly>
                            </div>

                            <div class="col-12">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" required>
                            </div>
                            <div class="col-12">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" oninput="hitungTotal()" required>
                            </div>
                            <div class="col-12">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" name="harga" id="harga" oninput="hitungTotal()" required>
                            </div>
                            <div class="col-12">
                                <label for="total" class="form-label">Total</label>
                                <input type="text" class="form-control" name="total" id="total" readonly>
                            </div>
                            <div class="col-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" required></textarea>

                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" readonly>
                            </div>
                            <div class="col-12">
                                <label for="satuid" class="form-label">Satuan</label>
                                <select class="form-select" aria-label="Default select example" name="satuid" id="satuid" required>
                                    <option selected>Pilih Satuan</option>
                                    <?php foreach ($satuanbrg as $key => $value) { ?>
                                        <option value="<?= isset($value['satuid']) ? $value['satuid'] : '' ?>" aria-required="true"> <?= isset($value['nama_satuan']) ? $value['nama_satuan'] : '' ?></option>
                                    <?php } ?>

                                </select>
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
                    currency: 'IDR',
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
<script>
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

        // Mengambil tanggal dalam format yang sesuai untuk kode barang
        var dateForCode = year.toString().substr(-2) + month + day; // Mengambil 2 digit terakhir tahun

        // Mengambil jam, menit, dan detik saat ini
        var hour = today.getHours();
        var minute = today.getMinutes();
        var second = today.getSeconds();

        // Format jam, menit, dan detik menjadi 2 digit angka jika kurang dari 10
        if (hour < 10) {
            hour = '0' + hour;
        }
        if (minute < 10) {
            minute = '0' + minute;
        }
        if (second < 10) {
            second = '0' + second;
        }

        // Menggabungkan tanggal, jam, menit, detik, dan index untuk kode barang
        var kodeBarang = dateForCode + hour + minute + second; // Misalnya format: YYMMDD-HHMMSS

        document.getElementById('kode_barang').value = kodeBarang; // Memasukkan kode barang ke input kode_barang
    };
</script>


</script>





<?= $this->endSection(); ?>
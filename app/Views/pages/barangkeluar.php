<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Barang Keluar</h1>
        <!-- <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav> -->
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Barang Keluar</h5>
                        <button type="button" class="btn btn-primary"> + Tambah Barang</button>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>
                                        Kode Barang
                                    </th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal</th>
                                    <th>Jam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>32212</td>
                                    <td>HVS</td>
                                    <td>2</td>
                                    <td>500</td>
                                    <td>1000</td>
                                    <td>hvs untuk print</td>
                                    <td>1/12/2023</td>
                                    <td>08.30</td>
                                    <td>
                                        <button type="button" class="btn btn-info">Edit Data</button>
                                        <button type="button" class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<?= $this->endSection(); ?>
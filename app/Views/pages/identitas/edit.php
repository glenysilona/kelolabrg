<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Identitas Diri</h5>

                        <!-- General Form Elements -->
                        <form action="/IdentitasDiri/update" class="row g-3" method="post">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?= $user['id_user'] ?>" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_user" id="nama_user" value="<?= $user['nama_user'] ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?= $user['email'] ?>" name="email" id="email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">No Whatsapp</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="<?= $user['notelp'] ?>" name="notelp" id="notelp">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-2 col-form-label"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
</main>
<?= $this->endSection(); ?>
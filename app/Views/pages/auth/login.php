<?php echo helper('form'); ?>
<?= $this->extend('layouts/templateauth'); ?>
<?= $this->section('content'); ?>
<style>
    .sectionbg {
        /* Tentukan path relatif atau absolut menuju gambar yang ingin Anda gunakan sebagai background */
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('/templates/assets2/img/illustrations/bgpoltek.jpg');
        ;
        /* Atur properti lain sesuai kebutuhan, seperti ukuran dan posisi background */
        background-size: cover;

        height: 100vh;
        background-repeat: no-repeat;
    }

    .input-field {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border-radius: 30px;
        border: none;
        width: 100%;
        padding: 10px;
    }

    .input-field:focus,
    .input-field:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    ::-webkit-input-field-placeholder {
        color: #fff;
    }
</style>
<section class="sectionbg register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block text-white animate__animated animate__backInDown">Sistem Inventory Unit Umum</span>
                    </a>
                </div><!-- End Logo -->


                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4 text-white animate__animated animate__backInLeft">Login to Your Account</h5>
                    <p class="text-center small text-white animate__animated animate__backInRight">Enter your username & password to login</p>
                </div>

                <?php echo form_open('auth/cek_login_admin', ['id' => 'loginForm']) ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="row g-3 needs-validation animate__animated animate__backInUp">
                    <div class="col-12">
                        <label for="email" class="form-label text-white">Username</label>
                        <div class=" input-group has-validation">
                            <input type="text" name="email" id="email" class="input-field form-control" required>
                            <div class="invalid-feedback">Please enter your username.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label text-white">Password</label>
                        <input type="password" name="password" class="input-field form-control" id="password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" id="loginButton" style="border-radius: 30px;">Login</button>
                    </div>
                </div>
                <?php echo form_close() ?>


                <div class="credits text-white animate__animated animate__backInUp">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Developed By Glenys
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        var loginButton = document.getElementById('loginButton');
        loginButton.disabled = true;
        loginButton.innerHTML = 'Loading...';
    });
</script>
<?= $this->endSection(); ?>
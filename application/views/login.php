<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?= SITE_NAME . " - " . $title ?></title>
        <link rel="shortcut icon" href="<?= base_url('assets/') ?>/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/flags-icon/css/flag-icon.min.css"> 

        <link rel="stylesheet" href="<?= base_url('assets/') ?>/vendors/social-button/bootstrap-social.css"/>   
        <link rel="stylesheet" href="<?= base_url('assets/') ?>/css/main.css">

    </head>
    <body id="main-container" class="default">
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <?= $this->session->flashdata('message'); ?>
                    <?= form_open('auth', array('class' => 'row row-eq-height lockscreen  mt-5 mb-5')) ?>
                        <div class="lock-image col-12 col-sm-5"></div>
                        <div class="login-form col-12 col-sm-7">
                            <h3>Halaman Login</h3>
                            <hr>
                            <div class="form-group mb-3">
                                <label for="emailaddress">Username</label>
                                <input type="text" class="form-control" value="<?= set_value('username'); ?>" required="" name="username" placeholder="Username">
                                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" name="password" placeholder="Masukkan kata sandi Anda">
                                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <hr>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary" type="submit"> Masuk Sekarang </button>
                            </div>
                            
                            <div class="mt-2">Tidak punya akun? <a href="#">Hubungi admin</a></div>
                        </div>
                    <?= form_close(); ?>
                </div>

            </div>
        </div>
        <script src="<?= base_url('assets/') ?>/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url('assets/') ?>/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url('assets/') ?>/vendors/moment/moment.js"></script>
        <script src="<?= base_url('assets/') ?>/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?= base_url('assets/') ?>/vendors/slimscroll/jquery.slimscroll.min.js"></script>  
    </body>
</html>

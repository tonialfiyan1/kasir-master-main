<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title><?= SITE_NAME ?></title>
        <link rel="shortcut icon" href="<?= config_item('base_url') ?>/assets/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/vendors/flags-icon/css/flag-icon.min.css"> 

        <link rel="stylesheet" href="<?= config_item('base_url') ?>/assets/css/main.css">
    </head> 
    <body id="main-container" class="default bg-primary">
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <div  class="lockscreen  mt-5 mb-5">
                        <div class="jumbotron mb-0 text-center theme-background rounded">
                            <h1 class="display-3 font-weight-bold"> 404</h1>
                            <h5><i class="ion ion-alert pr-2"></i>Oops! Something went wrong</h5>
                            <p>The page you are looking for is not found, please try after some time or go back to home</p>
                            <a href="<?= config_item('base_url') ?>" class="btn btn-primary">Go To Home</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="<?= config_item('base_url') ?>/assets/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?= config_item('base_url') ?>/assets/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= config_item('base_url') ?>/assets/vendors/moment/moment.js"></script>
        <script src="<?= config_item('base_url') ?>/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?= config_item('base_url') ?>/assets/vendors/slimscroll/jquery.slimscroll.min.js"></script>

    </body>
</html>

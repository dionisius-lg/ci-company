<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <title><?php echo !empty($company['name']) ? $company['name'] : $this->config->item('site_name'); ?> - Auth</title>
        <meta name="description" content="<?php echo $this->config->item('site_name'); ?>">
        <meta name="author" content="<?php echo convert_uudecode($this->config->item('site_auth')); ?>">
        <?php echo $this->template->meta; ?>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/adminlte/css/adminlte.min.css'); ?>">
        <?php echo $this->template->stylesheet; ?>

        <!--[if lt IE 9]>
            <script src="<?php echo base_url('assets/js/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/jquery.easing/jquery.easing.min.js'); ?>"></script>
        <?php echo $this->template->javascript; ?>
        <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/img/bootstrap.png'); ?>" alt="" class="img-fluid">
                </a>
            </div>

            <?php echo $this->template->content; ?>
        </div>
    </body>
</html>

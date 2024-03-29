<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <title><?php echo !empty($company['name']) ? $company['name'] : $this->config->item('site_name'); ?> - Administrator</title>
        <meta name="description" content="<?php echo $this->config->item('site_name'); ?>">
        <meta name="author" content="<?php echo convert_uudecode($this->config->item('site_auth')); ?>">
        <meta name="url" content="<?php echo base_url(); ?>">
        <?php echo $this->template->meta; ?>

        <link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/css/adminlte.min.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendor/toastr/css/toastr.min.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/vendor/sweetalert2/css/sweetalert2.min.css'); ?>" type="text/css">
        <?php echo $this->template->stylesheet; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/back.css'); ?>" type="text/css">

        <!--[if lt IE 9]>
            <script src="<?php echo base_url('assets/js/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
        <![endif]-->

        <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/adminlte/js/adminlte.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/toastr/js/toastr.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/adminlte/js/demo.js'); ?>"></script>
        <?php echo $this->template->javascript; ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-footer-fixeds text-sm">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="<?php echo site_url('admin'); ?>" class="brand-link text-sm">
                    <img src="<?php echo base_url('assets/img/admin-logo.png'); ?>" alt="Administator Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Administrator</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                         <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact text-sm" data-widget="treeview" role="menu" data-accordion="false">
                             <li class="nav-item">
                                <a href="<?php echo site_url('admin'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-tachometer"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/user-requests'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-exclamation-circle"></i>
                                    <p>User Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/booking-requests'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-exclamation-circle"></i>
                                    <p>Booking Requests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/users'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>Users Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/workers'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>Workers Data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/company'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-building-o"></i>
                                    <p>Company Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/sliders'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-television"></i>
                                    <p>Sliders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/testimonies'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-comments-o"></i>
                                    <p>Testimonies</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/galleries'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-photo"></i>
                                    <p>Galleries</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('admin/guest-books'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-book"></i>
                                    <p>Guest Books</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link treeview-link">
                                    <i class="nav-icon fa fa-cog"></i>
                                    <p>Settings <i class="right fa fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('admin/skill-experiences'); ?>" class="nav-link">
                                            <i class="fa fa-circle-thin nav-icon"></i>
                                            <p>Skill Experiences</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('admin/language-abilities'); ?>" class="nav-link">
                                            <i class="fa fa-circle-thin nav-icon"></i>
                                            <p>Language Abilities</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('admin/cooking-abilities'); ?>" class="nav-link">
                                            <i class="fa fa-circle-thin nav-icon"></i>
                                            <p>Cooking Abilities</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('admin/agency-locations'); ?>" class="nav-link">
                                            <i class="fa fa-circle-thin nav-icon"></i>
                                            <p>Agency Locations</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('admin/suplementary-questions'); ?>" class="nav-link">
                                            <i class="fa fa-circle-thin nav-icon"></i>
                                            <p>Suplementary Questions</p>
                                        </a>
                                    </li>
                                    <?php if ($this->session->userdata('AuthUser')['user_level_id'] == 1 && $this->session->userdata('AuthUser')['id'] == 1) { ?>
                                        <li class="nav-item">
                                            <a href="<?php echo site_url('admin/mailer'); ?>" class="nav-link">
                                                <i class="fa fa-circle-thin nav-icon"></i>
                                                <p>Mailer</p>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('/'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-globe"></i>
                                    <p>Main Page</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link">
                                    <i class="nav-icon fa fa-sign-out"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h1 class="m-0 text-dark"><?php echo $this->template->title; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <?php $this->load->view('templates/back/Element/flash_message'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <?php echo $this->template->content; ?>
                    </div>
                </div>
            </div>

            <footer class="main-footer text-sm">
                <strong><i class="fa fa-copyright"></i> <?php echo $this->config->item('site_year') . '&nbsp;' . (!empty($company['name']) ? $company['name'] : $this->config->item('site_name')); ?></strong>
            </footer>
        </div>

        <script src="<?php echo base_url('assets/js/back.js'); ?>"></script>
    </body>
</html>

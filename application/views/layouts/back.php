<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="all,follow">
		<title><?php echo $this->config->item('site_name'); ?> - Administrator</title>
		<meta name="description" content="<?php echo $this->template->description; ?>">
		<meta name="author" content="">
		<meta name="url" content="<?php echo base_url(); ?>">
		<?php echo $this->template->meta; ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/adminlte/css/adminlte.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/toastr/css/toastr.min.css'); ?>">
		<?php echo $this->template->stylesheet; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/back.css'); ?>">

		<!--[if lt IE 9]>
			<script src="<?php echo base_url('assets/js/html5shiv.min.js'); ?>"></script>
			<script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
		<![endif]-->

		<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/adminlte/js/adminlte.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/toastr/js/toastr.min.js'); ?>"></script>
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

				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="fa fa-bell"></i>
							<span class="badge badge-warning navbar-badge">15</span>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-item dropdown-header">15 Notifications</span>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fa fa-envelope mr-2"></i> 4 new messages
								<span class="float-right text-muted text-sm">3 mins</span>
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fa fa-users mr-2"></i> 8 friend requests
								<span class="float-right text-muted text-sm">12 hours</span>
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fa fa-file mr-2"></i> 3 new reports
								<span class="float-right text-muted text-sm">2 days</span>
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
						</div>
					</li>
				</ul>
			</nav>

			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="index3.html" class="brand-link text-sm">
					<img src="<?php echo base_url('assets/img/admin-logo.png'); ?>" alt="Administator Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Administrator</span>
				</a>
				<div class="sidebar">
					<!--
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
							<img src="" class="img-circle elevation-2" alt="User Image">
						</div>
						<div class="info">
							<a href="#" class="d-block">asd</a>
						</div>
					</div>
					-->
					<nav class="mt-2">
						 <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact text-sm" data-widget="treeview" role="menu" data-accordion="false">
						 	<li class="nav-item">
								<a href="<?php echo site_url('admin'); ?>" class="nav-link active">
									<i class="nav-icon fa fa-tachometer"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('admin/user-requests'); ?>" class="nav-link">
									<i class="nav-icon fa fa-users"></i>
									<p>User Requests Data</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('admin/users'); ?>" class="nav-link">
									<i class="nav-icon fa fa-users"></i>
									<p>Users Data</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('admin/employees'); ?>" class="nav-link">
									<i class="nav-icon fa fa-users"></i>
									<p>Employees Data</p>
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
									<p>Slider</p>
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
								<?php $this->load->view('templates/back/element/flash_message'); ?>
							</div>
						</div>
					</div>

					<div class="container-fluid">
						<?php echo $this->template->content; ?>
					</div>
				</div>
			</div>

			<footer class="main-footer text-sm">
				<strong><i class="fa fa-copyright"></i> <?php echo date('Y').' '.$this->config->item('site_name'); ?></strong>
				<div class="float-right d-none d-sm-inline-block">
					<strong><i class="fa fa-copyright"></i> 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
					<b>Version</b> 3.0.5
				</div>
			</footer>
		</div>

		
		<script src="<?php echo base_url('assets/js/back.js'); ?>"></script>
	</body>
</html>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="all,follow">
		<title><?php echo $this->config->item('site_name'); ?></title>
		<meta name="description" content="<?php echo $this->template->description; ?>">
		<meta name="author" content="">
		<?php echo $this->template->meta; ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/icofont/icofont.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/animate/animate.min.css'); ?>">
		<?php echo $this->template->stylesheet; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">

		<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-match-height/jquery.matchHeight-min.js'); ?>"></script>
		<?php echo $this->template->javascript; ?>
	</head>
	<body>
		<div id="topbar" class="d-lg-flex align-items-center fixed-top">
			<div class="container d-flex">
				<div class="menu-lang mr-auto">
					<div class="btn-group">
						<button class="btn btn-outline-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="<?php echo base_url('assets/img/lang/'.$_SESSION['site_lang'].'.png'); ?>" alt=""> <?php echo $this->session->userdata('site_lang'); ?>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="<?php echo base_url('language/switch/english'); ?>"><img src="<?php echo base_url('assets/img/lang/english.png'); ?>" class="img-fluid"> English</a>
							<a class="dropdown-item" href="<?php echo base_url('language/switch/indonesian'); ?>"><img src="<?php echo base_url('assets/img/lang/indonesian.png'); ?>" class="img-fluid"> Indonesian</a>
						</div>
					</div>
				</div>
				<div class="menu-user">
					<ul class="list-inline mb-0">
						<li class="list-inline-item"><a href="#">Login</a></li>
						<li class="list-inline-item"><a href="#">Register</a></li>
						<li class="list-inline-item"><a href="#">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>

		<header id="header" class="fixed-top">
			<div class="container d-flex align-items-center">

				<!-- <h1 class="logo mr-auto"><a href="index.html">Green</a></h1> -->
				<!-- Uncomment below if you prefer to use an image logo -->
				 <a href="index.html" class="logo mr-auto"><img src="<?php echo base_url('assets/img/bootstrap.png'); ?>" alt="" class="img-fluid"></a>

				<nav class="nav-menu d-none d-lg-block">
					<div class="mobile-nav-close d-sm-none">
						<button type="button" class="btn btn-sm shadow-none"><i class="fa fa-close"></i></button>
					</div>

					<ul>
						<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
						<li><a href="<?php echo base_url('gallery'); ?>">Gallery</a></li>
						<li class="drop-down"><a href="">Drop Down</a>
							<ul>
								<li><a href="#">Drop Down 1</a></li>
								<li class="drop-down"><a href="#">Deep Drop Down</a>
									<ul>
										<li><a href="#">Deep Drop Down 1</a></li>
										<li><a href="#">Deep Drop Down 2</a></li>
										<li><a href="#">Deep Drop Down 3</a></li>
										<li><a href="#">Deep Drop Down 4</a></li>
										<li><a href="#">Deep Drop Down 5</a></li>
									</ul>
								</li>
								<li><a href="#">Drop Down 2</a></li>
								<li><a href="#">Drop Down 3</a></li>
								<li><a href="#">Drop Down 4</a></li>
							</ul>
						</li>
						<li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
						<li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
					</ul>
				</nav>

				<!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->

			</div>
		</header>

		<?php
			// This is the main content partial
			echo $this->template->content;
		?>

		<footer id="footer">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-6 footer-info">
							<h3>Company Name</h3>
							<p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
						</div>
						<div class="col-lg-4 col-md-6 footer-link">
							<h4>Useful Links</h4>
							<ul>
								<li><i class="fa fa-chevron-right"></i> <a href="#">Home</a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="#">Gallery</a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="#">About us</a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="#">Contact Us</a></li>
							</ul>
						</div>
						<div class="col-lg-4 col-md-6 footer-contact">
							<h4>Contact Us</h4>
							<p>
								A108 Adam Street <br>
								New York, NY 535022<br>
								United States <br>
								<strong>Phone:</strong> +1 5589 55488 55<br>
								<strong>Email:</strong>
								<a href="#">info@example.com</a><br>
							</p>
							<div class="social">
								<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
								<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="copyright">
					&copy; Copyright <strong>Company Name</strong>. All Rights Reserved
				</div>
			</div>
		</footer>

		<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
		<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	</body>
</html>

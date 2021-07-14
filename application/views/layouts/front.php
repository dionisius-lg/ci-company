<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="all,follow">
		<title><?php echo !empty($company['name']) ? $company['name'] : $this->config->item('site_name'); ?></title>
		<meta name="description" content="<?php echo $this->config->item('site_name'); ?>">
		<meta name="author" content="<?php echo $this->config->item('site_author'); ?>">
		<?php echo $this->template->meta; ?>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/animate/animate.min.css'); ?>">

		<?php echo $this->template->stylesheet; ?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css?'.time()); ?>">

		<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-match-height/jquery.matchHeight-min.js'); ?>"></script>
		<?php echo (isset($recaptcha_script)) ? $recaptcha_script : ''; ?>
		<?php echo $this->template->javascript; ?>
	</head>
	<body>
		<div id="topbar" class="d-lg-flex align-items-center fixed-top">
			<div class="container d-flex">
				<div class="menu-lang mr-auto">
					<div class="btn-group">
						<button class="btn btn-outline-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo sitelang()['alias']; ?>
						</button>
						<div class="dropdown-menu">
							<?php echo anchor(base_url('lang/en'), 'English', ['class' => 'dropdown-item']); ?>
							<?php echo anchor(base_url('lang/id'), 'Bahasa', ['class' => 'dropdown-item']); ?>
							<?php echo anchor(base_url('lang/ja'), '日本語', ['class' => 'dropdown-item']); ?>
							<?php echo anchor(base_url('lang/ko'), '한국어', ['class' => 'dropdown-item']); ?>
							<?php echo anchor(base_url('lang/zh-TW'), '繁體中文', ['class' => 'dropdown-item']); ?>
						</div>
					</div>
				</div>
				<div class="menu-user">
					<ul class="list-inline mb-0">
						<?php if (!$this->session->has_userdata('AuthUser')) {
							echo '<li class="list-inline-item">' . anchor(base_url('auth'), $this->lang->line('front')['topbar']['login']) . '</li>';
							echo '<li class="list-inline-item">' . anchor(base_url('auth/register'), $this->lang->line('front')['topbar']['register']) . '</li>';
						} else {
							echo '<li class="list-inline-item dropdown">';
								// echo anchor('#', $this->lang->line('front')['topbar']['welcome'] . ', ' . strtok($this->session->userdata('AuthUser')['fullname'], ' '), ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
								echo anchor('#', $this->session->userdata('AuthUser')['fullname'], ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
								echo '<div class="dropdown-menu dropdown-menu-right">' . anchor(base_url('auth/logout'), $this->lang->line('front')['topbar']['logout'], ['class' => 'dropdown-item']) . '</div>';
							echo '</li>';
						} ?>
					</ul>
				</div>
			</div>
		</div>

		<header id="header" class="fixed-top">
			<div class="container d-flex align-items-center">

				<!-- <h1 class="logo mr-auto"><a href="index.html">Green</a></h1> -->
				<!-- Uncomment below if you prefer to use an image logo -->
				<a href="<?php echo base_url(); ?>" class="logo mr-auto">
					<?php if (@getimagesize(base_url('files/company/thumb/'.$company['logo']))) {
						echo '<img src="' . base_url('files/company/thumb/'.$company['logo']) . '" alt="Company Logo" class="img-fluid">';
					} else {
						echo 'Company Logo';
					} ?>
				</a>

				<nav class="nav-menu d-none d-lg-block">
					<div class="mobile-nav-close d-sm-none">
						<button type="button" class="btn btn-sm shadow-none"><i class="fa fa-close"></i></button>
					</div>

					<ul>
						<li><?php echo '<a href="' . base_url() . '">' . $this->lang->line('front')['navbar']['home'] . '</a>'; ?></li>
						<li><?php echo '<a href="' . base_url('about') . '">' . $this->lang->line('front')['navbar']['about'] . '</a>'; ?></li>
						<li><?php echo '<a href="' . base_url('worker') . '">' . $this->lang->line('front')['navbar']['worker'] . '</a>'; ?></li>
						<li><?php echo '<a href="' . base_url('contact') . '">' . $this->lang->line('front')['navbar']['contact'] . '</a>'; ?></li>
						<!-- <li class="drop-down"><a href="">Drop Down</a>
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
						</li> -->
					</ul>
				</nav>

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
							<h3><?php echo $company['name']; ?></h3>
							<p><?php echo $company['name'] . $this->lang->line('front')['footer']['company']['desc']; ?></p>
						</div>
						<div class="col-lg-4 col-md-6 footer-link">
							<h4><?php echo $this->lang->line('footer')['link']['title']; ?></h4>
							<ul>
								<li><i class="fa fa-chevron-right"></i> <a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="<?php echo base_url('about'); ?>"><?php echo $this->lang->line('front')['navbar']['about']; ?></a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="<?php echo base_url('worker'); ?>"><?php echo $this->lang->line('front')['navbar']['worker']; ?></a></li>
								<li><i class="fa fa-chevron-right"></i> <a href="<?php echo base_url('contact'); ?>"><?php echo $this->lang->line('front')['navbar']['contact']; ?></a></li>
							</ul>
						</div>
						<div class="col-lg-4 col-md-6 footer-contact">
							<h4><?php echo $this->lang->line('front')['footer']['contact']['title']; ?></h4>
							<p><?php echo ((siteLang()['key'] == 'en') ? $company['address_eng'] : $company['address_ind']) . ', ' . $company['city'] . ', ' . $company['province'] . (!empty($company['zip_code']) ? ' - ' . $company['zip_code'] : ''); ?></p>
							<p>
								<?php echo '<strong>' . $this->lang->line('front')['footer']['contact']['phone'] . ':</strong> ' . $company['phone_1'] . (!empty($company['phone_2']) ? ', ' . $company['phone_2'] : ''); ?>
								<br>
								<?php echo '<strong>' . $this->lang->line('front')['footer']['contact']['email'] . ':</strong> <a href="mailto:' . $company['email_1'] . '">' . $company['email_1'] . '</a> ' . (!empty($company['email_2']) ? ', <a href="mailto:' . $company['email_1'] . '">' . $company['email_1'] . '</a>' : ''); ?>
							</p>
							<div class="social">
								<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="copyright">
					&copy; 2021 <strong><?php echo $company['name']; ?></strong>. All Rights Reserved
				</div>
			</div>
		</footer>

		<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
		<div type="button" class="whatsapp-message" onclick="return window.open('https://wa.me/6281393240532', '_blank');" class="btn-whatsapp"><i class="fa fa-whatsapp"></button>
		<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
	</body>
</html>

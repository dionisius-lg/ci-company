<section class="main-slider owl-carousel owl-theme">
	<?php if (count($sliders) > 0) {
		foreach ($sliders as $slider) { echo
			'<div class="item clickable" data-onclick="' . (!empty($slider['link_to']) ? $slider['link_to'] : '#') . '">
				<img class="img-fluid" src="' . (@getimagesize(base_url('files/sliders/'.$slider['picture'])) ? base_url('files/sliders/'.$slider['picture']) : base_url('assets/img/default-picture.jpg')) . '">
			</div>';
		}
	} else { echo
		'<div class="item clickable" data-onclick="#">
			<img class="img-fluid" src="' . base_url('assets/img/default-slider.jpg') . '">
		</div>';
	} ?>
</section>

<section id="about" class="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 order-1 order-lg-2">
				<img src="<?php echo base_url('assets/img/about.jpg'); ?>" class="img-fluid" alt="about">
			</div>
			<div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
				<h3><?php echo $this->lang->line('welcome'); ?> Company Name</h3>
				<p class="font-italic">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p>
				<ul>
					<li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
					<li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
				</ul>
				<p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				<button type="button" class="btn btn-outline-secondary rounded-0">See more</button>
			</div>
		</div>
	</div>
</section>

<?php if (count($advantages) > 0) { ?>
<section class="serviceso section-bg">
	<div class="container">
		<div class="section-title">
			<h2>Advantages Edit</h2>
			<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
		</div>

		<div class="row">
			<?php foreach ($advantages as $advantage) { ?>
			<div class="col-lg-4 col-md-6 mt-md-0 mb-3">
				<div class="item text-center match-height">
					<i class="fa fa-check-square-o"></i>
					<?php if ($site_lang == 'english') {
						echo '<h4><a href="#">' . $advantage['title_eng'] . '</a></h4> <p>' . $advantage['detail_eng'] . '</p>';
					} else {
						echo '<h4><a href="#">' . $advantage['title_ind'] . '</a></h4> <p>' . $advantage['detail_ind'] . '</p>';
					} ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>

<section class="blog">
	<div class="container">
		<div class="section-title">
			<h2>news</h2>
			<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
				<div class="card">
					<div class="card-img">
						<img class="img-fluid" src="<?php echo base_url('assets/img/gallery/gallery-2.jpg'); ?>" alt="blog" width="100%">
					</div>
					<div class="card-body">
						<p class="card-title ellipsis2line">
							<a href="#">Sint eius inventore magni quod</a>
						</p>
						<ul class="list-unstyled list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> John Cenna</li>
							<li class="list-inline-item"><i class="fa fa-calendar"></i> 12 Feb, 2020</li>
						</ul>
						<p class="card-text">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur...</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
				<div class="card">
					<div class="card-img">
						<img class="img-fluid" src="<?php echo base_url('assets/img/gallery/gallery-3.jpg'); ?>" alt="blog" width="100%">
					</div>
					<div class="card-body">
						<p class="card-title ellipsis2line">
							<a href="#">Sint eius inventore magni quod</a>
						</p>
						<ul class="list-unstyled list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> <a href="#">John</a></li>
							<li class="list-inline-item"><i class="fa fa-calendar"></i> 12 Feb, 2020</li>
						</ul>
						<p class="card-text">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur...</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
				<div class="card">
					<div class="card-img">
						<img class="img-fluid" src="<?php echo base_url('assets/img/gallery/gallery-4.jpg'); ?>" alt="blog" width="100%">
					</div>
					<div class="card-body">
						<p class="card-title ellipsis2line">
							<a href="#">Sint eius inventore magni quod</a>
						</p>
						<ul class="list-unstyled list-inline">
							<li class="list-inline-item"><i class="fa fa-user-o"></i> <a href="#">John</a></li>
							<li class="list-inline-item"><i class="fa fa-calendar"></i> 12 Feb, 2020</li>
						</ul>
						<p class="card-text">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur...</p>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 text-center mt-4">
				<button type="button" class="btn btn-outline-secondary rounded-0">See more</button>
			</div>
		</div>
	</div>
</section>

<section class="banner section-bg">
	<div class="container">
		<div class="align-middle">
			<h2>For more information</h2>
			<a href="#" class="btn btn-outline-secondary rounded-0">Contact Us</a>
		</div>
	</div>
</section>

<section class="clients">
	<div class="container">
		<div class="section-title">
			<h2>Our Clients</h2>
			<p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
		</div>

		<div class="client-slider owl-carousel owl-theme">
		<?php for ($i=1; $i<=8; $i++) { ?>
			<div class="item clickable" data-onclick="#">
				<img class="img-fluid" src="<?php echo base_url('assets/img/clients/client-'.$i.'.png'); ?>">
			</div>
		<?php } ?>
		</div>
	</div>
</section>

<?php $this->template->stylesheet->add('assets/vendor/owlcarousel/css/owl.carousel.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/owlcarousel/css/owl.theme.default.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/owlcarousel/js/owl.carousel.min.js'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.match-height').matchHeight();
	});

	$('.main-slider').owlCarousel({
		autoplay: true,
		autoplayTimeout: 7000,
		autoplayHoverPause: true,
		smartSpeed: 500,
		loop: true,
		responsiveClass: true,
		items: 1,
		nav : true,
		navText: ['<i></i>', '<i></i>'],
		dots: true,
		dotsSpeed: 400
	});

	$('.client-slider').owlCarousel({
		autoplay: true,
		autoplayTimeout: 7000,
		autoplayHoverPause: true,
		smartSpeed: 500,
		loop: true,
		responsiveClass: true,
		items: 6,
		nav : false,
		dots: false,
		dotsSpeed: 400,
		margin: 50,
		responsiveClass: true,
		responsive: {
			0: {
				items: 2,
				margin: 25
			},
			576: {
				items: 2
			},
			768: {
				items: 4
			},
			992: {
				items: 6
			}
		}
	});
</script>
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

<?php $this->load->view('templates/front/Element/section_filter_list'); ?>

<?php $this->load->view('templates/front/Element/section_about_home'); ?>

<?php $this->load->view('templates/front/Element/section_advantage'); ?>

<section class="blog" hidden>
	<div class="container">
		<div class="section-title">
			<h2><?php echo $this->lang->line('section_title')['news']; ?></h2>
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
				<button type="button" class="btn btn-outline-secondary rounded-0">See More</button>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('templates/front/element/section_banner_home'); ?>

<section id="clients" hidden>
	<div class="container">
		<div class="section-title">
			<h2><?php echo $this->lang->line('section_title')['clients']; ?></h2>
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

	// $('.client-slider').owlCarousel({
	// 	autoplay: true,
	// 	autoplayTimeout: 7000,
	// 	autoplayHoverPause: true,
	// 	smartSpeed: 500,
	// 	loop: true,
	// 	responsiveClass: true,
	// 	items: 6,
	// 	nav : false,
	// 	dots: false,
	// 	dotsSpeed: 400,
	// 	margin: 50,
	// 	responsiveClass: true,
	// 	responsive: {
	// 		0: {
	// 			items: 2,
	// 			margin: 25
	// 		},
	// 		576: {
	// 			items: 2
	// 		},
	// 		768: {
	// 			items: 4
	// 		},
	// 		992: {
	// 			items: 6
	// 		}
	// 	}
	// });
</script>
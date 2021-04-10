<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('header')['navbar']['home']; ?></a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

<?php $this->load->view('templates/front/Element/section_about'); ?>

<?php $this->load->view('templates/front/Element/section_advantage'); ?>

<section id="clients">
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
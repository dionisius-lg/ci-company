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
				<img src="<?php echo base_url('assets/img/ptarj.jpg'); ?>" class="img-fluid" alt="about">
			</div>
			<div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
				<h3><?php echo $this->lang->line('welcome'); ?> PT. AMALIA ROZIKIN JAYA</h3>
				<hr>
				<p class="font-italic">
					PERUSAHAAN JASA PENEMPATAN TENAGA KERJA LUAR NEGERI 
				</p>
				<ul>
					<li><i class="icofont-check-circled"></i> PT. Amalia Rozikin Jaya adalah Perusahaan Rekrutmen dan Penempatan yang mengkhususkan diri dalam tenaga kerja trampil Indonesia di luar negeri. Kami berdedikasi untuk memberikan kesempatan yang lebih besar kepada sesama orang Indonesia tidak hanya untuk berbagi kemampuan dan bakat mereka dalam bekerja di berbagai bidang di mana kualifikasi mereka paling sesuai, tetapi juga untuk mendapatkan lebih banyak dan diberi kompensasi dengan manfaat yang lebih baik juga.  </li>
					<li><i class="icofont-check-circled"></i> PT Amalia Rozikin Jaya memahami bahwa modal kepemimpinan memainkan peran kunci dalam kinerja organisasi mana pun. Kemampuan organisasi untuk memperoleh keuntungan, berkembang, dan tumbuh bergantung pada bakat dan kinerja orang-orangnya. Di era mobilitas, mempekerjakan orang-orang yang berkinerja terbaik dapat membuat perbedaan nyata antara kesuksesan dan kegagalan.</li>
					<li><i class="icofont-check-circled"></i> PT. Amalia Rozikin Jaya telah memasok banyak tenaga kerja Indonesia dan profesional untuk berbagai sektor industri yang mencakup sektor manufaktur, konstruksi, rumah sakit, pertanian, perkebunan, teknik, nelayan, restoran, layanan kebersihan, hotel, asisten rumah tangga, perawat lansia.
					Calon Pekerja Migran Indonesia selalu dapat mengandalkan perwakilan bisnis PT. Amalia Rozikin Jaya untuk melakukan yang terbaik serta memberikan pelayanan yang baik dan efisien untuk memenuhi setiap kebutuhan Pekerja Migran Indonesia selama di luar negeri.
					 Semua biaya yang di tetapkan di PT. Amalia Rozikin Jaya selalu mengacu kepada peraturan pemerintah Republik Indonesia. Dengan kepemimpinan baru, PT.Amalia Rozikin Jaya akan berkembang dan memberikan pelayanan yang lebih baik lagi kepada seluruh Calon Pekerja Migran Indonesia yang bergabung. 
					</li>
				</ul>
				<!-- <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p> -->
				<!-- <button type="button" class="btn btn-outline-secondary rounded-0">See more</button> -->
			</div>
		</div>
	</div>
</section>

<?php if (count($advantages) > 0) { ?>
<section class="serviceso section-bg">
	<div class="container">
		<div class="section-title">
			<h2>Visi Dan Misi</h2>
			<p>
				Membantu pemerintah dalam penanggulan masalah pengangguran dalam negeri dan mencetak tenaga kerja yang memiliki keterampilan, pengetahuan, attitude dan pemasukan devisa negara. Mensejahterakan kehidupan tenaga kerja sendiri dan keluarga. Menyalurkan calon tenaga kerja Indonesia ke negara-negara yang membutuhkan tenaga kerja asing yang professional. Memberikan pengawasan dan perlindungan kepada Tenaga Kerja Indonesia di luar negeri.
			</p>
		</div>

		<div class="row">
			<?php foreach ($advantages as $advantage) { ?>
			<div class="col-lg-6 col-md-6 mt-md-0 mb-3">
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
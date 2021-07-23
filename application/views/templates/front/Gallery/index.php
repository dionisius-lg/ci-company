<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
				<li><?php echo $this->lang->line('front')['navbar']['gallery']; ?></li>
			</ol>
		</div>
	</div>
</section>

<section id="galleries">
	<div class="container">
		<div class="row album">
			<?php foreach($galleries AS $gallery) : ?>
			<div class="col-lg-4 col-md-6 item filter-app">
				<div class="wrapper">
					<img src="<?= base_url('files/galleries/'.$gallery['picture']); ?>" class="img-fluid" alt="">
					<div class="info">
						<h4><?= $gallery['pictname']; ?></h4>
						<p><?= $gallery['description']; ?></p>
						<div class="link">
							<a href="<?= base_url('files/galleries/'.$gallery['picture']) ?>" data-gall="portfolioGallery" class="venobox" title="<?= $gallery['pictname']; ?>"><i class="fa fa-search mt-3"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="page-center mt-4">
			<?php echo $pagination; ?>
		</div>
	</div>
</section>


<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/isotope-layout/isotope.pkgd.min.js'); ?>
<script type="text/javascript">
	$(window).on('load', function() {
		var galleryIsotope = $('#galleries .album').isotope({
			itemSelector: '#galleries .item'
		});

		$('#galleries .filter li').on('click', function() {
			$('#galleries .filter li').removeClass('active');
			$(this).addClass('active');

			galleryIsotope.isotope({
				filter: $(this).data('filter')
			});
		});

		// Initiate venobox (lightbox feature used in portofilo)
		$(document).ready(function() {
			$('.venobox').venobox();
		});
	});
</script>
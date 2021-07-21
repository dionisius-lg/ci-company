<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
				<li><?php echo $this->lang->line('front')['navbar']['testimony']; ?></li>
			</ol>
		</div>
	</div>
</section>

<section class="section-medium section-arrow--bottom-center section-arrow-primary-color bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-white text-center">
                <h2 class="section-title "> What Others Say About Us</h2>
                <p class="section-sub-title">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui beatae officia quia laborum sint nisi ullam consequuntur vitae ab illo itaque exercitationem eos enim voluptas quidem accusantium eius possimus dolores similique nesciunt, cumque repellat ipsa?
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section-primary t-bordered">
    <div class="container">
        <?php foreach($testimonies AS $testimony) : ?>
        <div class="row testimonial-three testimonial-three--col-three">
            <div class="col-md-12 testimonial-three-col">
                <div class="testimonial-inner">
                    <div class="testimonial-image" itemprop="image">
                        <img width="180" height="180" src="<?= base_url('files/testimonies/'.$testimony['picture']) ?>">
                    </div>
                </div>
                <h5 class="testimonial-name"><?= $testimony['fullname'] ?></h5>
                <div class="testimonial-content">
                    <p><?= $testimony['description'] ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
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
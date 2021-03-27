<?php if (sitelang() == 'english') { ?>
	<section id="banner" class="banner text-center">
		<div class="container">
			<div class="align-middle">
				<h2>For more information</h2>
				<a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-secondary rounded-0">Contact Us</a>
			</div>
		</div>
	</section>
<?php } else { ?>
	<section id="banner" class="banner text-center">
		<div class="container">
			<div class="align-middle">
				<h2>Informasi lebih lanjut</h2>
				<a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-secondary rounded-0">Hubungi Kami</a>
			</div>
		</div>
	</section>
<?php } ?>
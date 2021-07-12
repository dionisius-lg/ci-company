<section id="banner" class="banner text-center">
	<div class="container">
		<div class="align-middle">
			<?php if (siteLang()['key'] == 'en') { ?>
				<h2>For more information</h2>
			<?php } ?>

			<?php if (siteLang()['key'] == 'id') { ?>
				<h2>Informasi lebih lanjut</h2>
			<?php } ?>

			<?php if (siteLang()['key'] == 'ja') { ?>
				<h2>詳細については</h2>
			<?php } ?>

			<?php if (siteLang()['key'] == 'ko') { ?>
				<h2>자세한 내용은</h2>
			<?php } ?>

			<?php if (siteLang()['key'] == 'zh-TW') { ?>
				<h2>了解更多信息</h2>
			<?php } ?>

			<a href="<?php echo base_url('contact'); ?>" class="btn btn-outline-secondary rounded-0"><?php echo $this->lang->line('front')['navbar']['contact']; ?></a>
		</div>
	</div>
</section>
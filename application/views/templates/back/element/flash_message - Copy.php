<?php if (hasFlashSuccess()) { ?>
	<div class="alert alert-primary alert-sm alert-dismissible fade show rounded-0" role="alert">
		<i class="fa fa-lg fa-check">&nbsp;</i> <?php echo FlashSuccess(); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php } ?>

<?php if (hasFlashError()) { ?>
	<div class="alert alert-danger alert-sm alert-dismissible fade show rounded-0" role="alert">
		<i class="fa fa-lg fa-warning">&nbsp;</i> <?php echo FlashError(); ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php } ?>
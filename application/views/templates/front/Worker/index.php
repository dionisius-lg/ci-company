<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
				<li><?php echo $this->lang->line('front')['navbar']['worker']; ?></li>
			</ol>
		</div>
	</div>
</section>

<section id="worker">
	<div class="container">
		<?php echo form_open('', ['method' => 'get', 'id' => 'formFilter', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
			<div class="form-row">
				<div class="form-group col-md-3">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['nik'], null); ?>
					<?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control', 'value' => $this->input->get('nik') ? $this->input->get('nik') : '']); ?>
				</div>
				<div class="form-group col-md-3">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['fullname'], null); ?>
					<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
				</div>
				<div class="form-group col-md-2">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['gender'], null); ?>
					<select name="gender" class="form-control select2">
						<option value="">Please Select</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['marital_status'], null); ?>
					<select name="marital_status" class="form-control select2">
						<option value="">Please Select</option>
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="divorce">Divorce</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['age'], null); ?>
					<?php echo form_input(['type' => 'text', 'name' => 'age', 'class' => 'form-control numeric', 'value' => $this->input->get('age') ? $this->input->get('age') : '']); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['oversea_experience'], null); ?>
					<div class="d-flex flex-wrap">
						<?php foreach ($placements as $oversea_experience) { ?>
							<div class="icheck-secondary mr-4">
								<?php echo form_checkbox(['name' => 'oversea_experience[]', 'id' => 'OverseaExperience' . $oversea_experience['id'], 'value' => $oversea_experience['slug']]); ?>
								<?php echo form_label($oversea_experience['name'], 'OverseaExperience' . $oversea_experience['id']); ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="form-group col-md-6">
					<?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['experience'], null); ?>
					<div class="d-flex flex-wrap">
						<?php foreach ($experiences as $experience) { ?>
							<div class="icheck-secondary mr-4">
								<?php echo form_checkbox(['name' => 'experience[]', 'id' => 'Experience' . $experience['id'], 'value' => $experience['slug'], 'class' => 'asd']); ?>
								<?php echo form_label($experience['name'], 'Experience' . $experience['id']); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-right border-top mt-1 pt-2">
					<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-secondary', 'content' => $this->lang->line('front')['page_worker']['button']['search']]); ?>
				</div>
			</div>
		<?php echo form_close(); ?>

		<div class="section-sub-title">
			<h5><?php echo $this->lang->line('front')['page_worker']['result']; ?></h5>
		</div>

		<div class="row">
			<?php if (count($workers) > 0) { ?>
				<?php foreach ($workers as $worker) { ?>
					<div class="col-md-4 mb-3">
						<div class="box">
							<div class="profile-photo">
								<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>" class="img-fluid">
							</div>
							<div class="profile-name">
								<h6><?php echo $worker['fullname']; ?></h6>
								<p><?php echo $this->lang->line('front')['page_worker']['worker_data']['nik'] . ': ' . $worker['nik']; ?></p>
							</div>
							<div class="profile-info match-height">
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['gender']; ?></div>
									<div><?php echo !empty($worker['gender']) ? $worker['gender'] : '-'; ?></div>
								</div>
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['marital_status']; ?></div>
									<div><?php echo !empty($worker['marital_status']) ? $worker['marital_status'] : '-'; ?></div>
								</div>
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['age']; ?></div>
									<div><?php echo !empty($worker['age']) ? $worker['age'] : '-'; ?></div>
								</div>
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['experience']; ?></div>
									<div><?php echo !empty($worker['experience']) ? $worker['experience'] : '-'; ?></div>
								</div>
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['oversea_experience']; ?></div>
									<div><?php echo !empty($worker['oversea_experience']) ? $worker['oversea_experience'] : '-'; ?></div>
								</div>
								<div class="flex-wrapper">
									<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['ready_placement']; ?></div>
									<div><?php echo !empty($worker['ready_placement']) ? $worker['ready_placement'] : '-'; ?></div>
								</div>
							</div>
							<div class="profile-menu">
								<?php echo anchor('worker/detail/' . $worker['nik'], $this->lang->line('front')['page_worker']['button']['view_detail'], ['class' => 'btn btn-secondary']); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="col-md-12 text-center">
					<p class="my-4"><?php echo $this->lang->line('front')['page_worker']['no_result']; ?></p>
				</div>
			<?php } ?>
		</div>

		<div class="page-center">
			<?php echo $pagination; ?>
		</div>
	</div>
</section>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<?php if (hasFlashError('worker')) { ?>
<script>
	var bsSwal = Swal.mixin({
		customClass: {
			confirmButton: 'btn btn-secondary rounded-0'
		},
		buttonsStyling: false
	});

	bsSwal.fire('<?php echo flashError("worker"); ?>');
</script>
<?php } ?>

<!-- script for this page -->
<script type="text/javascript">
	$(document).ready(function() {
		// var paramExperience = '<?php echo $this->input->get('experience'); ?>',
		var paramExperience = '<?php echo urldecode($this->input->get('experience')); ?>',
			elemExperience = $('#formFilter [name="experience[]"');

		for (var x = 0; x < elemExperience.length; x++) {
			if($.inArray(elemExperience[x].value, paramExperience.split(',')) !== -1) {
				elemExperience.eq(x).attr('checked', true);
			}
		}

		// var paramOverseaExperience = '<?php echo$this->input->get('oversea_experience'); ?>',
		var paramOverseaExperience = '<?php echo urldecode($this->input->get('oversea_experience')); ?>',
			elemOverseaExperience = $('#formFilter [name="oversea_experience[]"');

		for (var y = 0; y < elemOverseaExperience.length; y++) {
			if($.inArray(elemOverseaExperience[y].value, paramOverseaExperience.split(',')) !== -1) {
				elemOverseaExperience.eq(y).attr('checked', true);
			}
		}

		if ($('#formFilter [name="gender"]').find('option[value="<?php echo $this->input->get('gender'); ?>"]').length) {
			$('#formFilter [name="gender"]').val('<?php echo $this->input->get('gender'); ?>').trigger('change');
		}

		if ($('#formFilter [name="marital_status"]').find('option[value="<?php echo $this->input->get('marital_status'); ?>"]').length) {
			$('#formFilter [name="marital_status"]').val('<?php echo $this->input->get('marital_status'); ?>').trigger('change');
		}

		if ($('#formFilter [name="placement"]').find('option[value="<?php echo $this->input->get('placement'); ?>"]').length) {
			$('#formFilter [name="placement"]').val('<?php echo $this->input->get('placement'); ?>').trigger('change');
		}
	});

	$('#formFilter').on('submit', function(e) {
		e.preventDefault();

		var thisForm = $(this);

		var thisExperience = thisForm.find('[name="experience[]"'),
			valueExperience = [],
			xxx = 0;

		for (var xx = 0; xx < thisExperience.length; xx++) {
			if (thisExperience[xx].checked) {
				valueExperience[xxx] = thisExperience[xx].value;
				xxx++;
			}
		}

		thisForm.append('<input type="hidden" name="experience" value="' + valueExperience.join(',') +'">');
		thisExperience.attr({'disabled': true});

		var thisOverseaExperience = thisForm.find('[name="oversea_experience[]"'),
			valueOverseaExperience = [],
			yyy = 0;

		for (var yy = 0; yy < thisOverseaExperience.length; yy++) {
			if (thisOverseaExperience[yy].checked) {
				valueOverseaExperience[yyy] = thisOverseaExperience[yy].value;
				yyy++;
			}
		}

		thisForm.append('<input type="hidden" name="oversea_experience" value="' + valueOverseaExperience.join(',') +'">');
		thisOverseaExperience.attr({'disabled': true});

		thisForm.find('[type="submit"]').attr({'disabled': true});

		e.currentTarget.submit();
	});
</script>
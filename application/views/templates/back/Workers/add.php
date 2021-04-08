<div class="row">
	<div class="col-md-2">
		<div class="card">
			<div class="card-body">
				<?php echo form_open(null, ['method' => 'post', 'id' => 'formPhoto', 'autocomplete' => 'off']); ?>
					<div class="form-group text-center">
						<div class="border">
							<?php echo form_input(['type' => 'file', 'name' => 'photo', 'class' => 'hidden' . ((hasFlashError('photo')) ? 'is-invalid' : ''), 'disabled' => true]); ?>
							<img src="<?php echo base_url('assets/img/default-avatar.jpg'); ?>" alt="Employees Photo" class="img-fluid" style="opacity: 0.4;">
							<div class="layer hidden">
								<button type="button" class="btn btn-xs btn-outline-primary rounded-0 venobox" hidden data-toggle="view">View</button>
								<?php echo form_button(['type' => 'button', 'class' => 'btn btn-xs btn-outline-success rounded-0', 'content' => 'Change', 'data-toggle' => 'browse', 'hidden' => true]); ?>
							</div>
						</div>
					</div>
					<div class="form-group" hidden>
						<div class="progress progress-md mt-2" hidden>
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<span class="form-text text-danger"></span>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<div class="col-md-10">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Add New</h3>
				</div>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/workers/create', ['method' => 'post', 'id' => 'formData', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-3">
							<?php echo form_label('NIK <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('nik') ? ' is-invalid' : ''), 'maxlength' => '20', 'value' => oldInput('nik')]); ?>
							<span class="invalid-feedback"><?php echo flashError('nik'); ?></span>
						</div>
						<div class="form-group col-md-5">
							<?php echo form_label('Fullname <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('fullname') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('fullname')]); ?>
							<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<?php echo form_label('Email <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0 lowercase' . (hasFlashError('email') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('email')]); ?>
							<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Phone 1 <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'phone_1', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_1') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_1')]); ?>
							<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Phone 2', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'phone_2', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_2') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_2')]); ?>
							<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Gender', null); ?>
							<select name="gender" class="form-control select2 rounded-0 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Marital Status', null); ?>
							<select name="marital_status" class="form-control select2 rounded-0 <?php echo (hasFlashError('marital_status')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Single</option>
								<option value="2">Married</option>
								<option value="3">Divorce</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('marital_status'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Birth Place', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'birth_place', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('birth_place') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('birth_place')]); ?>
							<span class="invalid-feedback"><?php echo flashError('birth_place'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Birth Date', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'birth_date', 'class' => 'form-control form-control-sm rounded-0 date' . (hasFlashError('birth_date') ? ' is-invalid' : ''), 'maxlength' => '20', 'value' => oldInput('birth_date')]); ?>
							<span class="invalid-feedback"><?php echo flashError('birth_date'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Age', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'age', 'class' => 'form-control form-control-sm rounded-0 numeric plaintext' . (hasFlashError('age') ? ' is-invalid' : ''), 'maxlength' => '3', 'value' => oldInput('age'), 'readonly' => true]); ?>
							<span class="invalid-feedback"><?php echo flashError('age'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Religion', null); ?>
							<select name="religion" class="form-control select2 rounded-0 <?php echo (hasFlashError('religion')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('religion'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<?php echo form_label('Address', null); ?>
							<?php echo form_textarea(['name' => 'address', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('address') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('address')]); ?>
							<span class="invalid-feedback"><?php echo flashError('address'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Province', null); ?>
							<select name="province" class="form-control select2 rounded-0 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($provinces as $province) {
									echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('City', null); ?>
							<select name="city" class="form-control select2 rounded-0 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<?php echo form_label('Description', null); ?>
							<?php echo form_textarea(['name' => 'description', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('description') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('description')]); ?>
							<span class="invalid-feedback"><?php echo flashError('description'); ?></span>
						</div>
						<div class="form-group col-md-12">
							<?php echo form_label('Work Experience', null); ?>
							<div class="d-flex flex-wrap">
								<?php $work_experience_ids = explode(',', oldInput('work_experience')); ?>
								<?php foreach ($work_experiences as $work_experience) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'work_experience[]', 'id' => 'WorkExperience' . $work_experience['id'], 'value' => $work_experience['id'], 'checked' => in_array($work_experience['id'], $work_experience_ids) ? true : false]); ?>
										<?php echo form_label($work_experience['name'], 'WorkExperience' . $work_experience['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('work_experience'); ?></span>
						</div>
						<div class="form-group col-md-12">
							<?php echo form_label('Placement Ready', null); ?>
							<div class="d-flex flex-wrap">
								<?php $placement_ready_ids = explode(',', oldInput('placement_ready')); ?>
								<?php foreach ($agency_countries as $placement_ready) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'placement_ready[]', 'id' => 'PlacementReady' . $placement_ready['id'], 'value' => $placement_ready['id'], 'checked' => in_array($placement_ready['id'], $placement_ready_ids) ? true : false]); ?>
										<?php echo form_label($placement_ready['name'], 'PlacementReady' . $placement_ready['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('placement_ready'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Agency', null); ?>
							<select name="agency_country" class="form-control select2 rounded-0 <?php echo (hasFlashError('agency_country')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($agency_countries as $agency_country) {
									echo '<option value="' .$agency_country['id']. '">'. $agency_country['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('agency_country'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0', 'content' => 'Create']); ?>
							<?php echo anchor('admin/workers', 'Back', ['class' => 'btn btn-sm btn-default rounded-0']); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/datatables/css/dataTables.bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/css/bs4-datatables.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>
<?php $this->template->javascript->add('assets/js/file-downloader.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
	$(document).ready(function() {
		// describe required variable
		var workerGender = '<?php echo oldInput('gender'); ?>',
			workerMaritalStatus = '<?php echo oldInput('marital_status'); ?>',
			workerReligion = '<?php echo oldInput('religion'); ?>',
			workerProvince = '<?php echo oldInput('province'); ?>',
			workerAgencyCountry = '<?php echo oldInput('agency_country'); ?>';

		var employeesGender = '<?php echo oldInput('gender'); ?>',
			employeesProvince = '<?php echo oldInput('province'); ?>';

		// set value to element if variable true or numeric
		if (workerGender && $.isNumeric(workerGender)) {
			$('#formData [name="gender"]').val(workerGender).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerMaritalStatus && $.isNumeric(workerMaritalStatus)) {
			$('#formData [name="marital_status"]').val(workerMaritalStatus).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerReligion && $.isNumeric(workerReligion)) {
			$('#formData [name="religion"]').val(workerReligion).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerProvince && $.isNumeric(workerProvince)) {
			$('#formData [name="province"]').val(workerProvince).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerAgencyCountry && $.isNumeric(workerAgencyCountry)) {
			$('#formData [name="agency_country"]').val(workerAgencyCountry).trigger('change');
		}
	});

	// disable submit on submitted form
	$('#formData').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	// request data city onchange element province
	$('#formData [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formData [name="city"]'),
			cityValue = '<?php echo oldInput('city'); ?>';

		cityElement.html('<option value="">Please Select</option>');

		if (provinceValue && $.isNumeric(provinceValue)) {
			var param = {
				'province_id': provinceValue,
				'order': 'name',
				'limit': 100
			}

			requestCities(param, cityValue, cityElement);
		}
	});

	// form photo event
	$('#formPhoto').on('submit', function(e) {
		e.preventDefault();
		return false;
	});
</script>
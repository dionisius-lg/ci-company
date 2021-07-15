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
					<?php echo form_label('Personal Data', null, ['class' => 'form-label border-bottom']); ?>
					<div class="row">
						<div class="form-group col-md-4">
							<?php echo form_label('Ref Number <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'ref_number', 'class' => 'form-control form-control-sm rounded-0 uppercase' . (hasFlashError('ref_number') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('ref_number')]); ?>
							<span class="invalid-feedback"><?php echo flashError('ref_number'); ?></span>
						</div>
						<div class="form-group col-md-8">
							<?php echo form_label('Fullname <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('fullname') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('fullname')]); ?>
							<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Birth Place <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'birth_place', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('birth_place') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('birth_place')]); ?>
							<span class="invalid-feedback"><?php echo flashError('birth_place'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Birth Date <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'birth_date', 'class' => 'form-control form-control-sm rounded-0 date' . (hasFlashError('birth_date') ? ' is-invalid' : ''), 'maxlength' => '20', 'value' => oldInput('birth_date')]); ?>
							<span class="invalid-feedback"><?php echo flashError('birth_date'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Age', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'age', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('age') ? ' is-invalid' : ''), 'value' => oldInput('age'), 'readonly' => true]); ?>
							<span class="invalid-feedback"><?php echo flashError('age'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Religion', null); ?>
							<select name="religion" class="form-control select2 rounded-0 <?php echo (hasFlashError('religion')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Moslem</option>
								<option value="2">Christian</option>
								<option value="3">Catholic Christians</option>
								<option value="4">Hindu</option>
								<option value="5">Buddha</option>
								<option value="6">Others</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('religion'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Gender <span class="text-danger">*</span>', null); ?>
							<select name="gender" class="form-control select2 rounded-0 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Marital Status <span class="text-danger">*</span>', null); ?>
							<select name="marital_status" class="form-control select2 rounded-0 <?php echo (hasFlashError('marital_status')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Single</option>
								<option value="2">Married</option>
								<option value="3">Divorce</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('marital_status'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Email', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0 lowercase' . (hasFlashError('email') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('email')]); ?>
							<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Phone', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'phone', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone')]); ?>
							<span class="invalid-feedback"><?php echo flashError('phone'); ?></span>
						</div>
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
						<div class="form-group col-md-6">
							<?php echo form_label('Character Evaluation', null); ?>
							<?php echo form_textarea(['name' => 'character_evaluation', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('character_evaluation') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('character_evaluation')]); ?>
							<span class="invalid-feedback"><?php echo flashError('character_evaluation'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Last Education', null); ?>
							<select name="last_education" class="form-control select2 rounded-0 <?php echo (hasFlashError('last_education')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Kindergarten</option>
								<option value="2">Primary School</option>
								<option value="3">Junior High School</option>
								<option value="4">Senior High School</option>
								<option value="5">Diploma Degree</option>
								<option value="6">Bachelor Degree</option>
								<option value="7">Other</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('last_education'); ?></span>
						</div>
					</div>
					<?php echo form_label('Family Background', null, ['class' => 'form-label border-bottom']); ?>
					<div class="row">
						<div class="form-group col-md-3">
							<?php echo form_label('Spouse Name', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'spouse_name', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('spouse_name') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('spouse_name')]); ?>
							<span class="invalid-feedback"><?php echo flashError('spouse_name'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Spouse Occupation', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'spouse_occupation', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('spouse_occupation') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('spouse_occupation')]); ?>
							<span class="invalid-feedback"><?php echo flashError('spouse_occupation'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Children', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'children', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('children') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('children')]); ?>
							<span class="invalid-feedback"><?php echo flashError('children'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Children Age', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'children_age', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('children_age') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('children_age')]); ?>
							<span class="invalid-feedback"><?php echo flashError('children_age'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Father Name', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'father_name', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('father_name') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('father_name')]); ?>
							<span class="invalid-feedback"><?php echo flashError('father_name'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Father Occupation', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'father_occupation', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('father_occupation') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('father_occupation')]); ?>
							<span class="invalid-feedback"><?php echo flashError('father_occupation'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Mother Name', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'mother_name', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('mother_name') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('mother_name')]); ?>
							<span class="invalid-feedback"><?php echo flashError('mother_name'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Mother Occupation', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'mother_occupation', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('mother_occupation') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('mother_occupation')]); ?>
							<span class="invalid-feedback"><?php echo flashError('mother_occupation'); ?></span>
						</div>
					</div>
					<?php echo form_label('Skills', null, ['class' => 'form-label border-bottom']); ?>
					<div class="row">
						<div class="form-group col-md-12">
							<?php echo form_label('Skill Experience', null); ?>
							<div class="d-flex flex-wrap">
								<?php $skill_experience_ids = explode(',', oldInput('skill_experience')); ?>
								<?php foreach ($skill_experiences as $skill_experience) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'skill_experience[]', 'id' => 'SkillExperience' . $skill_experience['id'], 'value' => $skill_experience['id'], 'checked' => in_array($skill_experience['id'], $skill_experience_ids) ? true : false]); ?>
										<?php echo form_label($skill_experience['name'], 'SkillExperience' . $skill_experience['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('skill_experience'); ?></span>
						</div>
						<div class="form-group col-md-12">
							<?php echo form_label('Language Ability', null); ?>
							<div class="d-flex flex-wrap">
								<?php $language_ability_ids = explode(',', oldInput('language_ability')); ?>
								<?php foreach ($language_abilities as $language_ability) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'language_ability[]', 'id' => 'LanguageAbility' . $language_ability['id'], 'value' => $language_ability['id'], 'checked' => in_array($language_ability['id'], $language_ability_ids) ? true : false]); ?>
										<?php echo form_label($language_ability['name'], 'LanguageAbility' . $language_ability['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('language_ability'); ?></span>
						</div>
						<div class="form-group col-md-12">
							<?php echo form_label('Cooking Ability', null); ?>
							<div class="d-flex flex-wrap">
								<?php $cooking_ability_ids = explode(',', oldInput('cooking_ability')); ?>
								<?php foreach ($cooking_abilities as $cooking_ability) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'cooking_ability[]', 'id' => 'CookingAbility' . $cooking_ability['id'], 'value' => $cooking_ability['id'], 'checked' => in_array($cooking_ability['id'], $cooking_ability_ids) ? true : false]); ?>
										<?php echo form_label($cooking_ability['name'], 'CookingAbility' . $cooking_ability['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('cooking_ability'); ?></span>
						</div>
						<div class="form-group col-md-12">
							<?php echo form_label('Work Experience', null); ?>
							<div class="d-flex flex-wrap">
								<?php $work_experience_ids = explode(',', oldInput('work_experience')); ?>
								<?php foreach ($agency_locations as $work_experience) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'work_experience[]', 'id' => 'WorkExperience' . $work_experience['id'], 'value' => $work_experience['id'], 'checked' => in_array($work_experience['id'], $work_experience_ids) ? true : false]); ?>
										<?php echo form_label($work_experience['name'], 'WorkExperience' . $work_experience['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('work_experience'); ?></span>
						</div>
					</div>
					<?php echo form_label('Others', null, ['class' => 'form-label border-bottom']); ?>
					<div class="row">
						<div class="form-group col-md-6">
							<?php echo form_label('Description', null); ?>
							<?php echo form_textarea(['name' => 'description', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('description') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('description')]); ?>
							<span class="invalid-feedback"><?php echo flashError('description'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Link Video', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'link_video', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('link_video') ? ' is-invalid' : ''), 'value' => oldInput('link_video')]); ?>
							<span class="invalid-feedback"><?php echo flashError('link_video'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<?php echo form_label('Ready to Placement', null); ?>
							<div class="d-flex flex-wrap">
								<?php $ready_placement_ids = explode(',', oldInput('ready_placement')); ?>
								<?php foreach ($agency_locations as $ready_placement) { ?>
									<div class="icheck-primary mr-4">
										<?php echo form_checkbox(['name' => 'ready_placement[]', 'id' => 'ReadyPlacement' . $ready_placement['id'], 'value' => $ready_placement['id'], 'checked' => in_array($ready_placement['id'], $ready_placement_ids) ? true : false]); ?>
										<?php echo form_label($ready_placement['name'], 'ReadyPlacement' . $ready_placement['id']); ?>
									</div>
								<?php } ?>
							</div>
							<span class="invalid-feedback"><?php echo flashError('ready_placement'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Placement Now', null); ?>
							<select name="placement" class="form-control select2 rounded-0 <?php echo (hasFlashError('placement')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($agency_locations as $placement) {
									echo '<option value="' .$placement['id']. '">'. $placement['name'] . (($placement['is_local'] == 1) ? ' (Local)' : ' (Oversea)') . '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('placement'); ?></span>
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
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
	$(document).ready(function() {
		// describe required variable
		var workerGender = '<?php echo oldInput('gender'); ?>',
			workerMaritalStatus = '<?php echo oldInput('marital_status'); ?>',
			workerReligion = '<?php echo oldInput('religion'); ?>',
			workerProvince = '<?php echo oldInput('province'); ?>',
			workerPlacement = '<?php echo oldInput('placement'); ?>';

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
		if (workerPlacement && $.isNumeric(workerPlacement)) {
			$('#formData [name="placement"]').val(workerPlacement).trigger('change');
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
				'limit': 100,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			}

			requestCities(param, cityValue, cityElement);
		}
	});

	// form photo event
	$('#formPhoto').on('submit', function(e) {
		e.preventDefault();
		return false;
	});

	// calculate age
	$('#formData [name="birth_date"]').on('change', function () {
		$('#formData [name="age"]').val(null);

		if (Date.parse(this.value)) {
			var today = new Date(),
				birthdate = new Date($(this).datepicker('getDate'));

			var age = today.getFullYear() - birthdate.getFullYear();

			$('#formData [name="age"]').val(age);
		}
	});
</script>

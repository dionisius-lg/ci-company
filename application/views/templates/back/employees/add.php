<div class="row">
	<div class="col-md-2">
		<div class="card">
			<div class="card-body">
				<?php echo form_open(null, ['method' => 'post', 'id' => 'formEmployeesPhoto', 'autocomplete' => 'off']); ?>
					<div class="form-group text-center">
						<div class="border">
							<input type="file" name="photo" class="hidden <?php echo (hasFlashError('photo')) ? 'is-invalid' : ''; ?>" disabled>
							<img src="<?php echo base_url('assets/img/default-avatar.jpg'); ?>" alt="Employees Photo" class="img-fluid" style="opacity: 0.4;">
							<div class="layer hidden">
								<button type="button" class="btn btn-xs btn-outline-primary rounded-0 venobox" hidden> data-toggle="view">View</button>
								<button type="button" class="btn btn-xs btn-outline-success rounded-0" data-toggle="browse" hidden>Change</button>
							</div>
						</div>
					</div>
					<div class="form-group hidden">
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
				<?php echo form_open('admin/employees/create', ['method' => 'post', 'id' => 'formEmployees', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-3">
							<label>NIK <span class="text-danger">*</span></label>
							<input type="text" name="nik" class="form-control form-control-sm rounded-0 numeric <?php echo hasFlashError('nik') ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('nik'); ?>">
							<span class="invalid-feedback"><?php echo flashError('nik'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Fullname <span class="text-danger">*</span></label>
							<input type="text" name="fullname" class="form-control form-control-sm rounded-0 capitalize <?php echo hasFlashError('fullname') ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('fullname'); ?>">
							<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Email <span class="text-danger">*</span></label>
							<input type="text" name="email" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('email')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('email'); ?>">
							<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Phone 1 <span class="text-danger">*</span></label>
							<input type="text" name="phone_1" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_1')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('phone_1'); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Phone 2</label>
							<input type="text" name="phone_2" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_2')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('phone_2'); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Birth Place</label>
							<input type="text" name="birth_place" class="form-control form-control-sm rounded-0 capitalize <?php echo (hasFlashError('birth_place')) ? 'is-invalid' : ''; ?>" maxlength="100" value="<?php echo oldInput('birth_place'); ?>">
							<span class="invalid-feedback"><?php echo flashError('birth_place'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Birth Date</label>
							<input type="text" name="birth_date" class="form-control form-control-sm rounded-0 date <?php echo (hasFlashError('birth_date')) ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('birth_date'); ?>">
							<span class="invalid-feedback"><?php echo flashError('birth_date'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Gender</label>
							<select name="gender" class="form-control select2 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label>Address</label>
							<textarea name="address" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('address')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo oldInput('address'); ?></textarea>
							<span class="invalid-feedback"><?php echo flashError('address'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Province</label>
							<select name="province" class="form-control select2 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($provinces as $province) {
									echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>City</label>
							<select name="city" class="form-control select2 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Religion</label>
							<select name="religion" class="form-control select2 <?php echo (hasFlashError('religion')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('religion'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<button type="submit" class="btn btn-primary rounded-0">Create</button>
							<a href="<?php echo site_url('admin/employees'); ?>" class="btn btn-default rounded-0">Back</a>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>



<?php $this->template->stylesheet->add('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var employeesGender = '<?php echo oldInput('gender'); ?>',
			employeesProvince = '<?php echo oldInput('province'); ?>';

		if (employeesGender && $.isNumeric(employeesGender)) {
			$('#formEmployees [name="gender"]').val(employeesGender).trigger('change');
		}

		if (employeesProvince && $.isNumeric(employeesProvince)) {
			$('#formEmployees [name="province"]').val(employeesProvince).trigger('change');
		}
	});

	//disable submit on submitted form
	$('#formEmployees').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	//onchange element
	$('#formEmployees [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formEmployees [name="city"]'),
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

	//form user photo event
	$('#formEmployeesPhoto').on('submit', function(e) {
		e.preventDefault();
		return false;
	});
</script>
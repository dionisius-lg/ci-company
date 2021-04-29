<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('admin/company/update', ['method' => 'post', 'id' => 'formData', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-6">
							<?php echo form_label('Name <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'name', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('name') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('name', $company['name'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('name'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<?php echo form_label('Address (English) <span class="text-danger">*</span>', null); ?>
							<?php echo form_textarea(['name' => 'address_eng', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('address_eng') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('address_eng', $company['address_eng'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('address_eng'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Address (Indonesian) <span class="text-danger">*</span>', null); ?>
							<?php echo form_textarea(['name' => 'address_ind', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('address_ind') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('address_ind', $company['address_ind'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('address_ind'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<?php echo form_label('Province <span class="text-danger">*</span>', null); ?>
							<select name="province" class="form-control select2 rounded-0 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($provinces as $province) {
									echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('City <span class="text-danger">*</span>', null); ?>
							<select name="city" class="form-control select2 rounded-0 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Zip Code', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'zip_code', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('zip_code') ? ' is-invalid' : ''), 'maxlength' => '10', 'value' => oldInput('zip_code', $company['zip_code'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('zip_code'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<?php echo form_label('Phone Number 1 <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'phone_1', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_1') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_1', $company['phone_1'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Phone Number 2', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'phone_2', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_2') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_2', $company['phone_2'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Email 1 <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email_1', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('email_1') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('email_1', $company['email_1'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('email_1'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<?php echo form_label('Email 2', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email_2', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('email_2') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('email_2', $company['email_2'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('email_2'); ?></span>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Fax2', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fax', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('fax') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('fax', $company['fax'])]); ?>
							<span class="invalid-feedback"><?php echo flashError('fax'); ?></span>
						</div>
					</div>
					<div class="row" id="previewAttachment">
						<div class="form-group col-md-4 item py-1">
							<label>Logo</label>
							<input type="file" name="logo" class="hidden <?php echo (hasFlashError('logo')) ? 'is-invalid' : ''; ?>" data-toggle="change">
							<div class="border">
								<img src="<?php echo @getimagesize(base_url('files/company/thumb/'.$company['logo'])) ? base_url('files/company/thumb/'.$company['logo']) : base_url('assets/img/default-picture.jpg'); ?>" alt="Atacchment Preview" class="img-fluid">
								<div class="layer">
									<button type="button" class="btn btn-sm btn-outline-primary rounded-0 venobox" <?php echo @getimagesize(base_url('files/company/'.$company['logo'])) ? 'data-href="' . base_url('files/company/'.$company['logo']) .'"' : 'hidden'; ?>>View</button>
									<?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-outline-success rounded-0', 'content' => 'Browse', 'data-toggle' => 'browse']); ?>
								</div>
							</div>
							<span class="form-text">Allowed type: jpg, jpeg, png. Max size: 2MB.</span>
							<span class="invalid-feedback"><?php echo flashError('logo'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0 btn-submit', 'content' => 'Update']); ?>
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

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var companyProvince = '<?php echo oldInput("province", $company["province_id"]); ?>';

		if (companyProvince && $.isNumeric(companyProvince)) {
			$('#formData [name="province"]').val(companyProvince).trigger('change');
		}
	});

	//disable submit on submitted form
	$('#formData').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	//onchange element
	$('#formData [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formData [name="city"]'),
			cityValue = '<?php echo oldInput("city", $company["city_id"]); ?>';

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
</script>
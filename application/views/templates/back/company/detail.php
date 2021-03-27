<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('admin/company/update', ['method' => 'post', 'id' => 'formCompany', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Name <span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control form-control-sm rounded-0 capitalize <?php echo (hasFlashError('name')) ? 'is-invalid' : ''; ?>" maxlength="100" value="<?php echo oldInput('name', $company['name']); ?>">
							<span class="invalid-feedback"><?php echo flashError('name'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Address (English) <span class="text-danger">*</span></label>
							<textarea name="address_eng" class="form-control form-control-sm rounded-0 capitalize <?php echo (hasFlashError('address_eng')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo oldInput('address_eng', $company['address_eng']); ?></textarea>
							<span class="invalid-feedback"><?php echo flashError('address_eng'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Address (Indonesian) <span class="text-danger">*</span></label>
							<textarea name="address_ind" class="form-control form-control-sm rounded-0 capitalize <?php echo (hasFlashError('address_ind')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo oldInput('address_ind', $company['address_ind']); ?></textarea>
							<span class="invalid-feedback"><?php echo flashError('address_ind'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-3">
							<label>Province <span class="text-danger">*</span></label>
							<select class="form-control select2 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>" name="province">
								<option value="">Please Select</option>
								<?php foreach ($provinces as $province) {
									echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<label>City <span class="text-danger">*</span></label>
							<select class="form-control select2 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>" name="city">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<label>Zip Code</label>
							<input type="text" name="zip_code" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('zip_code')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('zip_code', $company['zip_code']); ?>">
							<span class="invalid-feedback"><?php echo flashError('zip_code'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label>Phone Number 1 <span class="text-danger">*</span></label>
							<input type="text" name="phone_1" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_1')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('phone_1', $company['phone_1']); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
						</div>
						<div class="form-group col-md-2">
							<label>Phone Number 2</label>
							<input type="text" name="phone_2" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_2')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('phone_2', $company['phone_2']); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<label>Email 1 <span class="text-danger">*</span></label>
							<input type="text" name="email_1" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('email_1')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('email_1', $company['email_1']); ?>">
							<span class="invalid-feedback"><?php echo flashError('email_1'); ?></span>
						</div>
						<div class="form-group col-md-3">
							<label>Email 2</label>
							<input type="text" name="email_2" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('email_2')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('email_2', $company['email_2']); ?>">
							<span class="invalid-feedback"><?php echo flashError('email_2'); ?></span>
						</div>
						<div class="form-group col-md-2">
							<label>Fax</label>
							<input type="text" name="fax" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('fax')) ? 'is-invalid' : ''; ?>" value="<?php echo oldInput('fax', $company['fax']); ?>">
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
									<button type="button" class="btn btn-sm btn-outline-success rounded-0" data-toggle="browse">Browse</button>
								</div>
							</div>
							<span class="invalid-feedback"><?php echo flashError('logo'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<button type="submit" class="btn btn-primary rounded-0">Update</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var companyProvince = '<?php echo oldInput("province", $company["province_id"]); ?>';

		if (companyProvince && $.isNumeric(companyProvince)) {
			$('#formCompany [name="province"]').val(companyProvince).trigger('change');
		}
	});

	//disable submit on submitted form
	$('#formCompany').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	//onchange element
	$('#formCompany [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formCompany [name="city"]'),
			cityValue = '<?php echo oldInput("city", $company["city_id"]); ?>';

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
</script>
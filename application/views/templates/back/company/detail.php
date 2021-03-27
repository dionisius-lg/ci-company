<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link rounded-0 active" data-toggle="tab" href="#Detail">Detail</a>
					</li>
					<li class="nav-item">
						<a class="nav-link rounded-0" data-toggle="tab" href="#About">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link rounded-0" data-toggle="tab" href="#Vision">Vision Mission</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane container active" id="Detail">
						<?php echo form_open_multipart('admin/company/update-profile', ['method' => 'post', 'id' => 'formCompanyProfile', 'autocomplete' => 'off']); ?>
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
								<div class="form-group col-md-12">
									<label>Embed Maps</label>
									<textarea name="maps" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('maps')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo oldInput('maps', (!empty($company['maps']) ? html_entity_decode($company['maps']) : '')); ?></textarea>
									<span class="invalid-feedback"><?php echo flashError('maps'); ?></span>
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

					<div class="tab-pane container fade" id="About">
						<?php echo form_open('admin/company/update-about', ['method' => 'post', 'id' => 'formCompanyAbout', 'autocomplete' => 'off']); ?>
							<div class="row">
								<div class="form-group col-md-12">
									<label>About (English)</label>
									<textarea name="about_eng" class="form-control form-control-sm rounded-0 editor-about <?php echo (hasFlashError('about_eng')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo $company['about_eng']; ?></textarea>
									<span class="invalid-feedback"><?php echo flashError('about_eng'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label>About (Indonesian)</label>
									<textarea name="about_ind" class="form-control form-control-sm rounded-0 editor-about <?php echo (hasFlashError('about_ind')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo $company['about_ind']; ?></textarea>
									<span class="invalid-feedback"><?php echo flashError('about_ind'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-right border-top mt-2 pt-3">
									<button type="submit" class="btn btn-primary rounded-0">Update</button>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>

					<div class="tab-pane container fade" id="Vision">
						<?php echo form_open('admin/company/update-vision', ['method' => 'post', 'id' => 'formCompanyVision', 'autocomplete' => 'off']); ?>
							<div class="row">
								<div class="form-group col-md-12">
									<label>Vission Mission (English)</label>
									<textarea name="vision_eng" class="form-control form-control-sm rounded-0 editor-vision-mission <?php echo (hasFlashError('vision_eng')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo $company['vision_eng']; ?></textarea>
									<span class="invalid-feedback"><?php echo flashError('vision_eng'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label>Vission Mission (Indonesian)</label>
									<textarea name="vision_ind" class="form-control form-control-sm rounded-0 editor-vision-mission <?php echo (hasFlashError('vision_ind')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo $company['vision_ind']; ?></textarea>
									<span class="invalid-feedback"><?php echo flashError('vision_ind'); ?></span>
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
	</div>
</div>

<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/tinymce/tinymce.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var companyProvince = '<?php echo oldInput("province", $company["province_id"]); ?>';

		if (companyProvince && $.isNumeric(companyProvince)) {
			$('#formCompanyProfile [name="province"]').val(companyProvince).trigger('change');
		}
	});

	//describe required var
	var url = window.location.href,
		tabActive = url.substring(url.indexOf("#") + 1);

	//tab content display by url #
	$('a[data-toggle="tab"][href="#' + tabActive + '"]').tab('show');

	//disable submit on submitted form
	$('#formCompanyProfile, #formCompanyAbout, #formCompanyVision').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	//onchange element
	$('#formCompanyProfile [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formCompanyProfile [name="city"]'),
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


tinymce.init({
	selector: '.editor-about',
	theme: 'silver',
	//convert_fonts_to_spans: false,
	//fix_list_elements: true,
	//forced_root_block: '',
	//force_br_newlines: true,
	//force_p_newlines: false,
	invalid_elements: 'script',
	//extended_valid_elements: 'span',
	plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons code',
	menubar: false,
	toolbar: 'undo redo | ontsizeselect | alignleft aligncenter alignright | outdent indent | numlist bullist | insertfile image media template link | fullscreen preview code',
	fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt',
	//block_formats: 'Paragraph=p;Header 3=h3;Header 4=h4',
	quickbars_selection_toolbar: 'bold italic underline | blockquote quicktable hr | forecolor removeformat',
	quickbars_insert_toolbar: 'quicktable hr',
	noneditable_noneditable_class: 'mceNonEditable',
	toolbar_mode: 'sliding',
	image_advtab: true,
	importcss_append: true,
	image_caption: false,
	height: 500,
	content_css: [
		'<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>',
		'<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>',
		'<?php echo base_url("assets//css/company-editor.css"); ?>'
	],
	templates : [{
		title: 'Default Template',
		description: 'Default template for About.',
		content: '<div class="row"><div class="col-lg-6 col-12 order-2 order-lg-1"><img class="img-fluid" src="http://localhost/ci-company/files/editor/about.jpg" alt="" width="1024" height="768" /></div><div class="col-lg-6 col-12 order-1 order-lg-2"><p><span style="color: #3598db;"><strong><span style="font-size: 20pt;">Company Name</span></strong></span></p><p><span style="font-size: 12pt;"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></span></p><ul><li><span style="font-size: 12pt;">Ullamco laboris nisi ut aliquip ex ea commodo consequat</span></li><li><span style="font-size: 12pt;">Duis aute irure dolor in reprehenderit in voluptate velit</span></li></ul><p><span style="font-size: 12pt;">Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></p></div></div>'
	}],
	external_filemanager_path: '<?php echo base_url('filemanager/'); ?>',
	filemanager_title: 'File Manager',
	filemanager_access_key: 'DionisiusLumrangGesangie',
	external_plugins: {
		'responsivefilemanager': '<?php echo base_url("assets/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js"); ?>',
		'filemanager': '<?php echo base_url("filemanager/plugin.min.js"); ?>',
	},
	relative_urls: false,
	remove_script_host: false,
	setup: function(editor) {
		editor.on('change', function () {
			tinymce.triggerSave();
		});
	}
});

tinymce.init({
	selector: '.editor-vision-mission',
	theme: 'silver',
	invalid_elements: 'script',
	plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons code',
	menubar: false,
	toolbar: 'undo redo | ontsizeselect | alignleft aligncenter alignright | outdent indent | numlist bullist | insertfile image media template link | fullscreen preview code',
	fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt',
	//block_formats: 'Paragraph=p;Header 3=h3;Header 4=h4',
	quickbars_selection_toolbar: 'bold italic underline | blockquote quicktable hr | forecolor removeformat',
	quickbars_insert_toolbar: 'quicktable hr',
	noneditable_noneditable_class: 'mceNonEditable',
	toolbar_mode: 'sliding',
	image_advtab: true,
	importcss_append: true,
	image_caption: false,
	height: 300,
	content_css: [
		'<?php echo base_url("assets/vendor/font-awesome/css/font-awesome.min.css"); ?>',
		'<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>',
		'<?php echo base_url("assets//css/company-editor.css"); ?>'
	],
	templates : [{
		title: 'Default Template',
		description: 'Default template for Vision Mission.',
		content: '<div class="row"><div class="col-lg-6"><p><span style="color: #3598db;"><strong><span style="font-size: 20pt;">Vision<br /></span></strong></span></p><p><span style="font-size: 12pt;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span></p></div><div class="col-lg-6"><p><span style="font-size: 12pt;"><span style="color: #3598db;"><strong><span style="font-size: 20pt;">Mission</span></strong></span></span></p><ul><li><span style="font-size: 12pt;">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li><li><span style="font-size: 12pt;">Duis aute irure dolor in reprehenderit in voluptate velit.</span></li><li><span style="font-size: 12pt;">Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li></ul></div></div>'
	}],
	external_filemanager_path: '<?php echo base_url('filemanager/'); ?>',
	filemanager_title: 'File Manager',
	filemanager_access_key: 'DionisiusLumrangGesangie',
	external_plugins: {
		'responsivefilemanager': '<?php echo base_url("assets/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js"); ?>',
		'filemanager': '<?php echo base_url("filemanager/plugin.min.js"); ?>',
	},
	relative_urls: false,
	remove_script_host: false,
	setup: function(editor) {
		editor.on('change', function () {
			tinymce.triggerSave();
		});
	}
});

</script>
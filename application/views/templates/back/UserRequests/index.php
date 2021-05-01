<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/user-requests', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
					<div class="form-row">
						<div class="form-group col-md-2">
							<?php echo form_label('Fullname', 'Fullname'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'id' => 'Fullname', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Email', 'Email'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'id' => 'Email', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Company', 'Company'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'company', 'id' => 'Company', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('company') ? $this->input->get('company') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Register As', 'RegisterAs'); ?>
							<select class="form-control select2 rounded-0" name="register_as" id="RegisterAs">
								<option value="">Please Select</option>
								<?php foreach ($user_levels as $register_as) {
									echo '<option value="' .$register_as['id']. '">'. $register_as['name']. '</option>';
								} ?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Agency Location', 'AgencyLocation'); ?>
							<select class="form-control select2 rounded-0" name="agency_location" id="AgencyLocation">
								<option value="">Please Select</option>
								<?php foreach ($agency_locations as $agency_location) {
									echo '<option value="' .$agency_location['id']. '">'. $agency_location['name']. '</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0', 'content' => 'Search Data']); ?>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr class="">
								<th class="text-nowrap">No.</th>
								<th class="text-nowrap">Fullname</th>
								<th class="text-nowrap">Email</th>
								<th class="text-nowrap">Company</th>
								<th class="text-nowrap">Register As</th>
								<th class="text-nowrap">Agency Location</th>
								<th class="text-nowrap">Request Date</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($users) > 0) {
							foreach ($users as $user) { echo
								'<tr>
									<td class="text-nowrap">' . $no . '</td>
									<td class="text-nowrap">' . $user['fullname'] . '</td>
									<td class="text-nowrap">' . $user['email'] . '</td>
									<td class="text-nowrap">' . $user['company'] . '</td>
									<td class="text-nowrap">' . $user['user_level'] . '</td>
									<td class="text-nowrap">' . $user['agency_location'] . '</td>
									<td class="text-nowrap">' . $user['request_date'] . '</td>
									<td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-sm btn-secondary rounded-0', 'content' => 'Register', 'onclick' => 'detailData(' . $user['id'] . ')']) . '</td>
								</tr>';

								$no++;
							}
						} else { echo
							'<tr>
								<td class="text-center" colspan="7">No data found</td>
							</tr>';
						} ?>
						</tbody>
					</table>
				</div>

				<div class="page-sm page-right">
					<?php echo $pagination; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalData" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-6">
							<?php echo form_label('Username', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'username', 'class' => 'form-control form-control-sm rounded-0 lowercase', 'maxlength' => '30', 'autofocus', true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('User Level', null); ?>
							<select name="user_level" class="form-control select2 rounded-0">
								<option value="">Please Select</option>
								<?php foreach ($user_levels as $level) {
									echo '<option value="' .$level['id']. '">'. $level['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Password', null); ?>
							<?php echo form_input(['type' => 'password', 'name' => 'password', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10']); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Password Repeat', null); ?>
							<?php echo form_input(['type' => 'password', 'name' => 'password_repeat', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10']); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6" hidden>
							<?php echo form_label('Email', null, ['hidden' => true]); ?>
							<?php echo form_input(['type' => 'email', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '100', 'readonly' => true, 'hidden' => true]); ?>
							<span class="invalid-feedback" hidden></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0', 'content' => 'Submit']); ?>
					<?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-default rounded-0', 'content' => 'Cancel', 'data-dismiss' => 'modal']); ?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<script type="text/javascript">
	// describe required variable
	var modalData = $('#modalData'),
		modalDataForm = $('#modalData form');

	$(document).ready(function() {
		// describe required variable
		var filterRegisterAs = '<?php echo $this->input->get('register_as'); ?>',
			filterAgencyLocation = '<?php echo $this->input->get('agency_location'); ?>';

		// set value to element if variable true or numeric
		if (filterRegisterAs && $.isNumeric(filterRegisterAs)) {
			$('#RegisterAs').val(filterRegisterAs).trigger('change');
		}

		// set value to element if variable true or numeric
		if (filterAgencyLocation && $.isNumeric(filterAgencyLocation)) {
			$('#AgencyLocation').val(filterAgencyLocation).trigger('change');
		}
	});

	// detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/user-requests/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					modalDataForm[0].reset();
					modalDataForm.find('select').val(null).trigger('change');
					modalDataForm.attr('action', '<?php echo base_url("admin/user-requests/update/' + id + '"); ?>');
					modalDataForm.find('input, select, textarea').removeClass('is-invalid');
					modalDataForm.find('.invalid-feedback').empty();
					modalDataForm.find('button[type="submit"]').val('Register');

					modalData.find('.modal-header .modal-title').html('Register Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						if (response.status === 'success') {
							modalDataForm.find('input[name="username"]').val(response.data['email']);
							modalDataForm.find('select[name="user_level"]').val(response.data['user_level_id']).trigger('change');
							// $.each(response.data, function(key, val) {
							// 	modalDataForm.find('[name="' + key + '"]').val(val);
							// });

							modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
						}
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				}
			});
		}
	}

	// submited form modal
	modalDataForm.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: modalDataForm.attr('action'),
			type: 'post',
			data: modalDataForm.serialize(),
			dataType: 'json',
			beforeSend: function() {
				modalDataForm.find('.invalid-feedback').empty();
				modalDataForm.find('button').attr('disabled', true);
				modalDataForm.find('button[type="submit"]').prepend('<span class="spinner-border spinner-border-sm mr-2">&nbsp;</span>');
				modalData.find('.close').attr('disabled', true);
			},
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if ('error' in response) {
						if (response.error !== null && typeof response.error === 'object') {
							$.each(response.error, function(key, val) {
								if(val !== '') {
									modalDataForm.find('[name="' + key + '"]').addClass('is-invalid');
									modalDataForm.find('[name="' + key + '"]').parents('.form-group').find('.invalid-feedback').html(val);
								}
							});
						}
					} else {
						modalData.modal('hide');

						if (response.status == 'success') {
							window.location.reload();
						} else {
							toastr.error(response.message);
						}
					}
				}

				modalDataForm.find('button').attr('disabled', false);
				modalDataForm.find('button[type="submit"]').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

				modalDataForm.find('button').attr('disabled', false);
				modalDataForm.find('button[type="submit"]').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			}
		});
	});
</script>
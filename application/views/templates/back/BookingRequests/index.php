<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/booking-requests', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
					<div class="form-row">
					<div class="form-group col-md-2">
							<?php echo form_label('NIK', 'NIK'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'nik', 'id' => 'NIK', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('nik') ? $this->input->get('nik') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Fullname', 'Fullname'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'id' => 'Fullname', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Email', 'Email'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'id' => 'Email', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
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
								<th class="text-nowrap">NIK.</th>
								<th class="text-nowrap">Fullname</th>
								<th class="text-nowrap">Email</th>
								<th class="text-nowrap">Request Date</th>
								<th class="text-nowrap">Request By</th>
								<th class="text-nowrap">Request Agency Location</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($workers) > 0) { ?>
							<?php foreach ($workers as $worker) { ?>
								<tr>
									<td class="text-nowrap"><?php echo $no; ?></td>
									<td class="text-nowrap"><?php echo $worker['nik']; ?></td>
									<td class="text-nowrap"><?php echo $worker['fullname']; ?></td>
									<td class="text-nowrap"><?php echo $worker['email']; ?></td>
									<td class="text-nowrap"><?php echo $worker['booking_date']; ?></td>
									<td class="text-nowrap"><?php echo $worker['booking_by']; ?></td>
									<td class="text-nowrap">
										<?php for ($i = 0; $i < count($agency_locations); $i++) {
											if ($worker['booking_agency_location_id'] == $agency_locations[$i]['id']) {
												echo $agency_locations[$i]['name'];
											}
										} ?>
									</td>
									<td class="text-nowrap"><?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-secondary rounded-0', 'content' => 'Approve', 'onclick' => 'detailData(' . $worker['id'] . ')']); ?></td>
								</tr>

								<?php $no++; ?>
							<?php } ?>
						<?php } else { echo
							'<tr>
								<td class="text-center" colspan="8">No data found</td>
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
							<?php echo form_label('NIK', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Fullname', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Email', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Placement <span class="text-danger">*</span>', null); ?>
							<select name="placement" class="form-control select2 rounded-0">
								<option value="">Please Select</option>
								<?php foreach ($agency_locations as $placement) {
									echo '<option value="' .$placement['id']. '">'. $placement['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Request By', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'request_by', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<?php echo form_label('Request Date', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'request_date', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
							<span class="invalid-feedback"></span>
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
		var filterAgencyLocation = '<?php echo $this->input->get('agency_location'); ?>';

		// set value to element if variable true or numeric
		if (filterAgencyLocation && $.isNumeric(filterAgencyLocation)) {
			$('#AgencyLocation').val(filterAgencyLocation).trigger('change');
		}
	});

	// detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/booking-requests/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					modalDataForm[0].reset();
					modalDataForm.find('select').val(null).trigger('change');
					modalDataForm.attr('action', '<?php echo base_url("admin/booking-requests/update/' + id + '"); ?>');
					modalDataForm.find('input, select, textarea').removeClass('is-invalid');
					modalDataForm.find('.invalid-feedback').empty();
					modalDataForm.find('button[type="submit"]').html('Approve');

					modalData.find('.modal-header .modal-title').html('Approval Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						if (response.status === 'success') {
							modalDataForm.find('input[name="nik"]').val(response.data['nik']);
							modalDataForm.find('input[name="fullname"]').val(response.data['fullname']);
							modalDataForm.find('input[name="email"]').val(response.data['email']);
							modalDataForm.find('input[name="request_by"]').val(response.data['booking_by']);
							modalDataForm.find('input[name="request_date"]').val(response.data['booking_date']);
							modalDataForm.find('select[name="placement"]').val(response.data['booking_agency_location_id']).trigger('change');

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
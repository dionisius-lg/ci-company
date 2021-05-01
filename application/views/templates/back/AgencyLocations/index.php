<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>
				<div class="card-tools">
					<?php echo form_button(['type' => 'button', 'class' => 'btn btn-info btn-sm rounded-0', 'content' => 'New Data', 'onclick' => 'newData()']); ?>
				</div>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/agency-locations', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
					<div class="form-row">
						<div class="form-group col-md-2">
							<?php echo form_label('Name', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'name', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('name') ? $this->input->get('name') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Is Local', null); ?>
							<select class="form-control form-control-sm rounded-0" name="is_local">
								<option value="">Please Select</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
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
								<th class="text-nowrap">Name</th>
								<th class="text-nowrap">Is Local</th>
								<th class="text-nowrap">Is Default</th>
								<th class="text-nowrap">Create Date</th>
								<th class="text-nowrap">Create By</th>
								<th class="text-nowrap">Last Update Date</th>
								<th class="text-nowrap">Last Update By</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($agency_locations) > 0) {
							foreach ($agency_locations as $agency_location) { echo
								'<tr>
									<td class="text-nowrap">' . $no . '</td>
									<td class="text-nowrap">' . $agency_location['name'] . '</td>
									<td class="text-nowrap">' . (($agency_location['is_local'] == 1) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
									<td class="text-nowrap">' . (($agency_location['is_default'] == 1) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
									<td class="text-nowrap">' . $agency_location['create_date'] . '</td>
									<td class="text-nowrap">' . $agency_location['create_by'] . '</td>
									<td class="text-nowrap">' . $agency_location['update_date'] . '</td>
									<td class="text-nowrap">' . $agency_location['update_by'] . '</td>
									<td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailData(' . $agency_location['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $agency_location['id'] . ')']) . '</td>
								</tr>';

								$no++;
							}
						} else { echo
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

<!-- modal add/edit data -->
<div class="modal fade" id="modalData" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary rounded-0">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-md-12">
							<?php echo form_label('Name <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'name', 'class' => 'form-control form-control-sm rounded-0 capitalize', 'maxlength' => '100', 'autofocus' => true]); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-12">
							<div class="icheck-primary">
								<?php echo form_checkbox(['name' => 'is_local', 'id' => 'IsLocal', 'value' => '1']); ?>
								<?php echo form_label('Set As Local', 'IsLocal'); ?>
							</div>
						</div>
						<div class="form-group col-md-12">
							<div class="icheck-primary">
								<?php echo form_checkbox(['name' => 'is_default', 'id' => 'IsDefault', 'value' => '1']); ?>
								<?php echo form_label('Set As Default', 'IsDefault'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary btn-sm rounded-0 btn-submit', 'content' => 'Submit']); ?>
					<?php echo form_button(['type' => 'button', 'class' => 'btn btn-default btn-sm rounded-0 btn-cancel', 'content' => 'Cancel', 'data-dismiss' => 'modal']); ?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.css', ['type' => 'text/css']); ?>

<script type="text/javascript">
	// describe required variable
	var modalData = $('#modalData'),
		modalDataForm = $('#modalData form');

	// add new data
	function newData() {
		modalDataForm[0].reset();
		modalDataForm.find('select').val(null).trigger('change');
		modalDataForm.attr({'action': '<?php echo base_url("admin/agency-locations/create"); ?>'});
		modalDataForm.find('input, select, textarea').removeClass('is-invalid');
		modalDataForm.find('.invalid-feedback').empty();
		modalDataForm.find('.btn-submit').html('Create');

		modalData.find('.modal-header .modal-title').html('Create New Data');
		modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	// detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/agency-locations/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					modalDataForm[0].reset();
					modalDataForm.find('select').val(null).trigger('change');
					modalDataForm.attr({'action': '<?php echo base_url("admin/agency-locations/update/' + id + '"); ?>'});
					modalDataForm.find('input, select, textarea').removeClass('is-invalid');
					modalDataForm.find('.invalid-feedback').empty();
					modalDataForm.find('.btn-submit').html('Update');

					modalData.find('.modal-header .modal-title').html('Detail Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						if (response.status === 'success') {
							modalDataForm.find('[name="name"]').val(response.data['name']);

							if (response.data['is_local'] == '1') {
								modalDataForm.find('[name="is_local"]').attr({'checked': true});
							}

							if (response.data['is_default'] == '1') {
								modalDataForm.find('[name="is_default"]').attr({'checked': true});
							}

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

	// delete data by id
	function deleteData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			var swalBootstrap = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary rounded-0 mr-2',
					cancelButton: 'btn btn-default rounded-0'
				},
				buttonsStyling: false
			});

			swalBootstrap.fire({
				title: 'Delete this data?',
				text: 'This action cannot be undone.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Confirm'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?php echo base_url("admin/agency-locations/delete/' + id + '"); ?>',
						type: 'get',
						dataType: 'json',
						success: function(response) {
							if (response.status == 'success') {
								 window.location.reload();
							} else {
								toastr.error(response.message);
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
						}
					});
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
				modalDataForm.find('.btn-submit, .btn-cancel').attr('disabled', true);
				modalDataForm.find('.btn-submit').prepend('<span class="spinner-border spinner-border-sm mr-2">&nbsp;</span>');
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

				modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
				modalDataForm.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				console.log(jqXHR.responseText);

				modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
				modalDataForm.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			}
		});
	});
</script>
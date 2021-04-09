<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>
				<div class="card-tools">
					<?php echo anchor('admin/workers/add', 'New Data', ['class' => 'btn btn-info btn-sm rounded-0']); ?>
				</div>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/workers', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
					<div class="form-row">
						<div class="form-group col-md-2">
							<?php echo form_label('NIK', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('nik') ? $this->input->get('nik') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Fullname', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Email', 'Email'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'id' => 'Email', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('email') ? $this->input->get('email') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Agency', null); ?>
							<select class="form-control select2 rounded-0" name="agency_country">
								<option value="">Please Select</option>
								<?php foreach ($agency_countries as $agency_country) {
									echo '<option value="' .$agency_country['id']. '">'. $agency_country['name']. '</option>';
								} ?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Placement Ready', null); ?>
							<select class="form-control select2 rounded-0" name="placement_ready">
								<option value="">Please Select</option>
								<?php foreach ($agency_countries as $placement_ready) {
									echo '<option value="' .$placement_ready['id']. '">'. $placement_ready['name']. '</option>';
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
								<th class="text-nowrap">NIK</th>
								<th class="text-nowrap">Fullname</th>
								<th class="text-nowrap">Email</th>
								<th class="text-nowrap">Agency</th>
								<th class="text-nowrap">Placement Ready</th>
								<th class="text-nowrap">User Account</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($workers) > 0) {
							foreach ($workers as $worker) { echo
								'<tr>
									<td class="text-nowrap">' . $no . '</td>
									<td class="text-nowrap">' . $worker['nik'] . '</td>
									<td class="text-nowrap">' . $worker['fullname'] . '</td>
									<td class="text-nowrap">' . $worker['email'] . '</td>
									<td class="text-nowrap">' . $worker['agency_country'] . '</td>
									<td class="text-nowrap">' . $worker['placement_ready'] . '</td>
									<td class="text-nowrap">' . ((!empty($worker['user_id'])) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
									<td class="text-nowrap">' . anchor('admin/workers/detail/' . $worker['id'], '<i class="fa fa-eye fa-fw"></i>', ['class' => 'btn btn-info btn-xs rounded-0', 'title' => 'Detail']) . '&nbsp;' . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $worker['id'] . ')']) . '</td>
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

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		// describe required variable
		var filterAgencyCountry = '<?php echo $this->input->get('agency_country'); ?>',
			filterPlacementReady = '<?php echo $this->input->get('placement_ready'); ?>';

		// set value to element if variable true or numeric
		if (filterAgencyCountry && $.isNumeric(filterAgencyCountry)) {
			$('#formFilter [name="agency_country"]').val(filterAgencyCountry).trigger('change');
		}

		// set value to element if variable true or numeric
		if (filterPlacementReady !== null && filterPlacementReady !== undefined && $.isNumeric(filterPlacementReady)) {
			$('#formFilter [name="placement_ready"]').val(filterPlacementReady).trigger('change');
		}
	});

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
						url: '<?php echo base_url("admin/workers/delete/' + id + '"); ?>',
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
</script>
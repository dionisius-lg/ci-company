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
							<?php echo form_label('Ref Number', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'ref_number', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('ref_number') ? $this->input->get('ref_number') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Fullname', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Placement', null); ?>
							<select class="form-control select2 rounded-0" name="placement">
								<option value="">Please Select</option>
								<?php foreach ($placements as $placement) {
									echo '<option value="' .$placement['id']. '">'. $placement['name']. '</option>';
								} ?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<?php echo form_label('Booking Status', null); ?>
							<select class="form-control select2 rounded-0" name="booking_status">
								<option value="">Please Select</option>
								<option value="1">Free</option>
								<option value="2">On Booking</option>
								<option value="3">Confirmed</option>
								<option value="4">Approved</option>
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
								<th class="text-nowrap">Ref Number</th>
								<th class="text-nowrap">Fullname</th>
								<th class="text-nowrap">Placement</th>
								<th class="text-nowrap">Booking Status</th>
								<th class="text-nowrap">User Account</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($workers) > 0) {
							foreach ($workers as $worker) { echo
								'<tr>
									<td class="text-nowrap">' . $no . '</td>
									<td class="text-nowrap">' . $worker['ref_number'] . '</td>
									<td class="text-nowrap">' . $worker['fullname'] . '</td>
									<td class="text-nowrap">' . $worker['placement'] . '</td>
									<td class="text-nowrap">' . $worker['booking_status'] . '</td>
									<td class="text-nowrap">' . ((!empty($worker['user_id'])) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
									<td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'return window.location.href = \'' . base_url('admin/workers/detail/' . $worker['id']) . '\';']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $worker['id'] . ')']) . (($worker['booking_status_id'] == 3) ? form_button(['type' => 'button', 'class' => 'btn btn-warning btn-xs rounded-0', 'content' => '<i class="fa fa-exclamation-triangle fa-fw"></i>', 'title' => 'Booking Request', 'onclick' => 'window.location.href = \'' . base_url('admin/booking-requests?nik=' . $worker['nik']) . '\'']) : '') . '</td>
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
		var filterPlacement = '<?php echo $this->input->get('placement'); ?>',
			filterBookingStatus = '<?php echo $this->input->get('booking_status'); ?>';

		// set value to element if variable true or numeric
		if (filterPlacement && $.isNumeric(filterPlacement)) {
			$('#formFilter [name="placement"]').val(filterPlacement).trigger('change');
		}

		// set value to element if variable true or numeric
		if (filterBookingStatus !== null && filterBookingStatus !== undefined && $.isNumeric(filterBookingStatus)) {
			$('#formFilter [name="booking_status"]').val(filterBookingStatus).trigger('change');
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

	// approve booking by id
	function approveBooking(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			var swalBootstrap = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary rounded-0 mr-2',
					cancelButton: 'btn btn-default rounded-0'
				},
				buttonsStyling: false
			});

			swalBootstrap.fire({
				title: 'Approved this request?',
				text: 'This action cannot be undone.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Confirm'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?php echo base_url("admin/workers/approve-booking/' + id + '"); ?>',
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
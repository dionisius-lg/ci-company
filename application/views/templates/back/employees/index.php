<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-8 table-menu">
						<a href="<?php echo site_url('admin/employees/add'); ?>" class="btn btn-primary btn-sm rounded-0">New Data</a>
						<button type="button" class="btn btn-default btn-sm rounded-0" onclick="reloadData()">Reload Data</button>
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" class="form-control form-control-sm rounded-0" id="inputFilter" placeholder="Search">
							<div class="input-group-append">
								<button type="button" class="btn btn-info btn-sm rounded-0" id="submitFilter" title="Search"><i class="fa fa-search"></i></button>
								<button type="button" class="btn btn-default btn-sm rounded-0" id="resetFilter" title="Reset"><i class="fa fa-refresh"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableData" width="100%">
						<thead class="table-primary">
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">NIK</th>
								<th class="text-center">Fullname</th>
								<th class="text-center">Email</th>
								<th class="text-center">Create Date</th>
								<th class="text-center">Create By</th>
								<th class="text-center">Update Date</th>
								<th class="text-center">Update By</th>
								<th class="text-center">User Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="row" id="tableDataOption" class="text-center">
					<div class="col-md-12 table-length"></div>
					<div class="col-md-12 table-paginate d-flex flex-sm-row flex-column justify-content-between"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalData" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary rounded-0">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open(null, ['method' => 'post', 'id' => 'formModal', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Username <span class="text-danger">*</span></label>
							<input type="text" name="username" class="form-control form-control-sm rounded-0 lowercase" maxlength="30" value="">
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<label>User Level <span class="text-danger">*</span></label>
							<select class="form-control select2 rounded-0" name="user_level">
								<option value="">Please Select</option>
								<?php foreach ($user_levels as $user_level) {
									echo '<option value="' .$user_level['id']. '">'. $user_level['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row default-hide-1">
						<div class="form-group col-md-6">
							<label>Request Date</label>
							<input type="text" name="request_date" class="form-control form-control-sm rounded-0" maxlength="20" value="" readonly>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<label>Register Status <span class="text-danger">*</span></label>
							<select class="form-control form-control-sm rounded-0" name="is_register">
								<option value="1">Register</option>
								<option value="0">Not Register</option>
							</select>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<label>Employees Status</label>
							<input type="text" name="is_employees" class="form-control form-control-sm rounded-0" maxlength="20" value="" readonly>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row default-hide-2">
						<div class="form-group col-md-6">
							<label>NIK</label>
							<input type="text" name="nik" class="form-control form-control-sm rounded-0" maxlength="20" value="" readonly>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-6">
							<label>Fullname</label>
							<input type="text" name="fullname" class="form-control form-control-sm rounded-0" maxlength="20" value="" readonly>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<button type="button" class="btn btn-success btn-sm rounded-0 btn-password float-left">Reset Password</button>
							<button type="submit" class="btn btn-primary btn-sm rounded-0 btn-submit">Submit</button>
							<button type="button" class="btn btn-default btn-sm rounded-0 btn-cancel" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<?php $this->template->stylesheet->add('assets/vendor/datatables/css/dataTables.bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/css/bs4-datatables.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<script type="text/javascript">
	var tableData;

	$(document).ready(function() {
		//get datatable
		tabledata = $('#tableData').DataTable({
			'processing': true,
			'serverSide': true,
			//'bPaginate': true,
			//'bLengthChange': true,
			//'bFilter': true,
			//'bSort': true,
			//'bInfo': true,
			//'bAutoWidth': false,
			//'aaSorting': [
			//	[0, null]
			//],
			'order': [
				[ 0, 'desc' ]
			],
			'lengthMenu': [
				[10, 25, 50],
				[10, 25, 50]
			],
			'ajax': {
				'url': '<?php echo base_url("remote/get-employees-list"); ?>',
				'type': 'post'
			},
			'columnDefs': [{
				'targets': [-1, 0],
				'orderable': false
			}, {
				'targets': [-1],
				'className': 'text-center'
			}],
			'drawCallback': function( settings ) {
				$('.form-control').addClass('rounded-0');
				$('.pagination').addClass('pagination-sm');
				$('#tableData').next().attr({'id': 'tableData_option'});
				$('thead tr th').addClass('text-nowrap');
				$('tbody tr').find('td:last').addClass('text-nowrap');
			},
			'language': {
				'searchPlaceholder': 'Search',
				'search': '',
				'processing': '<div class="spinner-grow text-primary"></div><div class="spinner-grow text-warning"></div><div class="spinner-grow text-secondary"></div><div class="d-block text-center"><strong>Loading..</strong></div>'
			},
			//'dom': 'rt<"row"<"col-sm-12 col-md-5"<"d-inline"li>><"col-sm-12 col-md-7"p>>',
			'initComplete': (settings, json)=>{
				$('#tableData_length').appendTo('#tableDataOption .table-length');
				$('#tableData_info').appendTo('#tableDataOption .table-paginate');
				$('#tableData_paginate').appendTo('#tableDataOption .table-paginate');
				$('#tableData_filter').hide();
			},
		});
	});

	//on keypress input filter
	$('#inputFilter').keypress(function(e) {
		if (e.which == 13) {
			$('#submitFilter').trigger('click');
		}
	});

	//on click submit filter
	$('#submitFilter').on('click', function(e) {
		$('#tableData').DataTable().search($('#inputFilter').val()).draw();
	});

	//on click reset filter
	$('#resetFilter').on('click', function(e) {
		$('#inputFilter').val(null).clone(true);
		$('#submitFilter').trigger('click');
	});

	//reload table data
	function reloadData() {
		tabledata.ajax.reload();
	}

	//delete data by id
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
						url: '<?php echo base_url("admin/employees/delete/' + id + '"); ?>',
						type: 'get',
						dataType: 'json',
						success: function(response) {
							(response.status == 'success') ? toastr.success(response.message) : toastr.error(response.message);
							reloadData();
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
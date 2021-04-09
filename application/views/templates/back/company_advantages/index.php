<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-8 table-menu">
						<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="newData()">New Data</button>
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
								<th class="text-center text-nowrap">No. </th>
								<th class="text-center text-nowrap">Title (Eng)</th>
								<th class="text-center text-nowrap">Title (Ind)</th>
								<th class="text-center text-nowrap">Create Date</th>
								<th class="text-center text-nowrap">Create By</th>
								<th class="text-center text-nowrap">Update Date</th>
								<th class="text-center text-nowrap">Update By</th>
								<th class="text-center text-nowrap">Action</th>
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
					<div class="form-row">
						<div class="col-md-6 mb-2">
							<label>Title (Eng) <span class="text-danger">*</span></label>
							<input type="text" name="title_eng" class="form-control form-control-sm rounded-0 capitalize" maxlength="100" value="">
							<span class="invalid-feedback"></span>
						</div>
						<div class="col-md-6 mb-2">
							<label>Short Description (Eng)</label>
							<textarea name="detail_eng" class="form-control form-control-sm rounded-0" rows="4" style="resize:none;"></textarea>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-6 mb-2">
							<label>Title (Ind) <span class="text-danger">*</span></label>
							<input type="text" name="title_ind" class="form-control form-control-sm rounded-0 capitalize" maxlength="100" value="">
							<span class="invalid-feedback"></span>
						</div>
						<div class="col-md-6 mb-2">
							<label>Short Description (Ind)</label>
							<textarea name="detail_ind" class="form-control form-control-sm rounded-0" rows="4" style="resize:none;"></textarea>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
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

<?php $this->template->javascript->add('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
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
				'url': '<?php echo base_url("remote/get-company-advantages-list"); ?>',
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

	//add new data
	function newData() {
		$('#formModal')[0].reset();
		$('#formModal').attr({'action': '<?php echo base_url("admin/company-advantages/create"); ?>'});
		$('#formModal input, #formModal textarea, #formModal select').removeClass('is-invalid');
		$('#formModal .invalid-feedback').empty();
		$('#formModal .btn-submit').html('Create');

		$('#modalData .modal-title').html('Create New Data');
		$('#modalData').modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	//detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/company-advantages/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					$('#formModal')[0].reset();
					$('#formModal').attr({'action': '<?php echo base_url("admin/company-advantages/update/' + id + '"); ?>'});
					$('#formModal input, #formModal textarea, #formModal select').removeClass('is-invalid');
					$('#formModal .invalid-feedback').empty();
					$('#formModal .btn-submit').html('Update');

					$('#modalData .modal-title').html('Detail Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						if (response.status = 'success') {
							$.each(response.data, function(key, val) {
								$('#formModal').find('[name="' + key + '"]').val(val);
							});

							$('#modalData').modal({'backdrop': 'static', 'keyboard': false, 'show': true});
						}
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				}
			});
		}
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
						url: '<?php echo base_url("admin/company-advantages/delete/' + id + '"); ?>',
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

	//submited form modal
	$('#formModal').on('submit', function(e) {
		e.preventDefault();

		var formData = $(this),
			modalData = $('#modalData');

		$.ajax({
			url: formData.attr('action'),
			type: 'post',
			data: formData.serialize(),
			dataType: 'json',
			beforeSend: function() {
				formData.find('.invalid-feedback').empty();
				formData.find('.btn-submit, .btn-cancel').attr('disabled', true);
				formData.find('.btn-submit').prepend('<span class="spinner-border spinner-border-sm mr-2">&nbsp;</span>');
				modalData.find('.close').attr('disabled', true);
			},
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if ('error' in response) {
						if (response.error !== null && typeof response.error === 'object') {
							$.each(response.error, function(key, val) {
								if(val !== '') {
									formData.find('[name="' + key + '"]').addClass('is-invalid');
									formData.find('[name="' + key + '"]').parents('.form-group').find('.invalid-feedback').html(val);
								}
							});
						}
					} else {
						modalData.modal('hide');
						(response.status == 'success') ? toastr.success(response.message) : toastr.error(response.message);
						reloadData();
					}
				}

				formData.find('.btn-submit, .btn-cancel').attr('disabled', false);
				formData.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

				formData.find('.btn-submit, .btn-cancel').attr('disabled', false);
				formData.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			}
		});
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<button type="button" class="btn btn-primary btn-sm rounded-0" onclick="newData()">New Data</button>
				<button type="button" class="btn btn-default btn-sm rounded-0" onclick="reloadData()">Reload Data</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableData" width="100%">
						<thead class="table-primary">
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Slider</th>
								<th class="text-center">Order</th>
								<th class="text-center">Link To</th>
								<th class="text-center">Create Date</th>
								<th class="text-center">Create By</th>
								<th class="text-center">Update Date</th>
								<th class="text-center">Update By</th>
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
				<p class="modal-title">Modal title</p>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open_multipart(null, ['method' => 'post', 'id' => 'formModal', 'autocomplete' => 'off']); ?>
					<div class="row" id="previewAttachment">
						<div class="form-group col-md-12 item py-1">
							<label>Slider <span class="text-danger">*</span></label>
							<input type="file" name="picture" class="hidden" data-toggle="change">
							<div class="border">
								<img src="" alt="Atacchment Preview" class="img-fluid">
								<div class="layer">
									<button type="button" class="btn btn-sm btn-outline-primary rounded-0 venobox" hidden>View</button>
									<button type="button" class="btn btn-sm btn-outline-success rounded-0" data-toggle="browse">Browse</button>
								</div>
							</div>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<label>Order</label>
							<input type="text" name="order_number" class="form-control form-control-sm rounded-0 numeric" value="">
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-10">
							<label>Link To</label>
							<input type="text" name="link_to" class="form-control form-control-sm rounded-0" value="">
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

<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/datatables/css/dataTables.bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/css/bs4-datatables.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
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
				'url': '<?php echo base_url("remote/get-sliders-list"); ?>',
				'type': 'post'
			},
			'columnDefs': [{
				'targets': [-1, 0, 1 , 3],
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
				$('.venobox').venobox();
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

	//show temp filename
	$('#formModal .custom-file-input').on('change', function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass('selected').html(fileName);
	});

	//reload table data
	function reloadData() {
		tabledata.ajax.reload();
	}

	//add new data
	function newData() {
		$('#formModal')[0].reset();
		$('#formModal').attr({'action': '<?php echo base_url("admin/sliders/create"); ?>'});
		$('#formModal input, #formModal textarea, #formModal select').removeClass('is-invalid');
		$('#formModal .invalid-feedback').empty();
		$('#formModal .btn-submit').html('Create');
		$('#formModal img').attr({'src': '<?php echo base_url('assets/img/default-picture.jpg'); ?>'});

		$('#modalData .modal-title').html('Create New Slider');
		$('#modalData').modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	//detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/sliders/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					$('#formModal')[0].reset();
					$('#formModal').attr({'action': '<?php echo base_url("admin/sliders/update/' + id + '"); ?>'});
					$('#formModal input, #formModal textarea, #formModal select').removeClass('is-invalid');
					$('#formModal .invalid-feedback').empty();
					$('#formModal .btn-submit').html('Update');

					$('#modalData .modal-title').html('Detail Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						$('#formModal img').attr({'src': response.file});
						$('#formModal [name="order_number"]').val(response.order_number);
						$('#formModal [name="link_to"]').val(response.link_to);

						$('#modalData').modal({'backdrop': 'static', 'keyboard': false, 'show': true});
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
						url: '<?php echo base_url("admin/sliders/delete/' + id + '"); ?>',
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
			data: new FormData(formData[0]),
			dataType: 'json',
			async: true,
			cache: false,
			contentType: false,
			processData: false,
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
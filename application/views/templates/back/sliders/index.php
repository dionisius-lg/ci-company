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
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr class="">
								<th class="text-nowrap">No.</th>
								<th class="text-nowrap">Slider</th>
								<th class="text-nowrap">Order</th>
								<th class="text-nowrap">Link To</th>
								<th class="text-nowrap">Create Date</th>
								<th class="text-nowrap">Create By</th>
								<th class="text-nowrap">Last Update Date</th>
								<th class="text-nowrap">Last Update By</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>
						<tbody>
						;
						<?php if (count($sliders) > 0) {
							foreach ($sliders as $slider) { echo
								'<tr>
									<td class="text-nowrap">' . $no . '</td>
									<td class="text-nowrap">' . (@getimagesize(base_url('files/sliders/'.$slider['picture'])) ? '<a href="' . base_url('files/sliders/'.$slider['picture']) . '" class="venobox">View Slider</a>' : 'File not found') . '</td>
									<td class="text-nowrap">' . $slider['order_number'] . '</td>
									<td class="text-wrap">' . $slider['link_to'] . '</td>
									<td class="text-nowrap">' . $slider['create_date'] . '</td>
									<td class="text-nowrap">' . $slider['create_by'] . '</td>
									<td class="text-nowrap">' . $slider['update_date'] . '</td>
									<td class="text-nowrap">' . $slider['update_by'] . '</td>
									<td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailData(' . $slider['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $slider['id'] . ')']) . '</td>
								</tr>';

								$no++;
							}
						} else { echo
							'<tr>
								<td class="text-center" colspan="9">No data found</td>
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
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary rounded-0">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<?php echo form_open_multipart(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
				<div class="modal-body">
					<div class="row" id="previewAttachment">
						<div class="form-group col-md-12 item py-1">
							<?php echo form_label('Slider <span class="text-danger">*</span>', null); ?>
							<?php echo form_input(['type' => 'file', 'name' => 'picture', 'class' => 'hidden', 'data-toggle' => 'change']); ?>
							<div class="border">
								<img src="" alt="Attachment Preview" class="img-fluid">
								<div class="layer">
									<?php echo form_button(['type' => 'button', 'class' => 'btn btn-outline-success btn-sm rounded-0', 'content' => 'Browse', 'data-toggle' => 'browse']); ?>
								</div>
							</div>
							<span class="invalid-feedback"></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<?php echo form_label('Order', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'order_number', 'class' => 'form-control form-control-sm rounded-0 numeric', 'maxlength' => '3']); ?>
							<span class="invalid-feedback"></span>
						</div>
						<div class="form-group col-md-10">
							<?php echo form_label('Link To', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'link_to', 'class' => 'form-control form-control-sm rounded-0']); ?>
							<span class="invalid-feedback"></span>
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
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>

<script type="text/javascript">
	// describe required variable
	var modalData = $('#modalData'),
		modalDataForm = $('#modalData form');

	// add new data
	function newData() {
		modalDataForm[0].reset();
		modalDataForm.find('select').val(null).trigger('change');
		modalDataForm.attr({'action': '<?php echo base_url("admin/sliders/create"); ?>'});
		modalDataForm.find('input, select, textarea').removeClass('is-invalid');
		modalDataForm.find('.invalid-feedback').empty();
		modalDataForm.find('.btn-submit').html('Create');
		modalDataForm.find('img').attr({'src': '<?php echo base_url('assets/img/default-picture.jpg'); ?>'});

		modalData.find('.modal-header .modal-title').html('Create New Data');
		modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	// detail data by id
	function detailData(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			$.ajax({
				url: '<?php echo base_url("admin/sliders/detail/' + id + '"); ?>',
				type: 'get',
				dataType: 'json',
				beforeSend: function() {
					modalDataForm[0].reset();
					modalDataForm.find('select').val(null).trigger('change');
					modalDataForm.attr({'action': '<?php echo base_url("admin/sliders/update/' + id + '"); ?>'});
					modalDataForm.find('input, select, textarea').removeClass('is-invalid');
					modalDataForm.find('.invalid-feedback').empty();
					modalDataForm.find('.btn-submit').html('Update');

					modalData.find('.modal-header .modal-title').html('Detail Data');
				},
				success: function(response) {
					if (response !== null && typeof response === 'object') {
						if (response.status === 'success') {
							modalDataForm.find('img').attr({'src': response.data['file']});
							modalDataForm.find('[name="order_number"]').val(response.data['order_number']);
							modalDataForm.find('[name="link_to"]').val(response.data['link_to']);

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
						url: '<?php echo base_url("admin/sliders/delete/' + id + '"); ?>',
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
			data: new FormData(modalDataForm[0]),
			dataType: 'json',
			async: true,
			cache: false,
			contentType: false,
			processData: false,
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

				modalDataForm.find('.btn-submit, .btn-cancel').attr('disabled', false);
				modalDataForm.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

				modalDataForm.find('.btn-submit, .btn-cancel').attr('disabled', false);
				modalDataForm.find('.btn-submit').find('span').remove();
				modalData.find('.close').attr('disabled', false);
			}
		});
	});
</script>
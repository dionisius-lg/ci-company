<div class="row">
	<div class="col-md-2">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('admin/employees/upload-photo/'.$employees['id'], ['method' => 'post', 'id' => 'formEmployeesPhoto', 'autocomplete' => 'off']); ?>
					<div class="form-group text-center">
						<div class="border">
							<input type="file" name="photo" class="hidden <?php echo (hasFlashError('photo')) ? 'is-invalid' : ''; ?>">
							<img src="<?php echo @getimagesize(base_url('files/employees/'.$employees['id'].'/'.$employees['photo'])) ? base_url('files/employees/'.$employees['id'].'/'.$employees['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="Employees Photo" class="img-fluid">
							<div class="layer">
								<button type="button" class="btn btn-xs btn-outline-primary rounded-0 venobox" <?php echo @getimagesize(base_url('files/employees/'.$employees['id'].'/'.$employees['photo'])) ? 'data-href="' . base_url('files/employees/'.$employees['id'].'/'.$employees['photo']) .'"' : 'hidden'; ?> data-toggle="view">View</button>
								<button type="button" class="btn btn-xs btn-outline-success rounded-0" data-toggle="browse">Change</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="progress progress-md mt-2" hidden>
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<span class="form-text text-danger"></span>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<div class="card">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Detail</h3>
					<a href="javascript:void(0);"><i class="fa fa-download"></i> Download</a>
				</div>
			</div>
			<div class="card-body">
				<?php echo form_open('admin/employees/update/'.$employees['id'], ['method' => 'post', 'id' => 'formEmployees', 'autocomplete' => 'off']); ?>
					<div class="row">
						<div class="form-group col-md-3">
							<label>NIK <span class="text-danger">*</span></label>
							<input type="text" name="nik" class="form-control form-control-sm rounded-0 numeric <?php echo hasFlashError('nik') ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('nik', $employees['nik']); ?>">
							<span class="invalid-feedback"><?php echo flashError('nik'); ?></span>
						</div>
						<div class="form-group col-md-6">
							<label>Fullname <span class="text-danger">*</span></label>
							<input type="text" name="fullname" class="form-control form-control-sm rounded-0 capitalize <?php echo hasFlashError('fullname') ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('fullname', $employees['fullname']); ?>">
							<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Email <span class="text-danger">*</span></label>
							<input type="text" name="email" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('email')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('email', $employees['email']); ?>">
							<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Phone 1 <span class="text-danger">*</span></label>
							<input type="text" name="phone_1" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_1')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('phone_1', $employees['phone_1']); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Phone 2</label>
							<input type="text" name="phone_2" class="form-control form-control-sm rounded-0 numeric <?php echo (hasFlashError('phone_2')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('phone_2', $employees['phone_2']); ?>">
							<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Birth Place</label>
							<input type="text" name="birth_place" class="form-control form-control-sm rounded-0 capitalize <?php echo (hasFlashError('birth_place')) ? 'is-invalid' : ''; ?>" maxlength="100" value="<?php echo oldInput('birth_place', $employees['birth_place']); ?>">
							<span class="invalid-feedback"><?php echo flashError('birth_place'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Birth Date</label>
							<input type="text" name="birth_date" class="form-control form-control-sm rounded-0 date <?php echo (hasFlashError('birth_date')) ? 'is-invalid' : ''; ?>" maxlength="20" value="<?php echo oldInput('birth_date', $employees['birth_date']); ?>">
							<span class="invalid-feedback"><?php echo flashError('birth_date'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Gender</label>
							<select name="gender" class="form-control select2 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12">
							<label>Address</label>
							<textarea name="address" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('address')) ? 'is-invalid' : ''; ?>" rows="3" style="resize:none;"><?php echo oldInput('address', $employees['address']); ?></textarea>
							<span class="invalid-feedback"><?php echo flashError('address'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Province</label>
							<select name="province" class="form-control select2 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
								<?php foreach ($provinces as $province) {
									echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
								} ?>
							</select>
							<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>City</label>
							<select name="city" class="form-control select2 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>Religion</label>
							<select name="religion" class="form-control select2 <?php echo (hasFlashError('religion')) ? 'is-invalid' : ''; ?>">
								<option value="">Please Select</option>
							</select>
							<span class="invalid-feedback"><?php echo flashError('religion'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Username</label>
							<input type="text" name="username" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('user_id')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('username', (!empty($employees['user_id']) ? $employees['username'] : 'Not Register')); ?>" readonly>
							<span class="invalid-feedback"><?php echo flashError('user_id'); ?></span>
						</div>
						<div class="form-group col-md-4">
							<label>User Level</label>
							<input type="text" name="user_level" class="form-control form-control-sm rounded-0 <?php echo (hasFlashError('user_level')) ? 'is-invalid' : ''; ?>" maxlength="30" value="<?php echo oldInput('user_level', (!empty($employees['user_id']) ? $employees['user_level'] : 'Not Register')); ?>" readonly>
							<span class="invalid-feedback"><?php echo flashError('user_level'); ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-2 pt-3">
							<input type="hidden" name="user_id" value="<?php echo oldInput('user_id', $employees['user_id']); ?>">
							<button type="button" class="btn btn-success rounded-0 float-left" onclick="modalUser()">Select User</button>
							<button type="submit" class="btn btn-primary rounded-0">Update</button>
							<a href="<?php echo site_url('admin/employees'); ?>" class="btn btn-default rounded-0">Back</a>
						</div>
					</div>
				<?php echo form_close(); ?>
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
				<?php echo form_open(null, ['method' => 'post', 'id' => 'formModal', 'autocomplete' => 'off']); ?>
				<div class="form-row">
					<div class="col-md-6 mb-2">
						<label>Username</label>
						<input type="text" name="username" class="form-control form-control-sm rounded-0 lowercase" maxlength="100" placeholder="Search Username">
					</div>
					<div class="col-md-6 mb-2">
						<label>User Level</label>
						<select name="user_level" class="form-control select2">
							<option value="">Please Select</option>
							<?php foreach ($user_levels as $user_level) {
								echo '<option value="' .$user_level['id']. '">'. $user_level['name']. '</option>';
							} ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-right border-top mt-1 pt-2">
						<button type="submit" class="btn btn-primary btn-sm rounded-0 btn-search">Search</button>
						<button type="button" class="btn btn-default btn-sm rounded-0 btn-cancel" data-dismiss="modal">Cancel</button>
					</div>
				</div>
				<?php echo form_close(); ?>
				
				<div class="card mt-4 mb-0" id="resultModal">
					<div class="card-body p-2">
						<div class="table-responsive">
							<table class="table table-bordered" width="100%">
								<thead class="table-primary">
									<tr>
										<th class="text-center text-nowrap">Username</th>
										<th class="text-center text-nowrap">User Level</th>
										<th class="text-center text-nowrap">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<ul class="pagination pagination-sm justify-content-end mb-0">
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-md-12 text-right border-top mt-1 pt-2">
						<button type="button" class="btn btn-default btn-sm rounded-0 btn-cancel" data-dismiss="modal">Cancel</button>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>


<?php $this->template->stylesheet->add('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<?php $this->template->javascript->add('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var employeesGender = '<?php echo oldInput('gender', $employees['gender_id']); ?>',
			employeesProvince = '<?php echo oldInput('province', $employees['province_id']); ?>';

		if (employeesGender && $.isNumeric(employeesGender)) {
			$('#formEmployees [name="gender"]').val(employeesGender).trigger('change');
		}

		if (employeesProvince && $.isNumeric(employeesProvince)) {
			$('#formEmployees [name="province"]').val(employeesProvince).trigger('change');
		}
	});

	//disable submit on submitted form
	$('#formEmployees').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	//onchange element
	$('#formEmployees [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formEmployees [name="city"]'),
			cityValue = '<?php echo oldInput('city', $employees['city_id']); ?>';

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

	//form user photo event
	$('#formEmployeesPhoto').on('click', '[data-toggle="browse"]', function(e) {
		e.preventDefault();
		$('#formEmployeesPhoto input[type="file"]').trigger('click');
	}).on('change', 'input[type="file"]', function(e) {
		e.preventDefault();
		$('#formEmployeesPhoto').trigger('submit');
	}).on('submit', function(e) {
		e.preventDefault();

		var thisForm = $('#formEmployeesPhoto'),
			thisProgress = thisForm.find('.progress');

		$.ajax({
			xhr: function() {
				var xhr = $.ajaxSettings.xhr();

				xhr.upload.onprogress = function(e) {
					if (e.lengthComputable) {
						var percentComplete = e.loaded / e.total;
						percentComplete = parseInt(percentComplete * 100);

						thisProgress.attr('hidden', false);
						thisProgress.find('.progress-bar').width(percentComplete+'%');
						thisProgress.find('.progress-bar').html(percentComplete+'%');
					}
				};

				return xhr ;
			},
			url: thisForm.attr('action'),
			type: 'post',
			dataType: 'json',
			data: new FormData(thisForm[0]),
			async: true,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				thisForm.find('.btn').attr('disabled', true);
				thisForm.find('.form-text').empty();

				thisProgress.attr('hidden', true);
				thisProgress.find('.progress-bar').width('0%');
				thisProgress.find('.progress-bar').html('0%');
			},
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if ('error' in response) {
						var swalBootstrap = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-primary rounded-0 mr-2',
								cancelButton: 'btn btn-default rounded-0'
							},
							buttonsStyling: false
						});

						swalBootstrap.fire({
							title: 'Error',
							text: errorMessage,
							icon: 'error',
							showCancelButton: false,
							confirmButtonText: 'Ok'
						});
					} else {
						if (response.status == 'success') {
							thisForm.find('img').attr({'src': response.data['thumb']});
							thisForm.find('[data-toggle="view"]').attr({'data-href': response.data['file'], 'hidden': false});
							thisForm.find('[type="file"]').val(null).clone(true);
							toastr.success(response.message)
						} else {
							toastr.error(response.message)
						}
					}
				}

				thisForm.find('.btn').attr('disabled', false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				thisForm.find('.btn').attr('disabled', false);
			}
		});
	});

	//select user data
	function modalUser() {
		$('#formModal').attr({'action': '<?php echo base_url("remote/get-users"); ?>'});
		$('#resultModal').attr({'hidden': true});
		$('#modalData .modal-title').html('Select User');
		$('#modalData').modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	function requestUsers(param) {
		if (param !== null && typeof param === 'object') {
			var formData = $('#formModal'),
				resultData = $('#resultModal');

			$.ajax({
				type: 'post',
				url: '<?php echo base_url("remote/get-users"); ?>',
				data: param,
				dataType: 'json',
				beforeSend: function() {
					resultData.attr({'hidden': false});
					resultData.find('table tbody').html('<tr><td colspan="3" align="center"><div class="spinner-grow spinner-grow-sm text-primary"></div><div class="spinner-grow spinner-grow-sm text-warning"></div><div class="spinner-grow spinner-grow-sm text-secondary"></div></td></tr>');
					resultData.find('.pagination').empty();
				},
				success: function(response) {
					resultData.find('table tbody').empty();

					if (response !== null && typeof response === 'object') {
						if (response.data.length > 0) {
							for (i=0; i<response.data.length; i++) {
								resultData.find('table tbody').append(
									'<tr>'+
										'<td>' + response.data[i]['username'] + '</td>' +
										'<td>' + response.data[i]['user_level'] + '</td>' +
										'<td class="text-center"><button type="button" class="btn btn-xs btn-info rounded-0 btn-select" data-id="' + response.data[i]['id'] + '" data-username="' + response.data[i]['username'] + '" data-user_level="' + response.data[i]['user_level'] + '">Select</button></td>' +
									'</tr>'
								);
							}

							if (response.total_data > response.data.length) {
								resultData.find('.pagination').append(
									'<li class="page-item"><a href="#" class="page-link page-prev" data-page="' + response.paging['previous'] + '">Prev</a></li>' +
									'<li class="page-item"><a href="#" class="page-link page-next" data-page="' + response.paging['next'] + '">Next</a></li>'
								);

								if (response.paging['current'] == response.paging['first']) {
									resultData.find('.pagination .page-prev').parents('li').addClass('disabled');
								}

								if (response.paging['current'] == response.paging['last']) {
									resultData.find('.pagination .page-next').parents('li').addClass('disabled');
								}
							}
						}
					} else {
						resultData.find('table tbody').html('<tr><td colspan="3" align="center">Data Not Found</td></tr>');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					resultData.find('table tbody').html('<tr><td colspan="3" align="center">Data Not Found</td></tr>');
					console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				}
			});
		}
	}

	$('#resultModal').on('click', '.btn-select', function(e) {
		e.preventDefault();

		var userId = $(this).data('id'),
			userName = $(this).data('username'),
			userLevel = $(this).data('user_level'),
			formEmployees = $('#formEmployees');

		if (userId && $.isNumeric(userId)) {
			formEmployees.find('[name="user_id"]').val(userId);
			formEmployees.find('[name="username"]').val(userName).trigger('change');
			formEmployees.find('[name="user_level"]').val(userLevel);

			$('#modalData').modal('hide');
		}
	});

	$('#formModal').on('submit', function(e) {
		e.preventDefault();

		var formData = $(this);

		var param = {
			'like_username': formData.find('[name="username"]').val(),
			'user_level_id': formData.find('[name="user_level"]').val(),
			'order': 'username',
			'limit': 5
		};

		requestUsers(param);
	});

	$('#resultModal .pagination').on('click', '.page-link', function(e) {
		e.preventDefault();

		var thisPage = $(this).data('page'),
			formData = $('#formModal'),
			resultData = $('#resultModal');

		if ($(this).parents('li').hasClass('disabled')) {
			return false;
		}

		var param = {
			'like_username': formData.find('[name="username"]').val(),
			'user_level_id': formData.find('[name="user_level"]').val(),
			'order': 'username',
			'limit': 5,
			'page': thisPage
		};

		requestUsers(param);
	});
</script>
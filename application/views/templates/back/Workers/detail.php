<div class="row">
	<div class="col-md-2">
		<div class="card">
			<div class="card-body">
				<?php echo form_open_multipart('admin/workers/upload-photo/'.$worker['id'], ['method' => 'post', 'id' => 'formPhoto', 'autocomplete' => 'off']); ?>
					<div class="form-group text-center">
						<div class="border">
							<?php echo form_input(['type' => 'file', 'name' => 'photo', 'class' => 'hidden' . ((hasFlashError('photo')) ? 'is-invalid' : '')]); ?>
							<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="Employees Photo" class="img-fluid">
							<div class="layer">
								<button type="button" class="btn btn-xs btn-outline-primary rounded-0 venobox" <?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/'.$worker['photo'])) ? 'data-href="' . base_url('files/workers/'.$worker['id'].'/'.$worker['photo']) .'"' : 'hidden'; ?> data-toggle="view">View</button>
								<?php echo form_button(['type' => 'button', 'class' => 'btn btn-xs btn-outline-success rounded-0', 'content' => 'Change', 'data-toggle' => 'browse']); ?>
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
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a class="nav-link rounded-0 active" data-toggle="tab" href="#Detail">Detail</a>
					</li>
					<li class="nav-item">
						<a class="nav-link rounded-0" data-toggle="tab" href="#Attachment">Attachment</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane container active" id="Detail">
						<?php echo form_open('admin/workers/update/'.$worker['id'], ['method' => 'post', 'id' => 'formData', 'autocomplete' => 'off']); ?>
							<div class="row">
								<div class="form-group col-md-3">
									<?php echo form_label('NIK <span class="text-danger">*</span>', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('nik') ? ' is-invalid' : ''), 'maxlength' => '20', 'value' => oldInput('nik', $worker['nik'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('nik'); ?></span>
								</div>
								<div class="form-group col-md-5">
									<?php echo form_label('Fullname <span class="text-danger">*</span>', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('fullname') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('fullname', $worker['fullname'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
								</div>
								<div class="form-group col-md-4">
									<?php echo form_label('Email <span class="text-danger">*</span>', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0 lowercase' . (hasFlashError('email') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('email', $worker['email'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Phone 1 <span class="text-danger">*</span>', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'phone_1', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_1') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_1', $worker['phone_1'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('phone_1'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Phone 2', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'phone_2', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('phone_2') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('phone_2', $worker['phone_2'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('phone_2'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Gender', null); ?>
									<select name="gender" class="form-control select2 rounded-0 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
									<span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Marital Status', null); ?>
									<select name="marital_status" class="form-control select2 rounded-0 <?php echo (hasFlashError('marital_status')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
										<option value="1">Single</option>
										<option value="2">Married</option>
										<option value="3">Divorce</option>
									</select>
									<span class="invalid-feedback"><?php echo flashError('marital_status'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Birth Place', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'birth_place', 'class' => 'form-control form-control-sm rounded-0 capitalize' . (hasFlashError('birth_place') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('birth_place', $worker['birth_place'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('birth_place'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Birth Date', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'birth_date', 'class' => 'form-control form-control-sm rounded-0 date' . (hasFlashError('birth_date') ? ' is-invalid' : ''), 'maxlength' => '20', 'value' => oldInput('birth_date', $worker['birth_date'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('birth_date'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Age', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'age', 'class' => 'form-control form-control-sm rounded-0 numeric plaintext' . (hasFlashError('age') ? ' is-invalid' : ''), 'maxlength' => '3', 'value' => oldInput('age', $worker['age']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('age'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Religion', null); ?>
									<select name="religion" class="form-control select2 rounded-0 <?php echo (hasFlashError('religion')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
									</select>
									<span class="invalid-feedback"><?php echo flashError('religion'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<?php echo form_label('Address', null); ?>
									<?php echo form_textarea(['name' => 'address', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('address') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('address', $worker['address'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('address'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Province', null); ?>
									<select name="province" class="form-control select2 rounded-0 <?php echo (hasFlashError('province')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
										<?php foreach ($provinces as $province) {
											echo '<option value="' .$province['id']. '">'. $province['name']. '</option>';
										} ?>
									</select>
									<span class="invalid-feedback"><?php echo flashError('province'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('City', null); ?>
									<select name="city" class="form-control select2 rounded-0 <?php echo (hasFlashError('city')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
									</select>
									<span class="invalid-feedback"><?php echo flashError('city'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<?php echo form_label('Description', null); ?>
									<?php echo form_textarea(['name' => 'description', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('description') ? ' is-invalid' : ''), 'rows' => '2', 'style' => 'resize:none;', 'value' => oldInput('description', $worker['description'])]); ?>
									<span class="invalid-feedback"><?php echo flashError('description'); ?></span>
								</div>
								<div class="form-group col-md-12">
									<?php echo form_label('Work Experience', null); ?>
									<div class="d-flex flex-wrap">
										<?php $work_experience_ids = explode(',', $worker['work_experience_ids']); ?>
										<?php foreach ($work_experiences as $work_experience) { ?>
											<div class="icheck-primary mr-4">
												<?php echo form_checkbox(['name' => 'work_experience[]', 'id' => 'WorkExperience' . $work_experience['id'], 'value' => $work_experience['id'], 'checked' => in_array($work_experience['id'], $work_experience_ids) ? true : false]); ?>
												<?php echo form_label($work_experience['name'], 'WorkExperience' . $work_experience['id']); ?>
											</div>
										<?php } ?>
									</div>
									<span class="invalid-feedback"><?php echo flashError('work_experience'); ?></span>
								</div>
								<div class="form-group col-md-12">
									<?php echo form_label('Placement Ready', null); ?>
									<div class="d-flex flex-wrap">
										<?php $placement_ready_ids = explode(',', $worker['placement_ready_ids']); ?>
										<?php foreach ($agency_countries as $placement_ready) { ?>
											<div class="icheck-primary mr-4">
												<?php echo form_checkbox(['name' => 'placement_ready[]', 'id' => 'PlacementReady' . $placement_ready['id'], 'value' => $placement_ready['id'], 'checked' => in_array($placement_ready['id'], $placement_ready_ids) ? true : false]); ?>
												<?php echo form_label($placement_ready['name'], 'PlacementReady' . $placement_ready['id']); ?>
											</div>
										<?php } ?>
									</div>
									<span class="invalid-feedback"><?php echo flashError('placement_ready'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Agency', null); ?>
									<select name="agency_country" class="form-control select2 rounded-0 <?php echo (hasFlashError('agency_country')) ? 'is-invalid' : ''; ?>">
										<option value="">Please Select</option>
										<?php foreach ($agency_countries as $agency_country) {
											echo '<option value="' .$agency_country['id']. '">'. $agency_country['name']. '</option>';
										} ?>
									</select>
									<span class="invalid-feedback"><?php echo flashError('agency_country'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Username', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'username', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('username') ? ' is-invalid' : ''), 'maxlength' => '30', 'value' => oldInput('username', $worker['username']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('username'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('User Level', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'user_level', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('user_level') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('user_level', $worker['user_level']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('user_level'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-3">
									<?php echo form_label('Create Date', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'create_date', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('create_date') ? ' is-invalid' : ''), 'value' => oldInput('create_date', $worker['create_date']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('create_date'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Create By', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'create_by', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('create_by') ? ' is-invalid' : ''), 'value' => oldInput('create_date', $worker['create_by']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('create_by'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Last Update Date', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'update_date', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('update_date') ? ' is-invalid' : ''), 'value' => oldInput('update_date', $worker['update_date']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('update_date'); ?></span>
								</div>
								<div class="form-group col-md-3">
									<?php echo form_label('Last Update By', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'update_by', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('update_by') ? ' is-invalid' : ''), 'value' => oldInput('create_date', $worker['update_by']), 'readonly' => true]); ?>
									<span class="invalid-feedback"><?php echo flashError('update_by'); ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-right border-top mt-2 pt-3">
									<?php echo form_input(['type' => 'hidden', 'name' => 'user_id', 'value' => oldInput('user_id', $worker['user_id'])]); ?>
									<?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success rounded-0 float-left', 'content' => 'Select User', 'onclick' => 'modalUser()']); ?>

									<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0', 'content' => 'Update']); ?>
									<?php echo anchor('admin/workers', 'Back', ['class' => 'btn btn-sm btn-default rounded-0']); ?>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>

					<div class="tab-pane container fade" id="Attachment">
						<?php echo form_open_multipart('admin/workers/upload-attachment/'.$worker['id'], ['method' => 'post', 'id' => 'formAttachment', 'autocomplete' => 'off']); ?>
							<div class="form-row text-left">
								<div class="form-group col-md-4">
									<?php echo form_label('Attachment File', null); ?>
									<div class="custom-file custom-file-sm">
										<?php echo form_input(['type' => 'file', 'name' => 'attachment_file', 'class' => 'custom-file-input custom-file-input-sm']); ?>
										<?php echo form_label('Browse file', null, ['class' => 'custom-file-label label-icon text-truncate rounded-0']); ?>
										<span class="invalid-feedback"></span>
									</div>
									<span class="form-text">Allowed type: jpg, jpeg, png, doc, docx, pdf. Max size: 5MB.</span>
								</div>
								<div class="form-group col-md-4">
									<?php echo form_label('Attachment Name', null); ?>
									<?php echo form_input(['type' => 'text', 'name' => 'attachment_name', 'class' => 'form-control form-control-sm rounded-0 capitalize', 'maxlength' => '100']); ?>
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="d-flex flex-row justify-content-between">
								<div class="d-flex flex-colum justify-content-between" style="font-size: 0.8rem;">
									<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0 d-inline-block mr-2', 'content' => 'Upload']); ?>
								</div>
								<div class="d-block w-100">
									<div class="progress progress-md mt-2" hidden>
										<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						<?php echo form_close(); ?>

						<div class="card mt-4">
							<div class="card-header row border-0">
								<div class="input-group col-md-4" id="tableDataAttachmentFilter">
									<input type="text" class="form-control form-control-sm rounded-0 input-search" placeholder="Search Name">
									<div class="input-group-append">
										<button type="button" class="btn btn-info btn-sm rounded-0 btn-search" title="Search"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
							<div class="card-body pt-0">
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="tableDataAttachment" width="100%">
										<thead class="table-primary">
											<tr>
												<th class="text-center">No.</th>
												<th class="text-center">Name</th>
												<th class="text-center">Create Date</th>
												<th class="text-center">Create By</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="row" id="tableDataAttachmentOption">
									<div class="col-md-12 table-paginate"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal select user -->
<div class="modal fade" id="modalSearch" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary rounded-0">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
					<div class="form-row">
						<div class="col-md-4 mb-2">
							<?php echo form_label('Username', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'username', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '100']); ?>
						</div>
						<div class="col-md-4 mb-2">
							<?php echo form_label('Username', null); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '100']); ?>
						</div>
						<div class="col-md-4 mb-2">
							<?php echo form_label('User Level', null); ?>
							<select name="user_level" class="form-control form-control-sm rounded-0 select2">
								<option value="">Please Select</option>
								<?php foreach ($user_levels as $user_level) {
									echo '<option value="' . $user_level['id'] . '">' . $user_level['name'] . '</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-right border-top mt-1 pt-2">
							<?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0 btn-submit', 'content' => 'Search']); ?>
							<?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-default rounded-0 btn-cancel', 'content' => 'Cancel', 'data-dismiss' => 'modal']); ?>
						</div>
					</div>
				<?php echo form_close(); ?>

				<div class="card mt-4 mb-0 result">
					<div class="card-body p-2">
						<div class="table-responsive">
							<table class="table table-bordered" width="100%">
								<thead class="table-primary">
									<tr>
										<th class="text-center text-nowrap">Username</th>
										<th class="text-center text-nowrap">Email</th>
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
								<ul class="pagination pagination-sm justify-content-end mb-0"></ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/datatables/css/dataTables.bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/css/bs4-datatables.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/datatables/js/dataTables.bootstrap4.min.js'); ?>
<?php $this->template->javascript->add('assets/js/file-downloader.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
	// describe required variable
	var modalSearch = $('#modalSearch'),
		modalSearchForm = $('#modalSearch form'),
		modalSearchResult = $('#modalSearch .result'),
		tableDataAttachment;

	$(document).ready(function() {
		// describe required variable
		var workerGender = '<?php echo oldInput('gender', $worker['gender_id']); ?>',
			workerMaritalStatus = '<?php echo oldInput('marital_status', $worker['marital_status_id']); ?>',
			workerReligion = '<?php echo oldInput('religion', $worker['religion_id']); ?>',
			workerProvince = '<?php echo oldInput('province', $worker['province_id']); ?>',
			workerAgencyCountry = '<?php echo oldInput('agency_country', $worker['agency_country_id']); ?>';

		// set value to element if variable true or numeric
		if (workerGender && $.isNumeric(workerGender)) {
			$('#formData [name="gender"]').val(workerGender).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerMaritalStatus && $.isNumeric(workerMaritalStatus)) {
			$('#formData [name="marital_status"]').val(workerMaritalStatus).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerReligion && $.isNumeric(workerReligion)) {
			$('#formData [name="religion"]').val(workerReligion).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerProvince && $.isNumeric(workerProvince)) {
			$('#formData [name="province"]').val(workerProvince).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerAgencyCountry && $.isNumeric(workerAgencyCountry)) {
			$('#formData [name="agency_country"]').val(workerAgencyCountry).trigger('change');
		}

		// get datatable attachment
		tableDataAttachment = $('#tableDataAttachment').DataTable({
			'processing': true,
			'serverSide': true,
			'order': [
				[ 0, 'desc' ]
			],
			'lengthMenu': [
				[5]
			],
			'ajax': {
				'url': '<?php echo base_url("remote/get-datatable-worker-attachments/".$worker['id']); ?>',
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
				$('.pagination').addClass('pagination-sm float-right');
				$('#tableDataAttachment').next().attr({'id': 'tableDataAttachment_option'});
				$('thead tr th').addClass('text-nowrap');
				$('tbody tr').find('td:last').addClass('text-nowrap');
				$('.venobox').venobox();
			},
			'language': {
				'processing': '<div class="spinner-grow text-primary"></div><div class="spinner-grow text-warning"></div><div class="spinner-grow text-secondary"></div><div class="d-block text-center"><strong>Loading..</strong></div>'
			},
			'sDom': 'rpt',
			'initComplete': (settings, json)=>{
				$('#tableDataAttachment_paginate').appendTo('#tableDataAttachmentOption .table-paginate');
			},
		});
	});

	// on click submit filter
	$('#tableDataAttachmentFilter .btn-search').on('click', function() {
		tableDataAttachment.search($('#tableDataAttachmentFilter .input-search').val()).draw();
	});

	// on click enter input filter
	$('#tableDataAttachmentFilter .input-search').keypress(function(e) {
		if (e.which === 13) {
			tableDataAttachment.search($(this).val()).draw();
		}
	});

	// disable submit on submitted form
	$('#formData, #formAttachment').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

	// show filename onchange element input file
	$('#formAttachment .custom-file-input').on('change', function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass('selected').html(fileName);
	});

	// request data city onchange element province
	$('#formData [name="province"]').on('change', function() {
		var provinceValue = $(this).val(),
			cityElement = $('#formData [name="city"]'),
			cityValue = '<?php echo oldInput('city', $worker['city_id']); ?>';

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

	// form photo event
	$('#formPhoto').on('click', '[data-toggle="browse"]', function(e) {
		e.preventDefault();
		$('#formPhoto input[type="file"]').trigger('click');
	}).on('change', 'input[type="file"]', function(e) {
		e.preventDefault();
		$('#formPhoto').trigger('submit');
	}).on('submit', function(e) {
		e.preventDefault();

		var thisForm = $('#formPhoto'),
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
							text: response.error,
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

	// select user for workers
	function modalUser() {
		modalSearchForm.attr({'action': '<?php echo base_url("remote/get-users"); ?>'});
		modalSearchResult.attr({'hidden': true});
		modalSearch.find('.modal-header .modal-title').html('Select User');
		modalSearch.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
	}

	// submited form modal search
	modalSearchForm.on('submit', function(e) {
		e.preventDefault();

		var param = {
			'like_username': modalSearchForm.find('[name="username"]').val(),
			'like_email': modalSearchForm.find('[name="email"]').val(),
			'user_level_id': modalSearchForm.find('[name="user_level"]').val(),
			'order': 'username',
			'limit': 5
		};

		requestUsers(param);
	});

	// on selected result user
	modalSearchResult.on('click', '.btn-select', function(e) {
		e.preventDefault();

		var userId = $(this).data('id'),
			userName = $(this).data('username'),
			userLevel = $(this).data('user_level');

		if (userId && $.isNumeric(userId)) {
			$('#formData [name="user_id"]').val(userId);
			$('#formData [name="username"]').val(userName);
			$('#formData [name="user_level"]').val(userLevel);

			modalSearch.modal('hide');
		}
	});

	// on click pagination modal result user
	modalSearchResult.find('.pagination').on('click', '.page-link', function(e) {
		e.preventDefault();

		var thisPage = $(this).data('page');

		if ($(this).parents('li').hasClass('disabled')) {
			return false;
		}

		var param = {
			'like_username': modalSearchForm.find('[name="username"]').val(),
			'like_email': modalSearchForm.find('[name="email"]').val(),
			'user_level_id': modalSearchForm.find('[name="user_level"]').val(),
			'order': 'username',
			'limit': 5,
			'page': thisPage
		};

		requestUsers(param);
	});

	// get users data
	function requestUsers(param) {
		if (param !== null && typeof param === 'object') {
			$.ajax({
				type: 'post',
				url: modalSearchForm.attr('action'),
				data: param,
				dataType: 'json',
				beforeSend: function() {
					modalSearchResult.attr({'hidden': false});
					modalSearchResult.find('table tbody').html('<tr><td colspan="3" align="center"><div class="spinner-grow spinner-grow-sm text-primary"></div><div class="spinner-grow spinner-grow-sm text-warning"></div><div class="spinner-grow spinner-grow-sm text-secondary"></div></td></tr>');
					modalSearchResult.find('.pagination').empty();
				},
				success: function(response) {
					modalSearchResult.find('table tbody').empty();

					if (response !== null && typeof response === 'object') {
						if (response.data.length > 0) {
							for (i=0; i<response.data.length; i++) {
								modalSearchResult.find('table tbody').append(
									'<tr>'+
										'<td>' + response.data[i]['username'] + '</td>' +
										'<td>' + response.data[i]['email'] + '</td>' +
										'<td>' + response.data[i]['user_level'] + '</td>' +
										'<td class="text-center"><button type="button" class="btn btn-xs btn-info rounded-0 btn-select" data-id="' + response.data[i]['id'] + '" data-username="' + response.data[i]['username'] + '" data-email="' + response.data[i]['email'] + '" data-user_level="' + response.data[i]['user_level'] + '">Select</button></td>' +
									'</tr>'
								);
							}

							if (response.total_data > response.data.length) {
								modalSearchResult.find('.pagination').append(
									'<li class="page-item"><a href="#" class="page-link page-prev" data-page="' + response.paging['previous'] + '">Prev</a></li>' +
									'<li class="page-item"><a href="#" class="page-link page-next" data-page="' + response.paging['next'] + '">Next</a></li>'
								);

								if (response.paging['current'] == response.paging['first']) {
									modalSearchResult.find('.pagination .page-prev').parents('li').addClass('disabled');
								}

								if (response.paging['current'] == response.paging['last']) {
									modalSearchResult.find('.pagination .page-next').parents('li').addClass('disabled');
								}
							}
						}
					} else {
						modalSearchResult.find('table tbody').html('<tr><td colspan="4" align="center">Data Not Found</td></tr>');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

					modalSearchResult.find('table tbody').html('<tr><td colspan="4" align="center">Data Not Found</td></tr>');
				}
			});
		}
	}

	// submitted form attachment
	$('#formAttachment').on('submit', function(e) {
		e.preventDefault();

		var thisForm = $('#formAttachment'),
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
				thisForm.find('input, select, textarea').removeClass('is-invalid');
				thisForm.find('.invalid-feedback').empty();

				thisProgress.attr('hidden', true);
				thisProgress.find('.progress-bar').width('0%');
				thisProgress.find('.progress-bar').html('0%');
			},
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if ('error' in response) {
						
						if (response.error !== null && typeof response.error === 'object') {
							$.each(response.error, function(key, val) {
								if(val !== '') {
									thisForm.find('[name="' + key + '"]').addClass('is-invalid');
									thisForm.find('[name="' + key + '"]').parents('.form-group').find('.invalid-feedback').html(val);
								}
							});
						}
					} else {
						if (response.status == 'success') {
							toastr.success(response.message);
							tableDataAttachment.ajax.reload();
							thisForm.find('[type="file"]').val(null).clone(true);
							thisForm.find('.custom-file-label').removeClass('selected').html('Browse file');
						} else {
							toastr.error(response.message);
						}
					}
				}

				thisForm.find('[type="submit"]').attr({'disabled': false});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
				thisForm.find('[type="submit"]').attr({'disabled': false});
			}
		});
	});

	// delete attachment by id
	function deleteAttachment(id) {
		if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
			var swalBootstrap = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary rounded-0 mr-2',
					cancelButton: 'btn btn-default rounded-0'
				},
				buttonsStyling: false
			});

			swalBootstrap.fire({
				title: 'Delete this attachment?',
				text: 'This action cannot be undone.',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Confirm'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?php echo base_url("admin/workers/delete-attachment/' + id + '"); ?>',
						type: 'get',
						dataType: 'json',
						success: function(response) {
							if (response.status == 'success') {
								toastr.success(response.message);
								tableDataAttachment.ajax.reload();
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
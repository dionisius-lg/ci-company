<section class="breadcrumbs">
	<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('header')['navbar']['home']; ?></a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

<div class="container">
    <div class="quick-search mt-3 mb-3">
        <h5 class="font-weight-bold">Quick Search Worker</h5>
        <hr>
        <?php echo form_open('quicksearch', ['method' => 'get', 'id' => 'formData', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <?php echo form_label('NIK', null); ?>
                    <?php echo form_input(['type' => 'text', 'name' => 'nik', 'class' => 'form-control form-control-sm rounded-0 numeric' , 'value' => $this->input->get('nik') ? $this->input->get('nik') : '']); ?>
                </div>
                <div class="form-group col-md-6">
                <?php echo form_label('Placement', null); ?>
                    <select name="placement" class="form-control select2 rounded-0 <?php echo (hasFlashError('placement')) ? 'is-invalid' : ''; ?>">
                        <option value="">Please Select</option>
                        <?php foreach ($placements as $placement) {
                            echo '<option value="' .$placement['id']. '">'. $placement['name']. '</option>';
                        } ?>
                    </select>
                    <span class="invalid-feedback"><?php echo flashError('placement'); ?></span>
                </div>
                <div class="form-group col-md-6">
                    <?php echo form_label('Gender', null); ?>
                    <select name="gender" class="form-control select2 rounded-0 <?php echo (hasFlashError('gender')) ? 'is-invalid' : ''; ?>">
                        <option value="">Please Select</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                    <span class="invalid-feedback"><?php echo flashError('gender'); ?></span>
                </div>
                <div class="form-group col-md-6">
                    <?php echo form_label('Marital Status', null); ?>
                    <select name="marital_status" class="form-control select2 rounded-0 <?php echo (hasFlashError('marital_status')) ? 'is-invalid' : ''; ?>">
                        <option value="">Please Select</option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Divorce</option>
                    </select>
                    <span class="invalid-feedback"><?php echo flashError('marital_status'); ?></span>
                </div>

                <div class="form-group col-md-12">
                    <?php echo form_label('Experience', null); ?>
                    <div class="d-flex flex-wrap">
                        <?php $experience_ids = explode(',', oldInput('experience')); ?>
                        <?php foreach ($experiences as $experience) { ?>
                            <div class="icheck-primary mr-4">
                                <?php echo form_checkbox(['name' => 'experience[]', 'id' => 'Experience' . $experience['id'], 'value' => $experience['id'], 'checked' => in_array($experience['id'], $experience_ids) ? true : false]); ?>
                                <?php echo form_label($experience['name'], 'Experience' . $experience['id']); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <span class="invalid-feedback"><?php echo flashError('experience'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right border-top mt-2 pt-3">
                    <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0', 'content' => 'Search']); ?>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="">
                                            <th class="text-nowrap">No.</th>
                                            <th class="text-nowrap">NIK</th>
                                            <th class="text-nowrap">Fullname</th>
                                            <th class="text-nowrap">Email</th>
                                            <th class="text-nowrap">Placement</th>
                                            <th class="text-nowrap">Ready to Placement</th>
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
                                                <td class="text-nowrap">' . $worker['placement'] . '</td>
                                                <td class="text-nowrap">' . $worker['ready_placement'] . '</td>
                                                <td class="text-nowrap">' . ((!empty($worker['user_id'])) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
                                                <td class="text-nowrap">' . anchor('worker/detail/' . $worker['id'], '<i class="fa fa-eye fa-fw"></i>', ['class' => 'btn btn-info btn-xs rounded-0', 'title' => 'Detail']) . '</td>
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
        <?php echo form_close(); ?>
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
<?php //$this->template->javascript->add('assets/js/file-downloader.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
	$(document).ready(function() {
		// describe required variable
		var workerGender = '<?php echo oldInput('gender'); ?>',
			workerMaritalStatus = '<?php echo oldInput('marital_status'); ?>',
			workerPlacement = '<?php echo oldInput('placement'); ?>';

		// set value to element if variable true or numeric
		if (workerGender && $.isNumeric(workerGender)) {
			$('#formData [name="gender"]').val(workerGender).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerMaritalStatus && $.isNumeric(workerMaritalStatus)) {
			$('#formData [name="marital_status"]').val(workerMaritalStatus).trigger('change');
		}

		// set value to element if variable true or numeric
		if (workerPlacement && $.isNumeric(workerPlacement)) {
			$('#formData [name="placement"]').val(workerPlacement).trigger('change');
		}
	});

	// disable submit on submitted form
	$('#formData').on('submit', function(e) {
		$(this).find('[type="submit"]').attr({'disabled': true});
	});

</script>
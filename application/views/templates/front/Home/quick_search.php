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
                    <select name="placement" class="form-control select2 rounded-0">
                        <option value="">Please Select</option>
                        <?php foreach ($placements as $placement) {
                            echo '<option value="' .$placement['id']. '">'. $placement['name']. '</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <?php echo form_label('Gender', null); ?>
                    <select name="gender_id" class="form-control select2 rounded-0">
                        <option value="">Please Select</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <?php echo form_label('Marital Status', null); ?>
                    <select name="marital_status_id" class="form-control select2 rounded-0">
                        <option value="">Please Select</option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Divorce</option>
                    </select>
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
                                            <th class="text-nowrap">Marital Status</th>
                                            <th class="text-nowrap">Gender</th>
                                            <th class="text-nowrap">Experience</th>
                                            <th class="text-nowrap">Placement</th>
                                            <th class="text-nowrap">Placement Status</th>
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
                                                <td class="text-nowrap">' . $worker['marital_status'] . '</td>
                                                <td class="text-nowrap">' . $worker['gender'] . '</td>
                                                <td class="text-nowrap">' . $worker['experience'] . '</td>
                                                <td class="text-nowrap">' . $worker['placement'] . '</td>
                                                <td class="text-nowrap">' . $worker['placement_status'] . '</td>
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

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		// describe required variable
		var filterPlacement = '<?php echo $this->input->get('placement'); ?>',
			filterReadyPlacement = '<?php echo $this->input->get('ready_placement'); ?>';
            filterGender = '<?php echo $this->input->get('gender_id') ?>';
            filterMaritalStatus = '<?php echo $this->input->get('marital_status_id') ?>';

		// set value to element if variable true or numeric
		if (filterPlacement && $.isNumeric(filterPlacement)) {
			$('#formData [name="placement"]').val(filterPlacement).trigger('change');
		}

		// set value to element if variable true or numeric
		if (filterReadyPlacement !== null && filterReadyPlacement !== undefined && $.isNumeric(filterReadyPlacement)) {
			$('#formData [name="ready_placement"]').val(filterReadyPlacement).trigger('change');
		}

        if (filterGender && $.isNumeric(filterGender)) {
			$('#formData [name="gender_id"]').val(filterGender).trigger('change');
		}

        if (filterMaritalStatus && $.isNumeric(filterMaritalStatus)) {
			$('#formData [name="marital_status_id"]').val(filterMaritalStatus).trigger('change');
		}
	});
</script>
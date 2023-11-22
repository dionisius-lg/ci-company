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
                <?php echo form_open('admin/users', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php echo form_label('Fullname', 'Fullname'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'fullname', 'id' => 'Fullname', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Email', 'Email'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'email', 'id' => 'Email', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('email') ? $this->input->get('email') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Username', 'Username'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'username', 'id' => 'Username', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('username') ? $this->input->get('username') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('User Level', 'UserLevel'); ?>
                            <select class="form-control select2 rounded-0" name="user_level" id="UserLevel">
                                <option value="">Please Select</option>
                                <?php foreach ($user_levels as $user_level) {
                                    echo '<option value="' .$user_level['id']. '">'. $user_level['name']. '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Agency Location', 'AgencyLocation'); ?>
                            <select class="form-control select2 rounded-0" name="agency_location" id="AgencyLocation">
                                <option value="">Please Select</option>
                                <?php foreach ($agency_locations as $agency_location) {
                                    echo '<option value="' .$agency_location['id']. '">'. $agency_location['name']. '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Company', 'Company'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'company', 'id' => 'Company', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('company') ? $this->input->get('company') : '']); ?>
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
                                <th class="text-nowrap">Fullname</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Username</th>
                                <th class="text-nowrap">User Level</th>
                                <th class="text-nowrap">Agency Location</th>
                                <th class="text-nowrap">Company</th>
                                <th class="text-nowrap">Is Worker</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (count($users) > 0) {
                            foreach ($users as $user) { echo
                                '<tr>
                                    <td class="text-nowrap">' . $no . '</td>
                                    <td class="text-nowrap">' . $user['fullname'] . '</td>
                                    <td class="text-nowrap">' . $user['email'] . '</td>
                                    <td class="text-nowrap">' . $user['username'] . '</td>
                                    <td class="text-nowrap">' . $user['user_level'] . '</td>
                                    <td class="text-nowrap">' . $user['agency_location'] . '</td>
                                    <td class="text-nowrap">' . $user['company'] . '</td>
                                    <td class="text-nowrap">' . (($user['is_worker'] == 1) ? '<i class="fa fa-check text-primary"></i>' : '<i class="fa fa-close"></i>') . '</td>
                                    <td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailData(' . $user['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => ($this->session->userdata('AuthUser')['id'] == $user['id'] ? 'return toastr.error(\'Cannot delete your current account\');' : 'deleteData(' . $user['id'] . ')')]) . '</td>
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

<!-- modal add/edit data -->
<div class="modal fade" id="modalData" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary rounded-0">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <?php echo form_label('Fullname <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0 capitalize', 'maxlength' => '100', 'autofocus' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Email <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'email', 'class' => 'form-control form-control-sm rounded-0 lowercase', 'maxlength' => '100']); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Username <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'username', 'class' => 'form-control form-control-sm rounded-0 lowercase', 'maxlength' => '30']); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('User Level <span class="text-danger">*</span>', null); ?>
                            <select class="form-control select2 rounded-0" name="user_level">
                                <option value="">Please Select</option>
                                <?php foreach ($user_levels as $level) {
                                    echo '<option value="' .$level['id']. '">'. $level['name']. '</option>';
                                } ?>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Agency Location', null); ?>
                            <select class="form-control select2 rounded-0" name="agency_location">
                                <option value="">Please Select</option>
                                <?php foreach ($agency_locations as $agency) {
                                    echo '<option value="' .$agency['id']. '">'. $agency['name']. '</option>';
                                } ?>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Company', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'company', 'class' => 'form-control form-control-sm rounded-0 capitalize', 'maxlength' => '200']); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row group-add">
                        <div class="form-group col-md-4">
                            <?php echo form_label('Password <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'password', 'name' => 'password', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10']); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Password Repeat <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'password', 'name' => 'password_repeat', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10']); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row group-detail-user">
                        <div class="form-group col-md-4">
                            <?php echo form_label('Request Date', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'request_date', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Register Date', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'register_date', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Register By', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'register_by', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Last Update Date', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'update_date', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Last Update By', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'update_by', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Is Worker', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'is_worker', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row group-detail-worker">
                        <div class="form-group col-md-4">
                            <?php echo form_label('NIK (Workers)', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'worker_nik', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <?php echo form_label('Fullname (Workers)', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'worker_fullname', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div>
                        <?php echo form_button(['type' => 'button', 'class' => 'btn btn-success btn-sm rounded-0 btn-password', 'content' => 'Change Password']); ?>
                    </div>
                    <div>
                        <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary btn-sm rounded-0 btn-submit', 'content' => 'Submit']); ?>
                        <?php echo form_button(['type' => 'button', 'class' => 'btn btn-default btn-sm rounded-0 btn-cancel', 'content' => 'Cancel', 'data-dismiss' => 'modal']); ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- modal change password -->
<div class="modal fade" id="modalPassword" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary rounded-0">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <?php echo form_label('Password', null); ?>
                            <?php echo form_input(['type' => 'password', 'name' => 'password', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10', 'autofocus' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <?php echo form_label('Password Repeat', null); ?>
                            <?php echo form_input(['type' => 'password', 'name' => 'password_repeat', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '10']); ?>
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
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<script type="text/javascript">
    // describe required variable
    var modalData = $('#modalData'),
        modalDataForm = $('#modalData form'),
        modalPassword = $('#modalPassword'),
        modalPasswordForm = $('#modalPassword form');

    $(document).ready(function() {
        // describe required variable
        var filterUserLevel = '<?php echo $this->input->get('user_level'); ?>',
            filterAgencyLocation = '<?php echo $this->input->get('agency_location'); ?>';

        // set value to element if variable true or numeric
        if (filterUserLevel && $.isNumeric(filterUserLevel)) {
            $('#UserLevel').val(filterUserLevel).trigger('change');
        }

        // set value to element if variable true or numeric
        if (filterAgencyLocation && $.isNumeric(filterAgencyLocation)) {
            $('#AgencyLocation').val(filterAgencyLocation).trigger('change');
        }
    });

    // add new data
    function newData() {
        modalDataForm[0].reset();
        modalDataForm.find('select').val(null).trigger('change');
        modalDataForm.attr({'action': '<?php echo base_url("admin/users/create"); ?>'});
        modalDataForm.find('input, select, textarea').removeClass('is-invalid');
        modalDataForm.find('.invalid-feedback').empty();
        modalDataForm.find('.btn-submit').html('Create');
        modalDataForm.find('.group-add input').attr({'disabled': false, 'hidden': false});
        modalDataForm.find('.group-add').show();
        modalDataForm.find('.btn-password, .group-detail-user, .group-detail-worker').hide();
        modalDataForm.find('.btn-password').attr({'onclick': null});

        modalData.find('.modal-header .modal-title').html('Create New Data');
        modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
    }

    // detail data by id
    function detailData(id) {
        if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
            $.ajax({
                url: '<?php echo base_url("admin/users/detail/' + id + '"); ?>',
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    modalDataForm[0].reset();
                    modalDataForm.find('select').val(null).trigger('change');
                    modalDataForm.attr({'action': '<?php echo base_url("admin/users/update/' + id + '"); ?>'});
                    modalDataForm.find('input, select, textarea').removeClass('is-invalid');
                    modalDataForm.find('.invalid-feedback').empty();
                    modalDataForm.find('.btn-submit').html('Update');
                    modalDataForm.find('.group-add input').attr({'disabled': true, 'hidden': true});
                    modalDataForm.find('.btn-password, .group-detail-user, .group-detail-worker, .group-add').hide();
                    modalDataForm.find('.btn-password').attr({'onclick': null});

                    modalData.find('.modal-header .modal-title').html('Detail Data');
                },
                success: function(response) {
                    if (response !== null && typeof response.user == 'object') {
                        if ('worker' in response && typeof response.worker == 'object') {
                            if (!$.isEmptyObject(response.worker)) {
                                $.each(response.worker, function(key, val) {
                                    modalDataForm.find('[name="worker_'+key+'"').val(val);
                                });

                                modalDataForm.find('.group-detail-worker').show();
                            }
                        }

                        if ('user' in response && typeof response.user == 'object') {
                            if (!$.isEmptyObject(response.user)) {
                                $.each(response.user, function(key, val) {
                                    if ($.inArray(key, ['user_level', 'agency_location', 'is_worker']) < 0) {
                                        modalDataForm.find('[name="' + key + '"]').val(val);
                                    }

                                    if (key == 'user_level_id' && modalDataForm.find('[name="user_level"] option[value="' +val+ '"]').length) {
                                        modalDataForm.find('[name="user_level"]').val(val).trigger('change');
                                    }

                                    if (key == 'agency_location_id' && modalDataForm.find('[name="agency_location"] option[value="' +val+ '"]').length) {
                                        modalDataForm.find('[name="agency_location"]').val(val).trigger('change');
                                    }

                                    if (key == 'is_worker') {
                                        if (val == 1) {
                                            modalDataForm.find('[name="is_worker"]').val('Yes');
                                        } else {
                                            modalDataForm.find('[name="is_worker"]').val('No');
                                        }
                                    }
                                });

                                modalDataForm.find('.group-detail-user').show();
                                modalDataForm.find('.btn-password').attr({'onclick': 'changePassword(' + response.user.id + ')'}).show();

                                modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
                            }
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
                        url: '<?php echo base_url("admin/users/delete/' + id + '"); ?>',
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
            data: modalDataForm.serialize(),
            dataType: 'json',
            beforeSend: function() {
                modalDataForm.find('.invalid-feedback').empty();
                modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', true);
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

                modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalDataForm.find('.btn-submit').find('span').remove();
                modalData.find('.close').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

                modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalDataForm.find('.btn-submit').find('span').remove();
                modalData.find('.close').attr('disabled', false);
            }
        });
    });

    // change password by id
    function changePassword(id) {
        if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
            modalPasswordForm[0].reset();
            modalPasswordForm.attr({'action': '<?php echo base_url("admin/users/change-password/' + id + '"); ?>'});
            modalPasswordForm.find('input').removeClass('is-invalid');
            modalPasswordForm.find('.invalid-feedback').empty();
            modalPasswordForm.find('.btn-submit').html('Update');

            modalPassword.find('.modal-header .modal-title').html('Change Password');
            modalPassword.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
        }
    }

    // submited form password
    modalPasswordForm.on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: modalPasswordForm.attr('action'),
            type: 'post',
            data: modalPasswordForm.serialize(),
            dataType: 'json',
            beforeSend: function() {
                modalPasswordForm.find('.invalid-feedback').empty();
                modalPasswordForm.find('.btn-submit, .btn-cancel').attr('disabled', true);
                modalPasswordForm.find('.btn-submit').prepend('<span class="spinner-border spinner-border-sm mr-2">&nbsp;</span>');
                modalPassword.find('.close').attr('disabled', true);
            },
            success: function(response) {
                if (response !== null && typeof response === 'object') {
                    if ('error' in response) {
                        if (response.error !== null && typeof response.error === 'object') {
                            $.each(response.error, function(key, val) {
                                if(val !== '') {
                                    modalPasswordForm.find('[name="' + key + '"]').addClass('is-invalid');
                                    modalPasswordForm.find('[name="' + key + '"]').parents('.form-group').find('.invalid-feedback').html(val);
                                }
                            });
                        }
                    } else {
                        modalPassword.modal('hide');
                        modalData.modal('hide');

                        if (response.status == 'success') {
                            window.location.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    }
                }

                modalPasswordForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalPasswordForm.find('.btn-submit').find('span').remove();
                modalPassword.find('.close').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

                modalPasswordForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalPasswordForm.find('.btn-submit').find('span').remove();
                modalPassword.find('.close').attr('disabled', false);
            }
        });
    });

    // reset password by id
    function resetPassword(id) {
        if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
            var swalBootstrap = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary rounded-0 mr-2',
                    cancelButton: 'btn btn-default rounded-0'
                },
                buttonsStyling: false
            });

            swalBootstrap.fire({
                title: 'Reset this user password?',
                text: 'Password will reset to default.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url("admin/users/reset-password/' + id + '"); ?>',
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            modalData.modal('hide');

                            if (response.status == 'success') {
                                window.location.reload();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);

                            $('#modalData').modal('hide');
                        }
                    });
                }
            });
        }
    }
</script>
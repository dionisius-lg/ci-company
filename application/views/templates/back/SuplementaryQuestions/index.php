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
                <?php echo form_open('admin/suplementary-questions', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php echo form_label('Question', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'question', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('question') ? $this->input->get('question') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Answer Type'); ?>
                            <select class="form-control select2 rounded-0" name="answer_type">
                                <option value="">Please Select</option>
                                <option value="1">Option</option>
                                <option value="2">Text</option>
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
                                <th class="text-nowrap">Question</th>
                                <th class="text-nowrap">Answer Type</th>
                                <th class="text-nowrap">Create Date</th>
                                <th class="text-nowrap">Create By</th>
                                <th class="text-nowrap">Last Update Date</th>
                                <th class="text-nowrap">Last Update By</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (count($suplementary_questions) > 0) {
                            foreach ($suplementary_questions as $suplementary_question) { echo
                                '<tr>
                                    <td class="text-nowrap">' . $no . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['question'] . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['answer_type'] . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['create_date'] . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['create_by'] . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['update_date'] . '</td>
                                    <td class="text-nowrap">' . $suplementary_question['update_by'] . '</td>
                                    <td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailData(' . $suplementary_question['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $suplementary_question['id'] . ')']) . '</td>
                                </tr>';

                                $no++;
                            }
                        } else { echo
                            '<tr>
                                <td class="text-center" colspan="4">No data found</td>
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
            <?php echo form_open(null, ['method' => 'post', 'autocomplete' => 'off']); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php echo form_label('Question <span class="text-danger">*</span>', null); ?>
                            <?php echo form_textarea(['name' => 'question', 'class' => 'form-control form-control-sm rounded-0', 'rows' => '2', 'style' => 'resize:none;', 'autofocus' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <?php echo form_label('Answer Type <span class="text-danger">*</span>'); ?>
                            <select class="form-control select2 rounded-0" name="answer_type">
                                <option value="">Please Select</option>
                                <option value="1">Option</option>
                                <option value="2">Text</option>
                            </select>
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
        modalDataForm = $('#modalData form');

    $(document).ready(function() {
        // describe required variable
        var filterAnswerType = '<?php echo $this->input->get('answer_type'); ?>';

        // set value to element if variable true or numeric
        if (filterAnswerType && $.isNumeric(filterAnswerType)) {
            $('#formFilter select[name="answer_type"]').val(filterAnswerType).trigger('change');
        }
    });

    // add new data
    function newData() {
        modalDataForm[0].reset();
        modalDataForm.find('select').val(null).trigger('change');
        modalDataForm.attr({'action': '<?php echo base_url("admin/suplementary-questions/create"); ?>'});
        modalDataForm.find('input, select, textarea').removeClass('is-invalid');
        modalDataForm.find('.invalid-feedback').empty();
        modalDataForm.find('.btn-submit').html('Create');
        modalDataForm.find('select[name="answer_type"').attr('disabled', false);

        modalData.find('.modal-header .modal-title').html('Create New Data');
        modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
    }

    // detail data by id
    function detailData(id) {
        if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
            $.ajax({
                url: '<?php echo base_url("admin/suplementary-questions/detail/' + id + '"); ?>',
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    modalDataForm[0].reset();
                    modalDataForm.find('select').val(null).trigger('change');
                    modalDataForm.attr({'action': '<?php echo base_url("admin/suplementary-questions/update/' + id + '"); ?>'});
                    modalDataForm.find('input, select, textarea').removeClass('is-invalid');
                    modalDataForm.find('.invalid-feedback').empty();
                    modalDataForm.find('.btn-submit').html('Update');
                    modalDataForm.find('select[name="answer_type"').attr('disabled', true);

                    modalData.find('.modal-header .modal-title').html('Detail Data');
                },
                success: function(response) {
                    if (response !== null && typeof response === 'object') {
                        if (response.status === 'success') {
                            $.each(response.data, function(key, val) {
                                if ($.inArray(key, ['answer_type']) < 0) {
                                    modalDataForm.find('[name="' + key + '"]').val(val);
                                }

                                if (key == 'answer_type_id' && modalDataForm.find('[name="answer_type"] option[value="' +val+ '"]').length) {
                                    modalDataForm.find('[name="answer_type"]').val(val).trigger('change');
                                }
                            });

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
                text: 'Suplementary question data on worker also deleted as well. This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url("admin/suplementary-questions/delete/' + id + '"); ?>',
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

                modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalDataForm.find('.btn-submit').find('span').remove();
                modalData.find('.close').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
                console.log(jqXHR.responseText);

                modalDataForm.find('.btn-submit, .btn-cancel, .btn-password').attr('disabled', false);
                modalDataForm.find('.btn-submit').find('span').remove();
                modalData.find('.close').attr('disabled', false);
            }
        });
    });
</script>
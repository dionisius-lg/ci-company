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
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap">Fullname</th>
                                <th class="text-nowrap">Description</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if (count($testimonies) > 0) {
                            foreach ($testimonies as $testimony) { echo
                                '<tr>
                                    <td class="text-nowrap">' . $no . '</td>
                                    <td class="text-nowrap">' . (@getimagesize(base_url('files/testimonies/'.$testimony['picture'])) ? '<a href="' . base_url('files/testimonies/'.$testimony['picture']) . '" class="venobox">View Picture</a>' : 'File not found') . '</td>
                                    <td class="text-nowrap">' . $testimony['fullname'] . '</td>
                                    <td class="text-nowrap">' . $testimony['description'] . '</td>
                                    <td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'detailData(' . $testimony['id'] . ')']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $testimony['id'] . ')']) . '</td>
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
                            <?php echo form_label('Testimony <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'file', 'name' => 'picture', 'class' => 'hidden', 'data-toggle' => 'change']); ?>
                            <div class="border">
                                <img src="" alt="Attachment Preview" class="img-fluid">
                                <div class="layer">
                                    <?php echo form_button(['type' => 'button', 'class' => 'btn btn-outline-success btn-sm rounded-0', 'content' => 'Browse', 'data-toggle' => 'browse']); ?>
                                </div>
                            </div>
                            <span class="form-text">Allowed type: jpg, jpeg, png. Max size: 500KB (For optimal page load).</span>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <?php echo form_label('Fullname', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control form-control-sm rounded-0', 'maxlength' => '50', 'autofocus' => true]); ?>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php echo form_label('Testimony Description', null); ?>
                            <textarea name="description" class="form-control" id="Description" cols="30" rows="5"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="row group-detail">
                        <div class="form-group col-md-6">
                            <?php echo form_label('Create Date', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'create_date', 'class' => 'form-control form-control-sm rounded-0', 'readonly' => true]); ?>
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
        modalDataForm.attr({'action': '<?php echo base_url("admin/testimonies/create"); ?>'});
        modalDataForm.find('input, select, textarea').removeClass('is-invalid');
        modalDataForm.find('.invalid-feedback').empty();
        modalDataForm.find('.btn-submit').html('Create');
        modalDataForm.find('.group-detail').attr({'hidden': true});
        modalDataForm.find('img').attr({'src': '<?php echo base_url('assets/img/default-picture.jpg'); ?>'});

        modalData.find('.modal-header .modal-title').html('Create New Data');
        modalData.modal({'backdrop': 'static', 'keyboard': false, 'show': true});
    }

    // detail data by id
    function detailData(id) {
        if (id !== null && id !== undefined && id !== '' && $.isNumeric(id)) {
            $.ajax({
                url: '<?php echo base_url("admin/testimonies/detail/' + id + '"); ?>',
                type: 'get',
                dataType: 'json',
                beforeSend: function() {
                    modalDataForm[0].reset();
                    modalDataForm.find('select').val(null).trigger('change');
                    modalDataForm.attr({'action': '<?php echo base_url("admin/testimonies/update/' + id + '"); ?>'});
                    modalDataForm.find('input, select, textarea').removeClass('is-invalid');
                    modalDataForm.find('.invalid-feedback').empty();
                    modalDataForm.find('.btn-submit').html('Update');
                    modalDataForm.find('.group-detail').attr({'hidden': false});

                    modalData.find('.modal-header .modal-title').html('Detail Data');
                },
                success: function(response) {
                    if (response !== null && typeof response === 'object') {
                        if (response.status === 'success') {
                            modalDataForm.find('img').attr({'src': response.data['file']});
                            modalDataForm.find('[name="fullname"]').val(response.data['fullname']);
                            modalDataForm.find('[name="description"]').val(response.data['description']);
                            modalDataForm.find('[name="create_date"]').val(response.data['create_date']);
                            // modalDataForm.find('[name="create_by"]').val(response.data['create_by']);
                            // modalDataForm.find('[name="update_date"]').val(response.data['update_date']);
                            // modalDataForm.find('[name="update_by"]').val(response.data['update_by']);

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
                        url: '<?php echo base_url("admin/testimonies/delete/' + id + '"); ?>',
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

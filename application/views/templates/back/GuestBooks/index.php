<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter Data</h3>
            </div>
            <div class="card-body">
                <?php echo form_open('admin/guest-books', ['id' => 'formFilter', 'method' => 'get', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <?php echo form_label('Subject', 'Subject'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'subject', 'id' => 'Subject', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('subject') ? $this->input->get('subject') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Sender Name', 'SenderName'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'sender_name', 'id' => 'SenderName', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('sender_name') ? $this->input->get('sender_name') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Sender Email', 'SenderEmail'); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'sender_email', 'id' => 'SenderEmail', 'class' => 'form-control form-control-sm rounded-0', 'value' => $this->input->get('sender_email') ? $this->input->get('sender_email') : '']); ?>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Status', 'Status'); ?>
                            <select class="form-control select2 rounded-0" name="status" id="Status">
                                <option value="">Please Select</option>
                                <option value="1">Unread</option>
                                <option value="2">Read</option>
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
                                <th class="text-nowrap">Subject</th>
                                <th class="text-nowrap">Sender Name</th>
                                <th class="text-nowrap">Sender Email</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (count($guest_books) > 0) {
                            foreach ($guest_books as $guest_book) { echo
                                '<tr>
                                    <td class="text-nowrap">' . $no . '</td>
                                    <td class="text-nowrap">' . $guest_book['subject'] . '</td>
                                    <td class="text-nowrap">' . $guest_book['sender_name'] . '</td>
                                    <td class="text-nowrap">' . $guest_book['sender_email'] . '</td>
                                    <td class="text-nowrap"><span class="badge badge-' . ($guest_book['status_id'] == 1 ? 'warning' : 'secondary') . '"> ' . strtoupper($guest_book['status']) . ' </span></td>
                                    <td class="text-nowrap">' . form_button(['type' => 'button', 'class' => 'btn btn-info btn-xs rounded-0', 'content' => '<i class="fa fa-eye fa-fw"></i>', 'title' => 'Detail', 'onclick' => 'return window.location.href = \'' . base_url('admin/guest-books/detail/' . $guest_book['id']) . '\';']) . form_button(['type' => 'button', 'class' => 'btn btn-danger btn-xs rounded-0', 'content' => '<i class="fa fa-trash fa-fw"></i>', 'title' => 'Delete', 'onclick' => 'deleteData(' . $guest_book['id'] . ')']) . '</td>
                                </tr>';

                                $no++;
                            }
                        } else { echo
                            '<tr>
                                <td class="text-center" colspan="6">No data found</td>
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

<!-- load required builded stylesheet for this page -->
<!-- <?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?> -->
<!-- <?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?> -->

<!-- load required builded script for this page -->
<!-- <?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?> -->

<script type="text/javascript">
    $(document).ready(function() {
        // describe required variable
        var filterStatus = '<?php echo $this->input->get('status'); ?>';

        // set value to element if variable true or numeric
        if (filterStatus && $.isNumeric(filterStatus)) {
            $('#Status').val(filterStatus).trigger('change');
        }
    });

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
                        url: '<?php echo base_url("admin/guest-books/delete/' + id + '"); ?>',
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
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header">
                <h3 class="card-title">Read Mail</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div> -->

            <div class="card-body">
                <div class="mailbox-read-info">
                    <h5><?php echo $guest_book['subject']; ?></h5>
                    <h6>From: <?php echo $guest_book['sender_name'] . ' (' . $guest_book['sender_email'] . ')' ; ?>
                    <span class="mailbox-read-time float-right"><?php echo $guest_book['create_date']; ?></span></h6>
                </div>

                <div class="mailbox-read-message">
                    <?php echo unStrClean($guest_book['body']); ?>
                </div>
            </div>

            <div class="card-footer">
                <div class="float-right">
                    <?php echo form_button(['type' => 'button', 'class' => 'btn btn-sm btn-danger rounded-0', 'content' => 'Delete', 'onclick' => 'deleteData(' . $guest_book['id'] . ')']); ?>
                    <?php echo mailto($guest_book['sender_email'], 'Reply', ['class' => 'btn btn-sm btn-info rounded-0']); ?>
                </div>
                <?php echo anchor('admin/guest-books', 'Back', ['class' => 'btn btn-sm btn-default rounded-0']); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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
                                window.location.href = '<?php echo base_url("admin/guest-books"); ?>';
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
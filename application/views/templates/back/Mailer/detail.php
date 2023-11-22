<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php echo form_open_multipart('admin/mailer/update', ['method' => 'post', 'id' => 'formData', 'autocomplete' => 'off']); ?>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <?php echo form_label('Protocol <span class="text-danger">*</span>', null); ?>
                            <?php echo form_dropdown('protocol', ['' => 'Please Select', 'mail' => 'Mail', 'smtp' => 'SMTP' ], oldInput('encryption', $email_account['protocol']), 'class="form-control form-control-sm rounded-0"' . (hasFlashError('protocol') ? ' is-invalid' : '')); ?>
                            <span class="invalid-feedback"><?php echo flashError('protocol'); ?></span>
                        </div>
                        <div class="form-group col-md-3">
                            <?php echo form_label('Host <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'host', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('name') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('host', $email_account['host'])]); ?>
                            <span class="invalid-feedback"><?php echo flashError('host'); ?></span>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Port <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'text', 'name' => 'port', 'class' => 'form-control form-control-sm rounded-0 numeric' . (hasFlashError('port') ? ' is-invalid' : ''), 'maxlength' => '5', 'value' => oldInput('port', $email_account['port'])]); ?>
                            <span class="invalid-feedback"><?php echo flashError('port'); ?></span>
                        </div>
                        <div class="form-group col-md-2">
                            <?php echo form_label('Encryption <span class="text-danger">*</span>', null); ?>
                            <?php echo form_dropdown('encryption', ['' => 'Please Select', 'ssl' => 'SSL', 'tls' => 'TLS' ], oldInput('encryption', $email_account['encryption']), 'class="form-control form-control-sm rounded-0"' . (hasFlashError('encryption') ? ' is-invalid' : '')); ?>
                            <span class="invalid-feedback"><?php echo flashError('encryption'); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?php echo form_label('Username <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'email', 'name' => 'username', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('username') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('username', $email_account['username'])]); ?>
                            <span class="invalid-feedback"><?php echo flashError('username'); ?></span>
                        </div>
                        <div class="form-group col-md-3">
                            <?php echo form_label('Password <span class="text-danger">*</span>', null); ?>
                            <?php echo form_input(['type' => 'password', 'name' => 'password', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('password') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('password', $email_account['password'])]); ?>
                            <span class="invalid-feedback"><?php echo flashError('password'); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?php echo form_label('Alias (Username)', null); ?>
                            <?php echo form_input(['type' => 'email', 'name' => 'alias', 'class' => 'form-control form-control-sm rounded-0' . (hasFlashError('alias') ? ' is-invalid' : ''), 'maxlength' => '100', 'value' => oldInput('alias', $email_account['alias'])]); ?>
                            <span class="invalid-feedback"><?php echo flashError('alias'); ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right border-top mt-2 pt-3">
                            <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-sm btn-primary rounded-0 btn-submit', 'content' => 'Update']); ?>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //disable submit on submitted form
    $('#formData').on('submit', function(e) {
        $(this).find('[type="submit"]').attr({'disabled': true});
    });
</script>
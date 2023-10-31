<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?php echo $this->template->title; ?></h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
                <li><?php echo $this->lang->line('front')['topbar']['login']; ?></li>
            </ol>
        </div>
    </div>
</section>

<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-10 mx-auto">
                <div class="box mx-auto">
                    <div class="message">
                        <?php if (hasFlashError('register')) {
                            echo '<span class="text-danger"><i class="fa fa-warning"></i> ' . flashError('register') . '</span>';
                        } elseif (hasFlashSuccess('register')) {
                            echo flashSuccess('register');
                        } else {
                            echo $this->lang->line('front')['page_register']['intro'];
                        } ?>
                    </div>
                    <?php echo form_open('auth/register', ['id' => 'formRegister', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <?php echo form_label($this->lang->line('front')['page_register']['fullname'] . '&nbsp;<span class="text-danger">*</span>', 'fullname'); ?>
                                <?php echo form_input(['type' => 'text', 'name' => 'fullname', 'id' => 'fullname', 'class' => 'form-control capitalize ' . (hasFlashError('fullname') ? 'is-invalid' : ''), 'value' => oldInput('fullname'), 'required' => true, 'autofocus' => true]); ?>
                                <span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <?php echo form_label($this->lang->line('front')['page_register']['email'] . '&nbsp;<span class="text-danger">*</span>', 'email'); ?>
                                <?php echo form_input(['type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control lowercase ' . (hasFlashError('email') ? 'is-invalid' : ''), 'value' => oldInput('email'), 'required' => true]); ?>
                                <span class="invalid-feedback"><?php echo flashError('email'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <?php echo form_label($this->lang->line('front')['page_register']['company'], 'company'); ?>
                                <?php echo form_input(['type' => 'text', 'name' => 'company', 'id' => 'company', 'class' => 'form-control capitalize ' . (hasFlashError('company') ? 'is-invalid' : ''), 'value' => oldInput('company')]); ?>
                                <span class="invalid-feedback"><?php echo flashError('company'); ?></span>
                            </div>
                            <div class="col-md-6">
                                <?php echo form_label($this->lang->line('front')['page_register']['register_as'] . '&nbsp;<span class="text-danger">*</span>', 'RegisterAs'); ?>
                                <select name="register_as" id="RegisterAs" class="form-control custom-select" required>
                                    <option value="">Please Select</option>
                                    <?php foreach ($user_levels as $register_as) {
                                        echo '<option value="' .$register_as['id']. '">'. $register_as['name']. '</option>';
                                    } ?>
                                </select>
                                <span class="invalid-feedback"><?php echo flashError('register_as'); ?></span>
                            </div>
                            <div class="col-md-6 hidden">
                                <?php echo form_label($this->lang->line('front')['page_register']['agency_location'] . '&nbsp;<span class="text-danger">*</span>', 'agency_location'); ?>
                                <select name="agency_location" id="agency_location" class="form-control custom-select">
                                    <option value="">Please Select</option>
                                    <?php foreach ($agency_locations as $agency) {
                                        echo '<option value="' .$agency['id']. '">'. $agency['name']. '</option>';
                                    } ?>
                                </select>
                                <span class="invalid-feedback"><?php echo flashError('agency_location'); ?></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6 col-md-12 text-center">
                                <?php echo $recaptcha ?>
                            </div>
                            <div class="col-lg-6 col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary rounded-0"><?php echo $this->lang->line('front')['page_register']['submit']; ?></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/parsley/parsley.css', ['type' => 'text/css', 'media' => 'all']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/parsley/parsley.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/parsley/i18n/' . strtolower(str_replace('-', '_', siteLang()['key'])) . '.js'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        function rescaleCaptcha(){
            var width = $('.g-recaptcha').parent().width();
            var scale;
            if (width < 302) {
                scale = width / 302;
            } else {
                scale = 1.0; 
            }

            $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
            $('.g-recaptcha').css('transform-origin', '0 0');
            $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
        }

        rescaleCaptcha();
        $( window ).resize(function() { rescaleCaptcha(); });
    });

    $('#RegisterAs').on('change', function(e) {
        e.preventDefault();

        $('#agency_location').val(null).trigger('change');

        if (this.value == 3) {
            if ($('#agency_location').parent().hasClass('hidden')) $('#agency_location').attr({'required': true}).parent().removeClass('hidden');
        } else {
            if (!$('#agency_location').parent().hasClass('hidden')) $('#agency_location').attr({'required': false}).parent().addClass('hidden');
        }
    })

    $('#formRegister').on('submit', function(e) {
        e.preventDefault();

        $(this).parsley().validate();

        if (!$(this).parsley().isValid()) return false;

        var captcha = $('#g-recaptcha-response').val();

        if (captcha == "" || captcha == undefined || captcha.length == 0) {
            var bsSwal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-secondary rounded-0'
                },
                buttonsStyling: false
            });

            bsSwal.fire('<?php echo $this->lang->line('message')['error']['captcha']; ?>');

            return false;
        }

        e.currentTarget.submit();
    });
</script>
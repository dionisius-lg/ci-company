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

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 mx-auto">
                <div class="box mx-auto">
                    <div class="message">
                        <?php if (hasFlashError('auth')) {
                            echo '<span class="text-danger"><i class="fa fa-warning"></i> ' . ((flashError('auth') === 'unauthorized') ? $error_auth = $this->lang->line('message')['error']['auth'] : flashError('auth')) . '</span>';
                        } else {
                            echo $this->lang->line('front')['page_login']['intro'];
                        } ?>
                    </div>
                    <?php echo form_open('auth', ['id' => 'formAuth', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
                        <div class="form-group">
                            <?php echo form_input(['type' => 'text', 'name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => $this->lang->line('front')['page_login']['username'], 'data-parsley-errors-container' => '.parsley-username', 'required' => true, 'autofocus' => true]); ?>
                            <span class="text-danger parsley-username"></span>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <?php echo form_input(['type' => 'password', 'name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => $this->lang->line('front')['page_login']['password'], 'data-parsley-errors-container' => '.parsley-password', 'required' => true]); ?>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fa fa-fw fa-eye toggle-password"></i>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger parsley-password"></span>
                        </div>
                        <div class="form-group text-center">
                            <?php echo $recaptcha ?>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-secondary rounded-0"><?php echo $this->lang->line('front')['page_login']['submit']; ?></button>
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

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/parsley/parsley.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/parsley/i18n/' . strtolower(str_replace('-', '_', siteLang()['key'])) . '.js'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        rescaleCaptcha();
        $( window ).resize(function() { rescaleCaptcha(); });
    });

    $('.toggle-password').click(function() {
        $(this).toggleClass('fa-eye fa-eye-slash');

        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });

    $('#formAuth').on('submit', function(e) {
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
</script>
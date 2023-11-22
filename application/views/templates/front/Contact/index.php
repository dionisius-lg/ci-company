<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?php echo $this->template->title; ?></h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
                <li><?php echo $this->lang->line('front')['navbar']['contact']; ?></li>
            </ol>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <?php echo $this->lang->line('front')['page_contact']['info']['title']; ?>
                        </h5>
                    </div>
                    <div class="card-body info">
                        <div class="clearfix">
                            <i class="fa fa-map-marker"></i>
                            <h4><?php echo $this->lang->line('front')['page_contact']['info']['location']; ?>:</h4>
                            <p><?php echo ((siteLang()['key'] == 'en') ? $company['address_eng'] : $company['address_ind']) . ', ' . $company['city'] . ', ' . $company['province'] . (!empty($company['zip_code']) ? ' - ' . $company['zip_code'] : ''); ?></p>
                        </div>
                        <div class="clearfix">
                            <i class="fa fa-envelope"></i>
                            <h4><?php echo $this->lang->line('front')['page_contact']['info']['email']; ?>:</h4>
                            <p><?php echo $company['email_1'] . '</a> ' . (!empty($company['email_2']) ? $company['email_2'] : ''); ?></p>
                        </div>
                        <div class="clearfix">
                            <i class="fa fa-phone"></i>
                            <h4><?php echo $this->lang->line('front')['page_contact']['info']['phone']; ?>:</h4>
                            <p><?php echo $company['phone_1'] . (!empty($company['phone_2']) ? ', ' . $company['phone_2'] : ''); ?></p>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15805.182399269808!2d112.65305!3d-7.968372!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7ac4f9f54a469489!2sPT.%20Amalia%20Rozikin%20Jaya!5e0!3m2!1sen!2sid!4v1616842630982!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <?php echo $this->lang->line('front')['page_contact']['message']['title']; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('contact/send', ['method' => 'post', 'id' => 'formContact', 'autocomplete' => 'off']); ?>

                            <?php if (hasFlashError('contact')) {
                                echo '<div class="flash-message mb-3">' . flashError('contact') . '</div>';
                            } elseif (hasFlashSuccess('contact')) {
                                echo '<div class="flash-message mb-3">' . flashSuccess('contact') . '</div>';
                            } ?>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <?php echo form_label($this->lang->line('front')['page_contact']['message']['name'], 'ContactName'); ?>
                                    <?php echo form_input(['type' => 'text', 'name' => 'contact_name', 'id' => 'ContactName', 'class' => 'form-control rounded-0 shadow-none' . (hasFlashError('contact_name') ? ' is-invalid' : ''), 'value' => oldInput('contact_name', null)]); ?>
                                    <span class="invalid-feedback"><?php echo flashError('contact_name'); ?></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo form_label($this->lang->line('front')['page_contact']['message']['email'], 'ContactEmail'); ?>
                                    <?php echo form_input(['type' => 'email', 'name' => 'contact_email', 'id' => 'ContactEmail', 'class' => 'form-control rounded-0 shadow-none' . (hasFlashError('contact_email') ? ' is-invalid' : ''), 'value' => oldInput('contact_email', null)]); ?>
                                    <span class="invalid-feedback"><?php echo flashError('contact_email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label($this->lang->line('front')['page_contact']['message']['subject'], 'ContactSubject'); ?>
                                <?php echo form_input(['type' => 'text', 'name' => 'contact_subject', 'id' => 'ContactSubject', 'class' => 'form-control rounded-0 shadow-none' . (hasFlashError('contact_subject') ? ' is-invalid' : ''), 'value' => oldInput('contact_subject', null)]); ?>
                                <span class="invalid-feedback"><?php echo flashError('contact_subject'); ?></span>
                            </div>
                            <div class="form-group">
                                <?php echo form_label($this->lang->line('front')['page_contact']['message']['message'], 'ContactMessage'); ?>
                                <?php echo form_textarea(['name' => 'contact_message', 'id' => 'ContactMessage', 'class' => 'form-control rounded-0 shadow-none' . (hasFlashError('contact_message') ? ' is-invalid' : ''), 'value' => oldInput('contact_message', null)]); ?>
                                <span class="invalid-feedback"><?php echo flashError('contact_message'); ?></span>
                            </div>
                            <div class="mb-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary rounded-0"><?php echo $this->lang->line('front')['page_contact']['message']['send']; ?></button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- script for this page -->
<script type="text/javascript">
    $('#formContact').on('submit', function(e) {
        // e.preventDefault();

        $('#formContact .loading').show();
        // $('#formContact').submit();
        // $(e.currentTarget).submit();
    })
</script>
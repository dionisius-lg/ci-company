<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?php echo $this->template->title; ?></h2>
            <ol>
                <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
                <li><?php echo $this->lang->line('front')['navbar']['worker']; ?></li>
            </ol>
        </div>
    </div>
</section>

<section id="worker">
    <div class="container">
        <?php echo form_open('', ['method' => 'get', 'id' => 'formFilter', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['ref_number'], null); ?>
                    <?php echo form_input(['type' => 'text', 'name' => 'ref_number', 'class' => 'form-control', 'value' => $this->input->get('ref_number') ? $this->input->get('ref_number') : '']); ?>
                </div>
                <div class="form-group col-md-3">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['fullname'], null); ?>
                    <?php echo form_input(['type' => 'text', 'name' => 'fullname', 'class' => 'form-control', 'value' => $this->input->get('fullname') ? $this->input->get('fullname') : '']); ?>
                </div>
                <div class="form-group col-md-2">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['gender'], null); ?>
                    <select name="gender" class="form-control select2">
                        <option value="">Please Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['marital_status'], null); ?>
                    <select name="marital_status" class="form-control select2">
                        <option value="">Please Select</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorce">Divorce</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['age'], null); ?>
                    <div class="d-flex flex-wrap">
                        <div class="input-group input-group-sm input-daterange">
                            <?php echo form_input(['type' => 'text', 'name' => 'age_start', 'class' => 'form-control numeric age-range', 'value' => $this->input->get('age_start') ? $this->input->get('age_start') : '']); ?>
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text">to</span>
                            </div>
                            <?php echo form_input(['type' => 'text', 'name' => 'age_end', 'class' => 'form-control numeric age-range', 'value' => $this->input->get('age_end') ? $this->input->get('age_end') : '']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['work_experience'], null); ?>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($agency_locations as $work_experience) { ?>
                            <div class="icheck-secondary mr-4">
                                <?php echo form_checkbox(['name' => 'work_experience[]', 'id' => 'WorkExperience' . $work_experience['id'], 'value' => $work_experience['slug']]); ?>
                                <?php echo form_label($work_experience['name'], 'WorkExperience' . $work_experience['id']); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <?php echo form_label($this->lang->line('front')['page_worker']['worker_data']['skill_experience'], null); ?>
                    <div class="d-flex flex-wrap">
                        <?php foreach ($skill_experiences as $skill_experience) { ?>
                            <div class="icheck-secondary mr-4">
                                <?php echo form_checkbox(['name' => 'skill_experience[]', 'id' => 'SkillExperience' . $skill_experience['id'], 'value' => $skill_experience['slug'], 'class' => 'asd']); ?>
                                <?php echo form_label($skill_experience['name'], 'SkillExperience' . $skill_experience['id']); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right border-top mt-1 pt-2">
                    <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-secondary', 'content' => $this->lang->line('front')['page_worker']['button']['search']]); ?>
                </div>
            </div>
        <?php echo form_close(); ?>

        <div class="section-sub-title">
            <h5><?php echo $this->lang->line('front')['page_worker']['result']; ?></h5>
        </div>

        <div class="row">
            <?php if (count($workers) > 0) { ?>
                <?php foreach ($workers as $worker) { ?>
                    <div class="col-md-4 mb-3">
                        <div class="box">
                            <div class="profile-photo">
                                <img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>" class="img-fluid">
                            </div>
                            <div class="profile-name">
                                <h6><?php echo $worker['fullname']; ?></h6>
                                <p><?php echo $this->lang->line('front')['page_worker']['worker_data']['ref_number'] . ': ' . $worker['ref_number']; ?></p>
                            </div>
                            <div class="profile-info match-height">
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['gender']; ?></div>
                                    <div><?php echo !empty($worker['gender']) ? $worker['gender'] : '-'; ?></div>
                                </div>
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['marital_status']; ?></div>
                                    <div><?php echo !empty($worker['marital_status']) ? $worker['marital_status'] : '-'; ?></div>
                                </div>
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['age']; ?></div>
                                    <div><?php echo !empty($worker['age']) ? $worker['age'] : '-'; ?></div>
                                </div>
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['skill_experience']; ?></div>
                                    <div><?php echo !empty($worker['skill_experience']) ? $worker['skill_experience'] : '-'; ?></div>
                                </div>
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['work_experience']; ?></div>
                                    <div><?php echo !empty($worker['work_experience']) ? $worker['work_experience'] : '-'; ?></div>
                                </div>
                                <div class="flex-wrapper">
                                    <div><?php echo $this->lang->line('front')['page_worker']['worker_data']['ready_placement']; ?></div>
                                    <div><?php echo !empty($worker['ready_placement']) ? $worker['ready_placement'] : '-'; ?></div>
                                </div>
                            </div>
                            <div class="profile-menu">
                                <?php echo anchor('worker/detail/' . base64url_encode($worker['id']), $this->lang->line('front')['page_worker']['button']['view_detail'], ['class' => 'btn btn-secondary']);

                                echo form_button(['type' => 'button', 'class' => 'btn btn-outline-secondary btn-play-youtube rounded-0 ml-3' . (!filter_var($worker['link_video'], FILTER_VALIDATE_URL) ? ' disabled' : ''), 'content' => '<i class="fa fa-play">&nbsp;</i> ' . $this->lang->line('front')['page_worker']['button']['play_video'], 'data-url' => $worker['link_video']]); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-12 text-center">
                    <p class="my-4"><?php echo $this->lang->line('front')['page_worker']['no_result']; ?></p>
                </div>
            <?php } ?>
        </div>

        <div class="page-center">
            <?php echo $pagination; ?>
        </div>
    </div>
</section>

<!-- modal video -->
<div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
            <div class="modal-body">
                
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="" allowscriptaccess="always" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/select2/css/select2-bootstrap4.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/icheck-bootstrap/icheck-bootstrap.min.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/select2/js/select2.full.min.js'); ?>

<?php if (hasFlashError('worker')) { ?>
<script>
    var bsSwal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-secondary rounded-0'
        },
        buttonsStyling: false
    });

    bsSwal.fire('<?php echo flashError("worker"); ?>');
</script>
<?php } ?>

<!-- script for this page -->
<script type="text/javascript">
    $(document).ready(function() {
        // var paramSkillExperience = '<?php echo $this->input->get('skill_experience'); ?>',
        var paramSkillExperience = '<?php echo urldecode($this->input->get('skill_experience')); ?>',
            elemSkillExperience = $('#formFilter [name="skill_experience[]"');

        for (var x = 0; x < elemSkillExperience.length; x++) {
            if($.inArray(elemSkillExperience[x].value, paramSkillExperience.split(',')) !== -1) {
                elemSkillExperience.eq(x).attr('checked', true);
            }
        }

        // var paramWorkExperience = '<?php echo $this->input->get('work_experience'); ?>',
        var paramWorkExperience = '<?php echo urldecode($this->input->get('work_experience')); ?>',
            elemWorkExperience = $('#formFilter [name="work_experience[]"');

        for (var y = 0; y < elemWorkExperience.length; y++) {
            if($.inArray(elemWorkExperience[y].value, paramWorkExperience.split(',')) !== -1) {
                elemWorkExperience.eq(y).attr('checked', true);
            }
        }

        if ($('#formFilter [name="gender"]').find('option[value="<?php echo $this->input->get('gender'); ?>"]').length) {
            $('#formFilter [name="gender"]').val('<?php echo $this->input->get('gender'); ?>').trigger('change');
        }

        if ($('#formFilter [name="marital_status"]').find('option[value="<?php echo $this->input->get('marital_status'); ?>"]').length) {
            $('#formFilter [name="marital_status"]').val('<?php echo $this->input->get('marital_status'); ?>').trigger('change');
        }

        if ($('#formFilter [name="placement"]').find('option[value="<?php echo $this->input->get('placement'); ?>"]').length) {
            $('#formFilter [name="placement"]').val('<?php echo $this->input->get('placement'); ?>').trigger('change');
        }
    });

    $('#formFilter').on('submit', function(e) {
        e.preventDefault();

        var thisForm = $(this);

        var thisSkillExperience = thisForm.find('[name="skill_experience[]"'),
            valueSkillExperience = [],
            xxx = 0;

        for (var xx = 0; xx < thisSkillExperience.length; xx++) {
            if (thisSkillExperience[xx].checked) {
                valueSkillExperience[xxx] = thisSkillExperience[xx].value;
                xxx++;
            }
        }

        thisForm.append('<input type="hidden" name="skill_experience" value="' + valueSkillExperience.join(',') +'">');
        thisSkillExperience.attr({'disabled': true});

        var thisWorkExperience = thisForm.find('[name="work_experience[]"'),
            valueWorkExperience = [],
            yyy = 0;

        for (var yy = 0; yy < thisWorkExperience.length; yy++) {
            if (thisWorkExperience[yy].checked) {
                valueWorkExperience[yyy] = thisWorkExperience[yy].value;
                yyy++;
            }
        }

        thisForm.append('<input type="hidden" name="work_experience" value="' + valueWorkExperience.join(',') +'">');
        thisWorkExperience.attr({'disabled': true});

        thisForm.find('[type="submit"]').attr({'disabled': true});

        e.currentTarget.submit();
    });

    // script for play video
    $(document).ready(function() {
        $('#modalVideo').on('hide.bs.modal', function(e) {
            $('#modalVideo iframe').attr({'src': null});
        });
    });

    // play youtube video
    $('.btn-play-youtube').on('click', function(e) {
        e.preventDefault();

        var url = $(this).data('url'),
            regexpYoutube = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;

        try {
            var validUrl = new URL(url);
            var matchUrl = validUrl['href'].match(regexpYoutube);

            if (matchUrl && matchUrl[2].length == 11) {
                validUrl = 'https://www.youtube.com/embed/' + matchUrl[2];

                $('#modalVideo iframe').attr({'src': validUrl + '?autoplay=1&modestbranding=1&showinfo=0rel=0'});
                // $('#modalVideo iframe').attr({'src': validUrl + '?modestbranding=1&rel=0&iv_load_policy=3&fs=0&disablekb=1&showinfo=0&autoplay=1&ytp-pause-overlay=0'});
                $('#modalVideo').modal('show');
            }
        } catch (error) {
            return false;
        }
    });
</script>
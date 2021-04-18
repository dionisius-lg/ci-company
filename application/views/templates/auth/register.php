<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('header')['navbar']['home']; ?></a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

<section id="register">
	<div class="container">
		<div class="col-md-8 col-sm-10 mx-auto">
			<div class="box mx-auto">
				<div class="message">
					<?php if (hasFlashError()) {
						echo '<span class="text-danger"><i class="fa fa-warning"></i> ' . flashError();
					} elseif (hasFlashSuccess()) {
						echo flashSuccess();
					} else {
						echo $this->lang->line('page_register')['intro'];
					} ?>
				</div>
				<?php echo form_open('auth/register', ['id' => 'formRegister', 'autocomplete' => 'off', 'data-parsley-validate' => true]); ?>
					<div class="form-row">
						<div class="col-md-6">
							<?php echo form_label($this->lang->line('page_register')['fullname'] . '&nbsp;<span class="text-danger">*</span>', 'fullname'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'fullname', 'id' => 'fullname', 'class' => 'form-control capitalize ' . (hasFlashError('fullname') ? 'is-invalid' : ''), 'value' => oldInput('fullname'), 'required' => true, 'autofocus' => true]); ?>
							<span class="invalid-feedback"><?php echo flashError('fullname'); ?></span>
						</div>
						<div class="col-md-6">
							<?php echo form_label($this->lang->line('page_register')['email'] . '&nbsp;<span class="text-danger">*</span>', 'email'); ?>
							<?php echo form_input(['type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control lowercase ' . (hasFlashError('email') ? 'is-invalid' : ''), 'value' => oldInput('email'), 'required' => true]); ?>
							<span class="invalid-feedback"><?php echo flashError('email'); ?></span>
						</div>
						<div class="col-md-6">
							<?php echo form_label($this->lang->line('page_register')['company'], 'company'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'company', 'id' => 'company', 'class' => 'form-control capitalize ' . (hasFlashError('company') ? 'is-invalid' : ''), 'value' => oldInput('company')]); ?>
							<span class="invalid-feedback"><?php echo flashError('company'); ?></span>
						</div>
						<div class="col-md-6">
							<?php echo form_label($this->lang->line('page_register')['country'], 'country'); ?>
							<?php echo form_input(['type' => 'text', 'name' => 'country', 'id' => 'country', 'class' => 'form-control capitalize ' . (hasFlashError('country') ? 'is-invalid' : ''), 'value' => oldInput('country')]); ?>
							<span class="invalid-feedback"><?php echo flashError('country'); ?></span>
						</div>
					</div>
					<div class="form-row">
						<div class="col-lg-6 col-md-12 text-center">
							<?php echo $recaptcha ?>
						</div>
						<div class="col-lg-6 col-md-12 text-right">
							<button type="submit" class="btn btn-secondary rounded-0"><?php echo $this->lang->line('page_register')['submit']; ?></button>
						</div>
					</div>
				<?php echo form_close(); ?>
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
<?php switch (sitelang()) {
	case 'indonesian':
		$this->template->javascript->add('assets/vendor/parsley/i18n/id.js');
		break;
	case 'japanese':
		$this->template->javascript->add('assets/vendor/parsley/i18n/ja.js');
		break;
	case 'korean':
		$this->template->javascript->add('assets/vendor/parsley/i18n/ko.js');
		break;
	case 'mandarin':
		$this->template->javascript->add('assets/vendor/parsley/i18n/zh_tw.js');
		break;
} ?>

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

	$('#formRegister').on('submit', function(e) {
		e.preventDefault();

		$(this).parsley().validate();

		if (!$(this).parsley().isValid()) return false;

		var captcha = $('#g-recaptcha-response').val();

		if (captcha == "" || captcha == undefined || captcha.length == 0) {
			var errorMessage;

			switch ('<?php echo sitelang(); ?>') {
				case 'indonesian':
					errorMessage = 'Captcha diperlukan';
					break;
				case 'japanese':
					errorMessage = 'キャプチャが必要です';
					break;
				case 'korean':
					errorMessage = '보안 문자가 필요합니다';
					break;
				case 'mandarin':
					errorMessage = '必須輸入驗證碼';
					break;
				default:
					errorMessage = 'Captcha is required';
			}

			Swal.fire({
				icon: 'error',
				title: errorMessage
			});

			return false;
		}

		e.currentTarget.submit();
	});
</script>
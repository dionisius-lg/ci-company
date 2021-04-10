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

<section class="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 d-flex align-items-stretch">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">
							<?php echo $this->lang->line('page_contact')['info']['title']; ?>
						</h5>
					</div>
					<div class="card-body info">
						<div class="clearfix">
							<i class="fa fa-map-marker"></i>
							<h4><?php echo $this->lang->line('page_contact')['info']['location']; ?>:</h4>
							<p><?php echo ((sitelang() == 'english') ? $company['address_eng'] : $company['address_ind']) . ', ' . $company['city'] . ', ' . $company['province'] . (!empty($company['zip_code']) ? ' - ' . $company['zip_code'] : ''); ?></p>
						</div>
						<div class="clearfix">
							<i class="fa fa-envelope"></i>
							<h4><?php echo $this->lang->line('page_contact')['info']['email']; ?>:</h4>
							<p><?php echo $company['email_1'] . '</a> ' . (!empty($company['email_2']) ? $company['email_1'] : ''); ?></p>
						</div>
						<div class="clearfix">
							<i class="fa fa-phone"></i>
							<h4><?php echo $this->lang->line('page_contact')['info']['phone']; ?>:</h4>
							<p><?php echo $company['phone_1'] . (!empty($company['phone_2']) ? ', ' . $company['phone_2'] : ''); ?></p>
						</div>

						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15805.182399269808!2d112.65305!3d-7.968372!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7ac4f9f54a469489!2sPT.%20Amalia%20Rozikin%20Jaya!5e0!3m2!1sen!2sid!4v1616842630982!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
			</div>

			<div class="col-lg-7 d-flex align-items-stretch">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">
							<?php echo $this->lang->line('contact_message')['title']; ?>
						</h5>
					</div>
					<div class="card-body infos">
						<form action="" method="post" role="form">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="ContactName"><?php echo $this->lang->line('page_contact')['message']['name']; ?></label>
									<input type="text" class="form-control rounded-0 shadow-none" name="contact_name" id="ContactName">
									<span class="invalid-feedback"></span>
								</div>
								<div class="form-group col-md-6">
									<label for="ContactEmail"><?php echo $this->lang->line('page_contact')['message']['email']; ?></label>
									<input type="email" class="form-control rounded-0 shadow-none" name="contact_email" id="ContactEmail">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group">
								<label for="ContactSubject"><?php echo $this->lang->line('page_contact')['message']['subject']; ?></label>
								<input type="text" class="form-control rounded-0 shadow-none" name="contact_subject" id="ContactSubject">
								<span class="invalid-feedback"></span>
							</div>
							<div class="form-group">
								<label for="ContactMessage"><?php echo $this->lang->line('page_contact')['message']['message']; ?></label>
								<textarea class="form-control rounded-0 shadow-none" name="contact_message" id="ContactMessage" rows="10"></textarea>
								<span class="invalid-feedback"></span>
							</div>
							<div class="mb-3">
								<div class="loading">Loading</div>
								<div class="error-message"></div>
								<div class="sent-message">Your message has been sent. Thank you!</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-secondary rounded-0"><?php echo $this->lang->line('page_contact')['message']['send']; ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="index.html">Home</a></li>
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
							contact info
						</h5>
					</div>
					<div class="card-body info">
						<div class="clearfix">
							<i class="fa fa-map-marker"></i>
							<h4>location:</h4>
							<p>A108 Adam Street, New York, NY 535022</p>
						</div>
						<div class="clearfix">
							<i class="fa fa-envelope"></i>
							<h4>email:</h4>
							<p>info@example.com</p>
						</div>
						<div class="clearfix">
							<i class="fa fa-phone"></i>
							<h4>call:</h4>
							<p>+62 8888 8888 8888</p>
						</div>

						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
					</div>
				</div>
			</div>

			<div class="col-lg-7 d-flex align-items-stretch">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">
							get in touch
						</h5>
					</div>
					<div class="card-body infos">
						<form action="" method="post" role="form">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="ContactName">Your Name</label>
									<input type="text" class="form-control rounded-0 shadow-none" name="contact_name" id="ContactName">
									<span class="invalid-feedback"></span>
								</div>
								<div class="form-group col-md-6">
									<label for="ContactEmail">Your Email</label>
									<input type="email" class="form-control rounded-0 shadow-none" name="contact_email" id="ContactEmail">
									<span class="invalid-feedback"></span>
								</div>
							</div>
							<div class="form-group">
								<label for="ContactSubject">Subject</label>
								<input type="text" class="form-control rounded-0 shadow-none" name="contact_subject" id="ContactSubject">
								<span class="invalid-feedback"></span>
							</div>
							<div class="form-group">
								<label for="ContactMessage">Message</label>
								<textarea class="form-control rounded-0 shadow-none" name="contact_message" id="ContactMessage" rows="10"></textarea>
								<span class="invalid-feedback"></span>
							</div>
							<div class="mb-3">
								<div class="loading">Loading</div>
								<div class="error-message"></div>
								<div class="sent-message">Your message has been sent. Thank you!</div>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-secondary rounded-0">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
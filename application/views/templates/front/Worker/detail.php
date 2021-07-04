<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('front')['navbar']['home']; ?></a></li>
				<li><a href="<?php echo base_url('/worker'); ?>"><?php echo $this->lang->line('front')['navbar']['worker']; ?></a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

<section id="worker" class="detail">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<div class="profile-photo">
					<div class="img-wrapper">
						<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>" class="img-fluid">

						<div class="layer">
							<?php $attr_avatar = [
								'type' => 'button',
								'class' => 'btn btn-avatar venobox',
								'content' => $this->lang->line('front')['page_worker']['button']['view_avatar']
							];

							if (@getimagesize(base_url('files/workers/'.$worker['id'].'/'.$worker['photo']))) {
								$attr_avatar['data-href'] = base_url('files/workers/'.$worker['id'].'/'.$worker['photo']);
							} else {
								$attr_avatar['class'] = $attr_avatar['class'] . ' disabled';
							}

							echo form_button($attr_avatar); ?>
						</div>
					</div>
					
					<p class="booking-status">Booking Status: <?php echo $worker['booking_status']; ?></p>

					<?php if (in_array($worker['booking_status_id'], [2,3])) {
						if (!empty($worker['booking_user_id']) && $worker['booking_user_id'] != $this->session->userdata('AuthUser')['id']) {
							echo '<p class="booking-status">' . $worker['booking_status'] . ' by ' . $worker['booking_by'] . ' on ' . date('d-m-Y H:i:s', strtotime($worker['booking_date'])) . '</p>';
						}
					}

					if ($worker['booking_status_id'] == 4) {
						echo '<p class="booking-status">Hired by ' . $worker['booking_by'] . ' on ' . date('d-m-Y H:i:s', strtotime($worker['booking_date'])) . '</p>';
					} ?>
				</div>

				<div class="profile-menu">
					<?php if (isset($menu_booking)) echo form_button($menu_booking);

					echo form_button(['type' => 'button', 'class' => 'btn btn-outline-secondary btn-download-profile rounded-0', 'content' => '<i class="fa fa-download">&nbsp;</i> ' . $this->lang->line('front')['page_worker']['button']['download_data'], 'data-worker' => $worker['ref_number']]); ?>
				</div>

				<?php if (count($attachments) > 0) { ?>
					<div class="profile-menu text-left mt-4">
						<div class="section-sub-title">
							<h5><?php echo $this->lang->line('front')['page_worker']['attachment']; ?></h5>
						</div>
						<ul class="nav flex-column">
						<?php if ($worker['booking_status_id'] != 4) : ?>
							<small class="text-danger">*There is no Attach File*</small>
						<?php else : ?>
							<?php foreach ($attachments as $attachment) : ?>
								<li class="nav-item">
									<a href="#" class="nav-link btn-attachment" data-worker="<?= $worker['id'] ?>" data-filename="<?=  $attachment['file_name']; ?>"><?= $attachment['name']; ?><i class="fa fa-download float-right"></i>
									</a>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
						</ul>
					</div>
				<?php } ?>
			</div>
			<div class="col-lg-8">
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['profile']; ?></h5>
				</div>
				<div class="profile-info mb-4">
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['ref_number']; ?></div>
						<div><?php echo !empty($worker['ref_number']) ? $worker['ref_number'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['fullname']; ?></div>
						<div><?php echo !empty($worker['fullname']) ? $worker['fullname'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['birth_place']; ?></div>
						<div><?php echo !empty($worker['birth_place']) ? $worker['birth_place'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['birth_date']; ?></div>
						<div><?php echo !empty($worker['birth_date']) ? date('d-m-Y', strtotime($worker['birth_date'])) : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['age']; ?></div>
						<div><?php echo !empty($worker['age']) ? $worker['age'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['religion']; ?></div>
						<div><?php echo !empty($worker['religion']) ? $worker['religion'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['gender']; ?></div>
						<div><?php echo !empty($worker['gender']) ? $worker['gender'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['marital_status']; ?></div>
						<div><?php echo !empty($worker['marital_status']) ? $worker['marital_status'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['email']; ?></div>
						<div><?php echo !empty($worker['email']) ? $worker['email'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['phone']; ?></div>
						<div><?php echo !empty($worker['phone']) ? $worker['phone'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['address']; ?></div>
						<div><?php echo !empty($worker['full_address']) ? $worker['full_address'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['last_education']; ?></div>
						<div><?php echo !empty($worker['last_education']) ? $worker['last_education'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['character_evaluation']; ?></div>
						<div><?php echo !empty($worker['character_evaluation']) ? $worker['character_evaluation'] : '-'; ?></div>
					</div>
				</div>
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['family_background']; ?></h5>
				</div>
				<div class="profile-info mb-4">
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['spouse_name']; ?></div>
						<div><?php echo !empty($worker['spouse_name']) ? $worker['spouse_name'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['spouse_occupation']; ?></div>
						<div><?php echo !empty($worker['spouse_occupation']) ? $worker['spouse_occupation'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['children']; ?></div>
						<div><?php echo !empty($worker['children']) ? $worker['children'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['children_age']; ?></div>
						<div><?php echo !empty($worker['children_age']) ? $worker['children_age'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['father_name']; ?></div>
						<div><?php echo !empty($worker['father_name']) ? $worker['father_name'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['father_occupation']; ?></div>
						<div><?php echo !empty($worker['father_occupation']) ? $worker['father_occupation'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['mother_name']; ?></div>
						<div><?php echo !empty($worker['mother_name']) ? $worker['mother_name'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['mother_occupation']; ?></div>
						<div><?php echo !empty($worker['mother_occupation']) ? $worker['mother_occupation'] : '-'; ?></div>
					</div>
				</div>
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['skills']; ?></h5>
				</div>
				<div class="profile-info mb-4">
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['skill_experience']; ?></div>
						<div><?php echo !empty($worker['skill_experience']) ? $worker['skill_experience'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['language_ability']; ?></div>
						<div><?php echo !empty($worker['language_ability']) ? $worker['language_ability'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['cooking_ability']; ?></div>
						<div><?php echo !empty($worker['cooking_ability']) ? $worker['cooking_ability'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['work_experience']; ?></div>
						<div><?php echo !empty($worker['work_experience']) ? $worker['work_experience'] : '-'; ?></div>
					</div>
				</div>
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['others']; ?></h5>
				</div>
				<div class="profile-info ">
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['placement']; ?></div>
						<div><?php echo !empty($worker['placement']) ? $worker['placement'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['ready_placement']; ?></div>
						<div><?php echo !empty($worker['ready_placement']) ? $worker['ready_placement'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['description']; ?></div>
						<div><?php echo !empty($worker['description']) ? $worker['description'] : '-'; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css']); ?>
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/file-saver/FileSaver.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
	// download file
	$('.btn-attachment').on('click', function(e) {
		e.preventDefault();

		var param = {
			'worker': $(this).data('worker'),
			'filename': $(this).data('filename'),
			['<?php echo $this->security->get_csrf_token_name(); ?>']: '<?php echo $this->security->get_csrf_hash(); ?>'
		};

		$.ajax({
			url: '<?php echo base_url("worker/download-attachment"); ?>',
			type: 'post',
			data: param,
			dataType: 'json',
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if (response.status == 'success') {
						saveAs(response.file);
					} else {
						var bsSwal = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-secondary rounded-0'
							},
							buttonsStyling: false
						});

						bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
					}
				}
			},
			error: function () {
				var bsSwal = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-secondary rounded-0'
					},
					buttonsStyling: false
				});

				bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
			}
		});
	});

	// download biodata
	$('.btn-download-profile').on('click', function(e) {
		e.preventDefault();

		var param = {
			'worker': $(this).data('worker'),
			['<?php echo $this->security->get_csrf_token_name(); ?>']: '<?php echo $this->security->get_csrf_hash(); ?>'
		};

		$.ajax({
			url: '<?php echo base_url("worker/download-profile"); ?>',
			type: 'post',
			data: param,
			dataType: 'json',
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if (response.status == 'success') {
						saveAs(response.file);
					} else {
						var bsSwal = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-primary rounded-0'
							},
							buttonsStyling: false
						});

						bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
					}
				}
			},
			error: function () {
				var bsSwal = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary rounded-0'
					},
					buttonsStyling: false
				});

				bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
			}
		});
	});

	// booking worker
	$('.btn-booking').on('click', function(e) {
		e.preventDefault();

		var param = {
			'worker': $(this).data('worker'),
			'booking': $(this).data('booking'),
			['<?php echo $this->security->get_csrf_token_name(); ?>']: '<?php echo $this->security->get_csrf_hash(); ?>'
		};

		$.ajax({
			url: '<?php echo base_url("worker/booking"); ?>',
			type: 'post',
			data: param,
			dataType: 'json',
			success: function(response) {
				if (response !== null && typeof response === 'object') {
					if (response.status == 'success') {
						 window.location.reload();
					} else {
						var bsSwal = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-primary rounded-0'
							},
							buttonsStyling: false
						});

						bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
					}
				}
			},
			error: function () {
				var bsSwal = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-primary rounded-0'
					},
					buttonsStyling: false
				});

				bsSwal.fire('<?php echo $this->lang->line('message')['error']['default']; ?>');
			}
		});
	});
</script>

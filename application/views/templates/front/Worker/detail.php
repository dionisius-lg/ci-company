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
				</div>

				<div class="profile-menu">
					<?php $attr_booking = [
						'type' => 'button',
						'class' => 'btn btn-secondary btn-booking rounded-0 d-block mx-auto mb-2',
						'data-worker' => $worker['nik'],
						'data-booking' => 2,
						'content' => '<i class="fa fa-lock">&nbsp;</i> Booking'
					];

					if ($this->session->userdata('AuthUser')['user_level_id'] == 3) {
						if ($worker['booking_status_id'] == 2) {
							$attr_booking['data-booking'] = 3;
							$attr_booking['content'] = '<i class="fa fa-check">&nbsp;</i> Confirm';
						} elseif ($worker['booking_status_id'] == 3) {
							$attr_booking['class'] = $attr_booking['class'] . ' disabled';
							$attr_booking['content'] = '<i class="fa fa-spinner">&nbsp;</i> Waiting For Approval';
							unset($attr_booking['data-worker']);
							unset($attr_booking['data-booking']);
						} elseif ($worker['booking_status_id'] == 4) {
							$attr_booking['class'] = $attr_booking['class'] . ' disabled';
							$attr_booking['content'] = '<i class="fa fa-check">&nbsp;</i> Approved';
							unset($attr_booking['data-worker']);
							unset($attr_booking['data-booking']);
						}
					} else {
						$attr_booking['class'] = $attr_booking['class'] . ' disabled';
					}

					echo form_button($attr_booking);

					echo form_button(['type' => 'button', 'class' => 'btn btn-outline-secondary btn-download-profile rounded-0', 'content' => '<i class="fa fa-download">&nbsp;</i> ' . $this->lang->line('front')['page_worker']['button']['download_data'], 'data-worker' => $worker['nik']]);

					echo form_button(['type' => 'button', 'class' => 'btn btn-outline-secondary btn-play-youtube rounded-0' . (!filter_var($worker['link_video'], FILTER_VALIDATE_URL) ? ' disabled' : ''), 'content' => '<i class="fa fa-play">&nbsp;</i> ' . $this->lang->line('front')['page_worker']['button']['play_video'], 'data-url' => $worker['link_video']]); ?>
				</div>

				<?php if (count($attachments) > 0) { ?>
					<div class="profile-menu text-left mt-4">
						<div class="section-sub-title">
							<h5><?php echo $this->lang->line('front')['page_worker']['attachment']; ?></h5>
						</div>
						<ul class="nav flex-column">
							<?php foreach ($attachments as $attachment) { echo
								'<li class="nav-item">
									<a href="#" class="nav-link btn-attachment" data-worker="' . $worker['id'] . '" data-filename="' . $attachment['file_name'] . '">
										' . $attachment['name'] . ' <i class="fa fa-download float-right"></i>
									</a>
								</li>';
							} ?>
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
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['fullname']; ?></div>
						<div><?php echo !empty($worker['fullname']) ? $worker['fullname'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['nik']; ?></div>
						<div><?php echo !empty($worker['nik']) ? $worker['nik'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['gender']; ?></div>
						<div><?php echo !empty($worker['gender']) ? $worker['gender'] : '-'; ?></div>
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
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['marital_status']; ?></div>
						<div><?php echo !empty($worker['marital_status']) ? $worker['marital_status'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['religion']; ?></div>
						<div><?php echo !empty($worker['religion']) ? $worker['religion'] : '-'; ?></div>
					</div>
				</div>
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['contact']; ?></h5>
				</div>
				<div class="profile-info mb-4">
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
				</div>
				<div class="section-sub-title">
					<h5><?php echo $this->lang->line('front')['page_worker']['others']; ?></h5>
				</div>
				<div class="profile-info ">
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['description']; ?></div>
						<div><?php echo !empty($worker['description']) ? $worker['description'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['placement']; ?></div>
						<div><?php echo !empty($worker['placement']) ? $worker['placement'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['experience']; ?></div>
						<div><?php echo !empty($worker['experience']) ? $worker['experience'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['oversea_experience']; ?></div>
						<div><?php echo !empty($worker['oversea_experience']) ? $worker['oversea_experience'] : '-'; ?></div>
					</div>
					<div class="flex-wrapper">
						<div><?php echo $this->lang->line('front')['page_worker']['worker_data']['ready_placement']; ?></div>
						<div><?php echo !empty($worker['ready_placement']) ? $worker['ready_placement'] : '-'; ?></div>
					</div>
				</div>
			</div>
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
<?php $this->template->stylesheet->add('assets/vendor/venobox/css/venobox.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/venobox/js/venobox.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/file-saver/FileSaver.js'); ?>

<!-- script for this page -->
<script type="text/javascript">
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

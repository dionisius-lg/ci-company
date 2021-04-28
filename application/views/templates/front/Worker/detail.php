<section class="breadcrumbs">
	<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2 class="text-uppercase"><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('header')['navbar']['home']; ?></a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

<div class="container">
    <div class="main-body m-3 p-3">
	<h4 class="font-weight-bold text-primary"><i>Detail Worker</i></h4>
	<hr>
		<div class="row gutters-sm">
			<div class="col-md-4 mb-3">
				<div class="card border-primary">
					<div class="card-body">
						<div class="d-flex flex-column align-items-center text-center">
						<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>" class="rounded-circle">
							<div class="mt-3">
								<h4><?php echo $worker['nik']; ?></h4>
								<hr>
								<p class="text-secondary mb-2">
									Email: <?php echo $worker['email']; ?>
									<hr>
									Placement: <?php echo $worker['placement']; ?> - (<?php echo $worker['placement_status']; ?>)
								</p>
								<form action="<?php echo base_url('worker/bookingworker/' . $worker['id']); ?>" method="POST">
								<?php if ($worker['booking_status_id'] == 1) : ?>
									<button type="submit" name="free" class="text-uppercase btn btn-sm btn-primary mb-2">Booking</button>
								<?php elseif ($worker['booking_status_id'] == 3) : ?>
									<button type="submit" hidden name="confirmed" class="text-uppercase btn btn-sm btn-primary mb-2">Approved</button>
								<?php endif; ?>
									<!-- Button trigger modal -->
									<a href="" data-toggle="modal" data-target="#exampleModal" class="text-uppercase btn btn-sm btn-success mb-2">File Worker</a>
								</form>
								<?php if ($worker['booking_status_id'] == 3) : ?>
								<small class=text-danger>* Waiting For Approval *</small>
								<?php elseif ($worker['booking_status_id'] == 4) : ?>
								<small class=text-danger>* Approval Succes *</small>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="card mb-3 border-primary">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Full Name</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?php echo $worker['fullname']; ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Gender</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?php echo $worker['gender']; ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">City, Province</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							<?php echo $worker['city']; ?>, <?php echo $worker['province']; ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Birth Place</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							<?php echo $worker['birth_place']; ?> 
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Birth Date</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							<?php echo $worker['birth_date']; ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0">Address</h6>
							</div>
							<div class="col-sm-9 text-secondary">
							<?php echo $worker['address']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card mb-4 border-primary">
			<div class="card-body">
				<h5 class="text-primary text-center"><i>Worker And Experience</i></h5>
				<hr>
				<h6 class="my-3">Experience</h6>
				<div class="row mb-2">
					<div class="col-md-3 text-muted">Experience Worker:</div>
					<div class="col-md-9">
						<?php echo $worker['experience'] ?>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3 text-muted">Experience Oversea:</div>
					<div class="col-md-9">
						<?php echo $worker['oversea_experience']; ?>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3 text-muted">Placement Ready:</div>
					<div class="col-md-9">
					<a href="javascript:void(0)" class="text-body"><?php echo $worker['ready_placement']; ?></a>
					</div>
				</div>

				<h6 class="my-3">Contacts</h6>
				<div class="row mb-2">
					<div class="col-md-3 text-muted">Age:</div>
					<div class="col-md-9">
					<?php echo $worker['age'] ?>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3 text-muted">Marital Status:</div>
					<div class="col-md-9">
					<?php echo $worker['marital_status'] ?>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3 text-muted">Phone:</div>
					<div class="col-md-9">
					<?php echo $worker['phone_1'] ?>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3 text-muted">Religion:</div>
					<div class="col-md-9">
					<?php echo $worker['religion'] ?>
					</div>
				</div>

				<h6 class="my-3">Info</h6>
				<div class="row mb-2">
					<div class="col-md-3 text-muted">description:</div>
					<div class="col-md-9">
					<?php echo $worker['description'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File Attachment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<div class="card-body pt-0">
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tableDataAttachment" width="100%">
					<thead class="table-primary">
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Name</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach($attachments AS $attachment) : ?>
							<tr>
								<td class="text-center"><?php echo $i; ?></td>
								<td class="text-center"><?php echo $attachment['name']; ?></td>
								<td class="text-center">
									<a target="_blank" href="<?php echo base_url('worker/file/' . $attachment['id']); ?>"><i class="fa fa-download fa-fw"></i></a>
								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="row" id="tableDataAttachmentOption">
				<div class="col-md-12 table-paginate"></div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/sweetalert2/css/sweetalert2.min.css', ['type' => 'text/css', 'media' => 'all']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/sweetalert2/js/sweetalert2.min.js'); ?>

<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000
});
 
Toast.fire({
  title: '<?php echo flashSuccess() ?>'
});
</script>
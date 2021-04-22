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
	<div class="row justify-content-center">		
		<div class="col-md-4">
			<div class="card mb-4 m-5 p-3">
				<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>">
			</div>
		</div>  
		<div class="col-md-8">
			<div class="card m-5 p-3" style="font-size: 13px; box-shadow:18px 20px 5px rgba(0,0,0,0.5)">
				<div class="d-flex bd-highlight">
					<div class="m-3 bd-highlight">
						Nik : <?php echo $worker['nik']; ?>
						<hr>
						Email : <?php echo $worker['email']; ?>
						<hr>
						Age : <?php echo $worker['age']; ?>
						<hr>
						Gender : <?php echo $worker['gender']; ?>
						<hr>
						Religion : <?php echo $worker['religion']; ?>
						<hr>
						Status : <?php echo $worker['marital_status']; ?>
						<hr>
					</div>

					<div class="m-3 bd-highlight">
						Address : <?php echo $worker['address']; ?>
						<hr>
						City : <?php echo $worker['city']; ?>
						<hr>
						Province : <?php echo $worker['province']; ?>
						<hr>
						Experience : <?php echo $worker['experience']; ?>
						<hr>
						Oversea Experience : <?php echo $worker['oversea_experience']; ?>
						<hr>
						Ready For Placement : <?php echo $worker['ready_placement']; ?>
						<hr>	
					</div>
				</div>

				<div class="bd-highlight mt-3 mb-3">
					<form action="<?php echo base_url('worker/bookingworker/' . $worker['id']); ?>" method="POST">
					<?php if ($worker['booking_status_id'] == 1) : ?>
						<button type="submit" name="free" class="text-uppercase btn btn-sm btn-primary col-5">Booking</button>
					<?php elseif ($worker['booking_status_id'] == 2) : ?>
						<button type="submit" name="on_booking" class="text-uppercase btn btn-sm btn-primary col-5">On Booking</button>
					<?php elseif ($worker['booking_status_id'] == 3) : ?>
						<button type="submit" name="confirmed" class="text-uppercase btn btn-sm btn-primary col-5">Confirmed</button>
					<?php elseif ($worker['booking_status_id'] == 4) : ?>
						<button type="submit" name="approved" class="text-uppercase btn btn-sm btn-primary col-5">Approved</button>
					<?php endif; ?>					
						<button type="submit" name="download" class="text-uppercase btn btn-sm btn-success col-6">Download</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</div>

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
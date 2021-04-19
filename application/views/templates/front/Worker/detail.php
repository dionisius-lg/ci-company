tester<section class="breadcrumbs">
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
			<div class="card mb-4 box-shadow m-5 p-3">
				<img src="<?php echo @getimagesize(base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo'])) ? base_url('files/workers/'.$worker['id'].'/thumb/'.$worker['photo']) : base_url('assets/img/default-avatar.jpg'); ?>" alt="<?php echo $worker['fullname']; ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="card m-5 p-3" style="font-size: 13px; box-shadow:18px 20px 5px rgba(0,0,0,0.5)">
				<p>
					Email : <?php echo $worker['email']; ?>
					<hr>
					Phone : <?php echo $worker['phone_1']; ?>
					<hr>
					Birth Place : <?php echo $worker['birth_place']; ?>
					<hr>
					Birth Date : <?php echo $worker['birth_date']; ?>
					<hr>
					Gender : <?php echo $worker['gender']; ?>
					<hr>
					Address : <?php echo $worker['address']; ?>
					<hr>
					City : <?php echo $worker['city']; ?>
					<hr>
					Province : <?php echo $worker['province']; ?>
				</p>
					<a href="" class="text-uppercase btn btn-sm btn-primary m-2">Booking</a>
					<a href="" class="text-uppercase btn btn-sm btn-success m-2">Download</a>
			</div>
		</div>
	</div>
</div>
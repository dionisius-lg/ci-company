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
<div class="container bg-dark">
	<div class="row justify-content-center">
		<div class="col-sm-6 col-md-10">
			<div class="panel panel-default m-5 p-5">
			<!-- Default panel contents -->
				<div class="panel-heading text-center text-white mb-3"><h4>Details Worker</h4></div>
					<!-- List group -->
					<?php //print_r($worker); die(); ?>
					<ul class="list-group">
						<li class="list-group-item">Email : <?= $worker['email']; ?></li>
						<li class="list-group-item">Phone : <?= $worker['phone_1']; ?></li>
						<li class="list-group-item">Birth Place : <?= $worker['birth_place']; ?></li>
						<li class="list-group-item">Birth Date : <?= $worker['birth_date']; ?></li>
						<li class="list-group-item">Gender : <?= $worker['gender']; ?></li>
						<li class="list-group-item">Address : <?= $worker['address']; ?></li>
						<li class="list-group-item">City : <?= $worker['city']; ?></li>
						<li class="list-group-item">Province : <?= $worker['province']; ?></li>					
					</ul>
				</div>
		</div>
	</div>
</div>
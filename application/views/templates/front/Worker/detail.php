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
				<div class="panel-heading text-center text-white mb-3"><h4>Detail Employee</h4></div>
					<!-- List group -->
					<ul class="list-group">
						<li class="list-group-item">Email : <?= $data_employe['email']; ?></li>
						<li class="list-group-item">Phone : <?= $data_employe['phone_1']; ?></li>
						<li class="list-group-item">Birth Place : <?= $data_employe['birth_place']; ?></li>
						<li class="list-group-item">Birth Date : <?= $data_employe['birth_date']; ?></li>
						<li class="list-group-item">Gender : <?= $data_employe['gender']; ?></li>
						<li class="list-group-item">Address : <?= $data_employe['address']; ?></li>
						<li class="list-group-item">City : <?= $data_employe['city']; ?></li>
						<li class="list-group-item">Province : <?= $data_employe['province']; ?></li>					
					</ul>
				</div>
		</div>
	</div>
</div>
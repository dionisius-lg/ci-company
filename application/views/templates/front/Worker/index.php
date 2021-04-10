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
<?php
    // foreach($employees as $employee){    
    //     $data_employ = array_keys($employee);
    // }
    // print_r($data_employe); die();
?>
<section class="employees">
	<div class="container">
       <div class="row">

        <?php foreach ($workers as $worker) : ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail box">
                <img class="img-thumbnail" src="<?= base_url('files/worker/' . $worker['id'] . '/' . $worker['photo']); ?>">
                    <div class="caption">
                        <h5><?= $worker['fullname']; ?></h5>
                        <p><?= $worker['description']; ?></p>
                        <a href="<?= base_url('worker/detail/' . $worker['id']); ?>" class="btn btn-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
	</div>
</section>
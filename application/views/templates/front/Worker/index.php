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
            <div class="card m-5 p-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-thumbnail mb-3" src="<?= base_url('files/worker/'.$worker['id'] .'/'. $worker['photo']); ?>">
                        </div>
                        <div class="col-md-6" style="font-size: 14px">
                            <p><?php echo $worker['nik']; ?></p>
                            <p><?php echo $worker['fullname']; ?></p>
                            <p><?php echo $worker['age']; ?></p>
                            <p><?php echo $worker['marital_status']; ?></p>
                            <p><?php echo $worker['placement_status']; ?></p>
                            <p><?php echo $worker['placement']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="caption">
                        <p><?php echo $worker['description']; ?></p>
                    </div>
                    <a href="<?php echo base_url('worker/detail/' . $worker['id']); ?>" class="btn btn-primary btn-sm">Detail</a>
                    <?php //if(); ?>
                    <a href="<?php echo base_url('#' . $worker['id']); ?>" class="btn btn-success btn-sm">Choose</a>
                    <?php //endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
	</div>
</section>
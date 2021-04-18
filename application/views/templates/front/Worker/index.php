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
            <div class="col-md-12">
                <?php foreach ($workers as $worker) : ?>
                <div class="card m-5 p-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-uppercase">Nik - <?php echo $worker['nik']; ?></p>
                                <img width="200px" class="img-thumbnail mb-3" src="<?= base_url('files/workers/'.$worker['id'] .'/'. $worker['photo']); ?>">
                            </div>
                            
                            <div class="col-md-6">
                            <h5 class="text-center text-uppercase font-weight-bold">Detail Worker</h5>
                            <hr>
                                <p><?php echo $worker['fullname']; ?></p>
                                <p><?php echo $worker['age']; ?></p>
                                <p><?php echo $worker['marital_status']; ?></p>
                                <p><?php echo $worker['placement_status']; ?></p>
                                <p><?php echo $worker['placement']; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="caption mb-3 pb-5">
                            <p><?php echo $worker['description']; ?></p>
                        </div>
                        <a href="<?php echo base_url('worker/detail/' . $worker['id']); ?>" class="btn btn-primary btn-sm float-right">Detail</a>
                        <?php //if(); ?>
                        <a href="<?php echo base_url('#' . $worker['id']); ?>" class="btn btn-success btn-sm float-right mr-2">Choose</a>
                        <?php //endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
	</div>
</section>
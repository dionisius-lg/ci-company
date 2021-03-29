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
    // print_r($employees); die();
?>
<section class="employees">
	<div class="container">
       <div class="row">

        <?php foreach ($employees as $employee) : ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail box">
                <img class="img-thumbnail" src="<?= base_url('files/employees/'. $employee['photo']); ?>">
                    <div class="caption">
                        <h5>Thumbnail label</h5>
                        <p><?= $employee['fullname']; ?></p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Detail</button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                    </div>
                                <div class="modal-body">
                                <?php foreach($employees AS $employee) : ?>
                                    <div class="panel panel-default">
                                        <!-- Default panel contents -->
                                        <div class="panel-heading">Detail Employee</div>
                                        <!-- List group -->
                                        <ul class="list-group">
                                            <li class="list-group-item"><?= $employee['email'] ?></li>
                                            <li class="list-group-item"><?= $employee['phone_1'] ?></li>
                                            <li class="list-group-item"><?= $employee['birth_place'] ?></li>
                                            <li class="list-group-item"><?= $employee['birth_date'] ?></li>
                                            <li class="list-group-item"><?= $employee['gender'] ?></li>
                                            <li class="list-group-item"><?= $employee['address'] ?></li>
                                            <li class="list-group-item"><?= $employee['city'] ?></li>
                                            <li class="list-group-item"><?= $employee['province'] ?></li>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Modal -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
	</div>
</section>
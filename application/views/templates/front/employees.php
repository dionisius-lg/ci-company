<section class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2><?php echo $this->template->title; ?></h2>
			<ol>
				<li><a href="index.html">Home</a></li>
				<li><?php echo $this->template->title; ?></li>
			</ol>
		</div>
	</div>
</section>

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
                        <p>
                            <a href="#" class="btn btn-sm btn-primary" role="button">Detail</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
	</div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="countries mt-3">
                <h5 class="text-uppercase">Countries</h5>
                <hr>
                <?php foreach($placements AS $placement) : ?>
                <br>
                    <div class="col">
                        <a class="btn btn-outline-success border-dark col-8 text-left text-dark" href="<?php echo base_url('worker?ready_placement=' . $placement['id']); ?>"><?php echo $placement['name']; ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="categories mt-3">
                <h5 class="text-uppercase">Categories</h5>
                <hr>
                <?php foreach($experiences AS $experience) : ?>
                <br>
                    <div class="col">
                        <a class="btn btn-outline-primary border-dark col-8 text-left text-dark" href="<?php echo base_url('worker?experience_ids=' . $experience['id']); ?>"><?= $experience['name']; ?></a>
                    </div>
                <?php endforeach; ?>
                <br>
                    <div class="col">
                        <a class="btn btn-outline-primary border-dark col-8 text-left text-dark"  href="<?php echo base_url('worker'); ?>">Quick search</a>
                    </div>
            </div>
        </div>
    </div>
</div>
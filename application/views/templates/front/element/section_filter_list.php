<div class="container">
    <div class="row">
    <div class="col">
        <div class="countries mt-3">
        <h4>Countries</h4>
        <hr>
        <ul class="list-group">
        <?php foreach($placements AS $placement) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <p class="text-uppercase"><a href="<?php echo base_url('worker?ready_placement=' . $placement['id']); ?>"><?= $placement['name']; ?></a></p>
            </li>
        <?php endforeach; ?>
        </ul>
        </div>
    </div>

    <div class="col">
        <div class="categories mt-3">
        <h4>Categories</h4>
        <hr>

            <ul class="list-group">
            <?php foreach($experiences AS $experience) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="text-uppercase"><a href="<?php echo base_url('worker?experience_ids=' . $experience['id']); ?>"><?= $experience['name']; ?></a></p>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <div class="col">
        <div class="countries mt-3">
        <h4>Countries</h4>
        <hr>
        <ul class="list-group">
        <?php foreach($agency_countries AS $agent) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <p class="text-uppercase"><?= $agent['name']; ?></p>
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
            <?php foreach($work_experiences AS $work_exp) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p class="text-uppercase"><a href="<?php echo base_url('employees'); ?>"><?= $work_exp['name']; ?></a></p>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    </div>
</div>
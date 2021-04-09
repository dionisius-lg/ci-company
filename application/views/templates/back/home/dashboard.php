<div class="row">
	<div class="col-lg-12">
		<!-- Start of WebFreeCounter Code -->
<a href="https://www.webfreecounter.com/" target="_blank"><img src="https://www.webfreecounter.com/hit.php?id=gveodqno&nd=6&style=1" border="0" alt="visitor counter"></a>
<!-- End of WebFreeCounter Code -->
		<div class="card">
			<div class="card-header border-0">
				<div class="d-flex justify-content-between">
					<h3 class="card-title">Online Visitors</h3>
					<a href="javascript:void(0);">View Report</a>
				</div>
			</div>
			<div class="card-body">
				<div class="d-flex">
					<p class="d-flex flex-column">
						<span class="text-bold text-lg">820</span>
						<span>Visitors Over Time</span>
					</p>
					<p class="ml-auto d-flex flex-column text-right">
						<span class="text-success">
							<i class="fa fa-arrow-up"></i> 12.5%
						</span>
						<span class="text-muted">Since last week</span>
					</p>
				</div>
				<div class="position-relative mb-4">
					<canvas id="visitors-chart" height="200"></canvas>
				</div>
				<div class="d-flex flex-row justify-content-end">
					<span class="mr-2">
						<i class="fa fa-square text-primary"></i> This Week
					</span>
					<span>
						<i class="fa fa-square text-gray"></i> Last Week
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->template->javascript->add('assets/vendor/chartjs/js/Chart.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/adminlte/js/demo.js'); ?>
<?php $this->template->javascript->add('assets/vendor/adminlte/js/dashboard3.js'); ?>
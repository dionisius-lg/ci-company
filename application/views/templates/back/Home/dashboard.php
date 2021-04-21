<div class="row">
	<div class="col-12 col-sm-6 col-md-3 col-lg-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-danger"><i class="fa fa-user-plus"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total User Requests</span>
				<span class="info-box-number" id="TotalUserRequest">0</span>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3 col-lg-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-primary"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Users</span>
				<span class="info-box-number" id="TotalUser">0</span>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3 col-lg-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Workers</span>
				<span class="info-box-number" id="TotalWorker">0</span>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3 col-lg-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-warning"><i class="fa fa-exclamation-triangle"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Booking Request</span>
				<span class="info-box-number" id="TotalBookingRequest">0</span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header border-0">
				<h3 class="card-title">Total Data</h3>
			</div>
			<div class="card-body">
				<canvas id="TotalChart" height="300"></canvas>
			</div>
		</div>
	</div>
</div>


<!-- load required builded stylesheet for this page -->
<?php $this->template->stylesheet->add('assets/vendor/iosoverlay/css/iosOverlay.css', ['type' => 'text/css']); ?>

<!-- load required builded script for this page -->
<?php $this->template->javascript->add('assets/vendor/iosoverlay/js/iosOverlay.js'); ?>
<?php $this->template->javascript->add('assets/vendor/chartjs/js/Chart.min.js'); ?>
<?php $this->template->javascript->add('assets/vendor/socketio/socket.io.js'); ?>
<?php $this->template->javascript->add('assets/js/dashboard.js'); ?>

<script type="text/javascript">
// var ctx = $('#TotalChart');
	
// var ctx = document.getElementById('myChart').getContext('2d');
// var TotalChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: 'Total Data',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

</script>
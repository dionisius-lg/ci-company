const currentProtocol = window.location.protocol;
const currentLocation = window.location.hostname;
// console.log(currentProtocol + '//socket.' + currentLocation);

// const socket = io.connect(currentProtocol + '//socket.' + currentLocation.replace('www', ''));
const socket = io.connect('http://localhost:62542');

const base_url = $('meta[name="url"]').attr('content');

socket.on('total', function(result) {
	result = JSON.parse(result);

	if (result !== null && typeof result === 'object') {
		$('#TotalUserRequest').html(result.total_user_request);
		$('#TotalUser').html(result.total_user);
		$('#TotalWorker').html(result.total_worker);
		$('#TotalBookingRequest').html(result.total_booking_request);
	}

	var ticksStyle = {
		fontColor: '#495057',
		fontStyle: 'bold'
	}

	var totalChart = $('#TotalChart');
	var totalData = new Chart(totalChart, {
		type: 'bar',
		data: {
			labels: ['User Requests', 'User', 'Workers', 'Booking Requests',],
			datasets: [{
				label: 'Total Data',
				data: [
					result.total_user_request,
					result.total_user,
					result.total_worker,
					result.total_booking_request
				],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(255, 206, 86, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(255, 206, 86, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				mode: 'index',
				intersect: true
			},
			hover: {
				mode: 'index',
				intersect: true
			},
			legend: {
				display: false
			},
			scales: {
				yAxes: [{
					ticks: $.extend({
						beginAtZero: true,
								
						// Include a dollar sign in the ticks
						callback: function (value, index, values) {
							if (value >= 1000) {
								value /= 1000
								value += 'k'
							}
							
							return value
						}
					}, {
						fontColor: '#495057',
						fontStyle: 'normal'
					})
				}]
			}
		}
	});
});

$(function () {
	socket.emit('count-total', {});

	// socket.on('disconnect', function(reason) {
	// 	var disconnect = iosOverlay({
	// 		text: "Disconnected",
	// 		icon: base_url + 'assets/vendor/iosoverlay/img/cross.png'
	// 	});

	// 	socket.on('reconnect', function(){
	// 		disconnect.hide();

	// 		var reconnect = iosOverlay({
	// 			text: "Connected",
	// 			duration: 2000,
	// 			icon: base_url + 'assets/vendor/iosoverlay/img/check.png'
	// 		});
	// 	});

	// 	return false;
	// });
});

function isJson(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}

	return true;
}

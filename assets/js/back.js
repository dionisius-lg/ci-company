!(function($) {
	"use strict";

	// initialize select2
	if ($.isFunction($.fn.select2)) {
		$('.select2').select2({
			width: '100%',
			theme: 'bootstrap4',
		});
	}

	// trigger click input file
	$(document).on('click', '#previewAttachment [data-toggle="browse"]', function(e) {
		e.preventDefault();

		var attachItem = $(this).parents('.item');

		attachItem.find('input[type="file"]').trigger('click');
	});

	// show file temp on change
	$('input[type="file"][data-toggle="change"]').on('change', function(e) {
		e.preventDefault();

		var attachFile = $(this).get(0).files[0],
			attachItem = $(this).parents('.item'),
			attachFileReader = new FileReader();

		attachFileReader.onload = function(e) {
			if (attachFile.type.match('image')) {
				console.log(e.target.result);
				attachItem.find('img').attr('src', e.target.result);
			} else {
				attachItem.find('img').attr('src', $('meta[name="url"]').attr('content') + 'assets/img/default-picture.jpg');
			}
		};

		attachFileReader.readAsDataURL(attachFile);
	});

	// remove element error on keyup
	$('input, textarea').on('keyup', function(e) {
		var formGroup = $(this).parents('.form-group'),
			keycode = (event.keyCode ? event.keyCode : event.which);

		if (keycode != '13') {
			if ($(this).hasClass('is-invalid')) {
				$(this).removeClass('is-invalid');
			}

			formGroup.find('.invalid-feedback').not('.parsley').empty();
			formGroup.find('.form-text.text-danger').not('.parsley').empty();
		}
	});

	// remove element error on change
	$('input, select, textarea').on('change', function() {
		var formGroup = $(this).parents('.form-group');

		if ($(this).hasClass('is-invalid')) {
			$(this).removeClass('is-invalid');
		}

		formGroup.find('.invalid-feedback').not('.parsley').empty();
		formGroup.find('.form-text.text-danger').not('.parsley').empty();
	});

	// remove element.datepicker error on change
	$('.date').on('change.datetimepicker', function() {
		var formGroup = $(this).parents('.form-group');

		if ($(this).hasClass('is-invalid')) {
			$(this).removeClass('is-invalid');
		}

		formGroup.find('.invalid-feedback').not('.parsley').empty();
		formGroup.find('.form-text.text-danger').not('.parsley').empty();
	});

	// enable numeric only
	$('.numeric').on('keyup', function () {
		this.value = this.value.replace(/[^0-9\.]/g,'');
	});

	// initialize datepicker
	if ($.isFunction($.fn.datepicker)) {
		$('.date').datepicker({
			'format' : 'yyyy-mm-dd',
			'autoclose' : true,
			'minView' : 2,
			'weekStart' : 1,
			'language' : 'en',
			//'startDate' : '',
			//'endDate' : '{{ date("Y-m-d") }}',
			'todayHighlight': true,
		});
	}

	// initialize venobox
	if ($.isFunction($.fn.venobox)) {
		$('.venobox').venobox();
	}

	// initialize tooltip
	if ($.isFunction($.fn.tooltip)) {
		$('[data-toggle="tooltip"]').tooltip(); 
	}

	// autofocus on modal show
	$('.modal').on('shown.bs.modal', function() {
		$(this).find('[autofocus]').focus();
	});

	// custom ci3 pagination to bootstrap 4
	$('ul.pagination-ci3-bs4 > li').find('a, span').addClass('page-link');
})(jQuery);

// request data cities
function requestCities(param, selected = 0, element = null) {
	if (element == null) {
		element = $('#City');
	}

	if (param !== null && typeof param === 'object') {
		//$.ajaxSetup({
		//	headers: {
		//		'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		//	}
		//});

		$.ajax({
			type: 'post',
			url: $('meta[name="url"]').attr('content') + 'remote/get-cities',
			data: param,
			dataType: 'json',
			beforeSend: function() {
				element.html('<option value="">Please Wait</option>');
			},
			success: function(response) {
				element.html('<option value="">Please Select</option>');

				if (response !== null && typeof response === 'object') {
					if (response.length > 0) {
						for (i=0; i<response.length; i++) {
							element.append('<option value="' + response[i]['id'] + '">' + response[i]['name'] + '</option>');
						}
					}
				}

				if (element.find('option[value="'+selected+'"]').length) {
					element.find('option[value="'+selected+'"]').prop('selected', true);
					//element.val(selected).trigger('change');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				element.html('<option value="">Please Select</option>');
				console.log(jqXHR.status + '|' + textStatus + '|' + errorThrown);
			}
		});
	}
}

// show minimalist swal alert
function swalAlert(message = false) {
	// initialize sweetalert2 & message is true
	if (message && typeof Swal != 'undefined') {
		var swalBs = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-primary rounded-0'
			},
			buttonsStyling: false
		});

		swalBs.fire(message);
	}
}
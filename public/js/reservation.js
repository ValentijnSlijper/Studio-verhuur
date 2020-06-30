$('.add-reservation').on('click', function(){
	$(this).addClass('animate__rubberBand');

    $.post('https://studio-verhuur.tk/session/jsonSession', {}, function(result) {

		const data = JSON.parse(result);

        if (data['login'] !== true) {

        	$('.login').modal('show');
        }else {
        	
			setTimeout(function(){
				$('.animate__rubberBand').removeClass('animate__rubberBand');
				$('.resform').modal('toggle');
			}, 1000);
        }
    });
});

$('.delete-reservation').on('click', function(){
	$('.deletereservation').modal('show');
});

$('.update-reservation').on('click', function(){
	$('.updateresform').modal('show');
});

$('.deletereservation button').on('click', function(){
	if($(this).text() == 'Yes'){
		$.post('https://studio-verhuur.tk/reservation/delete/' + $('.delete-reservation').attr("data-id"), {}, function() {
			window.location.href = 'https://studio-verhuur.tk/home/reservations';
		});
	}else{
		$('.deletereservation').modal('hide');
	}
});

$('.reservationform').on('submit', function(e){
	// voorkomt dat de form automatisch submit wanneer je op de button klikt
	e.preventDefault();

	$.post('https://studio-verhuur.tk/error/validate/', { data: $('.reservationform').serializeArray() }, function(result) {

		const data = JSON.parse(result);

		if(data['success'] === true){
			showError('Reservation booked!', '#3BBA9C');

			$.post('https://studio-verhuur.tk/reservation/create', { data: data['reservation'] }, function(data) {
				setTimeout(function(){
					window.location.href = 'https://studio-verhuur.tk/home/reservations';
				}, 2000);
			});

		}else{
			showError(data, '#a03c3c');
		}

	});
});

$('.updatereservationform').on('submit', function(e){
	// voorkomt dat de form automatisch submit wanneer je op de button klikt
	e.preventDefault();

	$.post('https://studio-verhuur.tk/error/validate/', { data: $('.updatereservationform').serializeArray() }, function(result) {

		const data = JSON.parse(result);

		console.log(data);

		if(data['success'] === true){
			showError('Reservation updated!', '#3BBA9C');

			$.post('https://studio-verhuur.tk/reservation/update', { data: data['reservation'] }, function(data) {
				setTimeout(function(){
					window.location.href = 'https://studio-verhuur.tk/home/reservations';
				}, 2000);
			});

		}else{
			showError(data, '#a03c3c');
		}

	});
});

// seeden van de tijd select/options
for(i=0;i<24;i++){
	if(i<10){
		$('select[name="starttime"]').append(`
			<option value=${i}>${'0' + i + ':00'}</option>
		`);	

		$('select[name="endtime"]').append(`
			<option value=${i}>${'0' + i + ':00'}</option>
		`);		
	}else{
		$('select[name="starttime"]').append(`
			<option value=${i}>${i + ':00'}</option>
		`);

		$('select[name="endtime"]').append(`
			<option value=${i}>${i + ':00'}</option>
		`);
	}
}

function updateprice(modal){

	if($(modal).find('select[name="starttime"]').val() != 'empty' && $(modal).find('select[name="endtime"]').val() != 'empty' && $(modal).find('select[name="studio"]').val() != 'empty'){

		var formdata = { 
			'starttime' :  $(modal).find('select[name="starttime"]').val(),
			'endtime' :  $(modal).find('select[name="endtime"]').val(),
			'studio' :  $(modal).find('select[name="studio"]').val()
		};

		$.post('https://studio-verhuur.tk/reservation/price/', { data: formdata }, function(result) {
			$('.bookprice').text(result);
		});

		if($(modal).find('select[name="instrument"]').val() != 'empty'){

			formdata['instrument'] = $(modal).find('select[name="instrument"]').val();

			$.post('https://studio-verhuur.tk/reservation/price/', { data: formdata }, function(result) {
				$('.bookprice').text(result);
			});
		}
	}
}

// checkt of de start tijd niet later is dan de eind tijd
$('select[name="starttime"]').on('change', function(){

	var modal = $(this).closest('.modal');

	var starttime = parseInt(this.value.split(':')[0]);

	var end_el = $(modal).find('select[name="endtime"]');

	if(end_el.value != 'empty'){

		var endtime = parseInt($(modal).find('select[name="endtime"]').val());

		if(starttime > endtime){
			$(this).val(parseInt(end_el.value) - 1);
			showError("Start time can't be later than the end time", '#a03c3c');
		}
	}

	updateprice(modal);

});

// checkt of de eind tijd niet eerder is dan de start tijd
$('select[name="endtime"]').on('change', function(){

	var modal = $(this).closest('.modal');

	var endtime = parseInt(this.value.split(':')[0]);

	var start_el = $(modal).find('select[name="starttime"]');

	if(start_el.value != 'empty'){

		var starttime = parseInt($(modal).find('select[name="starttime"]').val());

		if(endtime < starttime){
			$(this).val(parseInt(start_el.value) + 1);
			showError("End time can't be earlier than the start time", '#a03c3c');
		}
	}

	updateprice(modal);

});

$('select[name="instrument"]').on('change', function(){
	var modal = $(this).closest('.modal');
	updateprice(modal);
});

$('select[name="studio"]').on('change', function(){
	var modal = $(this).closest('.modal');
	updateprice(modal);
});

$('.requestinvoice').on('click', function(){
	window.location.href = 'https://studio-verhuur.tk/reservation/invoice/' + $(this).data('id');
});


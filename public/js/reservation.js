$('.add-reservation').on('click', function(){
	$(this).addClass('animate__rubberBand');

	setTimeout(function(){
		$('.animate__rubberBand').removeClass('animate__rubberBand');
		$('.resform').modal('toggle');
	}, 1000);
})

$('.delete-reservation').on('click', function(){
	$('.deletereservation').modal('show');
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

$('.resform').on('submit', function(e){
	// voorkomt dat de form automatisch submit wanneer je op de button klikt
	e.preventDefault();

	
});
$('.booknow').on('click', function(){

	// wanneer de $session['login'] === false
	// open je de login modal als volgt: $('.login').modal('show')
	// anders open je de nog te maken reservation modal: $('.reservation').modal('show')
	// en vul je deze met data van de te boeken studio
	
});

$('.closemodal').on('click', function(){
	$(this).closest('.modal').modal('hide');
	$('.modal-backdrop').remove();
});
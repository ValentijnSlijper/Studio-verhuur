// functie voor het opvangen van de login form submit
$('.loginform').on('submit', function(e){

	// voorkomt dat de form de pagina refreshed
	e.preventDefault();

	// maakt een array van de form input data
	var formdata = $(this).serializeArray();

	// stuurt de array naar de controller en krijgt data terug.
	// wanneer de success key van de data array true is, laat je een confirm message zien, anders een error dmv de data array keys.
	$.post('https://studio-verhuur.tk/error/validate/', {data: formdata, function: $('.form-function').val()}, function(result) {

		// parsen van result data
		const data = JSON.parse(result);

		// wanneer de 'success' key van de data array true is
		if(data['success']){

			// wanneer de form functie op login staat word de ajax call gemaakt om de login data te controleren en in te loggen
			// hierna word een melding weergegeven dat er ingelogd word
			if(data['function'] == 'login'){
				$.post('https://studio-verhuur.tk/user/login/', {data: data['data']}, function(result) {

					// parsen van JSON data
					const data = JSON.parse(result);

					// wanneer data gelijk is aan success laat je zien dat er wordt ingelogd en verwijs je na 2s naar home, anders toon je de error
					if(data == 'success'){
						showError('Logging in...', '#3BBA9C');

						setTimeout(function(){
								window.location.href = 'https://studio-verhuur.tk/home/index';
						}, 2000);

					}else{
						showError(data, '#a03c3c');
					}
				});
			}

			// wanneer de form functie op register staat word de ajax call gemaakt om een nieuwe gebruiker aan te maken in de database
			// hierna word een melding weergegeven dat het is gelukt
			else if(data['function'] == 'register'){
				$.post('https://studio-verhuur.tk/user/newuser/', {data: data['data']}, function(result) {
					showError('Account created! Logging in...', '#3BBA9C');

					setTimeout(function(){
							window.location.href = 'https://studio-verhuur.tk/home/index';
					}, 2000);					
				});
			}
		// wanneer de success key false is worden de errors weergegeven dmv de showError functie
		}else{
			showError(data, '#a03c3c');
		}

	});
});

// wanneer je op login/register klikt
$(".select h3").on("click", function(){

	// als de geklikte text nog niet actief is
	if(!$(this).hasClass('active-login')){

		// verwijdert de active class van de andere text
		$(".active-login").toggleClass('active-login');

		// voegt de class toe aan de geklikte text
		$(this).toggleClass('active-login');

		// wanneer de waarde van de geklikte text gelijk is aan LOGIN
		if($(this).text() == "LOGIN"){

			// verandert het welkomst bericht
			$(".welcome-text").text("Welcome back");

			// verandert de text van de form button
			$(".loginform button").text("LOGIN");

			// verbergt de name input wanneer je wilt inloggen
			$(".loginform .input-group").first().toggleClass('d-none');

			// zet de form functie op login
			$(".form-function").val("login");

		// bovenstaande maar dan voor register
		}else{
			$(".welcome-text").text("Nice to meet you");
			$(".loginform button").text("REGISTER");
			$(".loginform .input-group").first().toggleClass('d-none');
			$(".form-function").val("register");
		}
	}
});

function showError(msg, color){

	// wanneer de msg parameter een object is, loop deze en toon per index een error, anders append je 1 error dmv de string text.
	if(typeof(msg) == 'object'){

		// wanneer er nog geen errors op het scherm worden getoond, append deze errors aan de error wrapper in de form modal.
		if($('.error').length < msg.length){
			for(i=0;i<msg.length;i++){
				$('.errorwrapper').append(`
					<div class='error animate__animated animate__headShake my-3' style='background-color:${color}'>${msg[i]}</div>
				`);				
			}		
		}
	}else{
		$('.errorwrapper').append(`
			<div class='error my-3' style='background-color:${color}'>${msg} </div>
		`);	

		if(msg == 'Logging in...'){
			$('.error').append(`<i class="fas fa-cog spin"></i>`);
		}
	}

	// verwijderd de headshake class na 1500ms op ruimte te maken voor de fade out class
	setTimeout(function(){
		$('.error').removeClass('animate__headShake').addClass('animate__fadeOut');
	}, 1500);

	// verwijderd de error message(s) uit de DOM
	setTimeout(function(){
		$('.error').remove();
	}, 2500);
}
$(".select h3").on("click", function(){
	if(!$(this).hasClass('active-login')){
		$(".active-login").toggleClass('active-login');
		$(this).toggleClass('active-login');

		if($(this).text() == "LOGIN"){
			$(".welcome-text").text("Welcome back");
			$(".loginform button").text("LOGIN");
			$(".loginform .input-group").first().toggleClass('d-none');
			$(".form-function").val("login");
			$('.error-field').css('height', '0em');
		}else{
			$(".welcome-text").text("Nice to meet you");
			$(".loginform button").text("REGISTER");
			$(".loginform .input-group").first().toggleClass('d-none');
			$(".form-function").val("check");
			$('.error-field').css('height', '0em');
		}
	}
});

$('.booknow').on('click', function(){
	$('input[name=login]').val() == 'false' ? $('.login').modal('show') : window.location.href = 'home/reservations';
});

$('.closemodal').on('click', function(){
	$(this).closest('.modal').modal('hide');
	$('.modal-backdrop').remove();
});
$('.booknow').on('click', function(){

    $.post('https://studio-verhuur.tk/session/jsonSession', {}, function(result) {

		const data = JSON.parse(result);

        if (data['login'] !== true) {
            $('.login').modal('show')
        }else {
            window.location.href=('https://studio-verhuur.tk/home/reservations');
        }
    });
});

$('.header-login').on('click', function(){
	$(this).text() == 'Login' ? $('.login').modal('show') : '' ;
});

$('.reservations').on('click', function(){
	window.location.href = 'https://studio-verhuur.tk/home/reservations';
});

$('.closemodal').on('click', function(){
    $(this).closest('.modal').modal('hide');
    $('.modal-backdrop').remove();
});
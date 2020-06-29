$('.booknow').on('click', function(){

    var data_id = $(this).data('id');

    $.post('https://studio-verhuur.tk/session/jsonSession', {}, function(result) {

		const data = JSON.parse(result);

        if (data['login'] !== true) {
            $('.login').modal('show');
        }else {
            $('.resform select[name="studio"]').val(data_id);
            $('.resform').modal('show');
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
$('.logout').on('click', function(){
	$.post('https://studio-verhuur.tk/user/logout', {}, function() {
		window.location.href = 'https://studio-verhuur.tk/home/index';
	});		
});

$('.delete-user').on('click', function(){
	$('.delete').modal('show');
});

$('.delete button').on('click', function(){
	if($(this).text() == 'Yes'){
		$.post('https://studio-verhuur.tk/user/delete/' + $('.delete-user').attr("data-id"), {}, function() {
			window.location.href = 'https://studio-verhuur.tk/home/index';
		});
	}else{
		$('.delete').modal('hide');
	}
});
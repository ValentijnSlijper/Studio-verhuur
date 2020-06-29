$('.logout').on('click', function(){
	$.post('https://studio-verhuur.tk/user/logout', {}, function() {
		window.location.href = 'https://studio-verhuur.tk/home/index';
	});		
});

$('.delete-user').on('click', function(){
	$('.deleteuser').modal('show');
});

$('.deleteuser button').on('click', function(){

	console.log($(this).text());

	if($(this).text() == 'Yes'){
		$.post('https://studio-verhuur.tk/user/delete/' + $('.delete-user').attr("data-id"), {}, function() {
			window.location.href = 'https://studio-verhuur.tk/home/index';
		});
	}else{
		$('.deleteuser').modal('hide');
	}
});

$('.update-user').on('click', function(){
	$('.updateuser').modal('show');
});

$('.updateuserform').on('submit', function(e){
	e.preventDefault();

	
});
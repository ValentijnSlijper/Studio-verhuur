<div class="sv-container profile-container py-3">
	
	<i class="far fa-user-circle sv-color-mint mb-3"></i>

	<h3 class='sv-text-bold sv-color-dark'>HELLO</h3>
	<p class='sv-text-light sv-color-dark'><?=$user['name']?></p>

	<div class="row">
		<button class="sv-button mx-2 col-lg-2 col-sm-12 ">Reservations</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 update-user">Update Profile</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 delete-user">Delete Profile</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 logout">Log Out</button>
	</div>
</div>

<script type="text/javascript">
	$('.logout').on('click', function(){
		$.post('https://studio-verhuur.tk/user/logout', {}, function() {
			window.location.href = 'https://studio-verhuur.tk/home/index';
		});		
	});

</script>
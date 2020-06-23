<div class="sv-container profile-container py-3">
	
	<i class="far fa-user-circle sv-color-mint mb-3 big-icon"></i>

	<h3 class='sv-text-bold sv-color-dark'>HELLO</h3>
	<p class='sv-text-light sv-color-dark'><?=$user['name']?></p>

	<div class="row">
		<button class="sv-button mx-2 col-lg-2 col-sm-12 reservations">Reservations</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 update-user">Update Profile</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 delete-user" data-id='<?=$user['id']?>'>Delete Profile</button>
		<button class="sv-button mx-2 col-lg-2 col-sm-12 logout">Log Out</button>
	</div>
</div>

<script type="text/javascript" src="<?=URL?>js/user.js"></script>
<div class="sv-container row animate__animated animate__fadeIn">

	<img src='<?= URL . $studio['img'] ?>' class='col-8 p-0 h-100 clippath-right'>

	<a href="<?=URL?>Home/studios">
		<div class="circle text-center">
			<p class="back">X</p>
		</div>
	</a>

	<div class="col-4 pt-5 text-center">
		<h2 class='text-center sv-color-mint mb-3'><?=$studio['name']?></h2>

		<h5 class='m-0'>Place</h5>
		<p class='sv-color-dark sv-font-light'><?= $studio['place'] ?></p>

		<h5 class='m-0'>Price / hour</h5>
		<p class='sv-color-dark sv-font-light'><?= $studio['price'] ?></p>

		<h5 class='m-0'>Maximum users</h5>
		<p class='sv-color-dark sv-font-light'><?= $studio['maxusers'] ?></p>

		<p class='sv-color-lightest sv-text-light'>A colorfull studio filled with the newest modern equipment. Ready to produce any mainstage track!</p>

		<button class="sv-button mt-1 booknow">Book now!</button>
	</div>

</div>
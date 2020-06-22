<?php var_dump($reservation) ?>

<div class="sv-container row animate__animated animate__fadeIn">

	<img src='<?= URL . $reservation['studioimg'] ?>' class='col-8 p-0 clippath-right'>

	<a href="<?=URL?>Home/reservations">
		<div class="circle text-center">
			<p class="back">X</p>
		</div>
	</a>

	<div class="col-4 pt-5 text-center mb-5">
		<h2 class='text-center sv-color-mint mb-3'><?=$reservation['studio']?></h2>

	<div class="row">
			<div class="col-6">
				<h5 class='m-0'>Name</h5>
				<p class='sv-color-lightest sv-font-light'><?= $reservation['user'] ?></p>
				<h5 class='m-0'>Total Price</h5>
				<p class='sv-color-lightest sv-font-light'>€<?= $reservation['price'] ?></p>
			</div>

		<div class="col-6">
			<h5 class='m-0'>Start Time</h5>
			<p class='sv-color-lightest sv-font-light'><?= $reservation['starttime'] ?></p>
			<h5 class='m-0'>End Time</h5>
			<p class='sv-color-lightest sv-font-light'><?= $reservation['endtime'] ?></p>
		</div>
	</div>

	<h5 class='m-0'>Instruments</h5>
	<img src="<?= URL . $reservation['instrumentimg'] ?>" alt='instrumentimg' class='instrumentimg my-3'>
	<p class='sv-color-lightest sv-font-light'><?= $reservation['instrument'] ?></p>

	<p>	&#9702; </p>

	<p class='sv-color-lightest sv-text-light'><?= $reservation['description'] ?></p>


		<div class="row mt-4">
			<div class="col-6">
			<button class="sv-button w-75 mt-1" data-target="#update" data-toggle="modal">Update</button>
			</div>
			<div class="col-6">
			<a href="<?php echo URL ?>reservation/destroy/<?php echo $reservation["id"] ?>"<button class="sv-button w-75 mt-1">Delete</button></a>
			</div>
		</div>

	</div>

</div>

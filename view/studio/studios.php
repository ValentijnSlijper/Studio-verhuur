<div class="cardwrapper pt-5 pb-5">

	<?php 

	foreach($studios as $key=>$value): 

	$id = $value['id'];
	$name = $value['name'];
	$img = $value['img'];
	$place = $value['place'];
	$price = $value['price'];
	$maxusers = $value['maxusers'];

	?>


	<div class='sv-card text-center m-3 animate__animated animate__fadeIn'>
		<h5 class='text-center sv-color-mint mb-5'><?= $name ?></h5>
		<img src='<?= URL . $img ?>' class='w-75 mb-2'>

		<h5 class='m-0'>Place</h5>
		<p class='sv-color-dark sv-font-light'><?= $place ?></p>

		<h5 class='m-0'>Price / hour</h5>
		<p class='sv-color-dark sv-font-light'><?= $price ?></p>

		<h5 class='m-0'>Maximum users</h5>
		<p class='sv-color-dark sv-font-light'><?= $maxusers ?></p>

		<a href="<?=URL?>studio/detail/<?=$id?>"><i class="fas fa-search mb-2 mt-2"></i></a>
	</div>

	<?php endforeach; ?>

</div>
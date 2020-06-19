<?php var_dump($reservations) ?>

<div class="sv-container">
	<table class="table">
		<thead>
			<tr>
				<th scope="col" class="sv-color-mint">Studio</th>
				<th scope="col" class="sv-color-mint">User</th>
				<th scope="col" class="sv-color-mint">Price</th>
				<th scope="col" class="sv-color-mint">Start Time</th>
				<th scope="col" class="sv-color-mint">End Time</th>
				<th scope="col" class="sv-color-mint">Details</th>
			</tr>
		</thead>

		<tbody>

			<?php
				foreach($reservations as $key=>$value):

				$id = $value['id'];
				$studio = $value['studio'];
				$user = $value['user'];
				$price = $value['price'];
				$starttime = $value['starttime'];
				$endtime = $value['endtime'];
				$description = $value['description'];

			?>

				<tr>
					<td><?=$studio?></td>
					<td><?=$user?></td>
					<td><?=$price?></td>
					<td><?=$starttime?></td>
					<td><?=$endtime?></td>
					<td><a href="<?=URL?>reservation/detail/<?=$id?>"><i class="fas fa-search mb-2 mt-2"></i></a></td>
				</tr>

			<?php endforeach; ?>


		</tbody>
	</table>
</div>

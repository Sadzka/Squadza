<html lang="en">

<head>
	<title>Arikazike</title>
	<link rel="stylesheet" href="public/css/items.css">
</head>

<body>

	<div class="itemtooltip">
		<p class="iconlarge">
			<img src="public/img/icons/itemborder.png" />
			<img class="itemicon" src="public/img/icons/inv_axe_113.jpg" />
		</p>
				
		<table class="tooltip">
		<th>
			<div class="item">
				<span class="q<?= $item->getQuality() ?> name"> <?= $item->getName() ?> </span> <br>
				
				<span class="ilvl">Item Level <span id="ilvlvalue"> <?= $item->getItemLevel() ?> </span></span> <br>
				<span id="boe"><?= ($item->isBindOnPickUp() ? 'Binds when pick up' : 'Binds on equip') ?> </span> <br>
				<?= $item->isUnique() ? '<span id="Unique">Unique</span> <br>' : '' ?>
				<span id="eqtype"> <?= $item->getEquipType()?></span>
				<span id="ittype" class="alignright"> <?= $item->getSlot() != '' ? $item->getSlot() : '' ?> </span> <br>

				<?php
					$damage = $item->getDamage();
					if ($damage != null) {
						echo '<span id="damage">' . $damage[0] . '-' . $damage[1] . ' Damage</span>';
						if ($item->getSpeed() != null){
							echo '<span id="speed" class="alignright">' . $item->getSpeed() . ' Speed</span> <br>';
							
							
							echo '<span id="dps">('
							. round(($damage[0] + $damage[1])/(2*$item->getSpeed()), 2)
							. ' Damage per second)</span> <br>';
						}
						else echo '<br>';
					}
				?>

				<?php
					foreach( $item->getStats() as $stat) {
						if (strtolower($stat['stat']) == 'stamina'
						||  strtolower($stat['stat']) == 'strength'
						||  strtolower($stat['stat']) == 'intelect'
						||  strtolower($stat['stat']) == 'agility'
						||  strtolower($stat['stat']) == 'spirit') {
							echo '<span> +' . $stat['value'] . ' ' . $stat['stat'] . '</span> <br>';
						}
						else {
							echo '<span class="q2"> +' . $stat['value'] . ' ' . $stat['stat'] . '</span> <br>';
						}
					}
				
				/*
				<span> +70 Strength </span> <br>
				<span> +70 Stamina </span> <br>
				<span class="q2"> +70 Crit </span> <br>
				<span class="q2"> +70 Haste </span> <br>
				*/
				?>
				<div class="sockets">
				<?php
					echo '<br>';

					if ($item->getSockets() != null ) {
						foreach($item->getSockets() as $socket) {
							echo '<p class="socket q1 s-' . $socket . '"></p>';
						}
						$x = $item->getSocketBonus();
						echo '<span class="q1"> Socket Bonus: +' . $x['value'] . ' ' . $x['stat'] . '</span>';
						echo '<br>';
					}
				?>
				</div>
				
				
				<span><?= $item->getRequiredLevel() == 0 ? '' : 'Required Level ' . $item->getRequiredLevel() ?> </span> <br>
				
				<div class="moneys">
					<?php
						$price = $item->getSellPrice();
						if ($price > 0 ) {
							echo 'Sell Price: ';

							if ( intval($price/10000) % 100 != 0)
								echo round($price/10000 % 100) . '<p class="money m-gold" />';

							if ( intval($price/100) % 100 != 0)
								echo round($price/100 % 100) . '<p class="money m-silver" />';

							if ($price % 100 != 0)
								echo round($price % 100) . '<p class="money m-copper" />';

						}
					?>
				</div>
				
				<th class="top-right" />
				
				<tr>
					<th class="bottom-left"></th>
					<th class="bottom-right"></th>
				</tr>
				
				<!-- <th style="background-position: top right;"></th> -->
				<!-- <tr><th style="background-position: bottom left"></th><th style="background-position: bottom right"></th></tr>  -->
				
			</div>
		</th>
		</table>
	</div>

</body>
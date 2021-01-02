<html lang="en">

<head>
	<title>Arikazike</title>
	<link rel="stylesheet" href="public/css/items.css">
	<link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>

	<?php
		include_once(__DIR__ . "/../../src/common/header.php");
		include_once(__DIR__ . "/../../src/common/menu.php");
	?>

	<div class="search-item-tooltip-container">

	<?php include_once(__DIR__ . "/../../src/common/searchItem.php"); ?>

	<?php
		if (!isset($_GET['search']))
		{
			if (isset($item)) {
				if ($item != 'notfound') {
					include_once (__DIR__ . '/../../src/common/renderItem.php');
				}
			}
		}
	?>
	
	</div>

	<?php

	if (isset($items) && $items != 'notfound') {

		echo '<div class="search-result-container">';

		$i = 0;
		foreach ($items as $item) {
			if ($i % 2)
				$result = '<div class="search-result-item result-odd"><a href="item?id=:param1"><span class="q:param2">:param3</span></a></div>';
			else
				$result = '<div class="search-result-item result-even"><a href="item?id=:param1"><span class="q:param2">:param3</span></a></div>';
			 

			$result = str_replace(":param1", $item['items_id'], $result);
			$result = str_replace(":param2", $item['quality'], $result);
			$result = str_replace(":param3", $item['name'], $result);

			echo ($result);
			$i++;
		}

		echo '</div>';
	}

	?>
</body>
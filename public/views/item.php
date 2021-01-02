<html lang="en">

<head>
	<title>Arikazike</title>
	<link rel="stylesheet" href="public/css/items.css">
	<link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>

	<?php

		if (isset($item)) {
			if ($item == 'notfound') {
				echo "Item not found xx <br>";
			}
			else {
				include_once (__DIR__ . '/../../src/common/renderItem.php');
			}
		}
		else {
			echo "Search item <br>";
		}
	?>
	
	


</body>
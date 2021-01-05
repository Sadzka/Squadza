<html lang="en">

<head>
	<title>Arikazike</title>
	<link rel="stylesheet" href="public/css/items.css">
	<link type="text/css" rel="stylesheet" href="public/css/main.css">

	<script type="text/javascript" src="./public/js/search.js" defer></script>
</head>

<body>

	<?php
		include_once(__DIR__ . "/../../src/common/header.php");
		include_once(__DIR__ . "/../../src/common/menu.php");
	?>

	<div class="search-item-tooltip-container">
		<?php include_once(__DIR__ . "/../../src/common/searchItem.php"); ?>
		<div class="itemtooltip">
		</div>
	</div>

	<div class="search-result-container" id="search-result-container">
		<table>
			<tr>
				<th><span>Name</span></th>
				<th>Item Level</th> 
				<th>Required Level</th> 
				<th>Slot</th>
				<th>Type</th>
			</tr>
		</table>
	</div>

	<div class="search-result-container" id="comments-container">
		<table>
			<tr>
				<td class="vote-column">
					<p class="vote" title="This comment is helpful."> ▲ </p>
					<p class="score"> 123 </p>
					<p class="vote" title="This comment is not helpful."> ▼ </p>
				</td>
				<td class="comment-content">
					<div class="comment-header">By {user} on {date}</div>
					<div class="comment-text">Comment Content</div>
					<div class="comment-edit"><span class="q1">Last Edited: {date} </span></div>
				</td>
			</tr>
		</table>
	</div>
	
</body>


<template id="item-template">
	<tr>
		<th id="iname">
			<a href="#" class="itemref">
				<span>
					Name
				</span>
			</a>
			<a href="#" class="itemref-new">
				<img class="item-ext-link" src="public/img/interface/external-link.png">
			</a>
		</th>

		<th id="ilv">Item Level</th> 
		<th id="rlv">Required Level</th> 
		<th id="slot">Slot</th>
		<th id="type">Type</th>
	</tr>
</template>

<template id="comment-template">
	<tr>
	<td class="vote-column">
		<p class="vote" title="This comment is helpful."> ▲ </p>
		<p class="score"> 123 </p>
		<p class="vote" title="This comment is not helpful."> ▼ </p>
	</td>
	<td class="comment-content">
		<div class="comment-header">By {user} on {date}</div>
		<div class="comment-text">Comment Content</div>
		<div class="comment-edit"><span class="q1">Last Edited: {date} </span></div>
	</td>
</tr>
</template>
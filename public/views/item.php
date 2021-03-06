<html lang="en">

<head>
	<title>Arikazike</title>
	<link type="text/css" rel="stylesheet" href="public/css/items.css">
	<link type="text/css" rel="stylesheet" href="public/css/main.css">

	<script type="text/javascript" src="./public/js/search.js" defer></script>
	<script type="text/javascript" src="./public/js/statistics.js" defer></script>
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
		<div class="inline-flex">
			<h2 class="">Comments</h2>
			<a href="#comment">
				<div class="add-comment">
					<?= $this->currentUser != null ? 'Post a comment' : 'Log in to post a comment.' ?>
				
				</div>
			</a>
		</div>

		<table>
			
		</table>

		<?php if($this->currentUser != null) : ?>

			<a name="comment"></a>
			<div class="comment-edit-body" id="comments">
				<h2>Post a comment</h2>
				<textarea rows="10" class="comment-editbox" name="body-comment" maxlength="1024"></textarea>
				<div class="char-remains">Up to 1024 characters. 1024 characters remaining.</div>
				<input type="submit" value="Submit" class="button comment-button">
			</div>

		<?php endif; ?>

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
	<td class="vote-column" id="comment_id">
		<p class="vote voteup" title="This comment is helpful."> ▲ </p>
		<p class="score"> 0 </p>
		<p class="vote votedown" title="This comment is not helpful."> ▼ </p>
	</td>
	<td class="comment-content">
		<div class="comment-header">By {user} on {date}</div>		
		<div class="comment-delete">Delete</div>
		<div class="comment-text">Comment Content</div>
		<div class="comment-edit"><span class="q1">Last Edited: {date} </span></div>
	</td>
</tr>
</template>
<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>	
		
	<header>
		<embed class="logoheader" src="public/img/Squadza.svg"/>
		<input class="searchheader" name="search">
		<a class="buttonheader" href="login"> SIGN UP </a>
		<a class="buttonheader" href="login"> LOGI IN </a>
	</header>

	<h1>AVATAR</h1>
	<?php
		echo isset($messages);
			if(isset($messages)){
				foreach($messages as $message) {
					echo $message;
				}
			}
		?>
	<form action="#" method="POST" ENCTYPE="multipart/form-data">
		<input type="file" name="file"> <br/>
		<button type="submit">UPLOAD</button>
	
	</form>
	
	<div class="content"> 
	</div>
</body>
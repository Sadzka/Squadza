<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>
    <div class="container">
        <embed id="logo"     src="public/img/Squadza.svg"/>
		
        <form class="login-form" action="login" method="POST">
			<input class="input-text" type="text"     name="email"    placeholder="email">
			<input class="input-text" type="password" name="password" placeholder="passsword" autocomplete="off">

			<input class="button" type="submit" value="LOGIN" name="Login">
        </form>
		
		<div class="messages">
		<?php
		echo isset($messages);
			if(isset($messages)){
				foreach($messages as $message) {
					echo $message;
				}
			}
		?>
		</div>
        <hr>
        <span class="help-text"> <a href="register">Register account.</a> </span>
        <span class="help-text"> <a href="#">Can't log in?</a> </span>

    </div>
</body>
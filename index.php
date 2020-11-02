<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="container">
        <embed id="logo"     src="img/Squadza.svg"/>
        <form class="login-form" action="login.php" method="POST">

                    <input class="input-text" type="text"     name="email"    placeholder="email">
                    <input class="input-text" type="password" name="password" placeholder="passsword" autocomplete="off">

                    <input class="button" type="submit" value="LOGIN" name="Login"></p>
                    <input type="hidden" name="user_token" value="<?php echo $CSRF_TOKEN; ?>">  
        </form>
        <hr>
        <span class="help-text"> <a href="TODO.php">Register account.</a> </span>
        <span class="help-text"> <a href="TODO.php">Can't log in?</a> </span>

    </div>
</body>
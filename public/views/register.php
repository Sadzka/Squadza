<!DOCTYPE HTML>
<head>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
</head>

<body>
    <div class="container">
        <embed id="logo"     src="public/img/Squadza.svg"/>
        <form class="login-form" action="login.php" method="POST">

                    <input class="input-text" type="text"     name="email"     placeholder="email">
                    <input class="input-text" type="text"     name="username"  placeholder="username">
                    <input class="input-text" type="password" name="password"  placeholder="passsword" autocomplete="off">
                    <input class="input-text" type="password" name="passwordC" placeholder="confirm passsword" autocomplete="off">

                    <input class="button" type="submit" value="REGISTER" name="Register"></p>
                    <input type="hidden" name="user_token" value="<?php echo $CSRF_TOKEN; ?>">  
        </form>
        <hr>
        <span class="help-text"> <a href="login">Have account? Login instead.</a> </span>

    </div>
</body>
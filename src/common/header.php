<header>
    <embed class="logoheader" src="public/img/Squadza.svg"/>
    <input class="searchheader" name="search" placeholder="Search player or guild..." >
    <div class="buttons-space-header">

        <!-- Icons made by Freepik from https://www.flaticon.com/ -->
        <div class="media-header"> 
            <a href=""> <img class="media-icon" src="public/img/media/discord.png" /> </a>
            <a href="#"> <img class="media-icon" src="public/img/media/twitter.png" /> </a>
            <a href="#"> <img class="media-icon" src="public/img/media/facebook.png" /> </a>
            <a href="#"> <img class="media-icon" src="public/img/interface/notification.png" /> </a>
            <img class="media-icon" id="icon-menu" src="public/img/interface/menu.png" />
        </div>
        <?php

        //TODO
        $logged = true	;
        $user = "ExampleUser";
        //

        if(!$logged) {
            echo 
            '<div class="button-header"> <a class="button-header-a" href="login"> SIGN UP </a> </div>
            <div class="button-header"> <a class="button-header-a" href="login"> LOGI IN </a> </div>';
        }
        else {
            echo
            '<div class="profile-header">
            <img class="header-profile-avatar" src="public/uploads/avatars/default.png">' . $user . '<a href=#>
            <img class="arrow-down-sign-to-navigate" src="public/img/interface/arrow-down-sign-to-navigate.png" /> 
            </a>
            </div>' ;
        }
        ?>

    </div>
</header>
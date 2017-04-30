<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        echo "Please login";
        return;
    }

    include("./templates/header.php");
    include("./templates/navbar.php");
    include("./user/sidebar.php");

    switch($_GET['main'])
    {
        case "playlist":
            if(isset($_GET['media_id']))
            {
                include("./user/add_media.php");
            }
            else
            {
                include("./user/playlist.php");
            }
            break;
        case "subscription":
            include("./user/subscription.php");
            break;
        case "uploaded":
            include("./user/uploaded.php");
            break;
        case "liked":
            include("./user/liked.php");
            break;
        case "disliked":
            include("./user/disliked.php");
            break;
        case "profile":
            include("./user/profile.php");
            break;
        case "contact":
            include("./user/contact.php");
            break;
        case "upload":
            include("./user/upload.php");
            break;
        case "message":
            include("./user/message.php");
            break;
        case "group":
            include("./user/group.php");
            break;
        case "history":
            include("./user/history.php");
            break;
        case "downloaded":
            include("./user/downloaded.php");
            break;
        case "group":
            include("./user/group.php");
            break;
    }
?>

<?php

include_once("db_conn.php");

function add_downloaded($user_id, $media_id)
{
    $sql = "INSERT
            INTO download 
            (user_id, media_id) 
            VALUES 
            ('$user_id', '$media_id')";

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>

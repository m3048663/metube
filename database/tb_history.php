<?php

include_once("db_conn.php");

function add_viewed($user_id, $media_id)
{
    $sql = "INSERT
            INTO history 
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

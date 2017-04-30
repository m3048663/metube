<?php

include_once("db_conn.php");

function add_liked($user_id, $media_id)
{
    $sql = "INSERT
            INTO liked 
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

function is_liked($user_id, $media_id)
{
    $sql = "SELECT *
            FROM liked 
            WHERE user_id=$user_id AND
            media_id=$media_id";    

    $result = db_query($sql);

    if(mysqli_num_rows($result) == 0)
    {
        return false; 
    }
    
    return true;
}

?>

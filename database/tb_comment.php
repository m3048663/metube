<?php

include_once("db_conn.php");

function add_comment($infos)
{
    if(count($infos) != 3)
    {
        return -1;
    }

    $sql = "INSERT
            INTO comments 
            (media_id, user_id, content) 
            VALUES 
            ('$infos[media_id]', '$infos[user_id]','$infos[content]')";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_comments($media_id)
{
    $sql = "SELECT *
            FROM comments 
            WHERE media_id=$media_id";    

    $rows= db_select($sql);
    if($rows== false)
    {
        return false;
    }
    else
    {
       return $rows;  
    }
}

?>

<?php

include_once("db_conn.php");

function add_playlist($infos)
{
    if(count($infos) != 2)
    {
        return false;
    }

    $sql = "INSERT
            INTO playlist 
            (user_id, playlist_name) 
            VALUES 
            ('$infos[user_id]', '$infos[playlist_name]')";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function del_playlist($infos)
{
    if(count($infos) != 2)
    {
        return false;
    }

    $sql = "DELETE
            FROM playlist 
            WHERE 
            user_id=$infos[user_id] and  playlist_name='$infos[playlist_name]'";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_playlist($playlist_id)
{
    $sql = "SELECT *
            FROM playlist 
            WHERE playlist_id=$playlist_id";    

    $rows= db_select($sql);
    if($rows == false)
    {
        return false;
    }
    else
    {
       return $rows[0];  
    }
}

function get_playlists($user_id)
{
    $sql = "SELECT *
            FROM playlist 
            WHERE user_id=$user_id";    

    $rows= db_select($sql);
    if($rows == false)
    {
        return false;
    }
    else
    {
       return $rows;  
    }
}

function delete_media_in_playlist($playlist_id, $field)
{
    $sql = "UPDATE playlist 
            SET $field='0'
            WHERE 
            playlist_id='$playlist_id'";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function add_media_to_playlist($playlist_id, $media_id)
{
    $playlist = get_playlist($playlist_id);
    if(!$playlist)
    {   
        return false;
    }

    if( $playlist["media_id1"] == $media_id or
        $playlist["media_id2"] == $media_id or
        $playlist["media_id3"] == $media_id or
        $playlist["media_id4"] == $media_id or
        $playlist["media_id5"] == $media_id
    )
    {
        return false;
    }

    $field = "";
    if(!$playlist['media_id1'])
    {
        $field = 'media_id1';
    }
    if(!$playlist['media_id2'])
    {
        $field = 'media_id2';
    }
    if(!$playlist['media_id3'])
    {
        $field = 'media_id3';
    }
    if(!$playlist['media_id4'])
    {
        $field = 'media_id4';
    }
    if(!$playlist['media_id5'])
    {
        $field = 'media_id5';
    }
    if(!$field)
    {
        return false;
    }

    $sql = "UPDATE playlist 
            SET $field='$media_id'
            WHERE 
            playlist_id='$playlist_id'";
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

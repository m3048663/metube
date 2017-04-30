<?php

include_once("db_conn.php");

function add_media($infos)
{
    $sql = "INSERT INTO 
            media (media_name, description, size, category, user_id, share, keyword) 
            VALUES 
            ('$infos[media_name]','$infos[description]', '$infos[size]', '$infos[category]','$infos[user_id]', '$infos[share]', '$infos[keyword]')";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_history($user_id)
{
    $sql = "SELECT *
            FROM media
            WHERE media_id IN (
                SELECT media_id
                FROM history 
                WHERE user_id=$user_id
            
            )";    

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

function get_downloaded($user_id)
{
    $sql = "SELECT *
            FROM media
            WHERE media_id IN (
                SELECT media_id
                FROM download 
                WHERE user_id=$user_id)";    

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

function get_medias($order)
{
    $sql = "SELECT *
            FROM media
            WHERE share='public' 
            ORDER BY $order desc";    

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

function get_disliked($user_id)
{
    $sql = "SELECT *
            FROM media
            WHERE media_id IN (
                SELECT media_id
                FROM disliked
                WHERE user_id=$user_id)";    

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


function get_liked($user_id)
{
    $sql = "SELECT *
            FROM media
            WHERE media_id IN (
                SELECT media_id
                FROM liked
                WHERE user_id=$user_id)";    

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

function get_uploaded($user_id)
{
    $sql = "SELECT *
            FROM media
            WHERE user_id=$user_id";    

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

function get_recent()
{
    $sql = "SELECT *
            FROM media
            WHERE share='public' 
            ORDER BY upload_time desc
            LIMIT 4";    

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

function get_recommended()
{
    $sql = "SELECT *
            FROM media
            WHERE share='public' 
            ORDER BY like_times desc
            LIMIT 4";    

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

function get_popular()
{
    $sql = "SELECT *
            FROM media
            WHERE share='public' 
            ORDER BY viewed_times desc
            LIMIT 4";    

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

function get_media_by_category($category)
{
    $sql = "SELECT *
            FROM media
            WHERE category=$category AND
            share='public'";    

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

function get_media_by_keyword($keyword)
{
    $sql = "SELECT *
            FROM media
            WHERE keyword='$keyword' AND
            share = 'public'";    

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

function get_media_by_id($media_id)
{
    $sql = "SELECT *
            FROM media
            WHERE media_id=$media_id";    

    $rows= db_select($sql);
    if($rows== false)
    {
        return false;
    }
    else
    {
       return $rows[0];  
    }
}

function increase_like($media_id)
{
    $sql = "UPDATE media
            SET like_times = like_times+1 
            WHERE media_id=$media_id";    

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function increase_dislike($media_id)
{
    $sql = "UPDATE media
            SET dislike_times = dislike_times+1 
            WHERE media_id='$media_id'";    

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function increase_viewed($media_id)
{
    $sql = "UPDATE media
            SET viewed_times = viewed_times+1 
            WHERE media_id=$media_id";    

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function basic_search($search_text)
{
    $sql = "SELECT *
            FROM media
            WHERE media_name 
            RLIKE '.*${search_text}.*' AND 
            share = 'public'"; 

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

function advance_search($args)
{
    if($args['author'])
    {
        $sql = "SELECT *
            FROM media
            WHERE DATEDIFF(CURDATE(), upload_time) < $args[upload_time] AND
            size > $args[min_size] and size < $args[max_size] AND
            user_id=$args[author] AND
            share = 'public'
            "; 
    }
    else
    {
         $sql = "SELECT *
            FROM media
            WHERE DATEDIFF(CURDATE(), upload_time) < $args[upload_time] AND
            size > $args[min_size] and size < $args[max_size]
            ";    
    }

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

function get_keywords_in_media()
{
    $sql = " select keyword from media where 1";

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

<?php

include_once("db_conn.php");

function is_subscription_exist($user_id, $channel_id)
{
    if($user_id == $channel_id)
    {
        return true;
    }

    $sql = "SELECT * 
            FROM subscription
            WHERE user_id='$user_id' AND
            channel_id='$channel_id'";

    echo $sql;
    $result = db_query($sql);

    if(mysqli_num_rows($result) == 0)
    {
        return false; 
    }
    
    return true;
}

function add_subscription($infos)
{
    if(count($infos) != 2)
    {
        return false;
    }
    if(is_subscription_exist($infos['user_id'], $infos['channel_id']))
    {
        return true;
    }

    $sql = "INSERT
            INTO subscription 
            (user_id, channel_id) 
            VALUES 
            ('$infos[user_id]', '$infos[channel_id]')";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function delete_subscription($subscription_id)
{
    $sql = "DELETE
            FROM subscription 
            WHERE subscription_id=$subscription_id";    

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }

}

function get_subscriptions($user_id)
{
    $sql = "SELECT *
            FROM subscription 
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

function get_fans($channel_id)
{
    $sql = "SELECT *
            FROM subscription 
            WHERE channel_id=$channel_id";    

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

<?php

include_once("db_conn.php");

function add_contact($infos)
{
    if(count($infos) != 3)
    {
        return -1;
    }

    $sql = "INSERT
            INTO contacts 
            (user_id, friend_id, group_name) 
            VALUES 
            ('$infos[user_id]', '$infos[friend_id]', '$infos[group_name]')";
    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function get_contacts($user_id)
{
    $sql = "SELECT *
            FROM contacts 
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

function delete_contact($contact_id)
{
    $sql = "DELETE
            FROM contacts
            WHERE contact_id=$contact_id";    

    if(db_query($sql))
    {
        return true;
    }
    else
    {
        return false;
    }

}

function block_contact($contact_id, $is_block)
{
    $sql = "UPDATE contacts
            SET is_block='$is_block' 
            WHERE contact_id=$contact_id";    

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

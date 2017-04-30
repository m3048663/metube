<?php
include_once("./database/tb_user.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $user_name = $_POST['user_name']; 
    $password0 = $_POST['password0']; 
    
    // create accout handling
    if(isset($_POST['signup']))
    {
        $email= $_POST['email']; 
        $password1 = $_POST['password1']; 
        $infos = [ 
            "user_name" => $user_name,
            "password"  => $password0,
            "email"     => $email
        ];

        if($user_id=add_user($infos))
        {
            $_SESSION['user_name'] = $user_name;
            $_SESSION["user_id"] = $user_id;

            //create folder for this user
            $path = '../media/'.$user_id;
            if(!file_exists($path))
            {
                mkdir($path, 0755, true);
            }
        }
        else
        {
           echo "add user failed"; 
        }
    }
    // sign in handling
    else
    {
       if($info = get_user_info($user_name))  
       {
            if($info['password'] == $password0) 
            {
                $_SESSION['user_name'] = $info['user_name'];
                $_SESSION["user_id"] = $info["user_id"];
            }
            else
            {
                echo "password error";
            }
       }
       else
       {
        echo "user name error";
       }
    }
}

header("location: index.php");
exit();
?>



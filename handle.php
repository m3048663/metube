<?php
session_start();

include_once("./database/tb_media.php");
include_once("./database/tb_disliked.php");
include_once("./database/tb_liked.php");
include_once("./database/tb_comment.php");

$response['status']='error'; 
$response['msg']=''; 
header('Content-type: application/json');
if(isset($_SESSION["user_id"]))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user_id = $_SESSION["user_id"];
        $user_name = $_SESSION["user_name"];
        if(isset($_POST['type']))
        {
            $type = $_POST['type'];
            $media_id = $_POST['media_id'];
            switch($type)
            {
                case 'comment':
                    $content= $_POST['content'];
                    $infos = array( 
                        'media_id' => $media_id,
                        'user_id' => $user_id,
                        'content' => $content
                    );
                    if(add_comment($infos))
                    {
                        $response['content']=$content; 
                        $response['user_name']=$user_name; 
                        $response['status']='success'; 
                    }
                    break;
                case 'dislike':
                    if(!is_disliked($user_id, $media_id))
                    {
                        add_disliked($user_id, $media_id);
                        increase_dislike($media_id);
                    }
                    $media = get_media_by_id($media_id);
                    if($media)
                    {
                        $response['status']='success'; 
                        $response['msg']=$media['dislike_times']; 
                    }
                    break;
                case 'like':
                    if(!is_liked($user_id, $media_id))
                    {
                        add_liked($user_id, $media_id);
                        increase_like($media_id);
                    }
                    $media = get_media_by_id($media_id);
                    if($media)
                    {
                        $response['status']='success'; 
                        $response['msg']=$media['like_times']; 
                    }
                    break;
            }
        }
    }
}
echo json_encode($response);
?>

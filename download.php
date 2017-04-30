<?php
session_start();

include("./database/tb_media.php");
include("./database/tb_download.php");

$config = parse_ini_file(__DIR__.'/config.ini');
$media_id = $_GET['media_id'];
$media = get_media_by_id($media_id);
$user_id = $media['user_id'];
$media_name = $media['media_name'];
$file = $config['media_dir_rp'].$user_id . '/' . $media_name;

header ("Content-type: octet/stream");
header ("Content-disposition: attachment; filename=".$file.";");
header("Content-Length: ".filesize($file));
readfile($file);

if(isset($_SESSION['user_id']))
{
   $user_id = $_SESSION['user_id']; 
   echo $user_id;
   add_downloaded($user_id, $media_id);
}

exit;
?>

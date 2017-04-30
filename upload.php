<?php
session_start();

include_once("database/tb_media.php");
include_once("database/tb_subscription.php");
include_once("database/tb_message.php");
include_once("database/tb_contact.php");

$user_id=$_SESSION['user_id'];


function upload_send_message($file_name)
{
    $user_id=$_SESSION['user_id'];
    $fans = get_fans($user_id); 
    if($fans) 
    {
        foreach($fans as $fan)
        {
            $fan_user_id = $fan['user_id'];
            $content = "Hi, there. I post a new media file ".$file_name.", welcome to watch";
            $infos = [
               'from_user_id' => $user_id, 
               'to_user_id' => $fan_user_id, 
               'content' => $content 
            ];
            add_message($infos);
        }
    }
    $friends = get_contacts($user_id); 
    if($friends) 
    {
        foreach($friends as $friend)
        {
            if(!$friend['is_block'])
            {
                $friend_user_id = $friend['friend_id'];
                $content = "Hi, there. I post a new media file ".$file_name.", welcome to watch";
                $infos = [
                    'from_user_id' => $user_id, 
                    'to_user_id' => $friend_user_id, 
                    'content' => $content 
                ];
                add_message($infos);           
            }

        }
    }
}

$uploadOk = 1;
//Create Directory if doesn't exist
$upload_dir = '../media/' . $user_id . '/';
if(!file_exists($upload_dir))
	mkdir($upload_dir, 0757);

if(isset($_FILES['fileToUpload']))
{
    $file_name = basename($_FILES['fileToUpload']['name']);
    $upload_file = $upload_dir. '/' . $file_name;

    // Check file size
    if ($_FILES['fileToUpload']['size'] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_file)) {
        chmod($upload_file, 644);    

        $infos['media_name'] = $file_name;
        $infos['description'] = $_POST['description'];
        $infos['size'] = $_FILES['fileToUpload']['size'];
        $infos['category'] = $_POST['category'];
        $infos['share'] =    $_POST['share_method'];
        $infos['keyword'] = $_POST['keyword'];
        $infos['user_id'] = $user_id;

        if(add_media($infos))
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    
        if($_POST['share_method'] == 'public')
        {
            upload_send_message($file_name);
        }

    }
}
	
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
</head>
<body>
<div class="upload-file">
    <form method="post" action="upload.php" enctype="multipart/form-data" >
        <p style="margin:0; padding:0">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
        Add a Media: <label style="color:#663399"><em> (Each file limit 2M)</em></label><br/>
        <input type="file" id="fileToUpload" name="fileToUpload"  size="50"><br/>
            Title:  <input type="text" name="title" /> <br>

        Keyword: <input type="text" id="keyword" name="keyword" /> <br>

        <input  type="hidden" /> Description:<br>
        <textarea name='description' cols="50" rows="10"> </textarea>

        <p><b> Please choose how to share the file: </b></p>
        <select id="share_method" name="share_method">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <p><b> Please choose category: </b></p>
        <select name="category">
            <option value=1001>Movie</option>
            <option value=1002>Cartoon</option>
            <option value=1003>Sport</option>
            <option value=2001>Song</option>
            <option value=2002>Talkshow</option>
            <option value=3000>Image</option>
        </select>
<input value="Upload" name="submit" type="submit" /><br>
</p>
</form>
</div>

</body>
</html>


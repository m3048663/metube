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
											Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
										<input type="file" id="fileToUpload" name="fileToUpload"  size="50"><br/>
										Title:  <input type="text" name="title" /> <br>
										Keyword: <input type="text" name="keyword" /> <br>
										<input  type="hidden" /> Description:<br>
										<textarea name='description' cols="50" rows="10"> </textarea>
										<p><b> Please choose how to share the file: </b></p>
										<input type="radio" name="share" value="private">Private<br>
										<input type="radio" name="share" value="public">Public<br>																				<input type="radio" name="share" value="friend">Friend<br>
										<p><b> Please choose whether to allow to discuss the file: </b></p>
										<input type="radio" name="discuss" value="allow-discuss">allow discuss<br>
										<p><b> Please choose whether to allow to rate the file: </b></p>
										<input type="radio" name="rate" value="allow-rate">allow rate<br>

                                        <select name="category">
                                            <option value=1001>Movie</option>
                                            <option value=1002>Cartoon</option>
                                            <option value=1003>Sport</option>
                                            <option value=2001>Song</option>
                                            <option value=2002>Talkshow</option>
                                            <option value=3000>Image</option>
										<input value="Upload" name="submit" type="submit" /><br>
								  </p>
							</form>
					</div>

</body>
</html>



<?php
session_start();

include_once("database/tb_media.php");

$user_id=$_SESSION['user_id'];

$uploadOk = 1;
//Create Directory if doesn't exist
$upload_dir = '../media/' . $user_id . '/';
if(!file_exists($upload_dir))
	mkdir($upload_dir, 0757);

if(isset($_FILES['fileToUpload']))
{
    $file_name = basename($_FILES['fileToUpload']['name']);
    $upload_file = $upload_dir. '/' . $file_name;

    // Check if file already exists
    if (file_exists($upload_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES['fileToUpload']['size'] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_file)) {
    
        $infos['media_name'] = $file_name;
        $infos['description'] = $_POST['description'];
        $infos['size'] = $_FILES['fileToUpload']['size'];
        $infos['category'] = $_POST['category'];
        $infos['user_id'] = $user_id;

        if(add_media($infos))
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
	
?>

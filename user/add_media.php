<?php
include_once("./database/tb_playlist.php");

session_start();

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
    $playlists = get_playlists($user_id);

    $options = "";
    if($playlists)
    {
        foreach($playlists as $playlist)
        {
            $options .= "<option value='".$playlist['playlist_id']."'>".$playlist['playlist_name']."</option>";
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $media_id = $_GET['media_id'];
    }
}

?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Add Media</h3>
            </div>

<form "form-horizontal" method="POST" action="user.php?main=playlist">

<input type="hidden" name="addmedia_media_id" value="<?php echo $media_id ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="phone">Choose a Playlist:</label>
    <div class="col-sm-6">
    <select class="form-control" name="addmedia_playlist_id">
        <?php echo $options;  ?>
    </select>

    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

		</div>

		</div>
	</div>

</div>

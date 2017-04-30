<?php
session_start();

include(__DIR__."/../database/tb_playlist.php");
include(__DIR__."/../database/tb_media.php");

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
}

function generate_trs($field, $media_id, $playlist_id)
{
    $media = get_media_by_id($media_id);
    $trs = sprintf("
            <tr class='warning'>
                <td > 
                <a href=play.php?media_id=%s>%s</a>  
                </td>
                <td>
                <a href='user.php?main=playlist&playlist=%s&media=%s' type='button' class='btn btn-danger'>Delete</a>
                </td>
            </tr>   
            ",$media_id, $media['media_name'],$playlist_id, $field
    );

    return $trs;
}

function generate_slider($playlist)
{

    $trs = '';
    $playlist_id = $playlist['playlist_id'];
    if($playlist['media_id1'])
    {
        $trs .= generate_trs('media_id1', $playlist['media_id1'], $playlist_id);
    }
    if($playlist['media_id2'])
    {
        $trs .= generate_trs('media_id2', $playlist['media_id2'], $playlist_id);
    }
    if($playlist['media_id3'])
    {
        $trs .= generate_trs('media_id3', $playlist['media_id3'], $playlist_id);
    }
    if($playlist['media_id4'])
    {
        $trs .= generate_trs('media_id4', $playlist['media_id4'], $playlist_id);
    }
    if($playlist['media_id5'])
    {
        $trs .= generate_trs('media_id5', $playlist['media_id5'], $playlist_id);
    }

    $html = sprintf("
            <div class='container h5'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>%s</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        %s
                     </tbody>
                </table>
                </div>
                       ", $playlist['playlist_name'], $trs); 

    echo $html;
}

function show_playlists()
{

    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
        $playlists = get_playlists($user_id);

        if($playlists)
        {
            foreach($playlists as $playlist)
            {
                generate_slider($playlist);

                echo "<br><hr>";
            }
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if(isset($_POST['create_playlist_name']))
    {
        $infos = [
            'playlist_name' => $_POST['create_playlist_name'], 
            'user_id' => $user_id
        ];

        add_playlist($infos);
    }
    elseif(isset($_POST['delete_playlist_name']))
    {
         $infos = [
            'playlist_name' => $_POST['delete_playlist_name'], 
            'user_id' => $user_id
        ];

        del_playlist($infos);   
    }
    elseif(isset($_POST['addmedia_media_id']))
    {
        $media_id = $_POST['addmedia_media_id'];
        $playlist_id = $_POST['addmedia_playlist_id'];
        add_media_to_playlist($playlist_id, $media_id);
    }
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['playlist']))
    {
        $playlist_id = $_GET['playlist'];
        $field = $_GET['media'];
        delete_media_in_playlist($playlist_id, $field);
    }
}

?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	        <div class="recommended-info">
					<a href="#small-dialog5" class="play-icon popup-with-zoom-anim btn btn-primary" id="create_playlist">Create Playlist</a>
					<a href="#small-dialog6" class="play-icon popup-with-zoom-anim btn btn-danger" id="delete_playlist">Delete Playlist</a>
                <div class="signin">
					<div id="small-dialog5" class="mfp-hide">
						<h3>Create Playlist</h3>
                        <hr>
                            <div class="container">
                                <form method="post" action="user.php?main=playlist" >
                                    <div class="form-group row col-sm-4">
								        <input class="form-control" type="text" name="create_playlist_name" placeholder="Enter Playlist Name" required="required">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary"> SUBMIT</button>
                                        </div>
                                    </div>
							    </form>
                            </div>
					</div>
                    <div id="small-dialog6" class="mfp-hide">
						<h3>Delete Playlist</h3>
                            <div class="container">
                                <form method="post" action="user.php?main=playlist" >
                                    <div class="form-group row col-sm-4">
								        <input class="form-control" type="text" name="delete_playlist_name" placeholder="Enter Playlist Name" required="required">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary"> SUBMIT</button>
                                        </div>
                                    </div>
							    </form>
                            </div>
					</div>
				</div>
<hr>


<?php 


show_playlists();

?>
                    </tbody>
                </table>
                </div>


		</div>
		</div>
	</div>

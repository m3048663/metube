<?php
session_start();

include_once(__DIR__."/database/tb_user.php");
include_once("./database/tb_subscription.php");

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['channel_name']))
        {
            $channel_name = $_GET['channel_name'];
            $channel = get_user_info($channel_name);
            if($channel)
            {
                $infos = [
                    'user_id' => $user_id,
                    'channel_id' => $channel['user_id'],
                ];

                add_subscription($infos);       
            }
        }
    }
}

function generate_slider($user_id, $user_name, $avatar)
{
    $config = parse_ini_file(__DIR__.'/config.ini');
    
    $image_src = $config['media_dir_rp']."/channel.jpg";
    $href = '1';
    $html = sprintf("
	    <div class='col-md-3 resent-grid recommended-grid'>
	        <div class='resent-grid-img recommended-grid-img'>
	            <a href=' %s '><img src=' %s ' /></a>
			    <div class='time small-time'>
                <p>  </p>
			    </div>
		    </div>
		    <div class='resent-grid-info recommended-grid-info video-info-grid'>
            <div class='file'>
                <a href='index.php?main=channels&channel_name=%s '  >Suscribe</a>
            </div>
			    <ul>
				    <li><p class='author author-info'><a href='#' > %s </a></p></li>
				</ul>
			</div>
		</div>
                    
        ", 
        $href, $image_src, $user_name, $user_name  
    );

    echo $html;
}

function channels_layout()
{
    // When user_id equals 0
    // get_user_info return all user info
    $user_id=0;
    $user_infos = get_user_info($user_id);

    // Each row has four items
    $count = 4;
    if($user_infos)
    {
        foreach($user_infos as $user_info)
        {
            generate_slider(
                $user_info['user_id'],
                $user_info['user_name'],
                $user_info['avatar']
            );
            if(!(--$count))
            {
                echo "<hr>";
                $count = 4;
            }
        }
    }
}

?>


<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Channels</h3>
            </div>
            <hr>
            <?php channels_layout() ?>
		</div>
		</div>
	</div>
</div>

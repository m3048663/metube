<?php
session_start();

include_once("./database/tb_user.php");
include_once("./database/tb_media.php");

function generate_slide($media_id, $user_id, $media_name, $datetime, $viewed_times, $category)
{
    $config = parse_ini_file(__DIR__.'/config.ini');
    
    $info = get_user_info($user_id);
    $user_name = $info['user_name']; 
    $image_src = $config['media_dir_rp'].$category . '.jpg';
    $href = 'play.php?media_id=' . $media_id; 
    $html = sprintf("
	    <div class='col-md-3 resent-grid recommended-grid'>
	        <div class='resent-grid-img recommended-grid-img'>
	            <a href=' %s '><img src=' %s '/></a>
			    <div class='time small-time'>
				    <p> %s </p>
			    </div>
		    </div>
		    <div class='resent-grid-info recommended-grid-info video-info-grid'>
			    <h5><a href=' %s ' class='title'> %s  </a></h5>
			    <ul>
				    <li><p class='author author-info'><a href='#' class='author'> %s </a></p></li>
				    <li class='right-list'><p class='views views-info'> %d views</p></li>
				</ul>
			</div>
		</div>
        ", 
        $href, $image_src, $datetime, $href, $media_name, $user_name, $viewed_times 
    );

    echo $html;
}


function show_slides($type, $args=NULL)
{
    $user_id = NULL;
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
    }
        $medias = NULL;

        switch($type)
        {
            // For main page
            case "recent":
                $medias = get_recent();
                break;
            case "recommended":
                $medias = get_recommended();
                break;
            case "popular":
                $medias = get_popular();
                break;
            // For category
            case "category":
                $medias = get_media_by_category($args);
                break;
            // For media order 
            case "media_order":
                $medias = get_medias($args);
                break;
            // For user pages
            case "uploaded":
                $medias = get_uploaded($user_id);
                break;
            case "downloaded":
                $medias = get_downloaded($user_id);
                break;
            case "liked":
                $medias = get_liked($user_id);
                break;
            case "disliked":
                $medias = get_disliked($user_id);
                break;
            case "history":
                $medias = get_history($user_id);
                break;
            // For search
            case "basic_search":
                $medias = basic_search($args);
                break;
            case "advance_search":
                $medias = advance_search($args);
                break;
        }

        // Each row has four items
        $count = 4;
        if($medias)
        {
            foreach($medias as $media)
            {
                generate_slide(
                    $media['media_id'],
                    $media['user_id'],
                    $media['media_name'],
                    $media['upload_time'],
                    $media['viewed_times'],
                    $media['category']
                );
                if(!(--$count))
                {
                    echo "<hr><br>";
                    $count = 4;
                }
            }
        }
}
?>

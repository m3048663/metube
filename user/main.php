<?php
function generate_slider($media_id, $user_id, $media_name, $duration, $viewed_times)
{
    $config = parse_ini_file(__DIR__.'/../config.ini');
    
    $image_src = $config['media_dir_rp'].$user_id . '/' . $media_id . '.jpg';
    $href = $config['media_dir_rp'].$user_id . '/' . $media_id;
    $html = sprintf("
	    <div class=\"col-md-3 resent-grid recommended-grid\">
	        <div class=\"resent-grid-img recommended-grid-img\">
	            <a href=\" %s \"><img src=\" %s \" alt=\"\" /></a>
			    <div class=\"time small-time\">
				    <p> %d </p>
			    </div>
			    <div class=\"clck small-clck\">
			        <span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span>
			    </div>
		    </div>
		    <div class=\"resent-grid-info recommended-grid-info video-info-grid\">
			    <h5><a href=\" %s \" class=\"title\"> %s  </a></h5>
			    <ul>
				    <li><p class=\"author author-info\"><a href=\"#\" class=\"author\">John Maniya</a></p></li>
				    <li class=\"right-list\"><p class=\"views views-info\"> %d views</p></li>
				</ul>
			</div>
		</div>
                    
        ", 
        $href, $image_src, $duration, $href, $media_name, $viewed_times 
    );

    echo $html;
}
?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Recent</h3>
            </div>
<?php


include(__DIR__."/../database/tb_media.php");

$medias = get_recent_media();

foreach($medias as $media)
{
    generate_slider(
        $media['media_id'],
        $media['user_id'],
        $media['media_name'],
        $media['duration'],
        $media['viewed_times']
    
    );
}

?>

			<div class="clearfix"> </div>
		</div>

		<div class="recommended">
		    <div class="recommended-grids">
			    <div class="recommended-info">
			        <h3>Recommended</h3>
				</div>
<?php

$medias = get_recent_media();

foreach($medias as $media)
{
    generate_slider(
        $media['media_id'],
        $media['user_id'],
        $media['media_name'],
        $media['duration'],
        $media['viewed_times']
    
    );
}
?>
		


					<div class="clearfix"> </div>
			</div>
			<div class="recommended-grids">
	
<?php

$medias = get_recent_media();

foreach($medias as $media)
{
    generate_slider(
        $media['media_id'],
        $media['user_id'],
        $media['media_name'],
        $media['duration'],
        $media['viewed_times']
    
    );
}
?>
				<div class="clearfix"> </div>
			</div>
		</div>

		<div class="recommended">
		    <div class="recommended-grids">
			    <div class="recommended-info">
				    <h3>Popular</h3>
				</div>
<?php

$medias = get_recent_media();

foreach($medias as $media)
{
    generate_slider(
        $media['media_id'],
        $media['user_id'],
        $media['media_name'],
        $media['duration'],
        $media['viewed_times']
    
    );
}
?>

				<div class="clearfix"> </div>
			</div>
			<div class="recommended-grids">
	
<?php

$medias = get_recent_media();

foreach($medias as $media)
{
    generate_slider(
        $media['media_id'],
        $media['user_id'],
        $media['media_name'],
        $media['duration'],
        $media['viewed_times']
    
    );
}

?>
		        <div class="clearfix"> </div>
			</div>
		</div>
	</div>

			<!-- footer -->
<?php
    //include("./footer.php");
?>

			<!-- //footer -->
</div>

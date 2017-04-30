<html>
<?php
session_start();

if(isset($_SESSION['user_id']))
{
    $local_user_id = $_SESSION['user_id']; 
}

include ("./templates/header.php");
include ("./templates/navbar.php");
include ("./templates/sidebar.php");
include("./database/tb_comment.php");
include("./database/tb_user.php");
include("./database/tb_media.php");
include("./database/tb_history.php");
include("./database/tb_contact.php");

$config = parse_ini_file(__DIR__.'/config.ini');


function check_is_blocked($user_id, $local_user_id)
{
   $contacts = get_contacts($user_id); 
   if($contacts)
   {
        foreach($contacts as $contact)
        {
            if($contact['friend_id'] == $local_user_id and
                $contact['is_block'] == 1) 
            {
                return true; 
            }
        }
   }

   return false;

}


$media_id = $_GET['media_id'];
$media = get_media_by_id($media_id);
$user_id = $media['user_id'];

if(isset($_SESSION['user_id']))
{
    $local_user_id = $_SESSION['user_id']; 

    if(check_is_blocked($user_id, $local_user_id))
    {
        return;
    }
}
$media_name = $media['media_name'];
$media_description = $media['description'];
$viewed_times = $media['viewed_times']; 
$dislike_times = $media['dislike_times']; 
$like_times = $media['like_times']; 
$upload_time = $media['upload_time']; 
$keyword = $media['keyword']; 
$source_url = $config['media_dir_rp'].$user_id . '/' . $media_name;
$comments = get_comments($media_id);
$comments_count = count($comments);

if (strpos($source_url, 'jpg') !== false) 
{
    $media_show = '<img src="' . $source_url . '">'; 
}
else
{
    $media_show = '<video width="600" height="420" controls><source src="' . $source_url . '" type="video/mp4"></video>';
}

increase_viewed($media_id);
add_viewed($local_user_id, $media_id);

function generate_up_next($media_id,$user_id, $media_name, $viewed_times, $category)
{
    $config = parse_ini_file(__DIR__.'/config.ini');
    $info = get_user_info($user_id);
    $user_name = $info['user_name']; 
    $href = 'play.php?media_id=' . $media_id; 
    $image_src = $config['media_dir_rp'].$category . '.jpg';
    $html = sprintf("
						<div class=\"single-right-grids\">
							<div class=\"col-md-4 single-right-grid-left\">
								<a href=\"%s\"><img src=\"%s\" alt=\"\" /></a>
							</div>
							<div class=\"col-md-8 single-right-grid-right\">
								<a href=\"%s\" class=\"title\"> %s </a>
								<p class=\"author\"><a href=\"#\" class=\"author\">%s</a></p>
								<p class=\"views\">%d views</p>
							</div>
							<div class=\"clearfix\"> </div>
						</div>
                        ",
                    $href, $image_src, $href, $media_name, $user_name, $viewed_times 
                    );

    echo $html;
}

function show_up_nexts($keyword)
{
   $medias = get_media_by_keyword($keyword); 
   if($medias)
   {
       foreach($medias as $media)
       {
           generate_up_next(
                $media['media_id'],
                $media['user_id'],
                $media['media_name'],
                $media['viewed_times'],
                $media['category']);
        }
    }
}

function generate_comment($user_name, $avatar, $content)
{
    $html = sprintf("
				<div class=\"media\">
				    <h5> %s </h5>
					<div class=\"media-left\">
						<a href=\"#\"></a>
				    </div>
					<div class=\"media-body\">
					    <p> %s </p>
				    </div>
				</div>
            ", $user_name, $content
        );

    echo $html;
}

function show_comments($comments)
{
    if($comments)
    {
        foreach($comments as $comment)
        {
            $user_id = $comment['user_id'];
            $content = $comment['content'];

            $user_info = get_user_info($user_id);
            if(!$user_info)
            {
                continue;
            }

            generate_comment(
                $user_info['user_name'], 
                $user_info['avatar'],
                $comment['content']);
        }
    }
}

?>
<script>

$(document).ready(function () {    
    $('#add_comment').on('submit', function(e){
        e.preventDefault();
        var data = {
            type    : "comment",
            media_id : $("#media_id").attr("value"), 
            content: $("#comment_content").val()
        
        };

        $.ajax(
            {
                url: 'handle.php',
                type:'POST',
                data: data,

                success: function(data)
                {
                    if(data.status == "error")
                    {
                        alert("please login");
                    }
                    else
                    {
                        var html = "<div class='media'><h5>"+ data.user_name +"</h5><div class='media-left'><a href='#'></a></div><div class='media-body'><p>"+ data.content +"</p></div></div>"
                        $('#show_comment').prepend(html); 
                    }
                },

                    error: function(){
                        alert('comment failed');
                    }
            });
        return false;
    });

    $('#media_dislike').click(function(event){
        var data = {
            type    : "dislike",
            media_id : $("#media_id").attr("value") 
        };

        $.ajax(
            {
                url: 'handle.php',
                type:'POST',
                data: data,

                success: function(data)
                {
                    if(data.status == "error")
                    {
                        alert("please login");
                    }
                    else
                    {
                        $('#media_dislike').text(data.msg+' dislike'); 
                    }
                },

                    error: function(){
                        alert('vote failed');
                    }
            });
    });
    $('#media_like').click(function(event){
        var data = {
            type    : "like",
            media_id : $("#media_id").attr("value") 
        
        };

        $.ajax(
            {
                url: 'handle.php',
                type:'POST',
                data: data,

                success: function(data)
                {
                    if(data.status == "error")
                    {
                        alert("please login");
                    }
                    else
                    {
                        $('#media_like').text(data.msg+ ' like'); 
                    }
                },

                error: function(){
                        alert('vote failed');
                    }
            });
    });
});



</script>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="show-top-grids">
				<div class="col-sm-8 single-left">
					<div class="song">
						<div class="song-info">
                        <h3 id='media_id' value='<?php echo $media_id ?>'><?php echo $media_name; ?></h3>	
					</div>
						<div class="video-grid">
                            <?php echo $media_show ?>
						</div>
					</div>
					<div class="song-grid-right">
						<div class="share">
							<h5>Share this</h5>
							<ul>
								<li><a href="#" class="icon fb-icon">Facebook</a></li>
                                <li><a href="user.php?main=playlist&media_id=<?echo $media_id ?>" class="icon dribbble-icon" id="add_contact" >Playlist</a></li>
								<li><a href="user.php?main=group" class="icon twitter-icon">Discussion</a></li>
                                <li><a href="download.php?media_id=<? echo $media_id ?>" id="media_download" class="icon pinterest-icon">Download</a></li>
                                <li><a id="media_dislike" href="#" class="icon whatsapp-icon"><?php echo $dislike_times; ?> dislike</a></li>
								<li><a id="media_like" href="#" class="icon "><?php echo $like_times; ?> like</a></li>
								<li><a href="#add_comment" class="icon comment-icon">Comments</a></li>
                                <li class="view"><?php echo $viewed_times+1 ?> Views</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"> </div>

					<div class="published">
							<script>
								$(document).ready(function () {
									size_li = $("#myList li").size();
									x=1;
									$('#myList li:lt('+x+')').show();
									$('#loadMore').click(function () {
										x= (x+1 <= size_li) ? x+1 : size_li;
										$('#myList li:lt('+x+')').show();
									});
									$('#showLess').click(function () {
										x=(x-1<0) ? 1 : x-1;
										$('#myList li').not(':lt('+x+')').hide();
									});
								});
							</script>
							<div class="load_more">	
								<ul id="myList">
									<li>
                                    <h4>Published on <?php echo $upload_time ?></h4>
                                        <p> <?php echo $media_description; ?></p>
									</li>

								</ul>
							</div>
					</div>

					<div class="all-comments">
						<div class="all-comments-info">
                        <a href="#">All Comments (<?php echo $comments_count  ?>)</a>
							<div class="box">
								<form  id="add_comment" method="post" action="handle.php">
									<textarea id="comment_content" placeholder="Message" required=" "></textarea>
									<input type="submit" class="submit" value="SEND" />
									<div class="clearfix"> </div>
								</form>
							</div>
						</div>
						<div class="media-grids" id="show_comment">
                        <?php show_comments($comments); ?>
						</div>
					</div>
				</div>


				<div class="col-md-4 single-right">
					<h3>Up Next</h3>
        		    <div class="single-grid-right">
                    <?php show_up_nexts($keyword); ?>
			    </div>
			</div>
		<div class="clearfix"> </div>
	</div>
		</div>
		<div class="clearfix"> </div>
</html>

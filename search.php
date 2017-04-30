<?php
include_once("./common.php");

function medias_layout()
{
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_GET['search_text']))
        {
            $search_text = $_GET['search_text']; 
            show_slides('basic_search', $search_text);
        }
        else
        {
            if(isset($_GET['size']))
            {
                $size = $_GET['size']; 
                if($size == "lessthan1m")
                {
                    $min_size = "0";
                    $max_size = "1024000";
                }
                elseif($size == "greatethan1m")
                {
                    $min_size = "1024000";
                    $max_size = "10000000";
                }
                else
                {
                    $min_size = "0";
                    $max_size = "10000000";
                }
            }
            else
            {
                $min_size = "0";
                $max_size = "10000000";
            }
            if(isset($_GET['upload_time']))
            {
                $upload_time = $_GET['upload_time']; 
            }
            if(isset($_GET['author']))
            {
                if($_GET['author'])
                {
                    $user_name = $_GET['author']; 
                    $user = get_user_info($user_name);
                    if($user)
                    {
                        $author = $user['user_id']; 
                    }
                    else
                    {
                        // This author could not exist
                        $author = 'not_exist';
                    }
                }
                else
                {
                    $author = '';
                }
            }
            else
            {
                $author = '';
            }

            $args = [
                'max_size'       => $max_size,
                'min_size'       => $min_size,
                'upload_time'    => $upload_time,
                'author'         => $author
            ];
        
            show_slides('advance_search', $args);
        }
    
    }
}

?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
                <div class="container" >
                    <form class="form-inline" method='GET' action='index.php'>
                        <input type="hidden" name="main" value="search">
                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="size" name='size'>
                            <option seleced disable value="">Size</option>
                            <option value="lessthan1m">Less than 1M </option>
                            <option value="greatethan1m">Greater than 1M</option>
                        </select>
                        <select class="form=control mb-2 mr-sm-2 mb-sm-0" id="upload_time" name='upload_time'>
                            <option value="10000">Uplod time</option>
                            <option value="1">Today </option>
                            <option value="7">This week</option>
                            <option value="30">This month</option>
                        </select>                       
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="author" id="author" placeholder="Author">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <hr>
                <?php medias_layout() ?>
		    </div>
		</div>
	</div>
</div>

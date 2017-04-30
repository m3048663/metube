<?php
include_once("./common.php");

function medias_layout()
{
    $order="viewed_times";
    if(isset($_GET['order']))
    {
        $order = $_GET['order']; 
    }
    show_slides('media_order', $order);
}

?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
                <div class="container" >
                    <form class="col-sm-5 h5" method='GET' action='index.php'>
                        <input type="hidden" name="main" value="medias">
                            <div class="form-group row">
                                <select class="form-control" id="order" name='order' onchange="this.form.submit()">
                                    <option selected disabled value="">choose order method</option>
                                    <option value="upload_time">Most-recently</option>
                                    <option value="viewed_times">Most-viewed</option>
                                    <option value="like_times">Most-popular</option>
                                    <option value="size">Size</option>
                                    <option value="media_name">Name</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
                <?php medias_layout() ?>
		    </div>
		</div>
	</div>
</div>

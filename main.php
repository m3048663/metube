<?php
include_once("./common.php");
?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Recent</h3>
                <hr>
            </div>
            <?php show_slides('recent');?>
			<div class="clearfix"> </div>
		</div>

		<div class="recommended">
		    <div class="recommended-grids">
			    <div class="recommended-info">
			        <h3>Recommended</h3>
                    <hr>
				</div>
                <?php show_slides('recommended'); ?>
			    <div class="clearfix"> </div>
			</div>
		</div>

		<div class="recommended">
		    <div class="recommended-grids">
			    <div class="recommended-info">
				    <h3>Popular</h3>
                    <hr>
				</div>
                <?php show_slides('popular'); ?>
		        <div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>

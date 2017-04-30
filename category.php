<?php
include_once("./common.php");

function category_layout()
{
    $config = parse_ini_file(dirname(__FILE__).'/config.ini');
    $category_name = $_GET['main'];
    $category = $config[$category_name];
    show_slides('category', $category);
}

?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
                <h3><?php echo $_GET['main']  ?></h3>
                <hr>
            </div>
            <?php category_layout() ?>
		</div>
	</div>
</div>

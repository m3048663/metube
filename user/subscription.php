<?php
session_start();
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
}
include_once("./database/tb_subscription.php");
include_once("./database/tb_user.php");


$update_infos = array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['channel_name']))
    {
        $channel_name = $_POST['channel_name'];
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

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['delete']))
    {
        $subscription_id = $_GET['delete'];
        delete_subscription($subscription_id);
    }
}

function show_subscription($subscription)
{

    $subscription_id = $subscription['subscription_id'];
    $channel_id = $subscription['channel_id'];
    $channel = get_user_info($channel_id);
    $channel_name = $channel['user_name'];
    $html = sprintf("
                         <tr class=\"warning\">
                            <td > %s </td>
                            <td>
                                <a href='user.php?main=subscription&delete=%s' id=\"delete_contact\" type=\"button\" class=\"btn btn-danger\">Delete</a>
                            </td>
                        </tr>   
                        ", $channel_name, $subscription_id); 

    echo $html;
}

function show_subscriptions()
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
        $subscriptions = get_subscriptions($user_id);

        if($subscriptions)
        {
            foreach($subscriptions as $subscription) 
            {
                show_subscription($subscription);
            }
        }   
    }

}


?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
					<a href="#small-dialog7" class="play-icon popup-with-zoom-anim btn btn-primary" id="add_contact">Subscription</a>

                <div class="signin">
					<div id="small-dialog7" class="mfp-hide">
						<h3>Subscription</h3>
                            <div class="container">
                                <form method="post" action="user.php?main=subscription" >
                                    <div class="form-group row col-sm-4">
								        <input class="form-control" type="text" name="channel_name" placeholder="Enter Channelname" required="required">
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
            <div class="container h5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Channel</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="aclrules" name="aclrules">
<?php 


show_subscriptions();

?>
                    </tbody>
                </table>
                </div>

</div>
</div>
</div>


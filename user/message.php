<?php
session_start();
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
}
include_once("./database/tb_message.php");
include_once("./database/tb_user.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['to_user_name']))
    {
        $to_user_name = $_POST['to_user_name'];
        $to = get_user_info($to_user_name);
        if($to)
        {
            $infos = [
                'from_user_id' => $user_id,
                'to_user_id' => $to['user_id'],
                'content' => $_POST['content']
            ];

            add_message($infos);       
        }

    }
}

function show_message($message)
{
    $from_user_id = $message['from_user_id']; 
    $from = get_user_info($from_user_id);
    $from_user_name = $from['user_name'];
    $content = $message['content'];
    $html = sprintf("
                <div class='bs-calltoaction bs-calltoaction-primary'>
                    <div class='row'>
                        <div class='col-md-9 cta-contents'>
                            <h1 class='cta-title h4'>%s</h1>
                            <div class='cta-desc h5'>
                                <p> %s </p>
                            </div>
                        </div>
                        <div class='col-md-3 cta-button'>
                            <a href='#small-dialog8' class='btn popup-with-zoom-anim btn-lg btn-block btn-warning'>Reply</a>
                        </div>
                     </div>
                </div>
                <hr>
             ", $from_user_name, $content); 

    echo $html;

}

function show_messages()
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
        $messages= get_messages($user_id);

        if($messages)
        {
            foreach($messages as $message) 
            {
                show_message($message);
            }
        }   
    }
}

?>

<div class='col-md-offset-2 main'>
    <div class='main-grids'>
	    <div class='top-grids'>
<!--	        <div class='recommended-info'>
	            <h3><a href='#' class='btn btn-lg btn-primary'>Send Messages</a></h3>
                <hr>
            </div>
-->
					<a href="#small-dialog8" class="play-icon popup-with-zoom-anim btn btn-primary" id="add_contact">Send Message</a>
<hr>

                <div class="signin">
					<div id="small-dialog8" class="mfp-hide">
						<h3>Send Message</h3>
                            <div class="container">
                                <form method="post" action="user.php?main=message" >
                                    <div class="form-group row col-sm-4">
								        <input class="form-control" type="text" name="to_user_name" placeholder="Receiver Username" required="required">
								        <textarea class="form-control" type="text" name="content" placeholder="Message" required="required" rows="4"> </textarea>
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



        <div class='container'>
            <div class='col-sm-12'>
            <?php show_messages(); ?>
            </div>
        </div>


  </div>
  </div>
  </div>
  

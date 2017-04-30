<?php
session_start();
if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id']; 
}
include_once("./database/tb_contact.php");
include_once("./database/tb_user.php");


$update_infos = array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST['contact_name']))
    {
        $friend_name = $_POST['contact_name'];
        $contact = get_user_info($friend_name);
        if($contact)
        {
            $infos = [
                'user_id' => $user_id,
                'friend_id' => $contact['user_id'],
                'group_name' => $_POST['group_name']
            ];

            add_contact($infos);       
        }

    }
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if(isset($_GET['delete']))
    {
        $contact_id = $_GET['delete'];
        delete_contact($contact_id);
    }
    if(isset($_GET['block']))
    {
        $contact_id = $_GET['block'];
        $is_block = $_GET['is_block'];
        block_contact($contact_id, $is_block);
    }
}

function show_contact($contact)
{

    $friend_id = $contact['friend_id'];
    $contact_id = $contact['contact_id'];
    $friend = get_user_info($friend_id);
    $friend_name = $friend['user_name'];
    $group_name = $contact['group_name'];
    $is_block = $contact['is_block'];
    $html = sprintf("
                         <tr class=\"warning\">
                            <td > %s </td>
                            <td> %s </td>
                            <td> %s </td>
                            <td>
                                <a href='user.php?main=contact&delete=%s' id=\"delete_contact\" type=\"button\" class=\"btn btn-danger\">Delete</a>
                                <a href='user.php?main=contact&block=%s&is_block=%s' type=\"button\" class=\"btn btn-warning\">un/block</a>
                            </td>
                        </tr>   
                        ", $friend_name, $group_name, $is_block, $contact_id, $contact_id, !$is_block); 

    echo $html;
}

function show_contacts()
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
        $contacts = get_contacts($user_id);

        if($contacts)
        {
            foreach($contacts as $contact) 
            {
                show_contact($contact);
            }
        }   
    }

}


?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
					<a href="#small-dialog7" class="play-icon popup-with-zoom-anim btn btn-primary" id="add_contact">Add Contact</a>

                <div class="signin">
					<div id="small-dialog7" class="mfp-hide">
						<h3>Add Contact</h3>
                            <div class="container">
                                <form method="post" action="user.php?main=contact" >
                                    <div class="form-group row col-sm-4">
								        <input class="form-control" type="text" name="contact_name" placeholder="Enter Username" required="required">
								        <input class="form-control" type="text" name="group_name" placeholder="Enter Group" required="required">
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
                            <th>Contact</th>
                            <th>Group</th>
                            <th>State</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="aclrules" name="aclrules">
<?php 


show_contacts();

?>
                    </tbody>
                </table>
                </div>

</div>
</div>
</div>


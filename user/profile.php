<?php
include_once("./database/tb_user.php");

session_start();

$update_infos = array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id']; 
    }
    if(!empty($_POST['email']))
    {
        $update_infos['email'] = $_POST['email']; 
    }
    if(!empty($_POST['phone']))
    {
        $update_infos['phone'] = $_POST['phone']; 
    }
    if(!empty($_POST['pwd0']))
    {
        $update_infos['password'] = $_POST['pwd0']; 
    }

    if($update_infos)
    {
        update_user($user_id, $update_infos);
    }
}

if(isset($_SESSION['user_name']))
{
    $info = get_user_info($_SESSION['user_name']);
}
else
{
    echo "error";
}

?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Profile</h3>
            </div>

<form class="form-horizontal" method="POST" action="user.php?main=profile">
  <div class="form-group">
  <label class="control-label col-sm-2" for="user_id">User ID</label>
    <div class="col-sm-6">
      <!--<input type="" class="form-control" id="user_id" placeholder="<?php //echo $info['user_id']; ?>">-->
      <p  class="form-control-static" id="user_id" > <?php echo $info['user_id']; ?> </p>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="user_name">User Name:</label>
    <div class="col-sm-6">
      <p  class="form-control-static" id="user_id" > <?php echo $info['user_name']; ?> </p>
      <!--<input type="" class="form-control" id="user_name" placeholder="<?php //echo $info['user_name']; ?>">-->
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-6">
      <input type="email" class="form-control" name="email" id="email"  placeholder="<?php echo $info['email']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="phone">Phone:</label>
    <div class="col-sm-6">
      <input type="" class="form-control" id="phone" name="phone"  placeholder="<?php echo $info['phone']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-6"> 
      <input type="password" class="form-control" id="pwd0" name="pwd0" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd1">Password:</label>
    <div class="col-sm-6"> 
      <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="Enter password again">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

		</div>

		</div>
	</div>

</div>

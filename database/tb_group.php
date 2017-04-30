<?php

include_once("db_conn.php");

if(!isset($_GET['func']))
	{echo "the func doesn't be set";}
else if($_GET["func"] == "set_message")
	{set_message($name,$msg);}
else if ($_GET["func"] == "get_message")
	{get_message();}

function set_message($name,$msg)
{
   $user = $_GET["name"];
   $dt = date("Y-m-d H:i:s");
   $msg = $_GET["msg"];
   $sql = "INSERT INTO chat(username,chatdate,msg)VALUES('$user','$dt','$msg')";
   $result = mysql_query($sql);
   if(db_query($sql))
   {
	return true;
   }
   else
   {
	return false;
   }
}

function get_message()
{
   $sql = "SELECT *, date_format(chatdate,'%d-%m-%Y %r') as cdt from chat order by ID desc limit 200";
   $sql = "SELECT * FROM (" . $sql .") as ch order by ID";
   //$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
   
   //$result = db_select($sql);
   
   $conn = db_connect();
   $result = mysqli_query($conn,$sql);

   //Update information
   $msg="";
   while ($line = mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
	$msg = sprintf('<div class="alert alert-success h5" role="alert">
		<strong> %s: </strong> %s </div>',
		$line["username"],$line["msg"]);
	echo $msg;
   }
}

?>


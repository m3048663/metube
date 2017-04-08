<?php
session_start();
//Connecting, selecting database
$servername = "mysql1.cs.clemson.edu";
$username = "metube_y7r3";
$password = "woshimahui2011";
$dbname = "metube_rqc2";

$uname = $_POST["username"];
$upwd = $_POST["password"];

// 创建连接
$link = mysqli_connect($servername,$username,$password,$dbname) or die('Could not connect:'.mysqli_error($link));
//send query
$checkquery = "select * from account where u_name='$uname' AND u_password='$upwd'";
$result = mysqli_query($link,$checkquery) or die("Query error:".mysqli_error($link)."\n");

//$sign = 0;

if(mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$_SESSION['users'] = $uname;
	//echo $_SESSION['users'];
	header("Location: index.php"); 
	//include("index.php");
}
//else header("Location: index.php");

//closing connection
mysqli_close($link);
?>
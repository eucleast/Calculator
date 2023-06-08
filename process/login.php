<?php
session_start();
include_once "../include/config.php";
include_once "../include/db_connect.php";
include_once "../include/functions.php";

$userid = secPOSTVar($_POST['userid']);
$password = secPOSTVar($_POST['password']);

REcheckValidation('userid,password','../');

$sql = "SELECT * FROM users WHERE user_id = '$userid' AND password = '$password' AND is_active = 1";
$result = mysql_query($sql); 
$count = mysql_num_rows($result);
$rows = mysql_fetch_array($result);
$errno = mysql_errno();

include_once "../include/db_close.php";

SQLErrorCheck($result, $errno, '../');

if($count == 1){
	 $_SESSION[$prefix.'user_id'] = $rows['user_id'];
	 $_SESSION[$prefix.'name'] = $rows['name'];
	 $_SESSION[$prefix.'is_admin'] = $rows['is_admin'];
	 $_SESSION[$prefix.'login'] = true;
	header("location:../default/");
	exit();
}else{
	$_SESSION[$prefix.'notify_type'] = 'bad';
	$_SESSION[$prefix.'notify_msg'] = 'Your Staff ID or Password is invalid.';
	header("location:../");
	exit();
}
?>
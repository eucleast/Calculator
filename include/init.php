<?php
// check if session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// check if user logged in, else go to login page
if(!isset($_SESSION[$prefix.'login']) || $_SESSION[$prefix.'login'] != true){
	header("location:../");
	exit();
}
// set default time zone
date_default_timezone_set('Asia/Kuala_Lumpur');
// for top menu navigation
$rootPath = '';
?>
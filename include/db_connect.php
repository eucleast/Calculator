<?php
// open connection
$db_connect = mysql_connect($db_server, $db_username, $db_password) or die ('Cannot establish Database connection');
mysql_select_db($db_name,$db_connect) or die ('Failed to open Database');
?>
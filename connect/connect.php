<?php
	$host = "localhost";
	$user = "root";
	$pw = "020508Yuna!";
	$db = "boardtest";
	$connect = new mysqli($host, $user, $pw, $db);
	$connect -> set_charset("utf-8");
	if(mysqli_connect_errno()) {
		echo "Database Connect false";
	} else {
		// echo "Database Connect true";
	}
	$connect->query('set names utf8');
	
	// if (function_exists("mysqli_connect")) {
	// 	$db_conn = new mysqli($host, $user, $pw, $db);
	// 	if ($db_conn->connect_errno) 
	// 		die("Connect Error Mysqli");
	// } else {
	// 	//$db_conn = mysql_connect($db_host, $db_user, $db_pass) or die ("Connect Error Mysql");
	// 	//mysql_select_db($db_name, $db_conn);
	// }
	// session_start();
	// // $_SESSION['DBCON_STATUS'] = 'CONNECTED';
	// session_unset();
	// session_destroy();
?>
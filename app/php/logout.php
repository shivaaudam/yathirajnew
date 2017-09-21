<?php 
	include "config.php";
	session_start();
	session_destroy();
	$arr = array('loggedOut'=>true, 'error' => '');
	$jsn = json_encode($arr);
	print_r($jsn);
?>


<?php 
	include "config.php";
	$data = json_decode(file_get_contents('php://input')); 
	session_start();
	if(!empty($_SESSION['email'])){
		$qry_em = 'select users.firstName,users.lastName,users.email,userinfo.dob,userinfo.fathersName,userinfo.mothersName,userinfo.gender,userinfo.maritalStatus,userinfo.occupation,userinfo.mobile, userinfo.profile_image from users, userinfo where users.user_id ="'.$_SESSION['userId'].'"';
		$qry_res =  $conn->query($qry_em) or die($conn->error);
		$res = $qry_res->fetch_assoc();
		if (!$res) {
		    //throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
		}
		$arr = array('userData'=>$res);
		$jsn = json_encode($arr);
		print_r(json_encode($arr));
	}
	echo null;
?>
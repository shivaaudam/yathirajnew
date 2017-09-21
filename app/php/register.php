<?php 
include "config.php";
$data = json_decode(file_get_contents('php://input'),true); 
		$fName = $data['fisrtName'];
		$lName = $data['lastName'];
		$email = $data['email'];
		$password = $data['password'];
		$cPassword = $data['confirmPassword'];
		$qry_em = 'select count(*) as cnt from users where email ="' . $email . '"';
		$qry_res =  $conn->query($qry_em);
		$res = $qry_res->fetch_assoc();
		$encryptedPwd = password_hash($password, PASSWORD_BCRYPT);
		if($res['cnt'] == 0){
			$userId = mt_rand();
			$sql1= "INSERT INTO users (user_id, firstName, lastName, email, password) 
	                             VALUE('{$userId}','{$fName}', '{$lName}', '{$email}', '{$encryptedPwd}')";
	        $result = $conn->query($sql1);
	        if($result){
	        	$sql2= "INSERT INTO userinfo (user_id) 
	                             values ((SELECT user_id FROM users WHERE email ='$email'))";
	        	$result1 = $conn->query($sql2);
	        	$arr = array('msg' => "User Created Successfully!!!", 'error' => '');
        		$jsn = json_encode($arr);
        		print_r($jsn);
	        }
	        else{
	        	$arr = array('msg' => "", 'error' => 'Error In inserting record');
		        $jsn = json_encode($arr);
		        print_r($jsn);
	        }
		}
		else{
			$arr = array('msg' => "", 'error' => 'User Already exists with same email');
		    $jsn = json_encode($arr);
		    print_r($jsn);
		}
?>
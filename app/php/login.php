<?php 
	include "config.php";
	$data = json_decode(file_get_contents('php://input')); 
	$email = $data->email;
	$pwd = $data->password;
	$qry_em = 'select count(*) as cnt,user_id,firstName,lastName,email,password from users where email ="' . $email . '"';
	$qry_res =  $conn->query($qry_em) or die($conn->error);
	$res = $qry_res->fetch_assoc();
	if (!$res) {
		    //throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
		}
	if($res['cnt'] == 1){
		if(password_verify($pwd, $res['password'])){
			session_start();
		    $_SESSION['email'] = $res['email'];
		    $_SESSION['username']= $res['firstName'];
		    $_SESSION['userId']=$res['user_id'];
			$arr = array('msg' => "user found",'loggedIn'=>true, 'error' => '','userDetails'=>$_SESSION);
		    $jsn = json_encode($arr);
		    print_r($jsn);
		}
		else{
			$arr = array('msg' => "",'loggedIn'=>false, 'error' => 'Wrong password');
		    $jsn = json_encode($arr);
		    print_r($jsn);
		}
	}
	else{
		$arr = array('msg' => "", 'error' => 'Please enter registered Email');
	    $jsn = json_encode($arr);
	    print_r($jsn);
	}
?>
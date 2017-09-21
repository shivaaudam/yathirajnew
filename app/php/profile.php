<?php 
include "config.php";
$data = json_decode($_POST['postdata']);
session_start();
if(!empty($_FILES['image'])){
	$ext = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $image = time().'.'.$ext;
    $folder = "images/";
    $dbPath ="app/assets/profilePics/".$_FILES['image']['name'];
    $imagePath = "assets/profilePics/".$_FILES['image']['name'];
    if(move_uploaded_file($_FILES["image"]["tmp_name"], PROJECT_ROOT.$imagePath)){
		$sql = "update userinfo set profile_image='$dbPath' where user_id='".$_SESSION['userId']."'";
		$result = $conn->query($sql);
    };
}else{
	echo "Image Is Empty";
}

$email = $_SESSION['email'];
$dob = $data->dob;
$fathersName = $data->fathersName;
$mothersName = $data->mothersName;
$gender = $data->gender;
$maritalStatus = $data->maritalStatus;
$occupation = $data->occupation;
$mobile = $data->mobile;
$sql = "update userinfo set dob='$dob', fathersName='$fathersName', mothersName='$mothersName', gender='$gender', maritalStatus='$maritalStatus', occupation='$occupation', mobile='$mobile' where user_id='".$_SESSION['userId']."'";
$result = $conn->query($sql);

$qry_em = 'select profile_image from userinfo where user_id ="' . $_SESSION['userId'] . '"';
	$qry_res =  $conn->query($qry_em);
	$res = $qry_res->fetch_assoc();
	$imagePath = $res['profile_image'];
if($result){
	$arr = array('msg' => "User updated Successfully!!!", 'error' => '','profileImage'=>$imagePath);
	$jsn = json_encode($arr);
	print_r($jsn);
}
else{
	$arr = array('msg' => "", 'error' => 'Error In inserting record');
    $jsn = json_encode($arr);
    print_r($jsn);
}
?>
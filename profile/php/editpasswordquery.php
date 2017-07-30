<?php
include "../../basefunction/database_connection.php";
include "../../basefunction/security.php";
include '../../basefunction/timezone.php';

session_start();
$userid=$_SESSION['session_userid'];
$CURRENT_PASSWORD = security($_POST['CURRENT_PASSWORD']);
$USER_NEWPASSWORD = security($_POST['USER_NEWPASSWORD']);
$USER_REPASSWORD = security($_POST['USER_REPASSWORD']);
$USER_DATEMODIFIED = date("m-d-Y H:i:s");
$USER_DATEONLY = date("m-d-Y");	
$select = mysqli_query($link,"select * from user where USER_ID='$userid'");
$fetch = mysqli_fetch_array($select);
$USER_PASSWORD = $fetch['USER_PASSWORD'];

$USER_USERNAME = $fetch['USER_USERNAME'];
$verify = password_verify($CURRENT_PASSWORD,$USER_PASSWORD);
$hash = password_hash($USER_NEWPASSWORD,PASSWORD_DEFAULT);
if($verify == false){
	echo 'pass';
}else{
$query= "update user set USER_PASSWORD='$hash' where USER_ID='$userid'";
$result = mysqli_query($link,$query);
if($result){
	$info = "Edited username:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Profile Module','Edited password','$info $USER_USERNAME','$USER_DATEMODIFIED','$USER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}
?>

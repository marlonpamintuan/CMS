<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
error_reporting(0);
$userid=$_SESSION['session_userid'];
$USER_FIRSTNAME = security($_POST['USER_FIRSTNAME']);
$USER_MIDDLENAME = security($_POST['USER_MIDDLENAME']);
$USER_LASTNAME = security($_POST['USER_LASTNAME']);
$USER_ID = security($_POST['USER_ID']);
$USER_EMAIL = security($_POST['USER_EMAIL']);
$USER_USERNAME = security($_POST['USER_USERNAME']);
$USER_AUDIT = security($_POST['USER_AUDIT']);
$USER_PASSWORD = security($_POST['USER_PASSWORD']);
$hash = password_hash($USER_PASSWORD,PASSWORD_DEFAULT);
$USER_ACCESS = security($_POST['USER_ACCESS']);
$USER_ACCESS = security($_POST['USER_ACCESS']);
$USER_DATECREATED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$USER_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
$userfetch=mysqli_query($link,"select * from user where USER_USERNAME = '".$USER_USERNAME."' AND USER_STATUS !='inactive'");
$countfetch= mysqli_num_rows($userfetch);
$emailfetch=mysqli_query($link,"select * from user where USER_EMAIL = '".$USER_EMAIL."' AND USER_STATUS !='inactive' ");
$countemail= mysqli_num_rows($emailfetch);
if($countfetch > 0){
	echo 'duplicate';	
}elseif($countemail > 0 && $USER_EMAIL !=''){
    echo 'email';
}else{
$query= "insert into user(USER_FIRSTNAME,USER_MIDDLENAME,USER_LASTNAME,USER_EMAIL,USER_USERNAME,USER_PASSWORD,USER_ACCESS,USER_AUDIT,USER_DATECREATED) VALUES('$USER_FIRSTNAME','$USER_MIDDLENAME','$USER_LASTNAME','$USER_EMAIL','$USER_USERNAME','$hash','$USER_ACCESS','$USER_AUDIT','$USER_DATECREATED')";
$result = mysqli_query($link,$query);
if($result){
	$info = "Added username:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('User Module','Added new user','$info $USER_USERNAME','$USER_DATECREATED','$USER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}
?>

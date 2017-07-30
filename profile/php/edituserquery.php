<?php
include "../../basefunction/database_connection.php";
include "../../basefunction/security.php";
include '../../basefunction/timezone.php';

session_start();
$userid=$_SESSION['session_userid'];
$USER_FIRSTNAME = security($_POST['USER_FIRSTNAME']);
$USER_MIDDLENAME = security($_POST['USER_MIDDLENAME']);
$USER_LASTNAME = security($_POST['USER_LASTNAME']);
$USER_ID = security($_POST['USER_ID']);
$USER_EMAIL = security($_POST['USER_EMAIL']);
$USER_USERNAME = security($_POST['USER_USERNAME']);
$USER_ACCESS = $_SESSION['session_access'];
$USER_DATEMODIFIED = date("m-d-Y H:i:s");
$USER_DATEONLY = date("m-d-Y");	
$select = mysqli_query($link,"select * from user where USER_ID='$userid'");
$fetch = mysqli_fetch_array($select);
$userfetch=mysqli_query($link,"select * from user where USER_USERNAME = '".$USER_USERNAME."'");
$countfetch= mysqli_num_rows($userfetch);
$emailfetch=mysqli_query($link,"select * from user where USER_EMAIL = '".$USER_EMAIL."' ");
$countemail= mysqli_num_rows($emailfetch);

if($countfetch > 1){
	echo 'duplicate';	
}elseif($countemail > 1){
    echo 'email';

}
else{
$query= "update user set USER_FIRSTNAME='$USER_FIRSTNAME',USER_MIDDLENAME='$USER_MIDDLENAME',USER_LASTNAME='$USER_LASTNAME',USER_EMAIL='$USER_EMAIL',USER_USERNAME='$USER_USERNAME',USER_ACCESS='$USER_ACCESS',USER_DATEMODIFIED ='$USER_DATEMODIFIED' where USER_ID='$userid'";
$result = mysqli_query($link,$query);
if($result){
		$info = "Edited username:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Profile Module','Edited user','$info $USER_USERNAME','$USER_DATEMODIFIED','$USER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}
?>

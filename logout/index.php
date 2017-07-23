<?php 
include ('../basefunction/database_connection.php');

session_start();
$userid = $_SESSION['session_userid'];
$select = mysqli_query($link,"select * from user where USER_ID ='$userid'");
$fetch = mysqli_fetch_array($select);
$username = $fetch['USER_USERNAME'];
$info = "Username:";
$logintime = date("m-d-Y H:i:s", strtotime('+6 hours'));	
$login_dateonly = date("m-d-Y", strtotime('+6 hours'));		
$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Logout Module','Logged out','$info $username','$logintime','$login_dateonly','$userid')");
if($audit_query){
session_destroy();

header('location:../login');
}
?>

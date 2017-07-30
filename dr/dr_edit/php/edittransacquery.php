<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
$userid=$_SESSION['session_userid'];
$DR_DATEONLY = date("m-d-Y");	
$CUSTOMER_ID = security($_POST['CUSTOMER_IDS']);
$DR_ID = security($_POST['DR_ID']);
$DR_NO = security($_POST['DR_NO']);
$DR_NO_ORIG = security($_POST['DR_NO_ORIG']);
$DR_STARTDATE = security(date('Y-m-d',strtotime($_POST['DR_STARTDATE'])));
$DR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['DR_RETURNDATE'])));
$DR_DATEMODIFIED = date("m-d-Y H:i:s");
$query= "update dr set DR_NO='$DR_NO_ORIG',CUSTOMER_ID='$CUSTOMER_ID',DR_STARTDATE='$DR_STARTDATE',DR_RETURNDATE='$DR_RETURNDATE',DR_DATEMODIFIED ='$DR_DATEMODIFIED' where DR_NO='$DR_NO'";
$result = mysqli_query($link,$query);
if($result){
$check_due =mysqli_query($link,"update dr set DR_DUE='Overdue' where DR_RETURNDATE < CURDATE()");
if($check_due){	
$info = "Edited Direct Receipt:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Edited direct receipt','$info $DR_NO','$DR_DATEMODIFIED','$DR_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}

}

?>

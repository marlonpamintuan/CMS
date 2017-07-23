<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$CUSTOMER_ID = security($_POST['CUSTOMER_IDS']);
$IR_NO = security($_POST['IR_NO']);
$IR_NO_ORIG = security($_POST['IR_NO_ORIG']);
$IR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['IR_RETURNDATE'])));
$IR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
$IR_DATEMODIFIED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$query= "update ir set IR_NO='$IR_NO_ORIG',CUSTOMER_ID='$CUSTOMER_ID',IR_RETURNDATE='$IR_RETURNDATE',IR_DATEMODIFIED ='$IR_DATEMODIFIED' where IR_NO='$IR_NO'";
$result = mysqli_query($link,$query);
if($result){
$info = "Edited Direct Receipt:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('IR Module','Edited inward receipt','$info $IR_NO','$IR_DATEMODIFIED','$IR_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}


}

?>

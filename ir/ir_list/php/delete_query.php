<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$IR_NO = security($_POST['IR_NO']);
$IR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
  $IR_DATEDELETED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$query = mysqli_query($link,"update ir set IR_STATUS='inactive', IR_DATEDELETED='$IR_DATEDELETED' where IR_STATUS='' and IR_NO='$IR_NO'");
if($query){

		$info = "Deleted IR:";
		 $audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('IR Module','Deleted inward receipt','$info $IR_NO','$IR_DATEDELETED','$IR_DATEONLY','$userid')");
		 if($audit_query){
	echo 'done';
		 	
		 }
}

?>
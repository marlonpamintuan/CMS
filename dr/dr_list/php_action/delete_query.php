<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$DR_NO = security($_POST['DR_NO']);
$DR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	

  $DR_DATEDELETED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$select = mysqli_query($link,"select * from dr where DR_NO='$DR_NO'");
while($row = mysqli_fetch_array($select)){
$CYLINDER_REFERENCEID = $row['CYLINDER_REFERENCEID'];	
$query = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$CYLINDER_REFERENCEID'");
}
if($query)
{
	$query2 = mysqli_query($link,"update dr set dr.DR_STATUS='inactive' where dr.DR_NO='$DR_NO'");
	if($query2)
	{
			$info = "Deleted DR:";
		 $audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Deleted direct receipt','$info $DR_NO','$DR_DATEDELETED','$DR_DATEONLY','$userid')");
		 if($audit_query){
	echo 'done';
		 	
		 }
	}
}

?>
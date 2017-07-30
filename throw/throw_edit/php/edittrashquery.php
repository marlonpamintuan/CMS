<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include '../../../basefunction/timezone.php';
session_start();
$userid=$_SESSION['session_userid'];
$TRASH_ID = security($_POST['TRASH_ID']);
$TRASH_REASON = security($_POST['TRASH_REASON']);
$TRASH_DATEMODIFIED = date("m-d-Y H:i:s");
$TRASH_DATEONLY = date("m-d-Y");	
$query= "update trash set TRASH_REASON='$TRASH_REASON',TRASH_DATEMODIFIED ='$TRASH_DATEMODIFIED' where CYLINDER_ID='$TRASH_ID'";
$result = mysqli_query($link,$query);
if($result){

  $info = "Edited container:";
  $audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Retrieve Module','Edited Container','$info $TRASH_ID','$TRASH_DATEMODIFIED','$TRASH_DATEONLY','$userid')");
  if($audit_query){
echo 'done';

}
}

?>

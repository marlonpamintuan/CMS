<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
$userid=$_SESSION['session_userid'];
$CYLINDER_REFERENCEID= $_POST['CYLINDER_REFERENCEID'];
$CYLINDER_DATEONLY = date("m-d-Y");	

$TRASH_REASON= $_POST['TRASH_REASON'];
$TRASH_DATECREATED = date("m-d-Y H:i:s");
foreach($CYLINDER_REFERENCEID as $j) {
	$select = mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID='$j'");
	while($row = mysqli_fetch_array($select)){
		$CYLINDER_REFERENCEID2 = $row['CYLINDER_REFERENCEID'];
$CONTAINER_TYPE = $row['CYLINDER_TYPE'];
		$CYLINDER_DETAILS = $row['CYLINDER_DETAILS'];

$insert = mysqli_query($link,"insert into trash(CYLINDER_ID,CYLINDER_TYPE,CYLINDER_DETAILS,TRASH_REASON,TRASH_DATECREATED,TRASH_DATEONLY) VALUES('$CYLINDER_REFERENCEID2','$CONTAINER_TYPE','$CYLINDER_DETAILS','$TRASH_REASON','$TRASH_DATECREATED','$CYLINDER_DATEONLY')");
if($insert){
	$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='throw' where CYLINDER_REFERENCEID='$CYLINDER_REFERENCEID2'");
	}

	}
}
	if($update){
		$info = "Throwed cylinder:";
		$items = array();
		foreach($CYLINDER_REFERENCEID as $i){
			$items[] = $i;
		}
		$container = implode(',',$items);
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Throw Cylinder Module','Throwed cylinder','$info $container','$TRASH_DATECREATED','$CYLINDER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

	}

?>

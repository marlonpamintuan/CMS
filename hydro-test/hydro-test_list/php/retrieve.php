<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
$userid=$_SESSION['session_userid'];
$CYLINDER_REFERENCEID= $_POST['CYLINDER_REFERENCEID'];
$CYLINDER_DATERECOVER = date("m-d-Y H:i:s");
$CYLINDER_DATEONLY = date("m-d-Y");	
foreach($CYLINDER_REFERENCEID as $j) {
	$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='', CYLINDER_DATERECOVER='$CYLINDER_DATERECOVER' where CYLINDER_REFERENCEID='$j' and CYLINDER_STATUS ='throw'");

	if($update){
		$delete = mysqli_query($link,"update hydro set HYDRO_STATUS='inactive' where CYLINDER_ID='$j'");
	}
}
if($delete){
		$info = "Retrieved Hydro Test Container:";
			$items = array();
		foreach($CYLINDER_REFERENCEID as $i){
			$items[] = $i;
		}
		$container = implode(',',$items);
	
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Retrieve Hydro Test Module','Retrieved Container','$info $container','$CYLINDER_DATERECOVER','$CYLINDER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

}
?>

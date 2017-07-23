<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
date_default_timezone_set('Asia/Manila');

$userid=$_SESSION['session_userid'];
$HYDRO_CYLINDER_REFERENCEID= $_POST['HYDRO_CYLINDER_REFERENCEID'];
$HYDRO_DATE= date("m-d-Y",strtotime($_POST['HYDRO_DATE']));
$HYDRO_DATECREATED = date("m-d-Y H:i:s");
$HYDRO_DATEONLY = date('m-d-Y');
foreach($HYDRO_CYLINDER_REFERENCEID as $j) {
	$select = mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID='$j'");
	while($row = mysqli_fetch_array($select)){
		$CYLINDER_REFERENCEID2 = $row['CYLINDER_REFERENCEID'];
$CONTAINER_TYPE = $row['CYLINDER_TYPE'];
		$CYLINDER_DETAILS = $row['CYLINDER_DETAILS'];

$insert = mysqli_query($link,"insert into hydro(CYLINDER_ID,CYLINDER_TYPE,CYLINDER_DETAILS,HYDRO_DATECREATED,HYDRO_DATEONLY) VALUES('$CYLINDER_REFERENCEID2','$CONTAINER_TYPE','$CYLINDER_DETAILS','$HYDRO_DATECREATED','$HYDRO_DATE')");
if($insert){
	$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='throw' where CYLINDER_REFERENCEID='$CYLINDER_REFERENCEID2'");
	}

	}
}
	if($update){
		$info = "Hydro test cylinder:";
		$items = array();
		foreach($HYDRO_CYLINDER_REFERENCEID as $i){
			$items[] = $i;
		}
		$container = implode(',',$items);
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Hydro Test Module','Hydro test cylinder','$info $container','$HYDRO_DATECREATED','$HYDRO_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

	}

?>

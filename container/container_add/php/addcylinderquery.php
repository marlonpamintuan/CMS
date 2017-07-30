<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
$userid = $_SESSION['session_userid'];
$CYLINDER_REFERENCEID= security($_POST['CYLINDER_REFERENCEID']);
$CYLINDER_DETAILS = security($_POST['CYLINDER_DETAILS']);
$CONTAINER_TYPE = security($_POST['CONTAINER_TYPE']);

$CYLINDER_DATEONLY = date("m-d-Y");	
$CYLINDER_DATECREATED = date("m-d-Y H:i:s");
$cylinderfetch=mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."' AND CYLINDER_STATUS = ''");
$countfetch= mysqli_num_rows($cylinderfetch);
$maintenancefetch=mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."' AND CYLINDER_STATUS = 'throw'");
$countmaintenancefetch= mysqli_num_rows($maintenancefetch);
$drfetch=mysqli_query($link,"select * from dr where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."' AND DR_STATUS = ''");
$countdrfetch= mysqli_num_rows($drfetch);

if($countmaintenancefetch > 0){
	echo 'maintenance';	

}elseif($countfetch > 0){
echo 'duplicate';
}elseif($countdrfetch > 0){
echo 'dr';
}
else{
$query= "insert into cylinder(CYLINDER_REFERENCEID,CYLINDER_TYPE,CYLINDER_DETAILS,CYLINDER_DATECREATED) VALUES('$CYLINDER_REFERENCEID','$CONTAINER_TYPE','$CYLINDER_DETAILS','$CYLINDER_DATECREATED')";
$result = mysqli_query($link,$query);
if($result){
$info = "Added cyinder:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Cylinder Module','Added new cylinder','$info $CYLINDER_REFERENCEID','$CYLINDER_DATECREATED','$CYLINDER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

}
}
?>

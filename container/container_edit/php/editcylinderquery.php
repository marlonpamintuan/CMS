<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$CYLINDER_REFERENCEID = security($_POST['CYLINDER_REFERENCEID']);
$CYLINDER_ID = security($_POST['CYLINDER_ID']);
$CYLINDER_DETAILS = security($_POST['CYLINDER_DETAILS']);
$CYLINDER_TYPE = security($_POST['CONTAINER_TYPE']);
$CYLINDER_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	

$CYLINDER_DATEMODIFIED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$cylinderfetch=mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."'");
$countfetch= mysqli_num_rows($cylinderfetch);
$maintenancefetch=mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."' AND CYLINDER_STATUS = 'throw'");
$countmaintenancefetch= mysqli_num_rows($maintenancefetch);
$drfetch=mysqli_query($link,"select * from dr where CYLINDER_REFERENCEID = '".$CYLINDER_REFERENCEID."' AND DR_STATUS = ''");
$countdrfetch= mysqli_num_rows($drfetch);
if($countmaintenancefetch > 1){
	echo 'maintenance';	

}
elseif($countfetch > 1){
	echo 'duplicate';	
}elseif($countdrfetch > 0){
	echo 'dr';	
}
else{
$query= "update cylinder set CYLINDER_REFERENCEID='$CYLINDER_REFERENCEID',CYLINDER_DETAILS='$CYLINDER_DETAILS',CYLINDER_TYPE='$CYLINDER_TYPE',CYLINDER_DATEMODIFIED ='$CYLINDER_DATEMODIFIED' where CYLINDER_ID='$CYLINDER_ID'";
$result = mysqli_query($link,$query);
if($result){
	$info = "Edited cyinder:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Cylinder Module','Edited cylinder','$info $CYLINDER_REFERENCEID','$CYLINDER_DATEMODIFIED','$CYLINDER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}
?>

<?php 

require_once '../../../basefunction/database_connection.php';
include ('../../../basefunction/timezone.php');
session_start();
$userid = $_SESSION['session_userid'];
$output = array('success' => false, 'messages' => array());
$DR_ID = $_POST['DR_ID'];


$DR_DATEDELETED = date("m-d-Y H:i:s");
$DR_DATEONLY = date("m-d-Y");  
  $select = mysqli_query($link,"select * from dr where DR_ID = {$DR_ID}");
  $fetch = mysqli_fetch_array($select);
  $cyl_id = $fetch['CYLINDER_REFERENCEID'];
   $dr_no = $fetch['DR_NO'];
  $info = "Deleted DR:";
  $info2 = "Deleted Container:";
$cyl = mysqli_query($link,"select CYLINDER_REFERENCEID from cylinder where CYLINDER_REFERENCEID='$cyl_id'");
if(mysqli_num_rows($cyl) > 0){
	 $sql_query="Update cylinder set cylinder.CYLINDER_STATUS='' WHERE cylinder.CYLINDER_REFERENCEID = '$cyl_id'";
$query = $link->query($sql_query);
if($query)
{
	$delete = mysqli_query($link,"delete from dr where DR_ID='{$DR_ID}'");
	if($delete){
	 $audit_query = "insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Deleted direct reciept','$info $dr_no $info2 $cyl_id','$DR_DATEDELETED','$DR_DATEONLY','$userid')";
	 $query_audit = $link->query($audit_query);
	 if($query_audit === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}
}
}

}else{
	 $sql_query="delete from dr where dr.DR_ID='{$DR_ID}'";
$query = $link->query($sql_query);
if($query)
{
	 $audit_query = "insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Deleted direct reciept','$info $dr_no $info2 $cyl_id','$DR_DATEDELETED','$DR_DATEONLY','$userid')";
	 $query_audit = $link->query($audit_query);
	 if($query_audit === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}

}

}



// close database connection
$link->close();

echo json_encode($output);
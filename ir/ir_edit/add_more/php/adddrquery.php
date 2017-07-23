<?php
include "../../../../basefunction/database_connection.php";
include "../../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$IR_NO = security($_POST['IR_NO']);
$select = mysqli_query($link,"select * from ir where IR_NO ='$IR_NO'");
$fetch = mysqli_fetch_array($select);
$CUSTOMER_ID = $fetch['CUSTOMER_ID'];
$IR_RETURNDATE = $fetch['IR_RETURNDATE'];
$IR_DATECREATED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$IR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	

foreach($CYLINDER_REFERENCEID as $j) {
$select_dr = mysqli_query($link,"select * from dr where CYLINDER_REFERENCEID = '$j'");
	while($row_selectdr = mysqli_fetch_array($select_dr)){
			$DR_NUMBER = $row_selectdr['DR_NO'];
$query= "insert into ir(CUSTOMER_ID,CYLINDER_REFERENCEID,IR_NO,DR_NO,IR_RETURNDATE,IR_DATECREATED) VALUES('$CUSTOMER_ID','$j','$IR_NO','$DR_NUMBER','$IR_RETURNDATE','$IR_DATECREATED')";
$result = mysqli_query($link,$query);
}
}
if($result)
{
	foreach ($CYLINDER_REFERENCEID as $REFERENCEID){
		$query2 = mysqli_query($link,"update dr set DR_STATUS='done' where CYLINDER_REFERENCEID = '$REFERENCEID'");

	}
	if($query2){
	$info = "Added Inward Receipt:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('IR Module','Added new direct receipt','$info $IR_NO','$IR_DATECREATED','$IR_DATEONLY','$userid')");
		if($audit_query)
		{
		echo 'done';
		}
	}

}



?>

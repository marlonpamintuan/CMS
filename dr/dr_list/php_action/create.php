<?php 

require_once '../../../basefunction/database_connection.php';
require_once '../../../basefunction/security.php';


session_start();
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

//****************FORM

$userid=$_SESSION['session_userid'];
$DR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
$DATE = date("m-d-Y H:i:s", strtotime('+6 hours'));
$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$DR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['DR_RETURNDATE'])));
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$DR_NO = security($_POST['DR_NO']);
$DR_STARTDATE = security(date('Y-m-d',strtotime($_POST['DR_DATECREATED'])));
$DR_DATECREATED = date("m-d-Y");


$count_dr = mysqli_query($link,"select DR_NO,DR_STATUS from dr where DR_NO ='$DR_NO' AND DR_STATUS != 'inactive' GROUP BY DR_NO");

if(mysqli_num_rows($count_dr)>0){
	$validator['success'] = false;
		$validator['messages'] = "Duplicate DR Number";
}elseif($DR_STARTDATE > $DR_RETURNDATE){
		$validator['success'] = false;
		$validator['messages'] = "Invalid Date";
}else{
	foreach($CYLINDER_REFERENCEID as $j) {

$query= mysqli_query($link,"insert into dr(CUSTOMER_ID,CYLINDER_REFERENCEID,DR_NO,DR_RETURNDATE,DR_STARTDATE,DR_DATECREATED,DR_DATETIME) VALUES('$CUSTOMER_ID','$j','$DR_NO','$DR_RETURNDATE','$DR_STARTDATE','$DR_DATECREATED','$DATE')");
if($query){
	$query2 = mysqli_query($link,"update cylinder set CYLINDER_STATUS='inactive' where CYLINDER_REFERENCEID = '$j'");

}
}
if($query2){
$info = "Added Direct Receipt:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Added new direct receipt','$info $DR_NO','$DATE','$DR_DATEONLY','$userid')");
	if($audit_query){
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";	
}

	}

}





	// close the database connection
	$link->close();

	echo json_encode($validator);

}
<?php
include "../basefunction/database_connection.php";
include "../basefunction/security.php";
include '../basefunction/timezone.php';
session_start();
$userid= $_SESSION['session_userid'];
$TODO_INFO= security($_POST['TODO_INFO']);
$TODO_DATECREATED = date("m-d-Y H:i:s");
$TODO_DATEONLY = date("m-d-Y");

$query= "insert into todo(TODO_INFO,TODO_DATECREATED) VALUES('$TODO_INFO','$TODO_DATECREATED')";
$result = mysqli_query($link,$query);
if($result){
	$info = "Added new task:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Task Module','Added new task','$info $TODO_INFO','$TODO_DATECREATED','$TODO_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}

?>

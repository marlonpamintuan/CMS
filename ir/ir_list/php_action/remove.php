<?php 

require_once 'db_connect.php';
include ('../../../basefunction/timezone.php');
$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];
$IR_DATEDELETED = date("m-d-Y H:i:s");
$sql = "Update ir set IR_STATUS='inactive',IR_DATEDELETED='$IR_DATEDELETED' WHERE IR_ID = {$memberId}";
$query = $link->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully removed';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}

// close database connection
$link->close();

echo json_encode($output);
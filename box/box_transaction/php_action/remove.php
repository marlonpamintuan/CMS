<?php 

require_once '../../../basefunction/database_connection.php';
$output = array('success' => false, 'messages' => array());
$BOXIN_ID = $_POST['BOXIN_ID'];
$sql = "delete from boxin where BOXIN_ID = {$BOXIN_ID}";
$query = $link->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully deleted';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}

// close database connection
$link->close();

echo json_encode($output);
<?php 

require_once '../../../basefunction/database_connection.php';
$output = array('success' => false, 'messages' => array());
$BOXOUT_ID = $_POST['BOXOUT_ID'];
$select = mysqli_query($link,"select * from boxout where BOXOUT_ID = {$BOXOUT_ID}");
$row = mysqli_fetch_array($select);
$BOX = $row['BOXOUT_BOXCODE'];
$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$BOX'");

if($update){
$sql = "delete from boxout where BOXOUT_ID = {$BOXOUT_ID}";
$query = $link->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully deleted';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while removing the member information';
}
}
// close database connection
$link->close();

echo json_encode($output);
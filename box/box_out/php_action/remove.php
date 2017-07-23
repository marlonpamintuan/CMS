<?php 

require_once '../../../basefunction/database_connection.php';
$output = array('success' => false, 'messages' => array());
$TEMP_ID = $_POST['TEMP_ID'];
$select = mysqli_query($link,"select * from temp where TEMP_ID = {$TEMP_ID}");
$row = mysqli_fetch_array($select);
$BOX = $row['TEMP_BOXCODE'];
$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$BOX'");
if($update){
$sql = "delete from temp where TEMP_ID = {$TEMP_ID}";
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
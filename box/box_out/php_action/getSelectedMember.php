<?php 

require_once '../../../basefunction/database_connection.php';
$TEMP_ID = $_POST['TEMP_ID'];
$sql = "SELECT * FROM temp where TEMP_ID='$TEMP_ID'";
$query = $link->query($sql);
$result = $query->fetch_assoc();

$link->close();

echo json_encode($result);


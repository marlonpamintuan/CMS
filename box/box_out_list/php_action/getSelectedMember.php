<?php 

require_once '../../../basefunction/database_connection.php';
$BOXOUT_ID = $_POST['BOXOUT_ID'];
$sql = "SELECT * FROM boxout where BOXOUT_ID='$BOXOUT_ID'";
$query = $link->query($sql);
$result = $query->fetch_assoc();

$link->close();

echo json_encode($result);


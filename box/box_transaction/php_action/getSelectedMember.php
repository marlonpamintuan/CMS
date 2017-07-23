<?php 

require_once '../../../basefunction/database_connection.php';
$BOXIN_ID = $_POST['BOXIN_ID'];
$sql = "SELECT * FROM boxin where BOXIN_ID='$BOXIN_ID'";
$query = $link->query($sql);
$result = $query->fetch_assoc();

$link->close();

echo json_encode($result);


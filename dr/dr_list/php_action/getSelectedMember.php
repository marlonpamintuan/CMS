<?php 

require_once '../../../basefunction/database_connection.php';
$DR_ID = $_POST['DR_ID'];
$sql = "SELECT * FROM dr where DR_ID='$DR_ID'";
$query = $link->query($sql);
$result = $query->fetch_assoc();

$link->close();

echo json_encode($result);


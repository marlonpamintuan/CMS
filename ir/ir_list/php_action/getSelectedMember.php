<?php 

require_once 'db_connect.php';

$memberId = $_POST['member_id'];

$sql = "SELECT * FROM ir WHERE IR_ID = $memberId";
$query = $link->query($sql);
$result = $query->fetch_assoc();

$link->close();

echo json_encode($result);


<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select COUNT(DISTINCT IR_NO) as transaction_count from ir");
$fetch = mysqli_fetch_array($query);
$count = $fetch['transaction_count'];
echo $count;
?>
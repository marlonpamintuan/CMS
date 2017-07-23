<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(DISTINCT DR_NO) as dr_count from dr where DR_STATUS = ''");
$fetch = mysqli_fetch_array($query);
$count = $fetch['dr_count'];
echo $count;
?>
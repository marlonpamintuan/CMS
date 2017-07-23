<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as cylinder_count from cylinder where CYLINDER_STATUS = ''");
$fetch = mysqli_fetch_array($query);
$count = $fetch['cylinder_count'];
echo $count;
?>
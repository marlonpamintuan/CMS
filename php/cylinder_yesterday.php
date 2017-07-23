<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as cylinder_yesterday from trash where TRASH_STATUS = ''");
$fetch = mysqli_fetch_array($query);
$count = $fetch['cylinder_yesterday'];
echo $count;
?>
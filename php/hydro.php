<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as hydro from hydro where HYDRO_STATUS = ''");
$fetch = mysqli_fetch_array($query);
$count = $fetch['hydro'];
echo $count;
?>
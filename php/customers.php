<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as customer_count from customer where CUSTOMER_STATUS != 'inactive'");
$fetch = mysqli_fetch_array($query);
$count = $fetch['customer_count'];
echo $count;
?>
<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as outside from dr inner join customer ON dr.CUSTOMER_ID = customer.CUSTOMER_ID where DR_STATUS = ''");
$fetch = mysqli_fetch_array($query);
$count = $fetch['outside'];
echo $count;
?>
<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"select count(*) as overdue_count from dr inner join customer ON dr.CUSTOMER_ID = customer.CUSTOMER_ID where DR_STATUS = '' and DR_DUE='Overdue'");
$fetch = mysqli_fetch_array($query);
$count = $fetch['overdue_count'];
echo $count;
?>
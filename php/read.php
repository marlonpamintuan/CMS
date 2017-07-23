<?php 
include "../basefunction/database_connection.php";
$query = mysqli_query($link,"update dr set DR_NOTIFICATION='1'");
if($query)
echo 'done';
?>
<?php 
include "../basefunction/database_connection.php";
$check_due =mysqli_query($link,"update dr set DR_DUE='' where DR_RETURNDATE >= CURDATE() and DR_STATUS =''");
if($check_due){

echo '';
	}
?>
<?php
include "../basefunction/database_connection.php";
include "../basefunction/security.php";
$CYLINDER_DATECREATED = date("m-d-Y");
$delete_query = mysqli_query($link,"Delete from cylinder_today where CYLINDER_DATECREATED = '$CYLINDER_DATECREATED'");
if($delete_query){
$delete_query2 = mysqli_query($link,"Delete from dr_temp where DR_DATECREATED = '$CYLINDER_DATECREATED'");
if($delete_query2){
	echo 'done';
}
}

?>

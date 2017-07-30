<?php 
include "../basefunction/database_connection.php";
include '../basefunction/timezone.php';

$check_due =mysqli_query($link,"update dr set DR_DUE='Overdue' where DR_RETURNDATE < CURDATE() and DR_STATUS =''");
if($check_due){
	$select_days = mysqli_query($link,"select * from dr");
	if(mysqli_num_rows($select_days)>0){
	while($row = mysqli_fetch_array($select_days)){
	$SINCE = $row['DR_STARTDATE'];
	$SINCE2 = date_create($SINCE);
	$now = date_create(date("Y-m-d"));
	$DAYS = date_diff($now,$SINCE2);
	$DAYS2 = $DAYS->format("%a");
	
$check_days= mysqli_query($link,"update dr set DR_DAYS = '$DAYS2' where DR_STARTDATE = '$SINCE' and DR_STATUS =''");
	}

		if($check_days){
	echo '';
	}

}

	}
?>
<?php
include "../basefunction/database_connection.php";
include '../basefunction/timezone.php';
$CYLINDER_DATECREATED = date("m-d-Y");
$delete= mysqli_query($link,"DELETE a FROM cylinder_today a inner join cylinder b on a.CYLINDER_REFERENCEID = b.CYLINDER_REFERENCEID WHERE b.CYLINDER_STATUS='inactive' or b.CYLINDER_STATUS='throw' and a.CYLINDER_DATECREATED='$CYLINDER_DATECREATED'");
if($delete)
{
	$delete2= mysqli_query($link,"DELETE FROM cylinder_today WHERE CYLINDER_REFERENCEID NOT IN (SELECT f.CYLINDER_REFERENCEID FROM cylinder f) and CYLINDER_DATECREATED ='$CYLINDER_DATECREATED'");
	if($delete2)
	{
		$query = mysqli_query($link,"select * from cylinder where CYLINDER_STATUS =''");
		while($row = mysqli_fetch_array($query))
		{
		$CYLINDER_REFERENCEID = $row['CYLINDER_REFERENCEID'];
		$CYLINDER_TYPE = $row['CYLINDER_TYPE'];
		$CYLINDER_DETAILS = $row['CYLINDER_DETAILS'];
		$ss = mysqli_query($link,"select * from cylinder_today where CYLINDER_REFERENCEID='$CYLINDER_REFERENCEID' and CYLINDER_DATECREATED='$CYLINDER_DATECREATED'");
			if(mysqli_num_rows($ss) == 0)
			{
			mysqli_query($link,"insert into cylinder_today(CYLINDER_REFERENCEID,CYLINDER_DETAILS,CYLINDER_TYPE,CYLINDER_DATECREATED) values('$CYLINDER_REFERENCEID','$CYLINDER_DETAILS','$CYLINDER_TYPE','$CYLINDER_DATECREATED')");
			}
		}
	}
}




?>

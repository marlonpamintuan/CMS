<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
$userid = $_SESSION['session_userid'];
$BOXOUT_DUTYOPERATOR= security($_POST['BOXOUT_DUTYOPERATOR']);
$BOXOUT_GUARD = security($_POST['BOXOUT_GUARD']);
$BOXOUT_DATE = security(date('m-d-Y',strtotime($_POST['BOXOUT_DATE'])));
$BOXOUT_TIMEOUT = security($_POST['BOXOUT_TIMEOUT']);
$BOXOUT_GATEPASS = security($_POST['BOXOUT_GATEPASS']);
$DATECREATED = date('m-d-Y H:i:s');
/* #IF CLIENTS WANTS DUPLICATION ON GATE PASS ADD ELSE
$count = mysqli_query($link,"select * from boxout where BOXOUT_GATEPASS='$BOXOUT_GATEPASS'");
$count_result = mysqli_num_rows($count);
if($count_result > 0){
	echo 'gate';
}
*/

$query = mysqli_query($link,"select * from temp");
if(mysqli_num_rows($query) > 0)
{
	while($row = mysqli_fetch_array($query))
	{
		$CUSTOMER_ID = $row['CUSTOMER_ID'];
		$TEMP_BOXCODE = $row['TEMP_BOXCODE'];
		$TEMP_DICEWEIGHT = $row['TEMP_DICEWEIGHT'];
		$TEMP_BOXWEIGHT = $row['TEMP_BOXWEIGHT'];
		$TEMP_TOTAL = $row['TEMP_TOTAL'];
		$TEMP_BOXSTATUS = $row['TEMP_BOXSTATUS'];
		$insert = mysqli_query($link,"insert into boxout(BOXOUT_DUTYOPERATOR,BOXOUT_GUARD,CUSTOMER_ID,BOXOUT_BOXCODE,BOXOUT_DICEWEIGHT,BOXOUT_BOXWEIGHT,BOXOUT_TOTAL,BOXOUT_BOXSTATUS,BOXOUT_TIMEOUT,BOXOUT_GATEPASS,BOXOUT_DATE,BOXOUT_DATECREATED) VALUES('$BOXOUT_DUTYOPERATOR','$BOXOUT_GUARD','$CUSTOMER_ID','$TEMP_BOXCODE','$TEMP_DICEWEIGHT','$TEMP_BOXWEIGHT','$TEMP_TOTAL','$TEMP_BOXSTATUS','$BOXOUT_TIMEOUT','$BOXOUT_GATEPASS','$BOXOUT_DATE','$DATECREATED')");
	}
	if($insert)
	{
		$delete = mysqli_query($link,"delete from temp");
		if($delete){
			$info = "Gate pass:";
			$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Box Out Module','Out Box','$info $BOXOUT_GATEPASS','$DATECREATED','$BOXOUT_DATE','$userid')");
		if($audit_query)
		{
		echo 'done';
		}
		}
	}
}
else
{
	echo 'not';
}


?>

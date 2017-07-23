<?php 

require_once '../../../basefunction/database_connection.php';
require_once '../../../basefunction/security.php';


session_start();
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

//****************FORM
date_default_timezone_set('Asia/Manila');
//BOX IN
$BOXIN_BOXCODE = $_POST['BOXIN_BOXCODE'];
$BOXIN_DUTYOPERATOR = $_POST['BOXIN_DUTYOPERATOR'];
$BOXIN_GUARD = $_POST['BOXIN_GUARD'];
$BOXIN_DATE = date('m-d-Y',strtotime($_POST['BOXIN_DATE']));
$BOXIN_TIMEIN = $_POST['BOXIN_TIMEIN'];
$BOXIN_DATECREATED = date('m-d-Y H:i:s');

foreach($BOXIN_BOXCODE as $j) {
$select = mysqli_query($link,"select * from boxout where BOXOUT_BOXCODE='$j'");
while($row = mysqli_fetch_array($select))
{
$CUSTOMER_ID = $row['CUSTOMER_ID'];
$BOXOUT_DICEWEIGHT = $row['BOXOUT_DICEWEIGHT'];
$BOXOUT_BOXWEIGHT = $row['BOXOUT_BOXWEIGHT'];
$BOXOUT_TOTAL = $row['BOXOUT_TOTAL'];
$BOXOUT_BOXSTATUS = $row['BOXOUT_BOXSTATUS'];
$BOXOUT_TIMEOUT = $row['BOXOUT_TIMEOUT'];
$BOXOUT_DUTYOPERATOR = $row['BOXOUT_DUTYOPERATOR'];
$BOXOUT_GUARD = $row['BOXOUT_GUARD'];
$BOXOUT_GATEPASS = $row['BOXOUT_GATEPASS'];
$BOXOUT_DATE = $row['BOXOUT_DATE'];


$insert = mysqli_query($link,"insert into boxin(BOXIN_DUTYOPERATOR,BOXIN_GUARD,BOXIN_DUTYOPERATOROUT,BOXIN_GUARDOUT,CUSTOMER_ID,BOXIN_BOXCODE,BOXIN_DICEWEIGHT,BOXIN_BOXWEIGHT,BOXIN_TOTAL,BOXIN_STATUS,BOXIN_TIMEOUT,BOXIN_TIMEIN,BOXIN_GATEPASS,BOXIN_DATE,BOXIN_DATEOUT,BOXIN_DATECREATED) VALUES('$BOXIN_DUTYOPERATOR','$BOXIN_GUARD','$BOXOUT_DUTYOPERATOR','$BOXOUT_GUARD','$CUSTOMER_ID','$j','$BOXOUT_DICEWEIGHT','$BOXOUT_BOXWEIGHT','$BOXOUT_TOTAL','$BOXOUT_BOXSTATUS','$BOXOUT_TIMEOUT','$BOXIN_TIMEIN','$BOXOUT_GATEPASS','$BOXIN_DATE','$BOXOUT_DATE','$BOXIN_DATECREATED')");
}
}
if($insert)
{
	foreach($BOXIN_BOXCODE as $i) 
	{
		$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$i'");
	}
if($update){
	foreach($BOXIN_BOXCODE as $k) 
	{
		$delete = mysqli_query($link,"delete from boxout where BOXOUT_BOXCODE ='$k'");
	}
	if($delete){
	$validator['success'] = true;
	$validator['messages'] = "Successfully Added";	
}
}
}







	// close the database connection
	$link->close();

	echo json_encode($validator);

}
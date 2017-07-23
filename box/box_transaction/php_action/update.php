<?php 

require_once '../../../basefunction/database_connection.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$BOXIN_ID = $_POST['BOXIN_ID'];
	$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
	$BOXIN_BOXCODE = $_POST['BOXIN_BOXCODE'];
	$BOXIN_DICEWEIGHT = $_POST['BOXIN_DICEWEIGHT'];
	$BOXIN_BOXWEIGHT = $_POST['BOXIN_BOXWEIGHT'];	
	$BOXIN_BOXSTATUS = $_POST['BOXIN_BOXSTATUS'];
	$BOXIN_GATEPASS = $_POST['BOXIN_GATEPASS'];
	$BOXIN_DATEOUT = $_POST['BOXIN_DATEOUT'];
	$BOXIN_TIMEOUT = $_POST['BOXIN_TIMEOUT'];
	$BOXIN_GUARDOUT = $_POST['BOXIN_GUARDOUT'];
	$BOXIN_DUTYOPERATOROUT = $_POST['BOXIN_DUTYOPERATOROUT'];

	$TOTAL = $BOXIN_DICEWEIGHT - $BOXIN_BOXWEIGHT;
	$count = mysqli_query($link,"select * from boxin where BOXIN_GATEPASS='$BOXIN_GATEPASS'");
	$count_result= mysqli_num_rows($count);
	if($count_result > 1)
	{
		$validator['success'] = false;
		$validator['messages'] = "Oops, Can't allow duplicate data";
	
	}
	else{
$sql = "UPDATE BOXIN SET CUSTOMER_ID = '$CUSTOMER_ID', BOXIN_BOXCODE = '$BOXIN_BOXCODE', BOXIN_DICEWEIGHT = '$BOXIN_DICEWEIGHT', BOXIN_BOXWEIGHT = '$BOXIN_BOXWEIGHT', BOXIN_STATUS = '$BOXIN_BOXSTATUS',BOXIN_TOTAL='$TOTAL',BOXIN_GATEPASS='$BOXIN_GATEPASS',BOXIN_DATEOUT='$BOXIN_DATEOUT',BOXIN_TIMEOUT='$BOXIN_TIMEOUT',BOXIN_GUARDOUT='$BOXIN_GUARDOUT',BOXIN_DUTYOPERATOROUT='$BOXIN_DUTYOPERATOROUT' WHERE BOXIN_ID = '$BOXIN_ID'";
	$query = $link->query($sql);

	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully modified information";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}
}

	// close the database connection
	$link->close();

	echo json_encode($validator);

}
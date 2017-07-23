<?php 

require_once '../../../basefunction/database_connection.php';
require_once '../../../basefunction/security.php';
//if form is submitted

if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
	$TEMP_BOXCODE = security($_POST['TEMP_BOXCODE']);
	$TEMP_BOXSTATUS = security($_POST['TEMP_BOXSTATUS']);
	$TEMP_DICEWEIGHT = security($_POST['TEMP_DICEWEIGHT']);
	$TEMP_BOXWEIGHT = security($_POST['TEMP_BOXWEIGHT']);
	$TEMP_TOTAL = $TEMP_DICEWEIGHT - $TEMP_BOXWEIGHT;
	$count = mysqli_query($link,"select * from temp where TEMP_BOXCODE='$TEMP_BOXCODE'");
	$count_result = mysqli_num_rows($count);
	if($TEMP_DICEWEIGHT < $TEMP_BOXWEIGHT)
	{
		$validator['success'] = false;
		$validator['messages'] = "Oops, box weight can't be greater than dry ice weight";
	}
	elseif($count_result > 0)
	{
		$validator['success'] = false;
		$validator['messages'] = "Oops, Duplicate box code, please try another code";
	}
	else
	{

	$sql = "INSERT INTO temp (CUSTOMER_ID,TEMP_BOXCODE,TEMP_DICEWEIGHT,TEMP_BOXWEIGHT,TEMP_TOTAL,TEMP_BOXSTATUS) VALUES ('$CUSTOMER_ID','$TEMP_BOXCODE','$TEMP_DICEWEIGHT','$TEMP_BOXWEIGHT','$TEMP_TOTAL','$TEMP_BOXSTATUS')";
	$query = $link->query($sql);

	if($query) {
	$container = mysqli_query($link,"update cylinder set CYLINDER_STATUS='inactive' where CYLINDER_REFERENCEID='$TEMP_BOXCODE'");
	if($container)
	{
		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";		
		
	}		
		} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}
	}

	// close the database connection
	$link->close();

	echo json_encode($validator);

}
<?php 

require_once '../../../basefunction/database_connection.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$BOXOUT_ID = $_POST['BOXOUT_ID'];
	$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
	$BOXOUT_BOXCODE = $_POST['BOXOUT_BOXCODE'];
	$BOXOUT_DICEWEIGHT = $_POST['BOXOUT_DICEWEIGHT'];
	$BOXOUT_BOXWEIGHT = $_POST['BOXOUT_BOXWEIGHT'];	
	$BOXOUT_BOXSTATUS = $_POST['BOXOUT_BOXSTATUS'];
	$TOTAL = $BOXOUT_DICEWEIGHT - $BOXOUT_BOXWEIGHT;
	//select old
	$old = mysqli_query($link,"select * from boxout where BOXOUT_ID='$BOXOUT_ID'");
	$old_row = mysqli_fetch_array($old);
	$OLD_BOX = $old_row['BOXOUT_BOXCODE'];
	//
	if($OLD_BOX != $BOXOUT_BOXCODE)
	{
		$update = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$OLD_BOX'");
	}
	$count = mysqli_query($link,"select * from boxout where BOXOUT_BOXCODE='$BOXOUT_BOXCODE'");
	$count_result= mysqli_num_rows($count);
	if($count_result > 1)
	{
		$validator['success'] = false;
		$validator['messages'] = "Oops, Can't allow duplicate data";
	
	}
	else{
$sql = "UPDATE boxout,cylinder SET boxout.CUSTOMER_ID = '$CUSTOMER_ID', boxout.BOXOUT_BOXCODE = '$BOXOUT_BOXCODE', boxout.BOXOUT_DICEWEIGHT = '$BOXOUT_DICEWEIGHT', boxout.BOXOUT_BOXWEIGHT = '$BOXOUT_BOXWEIGHT', boxout.BOXOUT_BOXSTATUS = '$BOXOUT_BOXSTATUS',boxout.BOXOUT_TOTAL='$TOTAL',cylinder.CYLINDER_STATUS='inactive' WHERE boxout.BOXOUT_ID = '$BOXOUT_ID' and cylinder.CYLINDER_REFERENCEID='$BOXOUT_BOXCODE'";
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
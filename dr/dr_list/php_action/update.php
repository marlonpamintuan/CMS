<?php 

require_once '../../../basefunction/database_connection.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$EMPLOYEE_ID = $_POST['EMPLOYEE_ID'];
	$EMPLOYEE_FIRSTNAME = $_POST['EMPLOYEE_FIRSTNAME'];
	$EMPLOYEE_LASTNAME = $_POST['EMPLOYEE_LASTNAME'];	
	$EMPLOYEE_CONTACTNUMBER = $_POST['EMPLOYEE_CONTACTNUMBER'];
	$EMPLOYEE_POSITION = $_POST['EMPLOYEE_POSITION'];

$sql = "UPDATE employee SET EMPLOYEE_FIRSTNAME = '$EMPLOYEE_FIRSTNAME',EMPLOYEE_LASTNAME = '$EMPLOYEE_LASTNAME',EMPLOYEE_CONTACTNUMBER = '$EMPLOYEE_CONTACTNUMBER',EMPLOYEE_POSITION = '$EMPLOYEE_POSITION' WHERE EMPLOYEE_ID = '$EMPLOYEE_ID'";
	$query = $link->query($sql);

	if($query === TRUE) {			
		$validator['success'] = true;
		$validator['messages'] = "Successfully modified information";		
	} else {		
		$validator['success'] = false;
		$validator['messages'] = "Error while updating information";
	}

	// close the database connection
	$link->close();

	echo json_encode($validator);

}
<?php
	//This is for the database connection
	include ('../basefunction/database_connection.php');
	//This is for the security of the web
	include ('../basefunction/security.php');
	//This is for the start of the session
	include ('../basefunction/session_start.php');
	
		
	//validation for the value of the session

	//login function

		$logintime = date("m-d-Y H:i:s", strtotime('+7 hours'));		
		$userid = security($_POST['userid']);
		$password = security($_POST['password']);
		
		$query = mysqli_query($link,"SELECT * FROM user WHERE USER_USERNAME = '".$userid."' AND USER_PASSWORD = '".$password."'");
		$numrows = mysqli_num_rows($query);
		if ($numrows!==0) 
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$_SESSION['session_userid'] = $row['USER_USERNAME'];
				$_SESSION['session_accounttype'] = $row['ACCESS_ID'];
				$_SESSION['session_usermodule'] = $row['USER_USERMODULE'];
				$_SESSION['session_salesrepmodule'] = $row['USER_SALESREPMODULE'];
				$_SESSION['session_customermodule'] = $row['USER_CUSTOMERMODULE'];
				$_SESSION['session_itemmodule'] = $row['USER_ITEMMODULE'];
				$_SESSION['session_unitmeasuremodule'] = $row['USER_UNITMEASUREMODULE'];
				$_SESSION['session_paymentmodule'] = $row['USER_PAYMENTMODULE'];
				$_SESSION['session_transactionmodule'] = $row['USER_TRANSACTIONMODULE'];
			}
			//Location Depends on the User Type
		
			echo 'Login';
				exit();
			
		    }
	

?>


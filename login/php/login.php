<?php
	//This is for the database connection
	include ('../../basefunction/database_connection.php');
	//This is for the security of the web
	include ('../../basefunction/security.php');
	//This is for the start of the session
	
		
	//validation for the value of the session

	//login function

		$logintime = date("m-d-Y H:i:s", strtotime('+6 hours'));
		$login_dateonly = date("m-d-Y", strtotime('+6 hours'));		
		$USER_USERNAME = security($_POST['USER_USERNAME']);
		$USER_PASSWORD = security($_POST['USER_PASSWORD']);
		
		$query = mysqli_query($link,"SELECT * FROM user WHERE USER_USERNAME = '".$USER_USERNAME."' and USER_STATUS =''");
		$numrows = mysqli_num_rows($query);
		if($numrows == 0){
		echo 'no';
		exit();
		}
		else
		{
		$row = mysqli_fetch_array($query);
		session_start();
		$_SESSION['session_userid'] = $row['USER_ID'];
		$userid = $_SESSION['session_userid'];
		$_SESSION['session_firstname'] = $row['USER_FIRSTNAME'];
		$_SESSION['session_middlename'] = $row['USER_MIDDLENAME'];
		$_SESSION['session_lastname'] = $row['USER_LASTNAME'];
		$_SESSION['session_EMAIL'] = $row['USER_EMAIL'];
		$_SESSION['session_username'] = $row['USER_USERNAME'];
		$username = $_SESSION['session_username'];
		$_SESSION['session_password'] = $row['USER_PASSWORD'];
		$_SESSION['session_access'] = $row['USER_ACCESS'];
		$_SESSION['timestamp'] = time();
		$PASSWORD = $row['USER_PASSWORD'];
			
		$verify= password_verify($USER_PASSWORD,$PASSWORD);
		if($verify){
		$info = "Username:";
		$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Login Module','Logged in','$info $username','$logintime','$login_dateonly','$userid')");
	
			//Location Depends on the User Type
		if($_SESSION['session_access']=="super admin" || $_SESSION['session_access']=="admin")
		{

		echo 'Login';
		exit();
		}
			
		}else{
		echo 'no';
		exit();
		}
			
			
		}
	

?>


<?php
	//This is for the start of the session
	include ('session_start.php');
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location:..");
	}
?>

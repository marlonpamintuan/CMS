<?php 
	include ('database_connection.php');
session_start();
	if(!isset($_SESSION['session_userid']) || empty($_SESSION['session_userid'])) {
		header("location: ../");
		exit();
	}
	if($_SESSION['session_access'] === "customer") {
		header("location: ../");
		exit();
	}
	
?>
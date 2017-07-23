<?php
	function security($data)
	{
		include ('database_connection.php');
		$data = trim($data);
		$data = strip_tags($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($link, $data);
		return $data;
	}
?>
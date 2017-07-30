<?php
include "../basefunction/database_connection.php";
include "../basefunction/security.php";
include '../basefunction/timezone.php';

$TODO_INFO= security($_POST['TODO_INFO']);
$TODO_DATECREATED = date("m-d-Y H:i:s");
$query= "insert into todo(TODO_INFO,TODO_DATECREATED) VALUES('$TODO_INFO','$TODO_DATECREATED')";
$result = mysqli_query($link,$query);
if($result){
echo 'done';
}

?>

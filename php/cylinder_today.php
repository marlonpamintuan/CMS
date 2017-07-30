<?php
include "../basefunction/database_connection.php";
include "../basefunction/security.php";
include '../basefunction/timezone.php';
$CYLINDER_DATECREATED2 = date("m-d-Y");
$CONTAINER_DATE = $_POST['CONTAINER_DATE'];
$CONTAINER_DATE2 = date('m-d-Y',strtotime($CONTAINER_DATE));
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$select = mysqli_query($link,"select * from cylinder_today where CYLINDER_DATECREATED = '$CONTAINER_DATE2'");
if(mysqli_num_rows($select)>0){

echo "exist";
}
else{
foreach($CYLINDER_REFERENCEID as $j) {
	$select = mysqli_query($link,"select * from cylinder where CYLINDER_REFERENCEID='$j' and CYLINDER_STATUS !='deleted'");
	while($row = mysqli_fetch_array($select)){
		$CYLINDER_DETAILS = $row['CYLINDER_DETAILS'];
			$CYLINDER_TYPE = $row['CYLINDER_TYPE'];
		$insert_query = mysqli_query($link,"insert into cylinder_today(CYLINDER_REFERENCEID,CYLINDER_DETAILS,CYLINDER_TYPE,CYLINDER_DATECREATED) VALUES('$j','$CYLINDER_DETAILS','$CYLINDER_TYPE','$CONTAINER_DATE2')");
	}

}
if($insert_query){
echo 'done';
}


}





?>

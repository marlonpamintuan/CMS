<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$IR_NO = security($_POST['IR_NO']);
$IR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$IR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['IR_RETURNDATE'])));
$IR_RETURNDATE2 = date_create($IR_RETURNDATE);
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$IR_DATECREATED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$TRANSACTION_DATECREATED = date("m-d-Y H:i:s", strtotime('+6 hours'));
$count_dr = mysqli_query($link,"select IR_NO,IR_STATUS from ir where IR_NO ='$IR_NO' and IR_STATUS !='inactive'");
foreach ($CYLINDER_REFERENCEID as $cyl) {
$validity = mysqli_query($link,"select * from dr where CUSTOMER_ID='$CUSTOMER_ID' and CYLINDER_REFERENCEID='$cyl'");
}
if(mysqli_num_rows($validity)<=0){
echo 'not';
}
elseif(mysqli_num_rows($count_dr)>0){
echo 'ir';
}else{
foreach ($CYLINDER_REFERENCEID as $j) {
	$select_dr = mysqli_query($link,"select * from dr where CYLINDER_REFERENCEID = '$j' and DR_STATUS =''");
	while($row_selectdr = mysqli_fetch_array($select_dr)){
			$DR_NUMBER = $row_selectdr['DR_NO'];
				$query= "insert into ir(IR_NO,DR_NO,CUSTOMER_ID,CYLINDER_REFERENCEID,IR_RETURNDATE,IR_DATECREATED) VALUES('$IR_NO','$DR_NUMBER','$CUSTOMER_ID','$j','$IR_RETURNDATE','$IR_DATECREATED')";
				$result = mysqli_query($link,$query);
			
			}
}

if($result){
	foreach ($CYLINDER_REFERENCEID as $REFERENCEID){
	$query2 = mysqli_query($link,"update dr set DR_STATUS='done' where CYLINDER_REFERENCEID = '$REFERENCEID'");
	}
	if($query2){
	foreach ($CYLINDER_REFERENCEID as $REFERENCEID2){	
	$query3 = mysqli_query($link,"update cylinder set CYLINDER_STATUS='' where CYLINDER_REFERENCEID='$REFERENCEID2'");
	}
	if($query3){
		$info = "Added Inward Receipt:";
		$info2 = "Container:";
	
			$items = array();
		foreach($CYLINDER_REFERENCEID as $i){
			$items[] = $i;
		}
		$container = implode(',',$items);
	
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('IR Module','Added inward receipt','$info $IR_NO $info2 $container','$IR_DATECREATED','$IR_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

	}
	}

}
	

}
?>

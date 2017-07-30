<?php
include "../../../../basefunction/database_connection.php";
include "../../../../basefunction/security.php";
include ('../../../../basefunction/timezone.php');
session_start();
$userid=$_SESSION['session_userid'];
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$DR_DATEONLY = date("m-d-Y");	
$DR_NO = security($_POST['DR_NO']);
$select = mysqli_query($link,"select * from dr where DR_NO ='$DR_NO'");
$fetch = mysqli_fetch_array($select);
$CUSTOMER_ID = $fetch['CUSTOMER_ID'];
$DR_STARTDATE = $fetch['DR_STARTDATE'];
$DR_RETURNDATE = $fetch['DR_RETURNDATE'];
$DR_DUE = $fetch['DR_DUE'];
$DR_DATECREATED = date("m-d-Y H:i:s");

if(isset($_POST['track'])){
if($DR_STARTDATE > $DR_RETURNDATE){
	echo 'date';
}else{
	foreach($CYLINDER_REFERENCEID as $j) {
$query= "insert into dr(CUSTOMER_ID,CYLINDER_REFERENCEID,DR_NO,DR_RETURNDATE,DR_STARTDATE,DR_DUE,DR_DATECREATED,DR_DATETIME) VALUES('$CUSTOMER_ID','$j','$DR_NO','$DR_RETURNDATE','$DR_STARTDATE','$DR_DUE','$DR_DATEONLY','$DR_DATECREATED')";
$result = mysqli_query($link,$query);

if($result){
	$query2 = mysqli_query($link,"update cylinder set CYLINDER_STATUS='inactive' where CYLINDER_REFERENCEID = '$j'");



}
}
if($query2){
$info = "Added Direct Receipt:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('DR Module','Added new direct receipt','$info $DR_NO','$DR_DATECREATED','$DR_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}

	}
}
}else{
?>
<table class="table table-responsive table-bordered table-collapsed" >
<tr>

<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Container</strong></td>
<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Customer</strong></td>
<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Returned Date</strong></td>
<?php
foreach($CYLINDER_REFERENCEID as $j) {
$ir = mysqli_query($link,"select t.CYLINDER_REFERENCEID, t.CUSTOMER_ID, t.IR_RETURNDATE from ir t inner join (select CYLINDER_REFERENCEID, max(IR_RETURNDATE) as MaxDate from ir group by CYLINDER_REFERENCEID) tm on t.CYLINDER_REFERENCEID = tm.CYLINDER_REFERENCEID and t.IR_RETURNDATE = tm.MaxDate where t.CYLINDER_REFERENCEID='$j'");
while($row = mysqli_fetch_array($ir)){
$CUSTOMER = $row['CUSTOMER_ID'];
$cylinder = $row['CYLINDER_REFERENCEID'];
$IR_RETURNDATE = $row['IR_RETURNDATE'];
$select = mysqli_query($link,"select * from customer where CUSTOMER_ID = '$CUSTOMER'");
$fetch_customer = mysqli_fetch_array($select);
$select_name = $fetch_customer['CUSTOMER_NAME'];
?>
<tr>

<td style="color:black;font-size:12px" class="bg-danger text-center"><strong><?php echo $cylinder; ?></strong></td>
<td style="color:black;font-size:12px" class="bg-danger text-center"><strong><?php echo $select_name; ?></strong></td>
<td style="color:black;font-size:12px" class="bg-danger text-center"><strong><?php echo $IR_RETURNDATE; ?></strong></td>

</tr>

<?php
}
}
?><table><?php

}

?>

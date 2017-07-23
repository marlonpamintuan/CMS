<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
session_start();
$userid=$_SESSION['session_userid'];
$DR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	

$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$DR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['DR_RETURNDATE'])));
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$DR_NO = security($_POST['DR_NO']);
$DR_STARTDATE = security(date('Y-m-d',strtotime($_POST['DR_DATECREATED'])));
$DR_DATECREATED = security(date('m-d-Y',strtotime($_POST['DR_TRANSACTION_DATECREATED'])));
if(isset($_POST['track'])){
$count_dr = mysqli_query($link,"select * from dr where DR_NO ='$DR_NO'");
if(mysqli_num_rows($count_dr)>0){
echo 'dr';	
}elseif($DR_STARTDATE > $DR_RETURNDATE){
	echo 'date';
}else{
	foreach($CYLINDER_REFERENCEID as $j) {
$query= "insert into dr(CUSTOMER_ID,CYLINDER_REFERENCEID,DR_NO,DR_RETURNDATE,DR_STARTDATE,DR_DATECREATED) VALUES('$CUSTOMER_ID','$j','$DR_NO','$DR_RETURNDATE','$DR_STARTDATE','$DR_DATECREATED')";
$result = mysqli_query($link,$query);

if($result){
	$query2 = mysqli_query($link,"update cylinder set CYLINDER_STATUS='inactive' where CYLINDER_REFERENCEID = '$j'");

if($query2){
$check_due =mysqli_query($link,"update dr set DR_DUE='Overdue' where DR_RETURNDATE < CURDATE()");
if($check_due){
	$select_days = mysqli_query($link,"select * from dr");
	if(mysqli_num_rows($select_days)>0){
	while($row = mysqli_fetch_array($select_days)){
	
	$SINCE = $row['DR_STARTDATE'];
	$SINCE2 = date_create($SINCE);
	$now = date_create(date("Y-m-d"));
	$DAYS = date_diff($now,$SINCE2);
	$DAYS2 = $DAYS->format("%a");
	
$check_days= mysqli_query($link,"update dr set DR_DAYS = '$DAYS2' where DR_STARTDATE = '$SINCE'");
	}
}
		

}

	}

}
}if($check_days){
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
$ir = mysqli_query($link,"select t.CYLINDER_REFERENCEID, t.CUSTOMER_ID, t.IR_RETURNDATE from ir t inner join (select CYLINDER_REFERENCEID, max(IR_RETURNDATE) as MaxDate from ir group by CYLINDER_REFERENCEID) tm on t.CYLINDER_REFERENCEID = tm.CYLINDER_REFERENCEID and t.IR_RETURNDATE = tm.MaxDate where t.CYLINDER_REFERENCEID='$j' AND t.IR_STATUS =''");
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

<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include '../../../basefunction/timezone.php';
session_start();
$userid = $_SESSION['session_userid'];
$CUSTOMER_ID = security($_POST['CUSTOMER_IDS']);
$CYLINDER_REFERENCEID = security($_POST['CYLINDER_REFERENCEIDS']);
$TRANSACTION_DRDATE = security(date('Y-m-d',strtotime($_POST['TRANSACTION_DRDATE'])));
$TRANSACTION_DRDATE2 = date_create($TRANSACTION_DRDATE);
$TRANSACTION_DUEDATE = security(date('Y-m-d',strtotime($_POST['TRANSACTION_DUEDATE'])));
$TRANSACTION_IRDATE = security(date('Y-m-d',strtotime($_POST['TRANSACTION_IRDATE'])));
$TRANSACTION_IRDATE2 = date_create($TRANSACTION_IRDATE);
$TRANSACTION_IRNO = security($_POST['TRANSACTION_IRNO']);
$TRANSACTION_DATEMODIFIED = date("m-d-Y H:i:s");
$DAYS=date_diff($TRANSACTION_IRDATE2,$TRANSACTION_DRDATE2);
$TRANSACTION_DAYS = $DAYS->format("%a");

$query= "update transaction set CUSTOMER_ID='$CUSTOMER_ID',CYLINDER_ID='$CYLINDER_REFERENCEID',TRANSACTION_DRDATE='$TRANSACTION_DRDATE',TRANSACTION_DUEDATE='$TRANSACTION_DUEDATE',TRANSACTION_IRDATE ='$TRANSACTION_IRDATE',TRANSACTION_DAYS ='$TRANSACTION_DAYS',TRANSACTION_DATEMODIFIED ='$TRANSACTION_DATEMODIFIED' where TRANSACTION_IRNO='$TRANSACTION_IRNO'";
$result = mysqli_query($link,$query);
if($result){
$info = "Customer:";
$info2 = "Container:";
$comma=",";
$select = mysqli_query($link,"select * from customer where CUSTOMER_ID = '$CUSTOMER_ID'");
$fetch = mysqli_fetch_array($select);
$customer = $fetch['CUSTOMER_NAME'];
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_USER) VALUES('Transaction Module','Edited transaction','$info $customer $comma $info2 $CYLINDER_REFERENCEID','$TRANSACTION_DATEMODIFIED','$userid')");
	if($audit_query){
echo 'done';
}

}

?>

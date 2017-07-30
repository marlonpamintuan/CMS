<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
include ('../../../basefunction/timezone.php');
session_start();
error_reporting(0);
$userid= $_SESSION['session_userid'];
$CUSTOMER_NAME = security($_POST['CUSTOMER_NAME']);
$CUSTOMER_CONTACTNUMBER = security($_POST['CUSTOMER_CONTACTNUMBER']);
$CUSTOMER_EMAIL = security($_POST['CUSTOMER_EMAIL']);
$CUSTOMER_ADDRESS = security($_POST['CUSTOMER_ADDRESS']);
$CUSTOMER_DATECREATED = date("m-d-Y H:i:s");
$CUSTOMER_DATEONLY = date("m-d-Y");	
$customerfetch=mysqli_query($link,"select * from customer where CUSTOMER_CONTACTNUMBER = '".$CUSTOMER_CONTACTNUMBER."'");
$countfetch= mysqli_num_rows($customerfetch);
$emailfetch=mysqli_query($link,"select * from customer where CUSTOMER_EMAIL = '".$CUSTOMER_EMAIL."' ");
$countemail= mysqli_num_rows($emailfetch);
$select = mysqli_query($link,"select * from customer");

	if($countfetch > 0 && $CUSTOMER_CONTACTNUMBER != ''){
	echo 'duplicate';	
	}elseif($countemail && $CUSTOMER_EMAIL !=''){
    echo 'email';
	}else{
	$query= "insert into customer(CUSTOMER_NAME,CUSTOMER_CONTACTNUMBER,CUSTOMER_EMAIL,CUSTOMER_ADDRESS,CUSTOMER_DATECREATED) VALUES('$CUSTOMER_NAME','$CUSTOMER_CONTACTNUMBER','$CUSTOMER_EMAIL','$CUSTOMER_ADDRESS','$CUSTOMER_DATECREATED')";
$result = mysqli_query($link,$query);
if($result){
	$info = "Added customer:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Customer Module','Added new customer','$info $CUSTOMER_NAME','$CUSTOMER_DATECREATED','$CUSTOMER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}

?>

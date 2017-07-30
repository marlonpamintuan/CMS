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
$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$CUSTOMER_DATEMODIFIED = date("m-d-Y H:i:s");
$CUSTOMER_DATEONLY = date("m-d-Y");	

$userfetch=mysqli_query($link,"select * from customer where CUSTOMER_NAME= '".$CUSTOMER_NAME."'");
$countfetch= mysqli_num_rows($userfetch);
$emailfetch=mysqli_query($link,"select * from customer where CUSTOMER_EMAIL = '".$CUSTOMER_EMAIL."' ");
$countemail= mysqli_num_rows($emailfetch);

if($countfetch > 1){
	echo 'duplicate';	
}elseif($countemail > 1 && $CUSTOMER_EMAIL !=''){
    echo 'email';

}
else{
$query= "update customer set CUSTOMER_NAME='$CUSTOMER_NAME',CUSTOMER_CONTACTNUMBER='$CUSTOMER_CONTACTNUMBER',CUSTOMER_EMAIL='$CUSTOMER_EMAIL',CUSTOMER_ADDRESS='$CUSTOMER_ADDRESS',CUSTOMER_DATEMODIFIED ='$CUSTOMER_DATEMODIFIED' where CUSTOMER_ID='$CUSTOMER_ID'";
$result = mysqli_query($link,$query);
if($result){
$info = "Edited customer:";
	$audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Customer Module','Edited customer','$info $CUSTOMER_NAME','$CUSTOMER_DATEMODIFIED','$CUSTOMER_DATEONLY','$userid')");
	if($audit_query){
echo 'done';
}
}
}
?>

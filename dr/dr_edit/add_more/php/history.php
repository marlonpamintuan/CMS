<?php
	include ('../../../basefunction/database_connection.php');
	//This is for the security of the web
	include ('../../../basefunction/security.php');

$history = security($_POST['history']);
$query = mysqli_query($link,"select * from ir where CYLINDER_REFERENCEID = '$history' ORDER BY IR_RETURNDATE DESC LIMIT 1");
if(mysqli_num_rows($query)==0){
echo 'no';
}else{
$row = mysqli_fetch_array($query);
$CUSTOMER = $row['CUSTOMER_ID'];
$IR_RETURNDATE = $row['IR_RETURNDATE'];
$select = mysqli_query($link,"select * from customer where CUSTOMER_ID = '$CUSTOMER'");
$fetch_customer = mysqli_fetch_array($select);
$select_name = $fetch_customer['CUSTOMER_NAME'];
?>

<table class="table table-responsive table-bordered table-collapsed" >
<tr>
<td style="color:black; width:50%;" class="bg-success"><strong>Customer</strong></td>
<td style="color:black;" class="bg-success"><strong>Returned Date</strong></td>

</tr>
<tr>
<td style="color:black;" class="bg-warning"><strong><?php echo $select_name; ?></strong></td>

<td style="color:black;" class="bg-warning"><strong><?php echo $IR_RETURNDATE; ?></strong></td>

</tr>
</table>

<br>

<?php

}

?>
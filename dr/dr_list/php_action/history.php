<?php 

require_once '../../../basefunction/database_connection.php';
require_once '../../../basefunction/security.php';
error_reporting(0);
$DR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));	
$DATE = date("m-d-Y H:i:s", strtotime('+6 hours'));
$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$DR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['DR_RETURNDATE'])));
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$DR_NO = security($_POST['DR_NO']);
$DR_STARTDATE = security(date('Y-m-d',strtotime($_POST['DR_DATECREATED'])));
$DR_DATECREATED = date("m-d-Y");
?><hr style="border-top: solid 5px #ffefd5;">
<table class="table table-responsive table-bordered table-collapsed" >
<tr>

<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Container</strong></td>
<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Customer</strong></td>
<td style="color:white;font-size:12px; width:33%;" class="bg-primary text-center"><strong>Returned Date</strong></td>
</tr>
<?php
foreach($CYLINDER_REFERENCEID as $i) {
$ir = mysqli_query($link,"select t.CYLINDER_REFERENCEID, t.CUSTOMER_ID, t.IR_RETURNDATE from ir t inner join (select CYLINDER_REFERENCEID, max(IR_RETURNDATE) as MaxDate from ir group by CYLINDER_REFERENCEID) tm on t.CYLINDER_REFERENCEID = tm.CYLINDER_REFERENCEID and t.IR_RETURNDATE = tm.MaxDate where t.CYLINDER_REFERENCEID='$i' AND t.IR_STATUS =''");
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
?><table>

<?php
?>
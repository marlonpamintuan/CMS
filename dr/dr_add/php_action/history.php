<?php 

require_once '../../../basefunction/database_connection.php';
require_once '../../../basefunction/security.php';
include ('../../../basefunction/timezone.php');
error_reporting(0);
$DR_DATEONLY = date("m-d-Y");	
$DATE = date("m-d-Y H:i:s");
$CUSTOMER_ID = security($_POST['CUSTOMER_ID']);
$DR_RETURNDATE = security(date('Y-m-d',strtotime($_POST['DR_RETURNDATE'])));
$CYLINDER_REFERENCEID = $_POST['CYLINDER_REFERENCEID'];
$DR_NO = security($_POST['DR_NO']);
$DR_STARTDATE = security(date('Y-m-d',strtotime($_POST['DR_DATECREATED'])));
$DR_DATECREATED = date("m-d-Y");
?>
    <div class="row">
        <div class="col-xs-12">
        

          <div class="box box-success">
           <div class="box-header with-border">
          <h3 class="box-title pull-right">
       &nbsp;
          </h3>   <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
          </div><br>
            <!-- /.box-header -->
            <div class="box-body">
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
?></table></div></div></div></div>

<?php
?>
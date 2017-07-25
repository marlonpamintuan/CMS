<html>
<head>

</head>
<body>
<?php
include "../../../basefunction/database_connection.php";
include "../../../basefunction/security.php";
$date = security(date('m-d-Y',strtotime($_POST['date'])));
$query = mysqli_query($link,"select * from audittrail inner join user ON audittrail.AUDITTRAIL_USER = user.USER_ID where audittrail.AUDITTRAIL_DATEONLY = '$date'");
if(mysqli_num_rows($query) < 0){
echo 'done';
}else{
?>
  <table id="example1" class="datatable table table-hover table-striped table-condensed" >
    <thead>
			<tr>
        <th class="bg-primary">MODULE</th>
        <th class="bg-primary">ACTION</th>
        <th class="bg-primary">INFORMATION</th>
        <th class="bg-primary">DATE AND TIME</th>
        <th class="bg-primary">SYSTEM USER</th>           
			</tr>
    </thead>
      <tbody>
         <?php
            while($row = mysqli_fetch_array($query)){
                $AUDITTRAIL_ACTIVITY = $row['AUDITTRAIL_ACTIVITY'];
                $AUDITTRAIL_ACTION = $row['AUDITTRAIL_ACTION'];
                $AUDITTRAIL_INFO = $row['AUDITTRAIL_INFO'];
                $AUDITTRAIL_DATE = $row['AUDITTRAIL_DATE'];
                $AUDITTRAIL_USER = $row['USER_FIRSTNAME'].' '.$row['USER_MIDDLENAME'].' '.$row['USER_LASTNAME'];
        ?>
        <tr>     
          <td><?php echo $AUDITTRAIL_ACTIVITY; ?></td>
          <td><?php echo $AUDITTRAIL_ACTION; ?></td>
          <td><?php echo $AUDITTRAIL_INFO; ?></td>
          <td><?php echo $AUDITTRAIL_DATE; ?></td>

          <td><?php echo $AUDITTRAIL_USER; ?></td>
        </tr>
        <?php
            }


?>
                </tbody>
                <tfoot>
                <tr>
        <th></th>
       <th></th>
        <th></th>
          <th></th>
        <th></th>       
                
				  </tr>
        </tfoot>
  </table>
  <hr>
            
<?php

}
?>


<script src="../../dist/js/dt.js"></script>
</body>
</html>
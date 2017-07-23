<?php 

require_once '../../../basefunction/database_connection.php';

$output = array('data' => array());

$sql = "select * from dr inner join customer ON dr.CUSTOMER_ID = customer.CUSTOMER_ID where dr.DR_STATUS = '' ORDER BY DR_NO ASC";
$query = $link->query($sql);


while ($row = $query->fetch_assoc()) {
$STATUS="";
$SINCE = $row['DR_STARTDATE'];
$SINCE2 = date_create($SINCE);
$DUE = $row['DR_RETURNDATE'];
$now = date_create(date("Y-m-d"));
$today = date("Y-m-d");
$DAYS = date_diff($now,$SINCE2);
$DAYS_CONVERT = $DAYS->format("%a");
if($today > $DUE){
  $STATUS = "Overdue";
}
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	 <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	 
	    <li><a type="button" href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['DR_ID'].')"> <span class="glyphicon glyphicon-trash text-danger"></span> Delete</a></li>	    
	 
	  </ul>
	</div>
		';

	$output['data'][] = array(
		$actionButton,
		$row['DR_NO'],
		$row['CUSTOMER_NAME'],
		$row['DR_STARTDATE'],
		$row['CYLINDER_REFERENCEID'],
		$row['DR_RETURNDATE'],
		$DAYS_CONVERT,
		$STATUS,
		$row['DR_DATETIME'],
	);

}

// database connection close
$link->close();

echo json_encode($output);
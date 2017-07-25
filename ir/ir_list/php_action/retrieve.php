<?php 

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "select * from ir inner join customer ON ir.CUSTOMER_ID = customer.CUSTOMER_ID where ir.IR_STATUS =''";


$query = $link->query($sql);

while ($row = $query->fetch_assoc()) {


	$actionButton = '<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
      <span class="caret"></span></button>
    <ul class="dropdown-menu">
   
     <li class="">	<a href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['IR_ID'].')"> <span class="glyphicon glyphicon-trash"></span>Delete</a></li>
  </ul>
</div>

		';

	$output['data'][] = array(
		$actionButton,
		$row['IR_NO'],
		$row['DR_NO'],
		$row['CUSTOMER_NAME'],
		$row['CYLINDER_REFERENCEID'],
		$row['IR_RETURNDATE'],
		$row['IR_DATECREATED']
		
		
	);


}

// database connection close
$link->close();

echo json_encode($output);
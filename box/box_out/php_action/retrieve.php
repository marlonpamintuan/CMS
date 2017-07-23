<?php 

require_once '../../../basefunction/database_connection.php';

$output = array('data' => array());
$sql = "SELECT * FROM temp inner join customer ON temp.CUSTOMER_ID=customer.CUSTOMER_ID";
$query = $link->query($sql);


while ($row = $query->fetch_assoc()) {
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	 <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
 
	    <li><a type="button" href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['TEMP_ID'].')"> <span class="glyphicon glyphicon-trash text-danger"></span> Delete</a></li>	    
	 
	  </ul>
	</div>
		';
//  <li><a type="button" href=""  data-toggle="modal" data-target="#deliveryMemberModal" onclick="delivery('.$row['BOOKING_ID'].')"> <span class="fa fa-spinner"></span> For-Delivery</a></li>		
	$output['data'][] = array(
		$actionButton,
		$row['CUSTOMER_NAME'],
		$row['TEMP_BOXCODE'],
		$row['TEMP_DICEWEIGHT'],
		$row['TEMP_BOXWEIGHT'],
		$row['TEMP_TOTAL'],
		$row['TEMP_BOXSTATUS']
	
		
		
	);

}

// database connection close
$link->close();

echo json_encode($output);
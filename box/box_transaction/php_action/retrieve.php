<?php 

require_once '../../../basefunction/database_connection.php';

$output = array('data' => array());

$sql = "SELECT * FROM boxin inner join customer ON boxin.CUSTOMER_ID=customer.CUSTOMER_ID";
$query = $link->query($sql);


while ($row = $query->fetch_assoc()) {
	$actionButton = '
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	 <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
    <li><a href="" type="button" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['BOXIN_ID'].')"> <span class="fa fa-edit text-info"></span>Edit</a></li>

	        
	    <li><a type="button" href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['BOXIN_ID'].')"> <span class="glyphicon glyphicon-trash text-danger"></span> Delete</a></li>	    
	 
	  </ul>
	</div>
		';
//  <li><a type="button" href=""  data-toggle="modal" data-target="#deliveryMemberModal" onclick="delivery('.$row['BOOKING_ID'].')"> <span class="fa fa-spinner"></span> For-Delivery</a></li>		
	$output['data'][] = array(
		$actionButton,
		$row['BOXIN_RDI'],
		$row['CUSTOMER_NAME'],
			$row['BOXIN_BOXCODE'],
			$row['BOXIN_TOTAL'],
				$row['BOXIN_STATUS'],
		$row['BOXIN_DUTYOPERATOR'],
		$row['BOXIN_GUARD'],
		$row['BOXIN_DATE'],
		$row['BOXIN_TIMEIN']
		
		
	);

}

// database connection close
$link->close();

echo json_encode($output);
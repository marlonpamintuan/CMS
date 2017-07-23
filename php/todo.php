<?php 
include "../basefunction/database_connection.php";
$check_due = mysqli_query($link,"select * from todo");

if(mysqli_num_rows($check_due)>0){
while($row = mysqli_fetch_array($check_due)){
	$TODO_ID = $row['TODO_ID'];
$TODO_INFO = $row['TODO_INFO'];
$TODO_DATECREATED = $row['TODO_DATECREATED'];

echo '    
 <li style="background:whitesmoke;padding:10px; border-radius:0px; border-left:4px solid #367fa9; border-bottom:solid 5px white;">
                  <!-- drag handle -->
                      <span>
                     <a href="javascript:delete_id('.$TODO_ID.')"> <i class="text-danger fa fa-trash"></i></a>
                      
                      </span>&nbsp;
                  <!-- checkbox -->
                  <!-- todo text -->
                  <span class="text">&nbsp;&nbsp;<strong>'.strtoupper($TODO_INFO).'</strong></span>  <!-- General tools such as edit or delete-->
              
                  <!-- Emphasis label -->
                  <small class="label label-info pull-right"><i class="fa fa-clock-o"></i>&nbsp;'.$TODO_DATECREATED.'</small>
                
                </li>';
}
}elseif(mysqli_num_rows($check_due) <= 0){
	echo '
	 			<li style="overflow:hidden;background:whitesmoke;padding:10px; border-radius:0px; border-left:4px solid #367fa9; border-bottom:solid 5px white;">
                  <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  
                  <!-- todo text -->
                  <span class="text"> YOU DON\'T HAVE ANY TASK YET</span>
                  <!-- Emphasis label -->
                  
                </li>';
}
?>
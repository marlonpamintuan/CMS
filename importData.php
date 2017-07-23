<?php
//load the database configuration file
include "basefunction/database_connection.php";
session_start();
$userid = $_SESSION['session_userid'];
date_default_timezone_set('UTC');
        $upload_date= date("m-d-Y H:i:s", strtotime('+6 hours'));
        $upload_dateonly = date("m-d-Y",strtotime('+6 hours'));    
if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //check whether member already exists in database with same email
                $prevQuery = "SELECT * FROM dr WHERE CYLINDER_REFERENCEID = '".$line[1]."' and DR_STATUS=''";
                $prevResult = $link->query($prevQuery);
                    $cylQuery = "SELECT * FROM cylinder WHERE CYLINDER_REFERENCEID = '".$line[1]."' and CYLINDER_STATUS=''";
                $cylResult = $link->query($cylQuery);
                if($prevResult->num_rows > 0){
                    //update member data
               $qstring = '?status=succ';
             
                }elseif($cylResult->num_rows > 0){
                    //update member data
               $update = "update cylinder set CYLINDER_STATUS='inactive' where CYLINDER_REFERENCEID='".$line[1]."'";
                $updateresult = $link->query($update);
                   $link->query("INSERT INTO dr (CUSTOMER_ID, CYLINDER_REFERENCEID, DR_NO, DR_STARTDATE, DR_RETURNDATE, DR_DATECREATED, DR_DATETIME) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$upload_dateonly."','".$upload_dateonly."')");
                }else{
                    //insert member data into database
                    $link->query("INSERT INTO dr (CUSTOMER_ID, CYLINDER_REFERENCEID, DR_NO, DR_STARTDATE, DR_RETURNDATE, DR_DATECREATED,DR_DATETIME) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$upload_dateonly."','".$upload_date."')");
                    
        $audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_DATEONLY,AUDITTRAIL_USER) VALUES('Beginning Balance Module','Uploaded','Uploaded CSV','$upload_date','$upload_dateonly','$userid')");
                }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: beginning_balance.php".$qstring);
<?php
include "basefunction/database_connection.php";
session_start();
if(!isset($_SESSION['session_userid']) || empty($_SESSION['session_userid'])) {
    header("location: login/");

  }
if(!empty($_REQUEST['status'])){
    switch($_REQUEST['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
         case 'dr':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Duplicate DR, please double check and try again.';
            break;    
          case 'cyl':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Duplicate container number, please double check and try again.';
            break;   
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
     
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<html>
<head>
<style>
body{
	background: url('login/bg2.jpg');
	background-repeat: no-repeat;
	background-size: 100% 100%;
	overflow: hidden;
}
.box
{
}
</style>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Format Instruction</h4>
      </div>
      <div class="modal-body">
  <div class="row">
<div class="col-md-12">
<img src="images/instruct2.png" style="width:100%;" class="img-responsive"/>
</div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Format Instruction</h4>
      </div>
      <div class="modal-body">
     <div class="row">
<div class="col-md-12">
<img src="images/instruct1.png" style="width:100%;" class="img-responsive"/>
</div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="row">
<div class="col-md-12 text-center">
<img src="images/csv.png" class="img img-rounded" style="width:20%; margin-top:1px;"/>
</div>
</div>
<div class="row">
<div class="col-md-offset-2 col-md-8 col-md-offset-2 box text-center" >
<h1>Import CSV File Data into Database </h1>
</div>
</div><br>
<div class="row">
<div class="col-md-offset-2 col-md-8 col-md-offset-2" >
<div class="well" style="background: white; border:1px solid black;">
<div class="container-fluid">
  <?php if(!empty($statusMsg)){
        echo '<div class="alert alert-dismissable '.$statusMsgClass.'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$statusMsg.'</div>';
    } ?>
<label>Select CSV File </label><a href="format.xlsx" class="pull-right" download>Get File Format</a>
<form action="importData.php" method="post" enctype="multipart/form-data" id="importFrm">
<input type="file" name="file" class="form-control"/><br>

<input type="submit" onclick="return confirm('Are you sure?');" name="importSubmit" class="btn btn-primary pull-right">
</form>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-offset-2 col-md-8 col-md-offset-2" >
<div class="row">
<div class="col-md-12">
<div class="alert alert-info text-center">You will get an .xlxs file. Follow the format and press "Save As" then choose "CSV (Comma Delimited)". Please do not close the csv file while uploading, leave it open and please follow the date format.</div>
</div>
</div>
</div>
</div>
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
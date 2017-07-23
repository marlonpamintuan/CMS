<!DOCTYPE html>
<?php
include_once('../../basefunction/database_connection.php');
session_start();

$IR_DATEONLY = date("m-d-Y", strtotime('+6 hours'));  
$userid = $_SESSION['session_userid'];
$select = mysqli_query($link,"select * from user where USER_ID = '$userid'");
$fetch = mysqli_fetch_array($select);
$firstname = $fetch['USER_FIRSTNAME'];
$lastname = $fetch['USER_LASTNAME'];
$access = $fetch['USER_ACCESS'];

if(!isset($_SESSION['session_userid']) || empty($_SESSION['session_userid'])) {
    header("location: ../../");
		exit();
	}
	if($_SESSION['session_access'] === "customer") {
    header("location: ../../");
		exit();
	}

	
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMS | Box Out</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  <link rel="icon" href="../../login/logo2.jpg">
  <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
<link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="../../dist/css/scroll.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  th,td{font-size:13px;}
th{
   white-space:nowrap;
}
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">

    <!-- Logo -->
    <a href="../../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CMS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CMS</b> <b>Dashboard</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
 
                    <li class="dropdown notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-file-text"></i>&nbsp;&nbsp;<strong>REPORTS</strong>
             
            </a>
            <ul class="dropdown-menu"  >
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="../../reports/statement_of_cylinder/dr_cylinder_per_customer">
                      <i class="fa fa-flask text-blue"></i> All Containers in Customer
                    </a>
                  </li>
                  
                  <li>
                    <a href="../../reports/statement_of_cylinder/dr_cylinder_overdue_customer">
                      <i class="fa fa-hourglass-o text-yellow"></i>All Overdue Containers in Customer
                    </a>
                  </li>
                  <li>
                    <a href="../../reports/customer_aging_report/">
                      <i class="fa fa-clock-o text-red"></i> Customer Aging Report
                    </a>
                  </li>
                  
                  <li>
                    <a href="../../reports/container_report/">
                      <i class="fa fa-archive text-red"></i> Container Report
                    </a>
                  </li>
                  <li>
                    <a href="../../reports/maintenance_report/">
                      <i class="fa fa-medkit text-aqua"></i> Maintenance Report
                    </a>
                  </li>
                  <li>
                    <a href="../../reports/hydrotest_report/">
                      <i class="fa fa-cog text-aqua"></i> Hydro Test Container Report
                    </a>
                  </li>
                  <li>
                    <a href="../../reports/transaction_report/">
                      <i class="fa fa-check text-green"></i> Transaction Report
                    </a>
                  </li>
                </ul>
              </li>
              </ul>
          </li>
         <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="../../throw/throw_list/">
              <i class="fa fa-trash"></i>&nbsp;&nbsp;<strong>UNDER MAINTENANCE</strong>
             
            </a>
          </li>
          <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="../../hydro-test/hydro-test_list/">
              <i class="fa fa-cog"></i>&nbsp;&nbsp;<strong>UNDER HYDROTESTING</strong>
             
            </a>
          </li>
          <?php if($_SESSION['session_access']==='super admin' || $USER_AUDIT==='1'){
          ?>
          <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="../../audit-trail/audit-trail-list/">
              <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong>AUDIT TRAIL</strong>
             
            </a>
          </li>
          <?php
        }
          ?>

                   <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $firstname.' '.$lastname;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $firstname.' '.$lastname;?>
                  <small><?php echo $access;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="../../profile/" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="../../logout/" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        

        </ul>
      </div>

    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar --><aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname.' '.$lastname;?></p>
          <a href="#" style="font-size: 10px;"><i class="fa fa-circle text-success"></i> <?php echo $access;?></a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header text-center">DATE / TIME</li>
        <li title="Time now"><a onclick="return false" href=""><i class="fa fa-clock-o"></i><span>Time: </span> <span id="websitetime"></span></a></li>
        <li title="Date today"><a  onclick="return false" href=""><i class="fa fa-calendar"></i><span>Calendar: </span><span id="websitedate"></span></a></li>
    
       
        <?php if($_SESSION['session_access'] === 'super admin'){
         ?> 
        <li class="header text-center">MAIN NAVIGATION</li>
        <li class="active" title="Dashboard">
          <a href="../../">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
        
        </li>
       
           <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>System User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="user_add" href="../../user/user_add/"><i class="fa fa-circle-o"></i> Add New User</a></li>
            <li><a href="../../user/user_list"><i class="fa fa-circle-o"></i> User List</a></li>
            
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../customer/customer_add/"><i class="fa fa-circle-o"></i> Add New Customer</a></li>
            <li><a href="../../customer/customer_list/"><i class="fa fa-circle-o"></i> Customer List</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>Container</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../container/container_add/"><i class="fa fa-circle-o"></i> Add New Container</a></li>
            <li><a href="../../container/container_list/"><i class="fa fa-circle-o"></i> Container List</a></li>
            
          </ul>
        </li>
        <?php
      }else{
?>
 <li class="header text-center">MAIN NAVIGATION</li>
        <li class="active" title="Dashboard">
          <a href="../../">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
        
        </li>
       
          
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../customer/customer_add/"><i class="fa fa-circle-o"></i> Add New Customer</a></li>
            <li><a href="../../customer/customer_list/"><i class="fa fa-circle-o"></i> Customer List</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>Container</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../container/container_add/"><i class="fa fa-circle-o"></i> Add New Container</a></li>
            <li><a href="../../container/container_list/"><i class="fa fa-circle-o"></i> Container List</a></li>
            
          </ul>
        </li>

<?php

      }
        ?>
         <li class="header text-center">TRANSACTION</li>
      
         
           <li class="treeview">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>DR</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="" title="Direct Receipt">
              <a href="../../dr/dr_add/">
            <i class="fa fa-circle-o"></i> <span>Direct Receipt ( DR )</span>
              <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
              </a>
          </li>
             <li class="" title="Direct Receipt List">
              <a href="../../dr/dr_list/">
            <i class="fa fa-circle-o"></i> <span>Direct Receipt List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-flask"></i>
            <span>Inward Receipt</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="" title="Inward Receipt">
          <a href="../../ir/ir_add">
            <i class="fa fa-file"></i> <span>Inward Receipt ( IR )</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-left pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Direct Receipt List">
              <a href="../../ir/ir_list/">
            <i class="fa fa-circle-o"></i> <span>Inward Receipt List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
        
      <li class="" title="Inward Receipt">
          <a href="../../transaction/transaction_list/">
            <i class="fa fa-file"></i> <span>All Transactions Made</span>
                <span class="pull-right-container">
              <i class="fa fa-check pull-right"></i>
            </span>
            
          </a>
        
        </li>
            <li class="header text-center">BOX</li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Box Out</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="" title="New Box Out">
          <a href="../../box/box_out">
            <i class="fa fa-plus"></i> <span>New Box Out</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Box Our List">
              <a href="../../box/box_out_list/">
            <i class="fa fa-archive"></i> <span>Box Out List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Box In</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="" title="New Box Out">
          <a href="../../box/box_in">
            <i class="fa fa-plus"></i> <span>New Box In</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Box Our List">
              <a href="../../box/box_transaction/">
            <i class="fa fa-archive"></i> <span>Box Returned List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
          <li class="header text-center">DOCUMENTATION</li>
         <li class="" title="Inward Receipt">
          <a href="../../documentation/">
            <i class="fa fa-info-circle"></i> <span>Documentation</span>
                <span class="pull-right-container">
          
            </span>
            
          </a>
        
        </li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      &nbsp;
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Box</a></li>
        <li class="active">New Box Out</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <!-- ##################### ADD MODAL ##########################-->
<!-- add modal -->
  <!-- edit modal -->
  <div class="modal fade" role="dialog" id="addMember">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> ADD NEW ITEM</h4>
        </div>

    <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">       

    <div class="modal-body">
        <div class="messages"></div>

 <div class="row">
  <div class="col-md-12"> 
    <label>Select Customer</label>
        <?php $query = "select * from customer where CUSTOMER_STATUS != 'inactive'";
        $result2 = mysqli_query($link,$query);
        ?>
    <select class="form-control select2" name="CUSTOMER_ID" data-placeholder="Select a Customer" style="width: 100%;" id="CUSTOMER_ID" required="">
              <option label="-- Select Customer --" ></option>
                <?php
                 while($row2 = mysqli_fetch_array($result2)){
                  $CUSTOMER_NAME = $row2['CUSTOMER_NAME'];
                  $CUSTOMER_ID = $row2['CUSTOMER_ID'];
                ?> 
                <option value="<?php echo $CUSTOMER_ID;?>"><?php echo $CUSTOMER_NAME;?></option>
                <?php
                }
                ?>
             
    </select>
  </div>
  </div>
  <br>
  <div class="row">
  <div class="col-md-6"> 
      <label for="editName" class="control-label">Box Code</label>
       <?php $query = "select * from cylinder where CYLINDER_STATUS = ''";
        $result2 = mysqli_query($link,$query);
        ?>
         <select class="form-control select2" name="TEMP_BOXCODE" data-placeholder="Select a Box" style="width: 100%;" id="TEMP_BOXCODE" required="">
              <option label="-- Select Container --" ></option>
                <?php
                 while($row2 = mysqli_fetch_array($result2)){
                  $CYLINDER_REFERENCEID= $row2['CYLINDER_REFERENCEID'];
                ?> 
                <option value="<?php echo $CYLINDER_REFERENCEID;?>"><?php echo $CYLINDER_REFERENCEID;?></option>
                <?php
                }
                ?>
             
    </select>
   
        <!-- here the text will apper  -->
  </div>
    <div class="col-md-6"> 
      <label for="editName" class="control-label">Box Status</label>
        <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-info"></i></span>
  <input type="text" class="form-control" placeholder="Box Status" id="TEMP_BOXSTATUS" name="TEMP_BOXSTATUS">
  </div>
        <!-- here the text will apper  -->
  </div>

</div>
<br>
  <div class="row">
  <div class="col-md-6"> 
      <label for="editName" class="control-label">Dry Ice Weight</label>
        <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-slack"></i></span>
  <input type="number" min="0" class="form-control" placeholder="Dry Ice Weight" id="TEMP_DICEWEIGHT" name="TEMP_DICEWEIGHT">
  </div>
        <!-- here the text will apper  -->
  </div>
    <div class="col-md-6"> 
      <label for="editName" class="control-label">Box Weight</label>
        <div class="input-group">
  <span class="input-group-addon"><i class="fa fa-slack"></i></span>
  <input type="number" class="form-control" placeholder="Box Weight" id="TEMP_BOXWEIGHT" name="TEMP_BOXWEIGHT">
  </div>
        <!-- here the text will apper  -->
  </div>

</div>

<br>


          <br>


      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /edit modal -->
  <!-- /add modal -->
    <!--###################### END MODAL ###########################-->
    <!--###################### REMOVE MODAL ##########################-->
      <!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete this data</h4>
        </div>
        <div class="modal-body">
          <p>Do you really want to remove ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
    <!--###################### END REMOVE ##############################-->
      <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary color-palette-box">
            <div class="box-header with-border ">
      	   <h3 class="box-title"><i class="fa fa-plus text-primary">&nbsp;</i>New Box Out</h3>
              <h3 class="box-title pull-right">
              <button class="btn btn-primary pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
      <strong>ADD NEW ITEM TO BOX OUT</strong>
        </button>
          </h3>
      
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form method="POST" id="box_form"> 
             <div class="row">
          <div class="col-md-6">
            <label class="control-label">Duty Operator</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              
                <input type="text" placeholder="Duty Operator" name="BOXOUT_DUTYOPERATOR"  id="BOXOUT_DUTYOPERATOR"  class="form-control" required="" >
            
              
            </div>
          </div>
          <div class="col-md-6">
            <label class="control-label">Date</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              
                <input type="text" name="BOXOUT_DATE"  id="datepicker"  class="form-control" required="">
            
              
            </div>
          </div>
        
       </div>
       <br>
           <div class="row">
          <div class="col-md-6">
            <label class="control-label">Duty Guard</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              
                <input type="text" placeholder="Duty Guard" name="BOXOUT_GUARD"  id="BOXOUT_GUARD"  class="form-control" required="">
            
              
            </div>
          </div>
        
       </div>
      
       <hr>
            <div class="row">
      <div class="col-md-12">

        <div class="removeMessages"></div>

        <table class="table table-striped table-hover" id="manageMemberTable">          
          <thead>
            <tr>
              <th class="bg-primary"></th>

            <th class="bg-primary">CUSTOMER</th>
          <th class="bg-primary">BOX CODE</th>
           <th class="bg-primary">DRY ICE WEIGHT</th>
          <th class="bg-primary">BOX WEIGHT</th>
          <th class="bg-primary">TOTAL</th>
          <th class="bg-primary">BOX STATUS</th>
      
                        </tr>
          </thead>
        </table>
      </div>
    </div>  
    <HR>
 <div class="row">
          <div class="col-md-6">
            <label class="control-label">Time Out</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
              
                <input type="time" name="BOXOUT_TIMEOUT"  id="BOXOUT_TIMEOUT"  class="form-control" required="">
            
              
            </div>
          </div>
           <div class="col-md-6">
            <label class="control-label">Gate Pass</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              
                <input type="number" min="0" placeholder="Gate Pass" name="BOXOUT_GATEPASS"  id="BOXOUT_GATEPASS"  class="form-control" required="" >
            
              
            </div>
          </div>
        
       </div>
       <br>
       <input type="submit" class="btn btn-success pull-right" value="SAVE AND CLOSE"/>
</form>
   <div id='loadingmessage' style='display:none;' class="text-center">
  <img src='../../images/loading.gif' style="width:12%;"/><br>
 
</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
	<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 <a target="_blank" href="http://quickbooksphl.com">QBM IT Services | MJNP</a>.</strong> All rights reserved.
      </footer> <!-- Control Sidebar --> 

</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
		<script src="../../plugins/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="custom/js/ajax.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../plugins/select2/select2.full.min.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../../dist/js/dt.js"></script>
<script src="custom/js/index.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
</script>

  <!-- This is what you need -->
  <script src="../../sweet/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="../../sweet/sweetalert.css">
<!-- page script -->
	<script>
	var myVar=setInterval(function(){myTimer()},1000);

	function myTimer() {
		var d = new Date();
		document.getElementById("websitetime").innerHTML = d.toLocaleTimeString();
		document.getElementById("websitedate").innerHTML = d.toDateString();
	}
	</script>
		<script type="text/javascript">
function edit_id(id)
{
 swal({
        title: "Are you sure?",
        text: "We will send you to the edit form!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
        
             window.location.href='../ir_edit/index.php?id='+id;

        } else {
            swal("Cancelled", "Your data is safe :)", "success");
        }
    });


 
}
function delete_id(id)
{
 swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            swal({
                title: 'Deleted!',
                text: 'Data was successfully deleted!',
                type: 'success'
            }, function() {
                window.location.href='index.php?delete_id='+id;
            });

        } else {
            swal("Cancelled", "Your data is safe :)", "success");
        }
    });

 
}
</script>
  <script language="javascript" type="text/javascript">

var timeout = setInterval(reloadChat, 3000);    
function reloadChat () {

    
          $('#transac').load('transac.php');
        
}
</script>

</body>
</html>


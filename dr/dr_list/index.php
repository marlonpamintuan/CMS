<!DOCTYPE html>
<?php
include_once('../../basefunction/database_connection.php');
include ('../../basefunction/timezone.php');
session_start();
$DR_DATEONLY = date("m-d-Y");  
$userid = $_SESSION['session_userid'];
$select = mysqli_query($link,"select * from user where USER_ID = '$userid'");
$fetch = mysqli_fetch_array($select);
$firstname = $fetch['USER_FIRSTNAME'];
$lastname = $fetch['USER_LASTNAME'];
$access = $fetch['USER_ACCESS'];
if(!isset($_SESSION['session_userid']) || empty($_SESSION['session_userid']))
  {
    header("location: ../../");
    exit();
  }
  if($_SESSION['session_access'] === "customer")
  {
    header("location: ../../");
    exit();
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMS | List of DR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  <link rel="icon" href="../../login/logo2.jpg">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="assests/datatables/dataTables.bootstrap.css">
  <!-- Font Awesome -->
   <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
    <link rel="stylesheet" href="../../ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- bootstrap css -->
  <!-- bootstrap css -->
<style>
th{
   white-space:nowrap;
}

</style>
</head>
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

<aside class="main-sidebar">

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
Direct Receipt
        <small>DR list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">DR</a></li>
        <li class="active">DR list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-edit"></span>&nbsp;Please enter the DR Number you want to modify</h4>
        </div>
      <div class="modal-body">
      <form action="../dr_edit/" method="POST"> 
      <div class="form-group">
                <label>Select DR Number</label>
                  <?php $query = "select DISTINCT(DR_NO) from dr order by DR_NO ASC";
                $result2 = mysqli_query($link,$query);
                ?>
                <select class="form-control select2"  name="DR_NO" data-placeholder="Select DR Number" style="width: 100%;" required>
                 <option label="-- Select DR Number--" ></option>
                  <?php while($row2 = mysqli_fetch_array($result2)){
             
               $DR_NO = $row2['DR_NO'];
                ?> <option value="<?php echo $DR_NO;?>"><?php echo $DR_NO;?></option><?php
                }?>
             
                </select>
              </div>
              <input type="submit" class="btn btn-success btn-flat pull-right"/><br><br>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <!--########################################EDIT MODAL ######################-->
    <!--########################################DELETE MODAL ######################-->
    <div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="fa fa-trash"></span>&nbsp;Please enter the DR Number you want to delete</h4>
      </div>
      <div class="modal-body">
      <form id="delete_dr" method="POST"> 
      <div class="form-group">
                <label>Select DR Number</label>
                  <?php $query = "select DISTINCT(DR_NO) from dr order by DR_NO ASC";
                $result2 = mysqli_query($link,$query);
                ?>
                <select class="form-control select2"  name="DR_NO" data-placeholder="Select DR Number" style="width: 100%;" required>
                 <option label="-- Select DR Number--" ></option>
                  <?php while($row2 = mysqli_fetch_array($result2)){
             
               $DR_NO = $row2['DR_NO'];
                ?> <option value="<?php echo $DR_NO;?>"><?php echo $DR_NO;?></option><?php
                }?>
             
                </select>
              </div>
              <input type="submit" class="btn btn-success btn-flat pull-right"/><br><br>
      </form>

        <div id='loadingmessage' style='display:none;' class="text-center">
  <img src='../../images/loading.gif' style="width:12%;"/><br>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
      <div class="row">
        <div class="col-xs-12">
        

          <div class="box box-danger">
           <div class="box-header with-border">
          <h3 class="box-title pull-right">
          <div class="btn-group">
              <!--<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
          <span class="glyphicon glyphicon-plus-sign "></span> <strong>ADD NEW DR</strong>
        </button>-->
 <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"><strong>EDIT DR</strong></button>
      <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal2"><strong>DELETE DR</strong></button>
      </div>
          </h3></div><br>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
      <div class="col-md-12">
        <div class="removeMessages"></div>
 <div class="pickupMessages"></div>
 <div class="deliveryMessages"></div>
        <span id="transac"></span>
         <span id="transac2"></span>
  

        <table class="table table-hover table-striped table-condensed" id="manageMemberTable">          
          <thead>
            <tr>
             <th class="bg-primary"></th>
                   <th class="bg-primary">DR NO</th>
               <th class="bg-primary">CUSTOMER</th>          
              <th class="bg-primary">SINCE</th>
              <th class="bg-primary">CYLINDER</th>
             <th class="bg-primary">DUE</th>
          <th class="bg-primary">DAYS</th>
          <th class="bg-primary">STATUS</th>
           <th class="bg-primary">DATE</th>
          
             
            </tr>
          </thead>
        </table>
      </div>
    </div>
 <!-- add modal -->
  <!-- edit modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
    <div class="modal-dialog modal-lg" role="document" style="height:100px;">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title "><span class="glyphicon glyphicon-plus"></span> 
          ADD NEW DR</h4>
        </div>

    <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">       

    <div class="modal-body">
        <div class="messages"></div>
       
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
           <div class="form-group">
                <label>DR Number</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-file"></i>
                  </div>
                  <input type="number" min="0" name="DR_NO"  class="form-control pull-right" id="DR_NO" required="" />
                </div>
                <!-- /.input group -->
              </div>
        </div>
         <div class="col-md-6">
              <div class="form-group">
                <label>Select Customer</label>
                  <?php $query = "select * from customer where CUSTOMER_STATUS != 'inactive'";
                $result2 = mysqli_query($link,$query);
                ?>
                <select class="form-control select2"  name="CUSTOMER_ID" data-placeholder="Select a Customer" style="width: 100%;" id="CUSTOMER_ID" required="">
                 <option label="-- Select Customer --" ></option>
                  <?php while($row2 = mysqli_fetch_array($result2)){
              $CUSTOMER_NAME = $row2['CUSTOMER_NAME'];
               $CUSTOMER_ID = $row2['CUSTOMER_ID'];
                ?> <option value="<?php echo $CUSTOMER_ID;?>"><?php echo $CUSTOMER_NAME;?></option><?php
                }?>
             
                </select>
              </div>
              <!-- /.form-group -->
             
              <!-- /.form-group -->
            </div>
        </div>
        <div class="row">
  <div class="col-md-12"> 
 
    <div class="form-group">
              <label for="editName" class="control-label">Container Number</label>
                <?php
                $querys = "select * from cylinder where CYLINDER_STATUS =''";
                 $result = $link->query($querys);
                ?>
                <select class="form-control select2" id="cylinder" multiple="multiple" data-placeholder="Select a Container" name="CYLINDER_REFERENCEID[]" style="width: 100%;" required="">
               <?php  while ($row = $result->fetch_assoc()) {
               $CYLINDER_REFERENCEID = $row['CYLINDER_REFERENCEID'];
                ?> <option value="<?php echo $CYLINDER_REFERENCEID;?>"><?php echo $CYLINDER_REFERENCEID;?></option><?php
                }?>
                </select>
              </div>
             

  </div>

</div>
  <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Starting Date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="DR_DATECREATED" class="form-control pull-right" id="datepicker" required="" />
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label>Due Date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="DR_RETURNDATE"  class="form-control pull-right" id="datepicker2" required="" />
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.col -->
          </div>
    
 </div>
<br>

  


      
        </div>
        <div class="modal-footer">
        <div class="btn-group">
          <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Close</button>
          <button type="submit" name="send" id="btnsave" value="save" class="btn btn-primary">Save new DR</button>
      <button onclick="submitForm('php_action/history.php')" title="Leave atleast one textbox empty when searching for history" id="btnhistory" class="btn btn-success">History</button>
      </div>
  
        </div>
        </form>
 <div id="history"></div>
           <div id='loadingmessage2' style='display:none;' class="text-center">
                <img src='../../images/loading.gif' style="width:12%;"/><br>
 
                </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /edit modal -->
  <!-- /add modal -->

  <!-- remove modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove this data?</h4>
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
  <!-- /remove modal -->
 
  
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
      <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2016-2017 <a href="#" title="Developer">MJNP</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="js/ajax.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->

<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- include custom index.js -->
  <script type="text/javascript" src="assests/datatables//dataTables.bootstrap.min.js"></script>
  <script src="../../plugins/select2/select2.full.min.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="../../sweet/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../../sweet/sweetalert.css">
  <script type="text/javascript" src="custom/js/index.js"></script>
<script>
  $(function (){
    $(".select2").select2();
        //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
     $('#datepicker2').datepicker({
      autoclose: true
    });
   //Timepicker
  });
</script>
<!-- page script -->
<script language="javascript" type="text/javascript">
var timeout = setInterval(reloadChat, 5000);    
function reloadChat (){
$('#transac').load('transac.php');
$('#transac2').load('transac2.php');      
}
</script>
<script language="javascript" type="text/javascript">
function history (){
$('#history').load('php_action/history.php');
}
</script>
<script>
  var myVar=setInterval(function(){myTimer()},1000);
    function myTimer() {
      var d = new Date();
      document.getElementById("websitetime").innerHTML = d.toLocaleTimeString();
      document.getElementById("websitedate").innerHTML = d.toDateString();
    }
</script>
<script type="text/javascript">
  function submitForm(url){
    var data = $("#createMemberForm").serialize();
    $.ajax({
        type : 'POST',
        url  : url,
        data : data,
        success :  function(data){
            $("#history").html(data);
        }
    });
}
</script>
</body>
</html>

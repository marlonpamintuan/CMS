<?php
include "basefunction/database_connection.php";
session_start();
error_reporting(0);
$userid = $_SESSION['session_userid'];
$select = mysqli_query($link,"select * from user where USER_ID = '$userid'");
$fetch = mysqli_fetch_array($select);
$firstname = $fetch['USER_FIRSTNAME'];
$lastname = $fetch['USER_LASTNAME'];
$access = $fetch['USER_ACCESS'];
$USER_AUDIT = $fetch['USER_AUDIT'];

if(!isset($_SESSION['session_userid']) || empty($_SESSION['session_userid'])) {
    header("location: login/");

  }

  if(isset($_REQUEST['delete_id']))
{

  $request_id = $_REQUEST['delete_id'];
  $info = "Added cyinder:";
  $audit_query = mysqli_query($link,"insert into audittrail(AUDITTRAIL_ACTIVITY,AUDITTRAIL_ACTION,AUDITTRAIL_INFO,AUDITTRAIL_DATE,AUDITTRAIL_USER) VALUES('Cylinder Module','Added new cylinder','$info $CYLINDER_REFERENCEID','$CYLINDER_DATECREATED','$userid')");
  if($audit_query){


   $sql_query="Delete from todo where TODO_ID = '$request_id'";
   
 mysqli_query($link,$sql_query);
 header("Location: $_SERVER[PHP_SELF]");
}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CTS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="icon" href="login/logo2.jpg">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->

  <!-- Date Picker -->
 
  <!-- Daterange picker -->

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
 <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CMS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CMS</b> <b>Dashboard</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation" >
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-file-text"></i>&nbsp;&nbsp;<strong>REPORTS</strong>
             
            </a>
            <ul class="dropdown-menu"  >
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="reports/statement_of_cylinder/dr_cylinder_per_customer">
                      <i class="fa fa-flask text-blue"></i> All Containers in Customer
                    </a>
                  </li>
                  
                  <li>
                    <a href="reports/statement_of_cylinder/dr_cylinder_overdue_customer">
                      <i class="fa fa-hourglass-o text-yellow"></i>All Overdue Containers in Customer
                    </a>
                  </li>
                  <li>
                    <a href="reports/customer_aging_report/">
                      <i class="fa fa-clock-o text-red"></i> Customer Aging Report
                    </a>
                  </li>
                  
                  <li>
                    <a href="reports/container_report/">
                      <i class="fa fa-archive text-red"></i> Container Report
                    </a>
                  </li>
                  <li>
                    <a href="reports/maintenance_report/">
                      <i class="fa fa-medkit text-aqua"></i> Maintenance Report
                    </a>
                  </li>
                  <li>
                    <a href="reports/hydrotest_report/">
                      <i class="fa fa-cog text-aqua"></i> Hydro Test Container Report
                    </a>
                  </li>
                  <li>
                    <a href="reports/transaction_report/">
                      <i class="fa fa-check text-green"></i> Transaction Report
                    </a>
                  </li>
                </ul>
              </li>
              </ul>
          </li>
          <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="throw/throw_list/">
              <i class="fa fa-trash"></i>&nbsp;&nbsp;<strong>UNDER MAINTENANCE</strong>
             
            </a>
          </li>
          <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="hydro-test/hydro-test_list/">
              <i class="fa fa-cog"></i>&nbsp;&nbsp;<strong>UNDER HYDROTESTING</strong>
             
            </a>
          </li>
          <?php if($_SESSION['session_access']==='super admin' || $USER_AUDIT==='1'){
          ?>
          <li class="notifications-menu active" style="border-right:2px solid #3c8dbc;">
            <a href="audit-trail/audit-trail-list/">
              <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong>AUDIT TRAIL</strong>
             
            </a>
          </li>
          <?php
        }
          ?>
           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $firstname.' '.$lastname;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $firstname.' '.$lastname;?>
                  <small><?php echo $access;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile/" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout/" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
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
          <a href="#">
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
            <li><a id="user_add" href="user/user_add/"><i class="fa fa-circle-o"></i> Add New User</a></li>
            <li><a href="user/user_list"><i class="fa fa-circle-o"></i> User List</a></li>
            
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
            <li><a href="customer/customer_add/"><i class="fa fa-circle-o"></i> Add New Customer</a></li>
            <li><a href="customer/customer_list/"><i class="fa fa-circle-o"></i> Customer List</a></li>
            
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
            <li><a href="container/container_add/"><i class="fa fa-circle-o"></i> Add New Container</a></li>
            <li><a href="container/container_list/"><i class="fa fa-circle-o"></i> Container List</a></li>
            
          </ul>
        </li>
        <?php
      }else{
?>
 <li class="header text-center">MAIN NAVIGATION</li>
        <li class="active" title="Dashboard">
          <a href="#">
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
            <li><a href="customer/customer_add/"><i class="fa fa-circle-o"></i> Add New Customer</a></li>
            <li><a href="customer/customer_list/"><i class="fa fa-circle-o"></i> Customer List</a></li>
            
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
            <li><a href="container/container_add/"><i class="fa fa-circle-o"></i> Add New Container</a></li>
            <li><a href="container/container_list/"><i class="fa fa-circle-o"></i> Container List</a></li>
            
          </ul>
        </li>

<?php

      }
        ?>
         <li class="header text-center">CYLINDER</li>
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
              <a href="dr/dr_add/">
            <i class="fa fa-circle-o"></i> <span>Direct Receipt ( DR )</span>
              <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
              </a>
          </li>
             <li class="" title="Direct Receipt List">
              <a href="dr/dr_list/">
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
          <a href="ir/ir_add">
            <i class="fa fa-file"></i> <span>Inward Receipt ( IR )</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-left pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Inward Receipt List">
              <a href="ir/ir_list/">
            <i class="fa fa-circle-o"></i> <span>Inward Receipt List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
        
      <li class="" title="Transaction Per Customer">
          <a href="transaction/transaction_list/">
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
          <a href="box/box_out">
            <i class="fa fa-plus"></i> <span>New Box Out</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Box Our List">
              <a href="box/box_out_list/">
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
          <a href="box/box_in">
            <i class="fa fa-plus"></i> <span>New Box In</span>
                <span class="pull-right-container">
              <i class="fa fa-long-arrow-right pull-right"></i>
            </span>
            
          </a>
        
        </li>
             <li class="" title="Box Our List">
              <a href="box/box_transaction/">
            <i class="fa fa-archive"></i> <span>Box Returned List</span>
              <span class="pull-right-container">
              <i class="fa fa-list pull-right"></i>
            </span>
            
              </a>
          </li>
            
          </ul>
        </li>
        <li class="header text-center">DOCUMENTATION</li>
         <li class="" title="Documentation">
          <a href="documentation/">
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
  <!--TODO LIST MODAL -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="ion ion-clipboard"></span> ADD NEW TASK</h4>
      </div>
      <div class="modal-body">
       <form action="" method="post" id="todo_form">
          <div class="row">
            <div class="col-md-12">
              <label class="control-label">TASK INFORMATION</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-question"></i>
              </div>
                <input type="text" placeholder="TASK INFORMATION" name="TODO_INFO" id="TODO_INFO"  class="form-control" required>
            </div>
            </div>
          </div><br>
          <div class="pull-right">
          <input type="submit" class="btn btn-md btn-primary" value="ADD / SAVE"/>
          </div><br><br>
       </form>

       <div id='loadingmessage' style='display:none;' class="text-center">
  <img src='images/loading.gif' style="width:12%;"/><br>
 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 <!--TODO LIST MODAL -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!-- Info boxes -->
     <span id="transac"></span>
     <span id="transac2"></span>
      <span id="save"></span>
 <span id="delete"></span>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <a href="container/container_list/" style="color:black;">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><img src="images/cylinder.png" style="width:40%;"></img></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Container List"><strong>containers</strong></span>
              <span class="info-box-number">
              <div id="container"></div>
          </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">

          <a href="customer/customer_list/" style="color:black;">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Number of Customers"><strong>Customers</strong></span>
              <span class="info-box-number">
              <div id="customer"></div>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">

          <a href="dr/dr_list/" style="color:black;">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Number of Direct Receipts"><strong>Direct Receipts</strong></span>
              <span class="info-box-number"><div id="dr"></div></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">

          <a href="ir/ir_list/" style="color:black;">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Number of Inward Receipts"><strong>Inward Receipts</strong></span>
              <span class="info-box-number"><div id="transaction"></div></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable" >
          <!-- Custom tabs (Charts with tabs)-->
         
          

          <!-- TO DO List -->
          <div class="box box-primary"  style="height:430px; overflow:auto;">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">TASK TO DO</h3> 
               <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> <strong>ADD NEW TASK</strong></button>


            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
             
           <div id="todo"> </div>
              
              
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
             </div>


          </div>
          <!-- /.box -->
           <div class="row">
  
  
      <div class="col-md-12">
      <form method="post" action="php/backup.php">
      <button type="submit" title="Backup my database" name="btn-submit" class="btn btn-primary btn-sm btn-block" style="font-family: arial;"><strong>BACKUP YOUR DATA</strong></button>
      </form>
          <!-- /.row -->
        </div>
      </div>
        </section>
        <!-- /.Left col -->
         <section class="col-lg-4 connectedSortable" >
           <!-- TO DO List -->
          <div class="box box-primary"  style="height:482px; overflow:auto;">
            <div class="box-header">
              <i class="fa fa-line-chart"></i>

              <h3 class="box-title">Reminder</h3>

           <span class="label label-primary pull-right" style="padding:5px;"><a href="beginning_balance.php" title="CSV uploader for beginning DR" target="_blank" style="color:white;"><strong>CSV UPLOADER</strong></a></span>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

          <a href="dr/dr_list/">
              <div class="info-box bg-aqua">
            <span class="info-box-icon"><img src="images/cylinder2.png" style="width:40%;"></img></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Container Outside"><strong>container Outside</strong></span>
              <span class="info-box-number"><div id="outside"></div></span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
                  <span class="progress-description">
                   All Container Outside
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>

          <a href="throw/throw_list/" style="color:black;">
           <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-gears"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Container Under Maintenance"><strong>Under Maintenance</strong></span>
              <span class="info-box-number"><div id="cylinder_yesterday"></div></span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
                  <span class="progress-description">
                  Container Under Maintenance
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
           <a href="hydro-test/hydro-test_list/" style="color:black;">
           <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-gears"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Container Under Hydro Testing"><strong>Under Hydro Test</strong></span>
              <span class="info-box-number"><div id="hydro"></div></span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
                  <span class="progress-description">
                  Container Under Hydro Testing
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>

          <a href="reports/statement_of_cylinder/dr_cylinder_overdue_customer/"" style="color:black;">
                <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-hourglass-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" title="Overdue Containers in Customer"><strong>Overdue</strong></span>
              <span class="info-box-number"><div id="overdue"></div></span>

              <div class="progress">
                <div class="progress-bar"></div>
              </div>
                  <span class="progress-description">
                   Overdue container in Customer
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
           
            </div>
            <!-- /.box-body -->
            


          </div>
        
        

        </section>
        <!-- /.Left col -->
      
      </div>
      <!-- /.row (main row) -->



      </div>
    </section>
    <!-- /.content -->  <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 <a target="_blank" href="http://quickbooksphl.com">QBM IT Services | MJNP</a>.</strong> All rights reserved.
      </footer> <!-- Control Sidebar --> 
  </div>
  <!-- /.content-wrapper -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <!--<div class="control-sidebar-bg"></div>-->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  </div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<script src="ajax/ajax.js"></script>
<script src="ajax/undo.js"></script>
<script src="ajax/todo-ajax.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Morris.js charts -->
<script src="dist/js/raphael.min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->

<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="dist/js/moment.min.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->


  <!-- This is what you need -->
  <script src="sweet/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="sweet/sweetalert.css">
<!-- DATE AND TIME -->
<script>
  var myVar=setInterval(function(){myTimer()},1000);
    function myTimer() {
      var d = new Date();
      document.getElementById("websitetime").innerHTML = d.toLocaleTimeString();
      document.getElementById("websitedate").innerHTML = d.toDateString();
    }
</script>

<script language="javascript" type="text/javascript">
var timeout = setInterval(reloadChat, 1000);    
function reloadChat () {
$('#dr').load('php/dr.php');
$('#container').load('php/cylinder.php');
$('#customer').load('php/customers.php');
$('#transaction').load('php/transaction.php');
$('#overdue').load('php/overdue.php');
$('#outside').load('php/outside.php');
$('#cylinder_yesterday').load('php/cylinder_yesterday.php');
$('#hydro').load('php/hydro.php');

 }
 
</script>

<script language="javascript" type="text/javascript">
var timeout = setInterval(reloadChat, 1000);    
function reloadChat () {
$('#todo').load('php/todo.php');


}
</script>
 <script language="javascript" type="text/javascript">

var timeout = setInterval(reloadChat, 5000);    
function reloadChat () {
$('#transac').load('dr/dr_list/transac.php');

$('#transac2').load('dr/dr_list/transac2.php');
        
}
</script>
 <script language="javascript" type="text/javascript">

var timeout = setInterval(reloadChat, 10000);    
function reloadChat () {
$('#save').load('php/save_container.php');

}
</script>

  <script type="text/javascript">
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

</body>
</html>

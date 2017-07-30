<!DOCTYPE html>
<?php
include_once('../../basefunction/database_connection.php');
include '../../basefunction/timezone.php';
session_start();


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

//START OF QUERY , FOR DISPLAYING THE CUSTOMER NAME ADDRESS AND DATE IN PRINT
	$CUSTOMER = $_POST['CUSTOMER_CYLINDER'];

$query2 = "select * from dr inner join ir ON ir.DR_NO = dr.DR_NO inner join customer ON dr.CUSTOMER_ID = customer.CUSTOMER_ID where dr.DR_STATUS='done' and IR_STATUS='' AND CUSTOMER_NAME = '$CUSTOMER' GROUP BY ir.IR_ID";
$result2 = mysqli_query($link,$query2);
$fetch = mysqli_fetch_array($result2);
$name = $fetch['CUSTOMER_NAME'];
$address = $fetch['CUSTOMER_ADDRESS'];


//START OF QUERY , FOR DISPLAYING THE CUSTOMER NAME ADDRESS AND DATE IN PRINT
$date_today = date("m/d/Y");
$query = "select * from dr inner join ir ON ir.DR_NO = dr.DR_NO inner join customer ON dr.CUSTOMER_ID = customer.CUSTOMER_ID where dr.DR_STATUS='done' and IR_STATUS='' and customer.CUSTOMER_NAME='$CUSTOMER' GROUP BY ir.IR_ID";
$result = mysqli_query($link,$query);


?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMS | Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->  <link rel="icon" href="../../login/logo2.jpg">
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
<link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../../ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="../../dist/css/scroll.css">
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
      <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->

  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
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
  <style>


  .font{font-family: Prestige Elite Std!important;}
  th,td{font-size:13px!important;}
@media print {
    .print {
        background-color: white;
        overflow: hidden!important;
    
    }
    .bord{border:none!important;}
s{page-break-inside: avoid;
  }

@page { margin: 0; overflow:hidden!important; }

.not-print{display:none;}
.x{position:fixed!important; bottom:0!important; left:0!important;}
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
        
          <!-- User Account: style can be found in dropdown.less -->

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
         <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
  
      <button class="btn btn-success not-print" onclick="myFunction()"><span class="fa fa-print"></span>&nbsp;Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Transaction</a></li>
        <li class="active">Transaction Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
<div class="col-md-12 bord" style="border:solid 1px grey; background: white;" >
<div class="row phil">
<div class="col-md-12 text-center s" >
<h3 class="font"><strong>PHILIPPINE CO<sub>2</sub> INDUSTRY, INC.</strong></h3>
<h4 class="font" style="font-size:15px;">525 M.Naval St., Navotas, MM</h4>
<h4 class="font" style="font-size:15px;">281-7962 ; 281-7951</h4><br>
<h4 class="font">T R A N S A C T I O N &nbsp;&nbsp;&nbsp;  R E P O R T</h4>
<h4 class="font">AS OF <?php echo $date_today;?></h4>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h4 class="font"><?php echo $name;?></h4>
<h4 class="font"><?php echo $address;?></h4>

<table class="table " >
<tr>
<td class="font" style="border-color:black; border-bottom:1px solid black;" >DR No</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;" >IR No</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;" >Customer</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;">Container</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;" >DR Date</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;">Due Date</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;">IR Date</td>
<td class="font" style="border-color:black; border-bottom:1px solid black;" >Days</td>

</tr>
<?php
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
$TRANSACTION_ID = $row['IR_ID'];
$TRANSACTION_DRNO = $row['DR_NO'];
$TRANSACTION_IRNO = $row['IR_NO'];
$CUSTOMER_NAME = $row['CUSTOMER_NAME'];
$CYLINDER_ID = $row['CYLINDER_REFERENCEID'];
$TRANSACTION_DRDATE = $row['DR_STARTDATE'];
$TRANSACTION_DUEDATE = $row['DR_RETURNDATE'];
$TRANSACTION_IRDATE = $row['IR_RETURNDATE'];
$TRANSACTION_DAYS = $row['DR_DAYS'];
$TRANSACTION_DRDATE2 = date_create($TRANSACTION_DRDATE);
$TRANSACTION_IRDATE2 = date_create($TRANSACTION_IRDATE);
$DAYS = date_diff($TRANSACTION_IRDATE2,$TRANSACTION_DRDATE2);

?>
<tr>
<td class="font" style="border:none!important;" ><?php echo $TRANSACTION_DRNO;?></td>
<td class="font" style="border:none!important;" ><?php echo $TRANSACTION_IRNO;?></td>
<td class="font" style="border:none!important;" ><?php echo $CUSTOMER_NAME;?></td>
<td class="font" style="border:none!important;"><?php echo $CYLINDER_ID;?></td>
<td class="font" style="border:none!important;" ><?php echo $TRANSACTION_DRDATE;?></td>
<td class="font" style="border:none!important;" ><?php echo $TRANSACTION_DUEDATE;?></td>
<td class="font" style="border:none!important;" ><?php echo $TRANSACTION_IRDATE;?></td>
<td class="font" style="border:none!important;"><?php echo $DAYS -> format("%a");?></td>


</tr>
<?php
}}
?>



</table>

<br>


</div>
</div>

</div>
    </div>
    </div>

   
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --><footer class="main-footer not-print">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 <a target="_blank" href="http://quickbooksphl.com">QBM IT Services | MJNP</a>.</strong> All rights reserved.
      </footer> <!-- Control Sidebar --> 

 <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li ><a href="#control-sidebar-home-tab" data-toggle="tab" style="font-family:verdana; font-size:11px;"><strong>SETTINGS</strong>&nbsp;&nbsp;<i class="fa fa-cog"></i></a></li>
     </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <ul class="control-sidebar-menu">
       <center><h4 style='font-family:verdana;font-size:11px;color:white;background:#1a2226;' class='control-sidebar-heading'>
      <strong>ALL REPORTS</strong>

      </h4></center>
       
        <li>
            <a href="../../reports/statement_of_cylinder/dr_cylinder_per_customer">
              <i class="menu-icon fa fa-flask bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;"><strong>Statement of Containers</strong></h4>

                <p style="font-family: verdana; font-size:10px;">Container(s) that is/are Still in the hand of Customer XYZ</p>
              </div>
            </a>
          </li>
          <li>
            <a href="../../reports/statement_of_cylinder/dr_cylinder_overdue_customer">
              <i class="menu-icon fa fa-flask bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Statement of Containers</h4>

                <p style="font-family: verdana; font-size:10px;">All Overdue Containers per Customer</p>
              </div>
            </a>
          </li>
          <li>
            <a href="../../reports/customer_aging_report/">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Customer Aging Report</h4>

                <p style="font-family: verdana; font-size:10px;">Aging Report</p>
              </div>
            </a>
          </li>
          <li>
            <a href="../../reports/transaction_report/">
              <i class="menu-icon fa fa-file-code-o bg-aqua"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Transaction Report</h4>

                <p style="font-family: verdana; font-size:10px;">All Transaction Made</p>
              </div>
            </a>
          </li>
          <li>
            <a href="../../reports/container_report/">
              <i class="menu-icon fa fa-flask bg-black"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Container Report</h4>

                <p style="font-family: verdana; font-size:10px;">Number of Container Per Day</p>
              </div>
            </a>
          </li>
          <center><h4 style='font-family:verdana;font-size:11px;color:white; background:#1a2226;' class='control-sidebar-heading'>
      <strong>SYSTEM</strong>
      </h4></center>
      <li>
            <a href="../../throw/throw_list/">
              <i class="menu-icon fa fa-trash bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Container Bin</h4>

                <p style="font-family: verdana; font-size:10px;">Retrieve your containers</p>
              </div>
            </a>
          </li>
          <?php
          if($_SESSION['session_access']==='super admin'){
            ?>
          <li>
            <a href="../../audit-trail/audit-trail-list/">
              <i class="menu-icon fa fa-eye bg-purple"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading" style="font-family: verdana; font-size: 11px;">Audit Trail</h4>

                <p style="font-family: verdana; font-size:10px;">View all activity</p>
              </div>
            </a>
          </li>
          <?php
        }else{
?>
&nbsp;
<?php
        }
          ?>
        </ul>
        
      </div>
    
      <!-- /.tab-pane -->
    </div>
  </aside>
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
		<script src="../../plugins/jquery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- FastClick -->

<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/dt.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy


  });
</script>

<!-- page script -->
	<script>
	var myVar=setInterval(function(){myTimer()},1000);

	function myTimer() {
		var d = new Date();
		document.getElementById("websitetime").innerHTML = d.toLocaleTimeString();
		document.getElementById("websitedate").innerHTML = d.toDateString();
	}
	</script>

</body>
</html>


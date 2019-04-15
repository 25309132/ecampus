<?php
include_once('../sys/core/init.inc.php');
$common=new common();
// error_reporting(E_ALL | E_STRICT);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_SESSION['UsersNames']; ?> | <?php echo $SystemName; ?></title>
  <?php include_once('../inc/inc.meta.php'); ?>
  
  <!--
  <link rel="stylesheet" type='text/css' href="templates/vendor/bootstrap.min.css">
  -->
  <link rel="stylesheet" type='text/css' href="templates/misc/emptyfile.css" title="PSI_Template">

</head>
<body class="hold-transition skin-blue sidebar-mini" style="margin-top: -80px;">
<div class="wrapper">
  <header class="main-header">
    <?php include_once('../inc/inc.topheader.php'); ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <?php include_once('../inc/inc.system-admin-menu.php'); ?>
      <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>System - Server Info</h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-home"></i>Home/ Module Select</a></li>
        <li><a href="javascript:void(0);"><i class="fa fa-cog"></i> System - Server Info</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!--Lock User From Accessing This Page -->
          <?php
            if($CanVIEW == 1){
          ?>
          <!--Lock User From Accessing This Page -->
          <div class="nav-tabs-custom border_grey">
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-right active"><a href="#Listing" data-toggle="tab"><h4><i class="fa fa-cogs"></i> System - Server Info</h4></a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="Listing">
                    <!--Start System Info -->
                    <?php
                      define('APP_ROOT', dirname(__FILE__));
                      define('PSI_INTERNAL_XML', false);

                      if (version_compare("5.1.3", PHP_VERSION, ">")) {
                          die("PHP 5.1.3 or greater is required!!!");
                      }
                      if (!extension_loaded("pcre")) {
                          die("phpSysInfo requires the pcre extension to php in order to work properly.");
                      }

                      require_once APP_ROOT.'/includes/autoloader.inc.php';

                      // Load configuration
                      require_once APP_ROOT.'/read_config.php';

                      if (!defined('PSI_CONFIG_FILE') || !defined('PSI_DEBUG')) {
                          $tpl = new Template("/templates/html/error_config.html");
                          echo $tpl->fetch();
                          //die();
                      }
                      $display = strtolower(isset($_GET['disp']) ? $_GET['disp'] : PSI_DEFAULT_DISPLAY_MODE);
                      $webpage = new Webpage("bootstrap");
                      $webpage->run();
                      //echo "<center><img src='../img/loading-bar.gif' width='160'></center>";
                    ?>
                    
                    <!--End System Info -->
              </div> 
             
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
          <?php
                }
            else
                {
          ?>
              <div class="box box-danger box-solid">
                <div class="box-header">
                  <h3 class="box-title">You Have No Access to the Contents of this Page</h3>
                </div>
                <div class="box-body">
                  Please Contact Systems Administrator!
                </div>
                <!-- /.box-body -->
                <!-- Loading (remove the following to stop the loading)-->
                <div class="overlay">
                  <i class="fa fa-database fa-spin"></i>
                </div>
                <!-- end loading -->
              </div>
          <?php
              }
          ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--Footer Starts -->
  <?php include_once('../inc/inc.footertext.php'); ?>
<!--Footer Ends-->
</div>
<!-- AdminLTE App -->
<?php include_once('../inc/inc.footerjs.php'); ?>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/app.min.js"></script>
</body>
</html>
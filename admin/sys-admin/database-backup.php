<?php 
include_once('../sys/core/init.inc.php');
$common=new common();

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$TodayDate = date("Y-m-d H:m:s");
$TodayYear = date("Y");
$GUID = $_SESSION['UID'];   
// Set script max execution time
set_time_limit(0); 
date_default_timezone_set('Africa/Nairobi');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Backup System Database | <?php echo $SystemName; ?></title>
    <?php include_once('../inc/inc.meta.php'); ?>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
        <!-- Content Header (Page header) --><!-- 
        <section class="content-header">
            <h1>Backup System Database</h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Backup System Database</a></li>
            </ol>
        </section> -->

        <!-- Main content -->
        <section class="content">

            <div class="row"> 
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
                        if($CanVIEW == 1){
                    ?> 
                        <div class="tab-pane active" id="RequestListing" style="font-family: monospace; background-color: #000000; width: 100%; color: #2ef507; padding:10px; margin: -5px;"> 
                                <?php 
                                    $backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARSET);
                                    $result = $backupDatabase->backupTables(TABLES, BACKUP_DIR) ? 'OK' : 'KO';
                                    $backupDatabase->obfPrint('Backup result: ' . $result, 1); 

                                    // Use $output variable for further processing, for example to send it by email
                                    $output = $backupDatabase->getOutput();  
                                ?> 
                        </div> 
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
                          <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <!-- end loading -->
                      </div>
                    <?php
                      }
                    ?>
                </div> 
            </div>
            <!-- /.row -->

            <!--Start View Petty Cash Modal -->
            <div class="modal fade" id="LoadMZModal" role="dialog" aria-labelledby="LoadMZModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="t_aling_c"><i class="fa fa-shield"></i> Are You Sure You want to TRUNCATE TABLE?</h4>
                        </div>
                        <div class="students-data"></div>
                    </div>
                </div>
            </div>
            <!--End View Petty Cash Modal-->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!--Footer Starts -->
    <?php include_once('../inc/inc.footertext.php'); ?>
    <!--Footer Ends-->

</div>

<!-- Bootstrap 3.3.5 -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
</body>
</html>

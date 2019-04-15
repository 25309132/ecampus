<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUserID = $_SESSION['UID'];      
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['UsersNames']; ?> | <?php echo $SystemName; ?></title>
    <?php include_once('../inc/inc.meta.php'); ?> 
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>jtable/jquery.jtable.js" type="text/javascript"></script>
    <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
    <!-- Include one of jTable styles. -->
    <link href="<?php echo ASSETS_URL; ?>jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ASSETS_URL; ?>jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .m_top_25 {
            margin-top: 25px;
        }

        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            display: inline-block;
            cursor: pointer;
        } 
      .tisaini-tisaini {
          width: 98%;
      }

      label {
          margin-top: 10px;
      }
      .m_top_15{
        margin-top: 10px;
        margin-bottom: 10px;
      }
      .help-inline-error {
          color: red;
      }

      .pan_bg_accu {
          background-color: #8CC85C;
      }
      .tabs-bg-c{
        background-color: #95C321 !important;
        font-weight: 500;
        margin-top: 10px;
        margin-right: 10px;
      }
      .nav-tabs-accu{
        border: 0px !important;
      }
      .accu-grass-grn-c{
        color: #95C321 !important;
      }
      .accu-kenyan-black-c{
        color: #000000 !important;
      }
      .accu-fs-small{
        font-size: 0.8em;
        padding: 5px 18px 10px !important;
      }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <?php include_once('../inc/inc.topheader.php'); ?>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once('../inc/stars-management-menu.php'); ?>
        <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper"> <!--Start Content Wrapper -->
            <section class="content-header">
                <h1> Available Courses </h1>
                <ol class="breadcrumb">
                    <li><a href="../index"><i class="fa fa-home"></i> Main Home/ Module Select</a></li>
                    <li><a href="javascript:void(0);"> Available Courses </a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <input type="hidden" class="form-control" name="UName" id="UName" value="<?php echo $_SESSION['UName']; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <!--Lock User From Accessing This Page -->
                        <?php
                          if($CanVIEW == 1){
                        ?>
                        <!--Lock User From Accessing This Page -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-left"> 
                                <li class="active" id="PaymentIWBLink"><a href="#PaymentIW" data-toggle="tab"><i class="fa fa-list"></i> Stock Level Adjustment </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="PaymentIW"> 
                                    <!-- Start Payment  -->
                                    <div id="PaymentsIWBTabInfo">
                                        <center id="PaymentsLoader" class="r_corners">
                                            <h4 class="m_top_20 m_bottom_20">Please wait... Loading Page Contents</h4>
                                            <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                                 style="max-width:160px;">
                                        </center>
                                    </div> 
                                    <!-- /. End Payment -->
                                </div>
                                <div class="tab-pane" id="PaidIW">
                                    Paid
                                </div>
                                <div class="tab-pane" id="CompanyStatementsIW">
                                    Company Statements
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
            </section>
            <!-- /.content -->

        </div><!--End Content Wrapper -->
        <!--Footer Starts -->
        <?php include_once('../inc/inc.footertext.php'); ?>
        <!--Footer Ends-->  
    </div>
    <!-- Bootstrap 3.3.5 --> 
    <script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>plugins/daterangepicker/moment.js"></script> 
    <script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL ?>js/print.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js"></script>
    <script src="../js/sweetalert2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: 'get-available-courses-content.php',
                type: 'POST',
                async: true,
                success: function (data) { 
                    //$("#PaymentsLoader").hide( "explode", {pieces: 4 }, 500 );
                    $("#PaymentsLoader").hide("fast");
                    $('#PaymentsIWBTabInfo').html(data);
                }
            });
        });

        $(".CloseGetIWBList").on('click', function (e) {
            e.preventDefault();
            $('#searchFRM').show();
            $('#IWBDataJTable').show();
            $('#RMDLoading_ID').hide('fast');
            $('.IWBData-retrieval').hide();
            $('.retrived-IWBData').hide();
            $('#PeopleTableContainer').jtable('load');
        });

        //Date picker
        var dateToday = new Date();
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            maxDate: dateToday
        });
        //Select 2 
        $(function () {
            $(".select2").select2();
        }); 
    </script> 
</body>
</html>
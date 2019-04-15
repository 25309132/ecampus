<?php
include_once('../sys/core/init.inc.php');
$common = new common();
?>
<!DOCTYPE html>
<html>
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
    
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <?php include_once('../inc/inc.topheader.php'); ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once('../inc/stars-finance-menu.php'); ?>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Students Statutory Payments
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Students Statutory Payments </a></li>
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
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Students Statutory Payments</h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                    
                                 <div class="d_none member-data-retrieval">
                                    <div class="row">
                                        <div class="col-md-6"><h4><i class="fa fa-check-circle-o"></i> Approve Students Payment </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn  btn-success btn-md pull-right select-another-member">
                                                <span class="glyphicon glyphicon-check"></span> Select Another Payment
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                    </div>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20"> Please wait... Fetching Students Payment </h4>
                                        <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                    </center>
                                    <!--End Loading Up Data -->
                                    <div class="retrived-member-data"></div>
                                </div>

                                <!--Start Activity Content -->
                                <div class="filtering m_bottom_20">
                                    
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <label> Payment Ref/Student Name </label>
                                                <input type="text" class="form-control" name="SearchPaymentInfo" id="SearchPaymentInfo" placeholder="Search Payment by Ref/Student Name" autocomplete="OFF">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full m_top_25" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Payment
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div id="StudentsTable" class="m_top_20"> <!--Start Students Table-->
                                    <div id="PeopleTableContainer" style="width: 100%;"></div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#PeopleTableContainer').jtable({
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Students Statutory Payments',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id DESC',
                                                //selecting: true,
                                                //openChildAsAccordion: true,
                                                actions: {
                                                    listAction: 'process-listings.php?action=studentstatutorylist'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    student_id: {
                                                        title: 'Student',
                                                        width: '15%',
                                                        options: 'process-listings.php?action=studentdetails'
                                                    },
                                                    amount: {
                                                        title: 'Amount Paid',
                                                        width: '15%'
                                                    },
                                                    transactionReferenceCode: {
                                                        title: 'Reference',
                                                        width: '15%'
                                                    },
                                                    year_id: {
                                                        title: 'Year',
                                                        width: '15%',
                                                        options: 'process-listings.php?action=yearid'
                                                    },
                                                    date_added: {
                                                        title: 'Payment_Date',
                                                        width: '15%',
                                                        type: 'date',
                                                        displayFormat: 'dd-mm-yy'
                                                    },
                                                    isConfirmed: {
                                                        title: 'Confirmed',
                                                        width: '8%',
                                                        list: false
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchPaymentInfo: $('#SearchPaymentInfo').val()
                                                });
                                            });
                                            //Load person list from server
                                            $('#PeopleTableContainer').jtable('load');

                                        });

                                    </script>

                                    </div>
                                    <!--End Activity Content -->
                                </div>
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
            <!--Start Confirm Approval Modal -->
            <div class="modal fade" id="LoadModal" role="dialog" aria-labelledby="LoadModal">
                <div class="modal-dialog" style="width:720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="t_aling_c"><i class="fa fa-database"></i> Update Academic Year</h4>
                        </div>
                        <div class="students-data"></div>
                    </div>
                </div>
            </div>
            <!--End Confirm Approval Modal-->

        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <!--Footer Starts -->
    <?php include_once('../inc/inc.footertext.php'); ?>
    <!--Footer Ends-->

</div>

<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript" ></script>
<!--Start Adding School  -->
<script type="text/javascript">
    //Load approval modal page
    function LoadUpModal(GetSchlID) {
        $('.filtering').hide();
        $('#RMDLoading_ID').show();
        $('.member-data-retrieval').show();
        // Load Up Member Data
        $.ajax({
            type: 'post',
            //url: 'get-payment-details',
            url: 'get-new-student-payment-details',
            async: true,
            data: 'GFID='+GetSchlID,
            success: function (data) {
                $('#RMDLoading_ID').hide();
                $('.retrived-member-data').html(data);
            }
        });
    } 

    //View Departments
    $(".select-another-member").click(function (e) {
        e.preventDefault();
        $('.filtering').show();
        $('#RMDLoading_ID').hide();
        $('.member-data-retrieval').hide();
        $('#PeopleTableContainer').jtable('load'); // This Reloads JTable
    });
    
</script>
</body>
</html>
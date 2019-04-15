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
                Students Credit 
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Students Credit  </a></li>
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
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Students Credit </h4></a></li>
                            <li class="pull-right"><a href="#AddBookCategory" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Students Credit </h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                    
                                 <div class="d_none member-data-retrieval">
                                    <div class="row">
                                        <div class="col-md-6"><h4><i class="fa fa-check-circle-o"></i> Confirm Students Credit </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn  btn-success btn-md pull-right select-another-member">
                                                <span class="glyphicon glyphicon-check"></span> Select Another Entry
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                    </div>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20"> Please wait... Fetching Students Credit Info </h4>
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
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Students Credits',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id DESC',
                                                //selecting: true,
                                                //openChildAsAccordion: true,
                                                actions: {
                                                    listAction: 'process-listings.php?action=studentscredits'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    studentID: {
                                                        title: 'Student',
                                                        width: '15%',
                                                        options: 'process-listings.php?action=studentdetails'
                                                    },
                                                    amount: {
                                                        title: 'Amount_Credited',
                                                        width: '15%'
                                                    },
                                                    dateLogged: {
                                                        title: 'Date_Added',
                                                        width: '15%',
                                                        type: 'date',
                                                        displayFormat: 'dd-mm-yy'
                                                    },
                                                    logApproved: {
                                                        title: 'Confirmed',
                                                        width: '8%',
                                                        options: {'1':'Confirmed', '0':'Not-Confirmed'}
                                                    },
                                                    supportingDocuments: {
                                                        title: 'Documents',
                                                        width: '8%',
                                                        list: false
                                                    },
                                                    DLButton: {
                                                        title: 'Documents',
                                                        width: '10%',
                                                        display: function (data) {
                                                            if (data.record.supportingDocuments) {
                                                                return '<a style="color: white" href="../../img/payment/' + data.record.supportingDocuments + '" target="_blank"><button class="btn btn-danger w_full"> <span class="glyphicon glyphicon-download"></span> Download </button></a>'
                                                            } else {
                                                                return 'No Receipt'
                                                            }
                                                        }
                                                    },
                                                    MyButton: {
                                                        title: 'Confirm',
                                                        width: '10%',
                                                        display: function (data) {
                                                          var GetIfConfirmed = data.record.logApproved;
                                                          if(GetIfConfirmed == 1) {
                                                            return '<center> <button type="button" class="btn btn-success w_full"><i class="fa fa-shield"></i> Approved </button> </center>';
                                                          }
                                                          else if(GetIfConfirmed == 3) {
                                                            return '<center> <button type="button" class="btn btn-danger w_full"><i class="fa fa-shield"></i> Declined </button> </center>';
                                                          }
                                                          else {
                                                            return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-check"></span> Confirm </button></center>' : ''; echo $CreateButton; ?>';
                                                          }
                                                        }
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
                            <div class="tab-pane" id="AddBookCategory">
                                <!--Start Adding Subjects -->
                                <form class="contact-form cf-style-1" name="AddStatusesFRM" id="AddStatusesFRM" method="POST" action="" enctype="multipart/form-data" action="">
                                    <fieldset>
                                        <div class="box-body">
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Search Student By Admission Number / Names </label>
                                                    <input type="text" class="form-control" name="StudentInfo" id="StudentInfo" placeholder="Search Student By Admission Number / Names" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="LogStudentCreditEntry" id="LogStudentCreditEntry">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"> 
                                                        <label> Credit Amount </label>
                                                        <input type="text" class="form-control" id="AddCreditAmount" name="AddCreditAmount" placeholder="Credit Amount" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label style="margin-top: 34px;" for="file-upload" class="custom-file-upload w_full btn bg-purple btn-info">
                                                        <i class="fa fa-cloud-upload"></i> Upload Document
                                                    </label>
                                                    <input id="file-upload" class="d_none" type="file" name="DocumentName"/>
                                                </div> 
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn  btn-info btn-md w_full m_top_20" name="submit" style="float:center; margin-right: 2.6%; margin-top:34px;"><span class="glyphicon glyphicon-check"></span> Submit </button>' : '';
                                                        echo $CreateButton; ?>
                                                    </div>
                                                </div>
                                            </div><hr/>

                                        </div>
                                    </fieldset>
                                </form>
                                <!--End Adding Subjects -->
                                <!--Processing Submission -->
                                <center id="Loading_ID" class="d_none r_corners">
                                    <h4 class="m_top_20 m_bottom_20">Please wait... Processing Your Submission </h4>
                                    <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                         style="max-width:160px;">
                                </center>
                                <!--End Submission Processing -->
                            </div>
                        </div>
                        <!-- /.tab-content 1 -->

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
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript"></script>

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
            url: 'get-students-credits',
            async: true,
            data: 'GFID='+GetSchlID,
            success: function (data) {
                $('#RMDLoading_ID').hide();
                $('.retrived-member-data').html(data);
            }
        });
    } 

    jQuery().ready(function () { //StudentInfo AddCreditAmount
        var v = $("#AddStatusesFRM").validate({
            rules: {
                StudentInfo: {
                    required: true
                },
                AddCreditAmount: {
                    required: true,
                    number: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $(function () {
            $(".select2").select2();
        });
  
        // Ajax Form Submission Starts
        $("form#AddStatusesFRM").submit(function (e) {
            e.preventDefault();
            if ($('#AddStatusesFRM').valid()) {
                $("#Loading_ID").show('fast');
                $('#AddStatusesFRM').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'mm-ajax-configs.php',
                    type: 'POST',
                    data: formData,
                    async: true,
                    success: function (data) {
                        window.setTimeout(close, 1000);
                        function close() {
                            $("#Loading_ID").hide('explode');
                            $('#AddStatusesFRM').show("fast");
                            $('#AddStatusesFRM')[0].reset();
                            $('#PeopleTableContainer').jtable('load'); // This Reloads JTable
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    });

    //View Departments
    $(".select-another-member").click(function (e) {
        e.preventDefault();
        $('.filtering').show();
        $('#RMDLoading_ID').hide();
        $('.member-data-retrieval').hide();
        $('#PeopleTableContainer').jtable('load'); // This Reloads JTable
    });

    // Start On Change Scripts
    $(document).on('keydown.autocomplete', '#StudentInfo', function (e) {
        $(this).autocomplete({
            source: 'get-students-info.php', // The source of the AJAX results
            minLength: 2, // The minimum amount of characters that mu*!/st be typed before the autocomplete is triggered
            focus: function (event, ui) { // What happens when an autocomplete result is focused on
                $(this).val(ui.item.name);
                return false;
            },
            select: function (event, ui) { 
                // What happens when an autocomplete result is selected 
                $(this).val(ui.item.name);
                $('#LogStudentCreditEntry').val(ui.item.id);
            }
        });
    });

    //File Upload preview
    $('#file-upload').change(function() {
      var i = $(this).prev('label').clone();
      var file = $('#file-upload')[0].files[0].name;
      $(this).prev('label').text(file);
    });
    
</script>
</body>
</html>
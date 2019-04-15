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
        <?php include_once('../inc/stars-management-menu.php'); ?>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Semesters
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Semesters </a></li>
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
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Semesters (Search &amp; Edit)</h4></a></li>
                            <li class=" pull-right"><a href="#AddBookCategory" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Semester </h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                <!--Start Activity Content -->
                                <div class="filtering m_bottom_20">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Academic Year </label>
                                                <select class="form-control select2" name="SelectYearID" id="SelectYearID" style="width: 100%; border-radius: 0; height:36px;">
                                                    <option value="">Select Year</option>
                                                    <?php
                                                    foreach ($common->GetRows("SELECT * FROM tbl_academic_years WHERE isActive = 1") as $A) {
                                                        ?>
                                                        <option value="<?php echo $A["id"]; ?>"><?php echo $A["year"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Semesters Name / Description </label>
                                                <input type="text" class="form-control" name="SearchSemester" id="SearchSemester" placeholder="Search Academic Years by Name / Description" autocomplete="OFF">
                                            </div>
                                            
                                            <div class="col-lg-3">
                                                <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full m_top_25" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Semester
                                                </button>
                                            </div>
                                        </div>
                                            
                                    </form>
                                </div>
                                <div id="StudentsTable"> <!--Start Students Table-->
                                    <div id="PeopleTableContainer" style="width: 100%;"></div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#PeopleTableContainer').jtable({
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Listed Semesters',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id ASC',
                                                selecting: true,
                                                openChildAsAccordion: true,
                                                actions: {
                                                    listAction: 'process-listings.php?action=semesters'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    semester: {
                                                        title: 'Semester',
                                                        width: '20%'
                                                    },
                                                    year_id: {
                                                        title: 'Year',
                                                        width: '15%',
                                                        options: 'process-listings.php?action=getyears'
                                                    },
                                                    start_date: {
                                                        title: 'Start-Date',
                                                        width: '10%'
                                                    },
                                                    end_date: {
                                                        title: 'End-Date',
                                                        width: '10%'
                                                    },
                                                    description: {
                                                        title: 'Description',
                                                        width: '30%'
                                                    },
                                                    isCurrent: {
                                                        title: 'isCurrent',
                                                        width: '8%',
                                                        options: { '1': 'Yes', '0': 'No' },
                                                    },
                                                    isActive: {
                                                        title: 'Status',
                                                        width: '8%',
                                                        options: 'process-listings.php?action=status'
                                                    },
                                                    MyButton: {
                                                        title: 'Action',
                                                        width: '8%',
                                                        display: function (data) {
                                                            return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-edit"></span> Edit  </button></center>' : ''; echo $CreateButton; ?>';
                                                        }
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchSemester: $('#SearchSemester').val(),
                                                    SelectYearID: $('#SelectYearID').val()
                                                });
                                            });
                                            //Load person list from server
                                            $('#PeopleTableContainer').jtable('load');

                                        });

                                    </script>

                                </div>
                                <!--End Activity Content -->

                            </div>
                            <div class="tab-pane" id="AddBookCategory">
                                <!--Start Adding Subjects -->
                                <form class="contact-form cf-style-1 m_bottom_40" name="AddSemesterFRM"
                                      id="AddSemesterFRM" method="POST" action="" enctype="multipart/form-data"
                                      action="">
                                    <fieldset>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label> Semester </label>
                                                    <input type="text" class="form-control" name="AddSemester" id="AddSemester" placeholder="Semester" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="Register_Semester" id="Register_Semester" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Academic Year</label>
                                                    <select class="form-control select2" name="YearID" id="YearID" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="">Select Year</option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_academic_years WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["year"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label> Description </label>
                                                    <input type="text" class="form-control" name="AddSemesterDescription" id="AddSemesterDescription" placeholder="Semester Description" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="Register_Semester" id="Register_Semester" value="1">
                                                </div>
                                                <div id="end_date" class="col-lg-2">
                                                    <label> Start Date:</label>
                                                    <div class="input-group bootstrap-timepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="SemesterStartDate" name="SemesterStartDate" placeholder="YYYY-MM-DD" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div id="end_date" class="col-lg-2">
                                                    <label> End Date:</label>
                                                    <div class="input-group bootstrap-timepicker">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control datepicker" id="SemesterEndDate" name="SemesterEndDate" placeholder="YYYY-MM-DD" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-3">
                                                  <div class="form-group">
                                                    <label for="GetIsCurrent"> Is Current</label>
                                                    <div class="radio" style="margin-top:0px;">
                                                      <label for="optionsRadios11">
                                                        <input type="radio" name="GetIsCurrent" id="optionsRadios11" value="1" >
                                                        Yes &nbsp;&nbsp;&nbsp;
                                                      </label>
                                                      <label for="optionsRadios22">
                                                        <input type="radio" name="GetIsCurrent" id="optionsRadios22" value="0" checked>
                                                        No
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                            
                                                <div class="col-md-3">
                                                  <div class="form-group">
                                                    <label for="AcademicYearStatus"> Is Upcoming </label>
                                                    <div class="radio" style="margin-top:0px;">
                                                      <label for="optionsRadios1">
                                                        <input type="radio" name="IsUpcoming" id="optionsRadios1" value="1">
                                                        Yes &nbsp;&nbsp;&nbsp;
                                                      </label>
                                                      <label for="optionsRadios2">
                                                        <input type="radio" name="IsUpcoming" id="optionsRadios2" value="0" checked>
                                                        No
                                                      </label>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn btn-info btn-lg w_full m_top_20" name="submit" style="float:center; margin-right: 2.6%; margin-top:34px;"><span class="glyphicon glyphicon-check"></span> Submit Semester Details </button>' : '';
                                                        echo $CreateButton; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
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
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript" ></script>
<script src="<?php echo ASSETS_URL; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
    function LoadUpModal(getSemesterId) {
        $('#LoadModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-edit-semester.php?getSemesterId=' + getSemesterId,
            async: true,
            success: function (data) {
                $('.students-data').html(data);
            }
        });
    }

</script>
<!--Start Adding School  -->
<script type="text/javascript">
    jQuery().ready(function () {
        var v = $("#AddSemesterFRM").validate({
            rules: {//YearID AddSemesterDescription SemesterStartDate SemesterEndDate
                AddSemester: {
                    required: true
                },
                YearID: {
                    required: true
                },
                SemesterStartDate: {
                    required: true
                },
                SemesterEndDate: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $(function () {
            $(".select2").select2();
        });

        var dateToday = new Date();
        $( ".datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "yy-mm-dd",
          minDate: dateToday
        });

        // Ajax Form Submission Starts
        $("form#AddSemesterFRM").submit(function (e) {
            e.preventDefault();
            if ($('#AddSemesterFRM').valid()) {
                $("#Loading_ID").show('fast');
                $('#AddSemesterFRM').hide("fast");
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
                            $('#AddSemesterFRM').show("fast");
                            $('#AddSemesterFRM')[0].reset();
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
</script>
</body>
</html>
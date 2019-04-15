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
                Course Types
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Course Types </a></li>
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
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Course Types (Search &amp; Edit)</h4></a></li>
                            <li class=" pull-right"><a href="#AddBookCategory" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Course Types </h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                <!--Start Activity Content -->
                                <div class="filtering m_bottom_20">
                                    <form>

                                        <div class="row">
                                            
                                            <div class="col-lg-8">
                                                <label> Course Types / Description </label>
                                                <input type="text" class="form-control" name="SearchCourseType" id="SearchCourseType" placeholder="Search Course Type Name / Description" autocomplete="OFF">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full m_top_25" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Course Type
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
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Listed Course Types',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id ASC',
                                                selecting: true,
                                                openChildAsAccordion: true,
                                                actions: {
                                                    listAction: 'process-listings.php?action=coursetype'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    course_type_name: {
                                                        title: 'Course Type Name',
                                                        width: '20%'
                                                    },
                                                    description: {
                                                        title: 'Description',
                                                        width: '30%'
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
                                                            return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-edit"></span> Edit </button></center>' : ''; echo $CreateButton; ?>';
                                                        }
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchCourseType: $('#SearchCourseType').val(),
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
                                <form class="contact-form cf-style-1" name="AddStatusesFRM"
                                      id="AddStatusesFRM" method="POST" action="" enctype="multipart/form-data"
                                      action="">
                                    <fieldset>
                                        <div class="box-body">
                                            
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label> Course Type Name </label>
                                                    <input type="text" class="form-control" name="AddCourseTypeName" id="AddCourseTypeName" placeholder="Course Types Name" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="Register_CourseType" id="Register_CourseType" value="1">
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group"> 
                                                        <label> Description </label>
                                                        <input type="text" required class="form-control" id="AddCourseTypeDescription" name="AddCourseTypeDescription" placeholder="Course Type Description" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn  btn-info btn-md w_full" name="submit" style="float:center; margin-right: 2.6%; margin-top:34px;><span class="glyphicon glyphicon-check"></span> Submit Course Type </button>' : '';
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
                            <h4 class="t_aling_c"><i class="fa fa-database"></i> Update Course Status </h4>
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

<script type="text/javascript">
    function LoadUpModal(getCourseTypeId) {
        $('#LoadModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-edit-course-type.php?getCourseTypeId=' + getCourseTypeId,
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
        var v = $("#AddStatusesFRM").validate({
            rules: {
                AddCourseTypeName: {
                    required: true
                },
                AddCourseTypeDescription: {
                    required: true
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
</script>
</body>
</html>
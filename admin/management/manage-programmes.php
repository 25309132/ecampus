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
                Manage Programmes
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i> Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Manage Programmes </a></li>
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
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Programme Listing (Search &amp; Edit)</h4></a></li>
                            <li class=" pull-right"><a href="#AddBookCategory" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Programme </h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">

                                <div class="d_none member-data-retrieval">
                                    <div class="row">
                                        <div class="col-md-6"><h4><i class="fa fa-check-circle-o"></i> Manage Programme Courses </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn  btn-success btn-md pull-right select-another-member">
                                                <span class="glyphicon glyphicon-check"></span> Select Another Programme
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                    </div>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20"> Please wait... Fetching Programme Courses </h4>
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
                                                <label> Programme / Programme Name / Description </label>
                                                <input type="text" class="form-control" name="SearchSchoolName" id="SearchSchoolName" placeholder="Search School / Institution by Name / Description" autocomplete="OFF">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full m_top_25" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Programme
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="m_top_20" id="StudentsTable"> <!--Start Students Table-->
                                        <div id="PeopleTableContainer" style="width: 100%;"></div>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $('#PeopleTableContainer').jtable({
                                                    title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Listed Programmes',
                                                    paging: true,
                                                    pageSize: 10,
                                                    sorting: true,
                                                    defaultSorting: 'id ASC',
                                                    selecting: true,
                                                    openChildAsAccordion: true,
                                                    actions: {
                                                        listAction: 'process-listings.php?action=programmelist'
                                                    },
                                                    fields: {
                                                        id: {
                                                            key: true,
                                                            create: false,
                                                            edit: false,
                                                            list: false
                                                        },
                                                        programme_name : {
                                                            title: 'Programme Name',
                                                            width: '30%'
                                                        },
                                                        programme_code: {
                                                            title: 'Code',
                                                            width: '8%'
                                                        },
                                                        fee_per_module: {
                                                            title: 'Fee-Per-Module',
                                                            width: '15%'
                                                        },
                                                        isActive: {
                                                            title: 'Status',
                                                            width: '8%',
                                                            options: 'process-listings.php?action=status'
                                                        },
                                                        MyButton2: {
                                                            title: 'Edit',
                                                            width: '8%',
                                                            display: function (data) {
                                                                return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-edit"></span> Edit </button></center>' : ''; echo $CreateButton; ?>';
                                                            }
                                                        },
                                                        MyButton3: {
                                                            title: 'Manage',
                                                            width: '8%',
                                                            display: function (data) {
                                                                return '<?php $CreateButton=($CanUPDATE==1) ? '<center><button class="btn btn-success btn-small w_full" onclick="LoadProgrammeCoursesPage(\' + data . record . id + \')"> Courses <span class="glyphicon glyphicon-chevron-right"></span></button></center>' : ''; echo $CreateButton; ?>'; 
                                                            }
                                                        },
                                                    }
                                                });
                                                // Re-load records when user click 'load records' button.
                                                $('#LoadRecordsButton').click(function (e) {
                                                    e.preventDefault();
                                                    $('#PeopleTableContainer').jtable('load', {
                                                        SearchSchoolName: $('#SearchSchoolName').val(),
                                                    });
                                                });
                                                //Load person list from server
                                                $('#PeopleTableContainer').jtable('load');

                                            });

                                        </script>
                                    </div>
                                </div>
                                <!--End Activity Content -->

                            </div>
                            <div class="tab-pane" id="AddBookCategory">
                                <!--Start Adding Subjects -->
                                <form class="contact-form cf-style-1" name="AddSchoolInstitutionFRM" id="AddSchoolInstitutionFRM" method="POST" action="" enctype="multipart/form-data" action="">
                                    <fieldset>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Programme Name </label>
                                                    <input type="text" class="form-control" name="AddProgrammeName" id="AddProgrammeName" placeholder="Programme Name" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="Register_Programme" id="Register_Programme" value="1">
                                                </div>
                                                <div class="col-md-4">
                                                    <label> Programme Type </label>
                                                    <select class="form-control select2" name="ProgrammeType" id="ProgrammeType" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="">Select Programme Type </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programme_types WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["type"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group"> 
                                                        <label> Programme Code </label>
                                                        <input type="text" required class="form-control" id="AddProgrammeCode" name="AddProgrammeCode" placeholder="Programme Code" autocomplete="off" />
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Mode of Study </label>
                                                    <input type="text" class="form-control" name="mode_of_study" id="mode_of_study" placeholder="Mode of Study" autocomplete="off" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label> Fee Per Module </label>
                                                    <input type="text" class="form-control" name="fee_per_module" id="fee_per_module" placeholder="Fee Per Module" autocomplete="off" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label> Programme Contact Person </label>
                                                    <select class="form-control select2" name="contact_person_id" id="contact_person_id" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="">Select Programme Contact Person </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programme_facilitators WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["facilitator_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div><hr style="margin-bottom: 0px" >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Minimum Entry Requirements </label>
                                                        <textarea id="EntryRequirements" name="EntryRequirements" placeholder="Minimum Entry Requirements" style="height: 80px;" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> Programme Description </label>
                                                        <textarea id="CourseDescription" name="CourseDescription" placeholder="Course Description" style="height: 80px;" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div><hr >
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn btn-info btn-lg w_full" name="submit" style="float:center; margin-right: 2.6%;"><span class="glyphicon glyphicon-check"></span> Submit Programme Details</button>' : '';
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
                            <h4 class="t_aling_c"><i class="fa fa-database"></i> Edit Programme Details</h4>
                        </div>
                        <div class="students-data"></div>
                    </div>
                </div>
            </div>
            <!--End Confirm Approval Modal-->
            
            <!--Start Confirm Approval Modal -->
            <div class="modal fade" id="LoadAddDeptModal" role="dialog" aria-labelledby="LoadAddDeptModal">
                <div class="modal-dialog" style="width:520px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="t_aling_c"><i class="fa fa-database"></i> Add Department </h4>
                        </div>
                        <div class="departments-data"></div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="LoadUpDeletePCourseModal" role="dialog" aria-labelledby="LoadUpDeletePCourseModal">
                <div class="modal-dialog" style="width:520px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="t_aling_c"><i class="fa fa-trash-o"></i> Remove Course From Programme </h4>
                        </div>
                        <div class="delete-pcourse-data"></div>
                    </div>
                </div>
            </div>

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
    //Add New School
    jQuery().ready(function () {
        var v = $("#AddSchoolInstitutionFRM").validate({
            rules: { //Register_Programme AddProgrammeName ProgrammeType AddProgrammeCode fee_per_module mode_of_study contact_person_id CourseDescription EntryRequirements
                AddProgrammeName: {
                    required: true
                },
                fee_per_module: {
                    required: true,
                    number: true
                },
                ProgrammeType: {
                    required: true
                },
                AddProgrammeCode: {
                    required: true
                },
                mode_of_study: {
                    required: true
                },
                contact_person_id: {
                    required: true
                }, 
                EntryRequirements: {
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
        $("form#AddSchoolInstitutionFRM").submit(function (e) {
            e.preventDefault();
            if ($('#AddSchoolInstitutionFRM').valid()) {
                $("#Loading_ID").show('fast');
                $('#AddSchoolInstitutionFRM').hide("fast");
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
                            $('#AddSchoolInstitutionFRM').show("fast");
                            $('#AddSchoolInstitutionFRM')[0].reset();
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
    //End Add new school
    
    //View Departments
    $(".select-another-member").click(function (e) {
        e.preventDefault();
        $('.filtering').show();
        $('#RMDLoading_ID').hide();
        $('.member-data-retrieval').hide();
    });
    
    function LoadUpModal(getProgrammeId) {
        $('#LoadModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-edit-programmes.php?getProgrammeId=' + getProgrammeId,
            async: true,
            success: function (data) {
                $('.students-data').html(data);
            }
        });
    }

    function LoadProgrammeCoursesPage(GetSchlID) {
        $('.filtering').hide();
        $('#RMDLoading_ID').show();
        $('.member-data-retrieval').show();
        // Load Up Member Data
        $.ajax({
            type: 'post',
            url: '../management/get-programme-courses',
            async: true,
            data: 'GFID='+GetSchlID,
            success: function (data) {
                $('#RMDLoading_ID').hide();
                $('.retrived-member-data').html(data);
            }
        });
    } 

</script>

</body>
</html>
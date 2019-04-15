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
                <li><a href="../index"><i class="fa fa-home"></i>Home/ Module Select</a></li>
                <li><a href="javascript:void(0);"> Manage Programmes</a></li>
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
                            <li class="active"><a href="#activity" data-toggle="tab"><h4><i class="fa fa-list"></i> Programmes Listing (Search &amp; Edit)</h4></a></li>
                            <li class=" pull-right"><a href="#AddBookCategory" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Programme </h4></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="activity">
                                <!--Start Activity Content -->
                                <div class="filtering m_bottom_20">
                                    <form>

                                        <div class="row">

                                            <div class="col-lg-8">
                                                <label>Search Programme Name / Description </label>
                                                <input type="text" class="form-control" name="SearchProgramme" id="SearchProgramme" placeholder="Search Department by Name / Description" autocomplete="OFF">
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full m_top_25" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Programme
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
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Listed Programmes',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id ASC',
                                                selecting: true,
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
                                                    programme_name: {
                                                        title: 'Programme Name',
                                                        width: '30%'
                                                    },
                                                    type_id: {
                                                        title: 'Programme Type',
                                                        width: '20%',
                                                        options: 'process-listings.php?action=progtypes'
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
                                                        title: 'Campuses',
                                                        width: '5%',
                                                        sorting: false,
                                                        edit: false,
                                                        create: false,
                                                        display: function (accessLevelData) {
                                                            // Create an image that will be used to open child table
                                                            var $img = $('<center><button class="btn btn-success btn-small w_full"><span class="glyphicon glyphicon-list">' +
                                                                '</span> Campuses </button></center>');
                                                            $img.click(function () {
                                                                $('#PeopleTableContainer').jtable('openChildTable',
                                                                    $img.closest('tr'), {
                                                                        title: accessLevelData.record.programme_name + ' Campuses Offered',
                                                                        actions: {
                                                                            listAction: 'process-listings.php?SchoolProgrammes='+accessLevelData.record.id+'',
                                                                        },
                                                                        fields: {
                                                                            id: {
                                                                                title: 'ID',
                                                                                width: '4%',
                                                                                list: false
                                                                            },
                                                                            campus_id: {
                                                                                title: 'School',
                                                                                width: '10%',
                                                                                options: 'process-listings.php?action=campuses'
                                                                            },
                                                                            school_description: {
                                                                                title: 'Description',
                                                                                width: '10%'
                                                                            },
                                                                            isActive: {
                                                                                title: 'Status',
                                                                                width: '8%',
                                                                                options: 'process-listings.php?action=status'
                                                                            },
                                                                            BtnEdit: {
                                                                                title: 'Action',
                                                                                width: '8%',
                                                                                display: function (data) {
                                                                                    return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-danger btn-small" onclick="LoadUpDeleteModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-trash"></span> Remove </button></center>' : ''; echo $CreateButton; ?>';
                                                                                }
                                                                            }
                                                                        }
                                                                    },
                                                                    function (data) { // opened handler
                                                                        data.childTable.jtable('load');
                                                                    });
                                                            });
                                                            //Return image to show on the Access
                                                            return $img;
                                                        }
                                                    },
                                                    MyButton2: {
                                                        title: 'Courses',
                                                        width: '8%',
                                                        display: function (data) {
                                                            return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-danger btn-small" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-check"></span> Courses </button></center>' : ''; echo $CreateButton; ?>';
                                                        }
                                                    },
                                                    MyButton3: {
                                                        title: 'Action',
                                                        width: '8%',
                                                        display: function (data) {
                                                            return '<?php $CreateButton = ($CanUPDATE == 1) ? '<center><button class="btn btn-info btn-small" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-edit"></span> Edit </button></center>' : ''; echo $CreateButton; ?>';
                                                        }
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchProgramme: $('#SearchProgramme').val()
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
                                <form class="contact-form cf-style-1 m_bottom_40" name="AddProgrammeFRM"
                                      id="AddProgrammeFRM" method="POST" action="" enctype="multipart/form-data"
                                      action="">
                                    <fieldset>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Programme Name</label>
                                                    <input type="text" class="form-control" name="AddProgrammeName" id="AddProgrammeName" placeholder="Programme Name" autocomplete="off" />
                                                    <input type="hidden" class="form-control" name="Register_Programme" id="Register_School" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Programme Type</label>
                                                    <select class="form-control select2" name="ProgrammeTypeId" id="ProgrammeTypeId" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Programme Type</option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programme_types WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["type"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group"> 
                                                        <label>Department Description</label>
                                                        <input type="text" required class="form-control" id="AddProgrammeDescription" name="AddProgrammeDescription" placeholder="Programme Description" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="phoneno">Select Campuses Offered</label>
                                                        <input name="Programmes_Maggic_Suggest" id="Programmes_Maggic_Suggest" class="form-control">
                                                        <input type="hidden" name="Programmes_Maggic_Suggest[]" id="Programmes_Maggic_Suggest" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn  btn-info btn-lg w_full" name="submit" style="float:center; margin-right: 2.6%; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Submit Programme Details</button>' : '';
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
                    <?php } ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--Start Confirm Approval Modal -->
            <div class="modal fade" id="LoadModal" role="dialog" aria-labelledby="LoadModal">
                <div class="modal-dialog" style="width:720px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="t_aling_c"><i class="fa fa-database"></i> Update Department Details</h4>
                        </div>
                        <div class="students-data"></div>
                    </div>
                </div>
            </div>
            <!--End Confirm Approval Modal-->
            <!--Start Remove School Modal-->
            <div class="modal fade" id="LoadUpDeleteModal" role="dialog" aria-labelledby="LoadUpDeleteModal">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="t_aling_c"><i class="fa fa-trash-o"></i> Remove School </h4>
                      </div>
                      <div class="schools-data"></div>
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

<script type="text/javascript">
    function LoadUpModal(getDepartmentId) {
        $('#LoadModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-edit-department.php?getDepartmentId=' + getDepartmentId,
            async: true,
            success: function (data) {
                $('.students-data').html(data);
            }
        });
    }

    function LoadUpDeleteModal(getSchoolId) {
        $('#LoadUpDeleteModal').modal({backdrop: 'static', keyboard: false});
        $.ajax({
            url: 'ajax-remove-school.php?getSchoolId=' + getSchoolId,
            async: true,
            success: function (data) {
                $('.schools-data').html(data);
            }
        });
    }

    $(function () {
        $(".select2").select2();
    });

</script>

<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>

<!--Start Adding School  -->
<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#AddProgrammeFRM").validate({
            rules: {//AddProgrammeName AddProgrammeDescription ProgrammeTypeId
                AddProgrammeName: {
                    required: true
                },
                ProgrammeTypeId: {
                    required: true
                },
                Programmes_Maggic_Suggest: {
                     required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

    });
</script>

<script type="text/javascript">
    // Ajax Form Submission Starts
    $("form#AddProgrammeFRM").submit(function (e) {
        e.preventDefault();
        if ($('#AddProgrammeFRM').valid()) {
            $("#Loading_ID").show('fast');
            $('#AddProgrammeFRM').hide("fast");
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
                        $('#AddProgrammeFRM').show("fast");
                        $('#AddProgrammeFRM')[0].reset();
                        $('#PeopleTableContainer').jtable('load'); // This Reloads JTable
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>
<!--End Adding Book Categories -->
<script type="text/javascript">
    var j = jQuery.noConflict();
    j('#Programmes_Maggic_Suggest').magicSuggest({
        placeholder: 'Choose schools which offer the programme',
        data: 'action.getdepartments.php?Campuses=1',
        valueField: 'id',
        displayField: 'campus_name',
    });
</script>
</body>
</html>
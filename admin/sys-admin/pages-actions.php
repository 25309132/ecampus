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
    <style type="text/css">
        .m_top_25 {
            margin-top: 25px;
        }

        .tisaini-tisaini {
            width: 98%;
        }

        label {
            margin-top: 10px;
        }

        .help-inline-error {
            color: red;
        }

        .pan_bg_accu {
            background-color: #8CC85C;
        }
    </style>
    <link rel="stylesheet" href="../css/formValidation.css"/>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <?php include_once('../inc/inc.topheader.php'); ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once('../inc/inc.school-admin-menu.php'); ?>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage Main/ Pages Actions
            </h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Main Home/ Module Select</a></li>
                <li><a href="javascript:void(0);">Manage Main/ Pages Actions</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom border_grey">
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#AddNewPlotManager" data-toggle="tab"><h4><i class="fa fa-folder-o"></i> Add Pages Actions </h4></a></li>
                            <li class="pull-left"><a href="#AgentsListing" data-toggle="tab"><h4><i class="fa fa-database"></i> Edit / View Pages Listing </h4></a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="AddNewPlotManager">
                                <!--Form Wizard Starts -->
                                <form class="contact-form cf-style-1 m_top_20 m_bottom_40" name="Submit_New_Plot_Form"
                                      id="Submit_New_Plot_Form" method="POST" action="" enctype="multipart/form-data"
                                      action="">
                                    <div class="box-body" id="Final_FormID">
                                        <!--Plot Details Start -->
                                        <div class="box-body">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Select System</label>
                                                            <select class="form-control select2" id="System_Module"
                                                                    name="System_Module" style="width: 100%;" required>
                                                                <option value="" selected> Choose System:</option>
                                                                <?php $UDSTT = $common->GetRows("SELECT id, sys_name FROM `tbl_sys_modules`;");
                                                                foreach ($UDSTT as $UDSsTT) { ?>
                                                                    <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['sys_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="hidden" class="form-control"
                                                                   name="KDCRegisterSubPages" id="KDCRegisterSubPages"
                                                                   value="3">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Select Module</label>
                                                            <select class="form-control select2" id="SystemModule"
                                                                    name="SystemModule" style="width: 100%;"
                                                                    required></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Select Page</label>
                                                            <select class="form-control select2" id="SysPageid"
                                                                    name="SysPageid" style="width: 100%;"
                                                                    required></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="phoneno">Assigned To</label>
                                                            <input name="menu_group_access2" id="menu_group_access2"
                                                                   class="form-control"
                                                                   placeholder="Enter one or multiple User Groups">
                                                            <input type="hidden" name="menu_group_access2[]"
                                                                   id="menu_group_access2" class="form-control"
                                                                   placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <label for="view">Can View</label>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="view" id="view"> View
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="create">Can Create</label>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="create" id="create"> Create
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label for="update">Can Edit</label>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="update" id="update"> Edit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-lg-4">
                                                        <label for="delete">Can Delete</label>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="delete" id="delete"> Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group  col-lg-4">
                                                        <label for="approve">Can Approve</label>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="approve" id="approve">
                                                                Approve
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <fieldset style="margin: 10px 10px 10px 10px; text-align: center;">
                                                    <div class="box-footer">
                                                        <?php $CreateButton = ($CanCREATE == 1) ? '<button type="submit" class="btn w_full btn-info btn-lg" name="submit" style="float:center; margin-right: 2.6%;"><span class="glyphicon glyphicon-check"></span> Submit Pages Actions</button>' : '';
                                                        echo $CreateButton; ?>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <!--Plot Survey Details End-->
                                </form><!--Form Wizard Ends -->
                                <!--Processing Submission -->
                                <center id="Loading_ID" class="d_none r_corners">
                                    <h4 class="m_top_20 m_bottom_20">Please wait... Processing Your Submission </h4>
                                    <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                         style="max-width:160px;">
                                </center>
                                <!--End Submission Processing -->
                            </div>
                        </div>
                        <!--Agents Listing Start -->
                        <div class="active tab-pane" id="AgentsListing">
                            <!--SCRUD System Starts -->
                            <div class="Posted_Plots_Listing">
                                <?php
                                $AFInfo = $common->GetRows("SELECT a.*, `s`.`sys_name` as Systemname, `m`.`name` as Modulename, `p`.`name` pagename FROM tbl_pages_actions a left join tbl_sys_modules s on `a`.`sys_id` = `s`.`id` left join tbl_sys_module_child `m` on `a`.`mod_id` =`m`.`id` left join tbl_modules_pages_access p on `a`.`par_id` = `p`.`id`;");
                                if (!$AFInfo)
                                {
                                   $UserDuplicateError12 = '<div class="alert alert-danger alert-dismissable t_align_c m_top_20">
                      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>There Are No Pages Actions Registered in the Systems Database!
                      </div>';
                                }
                                else { ?>
                                <table id="PlotMgrsTable" class="table table-bordered table-striped responds">

                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>System</th>
                                        <th>Module</th>
                                        <th>PageName</th>
                                        <th>C</th>
                                        <th>V</th>
                                        <th>U</th>
                                        <th>D</th>
                                        <th>A</th>
                                        <th>User Groups</th>
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($AFInfo as $InfoSc) {
                                        $id = $InfoSc['id'];
                                        $Systemname = $InfoSc['Systemname'];
                                        $Modulename = $InfoSc['Modulename'];
                                        $Pagename = $InfoSc['pagename'];
                                        $create = ($InfoSc['create'] == '1') ? 'Yes' : 'No';
                                        $update = ($InfoSc['update'] == '1') ? 'Yes' : 'No';
                                        $delete = ($InfoSc['delete'] == '1') ? 'Yes' : 'No';
                                        $view = ($InfoSc['view'] == '1') ? 'Yes' : 'No';
                                        $approve = ($InfoSc['approve'] == '1') ? 'Yes' : 'No';
                                        $group_access = $InfoSc['group_access'];
                                        $array_product_id = explode(",", $group_access);
                                        $latest = "";
                                        $st = "";
                                        //2,3,3 format
                                        for ($i = 0; $i < sizeof($array_product_id); $i++) {
                                            $product_id1 = $array_product_id[$i];
                                            $product_id2 = trim($product_id1);
                                            foreach ($common->GetRows("SELECT usergroup_name FROM tbl_usergroups WHERE usergroup_id='$product_id2' AND isActive=1;") as $row) {
                                                $st = rtrim($row["usergroup_name"]);
                                                $latest = $latest . $st . ", ";
                                            }

                                        }

                                        ?>
                                        <tr class="responds" id="item_<?php echo $id; ?>">
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $Systemname; ?></td>
                                            <td><?php echo $Modulename; ?></td>
                                            <td><?php echo $Pagename; ?></td>
                                            <td><?php echo $create; ?></td>
                                            <td><?php echo $view; ?></td>
                                            <td><?php echo $update; ?></td>
                                            <td><?php echo $delete; ?></td>
                                            <td><?php echo $approve; ?></td>
                                            <td><?php echo $latest; ?></td>
                                            <td>
                                                <?php $UpdateButton = ($CanVIEW == 1) ? '<center><a href="#Agents_Modal" class="btn btn-info btn-small btn-agent-id" id="AgentIDData" data-toggle="modal" data-id="' . $id . '"><i class="glyphicon glyphicon-check"></i> Edit Item</a></center>' : '';
                                                echo $UpdateButton;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    }
                                    echo $UserDuplicateError12;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--End SCRUD System -->

                            <!--Edit Listed Plot Details Start -->
                            <div class="edit_plot_data d_none">
                                <section class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn  btn-danger btn-lg cancel_edit_btn"><span
                                                    class="glyphicon glyphicon-check"></span> Cancel Pages Actions Edit
                                        </button>
                                    </div>
                                </section>
                                <div class="fetched-data"></div>
                            </div>
                            <!--Edit LIsted Plot Details End -->

                        </div>
                        <!--Agents Listing Ends -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
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
<!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="<?php echo ASSETS_URL; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/fastclick/fastclick.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<!-- Dependent Listbox -->
<script src="../js/dependent-dropdown.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#PlotMgrsTable").dataTable();
    });
    $(function () {
        $(".select2").select2();
    });
    //Deo For Menus
    $(function () {
        $("#SystemModule").depdrop({
            depends: ['System_Module'],
            url: 'ajax-get-actions.php?GetModule=1'
        });
    });
    //Deo For pages
    $(function () {
        $("#SysPageid").depdrop({
            depends: ['SystemModule'],
            url: 'ajax-get-actions.php?GetPage=1'
        });
    });
    $('#menu_group_access2').magicSuggest({
        placeholder: 'Enter one or multiple group',
        data: 'action.systemsaccess.php?UserGroups=1',
        valueField: 'usergroup_id',
        displayField: 'usergroup_name',
    });
    // Get Modal Data ID
    $('.btn-agent-id').click(function (e) {
        e.preventDefault();
        var rowid = $(this).data('id');
        $('.edit_plot_data').show('fast');
        $('.Posted_Plots_Listing').hide('fast');
        //alert(rowid)
        $.ajax({
            type: 'post',
            url: 'action.updatepagesactions.php',
            data: 'rowid=' + rowid,
            success: function (data) {
                $('.fetched-data').html(data);
            }
        });
    });
    $('#user_id').magicSuggest({
        placeholder: 'Enter one or multiple team members',
        data: 'action.pagesactions.php?UserGroups=1',
        valueField: 'usergroup_id',
        displayField: 'usergroup_name',
    });
</script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
    jQuery().ready(function () { //System_Module Register_SubPages SystemModule SysPageid menu_group_access2 view create update approve
        var v = jQuery("#Submit_New_Plot_Form").validate({
            rules: {
                System_Module: {
                    required: true
                },
                SystemModule: {
                    required: true
                },
                SysPageid: {
                    required: true
                },
                menu_group_access2: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
        //
        $(".cancel_edit_btn").click(function () {
            $('.edit_plot_data').hide('fast');
            $('.Posted_Plots_Listing').show('fast');
        });

    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("form#Submit_New_Plot_Form").submit(function (e) {
            e.preventDefault();
            var sys_id = $("#sys_id").val();
            var mod_id = $("#mod_id").val();

            if ($('#Submit_New_Plot_Form').valid()) {
                $("#Loading_ID").show('fast');
                $('#Final_FormID').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'action.systemsaccess.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        window.setTimeout(close, 1000);
                        setTimeout(function () {

                        }, 1000);
                        function close() {
                            $('#Final_FormID').show("fast");
                            $("#Loading_ID").hide('fast');
                            $('#Submit_New_Plot_Form')[0].reset();
                            $('#sf1').show("fast");
                            $("#sf2").hide('fast');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });

            }// End Else
            return false;
        });

    });
</script>
</body>
</html>
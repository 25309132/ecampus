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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Systems Access</h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Main Home</a></li>
                <li><a href="javascript:void(0);"> Systems Access</a></li>
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
                            <li class="pull-left active"><a href="#AgentsListing" data-toggle="tab"><h4><i class="fa fa-bars"></i> Systems Access Listing </h4></a></li>
                            <li class="pull-right"><a href="#AddAccess" data-toggle="tab"><h4><i class="fa fa-plus"></i> Register New System </h4></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="AddAccess">
                                <form class="contact-form cf-style-1 m_bottom_40" name="Add_SystemRights_Form"
                                      id="Add_SystemRights_Form" method="POST" action="" enctype="multipart/form-data"
                                      action="">
                                    <div class="box-body" id="Final_FormID">
                                        <fieldset>
                                            <!--Plot Details Start -->
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>System Name</label>
                                                            <input type="text" class="form-control" name="AddSystemName"
                                                                   id="AddSystemName" placeholder="System Name"/>
                                                            <input type="hidden" class="form-control" name="HiddenAdd"
                                                                   id="HiddenAdd" autocomplete="OFF">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>System Icon</label>
                                                            <input type="text" class="form-control" name="SystemIcon"
                                                                   id="SystemIcon" placeholder="System Icon"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
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
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>System URL</label>
                                                            <input type="text" class="form-control" name="SystemURL"
                                                                   id="SystemURL" placeholder="System URL"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 d_none">
                                                        <div class="form-group">
                                                            <label>Background Color</label>
                                                            <input type="text" class="form-control" name="background"
                                                                   id="background" placeholder="Background"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-lg w_full btn-info" name="submit">
                                                            <span class="glyphicon glyphicon-check"></span> Add User Group Access Details
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </form>
                            </div>
                            <!--Agents Listing Start -->
                            <div class="active tab-pane" id="AgentsListing">
                                <!--SCRUD System Starts -->
                                <div class="Posted_Plots_Listing">
                                    <?php $AFInfo = $common->GetRows("SELECT * FROM tbl_sys_modules WHERE isDeleted = 0");
                                    if (!$AFInfo)
                                    {
                                        $UserDuplicateError12 = '<div class="alert alert-danger alert-dismissable t_align_c m_top_20">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>There Are No Systems Registered on the Systems Database!
                      </div>';
                                    }
                                    else { ?>
                                    <table id="PlotMgrsTable" class="table table-bordered table-striped responds">
                                        <thead>
                                        <tr>
                                            <th class="d_none">ID</th>
                                            <th>System Name</th>
                                            <th>URL</th>
                                            <th>Icon</th>
                                            <th>Group With Access</th>
                                            <th>
                                                <center>Action</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($AFInfo as $InfoSc) {
                                            $id = $InfoSc['id'];
                                            $name = $InfoSc['sys_name'];
                                            $sysurl = $InfoSc['url'];
                                            $sys_icon = $InfoSc['sys_icon'];
                                            $sys_info = $InfoSc['sys_info'];
                                            $background = $InfoSc['sys_color'];
                                            $group_access = $InfoSc['group_access'];
                                            // Group Access
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
                                                <td class="d_none"><?php echo $id; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $sysurl; ?></td>
                                                <td><?php echo $sys_icon; ?></td>
                                                <td><?php echo $latest; ?></td>
                                                <td>
                                                    <?php $UpdateButton = ($CanUPDATE == 1) ? '<center>
                                                        <a href="#Agents_Modal" class="btn btn-info btn-small btn-agent-id" id="AgentIDData" data-toggle="modal" 
                                                        data-id="' . $id . '"><i class="glyphicon glyphicon-check"></i> Edit Item</a></center>' : ''; echo $UpdateButton;
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php } } echo $UserDuplicateError12;
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--End SCRUD System -->
                                <!--Edit Listed Plot Details Start -->
                                <div class="edit_plot_data d_none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4><p class="text-aqua"><i class="fa fa-fw fa-adjust"></i> Update System
                                                    Menus </p></h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <button class="btn btn-danger btn-md pull-right cancel_edit_btn"><span
                                                        class="glyphicon glyphicon-check"></span> Select Another Item
                                            </button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20">Please wait... Fetching Data</h4>
                                        <img src="images/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                             style="max-width:160px;">
                                    </center>
                                    <!--End Loading Up Data -->
                                    <div class="fetched-data"></div>
                                </div>
                                <!--Edit LIsted Plot Details End -->

                                <!--Edit Listed Plot Details Start
                                  <div class="edit_plot_data d_none">
                                      <section class="row">
                                        <div class="col-lg-12">
                                          <button type="button" class="btn  btn-danger btn-lg cancel_edit_btn"><span class="glyphicon glyphicon-check"></span> Cancel User Group Access Edit</button>
                                        </div>
                                      </section>
                                      <div class="fetched-data"></div>
                                  </div>
                                Edit LIsted Plot Details End

                              </div> -->
                                <!--Agents Listing Ends -->

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
<!-- ./wrapper -->
<!--Start Mikes JS -->
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
<script type="text/javascript" src="jquery.validate.js"></script>
<!--End JS Includes -->

<script type="text/javascript">
    $(function () {
        $("#PlotMgrsTable").dataTable();
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
            url: 'action.getsystemsaccessdata.php',
            data: 'rowid=' + rowid,
            success: function (data) {
                $('.fetched-data').html(data);
            }
        });
    });

    $(".cancel_edit_btn").click(function () {
        $('.edit_plot_data').hide('fast');
        $('.Posted_Plots_Listing').show('fast');
    });

</script>
<script type="text/javascript">
    jQuery().ready(function () { //Add_SystemRights_Form System_Name HiddenAdd SystemIcon menu_group_access2 SystemURL background AddSystemName
        var v = jQuery("#Add_SystemRights_Form").validate({
            rules: {
                AddSystemName: {
                    required: true
                },
                SystemIcon: {
                    required: true
                },
                menu_group_access2: {
                    required: true,
                    minlength: 2
                },
                SystemURL: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("form#Add_SystemRights_Form").submit(function (e) {
            e.preventDefault();
            if ($('#Add_SystemRights_Form').valid()) {
                $("#Loading_ID").show('fast');
                $('#Final_FormID').hide("fast");
                //var SAID = $('#menu_group_access2').val();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'action.systemsaccess',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        window.setTimeout(close, 2000);
                        setTimeout(function () {
                        }, 3000);
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
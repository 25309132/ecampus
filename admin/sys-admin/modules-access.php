<?php
include_once('../sys/core/init.inc.php');
$common=new common();
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
    label{margin-top: 10px;}
          .help-inline-error{color:red;}
    .pan_bg_accu{
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
    <?php include_once('../inc/inc.system-admin-menu.php'); ?>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Manage Modules Access</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-home"></i>Home/ Modules Access</a></li>
        <li><a href="javascript:void(0);"><i class="fa fa-briefcase"></i> Modules Access</a></li>
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
              <li class="pull-left active"><a href="#Listing" data-toggle="tab"><h4><i class="fa fa-database"></i> Modules Access </h4></a></li>
              <li class="pull-right"><a href="#AddNewBanks" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add Modules Access </h4></a></li>
            </ul>
            <div class="tab-content">
              <!--Start Activity Content -->
              <div class="active tab-pane" id="Listing">
                <!--SCRUD System Starts -->
                <div class="item-data-retriving d_none">
                    <div class="row">
                      <div class="col-lg-6"><h4><p class="text-aqua"><i class="fa fa-fw fa-adjust"></i> Update System Module </p></h4></div>
                      <div class="col-lg-6">
                        <button class="btn btn-danger btn-md pull-right select-another-item"><span class="glyphicon glyphicon-check"></span> Select Another Item </button>
                      </div>
                    </div><hr />
                    <!--Load Up Data -->
                      <center  id="RMDLoading_ID" class="d_none r_corners">
                        <h4 class="m_top_20 m_bottom_20">Please wait... Fetching Module Data</h4>
                        <img src="images/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                      </center>
                    <!--End Loading Up Data -->
                  </div>
                <div class="item-data-retrived"></div>
                <div class="System_Menus_listing">
                 <?php $AFInfo = $common->GetRows("SELECT `sc`.*, sm.sys_name FROM tbl_sys_module_child sc LEFT JOIN tbl_sys_modules `sm` ON `sm`.`id` = `sc`.`par_id` WHERE `sm`.`isDeleted` <> 1;") ;
                    if(!$AFInfo) {
                      $UserDuplicateError12 = '<div class="alert alert-danger alert-dismissable t_align_c m_top_20">
                      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> There Are No System Modules on the Systems Database!
                      </div>'; }
                    else { ?>
                  <table id="PlotMgrsTable" class="table table-bordered table-striped responds">
                    <thead>
                      <tr>
                          <th class="d_none">ID</th>
                          <th>System Name</th>
                          <th>Module Name</th>
                          <th>URL</th>
                          <th>Groups With Access</th>
                          <th><center>Action</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($AFInfo as $InfoSc) {
                          $id = $InfoSc['id'];
                          $SystemName = $InfoSc['sys_name']; 
                          $ModuleName = $InfoSc['name'];
                          $sysURL = $InfoSc['url'];
                          $sysinfo = $InfoSc['sys_info'];
                          $group_access = $InfoSc['group_access'];
                          $status = $InfoSc['isActive'];
                          if($status == 1) {
                            $actualstatus = 'Active';
                          }
                          else{
                            $actualstatus = 'InActive';
                          }
                          $array_product_id = explode(",",$group_access);
                          $latest="";
                          $st=""; //2,3,3 format
                        
                        for($i = 0; $i < sizeof($array_product_id); $i++) {
                          $product_id1=$array_product_id[$i];
                          $product_id2=trim($product_id1);
                          foreach ($common->GetRows("SELECT usergroup_name FROM `tbl_usergroups` where usergroup_id='$product_id2' AND isActive=1;") as $row) {
                            $st=rtrim($row["usergroup_name"]);
                            $latest= $latest.$st.", ";
                          }
                              
                        } ?>
                        <tr class="responds" id="item_<?php echo $id; ?>">
                          <td class="d_none"><?php echo $id; ?></td>
                          <td><?php echo $SystemName; ?></td>
                          <td><?php echo $ModuleName; ?></td>
                          <td><?php echo $sysURL; ?></td>
                          <td><?php echo $latest; ?></td>
                          <td>
                            <?php $UpdateButton = ($CanUPDATE == 1) ? '
                              <center>
                                <a href="#Agents_Modal" class="btn btn-info btn-small btn-agent-id" id="AgentIDData" data-toggle="modal" data-id="' . $id . '"><i class="glyphicon glyphicon-check"></i> Edit Item</a>
                              </center>' : ''; echo $UpdateButton;
                            ?> 
                          </td> 
                        </tr>
                          <?php  }  }
                            echo $UserDuplicateError12; ?>
                          </tbody>
                      </table>
                  </div>
                <!--End SCRUD System -->
              </div> 
              <div class="tab-pane" id="AddNewBanks">
                <?php echo $SuccessAlert; ?>
                  <form action="" enctype="multipart/form-data" method="post" id="Add_Menu_FRM" name="Add_Menu_FRM" data-fv-message="This value is not valid" data-fv-icon-validating="glyphicon glyphicon-refresh">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label> System Name</label>
                                    <select class="form-control select2" name="AddSystemID" id="AddSystemID" style="width: 100%;">
                                        <option value="" selected>Select System Name</option>
                                        <?php $UDSTT = $common->GetRows("SELECT id, `sys_name` FROM `tbl_sys_modules`;");
                                        foreach ($UDSTT as $UDSsTT) { ?>
                                            <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['sys_name']; ?></option><?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="SubmitSystemModule" id="SubmitSystemModule" value="1">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Module Name</label>
                                    <input type="text" class="form-control" name="AddSystemModuleName" id="AddSystemModuleName" placeholder="Module Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Module URL</label>
                                    <input type="text" class="form-control" name="AddSystemModuleURL" id="AddSystemModuleURL" placeholder="Module URL">
                                </div>
                            </div> 
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Module Icon</label>
                                    <input type="text" class="form-control" name="AddSystemModuleIcon" id="AddSystemModuleIcon" placeholder="Module URL">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Select User Groups:</label>
                                    <select class="form-control select2" name="SelectGroups" id="SelectGroups" multiple="multiple"
                                            data-placeholder="User Group" style="width: 100%;">
                                        <?php $UDSTT = $common->GetRows("SELECT usergroup_id, usergroup_name FROM `tbl_usergroups`;");
                                        foreach ($UDSTT as $UDSsTT) { ?>
                                            <option value="<?php echo $UDSsTT['usergroup_id']; ?>"><?php echo $UDSsTT['usergroup_name']; ?></option><?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Unique Name</label>
                                    <input type="text" class="form-control" name="AddUniqueName" id="AddUniqueName" placeholder="Unique Name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Display Position</label>
                                    <input type="text" class="form-control" name="AddDisplayPosition" id="AddDisplayPosition" placeholder="Display Position">
                                </div>
                            </div> 
                            <div class="col-lg-3">
                                <button type="submit" class="btn  btn-info w_full EditButton" name="EditButton" id="EditButton" style="float:center; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Add System Module
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <!-- /.box-body -->
                <!--Processing Submission-->
                <center  id="LoadingP_ID" class="d_none r_corners">
                  <h4 class="m_top_20 m_bottom_20">Please wait... Processing Your Submission </h4>
                  <img src="images/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
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
      <div class="modal fade" id="LoadUpModal" role="dialog" aria-labelledby="LoadUpModal">
        <div class="modal-dialog" style="width:720px;">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="t_aling_c"><i class="fa fa-database"></i> Update System Menu Details</h4>
            </div>
            <div class="students-data"></div> 
          </div>
        </div>
      </div>
    <!--End Confirm Approval Modal-->
    </section>
    <!-- /.content -->
   </div><!-- /.content-wrapper -->
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
<!--DOM MAnipulaion Scripts -->
<script type="text/javascript">
  $('.btn-agent-id').click(function(e) { 
        e.preventDefault();
        //var rowid = $(this).attr('href');
        var rowid = $(this).data('id');
        $('.System_Menus_listing').hide('fast');
        $('#RMDLoading_ID').show();
        $('.item-data-retriving').show('fast'); 
        //alert(rowid)
        $.ajax({
            type : 'post',
            url : 'ajax-get-system-modules.php',
            data:  'rowid='+rowid,
            success : function(data){
              $('#RMDLoading_ID').hide();
              $('.item-data-retrived').show();
              $('.item-data-retrived').html(data);
            }
        });
  });

  // Deo Drops
  $(function() {
    $("#SystemModule").depdrop({
        depends: ['System_Module'],
        url: 'ajax-get-actions.php?GetModule=1'
    });
  });
  $(".select-another-item").click(function(e){
    e.preventDefault(); // item-data-retriving item-data-retrived System_Module System_Menu Page_Name Hidden_Page_Name Page_URL Unique_Name SelectGroups
      $('.item-data-retrived').hide(); 
      $('.item-data-retriving').hide();
      $('.System_Menus_listing').show(); 
  });
  
</script>
<script type="text/javascript">
  $(function() {
      $("#PlotMgrsTable").dataTable();
  });
  $(function() {
    $(".select2").select2();
  });
  $(function() { // addCountry addBank
    $("#SystemModule").depdrop({
        depends: ['Select_System'],
        url: 'ajax-get-actions.php?GetModule=1'
    });
  });
</script>
</script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#Add_Menu_FRM").validate({
            rules: { //  Add_Menu_FRM 
                AddSystemID: {
                    required: true
                },
                AddSystemModuleName: {
                    required: true
                },
                SelectGroups: {
                    required: true
                },
                AddSystemModuleURL: {
                    required: true
                },
                AddUniqueName: {
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
    $("form#Add_Menu_FRM").submit(function (e) {
        e.preventDefault();
        if ($('#Add_Menu_FRM').valid()) {
            $("#Loading_ID").show('fast');
            $('#Add_Menu_FRM').hide("fast");
            var SelectData = $('#SelectGroups').val();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'action.system-configuration.php?il=' + SelectData,
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    window.setTimeout(close, 1000);
                    function close() {
                        $("#Loading_ID").hide('explode');
                        $('#Add_Menu_FRM').show("fast");
                        $('#Add_Menu_FRM')[0].reset();
                        //$('#PeopleTableContainer').jtable('load'); // This Reloads JTable
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>
</body>
</html>
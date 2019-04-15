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
  <!-- Include one of jTable styles. -->
  <script src="<?php echo ASSETS_URL; ?>jtable/jquery-3.1.1.min.js" type="text/javascript"></script>
  <script src="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?php echo ASSETS_URL; ?>jtable/jquery.jtable.js" type="text/javascript"></script>
  <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>jtable/jquery-ui-1.12.1/jquery-ui.theme.css" rel="stylesheet" type="text/css" />
  <!-- Include one of jTable styles. -->
  <link href="<?php echo ASSETS_URL; ?>jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ASSETS_URL; ?>jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>plugins/daterangepicker/daterangepicker-bs3.css">
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
      <h1> User Groups Management</h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-home"></i>Home/ Module Select</a></li>
        <li><a href="javascript:void(0);"><i class="fa fa-briefcase"></i>  User Groups Management</a></li>
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
              <li class="pull-left active"><a href="#Listing" data-toggle="tab"><h4><i class="fa fa-bars"></i> User Groups Listing</h4></a></li>
              <li class="pull-right"><a href="#AddNewBanks" data-toggle="tab"><h4><i class="fa fa-plus"></i> Add New Group</h4></a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="Listing">
                <form>
                  <fieldset>
                    <div class="box-body">
                      <div class="row"> 
                        <div class="col-lg-8">
                        <!--<label>Department Name</label>-->
                          <input type="text" class="form-control" name="SearchGrpName" id="SearchGrpName" placeholder="Search User Group" autocomplete="OFF">
                        </div> 
                        <div class="col-lg-4">
                        <button type="submit" id="LoadRecordsButton" class="btn btn-info btn-md w_full"> <span class="glyphicon glyphicon-search"></span> Search User Group</button>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
                <div id="StudentsTable"> <!--Start Students Table-->
                 <div id="PeopleTableContainer" style="width: 100%;"></div>
                  <script type="text/javascript">
                    $(document).ready(function () {
                      $('#PeopleTableContainer').jtable({
                        title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> User Group Listing',
                        paging: true,
                        pageSize: 10,
                        sorting: true,
                        defaultSorting: 'usergroup_id ASC',
                        //selecting: true, //Enable selecting
                        //multiselect: true, //Allow multiple selecting
                        //selectingCheckboxes: true, //Show checkboxes on first column
                        //selectOnRowClick: false,
                        actions: {
                          listAction: 'action.jtable.usergroups-listing.php?action=grplist'
                        },
                        fields: {
                          usergroup_id: {
                            key: true,
                            create: false,
                            edit: false,
                            delete: true,
                            list: false,
                            title: 'ID',
                            width: '7%'
                          },
                          usergroup_name: {
                            title: 'Name',
                            width: '20%'
                          }, 
                          description: {
                            title: 'Description',
                            width: '30%'
                          },
                          isActive: {
                            title: 'Status',
                            width: '10%',
                            options: 'action.jtable.usergroups-listing?action=status'
                          },
                          MyButton: {
                            title: 'Action',
                            width: '10%',
                            display: function(data) {
                              return '<center><button class="btn btn-info btn-small w_full" onclick="LoadUpModal('+data.record.usergroup_id+')"><span class="glyphicon glyphicon-edit"></span> Update</button></center>';
                            }
                         },
                        }
                      });
                      // Re-load records when user click 'load records' button. 
                          $('#LoadRecordsButton').click(function (e) {
                              e.preventDefault();
                              $('#PeopleTableContainer').jtable('load', {
                                  GetName: $('#SearchGrpName').val()
                              });
                          });
                      //Load person list from server
                      $('#PeopleTableContainer').jtable('load');

                    });
                  </script>
                </div> <!--End Students Table-->
                <!--End Activity Content -->
              </div> 
              <div class="tab-pane" id="AddNewBanks"> 
                  <?php echo $SuccessAlert; ?>
                  <form action="" enctype="multipart/form-data" method="post" id="Add_UserGroup_FRM" name="Add_UserGroup_FRM" data-fv-message="This value is not valid" data-fv-icon-validating="glyphicon glyphicon-refresh">
                    <fieldset>
                      <div class="box-body">
                      <div class="row"> 
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>User Group Name</label>
                            <input type="text" class="form-control" name="AddGroupName" id="AddGroupName" placeholder="User Group Name" required>
                            <input type="hidden" class="form-control" name="HiddenAddGroupName" id="HiddenAddGroupName" value="1">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="Description" id="Description" placeholder="Description" required> 
                          </div>
                        </div> 
                        <div class="col-lg-4">
                          <?php $CreateButton=($CanCREATE==1) ? '<button type="submit" class="btn btn-info w_full EditButton" name="submit" style="float:center; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span>  Add New User Group</button>' : '';
                                  echo $CreateButton; ?>

                        </div>
                      </div>
                      </div> 
                    </fieldset>
                  </form>
                <!-- /.box-body -->
                <!--Processing Submission -->
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
              <h4 class="t_aling_c"><i class="fa fa-database"></i> Update User Group Details</h4>
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
<script type="text/javascript">
  function LoadUpModal(getUgroupId){
    $('#LoadUpModal').modal({backdrop: 'static', keyboard: false}); 
    $.ajax({
          url: 'ajax-edit-usergroup.php?getUgroupId='+getUgroupId,
          async: true,
          success: function (data) {
          $('.students-data').html(data);
          }
      });
  }
</script>
<!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>
<!--Date Range Picker -->
<script src="<?php echo ASSETS_URL; ?>plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/fastclick/fastclick.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<!--Post Form Data -->
<script type="text/javascript">
  //Form Validations and Submission
  // Form Add_UserGroup_FRM
  $(document).ready(function() {
    $('.EditButton').on('click', function() {
      $('#Add_UserGroup_FRM')
          .formValidation('destroy')
          .formValidation()
          .on('success.form.fv', function(e) {
            // Submit Form
            $("#LoadingP_ID").show('fast'); 
            $('#Add_UserGroup_FRM').hide("fast");
            var formData = $('#Add_UserGroup_FRM').serialize(); 
              $.ajax({
                  url: 'action.system-configuration.php',
                  type: 'POST',
                  data: formData,
                  async: true,
                  success: function (data) {
                    window.setTimeout(close, 500);
                    function close() {
                        $("#LoadingP_ID").hide('explode');  
                        $('#Add_UserGroup_FRM').show("fast");
                        $('#Add_UserGroup_FRM')[0].reset();
                    }
                  }
              });
          });
      });
  });
</script>
</body>
</html>
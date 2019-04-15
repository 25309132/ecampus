<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUser = $_SESSION['UID'];
//echo $LoggedUser;
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
        <?php include_once('../inc/inc.system-admin-menu.php'); ?>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Manage Users Access</h1>
            <ol class="breadcrumb">
                <li><a href="../index"><i class="fa fa-home"></i>Main Home/ Module Select</a></li>
                <li><a href="javascript:void(0);">Manage Users Access</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <input type="hidden" class="form-control" name="UName" id="UName" value="<?php echo $_SESSION['UName']; ?>">
            <div class="row">
                <div class="col-md-12">
                    <!--Lock User From Accessing This Page -->
                    <?php
                        if($CanVIEW == 1){
                    ?>
                    <!--Lock User From Accessing This Page -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="pull-right active"><a href="#ListingsTab" data-toggle="tab"><h4><i class="fa fa-users"></i> Users Listing</h4></a></li>
                        </ul>
                        <div class="active tab-content">
                            <div class="active tab-pane" id="ListingsTab"> <!--Start Activity Content -->
                                <div class="d_none member-data-retrieval">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4><i class="fa fa-fw fa-database"></i> Manage User Access</h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <button class="btn btn-info btn-md pull-right select-another-member">
                                                <span class="glyphicon glyphicon-check"></span> Select Another User
                                            </button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <!--Load Up Data -->
                                    <center id="RMDLoading_ID" class="d_none r_corners">
                                        <h4 class="m_top_20 m_bottom_20">Please wait... Fetching User Details</h4>
                                        <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                             style="max-width:160px;">
                                    </center>
                                    <!--End Loading Up Data -->
                                </div>
                                <div class="retrived-member-data"></div>
                                <div class="filtering">
                                    <form id="searchFRM" name="searchFRM">
                                        <fieldset>
                                            <div class="row m_bottom_20">
                                                <div class="col-lg-8">
                                                    <label>Search Users Name/ Email or Phone</label>
                                                    <input type="text" class="form-control" name="SearchUName" id="SearchUName"
                                                           placeholder="Search Users Name/ Email or Phone" autocomplete="OFF">
                                                </div>
                                                <div class="col-lg-4">
                                                    <button type="submit" id="LoadRecordsButton" class="btn  btn-info btn-md w_full" style="margin-top: 34px;">
                                                        <span class="glyphicon glyphicon-check"></span> Search User Records
                                                    </button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <!--Start Listings -->
                                <div id="StudentsTable"> <!--Start Students Table-->
                                    <div id="PeopleTableContainer" style="width: 100%;"></div>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#PeopleTableContainer').jtable({
                                                title: '<i class="fa fa-database m_top_20 m_bottom_20"></i> Listed System Users',
                                                paging: true,
                                                pageSize: 10,
                                                sorting: true,
                                                defaultSorting: 'id ASC',
                                                selecting: true, // Enable selecting
                                                //multiselect: true, //Allow multiple selecting
                                                //selectingCheckboxes: true, //Show checkboxes on first column
                                                //selectOnRowClick: false,
                                                actions: {
                                                    listAction: 'users-action-listing.php?action=ulist'
                                                },
                                                fields: {
                                                    id: {
                                                        key: true,
                                                        create: false,
                                                        edit: false,
                                                        list: false
                                                    },
                                                    photo: {
                                                        title: 'Photo',
                                                        width: '5%',
                                                        display: function (data) {
                                                            var sphoto = data.record.photo;
                                                            if (sphoto == null || sphoto === '') {
                                                                sphoto = 'user_avatar.png';
                                                            }
                                                            else {
                                                                sphoto = data.record.photo;
                                                            }
                                                            return '<img src="../img/users/' + sphoto + '" width="40" height="15" class="img-thumbnail">';
                                                        }
                                                    },
                                                    names: {
                                                        title: 'Name(s)',
                                                        width: '18%'
                                                    },
                                                    group_id: {
                                                        title: 'Group ID',
                                                        width: '5%',
                                                        list: false
                                                    }, 
                                                    uname: {
                                                        title: 'Username',
                                                        width: '10%'
                                                    },
                                                    email: {
                                                        title: 'Email',
                                                        width: '8%'
                                                    },
                                                    phone: {
                                                        title: 'Phone',
                                                        width: '8%'
                                                    },
                                                    isActive: {
                                                        title: 'Status',
                                                        width: '5%',
                                                        options: 'users-action-listing.php?action=status'
                                                    },
                                                    MyButton: {
                                                        title: 'Action',
                                                        width: '8%',
                                                        display: function (data) {
                                                            return '<center><button class="btn btn-danger w_full btn-small" onclick="LoadUpModal(' + data.record.id + ')"><span class="glyphicon glyphicon-check"></span> Assign</button></center>';
                                                        }
                                                    },
                                                }
                                            });
                                            // Re-load records when user click 'load records' button.
                                            $('#LoadRecordsButton').click(function (e) {
                                                e.preventDefault();
                                                $('#PeopleTableContainer').jtable('load', {
                                                    SearchUName: $('#SearchUName').val()
                                                });
                                            });
                                            //Load person list from server
                                            $('#PeopleTableContainer').jtable('load');
                                        });
                                    </script>
                                </div><!--End Listings -->
                            </div>
                        </div><!-- /.tab-content -->

                    </div>
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
                </div><!-- /.col -->
            </div><!-- /.row --><!--Start Confirm Approval Modal -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!--Footer Starts -->
    <?php include_once('../inc/inc.footertext.php'); ?>
    <!--Footer Ends-->
    <script type="text/javascript">
        $(".select-another-member").click(function (e) {
            e.preventDefault();
            $('#searchFRM').show();
            $('#StudentsTable').show();
            $('#RMDLoading_ID').hide();
            $('.member-data-retrieval').hide();
            $('.retrived-member-data').hide();
        });
        function LoadUpModal(getUserData) {
            $('#LoadStudentsModal').modal({backdrop: 'static', keyboard: false});
            // Hide Default DIV's
            $('#searchFRM').hide();
            $('#StudentsTable').hide();
            $('#RMDLoading_ID').show('fast');
            $('.member-data-retrieval').show();
            // Load Up Allowance / Benefits Data
            $.ajax({
                url: 'get-users-actions.php?getUserData=' + getUserData,
                async: true,
                success: function (data) {
                    $('#RMDLoading_ID').hide();
                    $('.retrived-member-data').html(data);
                    $('.retrived-member-data').show();
                }
            });
        }
        // End Loading Up Allowance / Benefits Details
    </script>
</div>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/fastclick/fastclick.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".select2").select2();
    });
</script>
</body>
</html>

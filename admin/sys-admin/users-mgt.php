<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUser = $_SESSION['UID'];

if (filter_has_var(INPUT_POST, "email")) {
    try {  //     FullName Username email IdNumber photo USERTITLE Telephone password Cpassword AccessGroup Gender


        $AllowedFileTypes = array('image/png', 'image/jpeg', 'image/pjpeg', 'image/gif');
        $dir_base = "../img/users/";

        if (in_array($_FILES["photo"]["type"], $AllowedFileTypes)) {
            $UploadedFile = is_uploaded_file($_FILES['photo']['tmp_name']);
            if ($UploadedFile) {
                $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['photo']['name']));
                $TheImageOne = strtotime("now") . $safe_filename;
                move_uploaded_file($_FILES['photo']['tmp_name'], $dir_base . $TheImageOne);
            }
        }
        if (in_array($_FILES["Signature"]["type"], $AllowedFileTypes)) {
            $UploadedFileSignature = is_uploaded_file($_FILES['Signature']['tmp_name']);
            if ($UploadedFileSignature) {
                $safe_filenameSignature = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['Signature']['name']));
                $TheImageOneSignature = strtotime("now") . $safe_filenameSignature;
                move_uploaded_file($_FILES['Signature']['tmp_name'], $dir_base . $TheImageOneSignature);
            }
        }
        
        $Username = $common->CCStrip(strtolower($_POST['Username']));
        $email = $common->CCStrip(strtolower($_POST['email']));
        $AccessGroup = $_POST['AccessGroup'];
        $Telephone = $common->CCStrip($_POST['Telephone']);
        $IdNumber = $common->CCStrip($_POST['IdNumber']);
        $FullName = $common->CCStrip(ucwords($_POST['FullName']));
        $RawPassword = $common->CCStrip($_POST['password']);
        $Cpassword = $common->CCStrip(md5($_POST['Cpassword']));
        $USERTITLE = $_POST['USERTITLE'];
        $CamPhotoName = $_POST['CamPhotoName']; 
        $AddUserDepartment = $common->CCStrip($_POST['AddUserDepartment']);
        $Gender = $common->CCStrip($_POST['Gender']);
        /*
        $Usercreds = $common->GetRows("SELECT * FROM tbl_users WHERE  email = '{$email}'  ") ;
        if($Usercreds)
          {
            // Account Exists
          }
        else */
        //{
        if(!empty($CamPhotoName)){
            $TheImageOne = $CamPhotoName;
        }
        $var = "INSERT INTO tbl_users (names, uname, email, pass, group_id, photo, signature, phone, gender, user_title, idnumber, userDepartmentID) VALUES ('{$FullName}', '{$Username}', '{$email}', '{$Cpassword}', '{$AccessGroup}', '{$TheImageOne}',  '{$TheImageOneSignature}',  '{$Telephone}',  '{$Gender}',  '{$USERTITLE}', '{$IdNumber}', '{$AddUserDepartment}')";
        //echo $var;
        $common->Insert($var);
        //}
    } catch (Exception $e) {
        echo $e;
    }
}
?>
<!doctype html>

<html lang="en">
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

        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            display: inline-block;
            cursor: pointer;
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
        <div class="content-wrapper"> <!--Start Content Wrapper -->
            <section class="content-header">
                <h1>Manage System Users</h1>
                <ol class="breadcrumb">
                    <li><a href="../index"><i class="fa fa-home"></i>Main Home/ Module Select</a></li>
                    <li><a href="javascript:void(0);">Manage System Users</a></li>
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
                                <li class="active"><a href="#ListingsTab" data-toggle="tab"><h4><i class="fa fa-bars"></i> Users Listing (Search &amp; Edit)</h4></a></li>
                                <li class="pull-right"><a href="#AddSystemUsers" data-toggle="tab"><h4><i class="fa fa-users"></i> Manage System Users</h4></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="ListingsTab"> <!--Start Activity Content -->
                                    <div class="d_none member-data-retrieval">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4><p class="text-aqua"><i class="fa fa-fw fa-adjust"></i> Update User Details</p></h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-warning btn-md pull-right select-another-member">
                                                    <span class="glyphicon glyphicon-check"></span> Select Another User
                                                </button>
                                            </div>
                                        </div>
                                        <hr/>
                                        <!--Load Up Data -->
                                        <center id="RMDLoading_ID" class="d_none r_corners">
                                            <h4 class="m_top_20 m_bottom_20">Please wait... Fetching User Details</h4>
                                            <img src="images/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                                 style="max-width:160px;">
                                        </center>
                                        <!--End Loading Up Data -->
                                    </div>
                                    <div class="retrived-member-data"></div>
                                    <div class="filtering m_bottom_20">
                                        <form id="searchFRM" name="searchFRM">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <label>Search Users Name/ Email or Phone</label>
                                                        <input type="text" class="form-control" name="SearchUName"
                                                               id="SearchUName"
                                                               placeholder="Search Users Name/ Email or Phone"
                                                               autocomplete="OFF">
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <button type="submit" id="LoadRecordsButton"
                                                                class="btn  btn-info btn-md w_full m_top_25"
                                                                style="margin-top: 34px;"><span
                                                                    class="glyphicon glyphicon-check"></span> Search
                                                            Records
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
                                                    selecting: false, //Enable selecting
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
                                                                return '<img src="../img/users/' + sphoto + '" width="50" height="15" class="img-thumbnail">';
                                                            }
                                                        },
                                                        names: {
                                                            title: 'User Names',
                                                            width: '18%'
                                                        },
                                                        uname: {
                                                            title: 'Login Username',
                                                            width: '12%'
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
                                                            width: '8%',
                                                            options: 'users-action-listing.php?action=status'
                                                        },
                                                        MyButton: {
                                                            title: 'Action',
                                                            width: '8%',
                                                            display: function (data) {
                                                                return '<?php $CreateButton=($CanUPDATE==1) ? '<center><button class="btn btn-danger btn-small w_full" onclick="LoadUpModal(\' + data . record . id + \')"><span class="glyphicon glyphicon-edit"></span> Edit</button></center>' : ''; echo $CreateButton; ?>';
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
                                    </div>
                                    <!--End Listings -->
                                </div>
                                <div class="tab-pane" id="AddSystemUsers">
                                    <!--Start Adding Members -->
                                    <form class="contact-form cf-style-1 m_bottom_40" name="RaisePPOForm" id="RaisePPOForm"
                                          method="POST" action="" enctype="multipart/form-data" action="">
                                        <fieldset>
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input type="text" class="form-control" name="FullName"
                                                                   id="FullName" placeholder="Full Name" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" name="Username"
                                                                   id="Username" placeholder="Username" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="email" id="email"
                                                                   placeholder="Email" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>ID No</label>
                                                            <input type="text" class="form-control" id="IdNumber"
                                                                   name="IdNumber" placeholder="ID Number"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <select id="Gender" name="Gender" class="form-control select2"
                                                                    style="width: 100%; border-radius: 0; height:36px;">
                                                                <?php
                                                                $UDSTT = $common->GetRows("SELECT * FROM lookup_gender WHERE isActive = 1 ");
                                                                foreach ($UDSTT as $UDSsTT) {
                                                                    ?>
                                                                    <option value="<?php echo $UDSsTT['gender']; ?>"><?php echo $UDSsTT['gender']; ?></option>

                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <select id="USERTITLE" name="USERTITLE"
                                                                            class="form-control select2"
                                                                            style="width: 100%; border-radius: 0; height:36px;">
                                                                        <?php
                                                                        $UDSTT = $common->GetRows("SELECT * FROM lookup_titles");
                                                                        foreach ($UDSTT as $uatt) {
                                                                            ?>
                                                                            <option value="<?php echo $uatt['title']; ?>"><?php echo $uatt['title']; ?></option>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Telephone</label>
                                                                    <input type="text" class="form-control" id="Telephone" name="Telephone" placeholder="Telephone"  autocomplete="off">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input type="password" class="form-control" id="password"
                                                                           name="password" placeholder="Password">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Re-type Password</label>
                                                                    <input type="password" class="form-control" name="Cpassword"
                                                                           id="Cpassword" placeholder="Retype Password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>Access Level</label>
                                                                <select id="AccessGroup" name="AccessGroup"
                                                                        class="form-control select2"
                                                                        placeholder="User Group/ Access Level"
                                                                        style="width: 100%; border-radius: 0; height:36px;">
                                                                    <?php
                                                                    $UDS = $common->GetRows("SELECT * FROM tbl_usergroups WHERE isactive = 1");
                                                                    foreach ($UDS as $UDSs) {
                                                                        ?>
                                                                        <option value="<?php echo $UDSs['usergroup_id']; ?>"><?php echo $UDSs['usergroup_name']; ?></option>

                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select id="AddUserDepartment" name="AddUserDepartment" class="form-control select2"
                                                                    placeholder="Department" style="width: 100%; border-radius: 0; height:36px;">
                                                                <?php
                                                                $UDS = $common->GetRows("SELECT * FROM setup_facility_departments WHERE isActive = 1");
                                                                foreach ($UDS as $UDSs) {
                                                                ?>
                                                                    <option value="<?php echo $UDSs['id']; ?>"><?php echo $UDSs['departmentName']; ?></option>

                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="form-group"> 
                                                        <center >
                                                            <h4 class="t_align_c">Preview</h4>
                                                            <div id="WebCamImageTab" style="border-bottom: 2px solid #3FB618; border-radius:4px; margin-top: 14px; margin-bottom: 5px; width: 100%; border-top: 1px solid #CCCCCC;  border-left: 1px solid #CCCCCC;  border-right: 1px solid #CCCCCC;">
                                                            </div>
                                                        </center>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group"> 
                                                        <center>
                                                            <h4 class="t_align_c">Captured</h4>
                                                            <div id="WebCamCapturedImageTab" style="border-bottom: 2px solid #3FB618; border-radius:4px; margin-top: 5px; margin-bottom: 5px; width: 100%" class="img-thumbnail">
                                                                <img src="../img/users/user_avatar.png" style="width: auto; height: 200px;">
                                                            </div>

                                                            <img src="../img/users/user_avatar.png" id="ImgInp"  class="img-thumbnail d_none">
                                                        </center>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                            <div class="row" style="margin-top: 24px;">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="file-upload" class="custom-file-upload w_full btn bg-navy btn-flat">
                                                                            <i class="fa fa-cloud-upload"></i> Upload Photo
                                                                        </label>
                                                                        <input type="hidden" name="MAX_FILE_SIZE" value="99000000"/>
                                                                        <input id="file-upload" type="file" name="photo" onChange="ShowUploadedUserPhoto(this);"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="custom-file-upload w_full">  
                                                                        <button type="button" class="btn bg-purple btn-flat w_full" onClick="takeSnapshot()"><i class="fa fa-camera"></i> Take Photo</button>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="Signatureupload" class="custom-file-upload w_full btn bg-maroon btn-flat">
                                                                            <i class="fa fa-cloud-upload"></i> Upload User Signature
                                                                        </label>
                                                                        <input type="hidden" name="MAX_FILE_SIZE" value="99000000"/>
                                                                        <input id="Signatureupload" type="file" name="Signature"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-md-12">
                                                                    <hr />
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="CamPhotoName" id="CamPhotoName" value=""/>
                                                                        <button type="submit" class="btn btn-info btn-lg w_full submitBtn" name="submit" style="float:center;"> <span class="glyphicon glyphicon-check"></span> Register System User
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <!--End Adding Members -->

                                    <!--Processing Submission -->
                                    <div id="Loading_ID" class="d_none r_corners m_top_40">
                                        <h4 class="m_top_20 t_align_c">Please wait... Processing Your Transction</h4>
                                        <div class="sk-wave">
                                            <div class="sk-rect sk-rect1"></div>
                                            <div class="sk-rect sk-rect2"></div>
                                            <div class="sk-rect sk-rect3"></div>
                                            <div class="sk-rect sk-rect4"></div>
                                            <div class="sk-rect sk-rect5"></div>
                                        </div>
                                    </div>
                                    <!--End Submission Processing -->

                                </div>

                                <div class="tab-pane" id="activity">

                                    <!--Retrieve and Edit Batch Details Starts-->
                                    <div class="d_none member-data-retrieval">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr/>
                                            </div>
                                            <div class="col-lg-6"><h4><i class="fa fa-edit"></i> Update Direct Item Receipt
                                                    Information</h4></div>
                                            <div class="col-lg-6">
                                                <button class="btn  btn-warning btn-md pull-right select-another-member">
                                                    <span class="glyphicon glyphicon-check"></span> Select Another Item
                                                </button>
                                            </div>

                                            <div class="col-lg-12">
                                                <hr/>
                                            </div>
                                        </div>
                                        <!--Load Up Data -->
                                        <center id="RMDLoading_ID" class="d_none r_corners">
                                            <h4 class="m_top_20 m_bottom_20">Please wait... Fetching Data</h4>
                                            <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                                                 style="max-width:160px;">
                                        </center>
                                        <!--End Loading Up Data -->
                                        <div class="retrived-member-data"></div>
                                    </div>
                                    <!--Retrieve and Edit Batch Details Ends-->
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
                <!-- /.row --><!--Start Confirm Approval Modal -->
                <div class="modal fade" id="LoadUpModal" tabindex="-1" role="dialog" aria-labelledby="LoadUpModal">
                    <div class="modal-dialog" style="width:720px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="t_aling_c"><i class="fa fa-database"></i> Update User Details</h4>
                            </div>
                            <div class="students-data"></div>
                        </div>
                    </div>
                </div>
                <!--End Confirm Approval Modal-->
            </section>
            <!-- /.content -->

        </div><!--End Content Wrapper -->
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
                    url: 'ajax-get-user-data.php?getUserData=' + getUserData,
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
    <script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
    <script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo SITE_ROOT; ?>js/formValidation.js"></script>
    <script src="<?php echo SITE_ROOT; ?>js/dependent-dropdown.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".select2").select2();
        });
    </script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js"></script>
    <script type="text/javascript">
        jQuery().ready(function () {
            var v = jQuery("#RaisePPOForm").validate({
                rules: {
                    FullName: {
                        required: true
                    },
                    Username: {
                        required: true,
                        minlength: 4
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    Telephone: {
                        required: true,
                        minlength: 10
                    },
                    password: {
                        required: true
                    },
                    Cpassword: {
                        required: true,
                        minlength: 7,
                        equalTo: "#password"
                    },
                    AccessGroup: {
                        required: true
                    },
                    IdNumber: {
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
        $("form#RaisePPOForm").submit(function (e) {
            e.preventDefault();
            var AccessGroup = $("#AccessGroup").val();
            //alert(AccessGroup)
            if ($('#RaisePPOForm').valid()) {
                $("#Loading_ID").show('fast');
                $('#RaisePPOForm').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'users-mgt',
                    type: 'POST',
                    data: formData,
                    async: true,
                    success: function (data) {
                        window.setTimeout(close, 1000);
                        function close() {
                            $("#Loading_ID").hide('explode');
                            $('#RaisePPOForm').show("fast");
                            $('#RaisePPOForm')[0].reset();
                            $('#PeopleTableContainer').jtable('load'); // This Reloads JTable

                            $('#CamPhotoName').val('');
                            $('#WebCamCapturedImageTab').html('');
                            $('#WebCamCapturedImageTab').html('<img src="../img/users/user_avatar.png" id="ImgInp"  style="width: auto; height: 200px;">');
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    </script>
    <!--Awesome WebCam Starts -->
    <script type="text/javascript" src="webcam.js"></script>
    <script language="JavaScript">
            Webcam.set({
                width: 220,
                height: 210,
                image_format: 'jpeg',
                jpeg_quality: 100
            });
            Webcam.attach('#WebCamImageTab');
        
            function takeSnapshot() {
                $('#ImgInp').addClass('d_none');
                $('#WebCamCapturedImageTab').removeClass('d_none');
                // Get Current Photo Details & Delete
                var CurrentSnapShot = $('#CamPhotoName').val();
                if(CurrentSnapShot === ''){
                    // Do Nothing
                }
                else {
                    // Delete Current Photo
                    $.ajax({
                        url: 'process-cam-image.php?CurrentSnapShot='+CurrentSnapShot,
                        async: true
                    });
                }
                Webcam.snap(function(data_uri){
                    document.getElementById('WebCamCapturedImageTab').innerHTML = 
                        '<h4>Processing...</h4>';
                        Webcam.upload(data_uri, 'process-cam-image.php', function(code, text) {
                        document.getElementById('WebCamCapturedImageTab').innerHTML = '<img src="'+text+'"/>';
                        $('#CamPhotoName').val(text.split("/").pop());
                        $('#photo').val('');
                    });    
                });
            }

            function ShowUploadedUserPhoto(input) {
              if (input.files && input.files[0]) {
                var reader = new FileReader();
                $('#ImgInp').removeClass('d_none');
                $('#WebCamCapturedImageTab').addClass('d_none');
                $('#CamPhotoName').val('');
                reader.onload = function (e) {
                  $('#ImgInp')
                    .attr('src', e.target.result)
                    .width('auto')
                    .height('210');
                };
                reader.readAsDataURL(input.files[0]);
              }
            }
    </script>
    <!--Awesome Web Cam Ends -->
</body>

</html>

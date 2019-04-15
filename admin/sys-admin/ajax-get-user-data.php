<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();


if(!isset($_SESSION['UID'])){
    header("location: ../index");
}


$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

// Get User Info Data 
if (filter_has_var(INPUT_GET, "getUserData")) {
    try {
        $getUserData = $_REQUEST['getUserData'];
        $result = $common->GetRows("SELECT `ts`.*, `gp`.`usergroup_name` FROM tbl_users ts LEFT JOIN tbl_usergroups gp ON `gp`.`usergroup_id` = `ts`.`group_id` WHERE `ts`.`id` = '{$getUserData}'");
        // Add all records to an array
        foreach ($result as $row) {
            $UID = $row['id'];
            $names = $row['names'];
            $username = $row['uname'];
            $email = $row['email'];
            $phone = $row['phone'];
            $CPhoto = $row['photo'];
            $idnumber = $row['idnumber'];
            $telephone = $row['phone'];
            $signature = $row['signature'];
            $titleid = $row['user_title'];
            $CurrentPassWord = $row['pass'];
            $groupid = $row['group_id'];
            $groupname = $row['usergroup_name'];
            $genderid = $row['gender'];


            $GetuserDepartmentID = $row['userDepartmentID'];
            $GetdepartmentName = $row['departmentName'];
            // $gendername = $row['gendername'];
            if(empty($signature)){
                $signature = 'user_avatar.png';
            }
        }
    } catch (Exception $e) {
        echo $e;
    }
}
// Update user details
//EFullName EUSERTITLE EUsername Eemail EIdNumber ETelephone EAccessGroup EGender imgInp2 ImgInpE HiddenEditPhoto CurrentPass
elseif (filter_has_var(INPUT_POST, "HiddenEditID")) {
    try {
        $EditUID = $_GET['EditID'];
        $AllowedFileTypes = array('image/png', 'image/jpeg', 'image/pjpeg', 'image/gif');
        $dir_base = "../img/users/";

        if (in_array($_FILES["ImgInpE"]["type"], $AllowedFileTypes)) {
            $UploadedFile = is_uploaded_file($_FILES['ImgInpE']['tmp_name']);
            if ($UploadedFile) {
                $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['ImgInpE']['name']));
                $TheImageOne = strtotime("now") . $safe_filename;
                move_uploaded_file($_FILES['ImgInpE']['tmp_name'], $dir_base . $TheImageOne);
            } else {
                $TheImageOne = $common->CCStrip($_POST['HiddenEditPhoto']);
            }
        }
        else {
                $TheImageOne = $common->CCStrip($_POST['HiddenEditPhoto']);
            }
        if (in_array($_FILES["imgInp2"]["type"], $AllowedFileTypes)) {
            $UploadedFileSignature = is_uploaded_file($_FILES['imgInp2']['tmp_name']);
            if ($UploadedFileSignature) {
                $safe_filenameSignature = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['imgInp2']['name']));
                $TheImageOneSignature = strtotime("now") . $safe_filenameSignature;
                move_uploaded_file($_FILES['imgInp2']['tmp_name'], $dir_base . $TheImageOneSignature);
            } else {
                $TheImageOneSignature = $common->CCStrip($_POST['HiddenEditSig']);
            }
        } 
        else {
                $TheImageOneSignature = $common->CCStrip($_POST['HiddenEditSig']);
            }

        $EUsername = $common->CCStrip(strtolower($_POST['EUsername']));
        $email = $common->CCStrip(strtolower($_POST['Eemail']));
        $AccessGroup = $common->CCStrip($_POST['EAccessGroup']);
        $Telephone = $common->CCStrip($_POST['ETelephone']);
        $IdNumber = $common->CCStrip($_POST['EIdNumber']);
        $FullName = $common->CCStrip(ucwords($_POST['EFullName']));
        $USERTITLE = $common->CCStrip($_POST['EUSERTITLE']);
        $Gender = $common->CCStrip($_POST['EGender']);
        $Epassword = $common->CCStrip(md5($_POST['Epassword'])); 
        //$EAddUserDepartment = $common->CCStrip($_POST['EAddUserDepartment']);
        $EAddUserDepartment = '1';
        
        if(empty($_POST['Epassword'])){
           $Epassword = $_POST['CurrentPass'];  // CurrentPass
        }

        $CamPhotoNameE = $_POST['CamPhotoNameE'];
        if(!empty($CamPhotoNameE)){
            $TheImageOne = $CamPhotoNameE;
        }

        $EDITSQL = "UPDATE tbl_users SET userDepartmentID = '{$EAddUserDepartment}', names = '{$FullName}', uname = '{$EUsername}', email = '{$email}', group_id = '{$AccessGroup}', photo = '{$TheImageOne}', signature = '{$TheImageOneSignature}', phone =  '{$Telephone}', gender = '{$Gender}', user_title = '{$USERTITLE}' , idnumber = '{$IdNumber}', pass = '{$Epassword}' WHERE id = '{$EditUID}'";
        echo $EDITSQL;
        $common->Insert($EDITSQL);
    } catch (Exception $e) {echo $e;}
}
?>
<style type="text/css">
    label {
        margin-top: 10px;
    }

    .help-inline-error {
        color: red;
    }
</style>
<!--Start Students Update Form -->
<form class="contact-form cf-style-1 m_bottom_40" name="Edit_User_FRM" id="Edit_User_FRM" method="POST" action=""
      enctype="multipart/form-data" action="">
    <fieldset>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Title</label>
                        <select id="EUSERTITLE" name="EUSERTITLE" class="form-control select2" style="width: 100%; border-radius: 0; height:36px;">
                            <option value="<?php echo $titleid; ?>" selected><?php echo $titleid; ?></option>
                            <?php $UDSTT = $common->GetRows("SELECT * FROM lookup_titles");
                            foreach ($UDSTT as $uatt) { ?>
                                <option value="<?php echo $uatt['title']; ?>"><?php echo $uatt['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Full Names</label>
                        <input type="text" class="form-control" name="EFullName" id="EFullName" placeholder="Full Name" autocomplete="off" value="<?php echo $names; ?>"/>
                        <input type="hidden" class="form-control" name="HiddenEditID" id="HiddenEditID" value="<?php echo $getUserData; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-md-6">
                            <img id='img-upload' style="width: 100px;" src="../img/users/<?php echo $CPhoto; ?>"/> 
                        </div>
                        <div class="col-md-6">
                            <div id="WebCamImageTabE" style="margin-top: -10px; border-radius: 4px !important; width: 100%"></div>
                            <div id="WebCamCapturedImageTabE" class="img-thumbnail d_none" style="max-width: 120px !important;"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="EUsername" id="EUsername" placeholder="Username" autocomplete="off" value="<?php echo $username; ?>"/>
                        <input type="hidden" class="form-control" name="HiddenEditPhoto" id="HiddenEditPhoto" value="<?php echo $CPhoto; ?>" />
                        <input type="hidden" class="form-control" name="HiddenEditSig" id="HiddenEditSig" value="<?php echo $signature; ?>" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Eemail" id="Eemail" placeholder="Email" autocomplete="off" value="<?php echo $email; ?>"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Image</label><div class="input-group">
                                <span class="input-group-btn">
                                <span class="btn btn-default btn-file">Browse… <input type="file" id="ImgInpE" name="ImgInpE" onChange="ShowUploadedUserPhotoE(this);"></span>
                                </span><input type="text" class="form-control" readonly></div>
                                <input type="hidden" name="CamPhotoNameE" id="CamPhotoNameE" value=""/>

                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-top: 24px;">
                                <label class="custom-file-upload w_full">  
                                <button type="button" class="btn bg-purple btn-flat w_full" onClick="takeSnapshotE()"><i class="fa fa-camera"></i> Take Photo</button>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>ID No</label>
                        <input type="text" class="form-control" id="EIdNumber" name="EIdNumber" placeholder="ID Number" autocomplete="off" value="<?php echo $idnumber; ?>"/>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" class="form-control" id="ETelephone" name="ETelephone"
                               placeholder="Telephone" autocomplete="off" value="<?php echo $telephone; ?>"/>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img id='img-upload' style="width: 80px;" src="../img/users/<?php echo $signature; ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>User Group/ Access Level</label>
                        <select id="EAccessGroup" name="EAccessGroup" class="form-control select2" placeholder="User Group/ Access Level"
                                style="width: 100%; border-radius: 0; height:36px;">
                            <option value="<?php echo $groupid; ?>" selected><?php echo $groupname; ?></option>
                            <?php $UDS = $common->GetRows("SELECT * FROM tbl_usergroups WHERE isactive = 1");
                            foreach ($UDS as $UDSs) { ?>
                                <option value="<?php echo $UDSs['usergroup_id']; ?>"><?php echo $UDSs['usergroup_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Select Gender</label><br/>
                        <select id="EGender" name="EGender" class="form-control select2"
                                style="width: 100%; border-radius: 0; height:36px;">
                            <option value="<?php echo $genderid; ?>" selected><?php echo $genderid; ?></option>
                            <?php $UDSTT = $common->GetRows("SELECT * FROM lookup_gender WHERE isActive = 1");
                            foreach ($UDSTT as $UDSsTT) { ?>
                                <option value="<?php echo $UDSsTT['gender']; ?>"><?php echo $UDSsTT['gender']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>User Signature</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">Browse… <input type="file" id="imgInp2" name="imgInp2" value="<?php echo $signature ?>"></span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div><hr/>
            <div class="row">
                
                <div class="col-lg-4">
                    <?php
                        if($_SESSION['GrpID'] == 1){
                    ?>
                    <div class="form-group">
                        <label>Update Password</label>
                        <input type="password" class="form-control" id="Epassword" name="Epassword" placeholder="Password">
                        <input type="hidden" class="form-control" id="CurrentPass" name="CurrentPass" placeholder="Current Password" value="<?php echo $CurrentPassWord; ?>">
                        
                    </div>
                    <?php
                        }
                    else{
                        echo "<p>Password Edit Not Available</p>";
                    }
                    ?>
                </div>
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-info w_full submitBtn" name="submit"
                            style="float:center; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span>
                        Edit System User
                    </button>
                </div>
            </div>
        </div>
    </fieldset>
</form>
<!--Processing Submission -->
<div class="d_none" id="BCEditLoading_ID">
    <center class=" r_corners m_top_20">
        <h4 class="m_top_20 m_bottom_20">Please wait... Updating User Details</h4>
        <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
    </center>
</div>
<!--End Submission Processing -->
<!--Alert Successful -->
<div class="BCEditUpdateSuccessful d_none" id="BCEditUpdateSuccessful" style="margin: o auto;">
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-database"></i>User Details have been successfully updated!</h4>
    </div>
</div>
<!--End Editing Members -->
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
        $(".select2").select2();
        $("#Epassword").val('');
    });
</script> 
<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#Edit_User_FRM").validate({
            rules: { // EFullName EUSERTITLE EUsername Eemail EIdNumber ETelephone EAccessGroup EGender imgInp2 imgInp
                EFullName: {
                    required: true
                },
                EUsername: {
                    required: true,
                    minlength: 4
                },
                Eemail: {
                    required: true,
                    email: true
                },
                ETelephone: {
                    required: true,
                    minlength: 10
                },
                EAccessGroup: {
                    required: true
                },
                EIdNumber: {
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
    $("form#Edit_User_FRM").submit(function (e) {
        e.preventDefault();
        if ($('#Edit_User_FRM').valid()) {
            $("#BCEditLoading_ID").show('fast');
            $('#Edit_User_FRM').hide("fast");
            var HiddenEditID = $("#HiddenEditID").val();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'ajax-get-user-data.php?EditID=' + HiddenEditID,
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    window.setTimeout(close, 1000);
                    function close() {
                        $("#BCEditLoading_ID").hide('explode');
                        $('.BCEditUpdateSuccessful').show("fast");
                        $('#Edit_User_FRM')[0].reset();
                        $('#PeopleTableContainer').jtable('load');

                        $('#searchFRM').show();
                        $('#StudentsTable').show();
                        $('#RMDLoading_ID').hide();
                        $('.member-data-retrieval').hide();
                        $('.retrived-member-data').hide();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });
        $('.btn-file :file').on('fileselect', function (event, label) {
            var input = $(this).parents('.input-group').find(':text'),
                log = label;
            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }
        });
    });
    function ShowUploadedUserPhotoE(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        $('#img-upload').removeClass('d_none');
        $('#WebCamCapturedImageTabE').addClass('d_none');
        $('#CamPhotoNameE').val('');
        reader.onload = function (e) {
          $('#img-upload')
            .attr('src', e.target.result)
            .width('auto')
            .height('120');
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    Webcam.set({
        width: 120,
        height: 120,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach('#WebCamImageTabE');

    function takeSnapshotE() {
        $('#WebCamCapturedImageTabE').removeClass('d_none');
        $('#WebCamImageTabE').addClass('d_none');
        Webcam.snap(function(data_uri){
            document.getElementById('WebCamCapturedImageTabE').innerHTML = 
                '<h2>Processing:</h2>';
                Webcam.upload(data_uri, '../sys-admin/process-cam-image.php', function(code, text) {
                document.getElementById('WebCamCapturedImageTabE').innerHTML = '<img src="'+text+'"/>';
                //alert(text.split("/").pop());
                $('#CamPhotoNameE').val(text.split("/").pop());
                $('#ImgInpE').val('');
                $('#img-upload').addClass('d_none');
            });    
        });
    }
</script> 
<?php
include_once('sys/core/init.inc.php');
$common=new common();

if (filter_has_var(INPUT_POST, "SubmitFRMElements")) {
  try { 
        $Salutation = $common->CCStrip($_POST['Salutation']); 
        $Surname = $common->CCStrip($_POST['Surname']);
        $Firstname = $common->CCStrip($_POST['Firstname']);
        $Othernames = $common->CCStrip(strtolower($_POST['Othernames']));
        $Gender = $common->CCStrip($_POST['Gender']);
        $DOB = $common->CCStrip($_POST['DOB']);
        $InstitutionEmail = $common->CCStrip($_POST['InstitutionEmail']);
        $PersonalEmail = $common->CCStrip($_POST['PersonalEmail']);
        $PhoneNumber = $common->CCStrip($_POST['PhoneNumber']);
        $AdmissionNumber = $common->CCStrip($_POST['AdmissionNumber']);
        $School = $common->CCStrip($_POST['School']); 
        $Programme = $common->CCStrip($_POST['Programme']);
        $Campus = $common->CCStrip($_POST['Campus']);
        $YOS = $common->CCStrip($_POST['YOS']);
        $Admission = $common->CCStrip($_POST['Admission']);
        $Orientation = $common->CCStrip($_POST['Orientation']);
        $StudentType = $common->CCStrip($_POST['StudentType']);
        $PHT = $common->CCStrip($_POST['PHT']);
        
        $IDNumber = $common->CCStrip($_POST['IDNumber']);
        $PostalAddress = $common->CCStrip($_POST['PostalAddress']);
        $Country = $common->CCStrip($_POST['Country']);
        $TownCity = $common->CCStrip($_POST['TownCity']);

        //Create Student Details
        $SQLInsert = $common->INSERT("INSERT INTO tbl_students (surname, firstname, othernames, gender, date_of_birth, admissionnumber, idpassport, institution_email, personal_email, telephone, school, programme, campus, postal_address, country, city, yearofadmission, yearofstudy, doneorientation, pht, student_type) VALUES ('{$Surname}', '{$Firstname}', '{$Othernames}', '{$Gender}', '{$DOB}', '{$AdmissionNumber}', '{$IDNumber}', '{$InstitutionEmail}', '{$PersonalEmail}', '{$PhoneNumber}', '{$School}', '{$Programme}', '{$Campus}', '{$PostalAddress}', '{$Country}', '{$TownCity}', '{$Admission}', '{$YOS}', '{$Orientation}', '{$PHT}', '{$StudentType}');");

        //Create a user
        $Names = $Surname.' '.$Firstname.' '.$Othernames;
        $LoginEmail = $common->CCStrip($_POST['LoginEmail']);
        $Username = $common->CCStrip($_POST['Username']);
        $Password = $common->md5($_POST['Password']);

        $Query = "INSERT INTO tbl_users (names, uname, email, pass, group_id, phone, gender, user_title, idnumber, isActive) VALUES ('{$Names}', '{$Username}', '{$LoginEmail}', '{$Password}', '3', '{$PhoneNumber}',  '{$Gender}',  '{$Salutation}', '{$IDNumber}', '0')";
        //echo $var;
        $common->Insert($Query);


        if($SQLInsert >= 1)
        {
          $CurrentYear = date('Y');
          $PersonalEmail = $common->CCStrip(strtolower($_POST['PersonalEmail']));
          $InstitutionEmail = $common->CCStrip(strtolower($_POST['InstitutionEmail']));
          $from = 'ecampus@maseno.ac.ke';
          $to = $PersonalEmail;
          $cc = $InstitutionEmail;
          $Bcc = "bmakhaya@maseno.ac.ke, mwangudi@gmail.com";
          $headers = "From: " . strip_tags($from) . "\r\n";
          $headers .= "Reply-To: " . strip_tags($from) . "\r\n";
          $headers .= "cc: " . strip_tags($cc) . "\r\n";
          $headers .= "Bcc: " . strip_tags($Bcc) . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          $Emessage = '<html><body>';

          $Emessage .= '<center><table width="100%"; rules="all" style="border-style: solid; border:1px;  border-color:#41BEDD;" cellpadding="10">';
          $Emessage .= "<tr><td colspan='2'><a href='$SystemURI'><img src='$SystemURI/assets/img/<?php echo $companyLogo; ?>' alt='Logo' width='180px'/></a></td></tr>";
          $Emessage .= "<tr><td colspan='2'>Dear $Names, <br /><br /> Thank you for registering with us for e-learning. Our administrator will review your application and an email will be sent to you upon successful confirmation.</td></tr>";
          $Emessage .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><p align='center'>&copy; $CurrentYear www.codebluelimited.com </p></td></tr>";
          $Emessage .= "</table></center>";
          $Emessage .= "</body></html>";
          mail($to, "Individual Training Registration", $Emessage, $headers);

        }
        
    }
        catch (Exception $e) {echo $e; }
  }
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Home | Maseno E-Learning Portal</title>
        <?php include_once('include/meta.php'); ?>

    </head>
    <body>
        <!-- Pre Loader
        ============================================ -->
        <div class="preloader">
            <div class="loading-center">
                <div class="loading-center-absolute">
                    <div class="object object_one"></div>
                    <div class="object object_two"></div>
                    <div class="object object_three"></div>
                </div>
            </div>
        </div>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="as-mainwrapper">
            <div class="bg-white">
                <!-- header start -->
                <header class="header-area">
                    <?php include_once('include/topheader.php'); ?>
                    <?php include_once('include/header.php'); ?>
                </header>
                <!-- header end -->
                <div class="blog-area ptb-35">
                    <div class="container">
                        <div class="row">
                            <div class="tab-content row">
                                <div class="col-md-12">
                                    <!-- Begin # Login Form -->
                                    <div class="row" id="pwd-container">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-5 pull-right">
                                          <section class="login-form">
                                            <form id="LoginReg" name="LoginReg" role="login" action="" method="POST">
                                                <div id="wrongOTPMsgReg" class="row d_none">
                                                    <div class="col-md-12 alert alert-danger" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only"> Close </span></button>
                                                        <strong><i class="fa fa-recycle"></i> </strong> <span id="ErrorTxtReg"> Invalid Credentials </span>
                                                    </div>
                                                </div>
                                                    <h3><b>Login to your student area to experience e-learning</b></h3>
                                                    <img src="" class="img-responsive" alt="" />
                                                    <input type="text" id="LoginUsername" name="LoginUsername" placeholder="Email / Admission Number" class="form-control input-lg" />
                                                    <input type="hidden" name="PostSignIn" id="PostSignIn"  class="form-control" value="1" autocomplete="OFF">
                                                    <input type="password" class="form-control input-lg" id="LoginPassword" name="LoginPassword" placeholder="Password" />
                                                    <div class="pwstrength_viewport_progress"></div>
                                                    <button type="submit" name="login" class="btn btn-lg btn-success btn-block"><i class="fa fa-check-circle-o"></i> Login </button>
                                                <div>
                                                    <a href="#blog"> Register / Create account </a>
                                                </div>
                                            </form>
                                            <!--Processing Submission -->
                                            <center  id="Loading_IDReg" class="d_none">
                                                <h4 class="ptb-5"> Please wait... Logging you In </h4>
                                                <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                                            </center>
                                          <!--End Submission Processing -->
                                          </section>  
                                          </div>
                                          <div class="col-md-3"></div>
                                      </div>
                                    <!-- End # Login Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- Form Ends -->
                <?php include_once('include/footerjs.php'); ?>
                <!-- footer start -->
                 <?php include_once('include/footer.php'); ?>
                <!-- footer end -->
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    
    jQuery().ready(function () {
        var v = jQuery("#RegisterFRM").validate({
            rules: {   
                InstitutionEmail: {
                    email: true
                },
                PersonalEmail: {
                    email: true
                },
                PhoneNumber: {
                    number: true
                },
                LoginEmail: {
                    email: true
                },
                Confirmpassword: {
                    equalTo: "#Password"
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
        
    });

    $(document).ready(function() {
        $("form#RegisterFRM").submit(function (e) {
            e.preventDefault();
            if ($('#RegisterFRM').valid()) {
                $("#Loading_ID").show('fast');
                $('.form-wizard').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'register.php',
                    type: 'POST',
                    data: formData,
                    async: true,
                    success: function (data) {
                        window.setTimeout(close, 500);
                        function close() {
                            $("#Loading_ID").hide('explode');
                            $('.form-wizard').show("fast");
                            $('#RegisterFRM')[0].reset();
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
        
        $(function () {
            $(".select2").select2();
        });

        $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "yy-mm-dd",
        });
    });

</script>

<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#LoginReg").validate({
            rules: {   
                LoginUsername: {
                    required: true
                },
                LoginPassword: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });
    
    $("form#LoginReg").submit(function(e){
        e.preventDefault();
        if($("#LoginReg").valid()){
            $("#Loading_IDReg").removeClass('d_none'); 
            $("#LoginReg").addClass('d_none');  
            var OTPdata = $("#LoginReg").serialize(); 
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "auth",
                data: OTPdata,
                success: function(data) {
                if(data["type"] == "error"){
                        $("#wrongOTPMsgReg").removeClass('d_none');
                        $("#ErrorTxtReg").text(data["OTPmsg"]); 
                        $("#Loading_IDReg").addClass('d_none');
                        $("#LoginReg").removeClass('d_none');    
                    } 
                else {   
                        $("#wrongOTPMsgReg").removeClass('d-none');
                        $("#ErrorTxtReg").text(data["OTPVmsg"]);
                        var usergroup = data["UGroup"]
                        window.setTimeout(function(){
                            if(usergroup == 3) {
                                window.location.replace("studentarea");
                            }
                            else {
                                window.location.replace("admin/index");
                            }
                        }, 1000);
                      }    
                },
                  error: function(xhr, textStatus, errorThrown) {
                }
            });
          return false;
        }
    });
</script>
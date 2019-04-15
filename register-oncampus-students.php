<?php
include_once('sys/core/init.inc.php');
$common=new common();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Home | Maseno E-Learning Portal</title>
        <?php include_once('include/meta.php'); ?>
    </head>
    <body>
        <!-- Pre Loader ============================================ -->
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
                    <?php include_once('include/mainmenu.php'); ?>
                </header>
                <!-- header end -->
                <div class="blog-area ptb-35">
                    <div class="container">
                        <div class="row">        
                            <!-- Form Wizard Starts -->     
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <!-- Form Wizard -->
                                <form class="contact-form cf-style-1 pt-20" name="CertificateRegisterFRM" id="CertificateRegisterFRM" method="POST" action="" enctype="multipart/form-data" action="">
                                    <h5 class="t_align_c"> <b> APPLICATION FOR ON CAMPUS (Face to Face) STUDENTS </b></h5>
                                    <fieldset>
                                        <h6> 1. PERSONAL DETAILS: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Surname / Family Name: <span class="required">*</span></label>
                                                    <input type="text" name="Surname" id="Surname" placeholder="Surname / Family Name" class="form-control required">
                                                    <input type="hidden" name="StudentType" id="StudentType" value="4">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Other Names: <span class="required">*</span></label>
                                                    <input type="text" name="Othernames" id="Othernames" placeholder="Other Names" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Gender: <span class="required">*</span></label><br/>
                                                    <select name="Gender" id="Gender" style="width: 100%" class="form-control select2 required">
                                                        <option selected value="">Select Gender</option>
                                                        <option value="Male" >Male </option>
                                                        <option value="Female" >Female </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Date Of Birth: <span class="required">*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker required" id="DOB" name="DOB" placeholder="Date of Birth" autocomplete="off">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Admission Number: <span class="required">*</span></label>
                                                    <input type="text" name="AdmissionNumber" id="AdmissionNumber" placeholder="e.g. BA/00060/2019" class="form-control required" autocomplete="off">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Institutional Email: <span class="required">*</span></label>
                                                    <input type="text" name="InstitutionalEmail" id="InstitutionalEmail" placeholder="e.g. @student.maseno.ac.ke" class="form-control required" autocomplete="off">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Personal Email: <span class="required">*</span></label>
                                                    <input type="email" name="PersonalEmail" id="PersonalEmail" placeholder="e.g. @gmail.com" class="form-control required" autocomplete="off">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Phone Number: <span class="required">*</span></label>
                                                    <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="e.g. 0700 000 000" class="form-control required" autocomplete="off">
                                                </div>
                                            </div>
                                        </div> <br/>
                                        <h6> 2. COURSE DETAILS: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Choose School: <span class="required">*</span></label><br/>
                                                    <select class="form-control select2 required" name="School" id="School" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Choose School </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_schools WHERE isActive = 1") as $A) { ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["school_name"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label> Choose Programme (e.g. Bachelor of Arts in English with IT): <span class="required">*</span></label><br/>
                                                    <select class="form-control select2 required" name="Programme" id="Programme" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Choose Programme </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programmes WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["programme_code"]. ' - '.$A["programme_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Choose Campus: <span class="required">*</span></label><br/>
                                                    <select class="form-control select2 required" name="Campus" id="Campus" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="1" selected> ECampus Maseno University </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_campuses WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["campus_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Year of Admission: </label>
                                                    <select class="form-control select2 required" name="KACYearofAdmission" id="KACYearofAdmission" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="" selected> Select Year</option>
                                                        <?php for ($i = date('Y'); $i > date('Y') - 10; $i--) 
                                                        {
                                                            echo "<option value='{$i}'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Year of Study: </label>
                                                    <select class="form-control select2 required" name="KACYearofStudy" id="KACYearofStudy" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="" selected> Select Year of Study</option>
                                                        <option value="1"> Year - 1 </option>
                                                        <option value="2"> Year - 2 </option>
                                                        <option value="3"> Year - 3 </option>
                                                        <option value="4"> Year - 4 </option>
                                                        <option value="5"> Year - 5 </option>
                                                        <option value="6"> Year - 6 </option>
                                                        
                                                    </select>
                                                </div> 
                                                <div class="col-md-3">
                                                    <label> Have you done orientation before? </label>
                                                    <select class="form-control select2 required" name="DoneOrientation" id="DoneOrientation" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="" selected> Indicate with Yes or No. </option>
                                                        <option value="1"> Yes </option>
                                                        <option value="2"> No </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Select PHT Option </label>
                                                    <select class="form-control select2 required" name="PHTOption" id="PHTOption" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="" selected> Select applicable PHT option for you </option>
                                                        <option value="1"> 1st Attempt </option>
                                                        <option value="2"> Resit / Retake </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success w_full" style="margin-top: 25px;"> <i class="fa fa-send-o"></i> Submit Application </button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 1 -->
                                </form>
                                <!-- Form Wizard -->
                            </div>
                            <!-- Form Wizard Ends -->
                            <!--Processing Submission -->
                            <center id="LoadingDiv" name="LoadingDiv" class="d_none">
                              <h4 class="ptb-35"> Please wait... Processing Your Submission </h4>
                              <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                            </center>
                            <!--End Submission Processing -->
                            <!-- Success Div -->
                            <div id="SuccessDiv" class="alert alert-success d_none pt-60" role="alert">
                                <h4 align="center"> Your application is complete! </h4>
                                <p align="center"> Thank you for registering with us for on campus programme. Our administrator will review your application and an email will be sent to you upon successful confirmation. </p><hr>
                                <p class="mb-0" align="center"> For any queries on your application, You can contact us through (020) 057-2021013 & (+254) 711 432 244 or visit us at Varsity Plaza, Kisumu. We are open from 8am - 5pm </p>
                            </div>
                            <!--End Success Div -->
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
        <script type="text/javascript">
            jQuery().ready(function () {
                var v = jQuery("#CertificateRegisterFRM").validate({
                    rules: {   
                        Email: {
                            email: true
                        },
                        Gender: {
                            required: true
                        },
                        MaritalStatus: {
                            required: true
                        },
                        AdmissionNumber: {
                            required: true
                        },
                        Programme: {
                            required: true
                        }
                    },
                    errorElement: "span",
                    errorClass: "help-inline-error",
                });
                
            });

            $(document).ready(function() {
                $("form#CertificateRegisterFRM").submit(function (e) {
                    e.preventDefault();
                    if ($('#CertificateRegisterFRM').valid()) {
                        $("#LoadingDiv").show('fast');
                        $('#CertificateRegisterFRM').hide("fast");
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: 'submit-facetoface-application',
                            type: 'POST',
                            data: formData,
                            async: true,
                            success: function (data) {
                                window.setTimeout(close, 1000);
                                function close() {
                                    $("#LoadingDiv").hide('explode');
                                    $('#SuccessDiv').show("fast");
                                    $('#CertificateRegisterFRM')[0].reset();
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

                var dateToday = new Date();
                $('.datepicker').datepicker({
                  changeMonth: true,
                  changeYear: true,
                  dateFormat: "yy-mm-dd"
                  //maxDate: dateToday
                }); 
            });

        </script>
    </body>
</html>
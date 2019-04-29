<?php
include_once('sys/core/init.inc.php');
$common=new common();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title> Home | Maseno E-Learning Portal</title>
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
                                    <h5 class="t_align_c"> <b> REFEREES CONFIDENTIAL REPORT </b></h5>
                                    <fieldset>
                                        <p>
                                            The candidate whose name is given below wishes to undertake postgraduate studies in the University. The University would be grateful for your comments on the candidate’s suitability for this programme.
                                            
                                            Please return the completed form directly to:
                                        </p>
                                        <h6> <b> THE DIRECTOR, SCHOOL OF GRADUATE STUDIES, MASENO UNIVERSITY, P.O. PRIVATE BAG, MASENO, KENYA </b></h6> <hr/>
                                        <h6> SECTION A: (To be completed by the candidate) </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> 1. Surname / Family Name: <span class="required">*</span></label>
                                                    <input type="text" name="Surname" id="Surname" placeholder="Surname / Family Name" class="form-control required">
                                                    <input type="hidden" name="StudentType" id="StudentType" value="4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label> Other Names: <span class="required">*</span></label>
                                                    <input type="text" name="Othernames" id="Othernames" placeholder="Other Names" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> 2. Degree applied for: <span class="required">*</span></label><br/>
                                                    <input type="text" name="DegreeAppliedFor" id="DegreeAppliedFor" placeholder="Degree Applied For" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> 3. Department/Faculty to which application is made: <span class="required">*</span></label><br/>
                                                    <input type="text" name="DepartmentFaculty" id="DepartmentFaculty" placeholder="Department / Faculty" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> 4. Field of study/subject: <span class="required">*</span></label><br/>
                                                    <input type="text" name="FieldOfStudy" id="FieldOfStudy" placeholder="Field of study / Subject" class="form-control required">
                                                </div>
                                            </div>
                                        </div><hr/>

                                        <h6> SECTION B: (To be completed by the referee) </h6>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label> 5. For how long and in what capacity have you known the candidate? <span class="required">*</span></label>
                                                    <input type="text" name="PeriodKnown" id="PeriodKnown" placeholder="Period You have known the Candidate" class="form-control required" autocomplete="off">
                                                </div>
                                            </div>
                                        
                                            <h6> 2. Please rate the candidate on the following </h6>
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
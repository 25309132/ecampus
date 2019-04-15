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
                            <div class="col-md-12 col-sm-12 col-lg-12 form-wizard">
                                <!-- Form Wizard -->
                                <form class="contact-form cf-style-1 m_bottom_40" name="UndeGraduateRegisterFRM" id="UndeGraduateRegisterFRM" method="POST" action="" enctype="multipart/form-data" action="">
                                    <h5> <b> APPLICATION FORM FOR UNDERGRADUATE E-LEARNING PROGRAMMES </b></h5>
                                    <!-- Form progress -->
                                    <div class="form-wizard-steps form-wizard-tolal-steps-3">
                                        <div class="form-wizard-progress">
                                            <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="3" style="width: 12.25%;"></div>
                                        </div>
                                        <!-- Step 1 -->
                                        <div class="form-wizard-step active">
                                            <div class="form-wizard-step-icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                            <p>SECTION A</p>
                                        </div>
                                        <!-- Step 1 -->
                                        
                                        <!-- Step 2 -->
                                        <div class="form-wizard-step">
                                            <div class="form-wizard-step-icon"><i class="fa fa-book" aria-hidden="true"></i></div>
                                            <p>SECTION B</p>
                                        </div>
                                        <!-- Step 2 -->
                                        
                                        <!-- Step 3 -->
                                        <div class="form-wizard-step">
                                            <div class="form-wizard-step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                                            <p>Confirm</p>
                                        </div>
                                        <!-- Step 3 -->
                                    </div>
                                    <!-- Form progress -->
                                    <!-- Form Step 1 -->
                                    <fieldset>
                                        <h4>NOTE: <span>Step 1 - 3 </span></h4>
                                        <P>
                                            <ol type="i" class="ol-list">
                                                <li>
                                                    That the completed form should be sent by courier to the DIRECTOR E-CAMPUS, MASENO UNIVERSITY, VARSITY PLAZA 10TH FLOOR, WING A. P.O. BOX 3275-40100, KISUMU 
                                                </li>
                                                <li>
                                                    That all candidates applying must attach copies of their certificates/transcripts, Identity Card/Waiting Card/Birth Certificate and School Leaving Certificate
                                                </li>
                                                <li>That only successful candidates will be contacted.</li>
                                                <li>That the names appearing on this form should be the same as those on your certificates.</li>
                                            </ol><hr />
                                        </P>
                                        <h6> 1. PERSONAL DETAILS: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Surname / Family Name: <span>*</span></label>
                                                    <input type="text" name="Surname" id="Surname" placeholder="Surname / Family Name" class="form-control required">
                                                    <input type="hidden" name="StudentType" id="StudentType" value="2">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Other Names: <span>*</span></label>
                                                    <input type="text" name="Othernames" id="Othernames" placeholder="Other Names" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Date Of Birth: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker required" id="DOB" name="DOB" placeholder="Date of Birth" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Gender: <span>*</span></label><br/>
                                                    <select name="Gender" id="Gender" style="width: 100%" class="form-control select2 required">
                                                        <option selected value="">Select Gender</option>
                                                        <option value="Male" >Male </option>
                                                        <option value="Female" >Female </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Marital Status: <span>*</span></label><br/>
                                                    <input type="text" class="form-control" id="MaritalStatus" name="MaritalStatus" placeholder="Marital Status" autocomplete="off">
                                                    <!--<select name="MaritalStatus" id="MaritalStatus" style="width: 100%" class="form-control select2 required">
                                                        <option selected value=""> Select Marital Status</option>
                                                        <option value="Single"> Single </option>
                                                        <option value="Married"> Married </option>
                                                        <option value="Divorced"> Divorced </option>
                                                        <option value="Undisclosed"> Undisclosed </option>
                                                    </select>-->
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ID / Passport Number: <span>*</span></label>
                                                    <input type="text" name="IDNumber" id="IDNumber" placeholder="ID/Passport Number" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Country From: <span>*</span></label>
                                                    <select class="form-control select2 required" name="Country" id="Country" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Select Your Country </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM lookup_countries WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["country_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" id="TownCityDiv">
                                                    <label>Town / City / State:</label>
                                                    <input type="text" name="TownCity" id="TownCity" placeholder="Town City" class="form-control">
                                                    <input type="hidden" id="CountryName" name="CountryName" />
                                                    <input type="hidden" id="CountyName" name="CountyName" />
                                                </div>
                                                <div class="col-md-3 d_none" id="CountyDIV" >
                                                    <label>Kenyan County:</label>
                                                    <select class="form-control select2" name="CountyID" id="CountyID" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Select Your County </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM lookup_counties WHERE isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["county_name"]; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Phone Number: <span>*</span></label>
                                                    <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Phone Number" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Email: <span>*</span></label>
                                                    <input type="email" name="Email" id="Email" placeholder="Email" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Postal Address: <span>*</span></label>
                                                    <input type="text" name="PostalAddress" id="PostalAddress" placeholder="Postal Address" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Permanent Address </label>
                                                    <input type="text" name="PermanentAddress" id="PermanentAddress" placeholder="Permanent Address" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="image-upload" class="custom-file-upload w_full btn btn-success" style="margin-top: 26px;">
                                                            <i class="fa fa-cloud-upload"></i> Upload Student Photo
                                                        </label>
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="99000000"/>
                                                        <input id="image-upload" type="file" accept="image/*" name="photo" onChange="ShowUploadedUserPhoto(this);"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d_none" id="ImgDIV">
                                                    <center>
                                                    <img src="admin/img/students/user_avatar.png" id="ImgInp" class="img-thumbnail d_none"></center>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-next btn-first">Next <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 1 -->
                                    <!-- Form Step 2 -->
                                    <fieldset>
                                        <h4> PROGRAMME APPLICATION DETAILS / ACADEMIC BACKGROUND <span>Step 2 - 3 </span></h4><br/>
                                        <h6> 2. DEGREE APPLIED FOR: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> Select Degree Programme: <span>*</span></label><br/>
                                                    <select class="form-control select2" name="ProgrammeType" id="ProgrammeType" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Select Degree Programme </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programmes WHERE type_id = 2 AND isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["programme_code"]. ' - '.$A["programme_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 3. ACADEMIC BACKGROUND </h6>
                                        <h6> Please select one of the following Options: <br>
                                            i). KENYA CERTIFICATE OF SECONDARY EDUCATION (KCSE) <br/>
                                            ii). KENYA ADVANCED CERTIFICATE OF EDUCATION (KACE) <br/>
                                            iii). INTERNATIONAL EXAMINATION FOR INTERNATIONAL STUDENTS <br/>
                                        </h6>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label> Select Academic Background: <span>*</span></label><br/>
                                                    <select class="form-control select2" name="AcademicBackground" id="AcademicBackground" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value="" selected> Select Academic Background </option>
                                                        <option value="1">KENYA CERTIFICATE OF SECONDARY EDUCATION (KCSE) </option>
                                                        <option value="2">KENYA ADVANCED CERTIFICATE OF EDUCATION (KACE)</option>
                                                        <option value="3">INTERNATIONAL EXAMINATION (FOR INTERNATIONAL STUDENTS)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d_none" id="KCPE">
                                            <h6> KENYA CERTIFICATE OF SECONDARY EDUCATION (KCSE)/KCE/EACE or Equivalent Examination passed. Candidates offering alternative qualifications must attach copy(ies) of certificate(s). </h6>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label> Last Secondary/High School attended <span>*</span></label><br/>
                                                        <input type="text" name="SecondaryAttended" id="SecondaryAttended" placeholder="Secondary School Attended" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Date of Admission: <span>*</span></label><br/>
                                                        <div class="input-group bootstrap-timepicker">
                                                          <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                          <input type="text" class="form-control datepicker" id="SecDateFrom" name="SecDateFrom" placeholder="Date From" autocomplete="off">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-2">
                                                        <label> Date of Completion: <span>*</span></label><br/>
                                                        <div class="input-group bootstrap-timepicker">
                                                          <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                          <input type="text" class="form-control datepicker" id="SecDateTo" name="SecDateTo" placeholder="Date To" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Year of Examination: </label>
                                                        <select class="form-control select2" name="SecYearofAdmission" id="SecYearofAdmission" style="width: 100%; border-radius: 0; height:36px;">
                                                            <option value="" selected> Select Year</option>
                                                            <?php for ($i = date('Y'); $i > date('Y') - 10; $i--) 
                                                            {
                                                                echo "<option value='{$i}'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label> Examination Body: <span>*</span></label><br/>
                                                         <input type="text" name="SecExaminationBody" id="SecExaminationBody" placeholder="Examination Body" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Index Number: <span>*</span></label><br/>
                                                         <input type="text" name="SecIndexNumber" id="SecIndexNumber" placeholder="Index Number" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Mean Grade: <span>*</span></label><br/>
                                                         <input type="text" name="SecMeanGrade" id="SecMeanGrade" placeholder="e.g. A, B, C, D" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Points: <span>*</span></label><br/>
                                                         <input type="text" name="SecAwardedPoints" id="SecAwardedPoints" placeholder="e.g. 90, 80, 70, 60" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="KCPEFileUpload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Scanned PDF Certificates </label>
                                                        <input id="KCPEFileUpload" type="file" class="d_none" name="KCPEFileUpload"/>
                                                    </div>
                                                </div>
                                                <div class="row DynamicFormTab pt-20">
                                                    <h6 style="margin-left: 15px;"> Add at least 8 subjects and grade obtained in above: </h6>
                                                    <div class="col-md-4">
                                                        <label>Subject <span>*</span></label>
                                                        <input type="text" id="Subject-1" required class="form-control" name="Subject[]" placeholder="Indicate Subject" autocomplete="OFF">
                                                        <input type="hidden" id="DynamicSubjects-1" name="DynamicSubjects[]" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="GradeObtained"> Grade <span>*</span></label>
                                                        <input type="text" id="GradeObtained-1" required class="form-control t_align_c" name="GradeObtained[]" placeholder="e.g. A, B, C" autocomplete="OFF">
                                                    </div> 
                                                    <div class="col-md-4 pt-20">
                                                        <span class="float-right"><button type="button" type="button"class="btn btn-block btn-info" style="height: 35px; margin-top: 10px;" id="addSubjectButton"><i class="fa fa-plus"></i> Add Subject </button></span>
                                                    </div>
                                                </div>
                                                <!--Input Fields Wrapper Starts -->
                                                <div id="dynamic_fields_subjects"></div>
                                                <!--End Dynamic Listing -->  
                                            </div> <hr />
                                        </div>
                                        <div class="d_none" id="KACE">
                                            <h6> KENYA ADVANCED CERTIFICATE OF EDUCATION (KACE), EAACE or Equivalent. (Write N/A if Not Applicable) </h6>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label> High School attended </label><br/>
                                                        <input type="text" name="KACSecondaryAttended" id="KACSecondaryAttended" placeholder="Secondary School Attended" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Date of Admission: </label><br/>
                                                        <div class="input-group bootstrap-timepicker">
                                                          <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                          <input type="text" class="form-control datepicker" id="KACAdmissionDate" name="KACAdmissionDate" placeholder="Date of Admission" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Date of Graduation: </label><br/>
                                                        <div class="input-group bootstrap-timepicker">
                                                          <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                          </div>
                                                          <input type="text" class="form-control datepicker" id="KACGraduationDate" name="KACGraduationDate" placeholder="Date of Graduation" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Year of Examination: </label>
                                                        <select class="form-control select2" name="KACYearofExamination" id="KACYearofExamination" style="width: 100%; border-radius: 0; height:36px;">
                                                            <option value="" selected> Select Year</option>
                                                            <?php for ($i = date('Y'); $i > date('Y') - 10; $i--) 
                                                            {
                                                                echo "<option value='{$i}'>$i</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label> Examination Body: </label><br/>
                                                         <input type="text" name="KACExaminationBody" id="KACExaminationBody" placeholder="Examination Body" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Index Number: </label><br/>
                                                         <input type="text" name="KACIndexNumber" id="KACIndexNumber" placeholder="Index Number" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Principle Pass (es): </label><br/>
                                                         <input type="text" name="KACResultPrinciple" id="KACResultPrinciple" placeholder="Result Principle" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label> Subsidiary Pass (es): </label><br/>
                                                         <input type="text" name="KACSubsidiaryPass" id="AwardedPoints" placeholder="Subsidiary Pass" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="KACEFileUpload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Scanned PDF Certificates </label>
                                                        <input id="KACEFileUpload" type="file" class="d_none" name="KACEFileUpload"/>
                                                    </div>
                                                </div>
                                                <div class="row DynamicFormTab pt-20">
                                                    <h6 style="margin-left: 15px;"> Add at least 3 subjects and grade obtained above: </h6>
                                                    <div class="col-md-4">
                                                        <label>Subject </label>
                                                        <input type="text" id="KACSubject-1" class="form-control" name="KACSubject[]" placeholder="Indicate Subject" autocomplete="OFF">
                                                        <input type="hidden" id="KACDynamicSubjects-1" name="KACDynamicSubjects[]">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="KACGradeObtained"> Grade </label>
                                                        <input type="text" id="KACGradeObtained-1" class="form-control" name="KACGradeObtained[]" placeholder="Grade Obtained" autocomplete="OFF">
                                                    </div> 
                                                    <div class="col-md-4 pt-20">
                                                        <span class="float-right"><button type="button" type="button"class="btn btn-block btn-info" style="height: 35px;" id="addKACSubjectButton"><i class="fa fa-plus"></i> Add Subject </button></span>
                                                    </div>
                                                </div>
                                                <!--Input Fields Wrapper Starts -->
                                                <div id="dynamic_fields_kacsubjects"></div>
                                                <!--End Dynamic Listing -->  
                                            </div> <hr />
                                        </div>
                                        <h6> 4. PROFESSIONAL OR OTHER QUALIFICATION (S) </h6>
                                        <div class="form-group">
                                            <!--Start Dynamic Listing -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Give details where obtained, dates and certificate(s) awarded. (Attach documentary proof). </h6>
                                                </div>
                                            </div>
                                            <div class="row DynamicFormTab pt-20">
                                                <div class="col-md-2">
                                                    <label>Qualifications <span>*</span></label>
                                                    <input type="text" id="Qualifications-1" class="form-control" name="Qualifications[]" placeholder="Qualifications" autocomplete="OFF">
                                                    <input type="hidden" id="ProfessionalQualification-1" name="ProfessionalQualification[]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="WhereObtained"> Where obtained <span>*</span></label>
                                                    <input type="text" id="WhereObtained-1" class="form-control" name="WhereObtained[]" placeholder="Where Obtained" autocomplete="OFF">
                                                </div> 
                                                <div class="col-md-2">
                                                    <label>Start Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="QualificationsStartDate-1" name="QualificationsStartDate[]" placeholder="Start Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>End Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="QualificationsEndDate-1" name="QualificationsEndDate[]" placeholder="End Date" autocomplete="off">
                                                    </div>
                                                </div>                                                       
                                                <div class="col-md-2">
                                                    <label for="AwardObtained"> Award Obtained <span>*</span></label>
                                                    <input type="text" id="AwardObtained-1" class="form-control"  name="AwardObtained[]" placeholder="Award Obtained" autocomplete="OFF">
                                                </div>
                                                <div class="col-md-2 AddDrugItemTab pt-20">
                                                    <span class="float-right"><button type="button" type="button"class="btn btn-block btn-info" style="height: 35px;" id="addButton"><i class="fa fa-plus"></i> Add  </button></span>
                                                </div>
                                            </div>
                                            <!--Input Fields Wrapper Starts -->
                                            <div id="dynamic_fields"></div>
                                            <!--End Dynamic Listing -->  
                                        </div><hr />
                                        <h6>5. EMPLOYMENT HISTORY: </h6>
                                        <h6> List all relevant work experience: previous and current. </h6>
                                        <div class="form-group">
                                            <div class="row DynamicFormTab pt-20">
                                                <div class="col-md-3">
                                                    <label>Position <span>*</span></label>
                                                    <input type="text" id="Position-1" class="form-control" name="Position[]" placeholder="Position" autocomplete="OFF">
                                                    <input type="hidden" id="DynamicFieldPosition-1" name="DynamicFieldPosition[]">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="EmploymentPlace"> Place <span>*</span></label>
                                                    <input type="text" id="EmploymentPlace-1" class="form-control" name="EmploymentPlace[]" placeholder="Employment Place" autocomplete="OFF">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Start Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="EmploymentStartDate-1" name="EmploymentStartDate[]" placeholder="Start Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>End Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="EmploymentEndDate-1" name="EmploymentEndDate[]" placeholder="End Date" autocomplete="off">
                                                    </div>
                                                </div>                                                       
                                                <div class="col-md-2 d_none pt-20">
                                                    <label for="info" class="btn btn-block btn-success" style="width: 100%; height: 37px;"> Is Current <input type="checkbox" id="info-1" name="info[]" class="badgebox"><span class="badge">&check;</span></label>
                                                </div>
                                                <div class="col-md-2 AddDrugItemTab pt-20">
                                                    <span class="float-right"><button type="button" type="button"class="btn btn-block btn-info" style="height: 35px;" id="addEmploymentButton"><i class="fa fa-plus"></i> Add Position </button></span>
                                                </div>
                                            </div>
                                            <!--Input Fields Wrapper Starts -->
                                            <div id="dynamic_fields_employment"></div>
                                            <!--End Dynamic Listing -->  
                                        </div><hr/>
                                        <h6> 6. ACADEMIC REFEREES (Applicable only to degree applicants) </h6>
                                        </h6> Give names, contacts and designation of two referees. </h6>
                                        <div class="form-group">
                                            REFEREE 1
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>  Name <span>*</span></label><br/>
                                                    <input type="text" name="Referee1Name" id="Referee1Name" placeholder="Referee1 Name" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Designation <span>*</span></label><br/>
                                                    <input type="text" name="Referee1Title" id="Referee1Title" placeholder="Referee1 Designation" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Address <span>*</span></label><br/>
                                                    <input type="text" name="Referee1Address" id="Referee1Address" placeholder="Referee1 Address" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Email Address <span>*</span></label><br/>
                                                    <input type="email" name="Referee1Email" id="Referee1Email" placeholder="Referee1 Email" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>  Telephone <span>*</span></label><br/>
                                                    <input type="text" name="Referee1Telephone" id="Referee1Telephone" placeholder="Referee1 Telephone" class="form-control required">
                                                </div>
                                            </div><br/>

                                            REFEREE 2
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>  Name </label><br/>
                                                    <input type="text" name="Referee2Name" id="Referee2Name" placeholder="Referee2 Name" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Designation </label><br/>
                                                    <input type="text" name="Referee2Title" id="Referee2Title" placeholder="Referee2 Designation" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Address </label><br/>
                                                    <input type="text" name="Referee2Address" id="Referee2Address" placeholder="Referee2 Address" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Email Address </label><br/>
                                                    <input type="email" name="Referee2Email" id="Referee2Email" placeholder="Referee2 Email" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>  Telephone </label><br/>
                                                    <input type="text" name="Referee2Telephone" id="Referee2Telephone" placeholder="Referee2 Telephone" class="form-control required">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Back </button>
                                            <button type="button" class="btn btn-next nearApprove"> Next <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 2 -->
                                    <!-- Form Step 3 -->
                                    <fieldset>
                                        <h4> APPLICATION SUMMARY: <span>Step 3 - 3 </span></h4>
                                        <div style="clear:both;"></div>
                                        <div class="table-responsive">
                                          <table class="table">
                                            <tr><th>Name</th><td id="ConfirmNames"></td></tr>
                                            <tr><th>Gender</th><td id="ConfirmGender">Gender</td></tr>
                                            <tr><th>ID Number</th><td id="ConfirmIDNumber"></td></tr>
                                            <tr><th>Personal Email</th><td id="ConfirmPersonalEmail"></td></tr>
                                            <tr><th>DOB</th><td id="ConfirmDOB"></td></tr><hr/>
                                            <tr><th>Academic Background</th><td id="ConfirmAcademicBackground"></td></tr>
                                            <tr><th>Employment Record</th><td id="ConfirmEmployment"></td></tr>
                                            <tr><th>Programme Applied For</th><td id="ConfirmProgramme"></td></tr>
                                            <tr><th>Referees</th><td id="ConfirmReferees"></td></tr>
                                          </table>
                                        </div>
                                        <P>
                                            <b> DECLARATION:</b><br />
                                            <b>I declare that all statements on this application from and any material filed in support here of are true, correct and complete and all required information has been disclosed. I acknowledge that providing incorrect information or withholding relevant information may result in the University withdrawing any offer of a place and that withdrawal may take place at any stage during the course of study:</b>
                                            <hr />

                                            NOTE: Once your application is received at the eCampus and confirmed as complete, it will be forwarded to the Office of the Registrar, Academic Affairs for further action.
                                        </P>

                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Back </button>
                                            <button type="submit" class="btn btn-submit"> <i class="fa fa-send-o"></i> Submit </button>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 3 -->
                                </form>
                                <!-- Form Wizard -->
                            </div>
                            <!-- Form Wizard Ends -->
                            <!--Processing Submission -->
                            <center id="LoadingDiv" name="LoadingDiv" class="d_none">
                              <h4 class="ptb-35">Please wait... Processing Your Submission </h4>
                              <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
                            </center>
                            <!--End Submission Processing -->
                            <!-- Success Div -->
                            <div id="SuccessDiv" class="alert alert-success d_none pt-60" role="alert">
                                <h4 align="center"> Your application is complete! </h4>
                                <p align="center"> Thank you for registering with us for e-learning programme. Our administrator will review your application and an email will be sent to you upon successful confirmation. </p><hr>
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
                var v = jQuery("#UndeGraduateRegisterFRM").validate({
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
                        IDNumber: {
                            required: true,
                            number: true,
                            minlength: 6
                        },
                        SecondaryAttended: {
                            required: true
                        },
                        SecDateFrom: {
                            required: true
                        },
                        SecDateTo: {
                            required: true
                        },
                        SecYearofAdmission: {
                            required: true
                        },
                        SecExaminationBody: {
                            required: true
                        },
                        SecIndexNumber: {
                            required: true
                        },
                        SecMeanGrade: {
                            required: true
                        },
                        SecAwardedPoints: {
                            required: true
                        }
                    },
                    errorElement: "span",
                    errorClass: "help-inline-error",
                });
                
            });

            $(document).ready(function() {
                
                toastr.options.timeOut = 15000; // 1.5s
                toastr.info('Welcome to Under Graduate Registration. Please fill all the required fields marked with asterik (*)');
                
                $('.form-wizard .btn-first').on('click', function () {
                    if ($('#UndeGraduateRegisterFRM').valid()) {
                        toastr.info('Fill in your programme application details');
                    }
                    else {
                        toastr.error('Please correct the errors on form inputs to proceed');
                    }
                });

                $("form#UndeGraduateRegisterFRM").submit(function (e) {
                    e.preventDefault();
                    if ($('#UndeGraduateRegisterFRM').valid()) {
                        $("#LoadingDiv").show('fast');
                        $('.form-wizard').hide("fast");
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: 'submit-undergraduate',
                            type: 'POST',
                            data: formData,
                            async: true,
                            success: function (data) {
                                window.setTimeout(close, 1000);
                                function close() {
                                    $("#LoadingDiv").hide('explode');
                                    $('#SuccessDiv').show("fast");
                                    //$('#UndeGraduateRegisterFRM')[0].reset();
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
                  dateFormat: "yy-mm-dd",
                  yearRange: "-50:+0"
                  //maxDate: dateToday
                }); 
            });

            //Start Dynamic form Professional Qualifications
            var fieldscount = 1;
            $("#addButton").click(function (e) { //ProfessionalQualification Qualifications WhereObtained QualificationsStartDate QualificationsEndDate AwardObtained
                e.preventDefault();
                fieldscount++;
                $("#dynamic_fields").append('<div class="row pt-20">' +
                    '<div  class="col-md-2">' +
                    '<div class="m_top_15 m_xs_bottom_15">' +
                    '<input type="text" id="Qualifications-' + fieldscount + '" class="form-control item-name" name="Qualifications[]" placeholder="Qualifications" autocomplete="OFF">' +
                    '<input type="hidden" id="ProfessionalQualification-' + fieldscount + '" name="ProfessionalQualification[]">' +
                    '</div>' +
                    '</div>' +
                    '<div  class="col-md-2">' +
                    '<input type="text" id="WhereObtained-' + fieldscount + '" class="form-control t_align_c"  name="WhereObtained[]" placeholder = "Where Obtained"  autocomplete="OFF">' +
                    '</div>' +    
                    '<div  class="col-md-2">' +
                    '<input type="text" id="QualificationsStartDate-' + fieldscount + '" class="form-control datepicker"  name="QualificationsStartDate[]" placeholder = "Start Date" autocomplete="OFF">' +
                    '</div>' +
                    '<div  class="col-md-2">' +
                    '<input type="text" id="QualificationsEndDate-' + fieldscount + '" class="form-control datepicker"  name="QualificationsEndDate[]" placeholder = "End Date" autocomplete="OFF">' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<input type="text" id="AwardObtained-' + fieldscount + '" class="form-control" name="AwardObtained[]" placeholder="Award Obtained" autocomplete="OFF">' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<a href="#" class="btn btn-block btn-danger removeButton" style="height: 35px;" id="removeButton-' + fieldscount + '"><i class="fa fa-trash"></i> Remove </a>' +
                    '</div>' +
                    '</div>'
                );
            });

            $(dynamic_fields).on("click", ".removeButton", function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                fieldscount--;
                var toRemove = this.id;
                removeValue(toRemove);

            });

            //Start Dynamic form Add Subject/Grade
            //Subject DynamicSubjects GradeObtained addSubjectButton dynamic_fields_subjects
            var fieldscount2 = 1;
            $("#addSubjectButton").click(function (e) { 
                e.preventDefault();
                fieldscount2++;
                $("#dynamic_fields_subjects").append('<div class="row pt-20">' +
                    '<div  class="col-md-4">' +
                    '<div class="m_top_15 m_xs_bottom_15">' +
                    '<input type="text" id="Subject-' + fieldscount2 + '" class="form-control item-name" name="Subject[]" placeholder="Indicate Subject" autocomplete="OFF">' +
                    '<input type="hidden" id="DynamicSubjects-' + fieldscount2 + '" name="DynamicSubjects[]">' +
                    '</div>' +
                    '</div>' +
                    '<div  class="col-md-4">' +
                    '<input type="text" id="GradeObtained-' + fieldscount2 + '" class="form-control t_align_c"  name="GradeObtained[]" placeholder = "e.g. A, B, C"  autocomplete="OFF">' +
                    '</div>' +              
                    '<div class="col-md-4">' +
                    '<a href="#" class="btn btn-block btn-danger removeButton2" style="height: 35px;" id="removeButton2-' + fieldscount2 + '"><i class="fa fa-trash"></i> Remove Subject </a>' +
                    '</div>' +
                    '</div>'
                );
            });

            $(dynamic_fields_subjects).on("click", ".removeButton2", function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                fieldscount2--;
                var toRemove = this.id;
                removeValue(toRemove);

            });

            //Start Dynamic form Add KAC Subject/Grade
            //KACSubject KACDynamicSubjects KACGradeObtained addKACSubjectButton dynamic_fields_kacsubjects
            var fieldscount3 = 1;
            $("#addKACSubjectButton").click(function (e) { 
                e.preventDefault();
                fieldscount3++;
                $("#dynamic_fields_kacsubjects").append('<div class="row pt-20">' +
                    '<div  class="col-md-4">' +
                    '<div class="m_top_15 m_xs_bottom_15">' +
                    '<input type="text" id="KACSubject-' + fieldscount3 + '" class="form-control item-name" name="KACSubject[]" placeholder="Indicate Subject" autocomplete="OFF">' +
                    '<input type="hidden" id="KACDynamicSubjects-' + fieldscount3 + '" name="KACDynamicSubjects[]">' +
                    '</div>' +
                    '</div>' +
                    '<div  class="col-md-4">' +
                    '<input type="text" id="KACGradeObtained-' + fieldscount3 + '" class="form-control t_align_c"  name="KACGradeObtained[]" placeholder = "Grade Obtained"  autocomplete="OFF">' +
                    '</div>' +              
                    '<div class="col-md-4">' +
                    '<a href="#" class="btn btn-block btn-danger removeButton3" style="height: 35px;" id="removeButton3-' + fieldscount3 + '"><i class="fa fa-trash"></i> Remove Subject </a>' +
                    '</div>' +
                    '</div>'
                );
            });

             $(dynamic_fields_kacsubjects).on("click", ".removeButton3", function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                fieldscount3--;
                var toRemove = this.id;
                removeValue(toRemove);

            });


            //dynamic_fields_employment
            //Start Dynamic form Add Employment History
            //DynamicFieldPosition Position EmploymentStartDate EmploymentEndDate dynamic_fields_employment
            var fieldscount4 = 1;
            $("#addEmploymentButton").click(function (e) { 
                e.preventDefault();
                fieldscount4++;
                $("#dynamic_fields_employment").append('<div class="row pt-20">' +
                    '<div class="col-md-3">' +
                    '<div class="m_top_15 m_xs_bottom_15">' +
                    '<input type="text" id="Position-' + fieldscount4 + '" class="form-control item-name" name="Position[]" placeholder="Position" autocomplete="OFF">' +
                    '<input type="hidden" id="DynamicFieldPosition-' + fieldscount4 + '" name="DynamicFieldPosition[]">' +
                    '</div>' +
                    '</div>' +
                    '<div  class="col-md-3">' +
                    '<input type="text" id="EmploymentPlace-' + fieldscount4 + '" class="form-control t_align_c"  name="EmploymentPlace[]" placeholder = "Employment Place"  autocomplete="OFF">' +
                    '</div>' +  
                    '<div  class="col-md-2">' +
                    '<input type="text" id="EmploymentStartDate-' + fieldscount4 + '" class="form-control t_align_c"  name="EmploymentStartDate[]" placeholder = "Start Date"  autocomplete="OFF">' +
                    '</div>' +   
                    '<div  class="col-md-2">' +
                    '<input type="text" id="EmploymentEndDate-' + fieldscount4 + '" class="form-control t_align_c"  name="EmploymentEndDate[]" placeholder = "End Date"  autocomplete="OFF">' +
                    '</div>' +
                    '<div  class="col-md-2 d_none">' +
                    '<label for="info" class="btn btn-block btn-success" style="width: 100%; height: 37px;"> Is Current <input type="checkbox" id="info-' + fieldscount4 + '" name="info[]" class="badgebox"><span class="badge">&check;</span></label>' +   
                    '</div>' +          
                    '<div class="col-md-2">' +
                    '<a href="#" class="btn btn-block btn-danger removeButton4" style="height: 35px;" id="removeButton4-' + fieldscount4 + '"><i class="fa fa-trash"></i> Remove </a>' +
                    '</div>' +
                    '</div>'
                );
            });

            $(dynamic_fields_employment).on("click", ".removeButton4", function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                fieldscount4--;
                var toRemove = this.id;
                removeValue(toRemove);

            });

            var removeValue = function (toRemove) {
                var removeFrom = $("#inlist").html().split(',');
                var index = removeFrom.indexOf(toRemove);
                if (index > -1) {
                    removeFrom.splice(index, 1);
                }
                $("#inlist").html(removeFrom.join(','));
            }

            $('#Country').change(function() {
                //Use $option (with the "$") to see that the variable is a jQuery object
                var $option = $(this).find('option:selected');
                //Added with the EDIT
                var value = $option.val(); //to get content of "value" attrib
                var text = $option.text(); //to get <option>Text</option> content
                $("#CountryName").val(text);
                if(value == 95){
                    $('#CountyDIV').removeClass('d_none');
                    $('#TownCityDiv').addClass('d_none');
                }
                else {
                    $('#CountyDIV').addClass('d_none');
                    $('#TownCityDiv').removeClass('d_none');
                }
            });

            $('#CountyID').change(function() {
                var $option = $(this).find('option:selected');
                var value = $option.val();
                var text = $option.text();
                $("#CountyName").val(text);
            });
            
            $('#AcademicBackground').change(function() {
                //Use $option (with the "$") to see that the variable is a jQuery object
                var $option = $(this).find('option:selected');
                //Added with the EDIT
                var value = $option.val(); //to get content of "value" attrib
                var text = $option.text(); //to get <option>Text</option> content
                if(value == 1){
                    $('#KCPE').removeClass('d_none');
                    $('#KACE').addClass('d_none');
                    $('#INT').addClass('d_none');
                }
                else if(value == 2){
                    $('#KCPE').addClass('d_none');
                    $('#KACE').removeClass('d_none');
                    $('#INT').addClass('d_none');
                }
                else if(value == 3){
                    $('#KCPE').addClass('d_none');
                    $('#KACE').addClass('d_none');
                    $('#INT').removeClass('d_none');
                }
                else {

                } 
            });
            
            //KCPEfile upload
            $('#KCPEFileUpload').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#KCPEFileUpload')[0].files[0].name;
                $(this).prev('label').text(file);
            });

            //KACE upload
            $('#KACEFileUpload').change(function() {
                var i = $(this).prev('label').clone();
                var file1 = $('#KACEFileUpload')[0].files[0].name;
                $(this).prev('label').text(file1);
            });
            
            function ShowUploadedUserPhoto(input) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                $('#ImgDIV').removeClass('d_none');
                $('#ImgInp').removeClass('d_none');
                $('#CamPhotoName').val('');
                reader.onload = function (e) {
                  $('#ImgInp')
                    .attr('src', e.target.result)
                    .width('auto')
                    .height('80');
                };
                reader.readAsDataURL(input.files[0]);
              }
            }

            //ConfirmAcademicBackground ConfirmProgramme
            //Confirm and submit details
            $('.form-wizard .nearApprove').on('click', function () {
                var Names = $('#Surname').val() + " " + $('#Othernames').val();
                $('#ConfirmNames').html(Names);
                var Gender = $('#Gender').find('option:selected').text();
                $('#ConfirmGender').html(Gender);
                var PhoneNumber = $('#PhoneNumber').val();
                $('#ConfirmPhone').html(PhoneNumber);
                var Email = $('#Email').val();
                $('#ConfirmPersonalEmail').html(Email);
                var ID = $('#IDNumber').val();
                $('#ConfirmIDNumber').html(ID);
                var DOB = $('#DOB').val();
                $('#ConfirmDOB').html(DOB);
                var Programme = $('#ProgrammeType').find('option:selected').text();
                $('#ConfirmProgramme').html(Programme);
                var Referees1 = $('#Referee1Name').val();
                var Referees2 = $('#Referee2Name').val();
                var Referees = $('#Referee1Name').val() + " AND " + $('#Referee2Name').val();
                $('#ConfirmReferees').html(Referees);
                var EducationInfo = $('#AcademicBackground').find('option:selected').text() + " - " + $('#SecondaryAttended').val() + " - " + $('#SecExaminationBody').val() + " From " + $('#SecDateFrom').val() + " To " + $('#SecDateTo').val() + " To " + $('#SecMeanGrade').val();
                $('#ConfirmAcademicBackground').html(EducationInfo);
                var Employment = $('#Position-1').val() + " - " + $('#EmploymentPlace-1').val() + " From " + $('#EmploymentStartDate-1').val() + " To " + $('#EmploymentEndDate-1').val();
                $('#ConfirmEmployment').html(Employment);
            });

        </script>
    </body>
</html>
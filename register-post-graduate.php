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
                    <?php include_once('include/mainmenu.php'); ?>
                </header>
                <!-- header end -->
                <div class="blog-area ptb-35">
                    <div class="container">
                        <div class="row">        
                            <!-- Form Wizard Starts -->     
                            <div class="col-md-12 col-sm-12 col-lg-12 form-wizard">
                                <!-- Form Wizard -->
                                <form class="contact-form cf-style-1 m_bottom_40" name="PostGraduateRegisterFRM" id="PostGraduateRegisterFRM" method="POST" action="" enctype="multipart/form-data" action="">
                                    <h5> <b> POST GRADUATE APPLICATION FORM FOR POST GRADUATE PROGRAMMES: E-CAMPUS </b></h5>
                                    <!-- Form progress -->
                                    <div class="form-wizard-steps form-wizard-tolal-steps-4">
                                        <div class="form-wizard-progress">
                                            <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4" style="width: 12.25%;"></div>
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
                                            <div class="form-wizard-step-icon"><i class="fa fa-building" aria-hidden="true"></i></div>
                                            <p>SECTION C</p>
                                        </div>
                                        <!-- Step 3 -->
                                        
                                        <!-- Step 4 -->
                                        <div class="form-wizard-step">
                                            <div class="form-wizard-step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                                            <p>Confirm</p>
                                        </div>
                                        <!-- Step 4 -->
                                    </div>
                                    <!-- Form progress -->
                                    <!-- Form Step 1 -->
                                    <fieldset>
                                        <h4>NOTE: <span>Step 1 - 4</span></h4>
                                        <P>
                                            <ol type="i" class="ol-list">
                                                <li>
                                                    That THREE (3) copies of this form should be sent by courier to the DIRECTOR E-CAMPUS, MASENO UNIVERSITY, VARSITY PLAZA 10TH FLOOR, WING A. P.O. BOX 3275-40100, KISUMU. 
                                                </li>
                                                <li>
                                                    That the form should be typed or completed in block letters.
                                                </li>
                                                <li>All applicants must attach copies of their certificates/transcripts and a copy of their Identity Card/Passport.</li>
                                                <li>That only successful candidates will be contacted.</li>
                                                <li>That the names appearing on this form should be the same as those on your certificates.</li>
                                            </ol><hr />
                                        </P>
                                        <h6> 1. PERSONAL DETAILS: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Surname / Family Name: <span>*</span></label>
                                                    <input type="text" name="Surname" id="Surname" placeholder="Surname/Family Name" class="form-control required">
                                                    <input type="hidden" name="StudentType" id="StudentType" value="1">
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
                                                        <option selected value=""> Select Gender</option>
                                                        <option value="Male" > Male </option>
                                                        <option value="Female" >Female </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Marital Status: </label><br/>
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
                                                    <label>Country From: <span>*</span></label>
                                                    <!--<input type="text" name="Citizenship" id="Citizenship" placeholder="Citizenship" class="form-control required">-->
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
                                                <div class="col-md-3" id="TownCityDiv">
                                                    <label>Town / City / State:</label>
                                                    <input type="text" name="TownCity" id="TownCity" placeholder="Town City" class="form-control">
                                                    <input type="hidden" id="CountryName" name="CountryName" />
                                                    <input type="hidden" id="CountyName" name="CountyName" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ID / Passport Number: <span>*</span></label>
                                                    <input type="text" name="IDNumber" id="IDNumber" placeholder="ID/Passport Number" class="form-control required">
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Phone Number: <span>*</span></label>
                                                    <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Phone Number" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Personal Email: <span>*</span></label>
                                                    <input type="email" name="Email" id="Email" placeholder="Email" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Current Address: <span>*</span></label>
                                                    <input type="text" name="CurrentAddress" id="CurrentAddress" placeholder="Current Address" class="form-control required">
                                                </div> 
                                                
                                                <div class="col-md-3">
                                                    <label> Permanent Address:</label>
                                                    <input type="text" name="PermanentAddress" id="PermanentAddress" placeholder="If different from the current address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label> Postal Address: </label>
                                                    <input type="text" name="PostalAddress" id="PostalAddress" placeholder="Postal Address" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Fax: </label>
                                                    <input type="text" name="Fax" id="Fax" placeholder="Fax" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="image-upload" class="custom-file-upload w_full btn btn-success" style="margin-top: 26px;">
                                                            <i class="fa fa-cloud-upload"></i> Upload Student Photo
                                                        </label>
                                                        <input type="hidden" name="MAX_FILE_SIZE" value="99000000"/>
                                                        <input id="image-upload" accept="image/*" type="file" name="photo" onChange="ShowUploadedUserPhoto(this);"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d_none" id="ImgDIV">
                                                    <center>
                                                    <img src="admin/img/students/user_avatar.png" id="ImgInp" class="img-thumbnail d_none"></center>
                                                </div>
                                            </div>
                                        </div> <br/>
                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 1 -->
                                    <!-- Form Step 2 -->
                                    <fieldset>
                                        <h4>Education / Employment History: <span>Step 2 - 4 </span></h4>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>SECONDARY/HIGH SCHOOL(S) ATTENDED <span>*</span></label><br/>
                                                    <input type="text" name="SecondaryAttended" id="SecondaryAttended" placeholder="Secondary School Attended" class="form-control required">
                                                </div>
                                            </div><br />
                                            <h5><b>UNIVERSITY EDUCATION OR EQUIVALENT QUALIFICATIONS OBTAINED</b></h5>
                                            <h6>(a). FIRST DEGREE</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> University attended <span>*</span></label><br/>
                                                    <input type="text" name="UniversityAttended" id="UniversityAttended" placeholder="University Attended" class="form-control required">
                                                </div>
                                                <div class="col-md-2">
                                                    <label> Field Of Study <span>*</span></label><br/>
                                                    <input type="text" name="FieldOfStudy" id="FieldOfStudy" placeholder="e.g. History, Economics, Physics, Chemistry" class="form-control required">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Select Date Range </label>
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-success" id="daterange-btn" style="width:100%; padding: 0 10px;     margin: 0px -5px -20px 0px;">
                                                                <i class="fa fa-calendar"></i> Select Date Range
                                                                <i class="fa fa-caret-down"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-2">
                                                    <label> Date From: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control required" id="DateFrom" name="DateFrom" placeholder="Date From" autocomplete="off" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label> Date To: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control required" id="DateTo" name="DateTo" placeholder="Date To" autocomplete="off" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Degree Awarded <span>*</span></label><br/>
                                                    <input type="text" name="DegreeAwarded" id="DegreeAwarded" placeholder="e.g. B.Sc. Upper 2nd Class Honours" class="form-control required">
                                                </div> 
                                                <div class="col-md-2">
                                                    <label>Date Awarded: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker required" id="DateAwarded" name="DateAwarded" placeholder="Date Awarded" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="degeree1Upload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Certificates (if any) in PDF
                                                    </label>
                                                    <input id="degeree1Upload" class="d_none" type="file" name="degeree1Upload"/>
                                                </div>
                                            </div><br />
                                            <h6>(b). SECOND DEGREE</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> University attended </label><br/>
                                                    <input type="text" name="UniversityAttended2" id="UniversityAttended2" placeholder="University Attended" class="form-control">
                                                </div> 
                                                <div class="col-md-2">
                                                    <label> Field Of Study </label><br/>
                                                    <input type="text" name="FieldOfStudy2" id="FieldOfStudy2" placeholder="e.g. History, Economics, Physics, Chemistry" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Select Date Range </label>
                                                        <div class="input-group">
                                                            <button type="button" class="btn btn-success" id="daterange-btn2" style="width:100%; padding: 0 10px;     margin: 0px -5px -20px 0px;">
                                                                <i class="fa fa-calendar"></i> Select Date Range
                                                                <i class="fa fa-caret-down"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Date From: </label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control" id="DateFrom2" name="DateFrom2" placeholder="Date From" autocomplete="off" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Date To: </label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control" id="DateTo2" name="DateTo2" placeholder="Date To" autocomplete="off" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Degree Awarded </label><br/>
                                                    <input type="text" name="DegreeAwarded2" id="DegreeAwarded2" placeholder="e.g. B.Sc. Upper 2nd Class Honours" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Date Awarded: </label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="DateAwarded2" name="DateAwarded2" placeholder="Date Awarded" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="degeree2Upload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Certificates (if any) in PDF
                                                    </label>
                                                    <input id="degeree2Upload" class="d_none" type="file" name="degeree2Upload"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>(c). OTHER DEGREES/DIPLOMA (where applicable): </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Other Degree / Diploma Awarded </label><br/>
                                                    <input type="text" name="DegreeAwardedOther" id="DegreeAwardedOther" placeholder="Other Degree / Diploma" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Date Awarded: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="OtherDegreeDateAwarded" name="OtherDegreeDateAwarded" placeholder="Date Awarded" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="OtherDegreesUpload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Certificates (if any) in PDF
                                                    </label>
                                                    <input id="OtherDegreesUpload" class="d_none" type="file" name="OtherDegreesUpload"/>
                                                </div>
                                            </div>
                                        </div> <br />
                                        <h6>(d). RESEARCH EXPERIENCE (if any): </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>List of publications, research reports, dissertation, thesis etc. Attach separate sheet if necessary. </label>
                                                    <input type="text" name="Research1" id="Research1" placeholder="List of publication (Research 1)" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="file-upload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 34px;"><i class="fa fa-cloud-upload"></i> Upload Research 1
                                                    </label>
                                                    <input id="file-upload" class="d_none" name='research1Attachment' type="file">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>List of publications, research reports, dissertation, thesis etc. Attach separate sheet if necessary. </label>
                                                    <input type="text" name="Research2" id="Research2" placeholder="List of publication (Research 2)" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="file-upload1" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 34px;"><i class="fa fa-cloud-upload"></i> Upload Research 2
                                                    </label>
                                                    <input id="file-upload1" class="d_none" type="file" name="research2Attachment"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>(e). EMPLOYMENT RECORD: </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Current Position</label>
                                                    <input type="text" name="EmploymentPosition" id="EmploymentPosition" placeholder="Employment Position" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label> Employer/Organization </label>
                                                    <input type="text" name="EmploymentPlace" id="EmploymentPlace" placeholder="Employer/Organization" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Start Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="EmploymentStartDate" name="EmploymentStartDate" placeholder="Start Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>End Date: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker" id="EmploymentEndDate" name="EmploymentEndDate" placeholder="End Date" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6>(f). WHAT LANGUAGE DO YOU SPEAK? </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label> Language </label>
                                                    <input type="text" name="LanguageSpoken" id="LanguageSpoken" placeholder="Language Spoken" class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Back </button>
                                            <button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </fieldset>
                                    <!-- Form Step 2 -->
                                    <!-- Form Step 3 -->
                                    <fieldset>
                                        <h4>PROGRAMME APPLICATION DETAILS: <span>Step 3 - 4 </span></h4>
                                        <h6> 4. THE HIGHER DEGREE APPLIED FOR </h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Select Higher Degree: <span>*</span></label><br/>
                                                    <select class="form-control select2" name="ProgrammeType" id="ProgrammeType" style="width: 100%; border-radius: 0; height:36px;">
                                                        <option value=""> Select Higher Degree </option>
                                                        <?php
                                                        foreach ($common->GetRows("SELECT * FROM tbl_programmes WHERE type_id = 1 AND isActive = 1") as $A) {
                                                            ?>
                                                            <option value="<?php echo $A["id"]; ?>"><?php echo $A["programme_code"]. ' - '.$A["programme_name"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Proposed date of commencement: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker required" id="ProposedStartDate" name="ProposedStartDate" placeholder="Start Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Expected date of completion: <span>*</span></label><br/>
                                                    <div class="input-group bootstrap-timepicker">
                                                      <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                      </div>
                                                      <input type="text" class="form-control datepicker required" id="ExpectedCompletionDate" name="ExpectedCompletionDate" placeholder="Date" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Institution where research work is to be done if not at Maseno University: </label>
                                                    <input type="text" name="ResearchInstitution" id="ResearchInstitution" placeholder="Research Institution" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 5. If a doctoral applicant, provide and attach a concept paper (not exceeding 500 words)</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Concept Paper Name </label>
                                                    <input type="text" name="ConceptPaperName" id="ConceptPaperName" placeholder="Concept Paper Name" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="file-upload2" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 26px;"><i class="fa fa-cloud-upload"></i> Upload Concept Paper
                                                    </label>
                                                    <input id="file-upload2" type="file" class="d_none" name="DoctorateConceptPaper"/>
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 6. If a doctoral applicant, indicate if Master’s degree was by coursework and thesis, or coursework and project, or course work only:</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12 style="margin-left: 12px;">
                                                    <label class="radio-inline">
                                                      <input type="radio" name="optradio" value="Coursework and Thesis" checked> Coursework and Thesis
                                                    </label>
                                                    <label class="radio-inline">
                                                      <input type="radio" name="optradio" value="Coursework and Project"> Coursework and Project
                                                    </label>
                                                    <label class="radio-inline">
                                                      <input type="radio" name="optradio" value="Coursework Only"> Coursework Only
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 7. Give the title of your master’s degree thesis:</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="MastersDegreeThesisName" id="MastersDegreeThesisName" placeholder="Masters Degree Thesis Name" class="form-control">
                                                </div>
                                            </div> 
                                        </div>
                                        <h6> 8. Give the title of your master’s degree project:</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="MastersDegreeProjectName" id="MastersDegreeProjectName" placeholder="Masters Degree Project Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 9. Indicate how you intend to finance your studies</h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="HowToFinance" id="HowToFinance" placeholder="How do you intend to finance your Studies?" class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <h6> 10. ACADEMIC REFEREES <i>(Request your referees to write confidential report directly to the Director, School of Graduate Studies – <b>sgs@maseno.ac.ke</b>).</i> </h6>
                                        <div class="form-group">
                                            REFEREE 1
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>  Name <span>*</span></label><br/>
                                                    <input type="text" name="Referee1Name" id="Referee1Name" placeholder="Referee1 Name" class="form-control required">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>  Designation <span>*</span></label><br/>
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
                                    <!-- Form Step 3 -->
                                    <!-- Form Step 4 -->
                                    <fieldset>
                                        <h4> APPLICATION SUMMARY: <span>Step 4 - 4</span></h4>
                                        <div style="clear:both;"></div>
                                        <div class="table-responsive">
                                          <table class="table">
                                            <tr><th>Name</th><td id="ConfirmNames"></td></tr>
                                            <tr><th>Gender</th><td id="ConfirmGender">Gender</td></tr>
                                            <tr><th>ID Number</th><td id="ConfirmIDNumber"></td></tr>
                                            <tr><th>Personal Email</th><td id="ConfirmPersonalEmail"></td></tr>
                                            <tr><th>DOB</th><td id="ConfirmDOB"></td></tr><hr/>
                                            
                                            <tr><th>Education Details</th><td id="ConfirmEducation"></td></tr>
                                            <tr><th>Employment Record</th><td id="ConfirmEmployment"></td></tr>
                                            <tr><th>Languages Spoken</th><td id="ConfirmLanguages"></td></tr>
                                            
                                            <tr><th>Programme Applied For</th><td id="ConfirmProgramme"></td></tr>
                                            <tr><th>Where Research will be Done</th><td id="ConfirmResearchPlace"></td></tr><hr/>
                                            <tr><th>Referees</th><td id="ConfirmReferees"></td></tr>
                                          </table>
                                        </div>
                                        <P>
                                            <b> APPLICATION CHECKLIST:</b> <br />
                                            Please ensure that you have done the following:
                                            <ol type="i" class="ol-list">
                                                <li>
                                                    Attached a passport size photo on each form.
                                                </li>
                                                <li>
                                                    Sent reference letters to the Director, School of Graduate Studies, Maseno University, Private Bag MASENO.
                                                </li>
                                                <li>Attached photocopies of both Academic and Professional certificates on each duly completed form.</li>
                                                <li>Attached photocopies of your transcripts.</li>
                                                <li>For doctoral applicants, attached Concept Paper.</li>
                                            </ol><hr />
                                            NOTE: Once your application is received at the eCampus and confirmed as complete, it will be forwarded to the Office of the Director, School of Graduate Studies for further action.
                                        </P>

                                        <div class="form-wizard-buttons">
                                            <button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Back </button>
                                            <button type="submit" class="btn btn-submit"> <i class="fa fa-send-o"></i> Submit </button>
                                        </div>

                                    </fieldset>
                                    <!-- Form Step 4 -->
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
                var v = jQuery("#PostGraduateRegisterFRM").validate({
                    rules: {   
                        Email: {
                            email: true
                        },
                        Citizenship: {
                            required: true
                        },
                        IDNumber: {
                            required: true,
                            number: true,
                            minlength: 6
                        }
                    },
                    errorElement: "span",
                    errorClass: "help-inline-error",
                }); 
                
            });

            $(document).ready(function() {
                $("form#PostGraduateRegisterFRM").submit(function (e) {
                    e.preventDefault();
                    if ($('#PostGraduateRegisterFRM').valid()) {
                        $("#LoadingDiv").show('fast');
                        $('.form-wizard').hide("fast");
                        var formData = new FormData($(this)[0]);
                        $.ajax({
                            url: 'submit-postgraduate',
                            type: 'POST',
                            data: formData,
                            async: true,
                            success: function (data) {
                                window.setTimeout(close, 1000);
                                function close() {
                                    $("#LoadingDiv").hide('explode');
                                    $('#SuccessDiv').show("fast");
                                    $('#PostGraduateRegisterFRM')[0].reset();
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
                  yearRange: "-50:+0",
                  //maxDate: dateToday
                }); 

                //File Upload preview
                $('#file-upload').change(function() {
                  var i = $(this).prev('label').clone();
                  var file = $('#file-upload')[0].files[0].name;
                  $(this).prev('label').text(file);
                });

                $('#file-upload1').change(function() {
                  var i = $(this).prev('label').clone();
                  var file1 = $('#file-upload1')[0].files[0].name;
                  $(this).prev('label').text(file1);
                });
                
                $('#file-upload2').change(function() {
                    var i = $(this).prev('label').clone();
                    var file2 = $('#file-upload2')[0].files[0].name;
                    $(this).prev('label').text(file2);
                });

                $('#image-upload').change(function() {
                    var i = $(this).prev('label').clone();
                    var file3 = $('#image-upload')[0].files[0].name;
                    $(this).prev('label').text(file3);
                });

                //Degree 1 file upload
                $('#degeree1Upload').change(function() {
                    var i = $(this).prev('label').clone();
                    var file4 = $('#degeree1Upload')[0].files[0].name;
                    $(this).prev('label').text(file4);
                });
                //Degree 2 file upload
                $('#degeree2Upload').change(function() {
                    var i = $(this).prev('label').clone();
                    var file5 = $('#degeree2Upload')[0].files[0].name;
                    $(this).prev('label').text(file5);
                });
                //OtherDegreesUpload
                $('#OtherDegreesUpload').change(function() {
                    var i = $(this).prev('label').clone();
                    var file6 = $('#OtherDegreesUpload')[0].files[0].name;
                    $(this).prev('label').text(file6);
                });
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

            $('#daterange-btn').daterangepicker({
                ranges: {
                    'One Year': [moment().subtract(1, 'years'), moment()],
                    'Last 5 Years': [moment().subtract(5, 'years'), moment()],
                    'Last 10 Years': [moment().subtract(10, 'years'), moment()]
                    },

                    startDate: moment().subtract(4, 'years'),
                    endDate: moment(),
                    showMeridian: false
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('yy-mm-dd') + ' - ' + end.format('yy-mm-dd'));
                    var GetStartDate = moment(start).format('YYYY-MM-DD');
                    var GetEndDate = moment(end).format('YYYY-MM-DD');

                    // PushEndDate
                    $("#DateFrom").val(GetStartDate);
                    $("#DateTo").val(GetEndDate);
                }
            );

            $('#daterange-btn2').daterangepicker({
                ranges: {
                    'One Year': [moment().subtract(1, 'years'), moment()],
                    'Last 5 Years': [moment().subtract(5, 'years'), moment()],
                    'Last 10 Years': [moment().subtract(10, 'years'), moment()]
                    },

                    startDate: moment().subtract(4, 'years'),
                    endDate: moment(),
                    showMeridian: false
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('yy-mm-dd') + ' - ' + end.format('yy-mm-dd'));
                    var GetStartDate = moment(start).format('YYYY-MM-DD');
                    var GetEndDate = moment(end).format('YYYY-MM-DD');

                    // PushEndDate
                    $("#DateFrom2").val(GetStartDate);
                    $("#DateTo2").val(GetEndDate);
                }
            );
            //Summary Details
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
                var EducationInfo = $('#SecondarySchool').val() + " - " + $('#UniversityAttended').val() + " - " + $('#FieldOfStudy').val() + " From " + $('#DateFrom').val() + " To " + $('#DateTo').val();
                $('#ConfirmEducation').html(EducationInfo);
                var Employment = $('#EmploymentPosition').val() + " - " + $('#EmploymentPlace').val() + " From " + $('#EmploymentStartDate').val() + " To " + $('#EmploymentEndDate').val();
                $('#ConfirmEmployment').html(Employment);
                var Language = $('#LanguageSpoken').val();
                $('#ConfirmLanguages').html(Language);
                var ResearchPlace = $('#ResearchInstitution').val();
                $('#ConfirmResearchPlace').html(ResearchPlace);
            });
        </script>
    </body>
</html>
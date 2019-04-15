<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUserID = $_SESSION['UID'];

// Get User Info Data 
if (filter_has_var(INPUT_POST, "GFID")) {
  try {
      $GFID = $_REQUEST['GFID'];
      // Get Patient Info
      $result = $common->GetRows("SELECT `ts`.* FROM apl_student_application_details ts LEFT JOIN tbl_programme_types pt ON `pt`.`id` = `ts`.`application_type` WHERE `ts`.`id` = '{$GFID}'");
      foreach ($result AS $row) {
          $UID = $row['id'];
          $GetfirstName = $row['surname'];
          $application_status = $row['application_status'];
          $GetmiddleName = $row['othernames'];
          $GetpatientTitle = $row['patientTitle'];
          $GetpatientPhone = $row['phone_number'];
          $GetpatientEmail = $row['personal_email'];
          $GetpatientHomeAddress = $row['patientHomeAddress'];
          $GetpatientDateOfirth = $row['date_of_birth'];
          $GetpatientIPOPNumber = $row['idpassport'];
          $Getgender = $row['gender'];
          $CPhoto = $row['student_image'];
          $GetAddress = $row['postal_address'];
          $GetCountry = $row['country'];
          $GetCitizenship = $row['citizenship'];
          $GetMaritalStatus = $row['marital_status'];
          $GetPermanentAddress = $row['permanent_address'];
          $DateToday = new DateTime();
          $DateCreated = $row['date_created'];
          $ApplicationDate = new DateTime($DateCreated);
          $difference = $DateToday->diff($ApplicationDate);
          $ApplicationDuration = format_interval($difference);
          $GetProgrammeAppliedFor = $row['programme'];
          $GetCity = $row['city'];
          $GetFax = $row['fax'];
          $GetApplicationType = $row['application_type'];
          
          // Academic Background For UnderGraduates and Cert/Diploma
          $GetSecondarySchoolAttended = $row['secondary_attended'];
          $GetSecondarySchoolStart = $row['sec_admission_date'];
          $GetSecondarySchoolStart = $row['sec_completion_date'];
          $GetSecondarySchoolEnd = $row['sec_completion_date'];
          $GetSecondarySchoolExamYR = $row['sec_exam_year'];
          $GetSecondarySchoolExamBody = $row['sec_exam_body'];
          $GetSecondarySchoolIndex = $row['sec_index_number'];
          $GetSecondarySchoolMeanGrade = $row['sec_meangrade'];
          $GetSecondarySchoolPoints= $row['sec_points'];
          // KACE
          $GetKACESchoolAttended = $row['kace_school_attended'];
          $GetKACESchoolIndexNumber = $row['kace_index_number'];
          $GetKACEAdmissionDate = $row['kace_admission_date'];
          $GetKACEEndDate = $row['kace_completion_date'];
          $GetKACEExamYear = $row['kace_exam_year'];
          $GetKACEExamBody = $row['kace_exam_body'];
          $GetKACEExamYR = $row['sec_exam_year'];
          $GetKACEExamBody = $row['sec_exam_body'];
          $GetKACEPrincipalPass = $row['kace_pricipal_pass'];
          $GetKACESubsidiaryPass = $row['kace_subsicidiary_pass'];

          //Referees
          $referee1 = $row['referee1'];
          $referee1_title = $row['referee1_title'];
          $referee1_address = $row['referee1_address'];
          $referee1_email = $row['referee1_email'];
          $referee1_phone = $row['referee1_phone'];

          $referee2 = $row['referee2'];
          $referee2_title = $row['referee2_title'];
          $referee2_address = $row['referee2_address'];
          $referee2_email = $row['referee2_email'];
          $referee2_phone = $row['referee2_phone'];
          $approval_comments = $row['approval_comments'];
          
          if(empty($GetpatientPhone)){
            $GetpatientPhone = '-';
          }

          if(empty($GetpatientEmail)){
            $GetpatientEmail = '-';
          }

          if(empty($CPhoto)){
              $CPhoto = 'user_avatar.png';
          }

          $GetcheckinPaymentOptionID = $row['application_type']; 
          
          if($GetcheckinPaymentOptionID == 1){
            $GetcheckinPaymentOptionName = 'POST GRADUATE APPLICATION';
          }
          elseif($GetcheckinPaymentOptionID == 2){
            $GetcheckinPaymentOptionName = 'UNDER GRADUATE APPLICATION';
          }
          else{
            $GetcheckinPaymentOptionName = 'CERTIFICATE/DIPLOMA APPLICATION'; 
          }
      }
  } catch (Exception $e) {echo $e;}
}

// Get Programme Applied
$GetPHDetails = $common->GetRows("SELECT `pr`.*, `tp`.`type` FROM tbl_programmes pr LEFT JOIN tbl_programme_types tp ON `pr`.`type_id` = `tp`.`id` WHERE `pr`.`id` = '{$GetProgrammeAppliedFor}' LIMIT 1 ");
    foreach ($GetPHDetails AS $phdrow) 
    {
      $ProgrammeName = $phdrow['programme_name'];
      $MinimumEntry = $phdrow['minimum_entry'];
      $ProgrammeCode = $phdrow['programme_code'];
      $ModeOfStudy = $phdrow['mode_of_study'];
      $FeePerModule = $phdrow['fee_per_module'];
      $ProgrammeType = $phdrow['type'];
    }
?>
<style type="text/css">
    label {
        margin-top: 10px;
    }

    .help-inline-error {
        color: red;
    }
    #PTSProceduresPagination div {
        display: inline-block;
        margin-right: 5px;
        margin-top: 5px
    }

    #PTSProceduresPagination .cell a {
        border-radius: 3px;
        font-size: 11px;
        color: #333;
        padding: 8px;
        text-decoration: none;
        border: 1px solid #d3d3d3;
        background-color: #f8f8f8;
    }

    #PTSProceduresPagination .cell a:hover {
        border: 1px solid #c6c6c6;
        background-color: #f0f0f0;
    }

    #PTSProceduresPagination .cell_active span {
        border-radius: 3px;
        font-size: 11px;
        color: #333;
        padding: 8px;
        border: 1px solid #c6c6c6;
        background-color: #e9e9e9;
    }

    #PTSProceduresPagination .cell_disabled span {
        border-radius: 3px;
        font-size: 11px;
        color: #777777;
        padding: 8px;
        border: 1px solid #dddddd;
        background-color: #ffffff;
    }
    .Editable-Cell-Bg{
        /*background-color: #c4fcd0;*/
        border-bottom: 2px solid #ffffff !important;
    }

</style>

<h4 class="text-green m_bottom_20">
  <?php echo $GetcheckinPaymentOptionName; ?> <i>for</i> <b><?php echo $GetfirstName. ' ' .$GetmiddleName; ?></b> <br/>Application Date:  <b><?php echo $DateCreated; ?></b> <br />  Course Applied: <b><?php echo $ProgrammeName; ?></b></span>
</h4><hr/>

<div class="nav-tabs-custom">

  <ul class="nav nav-tabs"> 
      <li class="active"><a href="#PatientInfoTab" data-toggle="tab"> Personal Details</a></li>
      <li id="AcademicTabLink"><a href="#AcademicTab" data-toggle="tab"> Academic Background </a></li>
      <li id="DispenseTabLink"><a href="#DispenseTab" data-toggle="tab"> Qualifications, Employment & Academic References </a></li>
      <li><a href="#PatientNotesTab" data-toggle="tab"> Approval Notes & Comments </a></li>
  </ul>

  <div class="tab-content"> 
      <div class="tab-pane active" id="PatientInfoTab">
        <!--Start Patients Info -->
        <!-- Start Left Tab -->
        <div class="row m_top_20">
          <div class="col-md-6">
            <h4 class="t_align_c-"><i class="fa fa-user"></i> Students Personal Details </h4> <hr />
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th><img src="../img/students/<?php echo $CPhoto; ?>" class="img-thumbnail" width="80"></th>
                    <th><?php echo $GetpatientTitle. ' ' .$GetfirstName. ' ' .$GetmiddleName. ' ' .$GetlastName; ?></th>
                  </tr>
                  <tr>
                    <td><b> National ID Number </b></td>
                    <td><?php echo $GetpatientIPOPNumber; ?></td>
                  </tr>
                  <tr>
                    <td><b> Gender </b></td>
                    <td><?php echo $Getgender; ?></td>
                  </tr>
                  <tr>
                    <td><b> Marital Status </b></td>
                    <td><?php echo $GetMaritalStatus; ?></td>
                  </tr> 
                  <tr>
                    <td><b> Date Of Birth </b></td>
                    <td><?php echo date('d/m/Y', strtotime($GetpatientDateOfirth)); ?> </td>
                  </tr>
                  <tr>
                    <td><b> Phone/Mobile </b></td>
                    <td><?php echo $GetpatientPhone; ?></td>
                  </tr>
                  <tr>
                    <td><b>Email</b></td>
                    <td><?php echo $GetpatientEmail; ?></td>
                  </tr>

                  <tr>
                    <td><b> Country | Citizenship </b></td>
                    <td><?php echo $GetCountry; ?> | <?php echo $GetCitizenship; ?> </td>
                  </tr> 
                  <tr>
                    <td><b>Postal Address</b></td>
                    <td><?php echo $GetAddress; ?></td>
                  </tr> 
                  <tr>
                    <td><b>Permanent Address</b></td>
                    <td><?php echo $GetPermanentAddress; ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
          <!-- /. End Left Div --> 
          <!-- Start Right Tab -->
          <div class="col-md-6">
            <h4 class="t_align_c-"><i class="fa fa-bars"></i> Programme Applied <span class="pull-right btn btn-info btn-small d_none" onClick="CheckOutPatient(<?php echo $GFID; ?>);"><i class="fa fa-rocket"></i> Check Patient Out of Queue</span> </h4><hr />
            
            <h5><b>Programme Name </b></h5><hr />
            <p><?php echo $ProgrammeName; ?></p><hr />

            <h5><b>Programme Type </b></h5><hr />
            <p><?php echo $ProgrammeType; ?></p><hr />

            <h5><b>Minimum Entry Qualifications</b></h5><hr />
            <p><?php echo $MinimumEntry; ?></p><hr />
            
            <h5><b>Fee Per Module</b></h5><hr />
            <p>KES <?php echo number_format($FeePerModule,0); ?>/=</p>

          </div> 
          <!--/. End Right Tab -->
        </div>
        <!-- /. End Patients Info -->
      </div>
      <div class="tab-pane" id="AcademicTab">
        <!-- /.  Patient Vitals Tab -->
        <div id="AcademicTabInfo">
          <div class="row">
            <div class="col-md-6">
              <h4 class="t_align_c-"><i class="fa fa-book"></i> KENYA CERTIFICATE OF SECONDARY EDUCATION </h4> <hr />
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td><b> Secondary School </b></td>
                      <td><?php echo $GetSecondarySchoolAttended; ?></td>
                    </tr>
                    <tr>
                      <td><b> Start - End Date </b></td>
                      <td><?php echo 'From: '. date('d/m/Y', strtotime($GetSecondarySchoolStart)) .' To: '. date('d/m/Y', strtotime($GetSecondarySchoolEnd)); ?></td>
                    </tr>
                    <tr>
                      <td><b> Exam Body </b></td>
                      <td><?php echo $GetSecondarySchoolExamBody; ?></td>
                    </tr> 
                    <tr>
                      <td><b> Exam Year </b></td>
                      <td><?php echo $GetSecondarySchoolExamYR; ?> </td>
                    </tr>
                    <tr>
                      <td><b> Index Number </b></td>
                      <td><?php echo $GetSecondarySchoolIndex; ?></td>
                    </tr>
                    <tr>
                      <td><b> Secondary School Mean Grade  </b></td>
                      <td><?php echo $GetSecondarySchoolMeanGrade .' | '. $GetSecondarySchoolPoints .' Points'; ?></td>
                    </tr>

                  </tbody>
                </table>
              </div><hr/>
              <h4 class="t_align_c-"><i class="fa fa-list"></i> Subject/Grades </h4> <hr />
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th> Subject </th>
                    <th> Grade Obtained </th>
                  </tr>
                  <tbody>
                    <?php $KCSEList = $common->GetRows("SELECT * FROM apl_kcse_subject_grades WHERE application_id = '{$GFID}';");
                    foreach ($KCSEList as $List) { ?> 
                      <tr>
                        <td><?php echo $List['subject']; ?></td>
                        <td><?php echo $List['grade']; ?></td>
                      </tr>
                     <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <h4 class="t_align_c-"><i class="fa fa-book"></i> KACE School Details </h4> <hr />
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td><b> KACE School </b></td>
                      <td><?php echo $GetKACESchoolAttended; ?></td>
                    </tr>
                    <tr>
                      <td><b> Index Number </b></td>
                      <td><?php echo $GetKACESchoolIndexNumber; ?></td>
                    </tr>
                    <tr>
                      <td><b> Start - End Date </b></td>
                      <td><?php echo 'From: '. date('d/m/Y', strtotime($GetKACEAdmissionDate)) .' To: '. date('d/m/Y', strtotime($GetKACEEndDate)); ?></td>
                    </tr>
                     <tr>
                      <td><b> Exam Body </b></td>
                      <td><?php echo $GetKACEExamBody; ?></td>
                    </tr> 
                    <tr>
                      <td><b> Exam Year </b></td>
                      <td><?php echo $GetKACEExamYear; ?> </td>
                    </tr>
                    <tr>
                      <td><b> Index Number </b></td>
                      <td><?php echo $GetSecondarySchoolIndex; ?></td>
                    </tr>
                    <tr>
                      <td><b> Principal Pass | Subsidiary Pass </b></td>
                      <td><?php echo $GetKACEPrincipalPass .' | '. $GetKACESubsidiaryPass; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div> <hr/>
              <h4 class="t_align_c-"><i class="fa fa-list"></i> Subject/Grades </h4> <hr />
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <tr>
                    <th>Subject</th>
                    <th>Grade Obtained</th>
                  </tr>
                  <tbody>
                    <?php $KCSEList = $common->GetRows("SELECT * FROM apl_kace_subject_grades WHERE application_id = '{$GFID}';");
                    foreach ($KCSEList as $List) { ?> 
                      <tr>
                        <td><?php echo $List['subject']; ?></td>
                        <td><?php echo $List['grade']; ?></td>
                      </tr>
                     <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> 
        <!-- /. End Patients Vitals Tab -->
      </div>
      <div class="tab-pane" id="PatientPreExaminationsTab">
          
          <div id="PatientPreExaminationsTabInfo">
              
          </div>

      </div>

      <!-- Treatment Dispensation Tab Starts-->
      <div class="tab-pane" id="DispenseTab">
        <div class="row">
          <div class="col-md-12">
          <h4 class="t_align_c-"><i class="fa fa-list"></i> PROFESSIONAL OR OTHER QUALIFICATION </h4> <hr />
          <div class="box-body no-padding">
            <table class="table table-striped">
              <tr>
                <th> Qualifications </th>
                <th> Where Obtained </th>
                <th> Start Dates </th>
                <th> End Dates </th>
                <th> Award Obtained </th>
              </tr>
              <tbody>
                <?php $KCSEList = $common->GetRows("SELECT * FROM apl_professional_qualifications WHERE application_id = '{$GFID}';");
                foreach ($KCSEList as $List) { ?> 
                  <tr>
                    <td><?php echo $List['qualification']; ?></td>
                    <td><?php echo $List['place_obtained']; ?></td>
                    <td><?php echo $List['start_date']; ?></td>
                    <td><?php echo $List['end_date']; ?></td>
                    <td><?php echo $List['award_obtained']; ?></td>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
          </div>
          </div> <hr />
          <div class="col-md-6">
          <h4 class="t_align_c-"><i class="fa fa-list"></i> EMPLOYMENT HISTORY </h4> <hr />
          <div class="box-body no-padding">
            <table class="table table-striped">
              <tr>
                <th> Position </th>
                <th> Place </th>
                <th> Start Dates </th>
                <th> End Dates </th>
              </tr>
              <tbody>
                <?php $KCSEList = $common->GetRows("SELECT * FROM apl_employment_history WHERE application_id = '{$GFID}';");
                foreach ($KCSEList as $List) { ?> 
                  <tr>
                    <td><?php echo $List['position']; ?></td>
                    <td><?php echo $List['place']; ?></td>
                    <td><?php echo $List['start_date']; ?></td>
                    <td><?php echo $List['end_date']; ?></td>
                  </tr>
                 <?php } ?>
              </tbody>
            </table>
          </div>
          </div>
          <div class="col-md-6">
          <h4 class="t_align_c-"><i class="fa fa-list"></i> ACADEMIC REFEREES </h4> <hr />
          <div class="box-body no-padding">
            <table class="table table-striped">
              <tr>
                <th> Name </th>
                <th> Title </th>
                <th> Address </th>
                <th> Email </th>
                <th> Phone </th>
              </tr>
              <tbody> 

                  <tr>
                    <td><?php echo $referee1; ?></td>
                    <td><?php echo $referee1_title; ?></td>
                    <td><?php echo $referee1_address; ?></td>
                    <td><?php echo $referee1_email; ?></td>
                    <td><?php echo $referee1_phone; ?></td>
                  </tr>

                  <tr>
                    <td><?php echo $referee2; ?></td>
                    <td><?php echo $referee2_title; ?></td>
                    <td><?php echo $referee2_address; ?></td>
                    <td><?php echo $referee2_email; ?></td>
                    <td><?php echo $referee2_phone; ?></td>
                  </tr>

              </tbody>
            </table>
          </div>
          </div>
        </div> 
      </div>
      <!-- Treatment Dispensation Tab Ends-->
      <div class="tab-pane" id="PatientNotesTab">
        <form class="contact-form cf-style-1 m_bottom_40" name="SubmitApproveApplicationFRM" id="SubmitApproveApplicationFRM" method="POST" action="">
          <input type="hidden" class="form-control" name="StudentSurname" id="StudentSurname"  value="<?php echo $GetfirstName; ?>">
          <input type="hidden" class="form-control" name="OtherNames" id="OtherNames"  value="<?php echo $GetmiddleName; ?>">
          <input type="hidden" class="form-control" name="ApplicationID" id="ApplicationID"  value="<?php echo $GFID; ?>">
          <input type="hidden" class="form-control" name="StudentPhone" id="StudentPhone"  value="<?php echo $GetpatientPhone; ?>">
          <input type="hidden" class="form-control" name="StudentGender" id="StudentGender"  value="<?php echo $Getgender; ?>">
          <input type="hidden" class="form-control" name="StudentDOB" id="StudentDOB"  value="<?php echo $GetpatientDateOfirth; ?>">
          <input type="hidden" class="form-control" name="StudentEmailAddress" id="StudentEmailAddress"  value="<?php echo $GetpatientEmail; ?>">
          <input type="hidden" class="form-control" name="StudentIDNumber" id="StudentIDNumber"  value="<?php echo $GetpatientIPOPNumber; ?>">
          <input type="hidden" class="form-control" name="StudentMaritalStatus" id="StudentMaritalStatus"  value="<?php echo $GetMaritalStatus; ?>">
          <input type="hidden" class="form-control" name="StudentPostalAddress" id="StudentPostalAddress"  value="<?php echo $GetAddress; ?>">
          <input type="hidden" class="form-control" name="StudentCountry" id="StudentCountry"  value="<?php echo $GetCountry; ?>">
          <input type="hidden" class="form-control" name="StudentCitizenship" id="StudentCitizenship"  value="<?php echo $GetCitizenship; ?>">
          <input type="hidden" class="form-control" name="StudentPermanentAddress" id="StudentPermanentAddress"  value="<?php echo $GetPermanentAddress; ?>">
          <input type="hidden" class="form-control" name="StudentCity" id="StudentFax"  value="<?php echo $GetCity; ?>">
          <input type="hidden" class="form-control" name="StudentFax" id="StudentFax"  value="<?php echo $GetFax; ?>">
          <input type="hidden" class="form-control" name="StudentProgrammeId" id="StudentProgrammeId"  value="<?php echo $GetProgrammeAppliedFor; ?>">
          <input type="hidden" class="form-control" name="StudentPhoto" id="StudentPhoto"  value="<?php echo $CPhoto; ?>">
          <input type="hidden" class="form-control" name="GetApplicationType" id="GetApplicationType"  value="<?php echo $GetApplicationType; ?>">
          <input type="hidden" class="form-control" name="ProgrammeCode" id="ProgrammeCode"  value="<?php echo $ProgrammeCode; ?>">
          <input type="hidden" class="form-control" name="SubmitApplicationApproval" id="SubmitApplicationApproval"  value="1">

            <div class="row m_top_10"> 
              <?php if($application_status == 0){ ?>
                <div class="col-md-12"> 
                  <h4> Approval Notes </h4>
                  <div class="form-group">
                    <textarea id="AddApprovalNotes" name="AddApprovalNotes" placeholder="Approver's Notes" value = "<?php echo $approval_comments; ?>" style="height: 50px; margin-top: 5px;" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-md-12">   
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat bg-maroon w_full btn-lg" name="submit"> <span class="fa fa-save"></span> Submit Approve Student's Application </button>
                  </div>
                </div>
              <?php } else { ?>
                  <h4 class="t_align_c"> Application has been approved </h4>
              <?php } ?>
            </div>
        </form>
        <!-- /. RF Admission Loader Starts-->
        <center id="RFAdmissionLoader" class="d_none r_corners m_bottom_20 m_top_20">
            <h4 class="m_top_20 m_bottom_20">Please wait... Processing your submission </h4>
            <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
        </center>
        <!-- /. RF Admission Loader Ends--> 
      </div> 
  </div>
</div>

<!-- Close Patient Tab Modal Confirmation Start -->
<div class="modal fade" id="CloseOutPatientModal" role="dialog" aria-labelledby="CloseOutPatientModal">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="t_aling_c"><i class="fa fa-power-off"></i> Decline Students Application? </h4>
          </div>
          <div class="CloseOutPatientModalTab"></div>
      </div>
  </div>
</div>
<!-- Close Patient Tab Modal Confirmation Ends -->
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript" ></script>

<script type="text/javascript">

    $(function () {
        $(".select2").select2();
    });
    
    jQuery().ready(function () {
      var v = jQuery("#SubmitApproveApplicationFRM").validate({
        rules: {
            AddApprovalNotes: {
              required: true
            }
        },
        errorElement: "span", 
        errorClass: "help-inline-error",
       });
    }); 

    $(document).ready(function () {
        $("#SubmitApproveApplicationFRM").submit(function (e) {
            e.preventDefault();
          if($('#SubmitApproveApplicationFRM').valid()){  
            $("#RFAdmissionLoader").show('fast');
            $('#SubmitApproveApplicationFRM').hide("fast");
            var formData = $("#SubmitApproveApplicationFRM").serialize();
            $.ajax({
                url: 'approve-students-application',
                type: 'POST',
                data: formData,
                success: function (data) {
                  $('#SubmitApproveApplicationFRM').show("fast");
                    $("#RFAdmissionLoader").hide('fast');
                    $('.filtering').show();
                    $('.member-data-retrieval').hide();
                    $('#PeopleTableContainer').jtable('load');
                }
            });
          }
        });
    });

</script>
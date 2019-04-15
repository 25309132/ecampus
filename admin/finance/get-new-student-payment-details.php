<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}
$QID = $_POST['GFID'];
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUserID = $_SESSION['UID'];

$GetPC2 = $common->GetRows("SELECT * FROM fin_new_students_payments l LEFT JOIN tbl_payment_options o ON `o`.`id` = `l`.`paymentTypeID` WHERE `l`.`id` = '{$QID}' ");
foreach ($GetPC2 as $gsdata2) 
{
    $paymentTypeID = $gsdata2['paymentTypeID'];
    $studentEmail = $gsdata2['studentEmail'];
    $amountPaid = $gsdata2['paymentAmount'];
    $paymentOptionID = $gsdata2['paymentOptionID'];
    $paymentOptionName = $gsdata2['paymentOptionName'];
    $paymentReference = $gsdata2['paymentReference'];
    $receiptFile = $gsdata2['receiptFile'];
    $paymentDateLogged = $gsdata2['dateLogged'];
}

// Get User Info Data 
if (filter_has_var(INPUT_POST, "GFID")) {
  try {
      // Get Patient Info
      $result = $common->GetRows("SELECT `ts`.* FROM apl_student_application_details ts LEFT JOIN tbl_programme_types pt ON `pt`.`id` = `ts`.`application_type` WHERE `ts`.`application_status` = '1' AND `ts`.`personal_email` = '{$studentEmail}'");

      foreach ($result AS $row) {
          $ApplicationID = $row['id'];
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

<?php if($application_status == 0) {
?>

<div class="row" style="margin: 15px;">
  <div class="col-md-12 alert alert-danger m_top_10 accu-f-md" role="alert"><center><h4 class="t_align_c"><i class="fa fa-shield"></i><hr /><strong>Ooops!</strong> No Payment details! Either application has not been approved or user indicated a wrong email! Contact finance officer. </h4></center></div></div>

<?php } 

else {
?>
<h4 class="text-green m_bottom_20">
  <?php echo $GetcheckinPaymentOptionName; ?> <i>for</i> <b><?php echo $GetfirstName. ' ' .$GetmiddleName; ?></b> <br/>Application Date:  <b><?php echo $DateCreated; ?></b> <br />  Course Applied: <b><?php echo $ProgrammeName; ?></b></span>
</h4><hr/>

<div class="nav-tabs-custom">

  <ul class="nav nav-tabs"> 
      <li class="active"><a href="#PatientInfoTab" data-toggle="tab"> Application Details</a></li>
      <li class="pull-right"><a href="#PatientNotesTab" data-toggle="tab"> Approval Notes & Comments </a></li>
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
            
      <!-- Treatment Dispensation Tab Ends-->
      <div class="tab-pane" id="PatientNotesTab">
        <form class="contact-form cf-style-1 m_bottom_40" name="SubmitApproveApplicationFRM" id="SubmitApproveApplicationFRM" method="POST" action="">
          <input type="hidden" class="form-control" name="StudentSurname" id="StudentSurname"  value="<?php echo $GetfirstName; ?>">
          <input type="hidden" class="form-control" name="OtherNames" id="OtherNames"  value="<?php echo $GetmiddleName; ?>">
          <input type="hidden" class="form-control" name="ApplicationID" id="ApplicationID"  value="<?php echo $ApplicationID; ?>">
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
          <input type="hidden" class="form-control" name="SubmitApplicationApproval" id="SubmitApplicationApproval"  value="<?php echo $QID; ?>"> 
          <input type="hidden" class="form-control" name="receiptFile" id="receiptFile"  value="<?php echo $receiptFile; ?>"> 
          <input type="hidden" class="form-control" name="paymentDateLogged" id="paymentDateLogged" value="<?php echo $paymentDateLogged; ?>"> 
          <input type="hidden" class="form-control" name="payment_option_id" id="payment_option_id" value="<?php echo $paymentTypeID; ?>">

          <div class="row">
            <div class="col-md-3">
              <label> Student Email:  </label>
              <input type="text" id="StudentEmail" name="StudentEmail" class="form-control item-name" value="<?php echo $studentEmail ; ?>" readonly>
            </div>
            <div class="col-lg-3"> 
              <div class="form-group">
                <label> Payment Ref: </label>
                <input type="text" id="paymentreference" name="paymentreference" class="form-control item-name" value="<?php echo $paymentReference; ?>" readonly>
              </div>
            </div>
            <div class="col-lg-3"> 
              <div class="form-group">
                <label> Payment Amount: </label>
                <input type="text" id="Amount" name="Amount" class="form-control item-name" value="<?php echo $amountPaid; ?>" readonly>
              </div>
            </div>
            <div class="col-lg-3"> 
              <div class="form-group">
                <label> Payment Option: </label>
                <input type="text" id="payment_option" name="payment_option" class="form-control item-name" value="<?php echo $paymentOptionName; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12"> 
              <div class="form-group">
                <textarea id="ApprovalComments" name="ApprovalComments" placeholder="Approval Comments" style="height: 50px;" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-danger w_full m_top_10" name="DeclinePaymentInfo" id="DeclinePaymentInfo"> <span class="glyphicon glyphicon-delete"></span> Decline payment </button>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success w_full m_top_10" name="ApprovePaymentInfo" id="ApprovePaymentInfo"> <span class="glyphicon glyphicon-check"></span> Approve payment </button>
            </div>
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
              <h4 class="t_aling_c"><i class="fa fa-power-off"></i> Decline Students Payment </h4>
          </div>
          <div class="CloseOutPatientModalTab"></div>
      </div>
  </div>
</div>
<?php } ?>
<!-- Close Patient Tab Modal Confirmation Ends -->
<script src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js" type="text/javascript" ></script>
<script type="text/javascript">

    jQuery().ready(function () {
      var v = jQuery("#SubmitApproveApplicationFRM").validate({
        rules: {
            ApprovalComments: {
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
                url: 'ajax-approve-new-students-payments',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $('#AddRequestPatientAdmission').val('');
                    $("#RFAdmissionLoader").hide('fast');
                    $('.filtering').show();
                    $('.member-data-retrieval').hide();
                    $('#PeopleTableContainer').jtable('load');


                }
            });
          }
        });

      //Decline Payment info
      $("#DeclinePaymentInfo").click(function (e) {
        e.preventDefault();
          $("#PatientVitalsFSLoader").show('fast');
          $('#SubmitApproveApplicationFRM').hide("fast");
          var paymentToDeclineId = "<?php echo $QID; ?>";
          var studentID = "<?php echo $studentID; ?>";
          var comments = $("#ApprovalComments").val();
          $.ajax({
              url: 'ajax-approve-new-students-payments.php?paymentToDeclineId='+paymentToDeclineId+'&comments='+comments+'&studentID='+studentID,
              type: 'POST',
              success: function (data) {
                  $('#AddRequestPatientAdmission').val('');
                    $("#RFAdmissionLoader").hide('fast');
                    $('.filtering').show();
                    $('.member-data-retrieval').hide();
                    $('#PeopleTableContainer').jtable('load');
              }
          });
      });
  });

</script>
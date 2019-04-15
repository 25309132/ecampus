<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$QID3 = $_POST['GFID'];

$GetPC2 = $common->GetRows("SELECT * FROM fin_students_credits_log l LEFT JOIN tbl_students o ON `o`.`id` = `l`.`studentID` WHERE `l`.`id` = '{$QID3}' ");
foreach ($GetPC2 as $gsdata2) 
{
    $studentID = $gsdata2['studentID'];
    $logApproved = $gsdata2['logApproved'];
    $amountPaid = $gsdata2['amount'];
    $loggedByUID = $gsdata2['loggedByUID'];
    $receiptFile = $gsdata2['supportingDocuments'];
    $studentADM = $gsdata2['admission_number'];
    $surname = $gsdata2['surname'];
    $othernames = $gsdata2['othernames'];
    $admission_number = $gsdata2['admission_number']; //$studentID $amountPaid
}

$GetTotalPrice = $common->CCGetDBValue("SELECT `tp`.`creditAmount` FROM fin_students_credits `tp` WHERE `tp`.`studentID` = '{$studentID}';");
?>
<form class="contact-form cf-style-1" name="PVGDForm" id="PVGDForm" method="POST">
  <fieldset>
    <div class="row">
      <div class="col-md-3">
        <label> Student Names:  </label>
        <input type="text" id="SelectCourse" name="SelectCourse" class="form-control item-name" value="<?php echo $surname.' '.$othernames; ?>" readonly>
      </div>
      <div class="col-lg-3"> 
        <div class="form-group">
          <label> Student Admission Number: </label>
          <input type="text" id="admission_number" name="admission_number" class="form-control item-name" value="<?php echo $admission_number; ?>" readonly>
        </div>
      </div>
      <div class="col-lg-3"> 
        <div class="form-group">
          <label> Credit Amount: </label>
          <input type="text" id="Amount" name="Amount" class="form-control item-name" value="<?php echo $amountPaid; ?>" readonly>
        </div>
      </div>
      <div class="col-lg-3"> 
        <div class="form-group">
          <label> Added By: </label>
          <input type="text" id="payment_option" name="payment_option" class="form-control item-name" value="<?php echo $loggedByUID; ?>" readonly>
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
</fieldset>
</form><hr />

<!--Load Up Data -->
<center id="PatientVitalsFSLoader" class="d_none r_corners m_bottom_20">
  <h4 class="m_top_20 m_bottom_20">Please wait... Processing your submission </h4>
  <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading" style="max-width:160px;">
</center>
<!--End Loading Up Data -->

<!-- /. Start Listing -->
<div id="PPNVitalsJTable"></div>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#PPNVitalsJTable').jtable({
              title: '<i class="fa fa-list m_top_20 m_bottom_20"></i> <?php echo $surname.' '.$othernames.' | '.$admission_number; ?> | TOTAL CREDITS: <?php echo number_format($GetTotalPrice, 0); ?>/=',
              paging: true,
              pageSize: 10,
              sorting: true,
              defaultSorting: 'id DESC',
              selecting: false, //Enable selecting
              actions: {
                  listAction: 'process-listings.php?GetStudentCreditsId=<?php echo $studentID; ?>',
              },
              fields: {
                studentID: {
                    title: 'Student',
                    width: '15%',
                    options: 'process-listings.php?action=studentdetails'
                },
                amount: {
                    title: 'Amount Paid',
                    width: '15%'
                },
                dateLogged: {
                    title: 'Payment Date',
                    width: '15%',
                    type: 'date',
                    displayFormat: 'dd-mm-yy'
                },
                logApproved: {
                    title: 'Confirmed',
                    width: '8%',
                    list: false
                },	
                MyButton: {
                  title: 'Status',
                  width: '10%',
                  display: function (data) {
                    var GetIfConfirmed = data.record.logApproved;
                    if(GetIfConfirmed == 1) {
                      return '<center> <button type="button" class="btn btn-success w_full"><i class="fa fa-check-circle-o"></i> Approved </button> </center>';
                    }
                    else {
                      return '<center> <button type="button" class="btn btn-danger w_full"><i class="fa fa-shield"></i>  </button> </center>';
                    }
                  }
                },		  
              }
          });
          // Re-load records when user click 'load records' button.
          $('#LoadRecordsButton').click(function (e) {
              e.preventDefault();
              $('#PPNVitalsJTable').jtable('load', {
                  SearchUName: $('#SearchUName').val()
              });
          });
          //Load person list from server
          $('#PPNVitalsJTable').jtable('load');
      });
  </script>
<!-- /. End Listing -->

<script type="text/javascript">
    
  $(function () {
      $(".select2").select2();
  });

  jQuery().ready(function() {
    var v = jQuery("#PVGDForm").validate({         
      rules: {  
          ApprovalComments: { //PVGDForm ApprovalComments
              required: true
          },
        }, 
        errorElement: "span",
        errorClass: "help-inline-error",
    });

  });

  jQuery(document).ready(function () {
      $("#ApprovePaymentInfo").click(function (e) {
        e.preventDefault();
          $("#PatientVitalsFSLoader").show('fast');
          $('#PVGDForm').hide("fast");
          var QID3 = "<?php echo $QID3; ?>";
          var Amount = "<?php echo $amountPaid; ?>";
          var StudentID = "<?php echo $studentID; ?>";
          var comments = $("#ApprovalComments").val();
          $.ajax({
              url: 'ajax-approve-students-payments.php?QID3='+QID3+'&comments='+comments+'&StudentID='+StudentID+'&Amount='+Amount,
              type: 'POST',
              success: function (data) {
                  $("#PatientVitalsFSLoader").hide('fast');
                  $("#PVGDForm").show('fast');
                  $('#PPNVitalsJTable').jtable('load');
			            $('#PVGDForm')[0].reset();
              }
          });
      });

      //Decline Payment info
      $("#DeclinePaymentInfo").click(function (e) {
        e.preventDefault();
          $("#PatientVitalsFSLoader").show('fast');
          $('#PVGDForm').hide("fast");
          var paymentToDeclineId = "<?php echo $QID3; ?>";
          var comments = $("#ApprovalComments").val();
          $.ajax({
              url: 'ajax-approve-students-payments.php?paymentToDeclineId='+paymentToDeclineId+'&comments='+comments,
              type: 'POST',
              success: function (data) {
                  $("#PatientVitalsFSLoader").hide('fast');
                  $("#PVGDForm").show('fast');
                  $('#PPNVitalsJTable').jtable('load');
                  $('#PVGDForm')[0].reset();
              }
          });
      });
  });
  
</script>
<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$QID = $_POST['GFID'];

$GetPC2 = $common->GetRows("SELECT * FROM tbl_fee_upload_log l LEFT JOIN tbl_payment_options o ON `o`.`id` = `l`.`paymentTypeID` WHERE `l`.`id` = '{$QID}' ");
foreach ($GetPC2 as $gsdata2) 
{
    $studentID = $gsdata2['studentID'];
    $paymentTypeID = $gsdata2['paymentTypeID'];
    $amountPaid = $gsdata2['amountPaid'];
    $paymentReference = $gsdata2['paymentReference'];
    $paymentOptionName = $gsdata2['paymentOptionName'];
    $receiptFile = $gsdata2['receiptFile'];
}

$GetPC3 = $common->GetRows("SELECT * FROM tbl_students WHERE id = '{$studentID}' ");
foreach ($GetPC3 as $gsdata3) 
{
    $surname = $gsdata3['surname'];
    $othernames = $gsdata3['othernames'];
    $admission_number = $gsdata3['admission_number'];
}

$GetTotalPrice = $common->CCGetDBValue("SELECT `tp`.`floatAmount` FROM tbl_students_float `tp` WHERE `tp`.`studentFID` = '{$studentID}';");
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
              title: '<i class="fa fa-list m_top_20 m_bottom_20"></i> <?php echo $surname.' '.$othernames.' | '.$admission_number; ?> | TOTAL FLOAT: <?php echo number_format($GetTotalPrice, 0); ?>/=',
              paging: true,
              pageSize: 10,
              sorting: true,
              defaultSorting: 'id DESC',
              selecting: false, //Enable selecting
              actions: {
                  listAction: 'process-listings.php?GetStudentPaymentId=<?php echo $studentID; ?>',
              },
              fields: {
                studentID: {
                    title: 'Student',
                    width: '15%',
                    options: 'process-listings.php?action=studentdetails'
                },
                amountPaid: {
                    title: 'Amount Paid',
                    width: '15%'
                },
                paymentTypeID: {
                    title: 'Payment Option',
                    width: '15%',
                    options: 'process-listings.php?action=paymentoptionsnames'
                },
                paymentReference: {
                   title: 'Reference',
                    width: '10%'
                },
                dateLogged: {
                    title: 'Payment Date',
                    width: '15%',
                    type: 'date',
                    displayFormat: 'dd-mm-yy'
                },
                isConfirmed: {
                    title: 'Confirmed',
                    width: '8%',
                    list: false
                },	
                MyButton: {
                  title: 'Status',
                  width: '10%',
                  display: function (data) {
                    var GetIfConfirmed = data.record.isConfirmed;
                    if(GetIfConfirmed == 1) {
                      return '<center> <button type="button" class="btn btn-success w_full"><i class="fa fa-check-circle-o"></i> Confirmed </button> </center>';
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
          var paymentId = "<?php echo $QID; ?>";
          var studentID = "<?php echo $studentID; ?>";
          var amountPaid = "<?php echo $amountPaid; ?>";
          var paymentReference = "<?php echo $paymentReference; ?>";
          var comments = $("#ApprovalComments").val();
          $.ajax({
              url: 'ajax-approve-students-payments.php?paymentId='+paymentId+'&comments='+comments+'&studentID='+studentID+'&amountPaid='+amountPaid+'&paymentReference='+paymentReference,
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
          var paymentToDeclineId = "<?php echo $QID; ?>";
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
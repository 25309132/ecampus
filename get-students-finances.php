<?php
//error_reporting(0);
include_once('sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$LoggedUserID = $_SESSION['UID']; 
$LoggedUserName = $_SESSION['UName']; 
$StudentID = $common->CCGetDBValue("SELECT id FROM tbl_students WHERE admission_number =  '".$LoggedUserName."' ");
?>
<style type="text/css">
  <?php include_once('include/meta.php'); ?>
</style>

<form class="contact-form cf-style-1 ptb-10" name="RaisePPOFormID" id="RaisePPOFormID" method="POST" action="" enctype="multipart/form-data" action="">
    <fieldset>
        <div class="row">
             <div class="col-md-3">
                <div class="form-group">
                    <label>Choose Payment Type </label>
                    <select id="AddPaymentTypeID" name="AddPaymentTypeID" class="form-control select2" style="width: 100%; border-radius: 0; height:36px;">
                        <option value=""> Choose Payment Type </option>
                        <?php $UDSTT = $common->GetRows("SELECT * FROM tbl_payment_options WHERE isActive = 1");
                        foreach ($UDSTT as $uatt) { ?>
                          <option value="<?php echo $uatt['id']; ?>"><?php echo $uatt['paymentOptionName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label> Amount Paid </label>
                    <input id="AddAmount" type="text" class="form-control" name="AddAmount" placeholder="Fee Amount" />
                    <input id="LogStudentPay" type="hidden" name="LogStudentPay" value="1" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label> Payment Reference </label>
                    <input id="PaymentReference" type="text" class="form-control" name="PaymentReference" placeholder="Payment Reference" />
                </div>
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                  <label for="file-upload" class="custom-file-upload w_full btn bg-purple btn-success" style="margin-top: 25px;">
                    <i class="fa fa-cloud-upload"></i> Upload Receipt
                  </label>
                  <input id="file-upload" class="d_none" type="file" name="DocumentName"/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-info w_full submitBtn" name="submit"> <i class="fa fa-check-circle-o"></i> Submit Fee Payment Details</button>
                </div>
            </div>
          </div>
    </fieldset>
</form>

<center id="RLoading_ID" class="d_none r_corners">
    <h4 class="m_top_20 m_bottom_20">Please wait... Fetching Data</h4>
    <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading"
         style="max-width:120px;">
</center><hr/>

<!--Load Up Data -->
<center id="GetLoader" class="d_none r_corners m_bottom_20">
    <h4 class="m_top_20 m_bottom_20">Please wait... Submitting your Details</h4>
    <img src="img/collection/loading-bar.gif" class="img-thumbnail" alt="Loading"
         style="max-width:160px;">
</center>
<!--End Loading Up Data -->

<div id="StudentsTable" style="width: 100%;">
  <div id="PeopleTableContainer" style="width: 100%;"></div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#PeopleTableContainer').jtable({
                title: '<i class="fa fa-list m_bottom_20"></i> My Recent Payments',
                paging: true,
                pageSize: 10,
                sorting: true,
                defaultSorting: 'id DESC',
                selecting: true,
                openChildAsAccordion: true,
                actions: {
                    listAction: 'process-listings.php?action=GetSudentsList'
                },
                fields: {
                    id: {
                        key: true,
                        create: false,
                        edit: false,
                        list: false
                    },
                    amountPaid: {
                        title: 'Amount',
                        width: '15%'
                    },
                    paymentTypeID: {
                        title: 'Option',
                        width: '15%',
                        options: 'process-listings.php?action=paymentoptions'
                    },
                    receiptFile: {
                        title: 'Receipt',
                        width: '30%'
                    },
                    dateLogged: {
                        title: 'Date',
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
                        title: 'Action',
                        width: '8%',
                        display: function (data) {
                          var GetIfConfirmed = data.record.isConfirmed;
                          if(GetIfConfirmed == 1) {
                            return '<center> <button type="button" class="btn btn-info"><i class="fa fa-shield"></i> </button> </center>';
                          }
                          else {
                            return '<center><button class="btn btn-danger btn-sm w_full" onclick="LoadUpDeleteModal(' + data.record.id + ')"> <span class="glyphicon glyphicon-trash"></span>  Delete </button></center>';
                          }
                        }
                    },
                }
            });
            // Re-load records when user click 'load records' button.
            $('#LoadRecordsButton').click(function (e) {
                e.preventDefault();
                $('#PeopleTableContainer').jtable('load', {
                    SearchSchoolName: $('#SearchSchoolName').val(),
                });
            });
            //Load person list from server
            $('#PeopleTableContainer').jtable('load');
        });

    </script>
</div>

<!--START DELETE MODAL -->
<div class="modal fade" id="DefaultDeleteModal" role="dialog" aria-labelledby="DefaultDeleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="t_aling_c"><i class="fa fa-circle-o-notch"></i> Confirm Delete Item </h4>
      </div>
      <div class="CPCModal-data"></div>
    </div>
  </div>
</div>
<!--FINISH DELETE MODAL -->
<script src="admin/assets/jtable/jquery.jtable.js" type="text/javascript"></script>
<!-- Include one of jTable styles. -->
<link href="admin/assets/jtable/themes/jqueryui/jtable_jqueryui.css" rel="stylesheet" type="text/css"/>
<link href="admin/assets/jtable/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
  //Delete Payment
  function LoadUpDeleteModal(getCIID) {
    $('#DefaultDeleteModal').modal({backdrop: 'static', keyboard: false});
    $.ajax({
      type: 'post',
      url: 'delete-payment-record.php',
      async: true,
      data: 'getCIID='+getCIID,
      success: function (data) {
        $('.CPCModal-data').html(data);
      }
    });
  }
  
  //Select 2
  $(function () {
    $(".select2").select2();
  });

  //File Upload preview
  $('#file-upload').change(function() {
    var i = $(this).prev('label').clone();
    var file = $('#file-upload')[0].files[0].name;
    $(this).prev('label').text(file);
  });

  jQuery().ready(function () {
    var v = jQuery("#RaisePPOFormID").validate({
        rules: {   
            AddPaymentTypeID: {
                required: true
            },
            AddAmount: {
                number: true,
                required: true
            }
        },
        errorElement: "span",
        errorClass: "help-inline-error",
    });
  });

  $("form#RaisePPOFormID").submit(function (e) {
        e.preventDefault();
        if ($('#RaisePPOFormID').valid()) {
            $("#RLoading_ID").show('fast');
            $('#RaisePPOFormID').hide("fast");
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'get-students-finances',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                    window.setTimeout(close, 500);
                    function close() {
                        $("#RLoading_ID").hide('explode');
                        $('#RaisePPOFormID').show("fast");
                        $('#RaisePPOFormID')[0].reset();
                        $('#PeopleTableContainer').jtable('load');
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>

<?php
  if(filter_has_var(INPUT_POST, "LogStudentPay"))
  {
    try  
      {    
      $AddPaymentTypeID =$common->CCStrip($_POST['AddPaymentTypeID']); 
      $PaymentReference =$common->CCStrip($_POST['PaymentReference']); 
      $AddAmountF =$common->CCStrip($_POST['AddAmount']);  
      $AddAmount = str_replace( ',', '', $AddAmountF ); 
      //$studentID = $_SESSION['UID'];
      $folderName = "img/payment/";

      $AllowedFileTypes = array('image/png', 'image/jpeg','image/pjpeg','image/gif', 'application/csv', 'application/excel','application/vnd.ms-excel','application/vnd.msexcel','application/mspowerpoint','application/msword', 'application/pdf', 'application/rtf', 'application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template' );
       
      if (in_array($_FILES["DocumentName"]["type"], $AllowedFileTypes))
      {
        $UploadedFile = is_uploaded_file($_FILES['DocumentName']['tmp_name']);
        if ($UploadedFile){
              $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['DocumentName']['name']));
              $TheImageOne= strtotime("now").$safe_filename;
              move_uploaded_file($_FILES['DocumentName']['tmp_name'], $folderName.$TheImageOne);
            }
        else {
            
            $TheImageOne = 'add.png';
        }
      } 
      else
      {
          $TheImageOne = 'add.png';
      }
      $common->Insert("INSERT INTO tbl_fee_upload_log (studentID, paymentTypeID, amountPaid, receiptFile, UIP, UPC, paymentReference) VALUES ('{$StudentID}', '{$AddPaymentTypeID}','{$AddAmount}', '{$TheImageOne}','{$Remote}','{$RemoteBrowser}', '{$PaymentReference}' )");

    } catch (Exception $e){echo $e;} 

  } 
?>
<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Data
if(filter_has_var(INPUT_GET, "paymentOptionId")) {
    $getPaymentOptionId = $_REQUEST['paymentOptionId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_payment_options WHERE id = '{$getPaymentOptionId}';"); 
    foreach ($GetPC as $gsdata) 
    {
        $PaymentOptionName = $gsdata['paymentOptionName'];
        $getisActive = $gsdata['isActive'];
        $PaymentOptionDescription = $gsdata['paymentOptionDescription'];
    }
}

?>

<!-- // Assign Form Variables -->
<script type="text/javascript">
    // Cancel Edit Button
    $(".cancel_edit_btn").click(function(e) {
        e.preventDefault();
        $('#LoadModal').modal('hide'); 
    });
</script>

<!--Start Update Form -->
<form action="" method="post" id="UpdateDepartmentFRM" name="UpdateDepartmentFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        
        <div class="col-md-3">
            <div class="form-group">
                <label>Edit Name</label>
                <input type="text" class="form-control" name="EditPaymentOptionName" id="EditPaymentOptionName" placeholder="Payment Option Name"  autocomplete="off" required value="<?php echo $PaymentOptionName; ?>">
                <input type="hidden" class="form-control" name="Edit_Payment_Option" id="Edit_Payment_Option" value="<?php echo $getPaymentOptionId; ?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label> Edit Description </label>
                <input type="text" class="form-control" name="EditDescription" id="EditDescription" placeholder="Edit Description" autocomplete="off" required value="<?php echo $PaymentOptionDescription; ?>">
            </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="AcademicYearStatus"> Status </label>
            <div class="radio" style="margin-top:0px;">
              <label for="optionsRadios1">
                <input type="radio" name="AcademicYearStatus" id="optionsRadios1" value="1" <?php if($getisActive == 1){ echo 'checked'; }; ?>>
                Active &nbsp;&nbsp;&nbsp;
              </label>
              <label for="optionsRadios2">
                <input type="radio" name="AcademicYearStatus" id="optionsRadios2" value="0" <?php if($getisActive == 0){ echo 'checked'; }; ?>>
                In-Active
              </label>
            </div>
          </div>
        </div>
    </div><hr />
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-success w_full cancel_edit_btn"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel Edit </button>
        </div>
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-danger w_full" name="UpdateSOTBLID" id="UpdateSOTBLID"><i class="fa fa-database"></i> Submit Changes </button>
        </div>
    </div>

</div>

</fieldset>
<!--End Subject Edit -->
</form>

<!--Processing Submission -->
<div class="col-lg-12 d_none"  id="EditLoading_ID">
<center class=" r_corners m_top_20">
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Payment Option </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Payment Option Successfully Updated!</h4>  
</div>
</div>
<!--End Successful ALert -->

<div class="modal-footer">
    <div class="col-lg-12">
        <center class="m_top_10">
            &copy; <?php echo ucwords(strtolower($SystemRegisteredTo)); ?>
        </center>
    </div>
</div>

<!--End Students Update Form -->
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>dist/js/jquery.validate.js"></script>
<script type="text/javascript">
    jQuery().ready(function() {
        var v = jQuery("#UpdateDepartmentFRM").validate({         
            rules: { 
                EditPaymentOptionName: {
                    required: true
                }
            }, 
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });

    // Ajax Form Submission Starts
    $("form#UpdateDepartmentFRM").submit(function(e){
    e.preventDefault(); 
        if($('#UpdateDepartmentFRM').valid()) { 
          $("#EditLoading_ID").show('fast');
          $('#UpdateDepartmentFRM').hide("fast"); 
          var formData = new FormData($(this)[0]); 
            $.ajax({
                url: 'mm-ajax-configs.php',
                type: 'POST',
                data: formData,
                async: true,
                success: function () {
                    window.setTimeout(close, 1000);
                    window.setTimeout(closemodal, 2000);
                    function close() {
                        $("#EditLoading_ID").effect('explode');  
                        $('.EditStudentUpdateSuccessful').show("fast");
                    }
                    function closemodal() {
                        $('#LoadModal').modal('hide').effect('explode');
                        $('.EditStudentUpdateSuccessful').hide("fast");
                        $('#PeopleTableContainer').jtable('load'); // This Reloads JTable
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });

</script>
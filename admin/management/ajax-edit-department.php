<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getDepartmentId")) {
    $getDepartmentId = $_REQUEST['getDepartmentId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_departments  WHERE id = '{$getDepartmentId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $get_schoolname = $gsdata['department_name'];
        $get_description = $gsdata['description'];
        $getisActive= $gsdata['isActive'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_Department")) {
    try  
        {   
            $EditDepartmentName = $common->CCStrip($_POST['EditDepartmentName']); 
            $EditDescription = $common->CCStrip($_POST['EditDescription']); 
            $DepartmentStatus =$common->CCStrip($_POST['DepartmentStatus']);
            $Update_Department =$common->CCStrip($_POST['Update_Department']);
           
            $common->Insert("UPDATE tbl_departments SET department_name = '{$EditDepartmentName}', description = '{$EditDescription}', isActive = '{$DepartmentStatus}' WHERE id = '{$Update_Department}' ");

        } catch (Exception $e){echo $e;} 
    }

?>

<style type="text/css">
    label { margin-top: 10px; }
    .help-inline-error{color:red;}
</style>

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
        <div class="col-lg-4">
            <div class="form-group">
                <label>Department Name</label>
                <input type="text" class="form-control" name="EditDepartmentName" id="EditDepartmentName" placeholder="School /Institution Name"  autocomplete="off" required value="<?php echo $get_schoolname; ?>">
                <input type="hidden" class="form-control" name="Update_Department" id="Update_Department" value="<?php echo $getDepartmentId; ?>">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label>Department Description</label>
                <input type="text" required class="form-control" id="EditDescription" name="EditDescription" placeholder="School /Institution Description" autocomplete="off" value="<?php echo $get_description; ?>">
            </div> 
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label for="DepartmentStatus"> Status</label>
            <div class="radio" style="margin-top:0px;">
              <label for="optionsRadios1">
                <input type="radio" name="DepartmentStatus" id="optionsRadios1" value="1" <?php if($getisActive == 1){ echo 'checked'; }; ?>>
                Active &nbsp;&nbsp;&nbsp;
              </label>
              <label for="optionsRadios2">
                <input type="radio" name="DepartmentStatus" id="optionsRadios2" value="0" <?php if($getisActive == 0){ echo 'checked'; }; ?>>
                In-Active
              </label>
            </div>
          </div>
        </div>
    </div><hr />
    <div class="row">
        <div class="col-lg-6">
            <button class="btn btn-success w_full cancel_edit_btn"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel Edit</button>
        </div>
        <div class="col-lg-6 ">
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Department Details</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Department Successfully Updated!</h4>  
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
                EditDepartmentName: {
                    required: true
                },
                EditDescription: {
                    required: true
                }
            }, 
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });
</script>
<script type="text/javascript">
// Ajax Form Submission Starts
$("form#UpdateDepartmentFRM").submit(function(e){
    e.preventDefault(); 
          if($('#UpdateDepartmentFRM').valid()) { 
              $("#EditLoading_ID").show('fast');
              $('#UpdateDepartmentFRM').hide("fast"); 
              var formData = new FormData($(this)[0]); 
                $.ajax({
                    url: 'ajax-edit-department.php',
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
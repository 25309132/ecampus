<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getSchoolId")) {
    $getSchoolId = $_REQUEST['getSchoolId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_schools WHERE id = '{$getSchoolId}' ");
    
    foreach ($GetPC as $gsdata) 
    {
        $get_schoolname = $gsdata['school_name'];
        $get_description = $gsdata['description'];
        $getisActive= $gsdata['isActive'];
    }

    $GetDepts = $common->GetRows("SELECT department_id FROM lookup_school_departments WHERE school_id = 2 ");

}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_School")) {
    try  
        {   
            $EditSchoolName = $common->CCStrip($_POST['EditSchoolName']); 
            $EditDescription = $common->CCStrip($_POST['EditDescription']); 
            $SchoolStatus =$common->CCStrip($_POST['SchoolStatus']);
            $Update_School =$common->CCStrip($_POST['Update_School']);
           
            $common->Insert("UPDATE tbl_schools SET school_name = '{$EditSchoolName}', description = '{$EditDescription}', isActive = '{$SchoolStatus}' WHERE id = '{$Update_School}' ");

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
<form action="" method="post" id="UpdateSchoolFRM" name="UpdateSchoolFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>School /Institution Name</label>
                <input type="text" class="form-control" name="EditSchoolName" id="EditSchoolName" placeholder="School /Institution Name"  autocomplete="off" required value="<?php echo $get_schoolname; ?>">
                <input type="hidden" class="form-control" name="Update_School" id="Update_School" value="<?php echo $getSchoolId; ?>">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label>School /Institution Description</label>
                <input type="text" required class="form-control" id="EditDescription" name="EditDescription" placeholder="School /Institution Description" autocomplete="off" value="<?php echo $get_description; ?>">
            </div> 
        </div> 
        <div class="col-lg-3">
          <div class="form-group">
            <label for="SchoolStatus"> Status</label>
            <div class="radio" style="margin-top:0px;">
              <label for="optionsRadios1">
                <input type="radio" name="SchoolStatus" id="optionsRadios1" value="1" <?php if($getisActive == 1){ echo 'checked'; }; ?>>
                Active &nbsp;&nbsp;&nbsp;
              </label>
              <label for="optionsRadios2">
                <input type="radio" name="SchoolStatus" id="optionsRadios2" value="0" <?php if($getisActive == 0){ echo 'checked'; }; ?>>
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating School/Institution Details</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> School /Institution Successfully Updated!</h4>  
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
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
<script type="text/javascript">
    jQuery().ready(function() {
        var v = jQuery("#UpdateSchoolFRM").validate({         
            rules: { 
                EditSchoolName: {
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
$("form#UpdateSchoolFRM").submit(function(e){
    e.preventDefault(); 
      if($('#UpdateSchoolFRM').valid()) { 
          $("#EditLoading_ID").show('fast');
          $('#UpdateSchoolFRM').hide("fast"); 
          var formData = new FormData($(this)[0]); 
            $.ajax({
                url: 'ajax-edit-school.php',
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
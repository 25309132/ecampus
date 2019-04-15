<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getCourseStatusId")) {
    $getCourseStatusId = $_REQUEST['getCourseStatusId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_course_status  WHERE id = '{$getCourseStatusId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $get_status_name = $gsdata['status_name'];
        $get_description = $gsdata['description'];
        $getisActive= $gsdata['isActive'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_CourseStatus")) {
    try  
        {   
            $EditCourseStatus =$common->CCStrip($_POST['EditCourseStatus']);
            $EditCourseStatusDescription =$common->CCStrip($_POST['EditCourseStatusDescription']);
            $GetIsActive =$common->CCStrip($_POST['GetIsActive']);
            $Update_CourseStatus =$common->CCStrip($_POST['Update_CourseStatus']);
           
            $common->Insert("UPDATE tbl_course_status SET status_name = '{$EditCourseStatus}', description = '{$EditCourseStatusDescription}', isActive = '{$GetIsActive}' WHERE id = '{$Update_CourseStatus}' ");

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
<form action="" method="post" id="UpdateProgrammeTypeFRM" name="UpdateProgrammeTypeFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label> Edit Course Status </label>
                <input type="text" class="form-control" name="EditCourseStatus" id="EditCourseStatus" placeholder="Edit Programme Type"  autocomplete="off" required value="<?php echo $get_status_name; ?>">
                <input type="hidden" class="form-control" name="Update_CourseStatus" id="Update_CourseStatus" value="<?php echo $getCourseStatusId; ?>">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label> Edit Description </label>
                <input type="text" class="form-control" name="EditCourseStatusDescription" id="EditCourseStatusDescription" placeholder="Edit Programme Type Description"  autocomplete="off" required value="<?php echo $get_description; ?>">
            </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label for="GetIsActive"> Status</label>
            <div class="radio" style="margin-top:0px;">
              <label for="optionsRadios1">
                <input type="radio" name="GetIsActive" id="optionsRadios1" value="1" <?php if($getisActive == 1){ echo 'checked'; }; ?>>
                Active &nbsp;&nbsp;&nbsp;
              </label>
              <label for="optionsRadios2">
                <input type="radio" name="GetIsActive" id="optionsRadios2" value="0" <?php if($getisActive == 0){ echo 'checked'; }; ?>>
                In-Active
              </label>
            </div>
          </div>
        </div>
    </div><hr />
    <div class="row">
        <div class="col-lg-6">
            <button class="btn btn-success w_full cancel_edit_btn"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel Edit </button>
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Course Status </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Course Status Type Successfully Updated!</h4>  
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
        var v = jQuery("#UpdateProgrammeTypeFRM").validate({         
            rules: { 
                EditCourseStatus: {
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
$("form#UpdateProgrammeTypeFRM").submit(function(e){
    e.preventDefault(); 
          if($('#UpdateProgrammeTypeFRM').valid()) { 
              $("#EditLoading_ID").show('fast');
              $('#UpdateProgrammeTypeFRM').hide("fast"); 
              var formData = new FormData($(this)[0]); 
                $.ajax({
                    url: 'ajax-edit-course-status.php',
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
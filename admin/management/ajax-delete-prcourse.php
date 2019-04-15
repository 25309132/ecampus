<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getProgrammeId")) {
    $getColumnId = $_REQUEST['getProgrammeId'];
    $GetPC = $common->GetRows("SELECT `a`.*, `b`.`course_name` FROM lookup_programmes_courses a LEFT JOIN tbl_courses b ON `a`.`course_id` = `b`.`id` WHERE `a`.`id` = '{$getColumnId}'"); 
    foreach ($GetPC as $gsdata) 
    {
        $get_department_name = $gsdata['course_name'];
        $get_programme_id = $gsdata['programme_id'];
        $get_course_id = $gsdata['course_id'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Delete_Course_ID")) {
    try  
        {   
            //Delete From Programme
            $Delete_ID = $common->CCStrip($_POST['Delete_ID']);
            $Delete_Course_ID = $common->CCStrip($_POST['Delete_Course_ID']);
            $Delete_Programme_ID = $common->CCStrip($_POST['Delete_Programme_ID']);
            $common->Insert("DELETE FROM lookup_programmes_courses WHERE id = '{$Delete_ID}' ");

            //Remove From Available Courses 
            $common->Insert("DELETE FROM tbl_available_courses WHERE course_id = '{$Delete_Course_ID}' AND programme_id = '{$Delete_Programme_ID}' ");


        } catch (Exception $e){echo $e;} 
    }

?>

<style type="text/css">
    label { margin-top: 10px; }
    .help-inline-error{color:red;}
    .t_aling_c {text-align: center;}
</style>

<!-- // Assign Form Variables -->
<script type="text/javascript">
    // Cancel Edit Button
    $(".cancel_edit_btn").click(function(e) {
        e.preventDefault();
        $('#LoadUpDeletePCourseModal').modal('hide'); 
    });
</script>

<!--Start Update Form -->
<form action="" method="post" id="UpdateProgrammeTypeFRM" name="UpdateProgrammeTypeFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col--12">
            <div class="form-group">
                <h4 class="t_aling_c" style="color: red; margin: 0;"> Remove <?php echo $get_department_name; ?>: This is irreversible. </h4>
                <input type="hidden" class="form-control" name="Delete_ID" id="Delete_ID" value="<?php echo $getColumnId; ?>">
                <input type="hidden" class="form-control" name="Delete_Course_ID" id="Delete_Course_ID" value="<?php echo $get_course_id; ?>">
                <input type="hidden" class="form-control" name="Delete_Programme_ID" id="Delete_Programme_ID" value="<?php echo $get_programme_id; ?>">
            </div>
        </div>
    </div><hr />
    <div class="row">
        <div class="col-lg-6">
            <button class="btn btn-success w_full cancel_edit_btn"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel </button>
        </div>
        <div class="col-lg-6 ">
            <button type="submit" class="btn btn-danger w_full" name="UpdateSOTBLID" id="UpdateSOTBLID"><i class="fa fa-database"></i> Remove Department </button>
        </div>
    </div>

</div>

</fieldset>
<!--End Subject Edit -->
</form>

<!--Processing Submission -->
<div class="col-lg-12 d_none"  id="EditLoading_ID">
<center class=" r_corners m_top_20">
    <h4 class="m_top_20 m_bottom_20">Please wait... Removing Course from list </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Course Successfully removed!</h4>  
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
// Ajax Form Submission Starts
$("form#UpdateProgrammeTypeFRM").submit(function(e){
    e.preventDefault(); 
          if($('#UpdateProgrammeTypeFRM').valid()) { 
              $("#EditLoading_ID").show('fast');
              $('#UpdateProgrammeTypeFRM').hide("fast"); 
              var formData = new FormData($(this)[0]); 
                $.ajax({
                    url: 'ajax-delete-prcourse.php',
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
                            $('#LoadUpDeletePCourseModal').modal('hide').effect('explode');
                            $('.EditStudentUpdateSuccessful').hide("fast");
                            $('#PPNVitalsJTable').jtable('load'); // This Reloads JTable
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
});
</script>
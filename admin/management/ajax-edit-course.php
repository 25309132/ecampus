<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve course status
if(filter_has_var(INPUT_GET, "getCourseId")) {
    $getCourseId = $_REQUEST['getCourseId'];
    $GetPC = $common->GetRows("SELECT c.*, `s`.`status_name` FROM tbl_courses c LEFT JOIN tbl_course_status s ON `s`.`id` = `c`.`course_status` WHERE `c`.`id` = '{$getCourseId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $get_course_name = $gsdata['course_name'];
        $get_course_code = $gsdata['course_code'];
        $get_course_price = $gsdata['course_price'];
        $get_description = $gsdata['course_description'];
        $get_course_status = $gsdata['course_status'];
        $get_course_status_name = $gsdata['status_name'];
        $get_course_prerequisite = $gsdata['course_prerequisite'];
        $getisActive= $gsdata['isActive'];
    }

    $GetPC2 = $common->GetRows("SELECT * FROM tbl_courses WHERE id = '{$get_course_prerequisite}' ");
    foreach ($GetPC2 as $gsdata2) 
    {
        $get_course_prerequisite_name = $gsdata2['course_name'];
    }
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
<form action="" method="post" id="UpdateCourseTypeFRM" name="UpdateCourseTypeFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label> Edit Course Name </label>
                <input type="text" class="form-control" name="EditCourseName" id="EditCourseName" placeholder="Edit Course Name"  autocomplete="off" required value="<?php echo $get_course_name; ?>">
                <input type="hidden" class="form-control" name="Update_Course" id="Update_Course" value="<?php echo $getCourseId; ?>">
                <input type="hidden" class="form-control" name="ItemId2" id="ItemId2">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label> Code </label>
                <input type="text" class="form-control" name="EditCourseCode" id="EditCourseCode" placeholder="Edit Course Code"  autocomplete="off" required value="<?php echo $get_course_code; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label> Price </label>
                <input type="text" class="form-control" name="EditCoursePrice" id="EditCoursePrice" placeholder="Edit Course Price"  autocomplete="off" required value="<?php echo $get_course_price; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <label> Course Status </label>
            <select class="form-control select2" name="CourseStatusId" id="CourseStatusId" style="width: 100%; border-radius: 0; height:36px;">
                <option value="<?php echo $get_course_status; ?>"><?php echo $get_course_status_name; ?></option>
                <?php
                foreach ($common->GetRows("SELECT * FROM tbl_course_status WHERE isActive = 1") as $A) {
                    ?>
                    <option value="<?php echo $A["id"]; ?>"><?php echo $A["status_name"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label> Course Pre-Requisite </label>
            <input type="text" id="PreRequisite" name="PreRequisite" class="form-control item-name" value="<?php echo $get_course_prerequisite_name; ?>" autocomplete="OFF">
        </div>
        <div class="col-md-4">
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Course Type </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Course Type Successfully Updated!</h4>  
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
        var v = jQuery("#UpdateCourseTypeFRM").validate({         
            rules: { 
                EditCourseType: {
                    required: true
                }
            }, 
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $(function () {
            $(".select2").select2();
        });
    });
</script>
<script type="text/javascript">
// Ajax Form Submission Starts
$("form#UpdateCourseTypeFRM").submit(function(e){
    e.preventDefault(); 
        if($('#UpdateCourseTypeFRM').valid()) { 
            $("#EditLoading_ID").show('fast');
            $('#UpdateCourseTypeFRM').hide("fast"); 
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
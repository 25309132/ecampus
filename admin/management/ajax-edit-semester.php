<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getSemesterId")) {
    $getSemesterId = $_REQUEST['getSemesterId'];
    $GetPC = $common->GetRows("SELECT `s`.*, `y`.`year` FROM tbl_semesters s INNER JOIN  tbl_academic_years y ON `y`.`id` = `s`.`year_id` WHERE `s`.`id` = '{$getSemesterId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $getYearName = $gsdata['year'];
        $getYearId = $gsdata['year_id'];
        $getSemesterName = $gsdata['semester'];
        $getDescription = $gsdata['description'];
        $getStartDate = $gsdata['start_date'];
        $getEndDate = $gsdata['end_date'];
        $getisActive= $gsdata['isActive'];
        $getisCurrent = $gsdata['isCurrent'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_Semester")) {
    try  
        {   
            $EditSemester =$common->CCStrip($_POST['EditSemester']);
            $EditDescription =$common->CCStrip($_POST['EditDescription']);
            $EditStartDate =$common->CCStrip($_POST['EditStartDate']);
            $EditEndDate =$common->CCStrip($_POST['EditEndDate']);
            $GetIsActive =$common->CCStrip($_POST['GetIsActive']);
            $EditAcademicYear =$common->CCStrip($_POST['EditAcademicYear']);
            $GetIsCurrent =$common->CCStrip($_POST['GetIsCurrent']);
            $Update_Semester =$common->CCStrip($_POST['Update_Semester']);
           
            $common->Insert("UPDATE tbl_semesters SET semester = '{$EditSemester}', description = '{$EditDescription}', start_date = '{$EditStartDate}', end_date = '{$EditEndDate}', year_id = '{$EditAcademicYear}', isActive = '{$GetIsActive}', isCurrent = '{$GetIsCurrent}' WHERE id = '{$Update_Semester}' ");

        } catch (Exception $e){echo $e;} 
    }

?>

<style type="text/css">
    label { margin-top: 10px; }
    .help-inline-error{color:red;}
    .datepickerEdit{z-index:1151 !important;}
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
<form action="" method="post" id="UpdateSemesterFRM" name="UpdateSemesterFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Edit Semester</label>
                <input type="text" class="form-control" name="EditSemester" id="EditSemester" placeholder="Edit Semester"  autocomplete="off" value="<?php echo $getSemesterName; ?>">
                <input type="hidden" class="form-control" name="Update_Semester" id="Update_Semester" value="<?php echo $getSemesterId; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <label>Edit Academic Year</label>
            <select class="form-control select2" name="EditAcademicYear" id="EditAcademicYear" style="width: 100%; border-radius: 0; height:36px;">
                <option value="<?php echo $getYearId; ?>"><?php echo $getYearName; ?></option>
                <?php
                foreach ($common->GetRows("SELECT * FROM tbl_academic_years WHERE isActive = 1") as $A) {
                    ?>
                    <option value="<?php echo $A["id"]; ?>"><?php echo $A["year"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Edit Semester Description</label>
                <input type="text" class="form-control" name="EditDescription" id="EditDescription" placeholder="Edit Semester Description"  autocomplete="off" value="<?php echo $getDescription; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div id="end_date" class="col-lg-3">
            <label> Edit Start Date:</label>
            <div class="input-group bootstrap-timepicker">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control datepickerEdit" id="EditStartDate" name="EditStartDate" value="<?php echo $getStartDate; ?>" autocomplete="off">
            </div>
        </div>
        <div id="end_date" class="col-lg-3">
            <label> Edit End Date:</label>
            <div class="input-group bootstrap-timepicker">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control datepickerEdit" id="EditEndDate" name="EditEndDate" value="<?php echo $getEndDate; ?>" autocomplete="off">
            </div>
        </div> 
        <div class="col-lg-3">
          <div class="form-group">
            <label for="GetIsActive"> Edit Status</label>
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
        <div class="col-lg-3">
          <div class="form-group">
            <label for="GetIsCurrent"> Is Current </label>
            <div class="radio" style="margin-top:0px;">
              <label for="optionsRadios1">
                <input type="radio" name="GetIsCurrent" id="optionsRadios1" value="1" <?php if($getisCurrent == 1){ echo 'checked'; }; ?>>
                Active &nbsp;&nbsp;&nbsp;
              </label>
              <label for="optionsRadios2">
                <input type="radio" name="GetIsCurrent" id="optionsRadios2" value="0" <?php if($getisCurrent == 0){ echo 'checked'; }; ?>>
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Semester Details</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Semester Successfully Updated!</h4>  
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
        var v = jQuery("#UpdateSemesterFRM").validate({         
            rules: { 
                EditAcademicYear: {
                    required: true
                },
                EditStartDate: {
                    required: true
                },
                EditEndDate: {
                    required: true
                }
            }, 
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $(function () {
            $(".select2").select2();
        });

        var dateToday = new Date();
        $( ".datepickerEdit" ).datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: "yy-mm-dd",
          minDate: dateToday
        });

    });
</script>
<script type="text/javascript">
// Ajax Form Submission Starts
$("form#UpdateSemesterFRM").submit(function(e){
    e.preventDefault(); 
          if($('#UpdateSemesterFRM').valid()) { 
              $("#EditLoading_ID").show('fast');
              $('#UpdateSemesterFRM').hide("fast"); 
              var formData = new FormData($(this)[0]); 
                $.ajax({
                    url: 'ajax-edit-semester.php',
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
<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getCenterId")) {
    $getCenterId = $_REQUEST['getCenterId'];
    $GetPC = $common->GetRows("SELECT `e`.*, `s`.`semester` FROM tbl_exam_centers e INNER JOIN tbl_semesters s ON s.id = `e`.`current_semester_id` WHERE `e`.`id` = '{$getCenterId}' ");
    
    foreach ($GetPC as $gsdata) 
    {
        $get_center_name = $gsdata['center_name'];
        $get_center_address = $gsdata['center_address'];
        $get_center_location = $gsdata['center_location'];
        $get_center_contacts = $gsdata['center_contacts'];
        $get_center_description = $gsdata['center_description'];
        $get_Semester = $gsdata['current_semester_id'];
        $get_Semester_Name = $gsdata['semester'];
        $getisActive= $gsdata['isActive'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_Exam_Center")) {
    try  
        {   //EditExamCenterName EditCenterDescription EditCenterLocation EditCenterAddress EditExamCenterContacts
            $EditExamCenterName = $common->CCStrip($_POST['EditExamCenterName']); 
            $EditCenterDescription = $common->CCStrip($_POST['EditCenterDescription']); 
            $EditCenterLocation =$common->CCStrip($_POST['EditCenterLocation']);
            $EditCenterAddress =$common->CCStrip($_POST['EditCenterAddress']);
            $SchoolStatus =$common->CCStrip($_POST['SchoolStatus']);
            $EditExamCenterContacts =$common->CCStrip($_POST['EditExamCenterContacts']);
            $Update_Exam_Center =$common->CCStrip($_POST['Update_Exam_Center']);
            $EditSemesterID =$common->CCStrip($_POST['EditSemesterID']);
           
            $common->Insert("UPDATE tbl_exam_centers SET center_name = '{$EditExamCenterName}', center_description = '{$EditCenterDescription}', center_address = '{$EditCenterAddress}', center_location = '{$EditCenterLocation}', center_contacts = '{$EditExamCenterContacts}', isActive = '{$SchoolStatus}', current_semester_id = '{$EditSemesterID}' WHERE id = '{$Update_Exam_Center}' ");

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
        <div class="col-md-3">
            <label> Exam Center Name </label>
            <input type="text" class="form-control" name="EditExamCenterName" id="EditExamCenterName" placeholder="School /Institution Name"  autocomplete="off" required value="<?php echo $get_center_name; ?>">
            <input type="hidden" class="form-control" name="Update_Exam_Center" id="Update_Exam_Center" value="<?php echo $getCenterId; ?>">
        </div>
        <div class="col-md-3">
            <label> Description</label>
            <input type="text" required class="form-control" id="EditCenterDescription" name="EditCenterDescription" placeholder="School /Institution Description" autocomplete="off" value="<?php echo $get_center_description; ?>">
        </div>
        <div class="col-md-3">
            <label> Address </label>
            <input type="text" class="form-control" name="EditCenterAddress" id="EditCenterAddress" placeholder="Exam Center Address" value="<?php echo $get_center_address; ?>" autocomplete="off" />
        </div>
        <div class="col-md-3">
            <label> Location </label>
            <input type="text" class="form-control" name="EditCenterLocation" id="EditCenterLocation" placeholder="Exam Center Location" value="<?php echo $get_center_location; ?>" autocomplete="off" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label> Contacts </label>
            <input type="text" required class="form-control" id="EditExamCenterContacts" name="EditExamCenterContacts" placeholder="Campus Description" value="<?php echo $get_center_contacts; ?>" autocomplete="off" />
        </div>
        <div class="col-md-3">
            <label> Select Semester </label>
            <select class="form-control select2" name="EditSemesterID" id="EditSemesterID" style="width: 100%; border-radius: 0; height:36px;">
                <option value="" selected> <?php echo $get_Semester_Name; ?> </option>
                <?php
                foreach ($common->GetRows("SELECT `s`.*, `y`.`year` FROM tbl_semesters s JOIN tbl_academic_years y ON `y`.`id` = `s`.`year_id` WHERE `s`.`isActive` = 1 AND `s`.`isCurrent` = 1") as $A) {
                    ?>
                    <option value="<?php echo $A["id"]; ?>"><?php echo $A["year"].' - '.$A["semester"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="SchoolStatus"> Status </label>
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Exam Center Details</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Exam Center Successfully Updated!</h4>  
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
            rules: { //EditExamCenterName EditCenterDescription EditCenterLocation EditCenterAddress EditExamCenterContacts
                EditExamCenterName: {
                    required: true
                },
                EditCenterLocation: {
                    required: true
                },
                EditCenterAddress: {
                    required: true   
                },
                EditExamCenterContacts: {
                    required: true 
                },
                EditSemesterID: {
                    required: true
                }
            }, 
            errorElement: "span",
            errorClass: "help-inline-error",
        });
    });

    $("form#UpdateSchoolFRM").submit(function(e){
        e.preventDefault(); 
        if($('#UpdateSchoolFRM').valid()) { 
          $("#EditLoading_ID").show('fast');
          $('#UpdateSchoolFRM').hide("fast"); 
          var formData = new FormData($(this)[0]); 
            $.ajax({
                url: 'ajax-edit-exam-centers',
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
    
    $(function () {
        $(".select2").select2();
    });
</script>
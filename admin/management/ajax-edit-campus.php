<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getCampusId")) {
    $getCampusId = $_REQUEST['getCampusId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_campuses `c` WHERE `c`.`id` = '{$getCampusId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $get_campusname = $gsdata['campus_name'];
        $get_schoolname = $gsdata['school_name'];
        $get_description = $gsdata['description'];
        $getisActive= $gsdata['isActive'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_Campus")) {
    try  
        {   
            $EditCampusName = $common->CCStrip($_POST['EditCampusName']); 
            $EditDescription = $common->CCStrip($_POST['EditDescription']); 
            $SchoolStatus =$common->CCStrip($_POST['SchoolStatus']);
            $Update_Campus =$common->CCStrip($_POST['Update_Campus']);
           
            $common->Insert("UPDATE tbl_campuses SET campus_name = '{$EditCampusName}', description = '{$EditDescription}', isActive = '{$SchoolStatus}' WHERE id = '{$Update_Campus}' ");

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
        <div class="col-lg-3">
            <div class="form-group">
                <label>Campus Name</label>
                <input type="text" class="form-control" name="EditCampusName" id="EditCampusName" placeholder="School /Institution Name"  autocomplete="off" required value="<?php echo $get_campusname; ?>">
                <input type="hidden" class="form-control" name="Update_Campus" id="Update_Campus" value="<?php echo $getCampusId; ?>">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group">
                <label>Campus Description</label>
                <input type="text" required class="form-control" id="EditDescription" name="EditDescription" placeholder="School /Institution Description" autocomplete="off" value="<?php echo $get_description; ?>">
            </div> 
        </div>
        <div class="col-lg-4">
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
            <button type="submit" class="btn btn-danger w_full" name="UpdateSOTBLID" id="UpdateSOTBLID"><i class="fa fa-database"></i> Submit Changes</button>
        </div>
    </div>

</div>

</fieldset>
<!--End Subject Edit -->
</form>

<!--Processing Submission -->
<div class="col-lg-12 d_none"  id="EditLoading_ID">
<center class=" r_corners m_top_20">
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Campus Details</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Campus Successfully Updated!</h4>  
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
        var v = jQuery("#UpdateSchoolFRM").validate({         
            rules: {  //EditSchoolId EditCampusName EditDescription
                EditCampusName: {
                    required: true
                },
                EditSchoolId: {
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
    $(function () {
        $(".select2").select2();
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
                    url: 'ajax-edit-campus.php',
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
<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getProgrammeId")) {
    $getProgrammeId = $_REQUEST['getProgrammeId'];
    $GetPC = $common->GetRows("SELECT p.*, `f`.`facilitator_name` FROM tbl_programmes p LEFT JOIN tbl_programme_facilitators f ON `f`.`id` = `p`.`contact_person_id` WHERE `p`.`id` = '{$getProgrammeId}' "); 
    foreach ($GetPC as $gsdata) 
    {
        $get_programmetype = $gsdata['type_id'];
        $get_description = $gsdata['description'];
        $programme_name = $gsdata['programme_name'];
        $programme_code = $gsdata['programme_code'];
        $fee_per_module = $gsdata['fee_per_module'];
        $contact_person_id = $gsdata['contact_person_id'];
        $facilitator_name = $gsdata['facilitator_name'];
        $getisActive= $gsdata['isActive'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_Programme")) {
    try  
        {   //EditProgrammeName Update_Programme EditProgrammeCode EditProgrammeDescription EditFeePerModule contact_person_id
            $EditProgrammeName =$common->CCStrip($_POST['EditProgrammeName']);
            $EditProgrammeCode =$common->CCStrip($_POST['EditProgrammeCode']);
            $EditFeePerModule =$common->CCStrip($_POST['EditFeePerModule']);
            $contact_person_id =$common->CCStrip($_POST['contact_person_id']);
            $type_id =$common->CCStrip($_POST['type_id']);
            $EditProgrammeDescription =$common->CCStrip($_POST['EditProgrammeDescription']);
            $GetIsActive =$common->CCStrip($_POST['GetIsActive']);
            $UpdateID =$common->CCStrip($_POST['Update_Programme']);
           
           $common->Insert("UPDATE tbl_programmes SET programme_name = '{$EditProgrammeName}',  programme_code = '{$EditProgrammeCode}', fee_per_module = '{$EditFeePerModule}', type_id = '{$type_id}', description = '{$EditProgrammeDescription}', contact_person_id = '{$contact_person_id}', isActive = '{$GetIsActive}' WHERE id = '{$UpdateID}' ");


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
                <label> Programme Name</label>
                <input type="text" class="form-control" name="EditProgrammeName" id="EditProgrammeName" placeholder="Edit Programme Name"  autocomplete="off" required value="<?php echo $programme_name; ?>">
                <input type="hidden" class="form-control" name="Update_Programme" id="Update_Programme" value="<?php echo $getProgrammeId; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label> Code</label>
                <input type="text" class="form-control" name="EditProgrammeCode" id="EditProgrammeCode" placeholder="Edit Programme Code"  autocomplete="off" required value="<?php echo $programme_code; ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Edit Description</label>
                <input type="text" class="form-control" name="EditProgrammeDescription" id="EditProgrammeDescription" placeholder="Edit Description"  autocomplete="off" required value="<?php echo $get_description; ?>">
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-4">
            <div class="form-group">
                <label> Fee Per Module</label>
                <input type="text" class="form-control" name="EditFeePerModule" id="EditFeePerModule" placeholder="Edit Fee Per Module"  autocomplete="off" required value="<?php echo $fee_per_module; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <label> Contact Person </label>
            <select class="form-control select2" name="contact_person_id" id="contact_person_id" style="width: 100%; border-radius: 0; height:36px;">
                <option selected value="<?php echo $contact_person_id; ?>"> <?php echo $facilitator_name; ?> </option>
                <?php
                foreach ($common->GetRows("SELECT * FROM tbl_programme_facilitators WHERE isActive = 1") as $A) {
                    ?>
                    <option value="<?php echo $A["id"]; ?>"><?php echo $A["facilitator_name"]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-4">
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Programme </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Programme Successfully Updated!</h4>  
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
                EditProgrammeName: { //EditProgrammeName Update_Programme EditProgrammeCode EditProgrammeDescription EditFeePerModule contact_person_id
                    required: true
                },
                EditProgrammeCode: {
                    required: true
                },
                EditFeePerModule: {
                    required: true
                },
                contact_person_id: {
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
                        url: 'ajax-edit-programmes.php',
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
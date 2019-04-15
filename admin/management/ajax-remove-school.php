<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getSchoolId"))
{
    $getSchoolId = $_REQUEST['getSchoolId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_schools WHERE id = '{$getSchoolId}' ");
    
    foreach ($GetPC as $gsdata) 
    {
        $get_schoolname = $gsdata['school_name'];
        $get_description = $gsdata['description'];
    }

}

// Update School Details 
if(filter_has_var(INPUT_POST, "Update_School")) {
    try  
        {   
            $Update_School =$common->CCStrip($_POST['Update_School']);
            $common->Insert("DELETE FROM lookup_shool_programmes WHERE school_id = '{$Update_School}' ");

        } catch (Exception $e){echo $e;} 
    }
?>

<!-- // Assign Form Variables -->
<script type="text/javascript">
    // Cancel Edit Button
    $(".cancel_edit_btn").click(function(e) {
        e.preventDefault();
        $('#LoadUpDeleteModal').modal('hide'); 
    });
</script>

<!--Start Update Form -->
<form action="" method="post" id="UpdateSchoolFRM" name="UpdateSchoolFRM">

    <fieldset>

        <div class="box-body">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="Update_School" id="Update_School" value="<?php echo $getSchoolId; ?>">
                        <h4 class="t_align_c"> Delete <?php echo $get_schoolname ; ?> From Programmes offered? </h4>
                    </div>
                </div>
            </div><hr />

            <div class="row">
                <div class="col-lg-6">
                    <button class="btn btn-success w_full cancel_edit_btn"><i class="fa fa-close" data-dismiss="modal"></i> Cancel </button>
                </div>
                <div class="col-lg-6 ">
                    <button type="submit" class="btn btn-danger w_full" name="UpdateSOTBLID" id="UpdateSOTBLID"><i class="fa fa-trash"></i> Delete </button>
                </div>
            </div>

        </div>

    </fieldset>

</form>

<!--Processing Submission -->
<div class="col-lg-12 d_none"  id="EditLoading_ID">
<center class=" r_corners m_top_20">
    <h4 class="m_top_20 m_bottom_20">Please wait... Submitting your request</h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> School / Institution Successfully Deleted!</h4>  
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

<script type="text/javascript">
// Ajax Form Submission Starts
$("form#UpdateSchoolFRM").submit(function(e){
    e.preventDefault(); 
      if($('#UpdateSchoolFRM').valid()) { 
          $("#EditLoading_ID").show('fast');
          $('#UpdateSchoolFRM').hide("fast"); 
          var formData = new FormData($(this)[0]); 
            $.ajax({
                url: 'ajax-remove-school.php',
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
                        $('#LoadUpDeleteModal').modal('hide').effect('explode');
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
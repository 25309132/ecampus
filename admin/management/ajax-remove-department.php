<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

// Retrieve Member Zones Data
if(filter_has_var(INPUT_GET, "getColumnId")) {
    $getColumnId = $_REQUEST['getColumnId'];
    $GetPC = $common->GetRows("SELECT `b`.`department_name` FROM lookup_school_departments a LEFT JOIN tbl_departments b ON `a`.`department_id` = `b`.`id` WHERE `a`.`id` = '{$getColumnId}'"); 
    foreach ($GetPC as $gsdata) 
    {
        $get_department_name = $gsdata['department_name'];
    }
}

// Update School Details 
if(filter_has_var(INPUT_POST, "Delete_Department_ID")) {
    try  
        {   
            $Delete_Department_ID =$common->CCStrip($_POST['Delete_Department_ID']);
            $common->Insert("DELETE FROM lookup_school_departments WHERE id = '{$Delete_Department_ID}' ");

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
        $('#LoadUpDeleteModal').modal('hide'); 
    });
</script>

<!--Start Update Form -->
<form action="" method="post" id="UpdateProgrammeTypeFRM" name="UpdateProgrammeTypeFRM"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <h3 class="t_aling_c" style="color: red;">Remove <?php echo $get_department_name; ?>?</h4>
                <input type="hidden" class="form-control" name="Delete_Department_ID" id="Delete_Department_ID" value="<?php echo $getColumnId; ?>">
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
    <h4 class="m_top_20 m_bottom_20">Please wait... Removing Department from list </h4>
    <img src="../img/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->

<!--Alert Successful -->
<div class="col-lg-12 EditStudentUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> Department Successfully removed!</h4>  
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
                EditProgrammeType: {
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
                    url: 'ajax-remove-department.php',
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
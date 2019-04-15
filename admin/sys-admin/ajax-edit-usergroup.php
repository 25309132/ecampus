<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

//Update   Bank_Name Update_UGroup Bank_Swift editCountryName
if(filter_has_var(INPUT_POST, "Update_UGroup")) {
  try {       
        $EName = $common->CCStrip(ucwords($_POST['GName']));
        $EDesctiption = $common->CCStrip($_POST['GDescription']);
        $Update_ID = $common->CCStrip($_POST['Update_UGroup']);
        $StatusActive = $common->CCStrip($_POST['EditTModeStatus']);
        
        $common->Insert("UPDATE tbl_usergroups SET usergroup_name = '{$EName}', description = '{$EDesctiption}', isActive = '{$StatusActive}' WHERE usergroup_id = '{$Update_ID}'");

        $SuccessfulRegistration = 1;
      }

    catch (Exception $e) {echo $e;}
}
//Get ID
if(filter_has_var(INPUT_GET, "getUgroupId")) {
    $getUgroupId = $_REQUEST['getUgroupId'];
    $GetPC = $common->GetRows("SELECT * FROM tbl_usergroups WHERE usergroup_id = '{$getUgroupId}'"); 
    foreach ($GetPC as $gsdata) {
             $Name = $gsdata['usergroup_name'];
             $Description = $gsdata['description'];
             $getisActive = $gsdata['isActive'];   
    }
?>
<head>
  <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>plugins/select2/select2.min.css">
</head>
<!-- // Assign Form Variables -->
<script type="text/javascript">
    $(".bccancel_edit_btn").click(function(e) {
        e.preventDefault();
        $('#LoadUpModal').modal('hide'); 
    });
</script>
<!--Start Students Update Form -->
<form action="" method="post" id="Update_UGroup_Details" name="Update_UGroup_Details"> 
<!--Start Subject Edit -->
<fieldset>
<div class="box-body">
  <div class="row">
    <!--Start Book Categories -->
      <div class="col-lg-4">
        <label>Group Name</label> 
        <input type="text" class="form-control" name="GName" id="GName" value="<?php echo $Name; ?>" required />
        <input type="hidden" class="form-control" name="Update_UGroup" id="Update_UGroup" value="<?php echo $getUgroupId; ?>" />
      </div>
      <div class="col-lg-5">
        <label>Description</label> 
        <input type="text" class="form-control" name="GDescription" id="GDescription" value="<?php echo $Description; ?>" required />
      </div>
      <div class="col-lg-3">
      <div class="form-group">
        <label for="EditTModeStatus">Status</label>
        <div class="radio" style="margin-top:0px;">
          <label for="optionsRadios1">
            <input type="radio" name="EditTModeStatus" id="optionsRadios1" value="1" <?php if($getisActive == 1){ echo 'checked'; }; ?>> Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </label>
          <label for="optionsRadios2">
            <input type="radio" name="EditTModeStatus" id="optionsRadios2" value="0" <?php if($getisActive == 0){ echo 'checked'; }; ?>> In-Active
          </label>
        </div>
      </div>
    </div>
  </div><hr />
  <div class="row">
    <div class="col-lg-6">
      <button class="btn btn-success w_full bccancel_edit_btn"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel Edit User Group</button>
    </div>
    <div class="col-lg-6 ">
      <button type="submit" class="btn btn-danger w_full" name="updateplan" id="updateplan"><i class="fa fa-database"></i> Submit Edit User Group Changes</button>
    </div>
  </div>
</div>
</fieldset>
<!--End Subject Edit -->
</form> 
<!--Processing Submission -->
<div class="col-lg-12 d_none"  id="BCEditLoading_ID">
<center class=" r_corners m_top_20">
  <h4 class="m_top_20 m_bottom_20">Please wait... Updating Details</h4>
  <img src="images/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->
<!--Alert Successful -->
<div class="col-lg-12 BCEditUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-database"></i> User Group Details Successfully Updated!</h4>  
</div>
</div>
<!--End Successful ALert -->
<div class="modal-footer">
  <div class="col-lg-12">
      <center class="m_top_10">
          &copy; <?php echo ucwords(strtolower($SystemName)); ?>
      </center>
  </div>
</div>
<!--End Students Update Form -->
<script src="<?php echo ASSETS_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>dist/js/app.min.js"></script> 
<script type="text/javascript" src="jquery.validate.js"></script>
<script src="<?php echo ASSETS_URL; ?>plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  jQuery().ready(function() { // Bank_Name Update_UGroup Bank_Swift editCountryName
    var v = jQuery("#Update_UGroup_Details").validate({              
      rules: {
        GName: {
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
$("form#Update_UGroup_Details").submit(function(e){
  e.preventDefault(); 
    if($('#Update_UGroup_Details').valid())  { 
        $("#BCEditLoading_ID").show('fast');
        $('#Update_UGroup_Details').hide("fast"); 
        var formData = new FormData($(this)[0]); 
          $.ajax({
              url: 'ajax-edit-usergroup.php',
              type: 'POST',
              data: formData,
              async: true,
              success: function () {
                  window.setTimeout(close, 2000);
                  window.setTimeout(closemodal, 3000);
                  function close() {
                      $("#BCEditLoading_ID").effect('explode');  
                      $('.BCEditUpdateSuccessful').show("fast");
                  }
                  function closemodal() {
                      $('#LoadUpModal').modal('hide').effect('explode');
                      $('.BCEditUpdateSuccessful').hide("fast");
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
<?php } ?>
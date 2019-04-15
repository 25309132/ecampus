<?php
include_once('../sys/core/init.inc.php');
$common=new common();
if($_POST['rowid']) 
  {
    $id = $_POST['rowid'];
    $GetAgentData = $common->GetRows("SELECT * FROM tbl_sys_modules WHERE id = '{$id}'") ;
    foreach($GetAgentData AS $InfoSc)
        {
          $id = $InfoSc['id'];
          $name = $InfoSc['sys_name'];
          $sysurl = $InfoSc['url'];
          $sys_icon = $InfoSc['sys_icon']; 
          $sys_info = $InfoSc['sys_info'];
          $background = $InfoSc['sys_color']; 
          $group_access = $InfoSc['group_access']; 
          $getisActive = $InfoSc['isActive']; 
		  
?>
<head>
   <?php include_once('../inc/inc.meta.php'); ?>
</head>
<form class="contact-form cf-style-1 m_top_20 m_bottom_40" name="Edit_Plot_Form" id="Edit_Plot_Form" method="POST" action="" enctype="multipart/form-data" action="">
  <div class="box-body" id="Final_FormID">
    <fieldset>
      <!--Plot Details Start -->
      <div class="box-body">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label>System Name</label>
              <input type="hidden" class="form-control" name="AccessLevelID" id="AccessLevelID" value="<?php echo $id; ?>">
              <input type="text" class="form-control" name="nameEdit" id="nameEdit" value="<?php echo $name; ?>" autocomplete="OFF">    
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>System Icon</label>
              <input type="text" class="form-control" name="SystemIconEdit" id="SystemIconEdit" value="<?php echo $sys_icon; ?>" placeholder="System Icon"  autocomplete="off">
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
  					<div class="form-group">
  						<label for="phoneno">Assigned To</label>
  						<input name="menu_group_access"  id="menu_group_access" class="form-control"  placeholder="Enter one or multiple User Groups" >
  		       <input type="hidden" name="menu_group_accessE[]"  id="menu_group_accessE" value="<?php echo $group_access;?>" class="form-control"  placeholder="Phone Number" >
					  </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>System URL</label>
              <input type="text" class="form-control" name="SystemURLEdit" id="SystemURLEdit" value="<?php echo $sysurl; ?>" placeholder="System URL"  autocomplete="off">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 d_none">
            <div class="form-group">
              <label>Background Color</label>
              <input type="text" class="form-control" name="backgroundEdit" id="backgroundEdit" value="<?php echo $background; ?>" placeholder="Background"  autocomplete="off">
            </div> 
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
          <div class="col-lg-9">
            <button type="submit" class="btn w_full btn-info btn-lg" name="submit" style="float:center; margin-right: 2.6%; margin-top: 34px;"><span class="glyphicon glyphicon-check"></span>Update System Access Details</button>
			    </div>
        </div>
      </div>
    </fieldset>
  </div>
</form>
  <center  id="Edit_Loading_ID" class="d_none">
    <h4 class="m_top_20 m_bottom_20">Please wait... Updating Access Level Information </h4>
    <img src="../img/loading-bar.gif" alt="Loading" style="max-width:160px;" />
  </center>
<?php
  }
} ?>
<script src="<?php echo ASSETS_URL; ?>/plugins/magicsuggest/magicsuggest.js"></script> 
<script src="<?php echo ASSETS_URL; ?>/dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/dist/dependent-dropdown.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
  jQuery().ready(function() { 
    var v = jQuery("#Edit_Plot_Form").validate({
      rules: {
        nameEdit: {
            required: true
        },
        backgroundEdit: {
            required: true
        }
      },
      errorElement: "span", 
      errorClass: "help-inline-error", 
    });

  });

</script>
<!--Update Sales Agent Information -->
<script type="text/javascript">

jQuery(document).ready(function() {
$("form#Edit_Plot_Form").submit(function(e){
e.preventDefault(); 

var id = $("#nameEdit").val();
var backgroundEdit = $("#backgroundEdit").val();

if(id === ''  || backgroundEdit === '' )
  {

  }
else
  {
    $("#Edit_Loading_ID").show('fast'); 
    $('#Edit_Plot_Form').hide("fast");
    var SAID = $('#AccessLevelID').val();
    var formData = new FormData($(this)[0]); 
      $.ajax({
          url: 'action.systemsaccess?AccessLevelID='+SAID,
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
              window.setTimeout(close, 1000);
              window.setTimeout(showhome, 1000);
              function close() {
                $('#Edit_Plot_Form').show("fast");
                $("#Edit_sf1").show("slow");
                $("#Edit_sf2").hide("slow");
                $("#Edit_Loading_ID").hide('fast'); 
              }
              function showhome() {
                window.location.href = 'systems-access';
              }
          },
          cache: false,
          contentType: false,
          processData: false
      });

  }// End Else
  return false;
});

});
</script>
<script src="<?php echo ASSETS_URL; ?>plugins/magicsuggest/magicsuggest.js"></script>
<script src="../js/dependent-dropdown.js" type="text/javascript"></script>
<script>
	 var sp=$('#menu_group_accessE').val().split(',');
    //magic select 
    var ms=$('#menu_group_access').magicSuggest({
    placeholder: 'Enter one or multiple User Groups',
		data: 'action.systemsaccess.php?UserGroups=1',
		valueField: 'usergroup_id',
		displayField: 'usergroup_name',
      dataUrlParams: {
           init: true,
           query: sp
       }
      });
      $(ms).on('load', function () {
           if (this._dataSet === undefined) {
               this._dataSet = true;
               ms.setValue( sp );
               ms.setDataUrlParams({});
           }
      });
</script>
<!-- End Sales Agent Information Update -->
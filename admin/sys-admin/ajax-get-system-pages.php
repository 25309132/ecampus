<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

// Retrieve SQL Data
if($_POST['rowid']) {
    $postedid = $_POST['rowid'];
    $GetPCbcd = $common->GetRows("SELECT `us`.`id`, `us`.`par_id`, `us`.name `pagename`,  `us`.url,  `us`.`group_access`,  `us`.isActive,  `us`.m_active, `sm`.`name` `module_name`, `ss`.`sys_name`, `sm`.`id` `moduleid`, `ss`.`id` `systemid` FROM tbl_modules_pages_access `us` LEFT JOIN tbl_sys_module_child `sm` ON `sm`.`id` = `us`.`par_id` LEFT JOIN tbl_sys_modules `ss` ON `ss`.`id` = `sm`.`par_id` WHERE `us`.`id` = '{$postedid}'"); 
      foreach ($GetPCbcd as $InfoSc) 
        {
            $getid = $InfoSc['pageid'];
            $SystemID = $InfoSc['systemid']; 
            $SystemName = $InfoSc['sys_name']; 
            $ModuleID = $InfoSc['moduleid'];
            $ModuleName = $InfoSc['module_name'];
            $PageName = $InfoSc['pagename'];
            $PageURL = $InfoSc['url'];
            $UniqueID = $InfoSc['m_active'];
            $group_access = $InfoSc['group_access'];
            $getisActive = $InfoSc['isActive'];
        }
  }
?>
<form action="" method="post" id="Edit_System_Menu" name="Edit_System_Menu" >
  <fieldset>
    <div class="box-body">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
         <label> Choose System</label>
         <select class="form-control select2" id="ESystem_Name" name="ESystem_Name" style="width: 100%;" required >
          <option value="<?php echo $SystemID; ?>" selected><?php echo $SystemName; ?></option>
          <?php $UDSTT = $common->GetRows("SELECT id, sys_name FROM `tbl_sys_modules`;");
          foreach($UDSTT as $UDSsTT) { ?>
            <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['sys_name']; ?></option>
          <?php  } ?>
          </select>
        </div>                            
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label> System Module</label>
          <select class="form-control select2" id="ESystemModule" name="ESystemModule" style="width: 100%;" required>
            <option value="<?php echo $ModuleID; ?>" selected><?php echo $ModuleName; ?></option>
          </select>
        </div>                           
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label> Page Name</label>
          <input type="text" class="form-control" name="EditPageName" id="EditPageName" placeholder="Menu URL" value="<?php echo $PageName ;?>"/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label> Page URL</label>
          <input type="text" class="form-control" name="EditMenu_URL" id="EditMenu_URL" placeholder="Page URL" value="<?php echo $PageURL ;?>"/>
          <input type="hidden" class="form-control" name="Hidden_Name" id="Hidden_Name" value="<?php echo $postedid; ?>" /> 
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group"> 
          <label> Unique Name</label>
          <input type="text" class="form-control" name="EUnique_Name" id="EUnique_Name" placeholder="Unique ID" value="<?php echo $UniqueID ;?>"/> 
        </div>
      </div>
      <div class="col-lg-4"> 
        <div class="form-group">
          <label for="phoneno">Assigned User Groups</label>
          <input name="menu_group_access"  id="menu_group_access" class="form-control"  placeholder="Enter one or multiple User Groups" >
          <input type="hidden" name="menu_group_accessE[]"  id="menu_group_accessE" value="<?php echo $group_access;?>" class="form-control"  placeholder="User Groups" >
        </div>
      </div>
    </div>
    <div class="row">
      <!-- radio -->
      <div class="col-lg-4">
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
      <div class="col-lg-8"> 
        <button type="submit" class="btn btn-info btn-lg w_full EditButton" name="EditButton" id="EditButton" style="float:center; margin-right: 2.6%; margin-top: 34px;" value="Edit/ Update Default Instituition Information"><span class="glyphicon glyphicon-check"></span> Edit Page Information</button>
      </div>
    </div> 
    </div> 
  </fieldset>
</form>
<!--Processing Submission -->
<div class="d_none"  id="EditLoading_ID">
<center class=" r_corners m_top_20">
  <h4 class="m_top_20 m_bottom_20">Please wait... Updating Page Details</h4>
  <img src="images/loading-bar.gif" class="img-thumbnail m_bottom_20" alt="Loading" style="max-width:160px;">
</center>
</div>
<!--End Submission Processing -->
<!--Alert Successful -->
<div class="BCEditUpdateSuccessful d_none" style="margin: o auto;">
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-database"></i>Page Details has been successfully updated!</h4>  
</div>
</div>
<!--End Successful ALert -->
<script src="<?php echo ASSETS_URL; ?>/plugins/magicsuggest/magicsuggest.js"></script> 
<script src="<?php echo ASSETS_URL; ?>/dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/dist/dependent-dropdown.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
   $(function() {
    $(".select2").select2();
  });
   // Deo Drops
  $(function() {
    $("#ESystemModule").depdrop({
        depends: ['ESystem_Name'],
        url: 'ajax-get-actions.php?GetModule=1'
    });
  });
  //Maggic Suggest
  var sp=$('#menu_group_accessE').val().split(',');
  var ms=$('#menu_group_access').magicSuggest({
      placeholder: 'Enter one or multiple User Groups',
      data: 'ajax-get-actions.php?UserGroups=1',
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
<script type="text/javascript">
//Start Form Validation
  jQuery().ready(function() {
    var v = jQuery("#Edit_System_Menu").validate({         
      rules: { 
        ESystem_Module: {
          required: true
        },
        EditPageName: {
          required: true
        },
        EditMenu_URL: {
          required: true
        },
        EUnique_Name:{
          required: true
        },
        menu_group_access: {
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
$("form#Edit_System_Menu").submit(function(e){
    e.preventDefault(); 
      if($('#Edit_System_Menu').valid()) { 
          $("#EditLoading_ID").show('fast'); 
          $('#Edit_System_Menu').hide("fast");
          var formData = new FormData($(this)[0]); 
            $.ajax({
                url: 'action.system-configuration.php',
                type: 'POST',
                data: formData,
                async: true,
                success: function (data) {
                  window.setTimeout(close, 1000);
                  window.setTimeout(showhome, 1000);
                  function close() {
                      $("#EditLoading_ID").hide('explode');  
                      $('.BCEditUpdateSuccessful').show("fast");
                  }
                  function showhome() {
                    window.location.href = 'system-pages-access';
                  }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
});
</script>
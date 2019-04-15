<?php
include_once('../sys/core/init.inc.php');
$common=new common();

if($_POST['rowid']) 
  {
    $id = $_POST['rowid'];
    $GetAgentData = $common->GetRows("SELECT a.*, s.sys_name as Systemname, m.name as Modulename, p.name as Pagename FROM tbl_pages_actions a left join tbl_modules_pages_access p on a.par_id=p.id left join tbl_sys_module_child m on p.par_id=m.id left join tbl_sys_modules s on m.par_id=s.id WHERE a.id = '{$id}'  ") ;
    foreach($GetAgentData AS $InfoSc)
        {
          $id = $InfoSc['id']; 
          $group_access = $InfoSc['group_access'];
          $name = $InfoSc['name'];
          $Systemname = $InfoSc['Systemname']; 
          $Modulename = $InfoSc['Modulename']; 
          $view = $InfoSc['view']; 
          $create = $InfoSc['create']; 
          $update = $InfoSc['update']; 
          $delete = $InfoSc['delete']; 
          $approve = $InfoSc['approve'];
          $Pagename = $InfoSc['Pagename']; 
?>
<form class="contact-form cf-style-1 m_top_20 m_bottom_40" name="Edit_Plot_Form" id="Edit_Plot_Form" method="POST" action="" enctype="multipart/form-data" action="">
  <div class="box-body" id="Final_FormID">
    <fieldset>
      <!--Plot Details Start -->
      <div class="box-body">
				<h3><?php echo $Systemname.' - '.$Modulename.' - '.$Pagename; ?></h3>
            <div class="col-lg-6">
              <div class="form-group">
								<input type="hidden" class="form-control" name="Edit_ProjectID" id="Edit_ProjectID" value="<?php echo $id; ?>">
              </div>
							<div class="form-group">
								<label for="phoneno">Assigned To</label>
								<input name="menu_group_access3" id="menu_group_access3" class="form-control"  placeholder="Enter one or multiple User Groups" >
							 <input type="hidden" name="menu_group_accessE[]"  id="menu_group_accessE" value="<?php echo $group_access;?>" class="form-control"  placeholder="Phone Number" >
							</div>
            </div> 
            <div class="col-lg-6">
							<div class="row">
							<div class="form-group  col-lg-4">
								<label for="view">Can View</label>
								<div class="checkbox">
									<label>
										<?php 
											$checkedview=($view == '1') ? ' checked':'';
										?>
										<input type="checkbox" name="viewEdit" id="viewEdit" <?php echo $checkedview;?> > View
									</label>
								</div>
							</div>
							<div class="form-group col-lg-4">
								<label for="create">Can Create</label>
								<div class="checkbox">
									<label>
										<?php 
											$checkedcreate=($create == '1') ? ' checked':'';
										?>
										<input type="checkbox" name="createEdit" id="createEdit" <?php echo $checkedcreate;?>> Create
									</label>
								</div>
							</div>
							<div class="form-group col-lg-4">
								<label for="update">Can Edit</label>
								<div class="checkbox">
									<label>
										<?php 
											$checkedupdate=($update == '1') ? ' checked':'';
										?>
										<input type="checkbox" name="updateEdit" id="updateEdit" <?php echo $checkedupdate;?>> Edit
									</label>
								</div>
							</div>
							<div class="form-group  col-lg-4">
								<label for="delete">Can Delete</label>
								<div class="checkbox">
									<label>
										<?php 
											$checkeddelete=($delete == '1') ? ' checked':'';
										?>
										<input type="checkbox" name="deleteEdit" id="deleteEdit" <?php echo $checkeddelete;?>> Delete
									</label>
								</div>
							</div> 
              <div class="form-group  col-lg-4">
                <label for="approveEdit">Can Approve</label>
                <div class="checkbox">
                  <label>
                    <?php 
                      $checkedapprove=($approve == '1') ? ' checked':'';
                    ?>
                    <input type="checkbox" name="approveEdit" id="approveEdit" <?php echo $checkedapprove;?>> Approve
                  </label>
                </div>
              </div>
							</div>
            </div>
          </div>  
					<div class="col-lg-12">
            <fieldset style="margin: 10px 10px 10px 10px; text-align: center;">
              <div class="box-footer">
                  <button type="submit" class="btn  btn-info btn-lg" name="submit" style="float:center; margin-right: 2.6%;"><span class="glyphicon glyphicon-check"></span>Update User Group Pages Actions Details</button>
              </div>
            </fieldset>
					</div>
        </div>
  </form>
      <center  id="Edit_Loading_ID" class="d_none">
        <h4 class="m_top_20 m_bottom_20">Please wait... Updating <?php echo $Editpltregname; ?> Pages Actions Information </h4>
        <img src="../img/loading-bar.gif" alt="Loading" style="max-width:160px;" />
      </center>
<?php } }
?>
<script src="<?php echo ASSETS_URL; ?>/plugins/magicsuggest/magicsuggest.js"></script> 
<script src="<?php echo ASSETS_URL; ?>/dist/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/dist/dependent-dropdown.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<!--Update Sales Agent Information -->
<script type="text/javascript">
jQuery(document).ready(function() {
$("form#Edit_Plot_Form").submit(function(e){
e.preventDefault(); 
    $("#Edit_Loading_ID").show('fast'); 
    $('#Edit_Plot_Form').hide("fast");
    var Edit_ProjectID = $("#Edit_ProjectID").val();
    var formData = new FormData($(this)[0]); 
      $.ajax({
          url: 'action.systemsaccess.php?Edit_ProjectID='+Edit_ProjectID,
          type: 'POST',
          data: formData,
          async: false,
          success: function (data) {
              window.setTimeout(close, 2000);
                setTimeout(function () { 

                }, 3000);
                function close() {
                  $('#Edit_Plot_Form').show("fast");
                  $("#Edit_sf1").show("slow");
                  $("#Edit_sf2").hide("slow");
                  $("#Edit_Loading_ID").hide('fast'); 
                  $('#Edit_Plot_Form')[0].reset();
                }
          },
          cache: false,
          contentType: false,
          processData: false
      });
  return false;
});
});
</script>
<script type="text/javascript">
    $(function() {
        $("#PlotMgrsTable").dataTable();
    });
	 //Maggic Suggest
  var sp=$('#menu_group_accessE').val().split(',');
  var ms=$('#menu_group_access3').magicSuggest({
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
<!-- End Sales Agent Information Update -->
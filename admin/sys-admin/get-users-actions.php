<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

// Get User Info Data 
if (filter_has_var(INPUT_GET, "getUserData")){
    try {
          $getUserData = $_REQUEST['getUserData'];
          $result = $common->GetRows("SELECT `ts`.*, `gp`.`usergroup_name` FROM tbl_users ts LEFT JOIN tbl_usergroups gp ON `gp`.`usergroup_id` = `ts`.`group_id` WHERE `ts`.`id` = '{$getUserData}'");
          foreach ($result as $row){
              $UID = $row['id'];
              $GetNames = $row['names'];
              $Getgroup_id = $row['group_id'];
          }

        // Check If User Group Page Access has been Loaded
        $CheckUAP = $common->GetRows("SELECT MPA.id AS MPAccessID, MPA.par_id AS MPAccessParent, SMC.id AS SMChildID, SMC.par_id AS SMChildParent, SM.id AS MainSysID, MPA.isActive AS ActiveModulePage FROM tbl_modules_pages_access MPA LEFT JOIN tbl_sys_module_child SMC ON SMC.id = MPA.par_id LEFT JOIN tbl_sys_modules SM ON SM.id = SMC.id WHERE MPA.group_access LIKE '%".$Getgroup_id."%' AND MPA.isActive = 1 AND MPA.id NOT IN (SELECT par_id FROM tbl_pages_actions GPA WHERE GPA.userID = '".$getUserData."' ) ");
        
            foreach ($CheckUAP as $cuap){
                $MainSysID = $cuap['MainSysID']; // Sys ID
                $SMChildID = $cuap['SMChildID']; // Module ID 
                $MPAccessID = $cuap['MPAccessID']; // Page ID
                $common->Insert("INSERT INTO tbl_pages_actions (sys_id, mod_id, par_id, userID) VALUES ('{$MainSysID}', '{$SMChildID}', '{$MPAccessID}', '{$getUserData}')");
            }

    } catch (Exception $e) { echo $e; }
}
?>
<!--Start Listings -->
    <div class="Accessfiltering">
        <form id="AccesssearchFRM" name="AccesssearchFRM">
            <fieldset>
                <div class="row m_bottom_20">
                    <div class="col-lg-6">
                        <label>Search Page Name/ URL</label>
                        <input type="text" class="form-control" name="SearchAccessName" id="SearchAccessName" placeholder="Search Page Name/ URL" autocomplete="OFF">
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" id="LoadAccessButton" class="btn  btn-danger btn-md w_full" style="margin-top: 34px;"><span class="glyphicon glyphicon-check"></span> Search Records
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <div class="btn  btn-warning btn-md w_full ManualAccessAddition" style="margin-top: 34px;" data-toggle="modal" data-target="#ManualAdditionModal"><span class="glyphicon glyphicon-plus"></span> Add Record
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div id="EditAccessTable"> <!--Start Students Table-->
        <div id="AccessTableContainer" style="width: 100%;"></div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#AccessTableContainer').jtable({
                    title: '<i class="fa fa-user m_top_20 m_bottom_20"></i> <?php echo $GetNames; ?> - Systems Access Setup ',
                    paging: true,
                    pageSize: 10,
                    sorting: true,
                    defaultSorting: 'pageid ASC',
                    //selecting: true, // Enable selecting
                    openChildAsAccordion: true,
                    //multiselect: true, //Allow multiple selecting
                    //selectingCheckboxes: true, //Show checkboxes on first column
                    //selectOnRowClick: false,
                    actions: {
                        listAction: 'users-action-listing.php?action=GetPagesList'
                    },
                    fields: {
                        pageid: {
                            key: true,
                            create: false,
                            edit: false,
                            list: false
                        },
                        sys_name: {
                            title: 'System',
                            width: '8%'
                        },
                        module_name: {
                            title: 'Module',
                            width: '12%'
                        },
                        pagename: {
                            title: 'Page Name',
                            width: '12%'
                        }, 
                        batchButton: {
                            title: 'Page URL/ Link',
                            width: '12%',
                            display: function (data) {
                                return '<a href="javascript:void(0);">' + data.record.url + '</a>';
                            }
                        },
                        isActive: {
                            title: 'Status',
                            width: '5%',
                            options: 'users-action-listing.php?action=status',
                            list: false
                        },
                        AssignBtns: {
                                title: 'Assign',
                                width: '5%',
                                sorting: false,
                                edit: false,
                                create: false,
                                display: function (accessLevelData) {
                                    // Create an image that will be used to open child table
                                    var $img = $('<center><button class="btn btn-info btn-small w_full"><span class="glyphicon glyphicon-check"></span> Assign</button></center>');
                                    // Open child table when user clicks the image 
                                    $img.click(function () {
                                        $('#AccessTableContainer').jtable('openChildTable',
                                                $img.closest('tr'),
                                                {
                                                    title: accessLevelData.record.sys_name + ' &rarr; ' + accessLevelData.record.module_name + ' &rarr; ' + accessLevelData.record.pagename,
                                                    actions: {
                                                        listAction: 'users-action-listing.php?GetAccessPageId='+accessLevelData.record.pageid+'&GUserID=<?php echo $getUserData; ?>',
                                                    },
                                                    fields: {
                                                        PActionID:{
                                                            title: 'ID',
                                                            width: '4%',
                                                            list: false
                                                        },
                                                        canCreateBtn: {
                                                            title: 'Can_Create',
                                                            width: '5%',
                                                            display: function (datav) {
                                                              var canCreateVar = datav.record.canCreate;
                                                              if(canCreateVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanCreate(' + datav.record.PActionID + ')" id="canCreateIDA'+datav.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanCreate(' + datav.record.PActionID + ')" id="canCreateIDB'+datav.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        canUpdateBtn: {
                                                            title: 'Can_Update',
                                                            width: '5%',
                                                            display: function (dataw){ // canUpdateIDA canUpdateIDB
                                                              var canUpdateVar = dataw.record.canUpdate;
                                                              if (canUpdateVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanUpdate(' + dataw.record.PActionID + ')" id="canUpdateIDA'+dataw.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanUpdate(' + dataw.record.PActionID + ')"  id="canUpdateIDB'+dataw.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        canDeleteBtn: {
                                                            title: 'Can_Delete',
                                                            width: '5%',
                                                            display: function (datax) { // canDeleteA canDeleteB
                                                              var canDeleteVar = datax.record.canDelete;
                                                              if (canDeleteVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanDelete(' + datax.record.PActionID + ')" id="canDeleteA'+datax.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanDelete(' + datax.record.PActionID + ')" id="canDeleteB'+datax.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        canViewBtn: { 
                                                            title: 'Can_View',
                                                            width: '5%',
                                                            display: function (datay) {
                                                              var canViewVar = datay.record.canView;
                                                              if (canViewVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanView(' + datay.record.PActionID + ')" id="canViewA'+datay.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanView(' + datay.record.PActionID + ')" id="canViewB'+datay.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        
                                                        canApproveBtn: {
                                                            title: 'Can_Approve',
                                                            width: '5%',
                                                            display: function (dataz) {
                                                              var canApproveVar = dataz.record.canApprove;
                                                              if (canApproveVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanApprove(' + dataz.record.PActionID + ')" id="canApproveA'+dataz.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanApprove(' + dataz.record.PActionID + ')" id="canApproveB'+dataz.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        canRejectBtn: {
                                                            title: 'Can_Reject',
                                                            width: '5%',
                                                            display: function (datac) {
                                                              var canRejectVar = datac.record.canReject; 
                                                              if (canRejectVar == 0){
                                                                  return '<center><button class="btn btn-danger btn-small w_full" onclick="LoadAccessRightscanReject(' + datac.record.PActionID + ')" id="canRejectA'+datac.record.PActionID+'"><span class="glyphicon glyphicon-check"></span> NO</button></center>';
                                                              }
                                                              else{
                                                                  return '<center><button class="btn btn-success btn-small w_full" onclick="LoadAccessRightscanReject(' + datac.record.PActionID + ')" id="canRejectB'+datac.record.PActionID+'"><span class="glyphicon glyphicon-trash"></span> YES </button></center>';
                                                              }
                                                            }
                                                        },
                                                        approvalLevelBtn: {
                                                            title: 'Approval_Level',
                                                            width: '5%',
                                                            display: function (datad) {
                                                                return '<center><button class="btn btn-warning btn-small w_full" onclick="LoadApprovalLevelModal(' + datad . record . PActionID + ')"><span class="glyphicon glyphicon-file"></span> ' + datad . record . approvalLevel + '</button></center>';
                                                                
                                                              }
                                                        }
                                                    }
                                                }, function (data) { // opened handler 
                                                    data.childTable.jtable('load');
                                                });
                                    });
                                    //Return image to show on the Access ID row
                                    return $img;
                                }
                            },
                    }
                });
                // Re-load records when user click 'load records' button.
                $('#LoadAccessButton').click(function (e) {
                    e.preventDefault();
                    $('#AccessTableContainer').jtable('load', {
                        SearchAccessName: $('#SearchAccessName').val()
                    });
                });
                // Load person list from server
                $('#AccessTableContainer').jtable('load');
            });
        </script>
    </div>
    <!--End Listings -->

<!--Start Manual Access Addition -->

<div class="modal fade" id="ManualAdditionModal" role="dialog" aria-labelledby="ManualAdditionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"> </div>
        <div class="modal-body">
            <!--Start Access Form -->
            <form class="contact-form cf-style-1 m_bottom_40" name="AddManualActionForm" id="AddManualActionForm" method="POST" action="" enctype="multipart/form-data" action="">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Select System</label>
                                    <select class="form-control select2" id="System_Module"
                                            name="System_Module" style="width: 100%;" required>
                                        <option value="" selected> Choose System:</option>
                                        <?php $UDSTT = $common->GetRows("SELECT id, sys_name FROM `tbl_sys_modules`;");
                                        foreach ($UDSTT as $UDSsTT) { ?>
                                            <option value="<?php echo $UDSsTT['id']; ?>"><?php echo $UDSsTT['sys_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" class="form-control"  name="KDCRegisterSubPages" id="KDCRegisterSubPages"  value="3">
                                    <input type="hidden" class="form-control"  name="GetUserID" id="GetUserID"  value="<?php echo $getUserData; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"> 
                                    <label>Select Module</label>
                                    <select class="form-control select2" id="SystemModule" name="SystemModule" style="width: 100%;" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Select Page</label>
                                    <select class="form-control select2" id="SysPageid"  name="SysPageid" style="width: 100%;" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="view">Can View</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="view" id="view" value="1"> &nbsp;&nbsp;View
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="create">Can Create</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="create" id="create" value="1"> &nbsp;&nbsp;Create
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="update">Can Edit</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="update" id="update" value="1"> &nbsp;&nbsp;Edit
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-lg-4">
                                <label for="delete">Can Delete</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="delete" id="delete" value="1"> &nbsp;&nbsp;Delete
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  col-lg-4">
                                <label for="approve">Can Approve</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="approve" id="approve" value="1">  &nbsp;&nbsp;Approve
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  col-lg-4">
                                <label for="approve">Can Receive</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="Receive" id="Receive" value="1"> &nbsp;&nbsp;Receive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-lg-4">
                                <label for="delete">Can Dispatch</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="Dispatch" id="Dispatch" value="1"> &nbsp;&nbsp;Dispatch
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  col-lg-4">
                                <label for="Reject">Can Reject</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="Reject" id="Reject" value="1"> &nbsp;&nbsp;Reject
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  col-lg-4">
                                <label>Approval Level</label>
                                <select class="form-control select2" id="UserApprovalLevelID" name="UserApprovalLevelID" style="width: 100%;" required>
                                    <option value="0" selected>0 (NO ACCESS)</option>
                                    <?php $gal = $common->GetRows("SELECT id, levelName FROM `tbl_approval_levels` WHERE isActive = 1;");
                                    foreach ($gal as $ral) { ?>
                                        <option value="<?php echo $ral['id']; ?>"><?php echo $ral['levelName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn w_full btn-info btn-lg" name="submit"><span class="glyphicon glyphicon-check"></span> Submit Pages Actions</button>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-warning w_full cancelManualALAdd btn-lg"><i class="fa fa-trash" data-dismiss="modal"></i> Cancel</button>
                        </div>
                    </div>
        </form>
        <!--Complete Access Form -->
        <!--Processing Submission -->
        <center id="ActionLoader" class="d_none r_corners">
            <h4 class="m_top_20 m_bottom_20">Please wait... Processing Your Submission </h4>
            <img src="../img/loading-bar.gif" class="img-thumbnail" alt="Loading"
                 style="max-width:160px;">
        </center>
        <!--End Submission Processing -->
        </div>
        <div class="modal-footer">
            <div class="col-lg-12">
                <center class="m_top_10">
                    &copy; <?php echo ucwords(strtolower($SystemRegisteredTo)); ?>
                </center>
            </div>
        </div>

    </div>
  </div>
</div>
<!--Finish Manual Access Addition -->


<!--Start Confirm Approval Modal -->
<div class="modal fade" id="ConfirmApprovalLevelModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmApprovalLevelModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="t_aling_c"><i class="fa fa-database"></i> Update User Approval Level</h4>
      </div>
        <div class="modal-body">
            <form class="contact-form cf-style-1 m_bottom_40" name="UUserAppLevelForm" id="UUserAppLevelForm" method="POST" action="" enctype="multipart/form-data" action=""> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>User Approval Level</label>
                            <select class="form-control select2" name="UUALevelID" id="UUALevelID" required style="width: 100%; border-radius: 0; height:36px;">
                                <option value="0">0</option>
                                <?php
                                foreach ($common->GetRows("SELECT * FROM tbl_approval_levels WHERE isActive = 1 ") AS $bcal) {
                                    ?>
                                    <option value="<?php echo $bcal["id"]; ?>"><?php echo $bcal["levelName"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-control" id="UpdatePageAccessID" name="UpdatePageAccessID">
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-success w_full ConfirmALUpdate"><i class="fa fa-cogs"></i> Confirm  Level</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-warning w_full cancelALM"><i class="fa fa-cogs" data-dismiss="modal"></i> Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="col-lg-12">
                <center class="m_top_10">
                    &copy; <?php echo ucwords(strtolower($SystemRegisteredTo)); ?>
                </center>
            </div>
        </div>

    </div>
  </div>
</div>
<!--End Confirm Approval Modal -->

<script src="../js/dependent-dropdown.js" type="text/javascript"></script>
<script src="../assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="../js/formValidation.js"></script>
<script type="text/javascript" src="../js/framework/bootstrap.js"></script>
<script type="text/javascript">
    $(function(){
        $(".select2").select2();
    });

    // Deo For Menus
    $(function () {
        $("#SystemModule").depdrop({
            depends: ['System_Module'],
            url: 'ajax-get-actions.php?GetModule=1'
        });
    });

    //Deo For pages
    $(function () {
        $("#SysPageid").depdrop({
            depends: ['SystemModule'],
            url: 'ajax-get-actions.php?GetPage=1'
        });
    });

    // Cancel Confirms
    $(".cancelALM").click(function(e) {
        e.preventDefault();
        $('#ConfirmApprovalLevelModal').modal('hide'); 
    });
    $(".cancelManualALAdd").click(function(e) {
        e.preventDefault();
        $('#ManualAdditionModal').modal('hide'); 
    });

    // Approval Level Modal
    function LoadApprovalLevelModal(ALID){
        $('#ConfirmApprovalLevelModal').modal({backdrop: 'static', keyboard: false}); 
        $("#UpdatePageAccessID").val(ALID) 
        $(".ConfirmALUpdate").click(function(e) { 
        e.preventDefault();
            var dataPosted = $("#UUserAppLevelForm").serialize();
                $.ajax({
                url: 'common-processor.php?UpdateUAapprovalL=1&aLid='+ALID,
                type: 'POST',
                data: dataPosted,
                async: true,
                    success: function () {
                        $('#ConfirmApprovalLevelModal').modal('hide'); 
                }
            });
        });
    }

    // Access Rights Update Functions btn-danger btn-success
    function LoadAccessRightscanCreate(AccessRightID){

            /*
            // $('#canCreateIDA'+AccessRightID).prop('disabled', true);
            */
            /*
            $("#canCreateIDA"+AccessRightID).on("click", function(){
                $('#canCreateIDA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
                //$('#canCreateIDA'+AccessRightID).addClass('btn-success');
            });
            $("#canCreateIDB"+AccessRightID).on("click", function(){
                $('#canCreateIDB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
                //$('#canCreateIDB'+AccessRightID).addClass('btn-danger');
            });
            */
            $('#canCreateIDA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canCreateIDB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canCreate='+AccessRightID,
            type: 'POST',
            async: true,
            success : function(data){
              data.childTable.jtable('load');
            }
        });
    }

    // Access Rights Update Functions      
    function LoadAccessRightscanUpdate(AccessRightID){
            $('#canUpdateIDA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canUpdateIDB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canUpdate='+AccessRightID,
            type: 'POST',
            async: true
        }); 
    }

   // Access Rights Update Functions
    function LoadAccessRightscanDelete(AccessRightID){ 
            $('#canDeleteA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canDeleteB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canDelete='+AccessRightID,
            type: 'POST',
            async: true
        });
    }

    // Access Rights Update Functions
    function LoadAccessRightscanView(AccessRightID){
            $('#canViewA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canViewB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canView='+AccessRightID,
            type: 'POST',
            async: true
        });
    }

    // Access Rights Update Functions
    function LoadAccessRightscanApprove(AccessRightID){
            $('#canApproveA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canApproveB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canApprove='+AccessRightID,
            type: 'POST',
            async: true
        });
    }
    // Access Rights Update Functions
    function LoadAccessRightscanReceive(AccessRightID){
            $('#canReceiveA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canReceiveB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canReceive='+AccessRightID,
            type: 'POST',
            async: true
        });
    }
    // Access Rights Update Functions  
    function LoadAccessRightscanDispatch(AccessRightID){
            $('#canDispatchA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canDispatchB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canDispatch='+AccessRightID,
            type: 'POST',
            async: true
        });
    }
    // Access Rights Update Functions
    function LoadAccessRightscanReject(AccessRightID){           
            $('#canRejectA'+AccessRightID).toggleClass('btn-danger').addClass('btn-success');
            $('#canRejectB'+AccessRightID).toggleClass('btn-success').addClass('btn-danger');
            $.ajax({
            url: 'common-processor.php?AlterRights='+AccessRightID+'&canReject='+AccessRightID,
            type: 'POST',
            async: true
        });
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("form#AddManualActionForm").submit(function (e) {
            e.preventDefault();
            var sys_id = $("#sys_id").val();
            var mod_id = $("#mod_id").val();

            if ($('#AddManualActionForm').valid()) {
                $("#ActionLoader").show('fast');
                $('#AddManualActionForm').hide("fast");
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: 'common-processor.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {
                        window.setTimeout(close, 100);
                        setTimeout(function () {

                        }, 1000);
                        function close() {
                            $('#AddManualActionForm').show("fast");
                            $("#ActionLoader").hide('fast');
                            $('#AddManualActionForm')[0].reset();
                            $('#ManualAdditionModal').modal('hide'); 
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
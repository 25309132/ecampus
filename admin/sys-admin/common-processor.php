<?php
include_once('../sys/core/init.inc.php');
$common=new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}


$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$TodayDate = date("Y-m-d H:m:s");
$TodayYear = date("Y");
$GUID = $_SESSION['UID'];

// Update User Approval Level     
if(filter_has_var(INPUT_GET, "UpdateUAapprovalL")) {
  try {                  
        $GetALID = $common->CCStrip($_GET['aLid']);
        $UpdatePageAccessID = $common->CCStrip($_POST['UpdatePageAccessID']);
        $UUALevelID = $common->CCStrip($_POST['UUALevelID']);
        
        $common->Insert("UPDATE tbl_pages_actions SET approvalLevel = '{$UUALevelID}' WHERE  id = '{$UpdatePageAccessID}' ");
      }catch (Exception $e) {echo $e;}

}

//  Update Access Status       
if(filter_has_var(INPUT_GET, "AlterRights")) {
  try {  
        $GetAccRID=$common->CCStrip($_GET['AlterRights']);
        

        // Get Current Access Status

        $GetAccRIDArray=$common->GetRows("SELECT * FROM tbl_pages_actions WHERE id ='{$GetAccRID}' ");
            foreach($GetAccRIDArray as $A)
                {
                    $canCreateVal=$A["canCreate"];
                    $canDeleteVal=$A["canDelete"];
                    $canViewVal=$A["canView"];
                    $canApproveVal=$A["canApprove"];
                    $canReceiveVal=$A["canReceive"];
                    $canDispatchVal=$A["canDispatch"];
                    $canRejectVal=$A["canReject"];
                    $canUpdateVal=$A["canUpdate"]; 
                }
        if(isset($_GET['canCreate'])){
            $GetUpdate=$common->CCStrip($_GET['canCreate']);
            $var = 'canCreate';
            if($canCreateVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }             
        elseif(isset($_GET['canUpdate'])){
            $GetUpdate=$common->CCStrip($_GET['canUpdate']);
            $var = 'canUpdate';
            if($canUpdateVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }             
        elseif(isset($_GET['canDelete'])){
            $GetUpdate=$common->CCStrip($_GET['canDelete']);
            $var = 'canDelete';
            if($canDeleteVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }  
        elseif(isset($_GET['canView'])){
            $GetUpdate=$common->CCStrip($_GET['canView']);
            $var = 'canView';
            if($canViewVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }
        elseif(isset($_GET['canApprove'])){
            $GetUpdate=$common->CCStrip($_GET['canApprove']);
            $var = 'canApprove';
            if($canApproveVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }
        elseif(isset($_GET['canReceive'])){
            $GetUpdate=$common->CCStrip($_GET['canReceive']);
            $var = 'canReceive';
            if($canReceiveVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }
        elseif(isset($_GET['canDispatch'])){
            $GetUpdate=$common->CCStrip($_GET['canDispatch']);
            $var = 'canDispatch';
            if($canDispatchVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }
        elseif(isset($_GET['canReject'])){
            $GetUpdate=$common->CCStrip($_GET['canReject']);
            $var = 'canReject';
            if($canRejectVal == 1){
                $TheVal = 0;
            }
            else{
                $TheVal = 1;
            }
        }

        $common->Insert("UPDATE tbl_pages_actions SET `$var` = $TheVal WHERE  id = '{$GetUpdate}' ");

      }catch (Exception $e) {echo $e;}

}
// Create New Action Rights
if(filter_has_var(INPUT_POST, "KDCRegisterSubPages")) {
   try {    //  System_Module SystemModule SysPageid view create update approve Receive Dispatch  Reject  
            $pageid = $common->CCStrip($_POST['SysPageid']);
            $sys_id = $common->CCStrip($_POST['System_Module']);
            $mod_id = $common->CCStrip($_POST['SystemModule']);
            $view = (!empty($_POST["view"])) ? 1 : 0;
            $create = (!empty($_POST["create"])) ? 1 : 0;
            $update = (!empty($_POST["update"])) ? 1 : 0;
            $delete = (!empty($_POST["delete"])) ? 1 : 0;
            $approve = (!empty($_POST["approve"])) ? 1 : 0;
            $PReceive = $_POST['Receive'];
            $PDispatch = $_POST['Dispatch'];
            $PReject = $_POST['Reject'];
            $UserApprovalLevelID = $_POST['UserApprovalLevelID'];
            $GetUserID = $_POST['GetUserID'];

            $CheckAccess = $common->CCGetDBValue("SELECT count(*) AS CheckedTotals FROM tbl_pages_actions WHERE par_id = '{$pageid}' AND userID = '{$GetUserID}' ;");
            if ($CheckAccess >= 1) {
                $common->Insert("UPDATE `tbl_pages_actions` SET `sys_id` = '{$sys_id}', `mod_id` = '{$mod_id}', `par_id` = '{$pageid}', `canCreate` = '{$create}', `canUpdate` = '{$update}', `canView` = '{$view}', `canDelete` = '{$delete}', `canApprove` = '{$approve}' , `canReceive` = '{$PReceive}', `canDispatch` = '{$PDispatch}', `canReject` = '{$PReject}', `approvalLevel` = '{$UserApprovalLevelID}' WHERE par_id = '{$pageid}' AND userID = '{$GetUserID}' ");
            } else {
                $common->Insert("INSERT INTO `tbl_pages_actions` (`canReceive`, `canDispatch`, `canReject`, `sys_id`, `mod_id`, `par_id`, `userID`, `canCreate`, `canUpdate`, `canView`, `canDelete`, `canApprove`, `approvalLevel`) VALUES ('{$PReceive}','{$PDispatch}','{$PReject}', '{$sys_id}', '{$mod_id}','{$pageid}', '{$GetUserID}', '{$create}', '{$update}', '{$view}','{$delete}','{$approve}','{$UserApprovalLevelID}');");
            }
        
    } catch (Exception $e) { echo $e;}

}

?>
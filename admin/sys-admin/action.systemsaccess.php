<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();
// Add New Plot Details
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$USESSION_EMAIL = $_SESSION['SESSION_EMAIL'];
$USESSION_UID = $_SESSION['UID_Session'];
if (!empty($_GET["GetActivities"])) {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $dd = $parents["0"];
            $out = $common->GetRows("SELECT user_id as id, a_name as name FROM projms_activities_activities where project_id= '" . $dd . "';");
            echo json_encode(['output' => $out, 'selected' => '']);
            return;
        }
    }
}
if (!empty($_GET["UserGroups"])) {
    $rows = $common->JsonGetRows("SELECT * FROM tbl_usergroups");
    echo $rows;
    return;
}
if (filter_has_var(INPUT_POST, "Register_New_Plot")) {
    try {
        $AllowedFileTypes = array('image/png', 'image/jpeg', 'image/pjpeg', 'image/gif', "application/pdf", 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/rtf');
        $dir_base = "projectsdoc/";
        if (in_array($_FILES["d_document"]["type"], $AllowedFileTypes)) {
            $UploadedFile = is_uploaded_file($_FILES['d_document']['tmp_name']);
            if ($UploadedFile) {
                $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['d_document']['name']));
                $TheImageOne = strtotime("now") . $safe_filename;
                move_uploaded_file($_FILES['d_document']['tmp_name'], $dir_base . $TheImageOne);
            }
        }

        $project_id = $common->CCStrip($_POST['project_id']);
        // $user_id =$common->CCStrip($_POST['user_id']);
        $groups = isset($_POST['user_id']) ? $_POST['user_id'] : array();
        $user_id = implode(",", $groups);
        $d_details = $common->CCStrip($_POST['d_details']);
        $d_version = $common->CCStrip($_POST['d_version']);
        $dd = "INSERT INTO `projms_activities_projectdocuments` (`project_id`, `user_id`, `d_details`, `d_document`, `d_version`) VALUES ('" . $project_id . "', '" . $user_id . "', '" . $d_details . "', '" . $TheImageOne . "', '" . $d_version . "');";
        $common->Insert($dd);
        echo $dd;
    } catch (Exception $e) {
        echo $e;
    }
}
// End Adding New Plot Details
// Start Plot Manager Information Update
elseif (isset($_GET["AccessLevelID"])) {
    try {

        $AccessLevelID = $common->CCStrip($_POST['AccessLevelID']);
        $name = $common->CCStrip($_POST['nameEdit']);
        $groups = isset($_POST['menu_group_access']) ? $_POST['menu_group_access'] : array();
        $group_access = implode(",", $groups);
        $background = $common->CCStrip($_POST['backgroundEdit']);
        $SystemIconEdit = $common->CCStrip($_POST['SystemIconEdit']);
        $SystemURLEdit = $common->CCStrip($_POST['SystemURLEdit']);
        $EditTModeStatus = $common->CCStrip($_POST['EditTModeStatus']);

        $common->Insert("UPDATE `tbl_sys_modules`
								SET
								`sys_name` ='" . $name . "',
								`group_access` ='" . $group_access . "',
								`sys_color` = '" . $background . "',
                                `url` = '" . $SystemURLEdit . "',
                                `isActive` = '" . $EditTModeStatus . "',
                                `sys_icon` = '" . $SystemIconEdit . "'
								WHERE `id` =" . $AccessLevelID . ";");

    } catch (Exception $e) {
        echo $e;
    }
}
// End Plot Manager Information Update
//Add_SystemRights_Form AccessID HiddenAdd SystemIcon menu_group_access2 SystemURL AccessLevelID background
elseif (filter_has_var(INPUT_POST, "HiddenAdd")) //elseif(isset($_GET["HiddenAdd"]))
{
    try {
        $AddSystemName = $common->CCStrip($_POST['AddSystemName']);
        $groups = isset($_POST['menu_group_access2']) ? $_POST['menu_group_access2'] : array();
        $group_access = implode(",", $groups);
        //$AccessID = $_GET("AccessID");
        $background = $common->CCStrip($_POST['background']);
        $SystemIcon = $common->CCStrip($_POST['SystemIcon']);
        $SystemURL = $common->CCStrip($_POST['SystemURL']);

        $common->Insert("INSERT INTO `tbl_sys_modules` (`sys_name`, `group_access`, `sys_color`, `url`, `sys_icon`) 
                VALUES ('{$AddSystemName}', '{$group_access}', '{$background }', '{$SystemURL}', '{$SystemIcon}')");

    } catch (Exception $e) {
        echo $e;
    }
} elseif (filter_has_var(INPUT_POST, "KDCRegisterSubPages")) {
    try { //System_Module SystemModule SysPageid menu_group_access2
        $pageid = $common->CCStrip($_POST['SysPageid']);
        $sys_id = $common->CCStrip($_POST['System_Module']);
        $mod_id = $common->CCStrip($_POST['SystemModule']);
        $view = (!empty($_POST["view"])) ? 1 : 0;
        $create = (!empty($_POST["create"])) ? 1 : 0;
        $update = (!empty($_POST["update"])) ? 1 : 0;
        $delete = (!empty($_POST["delete"])) ? 1 : 0;
        $approve = (!empty($_POST["approve"])) ? 1 : 0;
        $groups = isset($_POST['menu_group_access2']) ? $_POST['menu_group_access2'] : array();
        $group_access = implode(",", $groups);

        $getlibmembers = $common->CCGetDBValue("SELECT count(*) as tot FROM tbl_pages_actions WHERE par_id = '{$pageid}';");
        if ($getlibmembers >= 1) {
            $dd = "UPDATE `tbl_pages_actions` SET `sys_id` = '{$sys_id}', `mod_id` = '{$mod_id}', `par_id` = '{$pageid}', `group_access` = '{$group_access}', `create` = '{$create}', `update` = '{$update}', `view` = '{$view}', `delete` = '{$delete}', `approve` = '{$approve}' WHERE id = '{$pageid}'";
        } else {
            $dd = "INSERT INTO `tbl_pages_actions` (`sys_id`, `mod_id`, `par_id`, `group_access`, `create`, `update`, `view`, `delete`, `approve`) VALUES ('{$sys_id}', '{$mod_id}','{$pageid}', '{$group_access}', '{$create}', '{$update}', '{$view}','{$delete}','{$approve}');";
        }
        $common->Insert($dd);
        echo $dd;
    } catch (Exception $e) {
        echo $e;
    }
}
// End Adding New Details
// Updating Details
elseif (filter_has_var(INPUT_POST, "Edit_ProjectID")) {
    try {
        $pageid = $common->CCStrip($_POST['Edit_ProjectID']);
        //$sys_id =$common->CCStrip($_POST['System_Module']);
        //$mod_id =$common->CCStrip($_POST['SystemModule']);
        $view = (!empty($_POST["viewEdit"])) ? 1 : 0;
        $create = (!empty($_POST["createEdit"])) ? 1 : 0;
        $update = (!empty($_POST["updateEdit"])) ? 1 : 0;
        $delete = (!empty($_POST["deleteEdit"])) ? 1 : 0;
        $approve = (!empty($_POST["approveEdit"])) ? 1 : 0;
        $groups = isset($_POST['menu_group_access3']) ? $_POST['menu_group_access3'] : array();
        $group_access = implode(",", $groups);

        $dd = "UPDATE `tbl_pages_actions` SET `group_access` = '{$group_access}', `create` = '{$create}', `update` = '{$update}', `view` = '{$view}', `delete` = '{$delete}', `approve` = '{$approve}' WHERE id = '{$pageid}'";
        $common->Insert($dd);
        echo $dd;
    } catch (Exception $e) {
        echo $e;
    }
}
// End Adding New Details
?>

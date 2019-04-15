<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$TodayDate = date("Y-m-d H:m:s");
$TodayYear = date("Y");
$UID = $_SESSION['UID'];
//1. Add Pages 
// System_Module SystemModule Page_Name Hidden_Page_Name Page_URL Unique_Name SelectGroups ugrps
// Add System Module  //    SelectGroups

if(filter_has_var(INPUT_POST, "SubmitSystemModule")) {
  try {  
                
        $AddSystemModuleName = $common->CCStrip(ucwords(strtolower($_POST['AddSystemModuleName'])));
        $AddSystemID = $common->CCStrip($_POST['AddSystemID']);
        $AddSystemModuleURL = $common->CCStrip(strtolower($_POST['AddSystemModuleURL']));
        $AddSystemModuleIcon = $common->CCStrip(strtolower($_POST['AddSystemModuleIcon']));  
        $AddDisplayPosition = $common->CCStrip($_POST['AddDisplayPosition']);
        $AddUniqueName = $common->CCStrip($_POST['AddUniqueName']); 
        $SelectData = $_GET['il'];
        $common->Insert("INSERT INTO tbl_sys_module_child (par_id, name, url, m_active, group_access, linkicon, display_id) VALUES ('{$AddSystemID}', '{$AddSystemModuleName}', '{$AddSystemModuleURL}', '{$AddUniqueName}', '{$SelectData}', '{$AddSystemModuleIcon}', '{$AddDisplayPosition}')");
    }catch (Exception $e) {echo $e;}
}


if(filter_has_var(INPUT_POST, "Hidden_Page_Name")) {
  try {  
                
        //$ModuleName = $common->CCStrip($_POST['System_Module']);
        $MenuName = $common->CCStrip(strtolower($_POST['SystemModule']));
        $AddPageIcon = $common->CCStrip(strtolower($_POST['AddPageIcon']));
        $PageName = $common->CCStrip($_POST['Page_Name']);
        $URL = $common->CCStrip($_POST['Page_URL']);
        $Unique_Name = $common->CCStrip($_POST['Unique_Name']);
        $System_Module = $common->CCStrip($_POST['System_Module']); 
        $UGroups = $_GET['ugrps'];
        
        $SQL = "INSERT INTO tbl_modules_pages_access (mIconWebApp, par_id, name, url, m_active, group_access, isActive) VALUES ('{$AddPageIcon}', '{$MenuName}', '{$PageName}', '{$URL}', '{$Unique_Name}', '{$UGroups}', '1')";
        //echo $SQL;
        $common->Insert($SQL);

        $SuccessfulRegistration = 1;
    }

    catch (Exception $e) {echo $e;}
}
//2. Add Menu group access//Select_System Hidden_System_Name SystemModule SelectData
else if(filter_has_var(INPUT_POST, "Hidden_System_Name")) {
  try {      
        $Select_System = $common->CCStrip($_POST['Select_System']);
        $SystemModule = $common->CCStrip($_POST['SystemModule']);
        $SelectData = $_GET['il'];
        $common->Insert("UPDATE tbl_sys_module_child SET group_access = '{$SelectData}' WHERE id='{$SystemModule}' AND par_id = '{$Select_System}'");
        $SuccessfulRegistration = 1;
    }

    catch (Exception $e) {echo $e;}
}

//3. Edit Pages Access
//Edit_System_Menu ESystem_Module ESystemModule EditPageName EditMenu_URL EUnique_Name menu_group_access EditTModeStatus Hidden_Name
else if(filter_has_var(INPUT_POST, "Hidden_Name")) {
    try  
        {
            $ItemID = $common->CCStrip($_POST['Hidden_Name']);
            $SysID = $common->CCStrip($_POST['ESystem_Name']);
            $ModuleID = $common->CCStrip($_POST['ESystemModule']);
            $EditPageName = $common->CCStrip($_POST['EditPageName']);
            $EUnique_Name = $common->CCStrip($_POST['EUnique_Name']);
            $EPage_URL = $common->CCStrip($_POST['EditMenu_URL']);
            $EditTModeStatus = $common->CCStrip($_POST['EditTModeStatus']);
            $groups = isset($_POST['menu_group_access']) ? $_POST['menu_group_access'] : array();     
            $group_access=implode(",",$groups);

        $INSSQL = "UPDATE `tbl_modules_pages_access` SET `par_id` ='{$ModuleID}', name = '{$EditPageName}', url = '{$EPage_URL}', m_active = '{$EUnique_Name}', `group_access` ='{$group_access}', isActive = '{$EditTModeStatus}' WHERE `id` = '{$ItemID}';";
        $INSSQL2 = "UPDATE `tbl_sys_module_child` SET `par_id` ='{$SysID}' WHERE `id` = '{$ModuleID}';";
        //echo $INSSQL2;
        $common->Insert($INSSQL);
        $common->Insert($INSSQL2);
        } catch (Exception $e){echo $e;}
    }
// 4. Add Currency
// Currency_Name hidden_Currency_Name Currency_Code Currency_Symbol Currency_Icon
else if(filter_has_var(INPUT_POST, "hidden_Currency_Name")) {
    try  
        {
            $Currency_Name = $common->CCStrip($_POST['Currency_Name']);
            $Currency_Code = $common->CCStrip($_POST['Currency_Code']);
            $Currency_Symbol = $common->CCStrip($_POST['Currency_Symbol']);
            $Currency_Icon = $common->CCStrip($_POST['Currency_Icon']);

            $sql = $common->Insert("INSERT INTO tbl_currencies (currencyName, currency, symbol, icon, isActive) VALUES ('{$Currency_Name}', '{$Currency_Code}', '{$Currency_Symbol}', '{$Currency_Icon}', '1');");
            //$lastInsertId = $common->lastInsertId($sql);
            //echo $lastInsertId;
        } catch (Exception $e){echo $e;}
    }
// 5. Add User Group
else if(filter_has_var(INPUT_POST, "HiddenAddGroupName")) {
    try  
        {
            $AddGroupName = $common->CCStrip($_POST['AddGroupName']);
            $Description = $common->CCStrip($_POST['Description']);
            $sql = $common->Insert("INSERT INTO `tbl_usergroups` (usergroup_name, description, isActive) VALUES ('{$AddGroupName}', '{$Description}', '1');");
        } 
        catch (Exception $e){echo $e;}
    }
//6. Edit menu items
// ESystem_Module EMenu_Name EMenu_URL Hidden_EMenu_Name EWeb_Icon EMobile_Icon EUnique_Name menu_group_access
else if(filter_has_var(INPUT_POST, "Hidden_EMenu_Name")) {
//else if(isset($_GET["Hidden_EMenu_Name"])) {
    try  
        {
            $ItemID = $common->CCStrip($_POST['Hidden_EMenu_Name']);
            $ModuleID = $common->CCStrip($_POST['ESystem_Module']);
            $MenuName = $common->CCStrip($_POST['EMenu_Name']);
            $MenuURL = $common->CCStrip($_POST['EMenu_URL']);
            $WebIcon = $common->CCStrip($_POST['EWeb_Icon']);
            $MobileIcon = $common->CCStrip($_POST['EMobile_Icon']);
            $UniQueID = $common->CCStrip($_POST['EUnique_Name']);
            $ActiveStatus = $common->CCStrip($_POST['EditTModeStatus']);
            $groups = isset($_POST['menu_group_access']) ? $_POST['menu_group_access'] : array();     
            $group_access=implode(",",$groups);

            $SQL = "UPDATE `tbl_users_system_menus` SET mName = '{$MenuName}', mUrl = '{$MenuURL}', mIconWebApp = '{$WebIcon}', mIconMobileApp = '{$MobileIcon}', isActive = '{$ActiveStatus}', mActive = '{$UniQueID}', groupAccess = '{$group_access}', systems_module_id = '{$ModuleID}' WHERE `id` ='{$ItemID}';";
            //echo $SQL;
            $common->Insert($SQL);

        } 
        catch (Exception $e){echo $e;}
    }
//7. Add Attendant User Group //Name Hidden_AddGRP EMinLimit EMaxLimit
else if(filter_has_var(INPUT_POST, "Hidden_AddGRP")) {
    try  
        {
            $Name = $common->CCStrip($_POST['Name']);
            $EMinLimit = $common->CCStrip($_POST['MinLimit']);
            $EMaxLimit = $common->CCStrip($_POST['MaxLimit']);
            $sql = $common->Insert("INSERT INTO outlet_attendant_categories (name, minTransLimit, maxTransLimit, isActive) VALUES ('{$Name}', '{$EMinLimit}', '{$EMaxLimit}', '1');");
        } 
        catch (Exception $e){echo $e;}
    }
//8 Edit Memu Access //Edit_System_Menu ESystem_Name ESystemModule Emenu_group_access Hidden_ESystem_Module
else if(filter_has_var(INPUT_POST, "Hidden_ESystem_Module")) {
    try {
        $Select_System = $common->CCStrip($_POST['ESystem_Name']);
        $SystemModule = $common->CCStrip($_POST['ESystemModule']);
        $groups = isset($_POST['Emenu_group_access']) ? $_POST['Emenu_group_access'] : array();
        $group_access=implode(",",$groups);
        $sql = $common->Insert("UPDATE tbl_sys_module_child SET group_access = '{$group_access}' WHERE id='{$SystemModule}' AND par_id = '{$Select_System}';");
        $SuccessfulRegistration = 1;
    }

    catch (Exception $e) {echo $e;}
}
?>
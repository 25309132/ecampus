<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();

if(!isset($_SESSION['UID'])){
    header("location: ../index");
}

try {
    //Getting records (listAction)
    if ($_GET["action"] == "ulist") {
        if (isset($_REQUEST["SearchUName"])) {
            $SearchUName = $_REQUEST["SearchUName"];

            if (!empty($SearchUName)) {
                $where = "WHERE ts.names LIKE '%" . $SearchUName . "%' OR ts.email LIKE '%" . $SearchUName . "%' OR ts.phone LIKE '%" . $SearchUName . "%' ";
            } else {
                $where = "";
            }
        } else {
            $where = "";
        }
        //Get record count
        $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_users ts " . $where . " ;");

        //Get records from database
        $result = $common->GetRows("SELECT * FROM tbl_users ts " . $where . " ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

        // Add all records to an array
        foreach ($result as $row) {
            $rows[] = $row;
        }
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } elseif ($_GET["action"] == "GetPagesList") {
        if (isset($_REQUEST["SearchAccessName"])) {
            $SearchAccessName = $_REQUEST["SearchAccessName"];
            if (!empty($SearchAccessName)) {
                $where = "WHERE ss.sys_name LIKE '%" . $SearchAccessName . "%' OR us.name LIKE '%" . $SearchAccessName . "%' OR sm.name LIKE '%" . $SearchAccessName . "%' OR us.url LIKE '%" . $SearchAccessName . "%' AND ss.isActive = 1";
            } else {
                $where = "WHERE ss.isActive = 1";
            }
        } else {
            $where = "WHERE ss.isActive = 1";
        }
        // Get record count
        $recordCount = $common->CCGetDBValue("SELECT COUNT(us.id) AS RecordCount FROM tbl_modules_pages_access `us` LEFT JOIN tbl_sys_module_child `sm` ON `sm`.`id` = `us`.`par_id` LEFT JOIN tbl_sys_modules `ss` ON `ss`.`id` = `sm`.`par_id` " . $where . " ;");

        // Get records from database
        $result = $common->GetRows("SELECT `us`.`id` `pageid`, `us`.`par_id`, `us`.name `pagename`,  `us`.url,  `us`.`group_access`,  `us`.isActive,  `us`.m_active, `sm`.`name` `module_name`, `sm`.`id` `ModuleID`, `ss`.`sys_name` FROM tbl_modules_pages_access `us` LEFT JOIN tbl_sys_module_child `sm` ON `sm`.`id` = `us`.`par_id` LEFT JOIN tbl_sys_modules `ss` ON `ss`.`id` = `sm`.`par_id` " . $where . " ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

        // Add all records to an array
        foreach ($result as $row) {
            $rows[] = $row;
        }
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } // Get Listed Pages
    elseif ($_GET["GetAccessPageId"] >= 1) {
        $GetPageId = $_REQUEST["GetAccessPageId"];
        $GUserID = $_REQUEST["GUserID"];
        $where = " WHERE ts.userID = '" . $GUserID . "' AND ts.par_id = '" . $GetPageId . "' ";

        // Get record count
        $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_pages_actions ts " . $where . " ;");

        //Get records from database
        $result = $common->GetRows("SELECT ts.id AS PActionID, ts.canCreate, ts.canUpdate, ts.canDelete, ts.canView, ts.canApprove, ts.canReceive, ts.canDispatch, ts.canReject, ts.approvalLevel FROM tbl_pages_actions ts " . $where . " ; ");

        // Add all records to an array
        foreach ($result as $row) {
            $rows[] = $row;
        }
        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    } // Get Status
    elseif ($_GET["action"] == "status") {
        $result = $common->GetRows("SELECT statusname as DisplayText, id as Value FROM lookup_status");
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Options'] = $result;
        print json_encode($jTableResult);
    }
} catch (Exception $ex) {
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}

?>
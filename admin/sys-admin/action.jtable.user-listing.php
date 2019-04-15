<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
try {
//1. Get user List
	//3. Get Users list
if($_GET["action"] == "userslist") {
	if(isset($_REQUEST["GetTUserName"]) || isset($_REQUEST["GetTUserGroup"])) {
		$GetTUserName = $_REQUEST["GetTUserName"];
		$GetTUserGroup = $_REQUEST["GetTUserGroup"];
		if(!empty($GetTUserName) && !empty($GetTUserGroup)) {
			$where = "WHERE (su.names LIKE '%".$GetTUserName."%' OR su.idnumber LIKE '%".$GetTUserName."%') AND su.group_id = '{$GetTUserGroup}';";
		}
		elseif(!empty($GetTUserName) && empty($GetTUserGroup)) {
			$where = "WHERE su.names LIKE '%".$GetTUserName."%' OR su.idnumber LIKE '%".$GetTUserName."%';";
		}
		elseif(empty($GetTUserName) && !empty($GetTUserGroup)) {
			$where = "WHERE su.group_id = '{$GetTUserGroup}';";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " WHERE su.group_id";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_users `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_users `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	// Add all records to an array
	foreach($result as $row) {
		    $rows[] = $row;
	}
	//Return result to jTable
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['TotalRecordCount'] = $recordCount;
	$jTableResult['Records'] = $rows;
	print json_encode($jTableResult);
}
//Action get gender types 
elseif($_GET["action"] == "gender")
	{
		$result = $common->GetRows("SELECT gender as DisplayText, gender_id as Value FROM `lookup_gender`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
//Action get usergroups 
elseif($_GET["action"] == "usergroups")
	{
		$result = $common->GetRows("SELECT usergroup_name as DisplayText, usergroup_id as Value FROM `tbl_usergroups`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
//Action get statuses 
elseif($_GET["action"] == "status")
	{
		$result = $common->GetRows("SELECT statusname as DisplayText, id as Value FROM `lookup_status`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
}
catch(Exception $ex)
	{
	    //Return error message
		$jTableResult = array();
		$jTableResult['Result'] = "ERROR";
		$jTableResult['Message'] = $ex->getMessage();
		print json_encode($jTableResult);
	}
	
?>
<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
try {
//1. Get Language List
if($_GET["action"] == "grplist") {
	if(isset($_REQUEST["GetName"])) {
		$GetName = $_REQUEST["GetName"];
		
		if(!empty($GetName)) {
			$where = " WHERE ts.usergroup_name LIKE '%".$GetName."%';";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM `tbl_usergroups` ts ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM `tbl_usergroups` ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
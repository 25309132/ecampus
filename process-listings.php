<?php
//error_reporting(0);
include_once('sys/core/init.inc.php');
$common=new common();
$LoggedUserAdmission = $_SESSION['UName'];
$StudentID = $common->CCGetDBValue("SELECT id FROM tbl_students WHERE admission_number =  '".$LoggedUserAdmission."' ");
try {

	// 1. Get Students List
	if($_GET["action"] == "GetSudentsList") {
		
		if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SelectProgramme"])) {
			
			$SearchFNameP = $_REQUEST["SearchFNameP"];
			$SelectProgramme = $_REQUEST["SelectProgramme"];

			if(!empty($SearchFNameP) && !empty($SelectProgramme)) {
				$where = " WHERE isDeleted = 0 AND (su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%') AND su.application_type = '{$SelectProgramme}' AND `su`.`studentID` = '{$StudentID}' ";
			}
			else {
				$where = "WHERE `su`.`isDeleted` = 0 AND `su`.`studentID` = '{$StudentID}'";
			}
		}
		else {
			$where = " WHERE `su`.`isDeleted` = 0 AND `su`.`studentID` = '{$StudentID}'";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_fee_upload_log `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT * FROM tbl_fee_upload_log `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	// Get progtypes
	elseif($_GET["action"] == "paymentoptions")
	{
		$result = $common->GetRows("SELECT paymentOptionName AS DisplayText, id AS Value FROM `tbl_payment_options`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	else {

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
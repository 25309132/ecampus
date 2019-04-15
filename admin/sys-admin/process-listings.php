<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
try {
// 1. Facilities List
if($_GET["action"] == "GetFacilitiesList") {
	if(isset($_REQUEST["SearchFNameP"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		if(!empty($SearchFNameP)) {
			$where = "WHERE su.facilityName LIKE '%".$SearchFNameP."%' OR su.facilityTelephone LIKE '%".$SearchFNameP."%' OR su.facilityAddress LIKE '%".$SearchFNameP."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_facilites `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_facilites `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
} /// GetInsuranceFirmsList
// 2. Facility Departments List
if($_GET["action"] == "GetFacilityDeptList") {
	if(isset($_REQUEST["SearchFNameP"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		if(!empty($SearchFNameP)) {
			$where = "WHERE su.departmentName LIKE '%".$SearchFNameP."%' OR su.departmentCode LIKE '%".$SearchFNameP."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM setup_facility_departments `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM setup_facility_departments `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 3. Facility Department - Rooms List //     SearchFNameP
if($_GET["action"] == "GetFacilityDeptRoomsList") {
	if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SearchFID"]) || isset($_REQUEST["SearchDepartmentID"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		$SearchFID = $_REQUEST["SearchFID"];
		$SearchDepartmentID = $_REQUEST["SearchDepartmentID"];

		if(!empty($SearchFNameP) && empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.roomName LIKE '%".$SearchFNameP."%' OR su.roomCode LIKE '%".$SearchFNameP."%'  ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.roomName LIKE '%".$SearchFNameP."%' OR su.roomCode LIKE '%".$SearchFNameP."%'  AND  su.roomFacilityID ='{$SearchFID}' ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.roomName LIKE '%".$SearchFNameP."%' OR su.roomCode LIKE '%".$SearchFNameP."%'  AND  su.roomFacilityID ='{$SearchFID}'  AND  su.roomDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.roomFacilityID ='{$SearchFID}'  AND  su.roomDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE  su.roomDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(!empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.roomName LIKE '%".$SearchFNameP."%' OR su.roomCode LIKE '%".$SearchFNameP."%'  AND  su.roomDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.roomDepartmentID ='{$SearchDepartmentID}' ";
		}
		else {
			$where = "";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM setup_facility_rooms `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM setup_facility_rooms `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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


// 4. Procedure Categories List
if($_GET["action"] == "GetProcedureCategoriesList") {

	if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SearchFID"]) || isset($_REQUEST["SearchDepartmentID"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		$SearchFID = $_REQUEST["SearchFID"];
		$SearchDepartmentID = $_REQUEST["SearchDepartmentID"];

		if(!empty($SearchFNameP) && empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryName LIKE '%".$SearchFNameP."%' OR su.procedureCategoryCode LIKE '%".$SearchFNameP."%'  ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryName LIKE '%".$SearchFNameP."%' OR su.procedureCategoryCode LIKE '%".$SearchFNameP."%'  AND  su.procedureCategoryFacilityID ='{$SearchFID}' ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryName LIKE '%".$SearchFNameP."%' OR su.procedureCategoryCode LIKE '%".$SearchFNameP."%'  AND  su.procedureCategoryFacilityID ='{$SearchFID}'  AND  su.procedureCategoryDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryFacilityID ='{$SearchFID}'  AND  su.procedureCategoryDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE  su.procedureCategoryDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(!empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryName LIKE '%".$SearchFNameP."%' OR su.procedureCategoryCode LIKE '%".$SearchFNameP."%'  AND  su.procedureCategoryDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureCategoryDepartmentID ='{$SearchDepartmentID}' ";
		}
		else {
			$where = "";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM setup_procedure_categories `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM setup_procedure_categories `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 5. Procedures List
if($_GET["action"] == "GetProceduresList") {

	if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SearchFID"]) || isset($_REQUEST["SearchDepartmentID"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		$SearchFID = $_REQUEST["SearchFID"];
		$SearchDepartmentID = $_REQUEST["SearchDepartmentID"];

		if(!empty($SearchFNameP) && empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureName LIKE '%".$SearchFNameP."%' OR su.procedureCode LIKE '%".$SearchFNameP."%'  ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureName LIKE '%".$SearchFNameP."%' OR su.procedureCode LIKE '%".$SearchFNameP."%'  AND  su.procedureFacilityID ='{$SearchFID}' ";
		}
		elseif(!empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureName LIKE '%".$SearchFNameP."%' OR su.procedureCode LIKE '%".$SearchFNameP."%'  AND  su.procedureFacilityID ='{$SearchFID}'  AND  su.procedureDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && !empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureFacilityID ='{$SearchFID}'  AND  su.procedureDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE  su.procedureDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(!empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureName LIKE '%".$SearchFNameP."%' OR su.procedureCode LIKE '%".$SearchFNameP."%'  AND  su.procedureDepartmentID ='{$SearchDepartmentID}' ";
		}
		elseif(empty($SearchFNameP) && empty($SearchFID) && !empty($SearchDepartmentID)) {
			$where = "WHERE su.procedureDepartmentID ='{$SearchDepartmentID}' ";
		}
		else {
			$where = "";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM setup_procedures `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT su.*, FORMAT(procedureCashCharge, 2) AS procedureCashCharge, FORMAT(procedureInsuranceCharge, 2) AS procedureInsuranceCharge FROM setup_procedures `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 6. Get Lab Test Categories
if($_GET["action"] == "GLTestCategoriesList") {
	if(isset($_REQUEST["SearchLTCName"])) {
		$SearchLTCName = $_REQUEST["SearchLTCName"];
		if(!empty($SearchLTCName)) {
			$where = "WHERE su.ltCategoryName LIKE '%".$SearchLTCName."%' OR su.ltCategoryDescription LIKE '%".$SearchLTCName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_test_categories `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM lab_test_categories `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
// 7. Get Lab Test Sample Specimen
if($_GET["action"] == "GLSampleSpecimenList") {
	if(isset($_REQUEST["SearchSSName"])) {
		$SearchSSName = $_REQUEST["SearchSSName"];
		if(!empty($SearchSSName)) {
			$where = "WHERE su.ltSpecimenName LIKE '%".$SearchSSName."%' OR su.ltSpecimenDescription LIKE '%".$SearchSSName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_sample_specimen `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM lab_sample_specimen `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 8. Get Lab Test Units 
if($_GET["action"] == "GLSpecimenTUnitList") {
	if(isset($_REQUEST["SearchSTUnitName"])) {
		$SearchSTUnitName = $_REQUEST["SearchSTUnitName"];
		if(!empty($SearchSTUnitName)) {
			$where = "WHERE su.labTestUnitName LIKE '%".$SearchSTUnitName."%' OR su.labTestUnitDescription LIKE '%".$SearchSTUnitName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_test_units `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM lab_test_units `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 9. Get Lab Tests 
if($_GET["action"] == "GLSpecimenTestsList") {
	if(isset($_REQUEST["SearchSTestsName"])) {
		$SearchSTestsName = $_REQUEST["SearchSTestsName"];
		if(!empty($SearchSTestsName)) {
			$where = "WHERE su.testName LIKE '%".$SearchSTestsName."%' OR su.testDescription LIKE '%".$SearchSTestsName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_specimen_tests `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT su.*, FORMAT(su.testCashAmount, 2) AS testCashAmount, FORMAT(su.testInsuranceAmount, 2) AS testInsuranceAmount  FROM lab_specimen_tests `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 10. Refernce Ranges List
if($_GET["action"] == "GLSpecimenTestsRefRangeList") {
	if(isset($_REQUEST["SearchSReferenceName"])) {
		$SearchSReferenceName = $_REQUEST["SearchSReferenceName"];
		if(!empty($SearchSReferenceName)) {
			$where = "WHERE su.testName LIKE '%".$SearchSReferenceName."%' OR su.testDescription LIKE '%".$SearchSReferenceName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_specimen_tests `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT su.*, FORMAT(su.testCashAmount, 2) AS testCashAmount, FORMAT(su.testInsuranceAmount, 2) AS testInsuranceAmount  FROM lab_specimen_tests `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

// 10. Get Insurance Firms List
if($_GET["action"] == "GetInsuranceFirmsList") {
	if(isset($_REQUEST["SearchIFNameP"])) {
		$SearchIFNameP = $_REQUEST["SearchIFNameP"];
		if(!empty($SearchIFNameP)) {
			$where = "WHERE su.insuranceName LIKE '%".$SearchIFNameP."%' OR su.insuranceTelephone LIKE '%".$SearchIFNameP."%' OR su.insuranceAddress LIKE '%".$SearchIFNameP."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_insurance_firms `su` ".$where." ;");
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_insurance_firms `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
// 11. Get Lab Test Sample Specimen Sub Tests
elseif($_GET["action"] == "GLSpecimenSubTestsList") {
	if(isset($_REQUEST["SearchSSubTestsName"])) {
		$SearchSSubTestsName = $_REQUEST["SearchSSubTestsName"];
		if(!empty($SearchSSubTestsName)) {
			$where = "WHERE su.subTestName LIKE '%".$SearchSSubTestsName."%' OR su.subTestDescription LIKE '%".$SearchSSubTestsName."%'  ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	// Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lab_sub_test_results `su` ".$where." ;");
	// Get records from database
	$result = $common->GetRows("SELECT * FROM lab_sub_test_results `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	// Add all records to an array
	foreach($result as $row) {
		    $rows[] = $row;
	}
	// Return result to jTable
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['TotalRecordCount'] = $recordCount;
	$jTableResult['Records'] = $rows;
	print json_encode($jTableResult);
}
// Get Facility Types
elseif($_GET["action"] == "GetFacilityType")
	{
		$result = $common->GetRows("SELECT facilityTypeName AS DisplayText, id AS Value FROM `setup_facility_types`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
// Get Listed Facilities
elseif($_GET["action"] == "GetFacilityID")
	{
		$result = $common->GetRows("SELECT facilityName as DisplayText, id as Value FROM `tbl_facilites`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}

// Get Facility Department ID 
elseif($_GET["action"] == "GetFacilityDeptID")
	{
		$result = $common->GetRows("SELECT departmentName as DisplayText, id as Value FROM `setup_facility_departments`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
// Get Facility Procedure Category ID 
elseif($_GET["action"] == "GetProcedureCategoryID")
	{
		$result = $common->GetRows("SELECT procedureCategoryName as DisplayText, id as Value FROM `setup_procedure_categories`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
// Get Facility Gender ID 
elseif($_GET["action"] == "GetGenderID")
	{
		$result = $common->GetRows("SELECT gender as DisplayText, id as Value FROM `lookup_gender`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
// Get Lab Test Category ID
elseif($_GET["action"] == "LSCategoryID")
	{
		$result = $common->GetRows("SELECT ltCategoryName as DisplayText, id as Value FROM `lab_test_categories`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
// Get Lab Samples 
elseif($_GET["action"] == "LSTestSampleID")
	{
		$result = $common->GetRows("SELECT ltSpecimenName as DisplayText, id as Value FROM `lab_sample_specimen`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}

// Get Lab Specimen Sub Sample ID 
elseif($_GET["action"] == "LSampleSubTestSampleID")
	{
		$result = $common->GetRows("SELECT testName as DisplayText, id as Value FROM `lab_specimen_tests`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}

// Action get statuses 
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
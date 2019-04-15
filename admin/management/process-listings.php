<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$LoggedUserGroupID = $_SESSION['GrpID'];

try {

// 1. Get Students Aplication List
if($_GET["action"] == "GetStudentsList") {
	
	if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SelectProgramme"])) {
		
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		$SelectProgramme = $_REQUEST["SelectProgramme"];
		$GetUserRole = $_REQUEST["SelectProgramme"];

		//Get approval Levels
		if(!empty($SearchFNameP) && !empty($SelectProgramme)) {
			$where = " WHERE (su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%') AND su.application_type = '{$SelectProgramme}' ";
		}
		elseif(!empty($SearchFNameP) && empty($SelectProgramme)) {
			$where = " WHERE (su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%') ";
		}
		elseif(empty($SearchFNameP) && !empty($SelectProgramme)) {
			$where = " WHERE su.application_type = '{$SelectProgramme}' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM apl_student_application_details `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM apl_student_application_details `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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

// 2. Get Registered Students List
elseif($_GET["action"] == "GetRegisteredStudentsList") {
	
	if(isset($_REQUEST["SearchFNameP"])) {
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		//Get approval Levels
		if(!empty($SearchFNameP)) {
			$where = " WHERE su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_students `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_students `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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

// 2. Get Schools List
elseif($_GET["action"] == "schoollist") 
{
	if(isset($_REQUEST["SearchSchoolName"])) {
		$SearchSchoolName = $_REQUEST["SearchSchoolName"];
		if(!empty($SearchSchoolName)) {
			$where = "WHERE su.school_name LIKE '%".$SearchSchoolName."%' OR su.description LIKE '%".$SearchSchoolName."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_schools `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_schools `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//campuslist
elseif($_GET["action"] == "campuslist") {
	if(isset($_REQUEST["SearchCampusName"])) {
		$SearchCampusName = $_REQUEST["SearchCampusName"];
		if(!empty($SearchCampusName)) {
			$where = " WHERE su.campus_name LIKE '%".$SearchCampusName."%' OR su.description LIKE '%".$SearchCampusName."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_campuses `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_campuses `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//departmentlist
elseif($_GET["action"] == "departmentlist") {
	if(isset($_REQUEST["SearchDepartmentName"])) {
		$SearchDepartmentName = $_REQUEST["SearchDepartmentName"];
		if(!empty($SearchSchoolName) && !empty($SearchSchoolId)) {
			$where = " WHERE su.department_name LIKE '%".$SearchSchoolName."%' OR su.description LIKE '%".$SearchSchoolName."%' ";
		}
		elseif(!empty($SearchSchoolName) && empty($SearchSchoolId)) {
			$where = " WHERE su.department_name LIKE '%".$SearchSchoolName."%' OR su.description LIKE '%".$SearchSchoolName."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_departments `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_departments `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//examcenterlist
elseif($_GET["action"] == "examcenterlist") {
	if(isset($_REQUEST["SearchCampusName"])) {
		$SearchCampusName = $_REQUEST["SearchCampusName"];
		if(!empty($SearchCampusName)) {
			$where = " WHERE su.center_name LIKE '%".$SearchCampusName."%' OR su.center_address LIKE '%".$SearchCampusName."%' OR su.center_location LIKE '%".$SearchCampusName."%' OR su.center_contacts LIKE '%".$SearchCampusName."%' OR su.center_description LIKE '%".$SearchCampusName."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_exam_centers `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_exam_centers `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//uploadedresults
elseif($_GET["action"] == "uploadedresults") {
	if(isset($_REQUEST["SearchStudentReg"]) || isset($_REQUEST["SearchYearID"]) || isset($_REQUEST["SearchSemesterID"])) {
		$SearchStudentReg = $_REQUEST["SearchStudentReg"];
		$SearchYearID = $_REQUEST["SearchYearID"];
		$SearchSemesterID = $_REQUEST["SearchSemesterID"];
		if(!empty($SearchStudentReg) && !empty($SearchYearID) && !empty($SearchSemesterID)) {
			$where = " WHERE su.yearID = '{$SearchYearID}' AND su.semesterID = '{$SearchSemesterID}' AND su.studentRegNo LIKE '%".$SearchStudentReg."%' AND su.isDeleted = 0";
		}
		elseif(!empty($SearchStudentReg) && empty($SearchYearID) && empty($SearchSemesterID)) {
			$where = " WHERE su.studentRegNo LIKE '%".$SearchStudentReg."%' AND su.isDeleted = 0";
		}
		elseif(!empty($SearchStudentReg) && !empty($SearchYearID) && empty($SearchSemesterID)) {
			$where = " WHERE su.yearID = '{$SearchYearID}' AND su.studentRegNo LIKE '%".$SearchStudentReg."%' AND su.isDeleted = 0";
		}
		elseif(!empty($SearchStudentReg) && empty($SearchYearID) && !empty($SearchSemesterID)) {
			$where = " WHERE su.yearID = '{$SearchYearID}' AND su.studentRegNo LIKE '%".$SearchStudentReg."%' AND su.isDeleted = 0";
		}
		elseif(empty($SearchStudentReg) && !empty($SearchYearID) && !empty($SearchSemesterID)) {
			$where = " WHERE su.yearID = '{$SearchYearID}' AND su.semesterID = '{$SearchSemesterID}' su.isDeleted = 0";
		}
		elseif(empty($SearchStudentReg) && empty($SearchYearID) && !empty($SearchSemesterID)) {
			$where = " WHERE su.semesterID = '{$SearchSemesterID}' AND su.isDeleted = 0";
		}
		elseif(empty($SearchStudentReg) && !empty($SearchYearID) && empty($SearchSemesterID)) {
			$where = " WHERE su.yearID = '{$SearchYearID}' AND su.isDeleted = 0";
		}
		else {
			$where = " WHERE su.isDeleted = 0";
		}
	}
	else {
		$where = " WHERE su.isDeleted = 0";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_uploaded_exams `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_uploaded_exams `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//examfacilitators
elseif($_GET["action"] == "examfacilitators") {
	if(isset($_REQUEST["SearchCampusName"])) {
		$SearchCampusName = $_REQUEST["SearchCampusName"];
		if(!empty($SearchCampusName)) {
			$where = " WHERE su.facilitator_name LIKE '%".$SearchCampusName."%' OR su.contacts LIKE '%".$SearchCampusName."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_programme_facilitators `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_programme_facilitators `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
elseif($_GET["action"] == "GetAllSudentsList") {
	
	if(isset($_REQUEST["SearchFNameP"]) || isset($_REQUEST["SelectProgramme"])) {
		
		$SearchFNameP = $_REQUEST["SearchFNameP"];
		$SelectProgramme = $_REQUEST["SelectProgramme"];

		if(!empty($SearchFNameP) && !empty($SelectProgramme)) {
			$where = " WHERE (su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%') AND su.application_type = '{$SelectProgramme}' ";
		}
		elseif(!empty($SearchFNameP) && empty($SelectProgramme)) {
			$where = " WHERE (su.surname LIKE '%".$SearchFNameP."%' OR su.othernames LIKE '%".$SearchFNameP."%' OR su.idpassport LIKE '%".$SearchFNameP."%' OR su.personal_email LIKE '%".$SearchFNameP."%' OR su.phone_number LIKE '%".$SearchFNameP."%') ";
		}
		elseif(empty($SearchFNameP) && !empty($SelectProgramme)) {
			$where = " WHERE su.application_type = '{$SelectProgramme}' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_students `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_students `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
elseif ($_GET["GetMainProviderId"] >=1 ) 
{
    $GetMainProviderId = $_REQUEST['GetMainProviderId'];
    $where = " WHERE school_id = '{$GetMainProviderId}';";
    $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lookup_school_departments ts " . $where . " ;");
    //Get records from database
    $result = $common->GetRows("SELECT `ts`.*, `dp`.`description`, `dp`.`isActive` FROM lookup_school_departments ts INNER JOIN tbl_departments `dp` ON `dp`.`id` = `ts`.`department_id` " . $where . " ;");
    //Get records from database
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
}
elseif ($_GET["GetMainProgrammeId"] >=1 ) 
{
    $GetMainProgrammeId = $_REQUEST['GetMainProgrammeId'];
    $where = " WHERE programme_id = '{$GetMainProgrammeId}';";
    $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lookup_programmes_courses ts " . $where . " ;");
    //Get records from database
    $result = $common->GetRows("SELECT `ts`.*, `tc`.`course_name`, `tc`.`course_code`, FORMAT(`tc`.`course_price`, 0) AS `course_price`, `tc`.`isActive` FROM lookup_programmes_courses ts INNER JOIN tbl_courses `tc` ON `tc`.`id` = `ts`.`course_id` " . $where . " ;");
    //Get records from database
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
}

// Get School Programmes
elseif ($_GET["SchoolProgrammes"] >=1 ) 
{
    $SchoolProgrammes = $_REQUEST['SchoolProgrammes'];
    $where = " WHERE programme_id = '{$SchoolProgrammes}';";
    $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM lookup_campuses_programmes ts " . $where . " ;");
    //Get records from database
    $result = $common->GetRows("SELECT `ts`.*, `dp`.`campus_name`, `dp`.`description` AS `school_description`, `dp`.`isActive` FROM lookup_campuses_programmes ts INNER JOIN tbl_campuses `dp` ON `dp`.`id` = `ts`.`campus_id` " . $where . " ;");
    //Get records from database
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
}
//academic years
elseif($_GET["action"] == "academicyears") {
	if(isset($_REQUEST["SearchAcademicYear"])) {
		$SearchAcademicYear = $_REQUEST["SearchAcademicYear"];
		if(!empty($SearchAcademicYear)) {
			$where = " WHERE su.year LIKE '%".$SearchAcademicYear."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_academic_years `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_academic_years `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//academic years
elseif($_GET["action"] == "semesters") {
	if(isset($_REQUEST["SearchSemester"]) || isset($_REQUEST["SearchSemester"])) 
	{
		$SearchSemester = $_REQUEST["SearchSemester"];
		$SelectYearID = $_REQUEST["SelectYearID"];
		if(!empty($SearchSemester) && !empty($SelectYearID)) 
		{
			$where = " WHERE su.semester LIKE '%".$SearchSemester."%' AND su.year_id = '{$SelectYearID}' ";
		}
		else if (empty($SearchSemester) && !empty($SelectYearID))
		{
			$where = " WHERE su.year_id = '{$SelectYearID}' ";
		}
		else if(!empty($SearchSemester) && empty($SelectYearID)) 
		{
			$where = " WHERE su.semester LIKE '%".$SearchSemester."%' ";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_semesters `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_semesters `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//Programme Types
elseif($_GET["action"] == "programmetypes") {
	if(isset($_REQUEST["SearchProgrammeType"])) {
		$SearchSemester = $_REQUEST["SearchProgrammeType"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.type LIKE '%".$SearchSemester."%' OR su.description LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_programme_types `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_programme_types `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//Student Types
elseif($_GET["action"] == "studenttypes") {
	if(isset($_REQUEST["SearchProgrammeType"])) {
		$SearchSemester = $_REQUEST["SearchProgrammeType"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.StudentType LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_student_types `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_student_types `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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

//Student Statuses
elseif($_GET["action"] == "studetstatus") {
	if(isset($_REQUEST["SearchStudentStatus"])) {
		$SearchStudentStatus = $_REQUEST["SearchStudentStatus"];
		if(!empty($SearchStudentStatus)) {
			$where = " WHERE su.status LIKE '%".$SearchStudentStatus."%' AND su.isActive = 1";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_students_status `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_students_status `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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

//programmelist 
elseif($_GET["action"] == "programmelist") 
{
	if(isset($_REQUEST["SearchProgramme"])) {
		$SearchSemester = $_REQUEST["SearchProgramme"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.programme_name LIKE '%".$SearchSemester."%' OR su.description LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_programmes `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_programmes `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
// coursestatus
elseif($_GET["action"] == "coursestatus") 
{
	if(isset($_REQUEST["SearchStatusName"])) {
		$SearchSemester = $_REQUEST["SearchStatusName"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.status_name LIKE '%".$SearchSemester."%' OR su.description LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_course_status `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_course_status `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
// coursetype
elseif($_GET["action"] == "coursetype") 
{
	if(isset($_REQUEST["SearchCourseType"])) {
		$SearchSemester = $_REQUEST["SearchCourseType"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.course_type_name LIKE '%".$SearchSemester."%' OR su.description LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM  tbl_course_types `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM  tbl_course_types `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
//courseslist
elseif($_GET["action"] == "courseslist") 
{
	if(isset($_REQUEST["SearchCourseType"])) {
		$SearchSemester = $_REQUEST["SearchCourseType"];
		if(!empty($SearchSemester)) {
			$where = " WHERE su.course_name LIKE '%".$SearchSemester."%' OR su.course_code LIKE '%".$SearchSemester."%' OR su.description LIKE '%".$SearchSemester."%'";
		}
		else {
			$where = " ";
		}
	}
	else {
		$where = " ";
	}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM  tbl_courses `su` ".$where." ;");
	
	//Get records from database
	$result = $common->GetRows("SELECT * FROM tbl_courses `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
	
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
	elseif($_GET["action"] == "progtypes")
	{
		$result = $common->GetRows("SELECT type AS DisplayText, id AS Value FROM `tbl_programme_types`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Facility Types
	elseif($_GET["action"] == "GetGender")
	{
		$result = $common->GetRows("SELECT gender AS DisplayText, id AS Value FROM `lookup_gender`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Facility Types
	elseif($_GET["action"] == "departments")
	{
		$result = $common->GetRows("SELECT department_name AS DisplayText, id AS Value FROM `tbl_departments`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Year
	elseif($_GET["action"] == "getyears")
	{
		$result = $common->GetRows("SELECT year AS DisplayText, id AS Value FROM `tbl_academic_years`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Semester
	elseif($_GET["action"] == "getsemesters")
	{
		$result = $common->GetRows("SELECT semester AS DisplayText, id AS Value FROM `tbl_semesters`");
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

	// Action get statuses 
	elseif($_GET["action"] == "studentstatuses")
	{
		$result = $common->GetRows("SELECT status as DisplayText, id as Value FROM `tbl_students_status`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}

	// Action get Schools 
	elseif($_GET["action"] == "schools")
	{
		$result = $common->GetRows("SELECT school_name as DisplayText, id as Value FROM `tbl_schools`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Action get Schools 
	elseif($_GET["action"] == "campuses")
	{
		$result = $common->GetRows("SELECT campus_name as DisplayText, id as Value FROM `tbl_campuses`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Action get Programmes 
	elseif($_GET["action"] == "programmelisting")
	{
		$result = $common->GetRows("SELECT programme_name as DisplayText, id as Value FROM `tbl_programmes`");
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
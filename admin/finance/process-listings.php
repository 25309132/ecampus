<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();

try {

	// 1. Get Students List
	if($_GET["action"] == "paymentlist") {
		
		if(isset($_REQUEST["SearchPaymentInfo"])) {
			
			$SearchFNameP = $_REQUEST["SearchPaymentInfo"];
			if(!empty($SearchFNameP)) {
				$where = " WHERE (su.paymentReference LIKE '%".$SearchFNameP."%' OR `ts`.`surname` LIKE '%".$SearchFNameP."%' OR `ts`.`othernames` LIKE '%".$SearchFNameP."%' OR `ts`.`admission_number` LIKE '%".$SearchFNameP."%')";
			}
			else {
				$where = " ";
			}
		}
		else {
			$where = " ";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_fee_upload_log `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT `su`.*, `ts`.`surname`, `ts`.`othernames`, `ts`.`admission_number` FROM tbl_fee_upload_log `su` LEFT JOIN tbl_students ts ON `ts`.`id` = `su`.`studentID` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	
	//New students payments
	elseif($_GET["action"] == "newstudentspaymentlist") {
		
		if(isset($_REQUEST["SearchPaymentInfo"])) {
			
			$SearchFNameP = $_REQUEST["SearchPaymentInfo"];
			if(!empty($SearchFNameP)) {
				$where = " WHERE (`su`.`paymentReference` LIKE '%".$SearchFNameP."%' OR `su`.`studentEmail` LIKE '%".$SearchFNameP."%')";
			}
			else {
				$where = " ";
			}
		}
		else {
			$where = " ";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM fin_new_students_payments `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT * FROM fin_new_students_payments `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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

	//Statutory Payments
	elseif($_GET["action"] == "studentstatutorylist") {
		
		if(isset($_REQUEST["SearchPaymentInfo"])) {
			
			$SearchFNameP = $_REQUEST["SearchPaymentInfo"];
			if(!empty($SearchFNameP)) {
				$where = " WHERE (su.transactionReferenceCode LIKE '%".$SearchFNameP."%' OR `ts`.`surname` LIKE '%".$SearchFNameP."%' OR `ts`.`othernames` LIKE '%".$SearchFNameP."%' OR `ts`.`admission_number` LIKE '%".$SearchFNameP."%')";
			}
			else {
				$where = " ";
			}
		}
		else {
			$where = " ";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM fin_statutory_fee_payments `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT `su`.*, `ts`.`surname`, `ts`.`othernames`, `ts`.`admission_number` FROM fin_statutory_fee_payments `su` LEFT JOIN tbl_students ts ON `ts`.`id` = `su`.`student_id` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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

	//Students Credit Payments
	elseif($_GET["action"] == "studentscredits") {
		
		if(isset($_REQUEST["SearchPaymentInfo"])) {
			
			$SearchFNameP = $_REQUEST["SearchPaymentInfo"];
			if(!empty($SearchFNameP)) {
				$where = " WHERE (su.transactionReferenceCode LIKE '%".$SearchFNameP."%' OR `ts`.`surname` LIKE '%".$SearchFNameP."%' OR `ts`.`othernames` LIKE '%".$SearchFNameP."%' OR `ts`.`admission_number` LIKE '%".$SearchFNameP."%')";
			}
			else {
				$where = " ";
			}
		}
		else {
			$where = " ";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM fin_students_credits_log `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT `su`.*, `ts`.`surname`, `ts`.`othernames`, `ts`.`admission_number` FROM fin_students_credits_log `su` LEFT JOIN tbl_students ts ON `ts`.`id` = `su`.`studentID` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	//GetStudentCreditsId
	elseif ($_GET["GetStudentCreditsId"] >=1) 
	{
		$GetStudentCreditsId = $_REQUEST['GetStudentCreditsId'];
	    $where = " WHERE ts.studentID = '{$GetStudentCreditsId}';";
	    $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM fin_students_credits_log ts " . $where . ";");
	    //Get records from database
	    $result = $common->GetRows("SELECT * FROM fin_students_credits_log ts ". $where ." ;");
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
	elseif ($_GET["GetStudentPaymentId"] >=1) 
	{
		$GetStudentPaymentId = $_REQUEST['GetStudentPaymentId'];
	    $where = " WHERE ts.studentID = '{$GetStudentPaymentId}';";
	    $recordCount = $common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_fee_upload_log ts " . $where . ";");
	    //Get records from database
	    $result = $common->GetRows("SELECT * FROM tbl_fee_upload_log ts ". $where ." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

	elseif ($_GET["action"] == "paymentoptions") 
	{
		
		if(isset($_REQUEST["SearchPaymentInfo"])) {
			
			$SearchFNameP = $_REQUEST["SearchPaymentInfo"];
			if(!empty($SearchFNameP)) {
				$where = " WHERE `su`.`paymentOptionName` LIKE '%".$SearchFNameP."%' OR `su`.`paymentOptionDescription` LIKE '%".$SearchFNameP."%' ";
			}
			else {
				$where = " ";
			}
		}
		else {
			$where = " ";
		}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM tbl_payment_options `su` ".$where.";");
		
		//Get records from database
		$result = $common->GetRows("SELECT * FROM tbl_payment_options `su` ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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

	//Get Yearid
	elseif($_GET["action"] == "yearid")
	{
		$result = $common->GetRows("SELECT year AS DisplayText, id AS Value FROM `tbl_academic_years`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get progtypes
	elseif($_GET["action"] == "paymentoptionsnames")
	{
		$result = $common->GetRows("SELECT paymentOptionName AS DisplayText, id AS Value FROM `tbl_payment_options`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Student
	elseif($_GET["action"] == "studentdetails")
	{
		$result = $common->GetRows("SELECT admission_number AS DisplayText, id AS Value FROM `tbl_students`");
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options']=$result;
		print json_encode($jTableResult);
	}
	// Get Status
	elseif($_GET["action"] == "status")
	{
		$result = $common->GetRows("SELECT statusname AS DisplayText, id AS Value FROM `lookup_status`");
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
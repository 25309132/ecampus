<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
try
{
//Getting Record List (listAction) 
	//1. Get grade list
	if($_GET["action"] == "gradelist")
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				//$GetTmodeDescription = $_REQUEST["GetTmodeDescription"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE ts.grade_name LIKE '%".$GetTRouteName."%' ";
					}
				
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_job_grades ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_job_grades ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
// 2. Get Department List 
if($_GET["action"] == "deptlist") 
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				$GetTRouteDescription = $_REQUEST["GetTRouteDescription"];

				if(!empty($GetTRouteName)) {
						$where = "WHERE ts.department_name LIKE '%".$GetTRouteName."%' ";
				}
				else {
						$where = "isactive = 1";
				}
			}
		else
			{
				$where = "";
			}
		//Get record count
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_departments ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_departments ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
// 3. Get Job Title List 
if($_GET["action"] == "joblist") {
	if(isset($_REQUEST["GetTRouteName"])) 
		{
			$GetTRouteName = $_REQUEST["GetTRouteName"];
			if(!empty($GetTRouteName)) {
				$where = "WHERE ts.job_name LIKE '%".$GetTRouteName."%' ";
			}
			else {
				$where = "";
			}
		}
	else
		{
			$where = "";
		}
	//Get record count
	$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_job_titles ts ".$where." ;");

	//Get records from database
	$result = $common->GetRows("SELECT * FROM hrims_job_titles ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");

	// Add all records to an array
	foreach($result as $row)
		{
		    $rows[] = $row;
		}
	//Return result to jTable
	$jTableResult = array();
	$jTableResult['Result'] = "OK";
	$jTableResult['TotalRecordCount'] = $recordCount;
	$jTableResult['Records'] = $rows;
	print json_encode($jTableResult);
}
// 4. Drivers List
if($_GET["action"] == "emptypelist")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE ts.employment_type LIKE '%".$GetTRouteName."%' ";
					}
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_employment_types ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_employment_types ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}

// 5. Employment Status
if($_GET["action"] == "emplist")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE ts.employment_status LIKE '%".$GetTRouteName."%' ";
					}
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_employment_status ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_employment_status ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
// 6. Shifts
if($_GET["action"] == "shifts")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE ts.shift_name LIKE '%".$GetTRouteName."%' ";
					}
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_work_shifts ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_work_shifts ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
// 7. Leave Types
if($_GET["action"] == "leavetypes")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE `lt`.`leave_name` LIKE '%".$GetTRouteName."%' ";
					}
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_leave_types ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT `lt`.`id`, `lt`.`leave_name`,
									CASE 
									  WHEN `lt`.`paid` = 1 THEN 'Yes'
									  WHEN `lt`.`paid` = 0 THEN 'No'
									  ELSE 'Undefined' 
									END as `paid`,
									CASE 
									  WHEN `lt`.`situational` = 1 THEN 'Yes'
									  WHEN `lt`.`situational` = 0 THEN 'No'
									  ELSE 'Undefined' 
									END as `situational`, `lt`.`description`, `lt`.`isactive`
									FROM hrims_leave_types lt ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
// 8. Working Days
if($_GET["action"] == "wdays")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName))
					{
						$where = "WHERE ts.working_day LIKE '%".$GetTRouteName."%' ";
					}
				else
					{
						$where = "";
					}
			}
		else
			{
				$where = "";
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_working_days ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT * FROM hrims_working_days ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}	
// 9. Employee Listings
if($_GET["action"] == "employeelist")    
	{
		if(isset($_REQUEST["GetTRouteName"])) 
			{
				$GetTRouteName = $_REQUEST["GetTRouteName"];
				if(!empty($GetTRouteName) && empty($GetEmployeeNo))
					{
						$where = "WHERE ts.surname LIKE '%".$GetTRouteName."%' OR ts.firstname LIKE '%".$GetTRouteName."%' OR ts.middlename LIKE '%".$GetTRouteName."%'";
					}
				else if (empty($GetTRouteName) && !empty($GetEmployeeNo))
					{
						$where = "WHERE ts.employee_number LIKE '%".$GetEmployeeNo."%'";
					}
				else if (!empty($GetTRouteName) && !empty($GetEmployeeNo))
					{
						$where = "WHERE (ts.surname LIKE '%".$GetTRouteName."%' OR ts.firstname LIKE '%".$GetTRouteName."%' OR ts.middlename LIKE '%".$GetTRouteName."%') AND ts.employee_number LIKE '%".$GetEmployeeNo."%' ";
					}
				else
					{
						$where = "";
					}
			}
		//Get record count   
		$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM hrims_employees ts ".$where." ;");

		//Get records from database
		$result = $common->GetRows("SELECT concat(`ts`.`firstname`,' ',`ts`.`middlename`, ' ', `ts`.`surname`) AS names, ts.* FROM hrims_employees ts ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		// Add all records to an array
		foreach($result as $row)
			{
			    $rows[] = $row;
			}
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Action get status isactive
	if($_GET["action"] == "status")
		{
			$result = $common->GetRows("SELECT statusname as DisplayText, id as Value FROM ftms_transport_status");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options']=$result;
			print json_encode($jTableResult);
		}
	//Action get status isactive
	if($_GET["action"] == "empstatus")
		{
			$result = $common->GetRows("SELECT employment_status as DisplayText, id as Value FROM hrims_employment_status WHERE isactive = 1");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options']=$result;
			print json_encode($jTableResult);
		}
	//Action get wdtypes 
	else if($_GET["action"] == "wdtypes")
		{
			$result = $common->GetRows("SELECT type_name as DisplayText, id as Value FROM hrims_working_day_types");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options']=$result;
			print json_encode($jTableResult);
		}
	//Action get wdtypes 
	else if($_GET["action"] == "gender")
		{
			$result = $common->GetRows("SELECT gender as DisplayText, gender_id as Value FROM `lookup_gender`");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options']=$result;
			print json_encode($jTableResult);
		}
	//Action get job hierarchy
	else if($_GET["action"] == "hierarchy")
		{
			$result = $common->GetRows("SELECT job_name as DisplayText, id as Value FROM hrims_job_titles");
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['Options']=$result;
			print json_encode($jTableResult);
		}	
	//Deleting department record 
	else if($_GET["action"] == "deptdelete")
	    {
	        //Delete from database
	        $result=$common->Insert("UPDATE hrims_departments SET isactive = 0 WHERE id = " . $common->CCStrip($_POST["id"]) . ";");
	        //Return result to jTable
	        $jTableResult = array();
	        $jTableResult['Result'] = "OK";
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
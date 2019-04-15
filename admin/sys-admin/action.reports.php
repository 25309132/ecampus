<?php
error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
try
{
	//Getting records (listAction) 
	if($_GET["action"] == "finesreport")
		{
			if(isset($_REQUEST["SearchMemberNameReport"]) || isset($_REQUEST["SearchMemberAdmnNo"])) 
				{
					$SearchMemberNameReport = $_REQUEST["SearchMemberNameReport"];
					$SearchMemberAdmnNo = $_REQUEST["SearchMemberAdmnNo"];
					if(!empty($SearchMemberNameReport) && empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.firstname LIKE '%".$SearchMemberNameReport."%' OR ts.lastname LIKE '%".$SearchMemberNameReport."%'";
						}
					elseif(empty($SearchMemberNameReport) && !empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.regno LIKE '%".$SearchMemberAdmnNo."%' ";
						}
					elseif(!empty($SearchMemberNameReport) && !empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.regno LIKE '%".$SearchMemberAdmnNo."%' AND (ts.firstname LIKE '%".$SearchMemberNameReport."%' OR ts.lastname LIKE '%".$SearchMemberNameReport."%') ";
						}
					else
						{
							$where = "";
						}
				}
			else
				{
					$where = " "; 
				}
			//Get record count
			$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM libms_penalties_journal lib ".$where." ;");

			//DATE_FORMAT(NOW(),'%d %b %Y %T:%f') 
			//Get records from database
			$result = $common->GetRows("SELECT lib.id AS issuedbid, DATE_FORMAT(lib.datetimestamp, '%d %b %Y') AS datetimestamp, lib.libpenaltyamount, ts.firstname, ts.lastname, ts.id, ts.regno, ts.phone, ts.email, ts.sex, ts.photourl, lib.libbook_accession AS BkAccessionNo, CONCAT(glb.book_name, ' (', lib.libbook_accession, ')') AS bookdetails  FROM libms_members ts INNER JOIN libms_penalties_journal lib ON lib.libmember_regno = ts.regno JOIN libms_books glb ON glb.accession_no = lib.libbook_accession ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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

	// Retrieve Issued Books Report 
	if($_GET["action"] == "libactivityreport")
		{
			if(isset($_REQUEST["SearchMemberNameReport"]) || isset($_REQUEST["SearchMemberAdmnNo"])) 
				{
					$SearchMemberNameReport = $_REQUEST["SearchMemberNameReport"];
					$SearchMemberAdmnNo = $_REQUEST["SearchMemberAdmnNo"];
					if(!empty($SearchMemberNameReport) && empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.firstname LIKE '%".$SearchMemberNameReport."%' OR ts.lastname LIKE '%".$SearchMemberNameReport."%'";
						}
					elseif(empty($SearchMemberNameReport) && !empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.regno LIKE '%".$SearchMemberAdmnNo."%'  AND lib.penalty > 0";
						}
					elseif(!empty($SearchMemberNameReport) && !empty($SearchMemberAdmnNo))
						{
							$where = "WHERE ts.regno LIKE '%".$SearchMemberAdmnNo."%' AND (ts.firstname LIKE '%".$SearchMemberNameReport."%' OR ts.lastname LIKE '%".$SearchMemberNameReport."%') ";
						}
					else
						{
							$where = "";
						}
				}
			else
				{
					$where = " "; 
				}
			//Get record count
			$recordCount=$common->CCGetDBValue("SELECT COUNT(*) AS RecordCount FROM libms_issued_books lib ".$where." ;");

			//DATE_FORMAT(NOW(),'%d %b %Y %T:%f') 
			//Get records from database
			$result = $common->GetRows("SELECT DATEDIFF( cast(NOW()  AS date),lib.return_date)  AS GetODDays, DATE_FORMAT(lib.issue_date, '%d %b %Y') AS IssuedStartDate, DATE_FORMAT(lib.return_date, '%d %b %Y') AS TentativeReturnDate, lib.id AS issuedbid, ts.isindisciplined, ts.firstname, ts.lastname, ts.id, ts.regno, ts.phone, ts.email, ts.sex, ts.photourl, lib.penalty, lib.book_id AS BkAccessionNo, CONCAT(glb.book_name, ' (', lib.book_id, ')') AS bookdetails  FROM libms_members ts INNER JOIN libms_issued_books lib ON lib.member_id = ts.regno JOIN libms_books glb ON glb.accession_no = lib.book_id ".$where." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
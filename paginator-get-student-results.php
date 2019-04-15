<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include_once('sys/core/init.inc.php');
$common = new common();

if ($_POST) 
{
    $StudentID = $_SESSION['UName'];
    $SearchPatientName = $_REQUEST["SearchPatientName"];

    $page = $_REQUEST['page']; // Current page number
    if (!$page) {
        $page = 1;
    } else {
        $page = $_REQUEST['page'];
    }
    $per_page = $_REQUEST['per_page']; // Articles per page
    if (!$per_page) {
        $per_page = 9;
    } else {
        $per_page = $_REQUEST['per_page'];
    }

    if ($page != 1) {
        $start = ($page - 1) * $per_page;
    }
    else
    {
        $start = 0;
    }
    
    if(!empty($SearchPatientName))
    { 
        $SearchPatientName = " AND (ts.courseCode LIKE '%".$SearchPatientName."%')";
    }
    else
    {
        $SearchPatientName = " ";
    }
    
    $QUERY = "SELECT `ts`.*, `cs`.`year`, `sm`.`semester` FROM tbl_uploaded_exams ts LEFT JOIN tbl_academic_years `cs` ON `cs`.`id` = `ts`.`yearID` LEFT JOIN tbl_semesters `sm` ON `sm`.`id` = `ts`.`semesterID` WHERE `ts`.`studentRegNo` = '{$StudentID}' ".$SearchPatientName." LIMIT $start, $per_page";

    //echo $QUERY;
    $select = $common->GetRows($QUERY);
    
    $numArticlesQ = "SELECT `ts`.*, `cs`.`year`, `sm`.`semester` FROM tbl_uploaded_exams ts LEFT JOIN tbl_academic_years `cs` ON `cs`.`id` = `ts`.`yearID` LEFT JOIN tbl_semesters `sm` ON `sm`.`id` = `ts`.`semesterID` WHERE `ts`.`studentRegNo` = '{$StudentID}' ".$SearchPatientName." ";

    $numArticles = $common->CCGetDBValue($numArticlesQ);
    $numPage = ceil($numArticles / $per_page); 
    // Total number of page
    // We build the article list dfsd
    if ($numPage > 0) {
        $articleList = '';
        foreach ($select as $result) {
            $BID = $result['id'];
            $Year = $result['year']; 
            $Semester = $result['semester']; 
            $CourseCode = $result['courseCode'];
            $CatScore = $result['catScore'];
            $ExamScore = $result['examScore'];

            // End Looping Through the Data Retrieved
            $articleList .= '<tr id="ResultRow' . $BID . '">
                <td>' . $Year . '</td>
                <td>' . $Semester . '</td>
                <td>' . $CourseCode . '</td>
                <td>' . $CatScore . '</td>
                <td>' . $ExamScore . '</td>
                </tr>';

        } 
        $AccuJSScripts = '<script type="text/javascript">$(function(){$(".select2").select2();); $("#IncomeTypesTable").dataTable();}</script>';
        $dataBack = array('numPage' => $numPage, 'articleList' => $articleList, 'AccuJSScripts' => $AccuJSScripts);
        $dataBack = json_encode($dataBack);
        echo $dataBack;
    } else {
        $articleList = '<div class="row m_top_10"><div class="alert alert-danger m_top_10 accu-f-md" role="alert"><center><h4 class="t_align_c"><i class="fa fa-shield"></i><hr /><strong>Ooops!</strong> There are no items for your search! Please refine your search</h4></center></div></div>';
        $dataBack = array('numPage' => 0, 'articleList' => $articleList);
        $dataBack = json_encode($dataBack);
        echo $dataBack;
        exit;
    }
}
?>
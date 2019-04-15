<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include_once('sys/core/init.inc.php');
$common = new common();

if ($_POST) 
{
    $StudentID = $_SESSION['UID'];
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
        $SearchPatientName = " AND (ts.courseName LIKE '%".$SearchPatientName."%' OR cs.course_code LIKE '%".$SearchPatientName."%' OR cs.course_description LIKE '%".$SearchPatientName."%') ";
    }
    else
    {
        $SearchPatientName = " ";
    }
    
    $QUERY = "SELECT * FROM tbl_student_registered_courses ts LEFT JOIN tbl_courses `cs` ON `cs`.`id` = `ts`.`courseID` WHERE `ts`.`UID` = '{$StudentID}' ".$SearchPatientName." LIMIT $start, $per_page";
    //echo $QUERY;
    $select = $common->GetRows($QUERY);
    
    $numArticlesQ = "SELECT * FROM tbl_student_registered_courses ts LEFT JOIN tbl_courses `cs` ON `cs`.`id` = `ts`.`courseID` WHERE `ts`.`UID` = '{$StudentID}' ".$SearchPatientName." ";

    $numArticles = $common->CCGetDBValue($numArticlesQ);
    $numPage = ceil($numArticles / $per_page); // Total number of page
    // We build the article list dfsd
    if ($numPage > 0) {
        $articleList = '';
        foreach ($select as $result) {
            $BID = $result['id'];
            $FCourseName = $result['courseName']; 
            $FCourseCode = $result['course_code']; 
            $FCourseFee = $result['courseFee'];
            $FDateLogged = $result['dateLogged'];
            $FTransactionReferenceCode = $result['transactionReferenceCode'];

            // End Looping Through the Data Retrieved
            $articleList .= '<tr id="ResultRow' . $BID . '">
                <td>' . $FCourseName . '</td>
                <td>' . $FCourseCode . '</td>
                <td>' . number_format($FCourseFee,0) . '</td>
                <td>' . $FTransactionReferenceCode . '</td>
                <td>' . $FDateLogged . '</td>
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
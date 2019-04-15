<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include_once('../sys/core/init.inc.php');
$common = new common();

if ($_POST) {
    // Get Current
    //$StoreID = $_REQUEST['FStoreID'];
    $SelectYear = $_REQUEST["SelectYear"];
    $SelectSemester = $_REQUEST["SelectSemester"];
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
    
    $SQL = "SELECT `GLT`.`course_id` AS CourseID, `GLT`.`programme_id` AS ProgrammeID FROM lookup_programmes_courses GLT WHERE `GLT`.`isActive` = 1 AND `GLT`.`course_id` NOT IN (SELECT course_id FROM tbl_available_courses WHERE semester_id = '{$SelectSemester}' AND year_id = '{$SelectYear}')";
    //echo $SQL;

    $PSysTag = $common->CCGetDBValue("SELECT id FROM tbl_available_courses WHERE semester_id = '{$SelectSemester}' AND year_id = '{$SelectYear}' ORDER BY id DESC LIMIT 1");
    
    if(empty($PSysTag))
    {
        $PSysTag = 0;
    }
    
    $CheckData = $common->GetRows($SQL);
    foreach ($CheckData as $ED) 
    {
        $PSysTag++;
        $CourseID = $ED['CourseID'];
        $programmeID = $ED['ProgrammeID'];

        $common->Insert("INSERT INTO `tbl_available_courses` (`course_id`, `year_id`, `semester_id`, `programme_id`, `added_by`) VALUES ('{$CourseID}', '{$SelectYear}', '{$SelectSemester}', '{$programmeID}', '".$_SESSION['UserEmail']."')");

    } 

    if(!empty($SearchPatientName))
    { 
        $SearchPatientName = " WHERE (GTSC.course_name LIKE '%".$SearchPatientName."%' OR GTSC.course_code LIKE '%".$SearchPatientName."%') AND GSI.year_id = '{$SelectYear}' AND GSI.semester_id = '{$SelectSemester}' ";
    }
    else
    {
        $SearchPatientName = " WHERE GSI.year_id = '{$SelectYear}' AND GSI.semester_id = '{$SelectSemester}' ";
    }
    
    $selectQ = "SELECT GSI.*, `GTSC`.`course_name`, `GTSC`.`course_code`, `GTSC`.`course_price`, `SIC`.`programme_name` FROM tbl_available_courses GSI LEFT JOIN tbl_courses GTSC ON `GTSC`.`id` = `GSI`.`course_id` LEFT JOIN tbl_programmes SIC ON `SIC`.`id` = `GSI`.`programme_id` ".$SearchPatientName." LIMIT $start, $per_page";
    //echo $selectQ;
    $select = $common->GetRows($selectQ);
    
    $numArticlesQ = "SELECT COUNT(GSI.id) FROM tbl_available_courses GSI LEFT JOIN tbl_courses GTSC ON `GTSC`.`id` = `GSI`.`course_id` LEFT JOIN tbl_programmes SIC ON `SIC`.`id` = `GSI`.`programme_id` ".$SearchPatientName." ";
    $numArticles = $common->CCGetDBValue($numArticlesQ);
    $numPage = ceil($numArticles / $per_page); // Total number of page
    // We build the article list dfsd
    if ($numPage > 0) {
        $articleList = '';
        foreach ($select as $result) {
            $EntryID = $result["id"];
            $BID = $result["course_id"];
            $CourseName = $result['course_name'];
            $CourseCode = $result["course_code"];
            $programmeID = $result["programme_id"];
            $ProgrammeName = $result["programme_name"];
            $CoursePrice = $result["course_price"];
            $CoursePrice = $result["course_price"];
            $CourseAvailable = $result["available"];
            
            if($CourseAvailable == 1) {
                $ShowStatus = 'Available';
                $DisabledActiveEntry = 'd_none';
                $DisabledEntry = '';
                $BtnStatus = 'Active';
            }
            else if ($CourseAvailable == 0) 
            {
                $ShowStatus = 'Not Available'; 
                $BtnStatus = 'In-Active';
                $DisabledEntry = 'd_none';
                $DisabledActiveEntry = '';  
            }

            $EchoButtons = '<a class="delactionsbtn btn btn-danger DeleteEntry' . $EntryID . ' ' . $DisabledEntry . '" href="' . $EntryID . '"><i class="fa fa-trash"></i> Make Un-Available </a>
                <a class="enactionsbtn btn btn-info EnableEntry' . $EntryID . ' ' . $DisabledActiveEntry . '" href="' . $EntryID . '"><i class="fa fa-check"></i> Make Available </a>';

            // End Looping Through the Data Retrieved
            // class="availableQuantityClass Editable-Cell-Bg" id="course_price:' . $BID . '" getresid="' . $BID . '" contenteditable="true"
            $articleList .= '<tr id="ResultRow' . $BID . '">
                <td>' . $ProgrammeName . '</td>
                <td>' . $CourseName . '</td>
                <td>' . $CourseCode . '</td>
                <td>' . number_format($CoursePrice,0) . '</td>
                <td>' . $ShowStatus . '</td>
                <td><center>' . $EchoButtons . '</center></td>
                </tr>';

        } 
        $AccuJSScripts = '<script type="text/javascript">$(function(){$(".select2").select2();); $("#IncomeTypesTable").dataTable();}</script>';
        $dataBack = array('numPage' => $numPage, 'articleList' => $articleList, 'AccuJSScripts' => $AccuJSScripts);
        $dataBack = json_encode($dataBack);
        echo $dataBack;
    } else {
        $articleList = '<div class="row"><div class="alert alert-danger m_top_10 accu-f-md" role="alert"><center><h4 class="t_align_c"><i class="fa fa-shield"></i><hr /><strong>Ooops!</strong> There are no items for your search! Please refine your search</h4></center></div></div>';
        $dataBack = array('numPage' => 0, 'articleList' => $articleList);
        $dataBack = json_encode($dataBack);
        echo $dataBack;
        exit;
    }
}
?>
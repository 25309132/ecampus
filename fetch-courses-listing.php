<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include_once('sys/core/init.inc.php');
$common = new common();

if ($_POST) { 
    $SearchTSProcedure = $_REQUEST["SearchTSProcedure"];  
 
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
    } else {
        $start = 0;
    }
 
        if (!empty($SearchTSProcedure)) { 
            $where = ' WHERE `TSP`.course_name LIKE "%'.$SearchTSProcedure.'%"  AND `TSP`.isActive = 1 ORDER BY `TSP`.course_name ASC LIMIT ' . $start . ', ' . $per_page . ' ';
            $wherecount = '  WHERE `TSP`.course_name LIKE "%'.$SearchTSProcedure.'%"  AND `TSP`.isActive = 1   ';
        } else {
            $where = ' WHERE  `TSP`.isActive = 1 ORDER BY `TSP`.course_name ASC LIMIT ' . $start . ', ' . $per_page . ' ';
            $wherecount = 'WHERE `TSP`.isActive = 1';
        }
        
        $Sql= "SELECT TSP.* FROM tbl_courses TSP " . $where . " ";
        $numArticles = $common->CCGetDBValue("SELECT COUNT(TSP.id) FROM tbl_courses TSP " . $wherecount . ";");
    

    $select = $common->GetRows($Sql);
    $numPage = ceil($numArticles / $per_page); // Total number of page 
   
    if ($numPage > 0) {
        $LabTestsList = '';
        foreach ($select as $result) {

            $RProcedureID = $result["id"];
            $RcourseName = $result["course_name"]; 
            $RsystemPCode = $result["systemPCode"];
            $FCourseCode = $result["course_code"];
            $PriceAmount =  number_format($result["course_price"],2); 

            // End Looping Through the Data Retrieved
            $LabTestsList .= '<tr id="ResultRow' . $RProcedureID . '">  
            <td>' . $RcourseName . '</td>
            <td LTpostInsSchemeID="'.$GetIFSchemeID.'" class="d_none LTpostInsSchemeID' . $RProcedureID . '"></td> 
            <td LTpayoptname="'.$SPayOption.'" class="LTSPayOption' . $RProcedureID . '">' . $FCourseCode . '</td>  
            <td class="Editable-Cell-Bg d_none"><center><input name="LTqtyval" value="1" class="w_full form-input LTqtyval' . $RProcedureID . '"></center></td>
            <td><center>' . $PriceAmount . '</center></td>  
            <td onClick="labTestsCartActionAdd('.$RProcedureID.')"><center class="btn btn-info btn-flat btn-small"> Select  <i class="fa fa-arrow-right"></i></center></td>   
            </tr>';

        }
        $dataBack = array('numPage' => $numPage, 'LabTestsList' => $LabTestsList);
        $dataBack = json_encode($dataBack);
        echo $dataBack;
    }
}
?>
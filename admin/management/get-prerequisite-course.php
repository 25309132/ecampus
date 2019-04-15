<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if (!empty($_GET["term"])) {
    $searchTerm = $_GET['term'];
    $query = $common->GetRows("SELECT * FROM tbl_courses WHERE (course_name LIKE '%{$searchTerm}%' OR course_code LIKE '%{$searchTerm}%') AND isActive = 1;");
	
    if ($query) {
        $results = array();
        foreach ($query as $AC) {
            $tempArray = array(
                'id' => $AC['id'],
                'label' => $AC['course_name'].' - '.$AC['course_code'],
                'name' => $AC['id']
            );

            $results[] = $tempArray;
        }
        echo json_encode($results);
    }
}
?>
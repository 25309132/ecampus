<?php
include_once('../sys/core/init.inc.php');
$common = new common();

if (!empty($_GET["term"])) {
    $searchTerm = $_GET['term'];
    $query = $common->GetRows("SELECT * FROM tbl_students WHERE (surname LIKE '%{$searchTerm}%' OR othernames LIKE '%{$searchTerm}%' OR admission_number LIKE '%{$searchTerm}%');");
	
    if ($query) {
        $results = array();
        foreach ($query as $AC) {
            $tempArray = array(
                'id' => $AC['id'],
                'label' => $AC['surname'].' '.$AC['othernames'].' - '.$AC['admission_number'],
                'name' => $AC['id']
            );

            $results[] = $tempArray;
        }
        echo json_encode($results);
    }
}
?>
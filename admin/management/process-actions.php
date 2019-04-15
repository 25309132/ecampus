<?php
include_once('../sys/core/init.inc.php');
$common=new common();

// Get Insurance Schemes
if(!empty($_GET["GetSemester"]))
{
  $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
       if ($parents != null) {
            $dd=$parents["0"];
            $out = $common->GetRows("SELECT id,  semester  AS name FROM tbl_semesters WHERE year_id = ".$dd." AND isActive=1");
            echo json_encode(['output'=>$out, 'selected'=>'']);
      return;
       }
    }
}

?>
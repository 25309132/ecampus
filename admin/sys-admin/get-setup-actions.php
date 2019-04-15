<?php
include_once('../sys/core/init.inc.php');
$common=new common();

// Get Facility Departments
if(!empty($_GET["GetFDepartmentID"]))
  { 
    $DIsNOT = '';
    if(isset($_GET['DIsNOT'])){
      $DIsNOT = "AND id <> 14";
    }
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
              $dd=$parents["0"];
              $out = $common->GetRows("SELECT id, departmentName AS name FROM setup_facility_departments WHERE facilityID=".$dd." AND isActive=1 ".$DIsNOT." ");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
// Get Facility Department Rooms
if(!empty($_GET["GetFDServiceRoomID"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
              $dd=$parents["0"];
              $out = $common->GetRows("SELECT id, roomName AS name FROM setup_facility_rooms WHERE roomDepartmentID=".$dd." AND isActive=1");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
// Get Service Providers 
if(!empty($_GET["GetFDServiceProvidersID"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
              $dd=$parents["0"];
              $out = $common->GetRows("SELECT id, CONCAT(user_title,  ' ' , names) AS name FROM tbl_users WHERE userDepartmentID=".$dd." AND isActive=1");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
// Get Service Fee 
if(!empty($_GET["GetFDSPProcedureFeeID"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
              $dd=$parents["0"];
              $out = $common->GetRows("SELECT id, CONCAT(procedureName,  ' - CASH: ' , procedureCashCharge, ' - INSURANCE: ', procedureInsuranceCharge) AS name FROM setup_procedures WHERE procedureDepartmentID =".$dd." AND isActive=1");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
if(!empty($_GET["GetFDProcedureCatID"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
              $dd=$parents["0"];
              $out = $common->GetRows("SELECT id, concat(procedureCategoryName, ' - CODE:  ', procedureCategoryCode) AS name FROM setup_procedure_categories WHERE procedureCategoryDepartmentID=".$dd." AND isActive=1");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
if(!empty($_GET["GetLTSampleID"]))
  {
  	$out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
  			 $dd=$parents["0"];
              $out = $common->GetRows("SELECT GLT.testName AS name, GLT.id FROM lab_specimen_tests GLT LEFT JOIN lab_sample_specimen GLSS ON GLSS.id = GLT.testSpecimenID LEFT JOIN lab_test_categories GLTC ON GLTC.id = GLSS.ltSpecimenCategoryID WHERE GLTC.id = '{$dd}' ");
              echo json_encode(['output'=>$out, 'selected'=>'']);
  			return;
         }
      }
  }
if(!empty($_GET["GetOProceduresID"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
         $dd=$parents["0"];
              $out = $common->GetRows("SELECT GLTC.procedureName AS name, GLTC.id FROM setup_procedures GLTC WHERE GLTC.procedureCategoryID = '{$dd}' ");
              echo json_encode(['output'=>$out, 'selected'=>'']);
        return;
         }
      }
  }
?>
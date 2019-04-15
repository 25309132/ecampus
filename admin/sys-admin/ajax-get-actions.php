<?php
include_once('../sys/core/init.inc.php');
$common=new common();

if(!empty($_GET["GetModule"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
           if ($parents != null) {
           $dd=$parents["0"];
           $out = $common->GetRows("SELECT `id`, `name` AS `name` FROM `tbl_sys_module_child` WHERE `par_id` = '{$dd}' AND isActive=1");
                echo json_encode(['output'=>$out, 'selected'=>'']);
          return;
         }
      }
  }
elseif(!empty($_GET["UserGroups"]))
  {
    $rows=$common->JsonGetRows("SELECT * FROM tbl_usergroups WHERE isActive = 1");
    echo $rows;
    return;
  }
elseif(!empty($_GET["GetPage"]))
  {
    $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
           if ($parents != null) {
           $dd=$parents["0"];
           $out = $common->GetRows("SELECT `id`, `name` AS `name` FROM `tbl_modules_pages_access` WHERE `par_id` = '{$dd}' AND isActive=1");
                echo json_encode(['output'=>$out, 'selected'=>'']);
          return;
         }
      }
  }
?>
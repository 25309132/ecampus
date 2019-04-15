<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common = new common();

if (!empty($_GET["Depts"])) {
    $rows = $common->JsonGetRows("SELECT * FROM tbl_departments");
    echo $rows;
    return;
}
//Schools
elseif (!empty($_GET["Schools"])) {
    $rows = $common->JsonGetRows("SELECT * FROM tbl_schools WHERE isActive = 1");
    echo $rows;
    return;
}
//Programmes
elseif (!empty($_GET["Progs"])) {
    $rows = $common->JsonGetRows("SELECT * FROM tbl_programmes WHERE isActive = 1");
    echo $rows;
    return;
}
//Campuses
elseif (!empty($_GET["Campuses"])) {
    $rows = $common->JsonGetRows("SELECT * FROM tbl_campuses WHERE isActive = 1");
    echo $rows;
    return;
}
else {

}
?>
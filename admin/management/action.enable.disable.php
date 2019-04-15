<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$GetUserID = $_SESSION['UID'];
$Today = date('Y-m-d');

// Start enable member advances
if (isset($_POST["MakeUnavailable"]) && strlen($_POST["MakeUnavailable"]) > 0 && is_numeric($_POST["MakeUnavailable"])) {
    try {
        $MakeUnavailable = filter_var($_POST["MakeUnavailable"], FILTER_SANITIZE_NUMBER_INT);
        $common->Insert("UPDATE tbl_available_courses SET available = 0 WHERE id = '{$MakeUnavailable}' ");
    } catch (Exception $e) {  echo $e; }
}
// End  enable member advances

// Start disable member advances
elseif (isset($_POST["MakeAvailable"]) && strlen($_POST["MakeAvailable"]) > 0 && is_numeric($_POST["MakeAvailable"])) {
    try {
        $MakeAvailable = filter_var($_POST["MakeAvailable"], FILTER_SANITIZE_NUMBER_INT);
        $common->Insert("UPDATE tbl_available_courses SET available = 1 WHERE id = '{$MakeAvailable}' ");
    } catch (Exception $e) { echo $e;  }
}

else {
    header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>
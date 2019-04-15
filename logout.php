<?php
session_start();
include_once('sys/core/init.inc.php');
$common = new common();
$UserID = $_SESSION['UID'];
// Flag User offline Status
$common->Insert("UPDATE tbl_users SET online_status = 0 WHERE id = '{$UserID}';");

unset($_SESSION['UID']);
unset($_SESSION['GrpID']);
unset($_SESSION['UName']);
unset($_SESSION['UsersNames']);
unset($_SESSION['UserImage']);
unset($_SESSION['UserEmail']);
unset($_SESSION['UsersPhoneNumber']);
session_destroy();
header('location:index');

?>
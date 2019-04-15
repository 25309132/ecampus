<?php
session_start();
session_destroy();
unset($_SESSION['names']);
header('location:index.php');
?>
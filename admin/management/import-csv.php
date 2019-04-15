<?php
session_start();
include_once('../sys/core/init.inc.php');
$common=new common();

if(isset($_SESSION['insert'])) {
    
    $queries = explode(';', $_SESSION['insert']);
    foreach($queries as $query)
    {
        if($query != "")
        {
            try 
            { 
                $FUpload = $common->Insert($query); 
                //echo $query;
            }
            catch (Exception $e) 
            {
                echo $e;
            }
        }
    }
    $dbo = null; // Kill PDO Connection
    $_SESSION['insert']='';
}
?>
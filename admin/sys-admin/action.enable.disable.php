<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$SikuYleoSahii = date("Y-m-d");
// Include    Lab Procedure Scheme Pricing      
if(isset($_POST["IncludeLabSchemePID"]) && strlen($_POST["IncludeLabSchemePID"])>0 && is_numeric($_POST["IncludeLabSchemePID"]))
	{
		try 
			{	
				$IncludeLabSchemePID = filter_var($_POST["IncludeLabSchemePID"], FILTER_SANITIZE_NUMBER_INT); 
				$common->Insert("UPDATE tbl_schemes_pricing SET isExcluded = 1 WHERE id = '{$IncludeLabSchemePID}' ");
			}	catch (Exception $e) {echo $e;}
	}
// Excluding Lab Procedure Scheme Pricing 
elseif(isset($_POST["ExcludeLabSchemePID"]) && strlen($_POST["ExcludeLabSchemePID"])>0 && is_numeric($_POST["ExcludeLabSchemePID"]))
	{
		try 
			{	
				$ExcludeLabSchemePID = filter_var($_POST["ExcludeLabSchemePID"], FILTER_SANITIZE_NUMBER_INT); 
				echo $ExcludeLabSchemePID ;
				$common->Insert("UPDATE tbl_schemes_pricing SET isExcluded = 0 WHERE id = '{$ExcludeLabSchemePID}' ");
			}catch (Exception $e) {echo $e;}
	}
// End Disable Fee Structure
else
	{
		header('HTTP/1.1 500 Error occurred, Could not process request!');
	    exit();
	}
?>
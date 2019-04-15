<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$TodaysDate = date('Y-m-d');
$SelectYear = $common->CCStrip($_POST['SelectYear']);
$SelectSemester = $common->CCStrip($_POST['SelectSemester']); 

if(filter_has_var(INPUT_GET, "GetCoursesCount"))
//if(isset($_GET['GetCoursesCount'] == 1))
{ 
	if(!empty($SelectYear) && !empty($SelectSemester))
	{
		$ChequesLogged = $common->CCGetDBValue("SELECT COUNT(`inv`.`id`) FROM tbl_available_courses `inv` WHERE `inv`.`year_id` = '{$SelectYear}' AND `inv`.`semester_id` = '{$SelectSemester}' ");
	}

	if($ChequesLogged > 0){ 
		$StateResponse = 1; 
		$jsonArr = array( "type" => "success", "stockAmount" => "$ChequesLogged");
		echo json_encode( $jsonArr );
	}
	else{
		$StateResponse = 0; 
		$jsonArr = array( "type" => "error", "errormsg" => "$ChequesLogged" );
		echo json_encode( $jsonArr );
	}
}
?>
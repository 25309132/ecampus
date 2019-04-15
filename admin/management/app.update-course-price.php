<?php
include_once('../sys/core/init.inc.php');
$common=new common();

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$TodayDate = date("Y-m-d H:m:s");
$TodayYear = date("Y");
$GUID = $_SESSION['UID'];

if(!empty($_POST))
	{
		foreach($_POST as $field_name => $val)
			{
				$field_userid = strip_tags(trim($field_name));
				$val = $common->CCStrip($val);
				$split_data = explode(':', $field_userid);

				$iiid = $split_data[1];
				$field_name = $split_data[0];

				if(!empty($iiid) && !empty($field_name) && !empty($val))
					{
						$ValSanitized = str_replace( ',', '', $val );
						$common->Insert("UPDATE tbl_courses SET course_price = '".$ValSanitized."' WHERE id = '".$iiid."' ");
					} 
				else{echo "Invalid Requests";}
			}
	} else { echo "Invalid Requests";}
?>
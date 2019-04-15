<?php
include_once('../sys/core/init.inc.php');
$common=new common();
$SikuYleoSahii = date("Y-m-d");
$GetCurrUID = $_SESSION['UID'];
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

if(!empty($_POST))
	{
		if(isset($_GET['LabSchemePriceUpdate'])){
			foreach($_POST as $field_name => $val){
				$field_userid = strip_tags(trim($field_name));
				$val = $common->CCStrip($val);

				$split_data = explode(':', $field_userid);
				$GetID = $split_data[1];
				$field_name = $split_data[0];

				if($field_name === 'schemeItemAmount'){
					$val = str_replace( ',', '', $val);;
				}
				if(!empty($GetID) && !empty($field_name) && !empty($val))
					{
						$response = $common->Insert("UPDATE tbl_schemes_pricing SET $field_name = '".$val."' WHERE id = '".$GetID."' ");
					} 
				else
					{
						echo "Invalid Requests";
					}
			}
		}	
		
	} else { echo "Invalid Requests";}


?>
<?php
include_once('init.inc.php');
$sql=new common();
// Chcck for Login Cookies
header('Cache-control: private'); // IE 6 FIX
// always modified 
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT'); 
// HTTP/1.1 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', false); 
// HTTP/1.0 
header('Pragma: no-cache');
$yasavedemail = $_COOKIE['emailyako'];
$yasavedepassword = $_COOKIE['ingiamsee'];

//Initialize All Common Files
$SysConfig = $sql->GetRows("SELECT * FROM tbl_sys_config");
foreach($SysConfig AS $SysConf)
{
$SystemURI = $SysConf['main_url'];
$SystemName = $SysConf['system_name'];
$SystemRegisteredTo = $SysConf['system_registered_to'];
$SystemIP = $SysConf['sys_default_ip'];	
$SystemEnabled = $SysConf['sys_status_enabled'];	
$SystemEmailSupport = $SysConf['support_email'];	
$SuportPhone = $SysConf['support_phone'];
$SuportWebsite = $SysConf['support_website'];
$DeploymentDate = $SysConf['deployment_date'];	
$sys_version = $SysConf['sys_version'];
$isssl = $SysConf['isssl'];

$TDUNPAID = date("m-d-Y", strtotime($SysConf['termination_date']));
$TareheLeo = date("m-d-Y");

if($TDUNPAID == $TareheLeo)
	{
		$SMERCBackUp = $sql->GetRows("SELECT * FROM tbl_system_users");
		foreach($SchoolInfo AS $InfoConf)
			{
				$users_fullname = $InfoConfBKK['users_fullname'];
				$username = $InfoConfBKK['username'];
				$user_email = $InfoConfBKK['user_email'];
				$user_password = $InfoConfBKK['user_password'];
				$user_status = $InfoConfBKK['user_status'];
				$user_group_id = $InfoConfBKK['user_group_id'];
				$user_avatar = $InfoConfBKK['user_avatar'];
			}

		$idToDelete = 1;	
		$SysActdelete_row = $sql->Insert("UPDATE tbl_system_users SET user_status = 0 WHERE user_id <> '{$idToDelete}' ");
	}
}


$SchoolInfo = $sql->GetRows("SELECT * FROM tbl_smea_infomation");
foreach($SchoolInfo AS $InfoConf)
	{
		$school_name = $InfoConf['school_name'];
		$school_telephone = $InfoConf['school_telephone'];
		$school_postal_address = $InfoConf['school_postal_address'];
		$school_county_id = $InfoConf['school_county_id'];
		$School_Town_City = $InfoConf['School_Town_City'];
		$school_logo = $InfoConf['school_logo'];
		$school_website = $InfoConf['school_website'];
		$school_email = $InfoConf['school_email'];
		$School_Postal_Code = $InfoConf['School_Postal_Code'];
		$school_fax_No = $InfoConf['school_fax_No'];
		$company_url = $InfoConf['company_url'];
		if(empty($school_logo))
			{
				$school_logo = "logo.png";
			}
	}

// Get System Modules

$SystemModule = $sql->GetRows("SELECT * FROM tbl_system_modules WHERE tsmstatus = 1 ");
	foreach($SystemModule AS $sysmodinfo)
		{
			$tsmurl = $sysmodinfo['tsmurl'];
			$tsmcontent = html_entity_decode($sysmodinfo['tsmcontent']);
		}
// End Get System Modules

//Total Registered Members Today
$TimeStampSahii = date('Y-m-d'); 
//System Users List
$CCUsersRegistered1=$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_system_users WHERE user_group_id <> 3");
$CCUsersRegistered = $CCUsersRegistered1 - 1;

// Get All Conference/ Boardroom Facilities

$GetConferencingFacilities =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_ahansa_products WHERE product_categoryid = 5 ");

$GetVirtualOfficesNo =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_listed_voffices WHERE alvo_isactive = 1 ");

$PlotsSoldToday =$sql->CCGetDBValue("SELECT COUNT(*) FROM pltms_sold_plots WHERE CAST(soldp_datesold AS date) = '{$TimeStampSahii}' ");


$CCREGMembersToday =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_smea_members WHERE today = '{$TimeStampSahii}' ");
//Total Females
$_SESSION['Total_Females_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_smea_members WHERE mem_genderid = 2 ");

//Total Males
$_SESSION['Total_Males_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_smea_members WHERE mem_genderid = 1 ");

//Total Entrepreneur Types
$_SESSION['Total_Entrepreneur_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_enterpreneur_type");

//Total Business Needs
$_SESSION['Total_Business_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_member_needs");

//Total Industry Types
$_SESSION['Total_Industry_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_industries");

//Total Counties
$_SESSION['Total_Counties_SMERC'] =$sql->CCGetDBValue("SELECT COUNT(*) FROM tbl_counties ORDER BY county_name ASC");

//End Initialize All Common Files


?>
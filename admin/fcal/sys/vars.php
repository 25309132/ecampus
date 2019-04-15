<?php
$moduleactive="";
$menu_id="";
$pageactive="";
$CanVIEW="";
$CanCREATE="";
$CanUPDATE="";
$CanDELETE="";
//Get variables and access rights
$pagename=basename($_SERVER['PHP_SELF']);
//$moduleactive=$common->CCGetDBValue("");
foreach($common->GetRows("SELECT SM.MENU_ID, SM.M_ACTIVE as PGAC, MN.M_ACTIVE as MAC FROM CRM_SYSTEM_MENUS SM LEFT JOIN CRM_SYSTEM_MODULES  MN ON SM.MODULE_ID_FK=MN.MODULE_ID  WHERE SM.M_URL='".$pagename."'") as $R)
	
{
	$menu_id=$R["MENU_ID"];
	$moduleactive=$R["MAC"];
	$pageactive=$R["PGAC"];
	//$CanDELETE=$R["DRECORD"];
	
}
foreach($common->GetRows("SELECT CRECORD, DRECORD, URECORD, VRECORD FROM CRM_USERACTIONS WHERE GROUP_ID_FK='1' AND MENU_ID_FK='".$menu_id."'") as $R)
	
{
	$CanVIEW=$R["VRECORD"];
	$CanCREATE=$R["CRECORD"];
	$CanUPDATE=$R["URECORD"];
	$CanDELETE=$R["DRECORD"];
	
}
?>
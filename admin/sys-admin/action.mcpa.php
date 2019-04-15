<?php
//error_reporting(0);
include_once('sys/core/initialize.php');
$sql = new common();
// Add New Plot Details
$Remote = $sql->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $sql->CCStrip($_SERVER['HTTP_USER_AGENT']);

$USESSION_EMAIL = $_SESSION['SESSION_EMAIL']; 
$USESSION_UID = $_SESSION['UID_Session']; 
if(!empty($_GET["UserGroups"]))
{
	$rows=$sql->JsonGetRows("SELECT * FROM tbl_system_users");
	echo $rows;
	return;
}
if(filter_has_var(INPUT_POST, "SubmitCPA"))
        {
        try  
            {  
// mca_cost  mca_description mca_priority mca_Status mca_startdate mca_Enddate mca_activitytype mca_assignedto mca_progress 
               
                $GEmployee_Name =$sql->CCStrip($_POST['GEmployee_Name']); 
                $SubActivityName =$sql->CCStrip($_POST['SubActivityName']); 
                $GetMainProjectID =$sql->CCStrip($_POST['GetMainProjectID']); 
                $GetSA_Categoryid =$sql->CCStrip($_POST['GetSA_Categoryid']);
                $mca_cost =$sql->CCStrip($_POST['mca_cost']);
                $mca_MainProjectIDPOSTED =$sql->CCStrip($_POST['mca_MainProjectIDPOSTED']); 
                $mca_description =$sql->CCStrip($_POST['mca_description']); 
                $mca_priority =$sql->CCStrip($_POST['mca_priority']);
                $mca_startdate =$sql->CCStrip($_POST['mca_startdate']);
                $mca_Status =$sql->CCStrip($_POST['mca_Status']);  
				$groups=isset($_POST['mca_assignedto']) ? $_POST['mca_assignedto'] : array();		
				$mca_assignedto=implode(",",$groups);

                $mca_Enddate =$sql->CCStrip($_POST['mca_Enddate']);
                $mca_activitytype =$sql->CCStrip($_POST['mca_activitytype']);
                $mca_progress =$sql->CCStrip($_POST['mca_progress']); 
                $updatereason =$sql->CCStrip($_POST['updatereason']); 
               
				$sql->Insert("INSERT INTO `pms_approved_projects_subactivities` (`aps_subactivityname`,`aps_subactivitymainprojectid`, `aps_subactivityid`,
`aps_subactivitydescription`, `aps_subactivitycost`, `aps_subactivitystatusid`, `aps_subactivitystartdate`, `aps_subactivityassignedto`, `aps_subactivityenddate`, `aps_subactivityprogress`, `aps_subactivityaddedbyuip`, `aps_subactivityupdatedbyuid`, `aps_subactivityincharge`, `aps_subactivitypriority`, `aps_subactivitytype` , `aps_subactivityaddedbyupc`, `aps_subactivityupdatereason` )
VALUES ('".$SubActivityName."','".$GetMainProjectID."', '".$GetSA_Categoryid."', '".$mca_description."', '".$mca_cost."', '".$mca_Status."', '".$mca_startdate."', '".$mca_assignedto."', '".$mca_Enddate."', '".$mca_progress."',  '".$Remote."' , '".$USESSION_UID."', '".$GEmployee_Name."', '".$mca_priority."', '".$mca_activitytype."', '".$RemoteBrowser."', '".$RemoteBrowser."' )" );
                
            } catch (Exception $e){echo $e;} 
        }

// End Adding New Actvity Details


// Start Actvity Details Update

if(isset($_GET["Edit_SubmitCPA"]))
        {
        try  
            {
                $Edit_mca_MainProjectIDPOSTED =$sql->CCStrip($_POST['Edit_mca_MainProjectIDPOSTED']);
                $Edit_Get_Sub_Activity =$sql->CCStrip($_POST['Edit_Get_Sub_Activity']);   
                $Edit_mca_cost =$sql->CCStrip($_POST['Edit_mca_cost']);
                $Edit_mca_description =$sql->CCStrip($_POST['Edit_mca_description']); 
                $Edit_mca_priority =$sql->CCStrip($_POST['Edit_mca_priority']);
                $Edit_mca_startdate =$sql->CCStrip($_POST['Edit_mca_startdate']);
                $Edit_mca_Status =$sql->CCStrip($_POST['Edit_mca_Status']);  
                $Edit_groups=isset($_POST['Edit_mca_assignedto']) ? $_POST['Edit_mca_assignedto'] : array();       
                $Edit_mca_assignedto=implode(",",$Edit_groups);

                $Edit_mca_Enddate =$sql->CCStrip($_POST['Edit_mca_Enddate']);
                $Edit_mca_activitytype =$sql->CCStrip($_POST['Edit_mca_activitytype']);
                $Edit_mca_progress =$sql->CCStrip($_POST['Edit_mca_progress']); 
                $Employee_Name =$sql->CCStrip($_POST['Employee_Name']);
                $ESubActivityName =$sql->CCStrip($_POST['ESubActivityName']);

                $sql->Insert("UPDATE `pms_approved_projects_subactivities`
								SET
								`aps_subactivityid` ='".$Edit_Get_Sub_Activity."',
                                `aps_subactivityname` ='".$ESubActivityName."',
								`aps_subactivitydescription` ='".$Edit_mca_description."',
								`aps_subactivitycost` = '".$Edit_mca_cost."',
								`aps_subactivitystatusid` ='".$Edit_mca_Status."',
								`aps_subactivitystartdate` ='".$Edit_mca_startdate."',
								`aps_subactivityenddate` ='".$Edit_mca_Enddate."',
								`aps_subactivityassignedto` ='".$Edit_mca_assignedto."', 
                                `aps_subactivityprogress` ='".$Edit_mca_progress."',
								`aps_subactivityaddedbyuip` = '".$Remote."',
                                `aps_subactivityupdatedbyuid` = '".$USESSION_UID."',
                                `aps_subactivityincharge` ='".$Employee_Name."',
                                `aps_subactivitypriority` ='".$Edit_mca_priority."',
                                `aps_subactivitytype` ='".$Edit_mca_activitytype."'
								WHERE `aps_id` =".$Edit_mca_MainProjectIDPOSTED.";"); 
    
            } catch (Exception $e){echo $e;}
        }

?>

<?php 
include_once('../sys/core/init.inc.php');
$common=new common();
$GCUID = $_SESSION['UserEmail'];
$DayTodayIs = date('Y-m-d');
 
// Process Bulk Delete           
if(filter_has_var(INPUT_POST, "IWBID"))
{
    try {   
            // Delete from raw
            if(isset($_GET['DeleteItems']) && $_GET['DeleteItems'] == 1)
            {
                $IWBID = $common->CCStrip($_REQUEST["IWBID"]);  
                $common->Insert("UPDATE tbl_uploaded_exams SET isDeleted = 1, dateDeleted = '{$DayTodayIs}', deletedBy = '{$GCUID}' WHERE id = '{$IWBID}' AND isDeleted = 0;"); 
            }
            // Do nothing
            else
            {
                
            }
                   
        } catch (Exception $e){echo $e;} 
}
?>
<?php
include_once('../sys/core/init.inc.php');
$common=new common();
$LoggedUser = $_SESSION['UserEmail'];
// Update School Details 
if(filter_has_var(INPUT_POST, "Add_Programme_Course")) 
{
    try  
        {   
            $ProgrammeID = $common->CCStrip($_POST['Add_Programme_Course']);
            $ItemId = $common->CCStrip($_POST['ItemId']);
            $ugrps = $common->CCStrip($_GET['ugrps']);
            
            $SQL = "INSERT INTO lookup_programmes_courses (programme_id, course_id, course_type_tag, added_by) VALUES ('{$ProgrammeID}', '{$ItemId}', '". $_GET['ugrps'] ."', '{$LoggedUser}');";
            //echo $SQL;
            $common->Insert($SQL);

        } catch (Exception $e){echo $e;} 
    }
?>
<?php
include_once('../sys/core/init.inc.php');
$common=new common();

// Update School Details 
if(filter_has_var(INPUT_POST, "Add_Department_To_School")) 
{
    try  
        {   
            $PostSchoolID = $common->CCStrip($_POST['Add_Department_To_School']);
            $groups = isset($_GET['ugrps']) ? $_GET['ugrps'] : array();
            $group_access = explode(",",$groups);
            
            //Insert imploded values to lookup_school_departments
            foreach ($group_access as $key => $value) 
            { 
                if($value > 0)
                {
                    $common->Insert("INSERT INTO lookup_school_departments (school_id, department_id) VALUES ('{$PostSchoolID}', '{$value}');");
                }
            }

        } catch (Exception $e){echo $e;} 
    }
?>
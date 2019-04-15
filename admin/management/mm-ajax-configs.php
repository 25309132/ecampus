<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$LoggedUser = $_SESSION['UserEmail'];
// Add School/Institution    
if(filter_has_var(INPUT_POST, "Register_School")) {
    try  
        {   //AddSchoolName Register_School AddSchoolDescription
            $AddSchoolName = $common->CCStrip($_POST['AddSchoolName']); 
            $AddSchoolDepartments = $common->CCStrip($_POST['menu_group_access2']); 
            $AddSchoolDescription = $common->CCStrip(ucwords($_POST['AddSchoolDescription']));
            $groups = isset($_POST['menu_group_access2']) ? $_POST['menu_group_access2'] : array();

            //Insert into tbl_school
            $SchoolID = $common->Insert("INSERT INTO tbl_schools (school_name, description) VALUES ('{$AddSchoolName}', '{$AddSchoolDescription}');");

            //Insert exploded values to lookup_school_departments
            foreach ($groups as $key => $value) 
            { 
                if($value > 0)
                {
                    $common->Insert("INSERT INTO lookup_school_departments (school_id, department_id) VALUES ('{$SchoolID}', '{$value}');");
                }
            }
        } 
        catch (Exception $e) { echo $e; } 
}
// Add Capmus Details
elseif(filter_has_var(INPUT_POST, "Register_Campus")) {
    try  
        {   //AddSchoolName Register_School AddSchoolDescription
            $AddCampusName = $common->CCStrip($_POST['AddCampusName']); 
            $AddCampusDescription = $common->CCStrip(ucwords($_POST['AddCampusDescription']));
           
            $common->Insert("INSERT INTO tbl_campuses (campus_name, description) VALUES ('{$AddCampusName}', '{$AddCampusDescription}');");
        } 
        catch (Exception $e) { echo $e; } 
}

//AddDepartmentName AddDepartmentDescription
elseif(filter_has_var(INPUT_POST, "Register_Department")) {
    try  
        {   //AddSchoolName Register_School AddSchoolDescription
            $AddDepartmentName = $common->CCStrip($_POST['AddDepartmentName']); 
            $AddDepartmentDescription = $common->CCStrip(ucwords($_POST['AddDepartmentDescription']));
           
            $common->Insert("INSERT INTO tbl_departments (department_name, description) VALUES ('{$AddDepartmentName}', '{$AddDepartmentDescription}');");
        } 
    catch (Exception $e) { echo $e; } 
}
//Register_Year AddAcademicYear
elseif(filter_has_var(INPUT_POST, "Register_Year")) {
    try  
        {   
            $AddAcademicYear = $common->CCStrip($_POST['AddAcademicYear']); 
            $GetIsCurrent = $common->CCStrip($_POST['GetIsCurrent']); 
            $common->Insert("INSERT INTO tbl_academic_years (year, isCurrent) VALUES ('{$AddAcademicYear}', '{$GetIsCurrent}');");
        } 
    catch (Exception $e) { echo $e; } 
}
// /AddSemester Register_Semester SemesterStartDate SemesterEndDate
elseif(filter_has_var(INPUT_POST, "Register_Semester")) {
    try  
        {   
            $AddSemester = $common->CCStrip($_POST['AddSemester']);
            $AddSemesterDescription = $common->CCStrip(ucwords($_POST['AddSemesterDescription']));
            $SemesterStartDate = $common->CCStrip($_POST['SemesterStartDate']); 
            $YearID = $common->CCStrip($_POST['YearID']); 
            $SemesterEndDate = $common->CCStrip($_POST['SemesterEndDate']);
            $GetIsCurrent = $common->CCStrip($_POST['GetIsCurrent']); 
            $IsUpcoming = $common->CCStrip($_POST['IsUpcoming']); 
            $common->Insert("INSERT INTO tbl_semesters (semester, year_id, description, start_date, end_date, isUpcoming, isCurrent) VALUES ('{$AddSemester}', '{$YearID}', '{$AddSemesterDescription}', '{$SemesterStartDate}', '{$SemesterEndDate}', '{$IsUpcoming}', '{$GetIsCurrent}');");
        } 
    catch (Exception $e) { echo $e; } 
}

// AddStudentType Register_StudentType
elseif(filter_has_var(INPUT_POST, "Register_StudentType")) {
    try  
        {   
            $AddStudentType = $common->CCStrip($_POST['AddStudentType']);
            $common->Insert("INSERT INTO tbl_student_types (StudentType) VALUES ('{$AddStudentType}');");
        }
    catch (Exception $e) { echo $e; } 
}

//AddStudentStatus Register_StudentStatus
elseif(filter_has_var(INPUT_POST, "Register_StudentStatus")) {
    try  
        {   
            $AddStudentStatus = $common->CCStrip($_POST['AddStudentStatus']);
            $common->Insert("INSERT INTO tbl_students_status (status) VALUES ('{$AddStudentStatus}');");
        }
    catch (Exception $e) { echo $e; } 
}

//AddProgrammeType AddDescription Register_ProgrammeType
elseif(filter_has_var(INPUT_POST, "Register_ProgrammeType")) {
    try  
        {   
            $AddProgrammeType = $common->CCStrip($_POST['AddProgrammeType']);
            $AddDescription = $common->CCStrip(ucwords($_POST['AddDescription']));
            $common->Insert("INSERT INTO tbl_programme_types (type, description) VALUES ('{$AddProgrammeType}', '{$AddDescription}');");
        } 
    catch (Exception $e) { echo $e; } 
}
//Register_Exam_Facilitator
//AddProgrammeType AddDescription Register_ProgrammeType
elseif(filter_has_var(INPUT_POST, "Register_Exam_Facilitator")) {
    try  
        {   
            $AddFacilitatorNames = $common->CCStrip($_POST['AddFacilitatorNames']);
            $FacilitatorContacts = $common->CCStrip(ucwords($_POST['FacilitatorContacts']));
            $common->Insert("INSERT INTO tbl_programme_facilitators (facilitator_name, contacts) VALUES ('{$AddFacilitatorNames}', '{$FacilitatorContacts}');");
        } 
    catch (Exception $e) { echo $e; } 
}
//AddProgrammeType AddDescription Register_ProgrammeType
elseif(filter_has_var(INPUT_POST, "Update_Facilitator_Name")) {
    try  
        {   
            $EditFacilitatorName = $common->CCStrip($_POST['EditFacilitatorName']);
            $Update_Facilitator_Name = $common->CCStrip($_POST['Update_Facilitator_Name']);
            $EditContacts = $common->CCStrip(ucwords($_POST['EditContacts']));
            $common->Insert("UPDATE tbl_programme_facilitators SET facilitator_name = '{$EditFacilitatorName}', contacts = '{$EditContacts}' WHERE id = '{$Update_Facilitator_Name}';");
        } 
    catch (Exception $e) { echo $e; } 
}
// Add Course Statuses
elseif(filter_has_var(INPUT_POST, "Register_StatusName")) 
{
    try  
        {   
            $AddStatusName = $common->CCStrip($_POST['AddStatusName']);
            $AddStatusDescription = $common->CCStrip(ucwords($_POST['AddStatusDescription']));

            $common->Insert("INSERT INTO tbl_course_status (status_name, description) VALUES ('{$AddStatusName}', '{$AddStatusDescription}');");
        }

    catch (Exception $e) { echo $e; } 
}
//Add Course Types
elseif(filter_has_var(INPUT_POST, "Register_CourseType")) 
{
    try  
        {   
            $AddCourseTypeName = $common->CCStrip($_POST['AddCourseTypeName']);
            $AddCourseTypeDescription = $common->CCStrip(ucwords($_POST['AddCourseTypeDescription']));

            $common->Insert("INSERT INTO tbl_course_types (course_type_name, description) VALUES ('{$AddCourseTypeName}', '{$AddCourseTypeDescription}');");
        }
        
    catch (Exception $e) { echo $e; } 
}
//AddCourseName  AddCourseCode AddCourseDescription AddCoursePrice CourseType
elseif(filter_has_var(INPUT_POST, "Register_Course")) 
{
    try  
        {   
            $AddCourseName = $common->CCStrip($_POST['AddCourseName']);
            $AddCourseCode = $common->CCStrip($_POST['AddCourseCode']);
            $AddCoursePrice = $common->CCStrip($_POST['AddCoursePrice']);
            $CoursePrerequisite = $common->CCStrip($_POST['ItemId']);
            $CourseStatus = $common->CCStrip($_POST['CourseStatus']);
            $AddCourseDescription = $common->CCStrip(ucwords($_POST['AddCourseDescription']));
            $UCCode = 'ANC'.$CoursePrerequisite.$common->CCGetDBValue("SELECT id FROM tbl_courses ORDER BY id DESC LIMIT 1 ");

            $CourseId = $common->Insert("INSERT INTO tbl_courses (systemPCode, course_name, course_code, course_price, course_description, course_status, course_prerequisite, added_by) VALUES ('{$UCCode}', '{$AddCourseName}', '{$AddCourseCode}', '{$AddCoursePrice}', '{$AddCourseDescription}', '{$CourseStatus}', '{$CoursePrerequisite}', '{$LoggedUser}');");

            /*/Insert exploded values to lookup_school_departments
            foreach ($groups as $key => $value) 
            { 
                if($value > 0)
                {
                    $common->Insert("INSERT INTO lookup_programmes_courses (course_id, programme_id) VALUES ('{$CourseId}', '{$value}');");
                }
            }*/

        }
        
    catch (Exception $e) { echo $e; } 
}
// Update School Details 
elseif(filter_has_var(INPUT_POST, "Update_Course")) 
{
    try  
    {   //ItemId EditCourseName EditCoursePrice CourseStatusId GetIsActive
        $EditCourseName =$common->CCStrip($_POST['EditCourseName']);
        $EditCoursePrice =$common->CCStrip($_POST['EditCoursePrice']);
        $EditCourseCode =$common->CCStrip($_POST['EditCourseCode']);
        $GetIsActive =$common->CCStrip($_POST['GetIsActive']);
        $GetCourseStatusId =$common->CCStrip($_POST['CourseStatusId']);
        $GetCoursePrerequisiteID =$common->CCStrip($_POST['ItemId2']);
        $Update_Course =$common->CCStrip($_POST['Update_Course']);
       
        $SQL = "UPDATE tbl_courses SET course_name = '{$EditCourseName}', course_prerequisite = '{$GetCoursePrerequisiteID}', course_code = '{$EditCourseCode}', course_price = '{$EditCoursePrice}', course_status = '{$GetCourseStatusId}', isActive = '{$GetIsActive}' WHERE id = '{$Update_Course}'";
        echo $SQL;
        $common->Insert($SQL);

    } catch (Exception $e){echo $e;} 
}

//Register_Programme AddProgrammeName ProgrammeType AddProgrammeCode fee_per_module mode_of_study contact_person_id CourseDescription EntryRequirements
elseif(filter_has_var(INPUT_POST, "Register_Programme")) 
{
    try  
        {   
            $AddProgrammeName = $common->CCStrip($_POST['AddProgrammeName']);
            $ProgrammeType = $common->CCStrip($_POST['ProgrammeType']);
            $AddProgrammeCode = $common->CCStrip($_POST['AddProgrammeCode']);
            $fee_per_module = $common->CCStrip($_POST['fee_per_module']);
            $contact_person_id = $common->CCStrip($_POST['contact_person_id']);
            $fee_per_module = $common->CCStrip($_POST['fee_per_module']);
            $mode_of_study = $common->CCStrip($_POST['mode_of_study']);
            $CourseDescription = $common->CCStrip(ucwords($_POST['CourseDescription']));
            $EntryRequirements = $common->CCStrip(ucwords($_POST['EntryRequirements']));

            $common->Insert("INSERT INTO tbl_programmes (type_id, programme_name, programme_code, minimum_entry, description, mode_of_study, fee_per_module, contact_person_id, added_by) VALUES ('{$ProgrammeType}', '{$AddProgrammeName}', '{$AddProgrammeCode}', '{$EntryRequirements}', '{$CourseDescription}', '{$mode_of_study}', '{$fee_per_module}', '{$contact_person_id}', '{$LoggedUser}');");

        }
        
    catch (Exception $e) { echo $e; } 
}
//AddExamCenterName Register_Exam_Center AddCenterDescription AddCenterLocation AddCenterAddress AddExamCenterContacts
elseif(filter_has_var(INPUT_POST, "Register_Exam_Center")) 
{
    try  
        {   
            $AddExamCenterName = $common->CCStrip($_POST['AddExamCenterName']);
            $AddCenterDescription = $common->CCStrip($_POST['AddCenterDescription']);
            $AddCenterLocation = $common->CCStrip($_POST['AddCenterLocation']);
            $AddCenterAddress = $common->CCStrip($_POST['AddCenterAddress']);
            $AddExamCenterContacts = $common->CCStrip($_POST['AddExamCenterContacts']);
            $SemesterID = $common->CCStrip($_POST['SemesterID']);
            
            $common->Insert("INSERT INTO tbl_exam_centers (center_name, center_address, center_location, center_contacts, center_description, added_by, current_semester_id) VALUES ('{$AddExamCenterName}', '{$AddCenterAddress}', '{$AddCenterLocation}', '{$AddExamCenterContacts}', '{$AddCenterDescription}', '{$LoggedUser}', '{$SemesterID}');");

        }
        
    catch (Exception $e) { echo $e; } 
}
else 
{

}
?>
<?php
include_once('sys/core/init.inc.php');
$common=new common(); 
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);   
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$TodayDate = date("Y-m-d H:m:s");
$TodayYear = date("Y");
$GUID = $_SESSION['UID']; 

// Get Current Month ID and Year ID
$CurrentMonth = date('n');
$CurrentYear = date('Y');
if(filter_has_var(INPUT_GET, "SubmitLabTestsCartIN")) { 
  try { //     
        $studentFloatAmount = $common->CCStrip($_POST['studentFloatAmount']);
        $studentFID = $common->CCStrip($_POST['studentFID']);
        $TotalCoursesAmount = $common->CCStrip($_POST['TotalCoursesAmount']); 

        $AvailableBalance = $common->CCGetDBValue("SELECT floatAmount FROM tbl_students_float WHERE studentFID =  '".$studentFID."' "); 

        if($TotalCoursesAmount <= $AvailableBalance){
            $str12 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $shuffled12 = str_shuffle($str12);
            $DUReference = substr($shuffled12, 0, 5);
            $NextRefNo=$common->CCGetDBValue("SELECT id FROM tbl_references_serialization WHERE id >= 1 ORDER BY id DESC LIMIT 1");
            $RequestNo = $DUReference.$NextRefNo;
            $NextReqNoSeries = $NextRefNo+1;
            $UniqueRCode = $studentFID.$DUReference.$NextRefNo;

            foreach ($_SESSION["coursesCartItems"] as $item) {      
                $PSItemid = $item["id"]; 
                $PSsystemPCode = $item["systemPCode"]; 
                $PSprocedureName = $item["courseName"]; 
                $GetItemPrice = $item["ProcedureCharges"]; 
     
                

                $Total += floatval($GetItemPrice);
                $Vars = "INSERT INTO tbl_student_registered_courses (studentID, courseName, courseID, transactionReferenceCode, courseFee, UID, UIP, UPC) VALUES ('{$studentFID}', '".$PSprocedureName."',  '{$PSItemid}', '{$UniqueRCode}', '{$GetItemPrice}', '{$GUID}', '{$Remote}', '{$RemoteBrowser}' ) ";
                $common->Insert($Vars); 

                // echo $Vars;
            } 
            
            // Clear Courses Session 
            unset($_SESSION["coursesCartItems"]); 

            // Log Student Courses
            $common->Insert("INSERT INTO tbl_student_course_transactions (studentID, totalCourseAmount, txnReferenceCode, UID, UIP, UPC) VALUES ('{$studentFID}', '{$Total}', '{$UniqueRCode}', '{$GUID}', '{$Remote}', '{$RemoteBrowser}') " ); 

            // Reduce Student Float Amount 
            $common->Insert("UPDATE  `tbl_students_float` SET floatAmount = floatAmount-$Total WHERE studentFID = '{$studentFID}' " ); 

            $common->Insert("INSERT INTO tbl_references_serialization (codeSeries) VALUES ('{$NextReqNoSeries}')");
        }
            

      }catch (Exception $e) {echo $e;}
}
 
?>

<?php
//error_reporting(0);
include_once('../sys/core/init.inc.php');
$common=new common();
$LoggedUser = $_SESSION['UserEmail'];
// Add School/Institution    
if(filter_has_var(INPUT_POST, "Register_Payment_Option")) {
    try  
        {   // PaymentOptionName AddCourseTypeDescription Register_Payment_Option
            $PaymentOptionName = $common->CCStrip($_POST['PaymentOptionName']); 
            $AddCourseTypeDescription = $common->CCStrip($_POST['PaymentOptionDescription']); 
            //Insert
            $SQLINsert = $common->Insert("INSERT INTO tbl_payment_options (paymentOptionName, paymentOptionDescription) VALUES ('{$PaymentOptionName}', '{$AddCourseTypeDescription}');");

        } 
        catch (Exception $e) { echo $e; } 
}
// Add Capmus Details
elseif(filter_has_var(INPUT_POST, "Edit_Payment_Option")) {
    try  
        {   
            $EditDescription = $common->CCStrip($_POST['EditDescription']); 
            $EditPaymentOptionName = $common->CCStrip($_POST['EditPaymentOptionName']);
            $EditID = $common->CCStrip($_POST['Edit_Payment_Option']);
            $AcademicYearStatus = $common->CCStrip($_POST['AcademicYearStatus']);
            $common->Insert("UPDATE tbl_payment_options SET paymentOptionName = '{$EditPaymentOptionName}', paymentOptionDescription = '{$EditDescription}', isActive = '{$AcademicYearStatus}' WHERE id = '{$EditID}';");
        } 
        catch (Exception $e) { echo $e; } 
}
//Students Credit payment Info //StudentInfo AddCreditAmount
elseif(filter_has_var(INPUT_POST, "LogStudentCreditEntry")) {
    try  
        {    
          $AddStudentID =$common->CCStrip($_POST['LogStudentCreditEntry']); 
          $AddAmountF =$common->CCStrip($_POST['AddCreditAmount']);  
          $AddAmount = str_replace( ',', '', $AddAmountF ); 
          $folderName = "../../img/payment/";

        $AllowedFileTypes = array('image/png', 'image/jpeg','image/pjpeg','image/gif', 'application/csv', 'application/excel','application/vnd.ms-excel','application/vnd.msexcel','application/mspowerpoint','application/msword', 'application/pdf', 'application/rtf', 'application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template' );
       
      if (in_array($_FILES["DocumentName"]["type"], $AllowedFileTypes)) {
        $UploadedFile = is_uploaded_file($_FILES['DocumentName']['tmp_name']);
        if ($UploadedFile){
              $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['DocumentName']['name']));
              $TheImageOne= strtotime("now").$safe_filename;
              move_uploaded_file($_FILES['DocumentName']['tmp_name'], $folderName.$TheImageOne);
            }
        else {
            
            $TheImageOne = 'add.png';
        }
      } 
      else
      {
        $TheImageOne = 'add.png';
      }

        $SQL = "INSERT INTO fin_students_credits_log (studentID, amount, supportingDocuments, UIP, UPC, loggedByUID) VALUES ('{$AddStudentID}','{$AddAmount}', '{$TheImageOne}','{$Remote}','{$RemoteBrowser}', '{$LoggedUser}')";
        //echo $SQL;
        $common->Insert($SQL);

    }

    catch (Exception $e){echo $e;} 
} 

else 
{

}
?>
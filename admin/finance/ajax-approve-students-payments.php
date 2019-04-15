<?php
include_once('../sys/core/init.inc.php');
$common=new common();
$GUID = $_SESSION['UserEmail']; 
$QID = $_GET['paymentId'];
$QID2 = $_GET['paymentToDeclineId'];
$comments = $_GET['comments'];
$QID3 = $_GET['QID3'];

if ($QID >= 1) 
{
  try 
    {     
        $paymentAmount = $_REQUEST['amountPaid'];
        $StudentUploadID = $_GET['studentID'];
        $paymentReference = $_GET['paymentReference'];
        
        $FloatValueBeforeUpdate = $common->CCGetDBValue("SELECT floatAmount FROM `tbl_students_float` WHERE studentFID = '{$StudentUploadID}';");

        //Check if Student has balance on credit and deduct
        $CreditExists = $common->CCGetDBValue("SELECT creditAmount FROM `fin_students_credits` WHERE studentID = '{$StudentUploadID}';");

        if($CreditExists < 0) {
            $StudentNewBalance = $paymentAmount + $CreditExists;
            if($StudentNewBalance > 0) {
                $common->Insert("UPDATE fin_students_credits SET creditAmount = 0 WHERE studentID = '{$StudentUploadID}';");
                $common->Insert("UPDATE tbl_fee_upload_log SET amountPaid = '{$StudentNewBalance}', amountDeducted = '{$CreditExists}' WHERE studentID = '{$StudentUploadID}' AND paymentReference = '{$paymentReference}';");
                $common->Insert("UPDATE tbl_students_float SET floatAmount = '{$FloatValueBeforeUpdate}' WHERE studentFID = '{$StudentUploadID}';");
                //Mark Payment as Approved
                $common->Insert("UPDATE tbl_fee_upload_log SET isConfirmed = 1, confirmedBy = '{$GUID}', reason = '{$comments}' WHERE id = '{$QID}';");
            }
            else {
                $common->Insert("UPDATE tbl_fee_upload_log SET amountPaid = 0, amountDeducted = '{$CreditExists}' WHERE studentID = '{$StudentUploadID}' AND paymentReference = '{$paymentReference}';");
                $common->Insert("UPDATE fin_students_credits SET creditAmount = '{$StudentNewBalance}' WHERE studentID = '{$StudentUploadID}';");
                $common->Insert("UPDATE tbl_students_float SET floatAmount = '{$StudentNewBalance}' WHERE studentFID = '{$StudentUploadID}';");
                //Mark Payment as Approved
                $common->Insert("UPDATE tbl_fee_upload_log SET isConfirmed = 1, confirmedBy = '{$GUID}', reason = '{$comments}' WHERE id = '{$QID}';");
            }

        }
        else {

            $common->Insert("UPDATE tbl_fee_upload_log SET isConfirmed = 1, confirmedBy = '{$GUID}', reason = '{$comments}' WHERE id = '{$QID}';");
            echo "Less than zero";
        }
        

    }

    catch (Exception $e) {echo $e; }
}
elseif ($QID2 >= 1)
{
  try 
    { 
        //2. Decline Student Application Details
        $common->Insert("UPDATE tbl_fee_upload_log SET isConfirmed = 3, confirmedBy = '{$GUID}', reason = '{$comments}' WHERE id = '{$QID2}';");
    }
    catch (Exception $e) {echo $e; }
}
elseif ($QID3 >= 1)
{
  try 
    { 
        $StudentID = $_GET['StudentID'];
        $StudentCreditedAmount = $_GET['Amount'];

        //3. Approve Students Credit
        $common->Insert("UPDATE fin_students_credits_log SET logApproved = 1, logApprovedByUID = '{$GUID}', approvalComments = '{$comments}' WHERE id = '{$QID3}';");
        
        //Add or Update Students Credit
        $RecordExists = $common->CCGetDBValue("SELECT creditAmount FROM `fin_students_credits` WHERE studentID = '{$StudentID}';");
        
        if($RecordExists) {
            $StudentNewCredit = $RecordExists - $StudentCreditedAmount;
            $common->Insert("UPDATE fin_students_credits SET creditAmount = '{$StudentNewCredit}' WHERE studentID = '{$StudentID}';");
        }
        else {
            $StudentNewCredit = 0 - $StudentCreditedAmount;
            $common->Insert("INSERT INTO fin_students_credits (studentID, creditAmount) VALUES ('{$StudentID}', '{$StudentNewCredit}');");
        }

        //Update Students Float amount
        $FloatExists = $common->CCGetDBValue("SELECT floatAmount FROM `tbl_students_float` WHERE studentFID = '{$StudentID}';");
        if($FloatExists) {
            $StudentNewFloat = $FloatExists + $StudentCreditedAmount;
            $common->Insert("UPDATE tbl_students_float SET floatAmount = '{$StudentNewFloat}' WHERE studentFID = '{$StudentID}';");
        }
        else {
            $StudentNewFloat = $StudentCreditedAmount;
            $common->Insert("INSERT INTO tbl_students_float (studentFID, floatAmount) VALUES ('{$StudentID}', '{$StudentNewFloat}');");
        }
        
    }
    catch (Exception $e) {echo $e; }
}
else
{

}
<?php
include_once('../sys/core/init.inc.php');
$common=new common();

if (filter_has_var(INPUT_POST, "SubmitApplicationApproval")) 
{
  try { 
        // Get vars
        $StudentSurname = $common->CCStrip($_POST['StudentSurname']); 
        $OtherNames = $common->CCStrip($_POST['OtherNames']);
        $ApplicationID = $common->CCStrip(strtolower($_POST['ApplicationID']));
        $StudentPhone = $common->CCStrip($_POST['StudentPhone']);
        $StudentDOB = $common->CCStrip($_POST['StudentDOB']);
        $StudentEmailAddress = $common->CCStrip($_POST['StudentEmailAddress']);
        $StudentGender = $common->CCStrip($_POST['StudentGender']);
        $StudentIDNumber = $common->CCStrip($_POST['StudentIDNumber']);
        $StudentMaritalStatus = $common->CCStrip($_POST['StudentMaritalStatus']);
        $StudentPostalAddress = $common->CCStrip($_POST['StudentPostalAddress']);
        $StudentCountry = $common->CCStrip($_POST['StudentCountry']);
        $StudentCitizenship = $common->CCStrip($_POST['StudentCitizenship']);
        $StudentPermanentAddress = $common->CCStrip($_POST['StudentPermanentAddress']);
        $StudentCity = $common->CCStrip($_POST['StudentCity']);
        $StudentFax = $common->CCStrip($_POST['StudentFax']);
        $StudentProgrammeId = $common->CCStrip($_POST['StudentProgrammeId']);
        $StudentPhoto = $common->CCStrip($_POST['StudentPhoto']);
        $AddApprovalNotes = $common->CCStrip($_POST['AddApprovalNotes']);
        $TodayYear = date("Y");
        $TodayDate = date("Y-m-d H:m:s");
        $ApprovedBy = $_SESSION['UserEmail'];

        //1. Update Student Application Details
        $SQL1 = "UPDATE apl_student_application_details SET application_status = '1', date_approved = '{$TodayDate}', approval_comments = '{$AddApprovalNotes}', approved_by = '{$ApprovedBy}' WHERE id = '{$ApplicationID}';";
        //echo $SQL1;
        $SQLUpdateApplication = $common->INSERT($SQL1);
        
        if($SQLUpdateApplication >= 1)
        {

            //2. Send Success Email to Student
            $CurrentYear = date('Y');
            $Citizenship = $common->CCStrip(strtolower($_POST['Citizenship']));
            $Email = $common->CCStrip(strtolower($_POST['Email']));
            $from = 'ecampus@maseno.ac.ke';
            $to = $Citizenship;
            $cc = $Email;
            $Bcc = "bmakhaya@maseno.ac.ke, mwangudi@gmail.com";
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: " . strip_tags($from) . "\r\n";
            $headers .= "cc: " . strip_tags($cc) . "\r\n";
            $headers .= "Bcc: " . strip_tags($Bcc) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $Emessage = '<html><body>';

            $Emessage .= '<center><table width="100%"; rules="all" style="border-style: solid; border:1px;  border-color:#41BEDD;" cellpadding="10">';
            $Emessage .= "<tr><td colspan='2'><a href='$SystemURI'><img src='admin/img/Maseno-University.png' alt='Logo' width='80px'/></a></td></tr>";
            $Emessage .= "<tr><td colspan='2'> Dear $Surname, <br /><br /> Your application has been successfully approved. <br /><br /> Kindly follow <a href='$SystemURI/new-students-payments'> this payment link </a> to make payments before enrollment. Your payment must include a statutory fee of Kes.2,900.00/= and atleast 2 modules for the programme you applied. <br/> <br/> Thank you for choosing to study with Maseno University. </td></tr>";
            $Emessage .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><p align='center'>&copy; $CurrentYear www.maseno.ac.ke </p></td></tr>";
            $Emessage .= "</table></center>";
            $Emessage .= "</body></html>";
            mail($to, "Application Approved ", $Emessage, $headers);
        }

    }
        catch (Exception $e) {echo $e; }
}
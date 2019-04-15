<?php
include_once('sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

if (filter_has_var(INPUT_POST, "StudentType")) 
{
  try { 
        //Application type 4. Face to face Student
        $ApplicationType = $common->CCStrip($_POST['StudentType']); 
        $Surname = $common->CCStrip($_POST['Surname']);
        $Othernames = $common->CCStrip(strtolower($_POST['Othernames']));
        $Gender = $common->CCStrip($_POST['Gender']);
        $DOB = $common->CCStrip($_POST['DOB']);
        $PersonalEmail = $common->CCStrip($_POST['PersonalEmail']);
        $InstitutionalEmail = $common->CCStrip($_POST['InstitutionalEmail']);
        $IDNumber = $common->CCStrip($_POST['IDNumber']);
        $YearofStudy = $common->CCStrip($_POST['KACYearofStudy']);
        $DoneOrientation = $common->CCStrip($_POST['DoneOrientation']);
        $PHTOption = $common->CCStrip($_POST['PHTOption']);
        $Campus = $common->CCStrip($_POST['Campus']);
        $ProgrammeID = $common->CCStrip($_POST['Programme']);
        $SchoolID = $common->CCStrip($_POST['School']);
        $PhoneNumber = $common->CCStrip($_POST['PhoneNumber']);
        $AdmissionNumber = $common->CCStrip($_POST['AdmissionNumber']);
        $KACYearofAdmission = $common->CCStrip($_POST['KACYearofAdmission']);

        //1. Create Student Application Details
        // 0. Pending Acknowlegement, 1. Pending admission, 2. In Session, 3. Discontinued/expelled
        $VarSql = "INSERT INTO apl_student_application_details (application_type, surname, othernames, gender, date_of_birth, personal_email, institution_email, phone_number, campus, programme, admission_number, school, done_orientation, PHTOption, current_year_of_study, year_of_admission, UPC, UIP) VALUES ('{$ApplicationType}', '{$Surname}','$Othernames','{$Gender}','{$DOB}','$PersonalEmail','{$InstitutionalEmail}','{$PhoneNumber}','{$Campus}','{$ProgrammeID}', '{$AdmissionNumber}', '{$SchoolID}', '{$DoneOrientation}', '{$PHTOption}', '{$YearofStudy}', '{$KACYearofAdmission}', '{$Remote}', '{$RemoteBrowser}');";
        $SQLInsert = $common->INSERT($VarSql);
        //echo $VarSql;

        if($SQLInsert >= 1)
        {
            $CurrentYear = date('Y');
            $Email = $common->CCStrip(strtolower($_POST['Email']));
            $from = 'ecampus@maseno.ac.ke';
            $to = $Email;
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
            $Emessage .= "<tr><td colspan='2'><a href='$SystemURI'><img src='$SystemURI/assets/img/<?php echo $companyLogo; ?>' alt='Logo' width='180px'/></a></td></tr>";
            $Emessage .= "<tr><td colspan='2'> Dear $Surname, <br /><br /> Thank you for registering with us for e-learning. Our administrator will review your application and an email will be sent to you upon successful confirmation. </td></tr>";
            $Emessage .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><p align='center'>&copy; $CurrentYear www.maseno.ac.ke </p></td></tr>";
            $Emessage .= "</table></center>";
            $Emessage .= "</body></html>";
            mail($to, "Certificate/Diploma Registration", $Emessage, $headers);
        }

    }
        catch (Exception $e) {echo $e; }
}
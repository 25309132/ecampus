<?php
include_once('../sys/core/init.inc.php');
$common = new common();
$QID = $_POST['GFID'];
$ApprovalComments = $_POST['ApprovalComments'];
$paymentID = $_POST['SubmitApplicationApproval'];
$paymentreference = $_POST['paymentreference'];
$paymentAmount = $_POST['Amount'];
$paymentOptionID = $_POST['payment_option_id'];
$receiptFile = $_POST['receiptFile'];
$paymentDateLogged = $_POST['paymentDateLogged'];

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
$GetUserID = $_SESSION['UserEmail'];

$GetPC3 = $common->GetRows("SELECT * FROM tbl_students WHERE id = '{$studentID}' ");
foreach ($GetPC3 as $gsdata3) 
{
    $surname = $gsdata3['surname'];
    $othernames = $gsdata3['othernames'];
    $admission_number = $gsdata3['admission_number'];
}

$GetTotalPrice = $common->CCGetDBValue("SELECT `tp`.`floatAmount` FROM tbl_students_float `tp` WHERE `tp`.`studentFID` = '{$studentID}';");

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
        $SQLUpdateApplication = $common->INSERT("UPDATE apl_student_application_details SET application_status = '2' WHERE id = '{$ApplicationID}';");
        
        //Generate Admission Number
        $GetApplicationType = $common->CCStrip($_POST['GetApplicationType']);
        $ProgrammeCode = $common->CCStrip($_POST['ProgrammeCode']);
        if($GetApplicationType == 1)
        {
            $NumberNow = $common->CCGetDBValue("SELECT postGraduateCodeSeries FROM tbl_references_serialization ORDER BY id DESC LIMIT 1;");
            $CourseRef = 'EL';
        }
        elseif ($GetApplicationType == 2)
        {
            $NumberNow = $common->CCGetDBValue("SELECT underGraduateCodeSeries FROM tbl_references_serialization ORDER BY id DESC LIMIT 1;");
            $CourseRef = 'EL';
        } 
        elseif ($GetApplicationType == 3)
        {
            $NumberNow = $common->CCGetDBValue("SELECT diplomaCodeSeries FROM tbl_references_serialization ORDER BY id DESC LIMIT 1;");
            $CourseRef = 'EL';
        }
        else 
        {
            $NumberNow = 0;
        }
        
        $StudentAdmissionNumber = $CourseRef.'/'.$ProgrammeCode.'/'.$NumberNow.'/'.$TodayYear;
        $NumberUpdated = $NumberNow+1;

        //2. Create Student Details
        $VarSql = "INSERT INTO tbl_students (surname, othernames, gender, date_of_birth, idpassport, personal_email, marital_status, phone_number, programme, postal_address, country, citizenship, permanent_address, city, fax, year_of_admission, student_applications_details_id, student_image, registered_by, admission_number) VALUES ('{$StudentSurname}','{$OtherNames}', '{$StudentGender}', '{$StudentDOB}', '{$StudentIDNumber}', '{$StudentEmailAddress}', '{$StudentMaritalStatus}', '{$StudentPhone}', '{$StudentProgrammeId}', '{$StudentPostalAddress}', '{$StudentCountry}', '{$StudentCitizenship}', '{$StudentPermanentAddress}', '{$StudentCity}', '{$StudentFax}', '{$TodayYear}', '{$ApplicationID}', '{$StudentPhoto}', '{$ApprovedBy}', '{$StudentAdmissionNumber}');";

        //echo $VarSql;
        $SQLInsert = $common->INSERT($VarSql);
        
        if($SQLInsert >= 1)
        {
            //3. Update Student payment Details
            $common->Insert("UPDATE fin_new_students_payments SET isConfirmed = 1, confirmedBy = '{$GetUserID}', approvalComments = '{$ApprovalComments}' WHERE id = '{$paymentID}' ");
            
            //current_year_of_study
            $GetCurrentYear = $common->CCGetDBValue("SELECT current_year_of_study FROM tbl_students WHERE id = '{$SQLInsert}';");
            
            //4. Insert into paid Statutory
            $common->Insert("INSERT INTO fin_statutory_fee_payments (student_id, year_id, transactionReferenceCode) VALUES ('{$SQLInsert}', '{$GetCurrentYear}', '{$paymentreference}')");
            $BalanceForFloat =  $paymentAmount - 2900;
            
            //5. Add fee in fee log to update student float
            $SQLCreate = "INSERT INTO tbl_fee_upload_log (studentID, paymentTypeID, amountPaid, paymentReference, receiptFile, dateLogged) VALUES ('{$SQLInsert}', '{$paymentOptionID}', '{$BalanceForFloat}', '{$paymentreference}', '{$receiptFile}', '{$paymentDateLogged}')";
            $SQLInsertPayment = $common->Insert($SQLCreate);
            
            $common->Insert("UPDATE tbl_fee_upload_log SET isConfirmed = 1, confirmedBy = '{$GetUserID}' WHERE id = '{$SQLInsertPayment}' ");

            //6. Update Serialization table
            if($GetApplicationType == 1)
            {
                $common->Insert("INSERT INTO tbl_references_serialization (postGraduateCodeSeries) VALUES ('{$NumberUpdated}')");
            }
            elseif ($GetApplicationType == 2)
            {
                $common->Insert("INSERT INTO tbl_references_serialization (underGraduateCodeSeries) VALUES ('{$NumberUpdated}')");
            } 
            elseif ($GetApplicationType == 3)
            {
                $common->Insert("INSERT INTO tbl_references_serialization (diplomaCodeSeries) VALUES ('{$NumberUpdated}')");
            }
            else { }
            
            //7. Create User account to login to student area
            $StudentNames = $OtherNames.' '.$StudentSurname;
            $OneTimePassword = $password = md5($StudentIDNumber);
            
            $SQL2 = "INSERT INTO tbl_users (names, uname, email, pass, group_id, photo, phone, gender, user_title, idnumber) VALUES ('{$StudentNames}', '{$StudentAdmissionNumber}', '{$StudentEmailAddress}', '{$OneTimePassword}', '3', '{$StudentPhoto}', '{$StudentPhone}', '{$StudentGender}', 'Student', '{$StudentIDNumber}')";
            //echo $SQL2;

            $common->Insert($SQL2);

            //8. Send Email to student
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
            $Emessage .= "<tr><td colspan='2'><a href='$SystemURI'><img src='$SystemURI/img/<?php echo $coop_logo; ?>' alt='Logo' width='180px'/></a></td></tr>";
            $Emessage .= "<tr><td colspan='2'> Dear $Surname, <br /><br /> Your application process has been completed upon making payments. Your Admission Number is: " . $StudentAdmissionNumber .". <br/> Kindly use the following Username and password to login to your student area: Username: ". $StudentAdmissionNumber .". Password: ". $StudentIDNumber ." <br/><br/> Thank you choosing to study with Maseno University eCampus </td></tr>";
            $Emessage .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><p align='center'>&copy; $CurrentYear www.maseno.ac.ke </p></td></tr>";
            $Emessage .= "</table></center>";
            $Emessage .= "</body></html>";
            mail($to, "Application Approved ", $Emessage, $headers);
        }

    }
        catch (Exception $e) {echo $e; }
}

?>
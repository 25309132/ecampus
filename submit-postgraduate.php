<?php
include_once('sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
if (filter_has_var(INPUT_POST, "StudentType")) 
{
  try 
    { 
        //Application type 1. Post graduate 2. Undergraduate 3. Certificate
        $ApplicationType = $common->CCStrip($_POST['StudentType']); 
        $Surname = $common->CCStrip($_POST['Surname']);
        $Othernames = $common->CCStrip(strtolower($_POST['Othernames']));
        $Gender = $common->CCStrip($_POST['Gender']);
        $DOB = $common->CCStrip($_POST['DOB']);
        $Email = $common->CCStrip($_POST['Email']);
        $IDNumber = $common->CCStrip($_POST['IDNumber']);
        $MaritalStatus = $common->CCStrip($_POST['MaritalStatus']);
        $Citizenship = $common->CCStrip($_POST['Citizenship']);
        $PhoneNumber = $common->CCStrip($_POST['PhoneNumber']);
        $Fax = $common->CCStrip($_POST['Fax']);
        $PostalAddress = $common->CCStrip($_POST['PostalAddress']);
        $CurrentAddress = $common->CCStrip($_POST['CurrentAddress']);
        $PermanentAddress = $common->CCStrip($_POST['PermanentAddress']);
        $TownCity = $common->CCStrip($_POST['TownCity']);
        $SecondaryAttended = $common->CCStrip($_POST['SecondaryAttended']);
        $UniversityAttended = $common->CCStrip($_POST['UniversityAttended']);
        $FieldOfStudy = $common->CCStrip($_POST['FieldOfStudy']);
        $DateFrom = $common->CCStrip($_POST['DateFrom']);
        $DateTo = $common->CCStrip($_POST['DateTo']);
        $DegreeAwarded = $common->CCStrip($_POST['DegreeAwarded']);
        $DateAwarded = $common->CCStrip($_POST['DateAwarded']);
        $UniversityAttended2 = $common->CCStrip($_POST['UniversityAttended2']);
        $FieldOfStudy2 = $common->CCStrip($_POST['FieldOfStudy2']);
        $DateFrom2 = $common->CCStrip($_POST['DateFrom2']);
        $DateTo2 = $common->CCStrip($_POST['DateTo2']);
        $DegreeAwarded2 = $common->CCStrip($_POST['DegreeAwarded2']);
        $DateAwarded2 = $common->CCStrip($_POST['DateAwarded2']);
        $OtherDegreeDateAwarded = $common->CCStrip($_POST['OtherDegreeDateAwarded']);
        $Research1 = $common->CCStrip($_POST['Research1']);
        $Research2 = $common->CCStrip($_POST['Research2']);
        //$research1Attachment = $common->CCStrip($_POST['research1Attachment']);
        //$research2Attachment = $common->CCStrip($_POST['research2Attachment']);
        $EmploymentPosition = $common->CCStrip($_POST['EmploymentPosition']);
        $EmploymentPlace = $common->CCStrip($_POST['EmploymentPlace']);
        $EmploymentStartDate = $common->CCStrip($_POST['EmploymentStartDate']); 
        $EmploymentEndDate = $common->CCStrip($_POST['EmploymentEndDate']);
        $LanguageSpoken = $common->CCStrip($_POST['LanguageSpoken']);
        $HigherDegree = $common->CCStrip($_POST['HigherDegree']);
        $ProposedStartDate = $common->CCStrip($_POST['ProposedStartDate']);
        $ExpectedCompletionDate = $common->CCStrip($_POST['ExpectedCompletionDate']);
        $ResearchInstitution = $common->CCStrip($_POST['ResearchInstitution']);
        $ConceptPaperName = $common->CCStrip($_POST['ConceptPaperName']);
        //$DoctorateConceptPaper = $common->CCStrip($_POST['DoctorateConceptPaper']);
        $optradio = $common->CCStrip($_POST['optradio']);
        $MastersDegreeThesisName = $common->CCStrip($_POST['MastersDegreeThesisName']);
        $MastersDegreeProjectName = $common->CCStrip($_POST['MastersDegreeProjectName']);
        $HowToFinance = $common->CCStrip($_POST['HowToFinance']);
        $Referee1Name = $common->CCStrip($_POST['Referee1Name']);
        $Referee1Title = $common->CCStrip($_POST['Referee1Title']);
        $Referee1Address = $common->CCStrip($_POST['Referee1Address']);
        $Referee1Email = $common->CCStrip($_POST['Referee1Email']);
        $Referee1Telephone = $common->CCStrip($_POST['Referee1Telephone']);
        $Referee1Email = $common->CCStrip($_POST['Referee1Email']);
        $Referee2Name = $common->CCStrip($_POST['Referee2Name']);
        $Referee2Title = $common->CCStrip($_POST['Referee2Title']);
        $Referee2Address = $common->CCStrip($_POST['Referee2Address']);
        $Referee2Email = $common->CCStrip($_POST['Referee2Email']);
        $Referee2Telephone = $common->CCStrip($_POST['Referee2Telephone']);
        
        $Country = $common->CCStrip($_POST['Country']);
        $CountryName = $common->CCStrip($_POST['CountryName']);
        $County = $common->CCStrip($_POST['CountyID']);
        $CountyName = $common->CCStrip($_POST['CountyName']);
        
        $AllowedFileTypes = array("application/pdf", 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/rtf');
        $AllowedFileTypesPhoto = array("image/png', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg'");
        $dir_base = "admin/management/uploads/";
        $dir_base_photo = "admin/img/students/";
        
        if (in_array($_FILES["photo"]["type"], $AllowedFileTypesPhoto)) {
            $UploadedFile = is_uploaded_file($_FILES['photo']['tmp_name']);
            if ($UploadedFile)
            {
                $safe_filename = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['photo']['name']));
                $UploadedStudentImage = strtotime("now") . $safe_filename1;
                move_uploaded_file($_FILES['photo']['tmp_name'], $dir_base_photo . $UploadedStudentImage);
            }
        }

        if (in_array($_FILES["research1Attachment"]["type"], $AllowedFileTypes)) {
            $UploadedFile1 = is_uploaded_file($_FILES['research1Attachment']['tmp_name']);
            if ($UploadedFile1)
            {
                $safe_filename1 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['research1Attachment']['name']));
                $research1Attachment = strtotime("now") . $safe_filename1;
                move_uploaded_file($_FILES['research1Attachment']['tmp_name'], $dir_base . $research1Attachment);
            }
        }

        if (in_array($_FILES["research2Attachment"]["type"], $AllowedFileTypes)) {
            $UploadedFile2 = is_uploaded_file($_FILES['research2Attachment']['tmp_name']);
            if ($UploadedFile2) 
            {
                $safe_filename2 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['research2Attachment']['name']));
                $research2Attachment = strtotime("now") . $safe_filename2;
                move_uploaded_file($_FILES['research2Attachment']['tmp_name'], $dir_base . $research2Attachment);
            }
        }

        if (in_array($_FILES["DoctorateConceptPaper"]["type"], $AllowedFileTypes)) {
            $UploadedFile3 = is_uploaded_file($_FILES['DoctorateConceptPaper']['tmp_name']);
            if ($UploadedFile3)
            {
                $safe_filename3 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['DoctorateConceptPaper']['name']));
                $DoctorateConceptPaper = strtotime("now") . $safe_filename3;
                move_uploaded_file($_FILES['DoctorateConceptPaper']['tmp_name'], $dir_base . $DoctorateConceptPaper);
            }
        }

        if (in_array($_FILES["degeree1Upload"]["type"], $AllowedFileTypes)) {
            $UploadedFile4 = is_uploaded_file($_FILES['degeree1Upload']['tmp_name']);
            if ($UploadedFile4)
            {
                $safe_filename4 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['degeree1Upload']['name']));
                $degeree1FileUpload = strtotime("now") . $safe_filename4;
                move_uploaded_file($_FILES['degeree1Upload']['tmp_name'], $dir_base . $degeree1FileUpload);
            }
        }

        if (in_array($_FILES["degeree2Upload"]["type"], $AllowedFileTypes)) {
            $UploadedFile5 = is_uploaded_file($_FILES['degeree2Upload']['tmp_name']);
            if ($UploadedFile5)
            {
                $safe_filename5 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['degeree2Upload']['name']));
                $degeree2FileUpload = strtotime("now") . $safe_filename5;
                move_uploaded_file($_FILES['degeree2Upload']['tmp_name'], $dir_base . $degeree2FileUpload);
            }
        }

        if (in_array($_FILES["OtherDegreesUpload"]["type"], $AllowedFileTypes)) {
            $UploadedFile6 = is_uploaded_file($_FILES['OtherDegreesUpload']['tmp_name']);
            if ($UploadedFile6)
            {
                $safe_filename6 = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['OtherDegreesUpload']['name']));
                $OtherDegreesFileUpload = strtotime("now") . $safe_filename6;
                move_uploaded_file($_FILES['OtherDegreesUpload']['tmp_name'], $dir_base . $OtherDegreesFileUpload);
            }
        }
        
        //kace_certificate_upload kcpe_certificate_upload degree_certificate_upload
        //echo $_FILES['research2Attachment']['name']. ' File Name: research 2 Attachment <br />';
        //echo $_FILES['DoctorateConceptPaper']['name']. ' File Name: Doctorate Concept Paper <br />';

        //1. Create Student Details
        // 0. Pending Acknowlegement, 1. Pending admission, 2. In Session, 3. Discontinued/expelled
        $VarSql = "INSERT INTO apl_student_application_details (application_type, surname, othernames, gender, date_of_birth, personal_email, idpassport, marital_status, currentAddress, phone_number, fax, postal_address, country, countryID, county, countyID, permanent_address, city, secondary_attended, firstdegree_institution, firstdegree_field, firstdegree_datefrom, firstdegree_dateto, firstdegree_degree, firstdegree_dateawarded, seconddegree_institution, seconddegree_field, seconddegree_datefrom, seconddegree_dateto, seconddegree_degree, seconddegree_dateawarded, other_degrees, research_one, research_one_attachment, research_two, research_two_attachment, employement_position, employment_place, employment_start_date, employment_end_date, language_spoken, programme, higher_degree_start_date, higher_degree_end_date, research_institution, concept_paper_name, concept_paper_upload, mastersdegreeby, mastersdegree_thesis_name, mastersdegree_project_name, how_to_finance, referee1, referee1_title, referee1_address, referee1_email, referee1_phone, referee2, referee2_title, referee2_address, referee2_email, referee2_phone, campus, UPC, UIP, student_image, firstDegreeCertificateUpload, secondDegreeCertificateUpload, otherDegreesUpload) VALUES ('{$ApplicationType}','{$Surname}','{$Othernames}', '{$Gender}', '{$DOB}', '{$Email}', '{$IDNumber}', '{$MaritalStatus}', '{$CurrentAddress}', '{$PhoneNumber}', '{$Fax}', '{$PostalAddress}', '{$CountryName}', '{$Country}', '{$CountyName}', '{$County}','{$PermanentAddress}', '{$TownCity}', '{$SecondaryAttended}', '{$UniversityAttended}', '{$FieldOfStudy}', '{$DateFrom}', '{$DateTo}', '{$DegreeAwarded}', '{$DateAwarded}', '{$UniversityAttended2}', '{$FieldOfStudy2}', '{$DateFrom2}', '{$DateTo2}', '{$DegreeAwarded2}', '{$DateAwarded2}', '{$OtherDegreeDateAwarded}', '{$Research1}', '{$research1Attachment}', '{$Research2}', '{$research2Attachment}', '{$EmploymentPosition}', '{$EmploymentPlace}', '{$EmploymentStartDate}', '{$EmploymentEndDate}', '{$LanguageSpoken}', '{$HigherDegree}', '{$ProposedStartDate}', '{$ExpectedCompletionDate}', '{$ResearchInstitution}', '{$ConceptPaperName}', '{$DoctorateConceptPaper}', '{$optradio}', '{$MastersDegreeThesisName}', '{$MastersDegreeProjectName}', '{$HowToFinance}', '{$Referee1Name}', '{$Referee1Title}', '{$Referee1Address}', '{$Referee1Email}', '{$Referee1Telephone}', '{$Referee2Name}', '{$Referee2Title}', '{$Referee2Address}', '{$Referee2Email}', '{$Referee2Telephone}', 1, '{$Remote}', '{$RemoteBrowser}', '{$UploadedStudentImage}', '{$degeree1FileUpload}', '{$degeree2FileUpload}', '{$OtherDegreesFileUpload}');";
        
        $SQLInsert = $common->INSERT($VarSql);

        echo $VarSql;

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
          $Emessage .= "<tr><td colspan='2'>Dear $Surname, <br /><br /> Thank you for registering with us for e-learning. Our administrator will review your application and an email will be sent to you upon successful confirmation.</td></tr>";
          $Emessage .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><p align='center'>&copy; $CurrentYear www.maseno.ac.ke </p></td></tr>";
          $Emessage .= "</table></center>";
          $Emessage .= "</body></html>";
          mail($to, "Post Graduate Registration", $Emessage, $headers);

        } 
    }
        catch (Exception $e) {echo $e; }
}
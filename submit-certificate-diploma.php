<?php
include_once('sys/core/init.inc.php');
$common=new common();
$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
if (filter_has_var(INPUT_POST, "StudentType")) 
{
  try { 
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
        $CurrentAddress = $common->CCStrip($_POST['CurrentAddress']);
        $PermanentAddress = $common->CCStrip($_POST['PermanentAddress']);
        $SecondaryAttended = $common->CCStrip($_POST['SecondaryAttended']);
        $ProgrammeApplyingFor = $common->CCStrip($_POST['ProgrammeApplyingFor']);
        $SecDateFrom = $common->CCStrip($_POST['SecDateFrom']);
        $SecDateTo = $common->CCStrip($_POST['SecDateTo']);
        $SecYearofAdmission = $common->CCStrip($_POST['SecYearofAdmission']);
        $SecExaminationBody = $common->CCStrip($_POST['SecExaminationBody']);
        $SecIndexNumber = $common->CCStrip($_POST['SecIndexNumber']);
        $SecMeanGrade = $common->CCStrip($_POST['SecMeanGrade']);
        $SecAwardedPoints = $common->CCStrip($_POST['SecAwardedPoints']);
        $KACSecondaryAttended = $common->CCStrip($_POST['KACSecondaryAttended']);
        $KACAdmissionDate = $common->CCStrip($_POST['KACAdmissionDate']);
        $KACGraduationDate = $common->CCStrip($_POST['KACGraduationDate']);
        $KACYearofExamination = $common->CCStrip($_POST['KACYearofExamination']);
        $KACExaminationBody = $common->CCStrip($_POST['KACExaminationBody']);
        $KACIndexNumber = $common->CCStrip($_POST['KACIndexNumber']);
        $KACResultPrinciple = $common->CCStrip($_POST['KACResultPrinciple']);
        $KACSubsidiaryPass = $common->CCStrip($_POST['KACSubsidiaryPass']);
        $EmploymentPosition = $common->CCStrip($_POST['EmploymentPosition']);
        $EmploymentPlace = $common->CCStrip($_POST['EmploymentPlace']);
        $EmploymentStartDate = $common->CCStrip($_POST['EmploymentStartDate']); 
        $EmploymentEndDate = $common->CCStrip($_POST['EmploymentEndDate']);
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
        $LanguageSpoken = $common->CCStrip($_POST['LanguageSpoken']);
        $Country = $common->CCStrip($_POST['CurrentAddress']);
        $PostalAddress = $common->CCStrip($_POST['PostalAddress']);
        $UniversityAttended = null;
        $FieldOfStudy = null;
        $DateFrom = null;
        $DateTo = null;
        $DegreeAwarded = null;
        $DateAwarded = null;
        $UniversityAttended2 = null;
        $FieldOfStudy2 = null;
        $DateFrom2 = null;
        $DateTo2 = null;
        $DegreeAwarded2 = null;
        $DateAwarded2 = null;
        $OtherDegreeDateAwarded = null;
        $Research1 = null;
        $Research2 = null;
        $HigherDegree = null;
        $ProposedStartDate = null;
        $ExpectedCompletionDate = null;
        $ResearchInstitution = null;
        $ConceptPaperName = null;
        $optradio = null;
        $MastersDegreeThesisName = null;
        $MastersDegreeProjectName = null;
        $HowToFinance = null;

        //1. Create Student Application Details
        // 0. Pending Acknowlegement, 1. Pending admission, 2. In Session, 3. Discontinued/expelled
        $VarSql = "INSERT INTO apl_student_application_details (application_type, surname, othernames, gender, date_of_birth, personal_email, idpassport, marital_status, citizenship, phone_number, postal_address, country, permanent_address, city, secondary_attended, sec_admission_date, sec_completion_date, sec_exam_year, sec_exam_body, sec_index_number, sec_meangrade, sec_points, kace_school_attended, kace_admission_date, kace_completion_date, kace_exam_year, kace_exam_body, kace_index_number, kace_pricipal_pass, kace_subsicidiary_pass, firstdegree_institution, firstdegree_field, firstdegree_datefrom, firstdegree_dateto, firstdegree_degree, firstdegree_dateawarded, seconddegree_institution, seconddegree_field, seconddegree_datefrom, seconddegree_dateto, seconddegree_degree, seconddegree_dateawarded, other_degrees, research_one, research_one_attachment, research_two, research_two_attachment, employement_position, employment_place, employment_start_date, employment_end_date, language_spoken, programme, higher_degree_start_date, higher_degree_end_date, research_institution, concept_paper_name, concept_paper_upload, mastersdegreeby, mastersdegree_thesis_name, mastersdegree_project_name, how_to_finance, referee1, referee1_title, referee1_address, referee1_email, referee1_phone, referee2, referee2_title, referee2_address, referee2_email, referee2_phone, campus, UPC, UIP) VALUES ('{$ApplicationType}','{$Surname}','{$Othernames}', '{$Gender}', '{$DOB}', '{$Email}', '{$IDNumber}', '{$MaritalStatus}', '{$Citizenship}', '{$PhoneNumber}', '{$PostalAddress}', '{$Country}', '{$PermanentAddress}', '{$CurrentAddress}', '{$SecondaryAttended}', '{$SecDateFrom}', '{$SecDateTo}', '{$SecYearofAdmission}', '{$SecExaminationBody}', '{$SecIndexNumber}', '{$SecMeanGrade}', '{$SecAwardedPoints}', '{$KACSecondaryAttended}', '{$KACAdmissionDate}', '{$KACGraduationDate}', '{$KACYearofExamination}', '{$KACExaminationBody}', '{$KACIndexNumber}', '{$KACResultPrinciple}', '{$KACSubsidiaryPass}', '{$UniversityAttended}', '{$FieldOfStudy}', '{$DateFrom}', '{$DateTo}', '{$DegreeAwarded}', '{$DateAwarded}', '{$UniversityAttended2}', '{$FieldOfStudy2}', '{$DateFrom2}', '{$DateTo2}', '{$DegreeAwarded2}', '{$DateAwarded2}', '{$OtherDegreeDateAwarded}', '{$Research1}', '{$research1Attachment}', '{$Research2}', '{$research2Attachment}', '{$EmploymentPosition}', '{$EmploymentPlace}', '{$EmploymentStartDate}', '{$EmploymentEndDate}', '{$LanguageSpoken}', '{$ProgrammeApplyingFor}', '{$ProposedStartDate}', '{$ExpectedCompletionDate}', '{$ResearchInstitution}', '{$ConceptPaperName}', '{$DoctorateConceptPaper}', '{$optradio}', '{$MastersDegreeThesisName}', '{$MastersDegreeProjectName}', '{$HowToFinance}', '{$Referee1Name}', '{$Referee1Title}', '{$Referee1Address}', '{$Referee1Email}', '{$Referee1Telephone}', '{$Referee2Name}', '{$Referee2Title}', '{$Referee2Address}', '{$Referee2Email}', '{$Referee2Telephone}', 1, '{$Remote}', '{$RemoteBrowser}');";
        
        $SQLInsert = $common->INSERT($VarSql);

        //echo $VarSql;

        // Submit KCSE
        $DynamicSubjects = $common->CCStrip($_POST["DynamicSubjects"]);
        $Subject = $common->CCStrip($_POST["Subject"]);
        $GradeObtained = $common->CCStrip($_POST["GradeObtained"]);

        for ($i = 0; $i < count($DynamicSubjects); $i++) 
        {
            if(!empty($Subject[$i]))
            {  
                $VarS = "INSERT INTO `apl_kcse_subject_grades` (application_id, application_type, subject, grade) VALUES ('{$SQLInsert}', '{$ApplicationType}', '{$Subject[$i]}', '{$GradeObtained[$i]}')";
                $common->Insert($VarS);  
            }
        } 

        // Submit KACE
        $KACSubject = $common->CCStrip($_POST["KACSubject"]);
        $KACGradeObtained = $common->CCStrip($_POST["KACGradeObtained"]);
        $KACDynamicSubjects = $common->CCStrip($_POST["KACDynamicSubjects"]);
        
        for ($i = 0; $i < count($KACDynamicSubjects); $i++) 
        {
            if(!empty($KACSubject[$i]))
            {  
                $VarS = "INSERT INTO `apl_kace_subject_grades` (application_id, application_type, subject, grade) VALUES ('{$SQLInsert}', '{$ApplicationType}', '{$KACSubject[$i]}', '{$KACGradeObtained[$i]}')";
                $common->Insert($VarS);  
            }
        }

        // Submit Professional Qualifications
        //ProfessionalQualification Qualifications WhereObtained QualificationsStartDate QualificationsEndDate AwardObtained
        $ProfessionalQualification = $common->CCStrip($_POST["ProfessionalQualification"]);
        $Qualifications = $common->CCStrip($_POST["Qualifications"]);
        $WhereObtained = $common->CCStrip($_POST["WhereObtained"]);
        $QualificationsStartDate = $common->CCStrip($_POST["QualificationsStartDate"]);
        $QualificationsEndDate = $common->CCStrip($_POST["QualificationsEndDate"]);
        $AwardObtained = $common->CCStrip($_POST["AwardObtained"]);
        
        for ($i = 0; $i < count($ProfessionalQualification); $i++) 
        {
            if(!empty($Qualifications[$i]))
            {  
                $VarS = "INSERT INTO `apl_professional_qualifications` (application_id, application_type, qualification, place_obtained, start_date, end_date, award_obtained) VALUES ('{$SQLInsert}', '{$ApplicationType}', '{$Qualifications[$i]}', '{$WhereObtained[$i]}', '{$QualificationsStartDate[$i]}', '{$QualificationsEndDate[$i]}', '{$AwardObtained[$i]}')";
                
                $common->Insert($VarS);  
            }
        }

        // Submit Employment History
        // DynamicFieldPosition Position EmploymentStartDate EmploymentEndDate
        $DynamicFieldPosition = $common->CCStrip($_POST["DynamicFieldPosition"]);
        $Position = $common->CCStrip($_POST["Position"]);
        $EmploymentStartDate = $common->CCStrip($_POST["EmploymentStartDate"]);
        $EmploymentEndDate = $common->CCStrip($_POST["EmploymentEndDate"]);
        $EmploymentPlace = $common->CCStrip($_POST["EmploymentPlace"]);
        
        for ($i = 0; $i < count($DynamicFieldPosition); $i++) 
        {
            if(!empty($Position[$i]))
            {  
                $VarS = "INSERT INTO `apl_employment_history` (application_id, application_type, position, place, start_date, end_date) VALUES ('{$SQLInsert}', '{$ApplicationType}', '{$Position[$i]}', '{$EmploymentPlace[$i]}', '{$EmploymentStartDate[$i]}', '{$EmploymentEndDate[$i]}')";
                $common->Insert($VarS);  
            }
        }
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
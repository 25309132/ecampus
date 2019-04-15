<?php
error_reporting(0);
include_once('sys/core/init.inc.php');
$common = new common();

$RemoteIP = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$UserBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);

// Update User Credentials
if (filter_has_var(INPUT_POST, "UUserCredentialsEmail")) 
    {
        try {
                $Current_Password = $common->CCStrip($_POST['Current_Password']);
                $UUserCredentialsEmail = $common->CCStrip(strtolower($_POST['UUserCredentialsEmail']));
                $New_Password = $common->CCStrip($_POST['New_Password']);
                $Your_Username = $common->CCStrip($_POST['Your_Username']);
                $Retype_Password = $common->CCStrip(md5($_POST['Retype_Password'])); 


                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $UUserCredentialsEmail)) 
                    {
                        $common->Insert("UPDATE tbl_users SET uname = '{$Your_Username}', pass = '{$Retype_Password}' WHERE email = '{$UUserCredentialsEmail}' ");
                    }
            } catch (Exception $e) { echo $e;}
    }
// End Update 


// Update User Contact Details
elseif (filter_has_var(INPUT_POST, "UUContactsemail")) 
    {
        try {
                $GenderID = $common->CCStrip($_POST['GenderID']);
                $Your_Telephone = $common->CCStrip($_POST['Your_Telephone']);
                $Your_Names = $common->CCStrip($_POST['Your_Names']);
                $UTitle = $common->CCStrip($_POST['UTitle']); 
                $UUContactsemail = $common->CCStrip(strtolower($_POST['UUContactsemail']));

                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $UUContactsemail)) 
                    {
                        $common->Insert("UPDATE tbl_users SET   phone = '{$Your_Telephone}' , names = '{$Your_Names}',  gender = '{$GenderID}', user_title = '{$UTitle}' WHERE email = '{$UUContactsemail}' ");
                    }
            } catch (Exception $e) { echo $e;}
    }
// End Update User Contact Details

// Update User Contact Details
elseif (filter_has_var(INPUT_POST, "UUProfilePhotoFemail")) 
    {
        try {
                $AllowedFileTypesTN = array('image/png', 'image/jpeg','image/pjpeg','image/jpeg','image/pjpeg','image/gif');
                $dir_baseTN = "img/users/";
           
                if (in_array($_FILES["photo"]["type"], $AllowedFileTypesTN))
                    {
                        $isFile = is_uploaded_file($_FILES['photo']['tmp_name']);
                        if ($isFile)
                            {
                                $safemyeshopLogo = preg_replace(array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['photo']['name']));
                                $safeeshopLogodd = strtotime("now").$safemyeshopLogo;
                                move_uploaded_file($_FILES['photo']['tmp_name'], $dir_baseTN.$safeeshopLogodd);
                            }
                    }
                else
                    {
                      $safeeshopLogodd = 'user_avatar.png';
                    }

                $UUProfilePhotoFemail = $common->CCStrip(strtolower($_POST['UUProfilePhotoFemail']));
                $common->Insert("UPDATE tbl_users SET photo = '{$safeeshopLogodd}' WHERE email = '{$UUProfilePhotoFemail}' ");
                   
            } catch (Exception $e) { echo $e;}
    }

$leo = date('Y');
//Start Send Support Email
if(filter_has_var(INPUT_POST, "Contact_Us_Email"))
    {
        try { 
            
            $cf_message = $common->CCStrip($_POST['Contact_Us_Comments']);
            $cf_subject = $common->CCStrip($_POST['Contact_Us_Subject']);
            $cf_telephone = $common->CCStrip($_POST['CUYour_Telephone']);
            $cf_email = $common->CCStrip($_POST['Contact_Us_Email']);
            $cf_name = $common->CCStrip($_POST['CUYour_Names']);
            $RemoteIP = $common->CCStrip($_SERVER['REMOTE_ADDR']);
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $cf_email))
            {
                //New HTML Email Scripts
                $to   = 'support@acculynksystems.com';
                $encodedEmail = urlencode($email);
                $from = strip_tags($cf_email);
                $headers = "From: " . strip_tags($from) . "\r\n";  
                //$headers .= "CC: jwapp084syntax@gmail.com \r\n"; 
                $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $message = '<html><body>';
                $message .= '<center><table width="100%"; rules="all" style="border-style: solid; border:1px;  border-color:#41BEDD;" cellpadding="10">';
                $message .= "<tr><td colspan='2'>Dear Support, <br /><br /> $cf_message<br /><br />Name: $cf_name,<br />Telephone: $cf_telephone, <br />Email: $cf_email<br />Contact Remote IP Address: $RemoteIP<br /><br />If you have any further questions, please call or email Support team on <a href='mailto:support@acculynksystems.com'> support@acculynksystems.com</a><br /><br />Thank You.<br />Best regards, <br />
                Support Team <br />
                www.acculynksystems.com<br />
                </td></tr></td></tr>";
                $message .= "</table></center>"; 
                $message .= "</body></html>";
                mail($to, $cf_subject, $message, $headers);
            }
        } catch (Exception $e) {echo $e;}
    }
?>

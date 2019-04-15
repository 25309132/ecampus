<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start(); // Start Session
header('Cache-control: private'); // IE 6 FIX
// always modified
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// HTTP/1.1
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
// HTTP/1.0
header('Pragma: no-cache');
//Cookie Setup Above

include_once('sys/core/init.inc.php');
$common = new common();

$yasavedemail = $_COOKIE['emailyako'];
$yasavedepassword = $_COOKIE['ingiamsee'];

$Remote = $common->CCStrip($_SERVER['REMOTE_ADDR']);
$RemoteBrowser = $common->CCStrip($_SERVER['HTTP_USER_AGENT']);
 
// Sign In User
if (filter_has_var(INPUT_POST, "PostSignIn")) {
    try { 
            $Uname_Email= $_POST['LoginUsername'];
            $PostPassword =md5($_POST['LoginPassword']);
            $autologin= $_POST['autologin'];

            if(!empty($Uname_Email) && !empty($PostPassword)){
                    $where = " WHERE isActive = 1 AND pass = '".$PostPassword."' AND (email = '".$Uname_Email."' OR uname = '".$Uname_Email."') ";
            }

            $CheckEmail = $common->CCGetDBValue("SELECT COUNT(email) FROM tbl_users WHERE (email = '".$Uname_Email."' OR uname =  '".$Uname_Email."') ");
            
            if($CheckEmail > 0){
                $CheckCreds = $common->GetRows("SELECT * FROM tbl_users " . $where . " ");
                    if (!$CheckCreds){
                        $ErrorCreds = 'Invalid log in credentials!';
                        $jsonCreds = array( "type" => "error", "OTPmsg" => "$ErrorCreds");
                        echo json_encode($jsonCreds);
                    } else {
                        foreach ($CheckCreds AS $RowCreds){ 
                            $_SESSION['UID']=$RowCreds["id"];
                            $_SESSION['GrpID']=$RowCreds["group_id"];
                            $_SESSION['UName']=$RowCreds["uname"];
                            $_SESSION['UsersNames']=$RowCreds["names"];
                            $_SESSION['UsersPhoneNumber']=$RowCreds["phone"];
                            $_SESSION['UserImage']=$RowCreds["photo"];
                            $_SESSION['UserEmail']=$RowCreds["email"];

                            $ConfirmedCreds   = 'Credentials Confirmed!';
                            $usergroup = $_SESSION['GrpID'];
                            $jsonArr = array( "type" => "success", "OTPVmsg" => "$ConfirmedCreds",  "UGroup" => "$usergroup");
                            echo json_encode( $jsonArr);
                        } 
                        // Set Login Cookies
                        if ($_POST['autologin'] == 1) {
                            $year = time() + 31536000;
                            setcookie('emailyako', $Uname_Email, $year);
                            setcookie('ingiamsee', $_POST['password'], $year);

                        } else {
                            if (isset($_COOKIE['emailyako'])) {
                                $past = time() - 100;
                                setcookie('emailyako', gone, $past);
                                setcookie('ingiamsee', gone, $past);
                            }
                        }

                        // Flag User Online Status
                        $common->Insert("UPDATE tbl_users SET online_status = 1, last_login = now() WHERE id = '{$RowCreds["id"]}' ");
                    }
                }
            else{
                $ConfirmedCreds   = 'Account Does NOT Exist!';
                $jsonArr = array( "type" => "error", "OTPmsg" => "$ConfirmedCreds");
                echo json_encode( $jsonArr);
            }
            
    } catch (Exception $e) {echo $e;}
}
?>
<?php
error_reporting(0);
session_start();
if(isset($_SESSION['SESSION_EMAIL']))
{
	header("Location: index");	
}
include_once('sys/core/initialize.php');
$sql=new common(); 

if(filter_has_var(INPUT_POST, "Reset_Password"))
{
try   
{ 
	$Uname_Email = $sql->CCStrip(strtolower($_POST['Uname_Email']));

if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",  $Uname_Email))
{
	$activation = md5(uniqid(rand(), true));

	$ifuserin = $sql->GetRows("SELECT * FROM tbl_system_users WHERE user_email = '{$Uname_Email}' ");
		if(!$ifuserin)
		{
			$IFloginerror = '<div class="alert alert-danger alert-dismissable t_align_c m_all_round">Email Provided is Non-Existent!</div>';
		}
		else
		{
			$ULSU = $sql->Insert("UPDATE tbl_system_users SET pass_reset_token =NULL WHERE user_email = '{$Uname_Email}' ");
			foreach($ifuserin AS $sslin)
			{
				$users_fullname = $sslin['users_fullname'];
				$org_cp_email = $sslin['org_cp_email'];
				
			}
			$ULSU = $sql->Insert("UPDATE tbl_system_users SET pass_reset_token = '{$activation}' WHERE user_email = '{$Uname_Email}' ");
			
			$cf_subject = 'EARF Account Password Reset';
			$to   = $Uname_Email;
			$from = "<webmaster@earesearchfund.org>";
			$OutgoingEmailName = "East Africa Research Fund";
			$encodedEmail = urlencode($Uname_Email);
			$headers = "From: " .$OutgoingEmailName. ' ' .strip_tags($from) . "\r\n";		
			$headers .= "CC:  " . strip_tags($org_cp_email). "\r\n"; 
			$headers .= "Reply-To: " .strip_tags($from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message .= '<center><table width="100%"; rules="all" style="border-style: solid; border:1px;  border-color:#41BEDD;" cellpadding="10">';
			$message .= "<tr><td colspan='2'><a href='http://www.earesearchfund.org'><img src='http://www.earesearchfund.org/sites/default/files/logo_0.png' alt='EARF Logo' width='120px'/></a></td></tr>"; 
			$message .= "<tr><td colspan='2'>Dear $users_fullname, <br /><br />A request for password reset has been logged.<br />Please click <a href='http://www.earesearchfund.org/earf/Reset?SEID=$encodedEmail&token=$activation'><b>HERE</b></a> to reset your password.<br /><br />If you did not make this request please contact our Support Team.<br /><br />Regards,<br /><b>East Africa Research Fund.</b></td></tr>";
			$message .= "<tr  style='background-color:#ECF0F1;'><td colspan='2'><center><p align='center'>&copy; 2015 www.earesearchfund.org  <br /><img src='http://www.earesearchfund.org/sites/default/files/logo_0.png' align='absmiddle' width='120px'></p></center></td></tr>"; 
			$message .= "</table></center>"; 
			$message .= "</body></html>";
			mail($to, $cf_subject, $message, $headers);			
			$IFloginerror = '<div class="alert alert-danger alert-dismissable t_align_c m_all_round">An email has been sent to ' .$Uname_Email . ' Please follow the instructions therein to Proceed!</div>';			
		}
}
else
	{
		$IFloginerror = '<div class="alert alert-danger alert-dismissable t_align_c m_all_round">The Provided Email is Invalid.</div>';
	}
}
catch (Exception $e) {echo $e;}
}
include_once('inc/header_login1.php');


?>
	<body class="skin-blue" style="background-color:#DFDFE2; font-family: candara, verdana">
<?php
		include_once('inc/header_login.php');
?>

	<!-- MAIN CONTENT -->
	<div id="content" class="container " style="max-width:500px;">
						<div class="well no-padding m_top_40">
							<form action="" id="login-form" class="smart-form client-form r_corners border_grey" name="login-form" method="POST">
								<header class="r_corners" style="text-align: center; background-color: #000000; color:#FFFFFF;">
									<?php if($IFloginerror){echo $IFloginerror;} else {echo "Password Reset"; } ?>									
								</header>

								<fieldset>
									
									<section>
										<label class="label">E-mail (Enter Your Email Address & Click Reset)</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="email" name="Uname_Email" autocomplete="off" required class="r_corners" placeholder="Enter your Email" value="<?php if(isset($_REQUEST['mx'])){ echo $_REQUEST['mx'];} ; ?>">
											<b class="tooltip tooltip-top-right"> <i class="fa fa-user txt-color-teal"></i> Please enter Email address</b></label>
									</section>
								</fieldset>
								<footer>
										<button type="submit" class="btn btn-primary w_full" name="Reset_Password">
											<i class="fa fa-unlock"></i> Reset Your Password
										</button>
									<a href="index" class="btn btn-primary w_full"><i class="fa fa-lock"></i> Log in</a>

								</footer>
								
								<center><span class="p_bottom_20"><p class="p_bottom_20"><em>System is Registered to <b><a href="http://<?php echo $school_website; ?>" target="_blank"><?php echo $SystemRegisteredTo; ?></a> &copy; <?php echo date("Y"); ?></b></em></p><br /></span></center>
								
							</form>
						</div>
		</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				}
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				password : {
					required : 'Please enter your password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>
</body>
</html>
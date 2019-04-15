<?php
/**
* Common tasks
* @author Go Sheng Services
* @copyright 2014 AMREF Flying Doctors
*/
class Common extends DB_Connect
{
	public function __construct($dbo=NULL)
		{
			parent::__construct($dbo);
		}
	public function CCStrip($value)
		{
		  if(get_magic_quotes_gpc() != 0)
		  {
			if(is_array($value))  
			  foreach($value as $key=>$val)
				$value[$key] = stripslashes($val);
			else
			  $value = stripslashes($value);
		  }
		  return $value;
		}
	public function GetParam($parameter_name, $default_value = "")
		{
			$parameter_value = "";
			if(isset($_POST[$parameter_name]))
				$parameter_value = stripslashes($_POST[$parameter_name]);
			else if(isset($_GET[$parameter_name]))
				$parameter_value = stripslashes($_GET[$parameter_name]);
			else
				$parameter_value = $default_value;
			return $parameter_value;
		}
	public function CCGetDBValue($sql)
		{
		  $stmt = $this->db->prepare($sql);
		  $stmt->execute();
		  if ($stmt) 
				{ 
					if ($stmt->rowCount() > 0 ) { 
					   $result = $stmt->fetchColumn(); 
					}
					else $result="";
				}
		  return $result;  
		}
	public function JsonGetRows($sql)
		{
			try
				{
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return json_encode($results);
				}
			catch ( Exception $e )
			{
				die ( $e->getMessage() );
			}
		}
	public function JsonInsert($sql)
		{
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->closeCursor();
			return json_encode($this->db->lastInsertId());
			}
			catch ( Exception $e )
			{
			return $e->getMessage();
			}
		}	
	public function GetRows($sql)
		{
			try
				{
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $results;
				}
			catch ( Exception $e )
			{
				die ( $e->getMessage() );
			}
		}
	public function Insert($sql)
		{
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->closeCursor();
			return $this->db->lastInsertId();
			}
			catch ( Exception $e )
			{
			return $e->getMessage();
			}
		}
	public function Delete($sql)
		{
			try
			{
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$stmt->closeCursor();
			}
			catch ( Exception $e )
			{
			return $e->getMessage();
			}
		}
		
		public function sendEmail($email_sender,$from_name,$email_body,$email_receiver,$email_subject,$add_reply_to,$attachment=null)
				{
					$success = "";			
							
							//Send email
							try {
								$mail = new PHPMailer(true); //New instance, with exceptions enabled
							
								$body             = $email_body;//email body
								$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
							
								$mail->IsSMTP();                           // tell the class to use SMTP
								$mail->SMTPAuth   = true;                  // enable SMTP authentication
								$mail->Port       = 25;                    // set the SMTP server port
								$mail->Host       = trim("digitalshamba.co.ke"); // SMTP server
								$mail->Username   = trim('notifications@digitalshamba.co.ke');     // SMTP server username
								$mail->Password   = trim('n0t1f1c@t10n5');    
							
								$mail->From       = $email_sender;
								$mail->FromName   = "".$from_name."";
								
							
								$to = trim($email_receiver);//mail list
								$mail->AddAddress($to);
								$mail->AddAddress($add_reply_to);
								//$mail->addReplyTo($add_reply_to);
							
								$mail->Subject  =$email_subject;
								$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
								$mail->WordWrap   = 80; // set word wrap
								if(!empty($attachment)){
								$mail->AddAttachment($attachment);// attachment
								}
								$mail->MsgHTML($body);
							
								$mail->IsHTML(true); // send as HTML
							
								$mail->Send();
								//$success .=  'Message has been sent.';
								} 
							catch (phpmailerException $e) {
								//$success .=  $e->errorMessage();
							}
						//End Custom Code
				}//end sender email function
}
?>
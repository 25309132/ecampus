<?php
/**
* Common tasks
* @author Go Sheng Services & Acculynk Systems
* @copyright 2014 Acculynk Systems
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
	public function Update($sql)
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
}
?>
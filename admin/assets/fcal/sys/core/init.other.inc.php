<?php
session_start();
ob_start();
/*
* Include the necessary configuration info
*/
include '../sys/config/db-cred.inc.php';
/*
* Define constants for configuration info
*/
foreach ( $C as $name => $val )
{
define($name, $val);
}

/*
* Create a PDO object
*/
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$dbo = new PDO($dsn, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
/*
* Define the auto-load function for classes
*/
function __autoload($class)
{
$class=strtolower($class);
$filename = "../sys/class/class." . $class . ".php";
if ( file_exists($filename) )
{
include_once $filename;
}
}
//CCStrip @0-E1370054 n
function CCStrip($value)
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
//End CCStrip

//CCGetParam @0-3BB7E2D4
function CCGetParam($parameter_name, $default_value = "")
{
    $parameter_value = "";
    if(isset($_POST[$parameter_name]))
        $parameter_value = CCStrip($_POST[$parameter_name]);
    else if(isset($_GET[$parameter_name]))
        $parameter_value = CCStrip($_GET[$parameter_name]);
    else
        $parameter_value = $default_value;
    return $parameter_value;
}
//End CCGetParam
/* Dealing with session
*/
if (CCGetUserAddr() != $_SERVER["REMOTE_ADDR"]) { CCLogoutUser(); }



function CCGetSession($parameter_name, $default_value = "")
{
session_start();
    $result = isset($_SESSION[$parameter_name]) ? $_SESSION[$parameter_name] : $default_value;
    session_write_close();
    return $result;
}
//End CCGetSession

//CCSetSession @0-025730A6
function CCSetSession($param_name, $param_value)
{
session_start();
    $_SESSION[$param_name] = $param_value;
    session_write_close();
}
//End CCSetSession

//CCGetCookie @0-6B04B9B5
function CCGetCookie($parameter_name)
{
    return isset($_COOKIE[$parameter_name]) ? $_COOKIE[$parameter_name] : "";
}
//End CCGetCookie

//CCSetCookie @0-1968C877
function CCSetCookie($parameter_name, $param_value, $expired = -1, $path = "/", $domain = "", $secured = false, $http_only = false)
{
  if ($expired == -1)
    $expired = time() + 3600 * 24 * 366;
  elseif ($expired && $expired < time())
    $expired = time() + $expired;
  setcookie ($parameter_name, $param_value, $expired, $path, $domain, $secured, $http_only);
}
//End CCSetCookie
//autologin
function AutoLogin($id)
{
	mysql_select_db("sxcok548_vps",mysql_connect("localhost","sxcok548_vpsu","VPSU!548"));
	$sql="SELECT dbu_id,db_login,security_id,location_id FROM tbl_u_members WHERE dbu_id='$id'";
				$result=mysql_query($sql)or die(mysql_error());
				while($row=mysql_fetch_array($result))
							{							
							CCSetSession("UserID", $row['dbu_id']);									
							CCSetSession("UserName", $row['db_login']);
							CCSetSession("GroupID", $row['security_id']);
							CCSetSession("UserAddr", $_SERVER["REMOTE_ADDR"]);
							CCSetSession("UserMtaa", $row['location_id']);						
							}
	}
//End autologin
//CCDLookUp @0-AD41DC8E
function CCDLookUp($field_name, $table_name, $where_condition)
{
   $stmt=new common();
  $sql = "SELECT " . $field_name . ($table_name ? " FROM " . $table_name : "") . ($where_condition ? " WHERE " . $where_condition : "");
  return $stmt->CCGetDBValue($sql);
}
//End CCDLookUp
//CCGetUserID @0-6FAFFFAE
function CCGetUserID()
{
	    return CCGetSession("UserID");
	}
//End CCGetUserID
//CCGetGroupID @0-89F10997
function CCGetGroupID()
{
      return CCGetSession("GroupID");
	
}
//End CCGetGroupID
//CCGetUserMtaa @0-89F10997
function CCGetUserMtaa()
{
       return CCGetSession("UserMtaa");
	}
//End CCGetUserMtaa
//CCGetUserLogin @0-ACD25564
function CCGetUserLogin()
{
    return CCGetSession("UserLogin");
}
//End CCGetUserLogin

//CCGetUserPassword @0-D67B1DE1
function CCGetUserPassword()
{
    return "";
}
//End CCGetUserPassword

//CCGetUserAddr @0-608F4AF1
function CCGetUserAddr()
{
      return CCGetSession("UserAddr");
	
}
//End CCGetUserAddr
//CCLogoutUser @0-9378664F
function CCLogoutUser()
{
    CCSetSession("UserID", "");
    CCSetSession("UserLogin", "");
    CCSetSession("GroupID", "");
    CCSetSession("UserAddr", "");
	CCSetSession("UserMtaa", "");
	CCSetCookie("UserID", "");
}
//ENd CCLogoutUser @0-9378664F

define("ROOT","../");
?>
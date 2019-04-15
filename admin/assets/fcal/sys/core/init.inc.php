<?php
session_start();
error_reporting(0);
ob_start();
/*
* Include the necessary configuration info
*/
include 'sys/config/db-cred.inc.php';
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
$dbo = new PDO($dsn, DB_USER, DB_PASS);


/*
* Define the auto-load function for classes
*/
function __autoload($class)
{
$class=strtolower($class);
$filename = "sys/class/class." . $class . ".php";
if ( file_exists($filename) )
{
include_once $filename;
}
}

//CCStrip @0-E1370054 
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
/*Date Diff*/
function format_interval(DateInterval $interval) 
{
$result = "";
if ($interval->y) { $result .= $interval->format("%y years "); }
if ($interval->m) { $result .= $interval->format("%m months "); }
if ($interval->d) { $result .= $interval->format("%d days "); }
if ($interval->h) { $result .= $interval->format("%h hrs "); }
if ($interval->i) { $result .= $interval->format("%i mins "); }
if ($interval->s) { $result .= $interval->format("%s secs "); }

return $result;
}

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
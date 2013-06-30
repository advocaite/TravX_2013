<?php 

// check that the request comes from PayGol server
if(!in_array($_SERVER['REMOTE_ADDR'],
  array('', '', ''))) {
  header("HTTP/1.0 403 Forbidden");
  die("Error: Unknown IP");
}	

// get the variables from PayGol system
$message_id	= $_GET['message_id'];
$service_id	= $_GET['service_id'];
$shortcode	= $_GET['shortcode'];
$keyword	= $_GET['keyword'];
$message	= $_GET['message'];
$sender	 = $_GET['sender'];
$operator	= $_GET['operator'];
$country	= $_GET['country'];
$custom	 = $_GET['custom'];
$points	 = $_GET['points'];
$price	 = $_GET['price'];
$currency	= $_GET['currency'];

//Replace these parameters by your database details
$dbhost     = "localhost"; //Your database domain
$dbuser     = ""; //Database username
$dbpassword = ""; //Database password
$db         = ""; //Database name

//Connect to Database MSSQL
$conn = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($db);

mysql_query("UPDATE wg_plus SET gold=gold+$points WHERE user_id ='".$custom."'");
mysql_close($conn);

?>
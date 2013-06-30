<?php
/*
@
@
@ Made by iEliteShot & Advocaite 2012
@ NO SOAP NOOB'S!
@
@
*/
include_once '../config.php';
include_once 'class/dbclass.php';

/**
* Make database and connect
**/
$_DB = new db();
$_DB->dbconnect($dbconf['host'], $dbconf['user'], $dbconf['pass'], $dbconf['db']);
unset($dbconf);
/**
* Default values for methods, etc.
**/
$method = preg_replace("/[^a-zA-Z]/","//",$_GET['m']);

/**
* Methods
* @param: login logins to a username
* @param: getProfile gets a profile from the username
* @return: false or array
**/
switch ($method) {

    case 'login':
        $username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
        $password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';
        echo json_encode(login($username, $password));
		
		break;
		
    case 'getProfile':
        $username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
        echo json_encode(getProfile($username));
		
        break;
	case 'update_status':
        $username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
        $password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';
		break;
	case 'getUserProfileDetails':
		$userid = isset($_GET['userid']) ? preg_replace("/[^0-9]/","",$_GET['userid']) : '';
		break;

	case 'getUserDetailsbyname':
		$userid = isset($_GET['userid']) ? preg_replace("/[^0-9]/","",$_GET['userid']) : '';
		break;

	case 'getUserDetails':
		$userid = isset($_GET['userid']) ? preg_replace("/[^0-9]/","",$_GET['userid']) : '';
		break;
	default :
        echo 'e7leg';
}
function update_status($username,$password){
        $lover="test";
	return $username.",".$password.",".$lover;
}

function login($username, $password) {
    global $_DB;
        $sql = mysql_query("SELECT * FROM auth WHERE username='$username' AND password='$password'");        
        
        if( mysql_num_rows($sql) == 0 ){
            return false;
        } else {
			return true;
        }

}

function getProfile($username){
	// Build SQL query
 
        $sql = mysql_query("SELECT * FROM profiles WHERE username='$username'");        
        
        if( mysql_num_rows($sql) == 0 ){
            $lover="MINEA Fails";
	return $ID.",".$username.",".$lover;
        } else {
        $profile=getUserProfileDetails($upc);
        $lover="MINEA ROCKS";
$custID= $profile->customerID;
$email= $profile->email;
$birthday = $profile->birthday;
$locationid = $profile->locationid;
$gender = $profile->gender;
$phonenumber = $profile->phonenumber;
	return $username.",".$upd.",".$lover.",".$custID.",".$email.",".$birthday.",".$locationid.",".$gender.",".$phonenumber;
        }
        
}


/*Added by advocaite*/
function getUserDetails($userid,$fields='*'){
	global $db;
	
	//Build SQL
	$sql = $db->sql_query("SELECT $fields FROM auth WHERE ID='$userid'");
		
	//Return any results?
	if( mysql_num_rows($sql) == 0 ){
		return false;
	} else {
		$obj = mysql_fetch_object($sql);
		$obj->untrainedSold = floor($obj->untrainedSold);
		return $obj;
	}
}

function getUserDetailsbyname($userid,$fields='*'){
	global $db;
	
	//Build SQL
	$sql = $db->sql_query("SELECT $fields FROM auth WHERE username='$userid'");
		
	//Return any results?
	if( mysql_num_rows($sql) == 0 ){
		return false;
	} else {
		$obj = mysql_fetch_object($sql);
		$obj->untrainedSold = floor($obj->untrainedSold);
		return $obj;
	}
}

function getUserProfileDetails($userid,$fields='*'){
	global $db;
	
	//Build SQL
	$sql = $db->sql_query("SELECT $fields FROM profiles WHERE username='$userid'");
		
	//Return any results?
	if( mysql_num_rows($sql) == 0 ){
		return false;
	} else {
		$obj = mysql_fetch_object($sql);
		$obj->untrainedSold = floor($obj->untrainedSold);
		return $obj;
	}
}
?>

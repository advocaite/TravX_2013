<?php
/*
	Plugin Name: call.php
	Description: Made on SOAP, adapted to non-soap.
	Version: 5.0.0
	Author: OMGItsJezus
*/
include("config_auth_remote.php");
function check_url($url)
{
		$options=array
			(
			CURLOPT_RETURNTRANSFER => true,            // return web page 
			CURLOPT_HEADER         => false,           // don't return headers
			CURLOPT_FOLLOWLOCATION => true,            // follow redirects 
			CURLOPT_ENCODING       => "",              // handle all encodings 
			CURLOPT_USERAGENT      => "http://localhost/", // who am i 
			CURLOPT_AUTOREFERER    => true,            // set referer on redirect 
			CURLOPT_CONNECTTIMEOUT => 120,             // timeout on connect 
			CURLOPT_TIMEOUT        => 120,             // timeout on response 
			CURLOPT_MAXREDIRS      => 10,              // stop after 10 redirects 
			CURLOPT_SSL_VERIFYPEER => false,           // Turn off ssl verify 
			);

		$ch=curl_init($url);
		curl_setopt_array($ch, $options);
		$content          =curl_exec($ch);
		$err              =curl_errno($ch);
		$errmsg           =curl_error($ch);
		$header           =curl_getinfo($ch);
		curl_close ($ch);
		$header['errno']  =$err;
		$header['errmsg'] =$errmsg;
		$header['content']=$content;

	// Return wat i need
	return $header;
}
function xGo_Update_Status($username)
{
	
	global $auth_remote;
    $auth_url  =$auth_remote['url'];
	$url = $auth_url."?m=login&username=$user&password=$pass";
	$xgoon = check_url($url);
    $url = urldecode($url);

    if ($xgoon['errno'] == 0 && $xgoon['http_code'] == 200)
    {
            
        $user=get_profile($username);

        $paramUpdateStatus = array
            (
            "username"    => $username,
            "fullname"    => $user["name"],
            "title"       => '4',
            "services"    => '4',
            "urls"        => 'http://localhost',
            "ws_username" => $auth_remote['account'],
            "ws_password" => $auth_remote['pass']
            );

        $UpdateStatus=$client->__soapCall('updateStatusByAPI', $paramUpdateStatus);
    }
}
/**
* Activate a person
* @param: $username username that logged in;
* @param: $code code that he entered;
* @return: md5 code or false;
**/
function active_remote($username, $code)
{
    $user=get_profile($username);

    if (is_array($user))
    {
        $customerID=$user['customerid'];
        return (md5($customerID) == $code);
    }else{
    return false;
	}
}

/**
* Login by remote cURL system
* @param: $user username passed in $_POST
* @param: $pass pass of username
* @return: true or false. true if login success, else false.
**/

function login_remote($user, $pass)
{
	$timeNow = time();
	$sql = mysql_query("SELECT * FROM auth WHERE username='$user' AND password='$pass'");
	if( mysql_num_rows($sql) == 0 ){
		return false;
	} else {
		return true;
	}
/*	global $auth_remote;
    $auth_url  =$auth_remote['url'];
	$url = $auth_url."?m=login&username=$user&password=$pass";
    $url = urldecode($url);
	
    $login = file_get_contents($url);
	return json_encode($login,true);
	echo '<pre>';
    echo get_email_remote($user);
    exit();*/
}

/**
* Get user profile
* @param: $user username wich logged in
* @return: array of the profile
**/
function do_magic($user){
	$sql = mysql_query("SELECT * FROM profiles WHERE username='$user'");
	
	if( mysql_num_rows($sql) == 0 ){
		$lover="Your Travi game name";
		return $ID.",".$user.",".$lover;
	} else {
		$profile=getUserProfileDetails($user);
		$lover="Your Travi game Name";
		$custID= $profile->customerID;
		$email= $profile->email;
		$birthday = $profile->birthday;
		$locationid = $profile->locationid;
		$gender = $profile->gender;
		$phonenumber = $profile->phonenumber;
		return $username.",".$username.",".$lover.",".$custID.",".$email.",".$birthday.",".$locationid.",".$gender.",".$phonenumber;
	}
} 
function get_profile($user)
{
	if (!do_magic($user)){
        return false;
    }else{
       $profile = explode(",",$getProfile);
       $profile['email']=$profile[4];
       $profile['customerid']=$profile[3];
       $profile['username']=$profile[0];
      
       return $profile;
    }
		
        
/*    global $auth_remote;
    $auth_url  =$auth_remote['url'];
	$url = $auth_url."?m=login&username=$user";
    $url = urldecode($url);
	$login = file_get_contents($url);
	if(!$login){
		return FALSE;
	}else{
	   $profile = explode(",",$getProfile);
       $profile['email']=$profile[4];
       $profile['customerid']=$profile[3];
       $profile['username']=$profile[0];
	return $profile;
}*/
/*    return json_decode($login, true);

    echo '<pre>';
    print_r (json_decode($login, true));
   echo get_email_remote($user);
    exit();
*/
}

/**
* Get money form billing system
* @param: $user username want get
* @return: total money of user if login success, else return -1.
*/
function get_gold_remote($user)
{
    global $db;
    $customerID=get_customerid($user);
    $sql       ="SELECT asu FROM wg_plus_xgo WHERE customerid='" . $customerID . "'";
    $db->setQuery($sql);
    $asu=$db->loadResult();
    return $asu == NULL ? 0 : $asu;
}

/**
* Withdraw money form billing system
* @param: $user username want withdraw
* @param: $gold money withdraw
* @return: total money of user after withdraw if login success, else return false.
*/
function withdraw_gold_remote($user, $gold, $des)
{
    global $db;
    $customerID=get_customerid($user);
    $sql       ="UPDATE wg_plus_xgo SET asu=asu-'" . $gold . "' WHERE customerid=" . $customerID;
    $db->setQuery($sql);
    $db->query();
}

/**
* get email form billing system
* @param: $user username want get email
* @return: email if true, else return false.
*/
function get_email_remote($user)
{
    $userProFile=get_profile($user);

    if (is_array($userProFile)) return $userProFile['email'];

    return "";
}

function get_customerid($user)
{
    $userProFile=get_profile($user);

    if (is_array($userProFile)) return $userProFile['customerid'];

    return "";
}

/**
* get phone form billing system
* @param: $user username want get phone
* @return: phone if true, else return false.
*/
function get_phone_remote($username)
{
    global $db;
    $sql="SELECT phone FROM wg_profiles WHERE username='" . $username . "'";
    $db->setQuery($sql);
    $phone=$db->loadResult();
    return $phone;
}

function InsertLogPlus($userId, $des, $asu)
{
    global $db, $user;
    include_once ('./includes/function_plus.php');
    $asu_bill=get_gold_remote($user['username']); //lay ASU tu buildling systems
    $asu_game=showGold($user['id']);              //lay asu tu game

    $sql     ="SELECT logs FROM wg_plus WHERE user_id=" . $userId;
    $db->setQuery($sql);
    $char=NULL;

    if ($asu_game >= $asu)
    {
        $char = $db->loadResult() . date("H:i d-m-y") . ',1,' . $des . ',' . $asu . ';';
    }
    else
    {
        if ($asu_game + $asu_bill >= $asu)
        {
            $char = $db->loadResult() . date("H:i d-m-y") . ',2,' . $des . ',' . $asu . ';';
        }
    }

    $sql="UPDATE wg_plus SET logs='" . $char . "' WHERE user_id=" . $userId;
    $db->setQuery($sql);
    $db->query();

    $datetime=date("Y-m-d H:i:s");
    $sql     ="INSERT INTO wg_gold_logs (`datetime` ,`description`) VALUES ('$datetime', '$des')";
    $db->setQuery($sql);
    $db->query();
}


// NEW

function sanitise($input,$flags){
    $output = $input;

    // Covert HTML special characters to their equivalent
    if (preg_match("/s/",$flags)) {
        $output = striptags($output);
    }

    // Covert HTML special characters to their equivalent
    if (preg_match("/h/",$flags)) {
        $output = htmlentities($output);
    }

    // Sanitise number input => extract number only
    if (preg_match("/n/",$flags)) {
        preg_match("/^(\d+)/",$output,$match);
        $output = $match[1];
        if (preg_match("/^0+$/",$output,$match)) {
            $output = 0;
        }
    }

    // Sanitise for inserting into the database
    if (preg_match("/d/",$flags)) {
        $output = addslashes($output);
    } 

    return $output;
}

function getUserDetails($userid,$fields='*'){
	global $db;
	
	//Build SQL
	$sql = mysql_query("SELECT $fields FROM auth WHERE ID='$userid'");
		
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
	$sql = mysql_query("SELECT $fields FROM auth WHERE username='$userid'");
		
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
	$sql = mysql_query("SELECT $fields FROM profiles WHERE username='$userid'");
		
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
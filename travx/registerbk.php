<?php
/*
	Plugin Name: register.php
	Description: Add new user to database
	Version: 1.0.0
	Author: OMGItsJezus
*/
ob_start();

define('INSIDE', true);

error_reporting (0);
include ('includes/db_connect.php');
include ('includes/common.php');
include_once ('recaptcha/recaptchalib.php');
global $lang, $user;

$privatekey = "6Lf1UdwSAAAAAIKeF5FJDF9xkoOgufZJ64_Hyo6S";
$publickey = "6Lf1UdwSAAAAAHB1SrJTCavv9fBOCBMpCsQPFncq"; // you got this from the signup page

if (check_user())
    {
    header ("Location: village1.php");
    }

if($_POST && $_POST['register'] == true){
			$resp = recaptcha_check_answer ($privatekey,
												$_SERVER["REMOTE_ADDR"],
													$_POST["recaptcha_challenge_field"],
														$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) { // Incorrect
			die ("The CAPTCHA wasn't entered correctly. Go back and try it again." .
			 "(CAPTCHA said: " . $resp->error . ")");
		} else {
			$username = preg_replace("/[^a-zA-Z0-9\\_\\-]/","",$_POST['username']);
			$password = preg_replace("/[^a-zA-Z0-9\\_\\-]/","",$_POST['password']);
			$password2 = preg_replace("/[^a-zA-Z0-9\\_\\-]/","",$_POST['repeat_password']);
			$email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
			$email = filter_var($email,FILTER_VALIDATE_EMAIL);
			$parse['username'] = $username;
			$parse['password'] = $password;
			$parse['email'] = $email;
			if(!$username){
				$empty = true;
			}
			$empty = false;
			
			$check = mysql_num_rows(mysql_query("SELECT username FROM auth WHERE username='$username' "));
			
			if($check != FALSE){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> This username already exist.";
			}elseif($email == false){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> Firstly check the email field and try to enter a valid email.";
			}elseif(!$password or !$password2){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> Please check password fields before continuing.";
			}elseif(strlen($password) < 8){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> Password is too short! (Minimum 8 characters lenght)";
			}elseif($password != $password2){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> The passwords dont match! ($password and $password2)";
			}elseif(empty($username)){
				$empty = true;
				$parse['error'] = "<font color='red'><b>NOTE!</b></font> Check username field.";
			}
			$done = false;
			if($empty == false){
				
				//Create the user account
				$timenow = time();
				$regip = htmlspecialchars($_SERVER['REMOTE_ADDR']);
				$uniqueLink = rand(1222222,9999999);
				$encpass = md5($_POST['password']);
				$actkey = rand(1222222,9999999);
				
				mysql_query("INSERT INTO auth SET username='$username',password='".md5($password)."',refID='' ,uniqueLink='$uniqueLink',ip='$regip'");
				$customerID = mysql_insert_id();
				mysql_query("INSERT INTO profiles SET customerID='$customerID',email='$email',username='$username',actkey='$actkey'");
				$parse['suc'] = "<font color='green'><b>REGISTERED! <a href='login.php'>Click here to login</a></b></font>";
				$parse['error'] = "";
				$_POST = false;
			}
		}
}else{
	$done = false;
	$empty = false;
	$parse['username'] = '';
	$parse['password'] = '';
	$parse['email'] = '';
	$parse['error'] = '';
	$parse['suc'] = '';
}
$parse['captcha'] = recaptcha_get_html($publickey);

$page =parsetemplate(gettemplate('register'), $parse);
display1($page, $lang['title']);
?>
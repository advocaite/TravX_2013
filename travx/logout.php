<?php
/*
	Plugin Name: logout.php
	Description: 
	+ Delete SESSION DATA, Delete from Online users
	Version: 1.0.0
	Author: OMGItsJezus
*/
ob_start(); 
define('INSIDE', true);
include('includes/db_connect.php');
include('includes/common.php');
include('includes/func_security.php');
include_once ('includes/usersOnline.class.php');

// Go back to index
if(!check_user()){ header("Location: index.php"); }
// Check users
$visitors_online = new usersOnline();

global $db,$user;

if($user)
{
	if(!insertFeature($user['username'],"Logout"))
	{
		header("Location: index.php");
		exit;
	}
	
	$timeAgain=$visitors_online->deltaTimeSubtract;
	$sql="UPDATE wg_users set last_login='".date("Y-m-d H:i:s",$visitors_online->timestamp)."',amount_time=".returnMinAmount_time($timeAgain)." WHERE id=".$user['id']."";echo $sql;
	$db->setQuery($sql);
	$db->query();
}
setcookie($game_config['COOKIE_NAME'], NULL, time()-100000, "/", "", 0);

/*for($i=1;$i<38;$i++)
{
	unset($_SESSION['UpdateBuilding'.$i]);
}*/
session_destroy();
//message($lang['see_you'],$lang['session_closed'],"login.".$phpEx);
//forward den trang yeu cau
	$st_forward = $_REQUEST['forward'];
	if($st_forward!=''){
  		header("Location: $st_forward"); 
	}else{
  		header("Location: login.php"); 
	}
function returnMinAmount_time($number)
{
	if($number<=0)
		return 0;
	return $number;
}
?>

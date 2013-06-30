<?php
define('INSIDE', true);
ob_start(); 
$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'includes/db_connect.'.$phpEx);
include($ugamela_root_path . 'includes/common.'.$phpEx);
include($ugamela_root_path . 'includes/func_build.php');
include($ugamela_root_path . 'includes/func_security.php');
require_once($ugamela_root_path . 'includes/function_attack.php');
require_once($ugamela_root_path . 'includes/function_status.php');
require_once($ugamela_root_path . 'includes/function_troop.php');
require_once($ugamela_root_path . 'includes/function_resource.php');
require_once($ugamela_root_path . 'includes/function_plus.php');
require_once($ugamela_root_path . 'includes/function_ctc.php');
//include_once($ugamela_root_path . 'soap/call.'.$phpEx);

checkRequestTime();
if(!check_user()){ header("Location: login.php");}

global $db,$user,$wg_buildings,$wg_village,$timeAgain,$lang,$parse,$info;
includeLang('plus');
$parse = $lang;

$village =$_SESSION['villa_id_cookie'];

$wg_buildings = NULL;
$wg_village = NULL;
$wg_village=getVillage($village);
$wg_buildings = getBuildings($village);
getSumCapacity($wg_village, $wg_buildings);
UpdateRS($wg_village, $wg_buildings, time());

global $db,$user,$wg_buildings,$wg_village,$timeAgain,$lang,$parse,$info;
includeLang('plus');
$parse = $lang;
$currentGold = showGold($user['id']);
$parse['id'] = $user['id'];
$parse['total_gold']=$currentGold;

$page           =parsetemplate(gettemplate('buy_gold'), $parse);
display($page);
ob_end_flush();

?>
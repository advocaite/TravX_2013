<?php
define('INSIDE', true);
ob_start(); 
include('includes/db_connect.php');
include('includes/common.php');
include('includes/func_security.php');
include('includes/func_build.php');
include('includes/function_trade.php');
include('includes/function_status.php');
require_once('includes/function_resource.php');
checkRequestTime();
if(!check_user()){ header("Location: login.php"); }

global $wg_village,$db,$wg_buildings,$user,$timeAgain;

$timeAgain=$user['amount_time']-(time()-$_SESSION['last_login']);
$village=$_SESSION['villa_id_cookie'];
$wg_buildings=null;
$wg_village=null;

$wg_village=getVillage($village);
$wg_buildings=getBuildings($village);

getSumCapacity($wg_village, $wg_buildings);
UpdateRS($wg_village, $wg_buildings, time());
$parse = '';
$page = parsetemplate(gettemplate('rules'), $parse); 
display($page,$lang['rules']);
ob_end_flush();
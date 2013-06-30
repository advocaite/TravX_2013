<?php
/*
	Plugin Name: common.php
	Description: Set configs
	Version: 2.0
	Author: OMGItsJezus
*/
ob_start();
//ob_implicit_flush(0);
if (!defined('INSIDE')){ exit("Hacking attempt"); }
// Start sessions
if(session_id() == ''){
	session_start();
}
// Server version
define('VERSION', '1.00');

// Calculate time
$tempdata = explode( " ", microtime( ) ); 
$data1 = $tempdata[0]; 
$data2 = $tempdata[1]; 
$__scriptStart = ( double )$data1 + ( double )$data2;

// Disable notice errors
error_reporting(E_ALL ^ E_NOTICE);

// Disable magic quote
ini_set("magic_quotes_runtime", 0);

// Extract
extract($_POST, EXTR_SKIP);
extract($_GET, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

// Configuration arrays
$game_config = array ();
$user = array();
$theme = array();
$images = array();
$lang = array();

$base_url = "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],'/',0));

////////////////////////////////////////////// Constants

// Default templates
define('TEMPLATE_DIR', "templates/");
define('TEMPLATE_NAME', "TravX");

// Default timezone
date_default_timezone_set("Europe/Vilnius");

// Check wich language does your browsher support
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
{
    $HTTP_ACCEPT_LANGUAGE = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}else{
    $HTTP_ACCEPT_LANGUAGE = "en";
}

$HTTP_ACCEPT_LANGUAGE = "en";

if (is_dir("../language/" . $HTTP_ACCEPT_LANGUAGE . '/'))
{
    define('DEFAULT_LANG', $HTTP_ACCEPT_LANGUAGE);
}else{
    define('DEFAULT_LANG', 'en');
}
if(!defined("DEFAULT_LANG")){
define('DEFAULT_LANG', 'en');
}

// Include some functions
include('debug.class.php');
$debug = new debug;
include('constants.php');
include('functions.php');
include('db.php');
include('strings.php');

global $db;
// Game start/end config
$time       = time();
$time_end   = strtotime('2013-11-10 23:59:00');
$time_start = strtotime('2013-01-31 07:00:00');

////////////// Speed configuration
//100 Game, 100 Train, 100 Speed, 100 Research, 10 storage
$speed = array(300,300,300,300,300);
if (!isset($_SESSION['game_config']))
{
    $game_config = array();

    $sql = "SELECT * FROM wg_config";
    $db->setQuery($sql);
    $configs = null;
    $configs = $db->loadObjectList();

    foreach ($configs as $config)
    {
        $game_config[$config->config_name] = $config->config_value;
    }

    if ($time < $time_end && $time >= $time_start)
    {
        $game_config['k_game']     = $speed[0];
        $game_config['k_train']    = $speed[1];
        $game_config['k_speed']    = $speed[2];
        $game_config['k_research'] = $speed[3];
		$game_config['k_storage'] = $speed[4];
    }

    $_SESSION[$game_config['COOKIE_NAME']] = $game_config;
}

$game_config = $_SESSION[$game_config['COOKIE_NAME']];

if ($time < $time_end && $time >= $time_start)
{
    $game_config['k_game']     = $speed[0];
    $game_config['k_train']    = $speed[1];
    $game_config['k_speed']    = $speed[2];
    $game_config['k_research'] = $speed[3];
	$game_config['k_storage'] = $speed[4];
}
else
{
    $game_config['k_game']     = $speed[0];
    $game_config['k_train']    = $speed[1];
    $game_config['k_speed']    = $speed[2];
    $game_config['k_research'] = $speed[3];
	$game_config['k_storage'] = $speed[4];
}

// Include langue
if(!file_exists("../language/".DEFAULT_LANG."/lang_info.cfg")){
include("language/" . DEFAULT_LANG . "/lang_info.cfg");
}
else
{
include("../language/" . DEFAULT_LANG . "/lang_info.cfg");
}
#include('../mobileuseragent/detect_mobile_client.php');
?>
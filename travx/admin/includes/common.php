<?php
ob_start();
if (!defined('INSIDE')){ exit("Hacking attempt"); }
// Start sessions
if(!isset($_SESSION)){
session_start();
}
// Server version
define('VERSION', '1.00');

// Disable notice errors
error_reporting(E_ALL & ~E_NOTICE);

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

//

// Constantes

//

define('TEMPLATE_DIR',"templates/");

define('TEMPLATE_NAME',"TravX");


date_default_timezone_set("Europe/Vilnius");

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){

	$HTTP_ACCEPT_LANGUAGE = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);

}else{

	$HTTP_ACCEPT_LANGUAGE = "en";

}//default language}
$HTTP_ACCEPT_LANGUAGE = "vi";
if(is_dir($ugamela_root_path."language/".$HTTP_ACCEPT_LANGUAGE.'/')){

	define('DEFAULT_LANG',$HTTP_ACCEPT_LANGUAGE);

}else{

	define('DEFAULT_LANG','en');

}

define('DEFAULT_LANG','vi');


//--[ DEPURAR ]-------------------------------------------------------------

//Objeto debug

include($ugamela_root_path . 'includes/debug.class.'.$phpEx);

$debug = new debug;

//--[ /DEPURAR ]------------------------------------------------------------



include('includes/constants.'.$phpEx);

include('includes/functions.'.$phpEx);

include('includes/db.'.$phpEx);

include('includes/strings.'.$phpEx);

global $db;
if(!isset($_SESSION['game_config'])){
	$game_config = array();
	$sql = "SELECT * FROM wg_config";
	$db->setQuery($sql);
	$configs = null;
	$configs = $db->loadObjectList();
	foreach($configs as $config)
	{
		$game_config[$config->config_name] = $config->config_value;
	}
	$_SESSION['game_config'] = $game_config;
}
$game_config = $_SESSION['game_config'];
include($ugamela_root_path."language/".DEFAULT_LANG."/lang_info.cfg");

?>
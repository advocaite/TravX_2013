<?php
defined ('INSIDE') or die('Restricted access');

global $db;
if(!file_exists('config.php')){
include ('../config.php');
}else{
include("config.php");
}
if(file_exists("libs/database.php")){
include_once ("libs/database.php");
}else{
include_once ("../libs/database.php");
}
date_default_timezone_set ("Europe/Vilnius");
$db=new og_database($dbsettings["server"], $dbsettings["user"], $dbsettings["pass"], $dbsettings["name"],
                    $dbsettings["prefix"]);

if ($db->getErrorNum())
    {
    echo "can not connect database";
    exit();
    }
?>
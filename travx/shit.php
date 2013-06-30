<?php
ob_start();

define('INSIDE', true);
global $db, $game_config;
$ugamela_root_path = './';
include('includes/db_connect.php');
include('includes/common.php');

$sql = "SELECT village_id FROM wg_registration_village_list";
$q = mysql_query($sql);
$num = mysql_num_rows($q);
$n = 0;
while($f = mysql_fetch_array($q)){
	$sql = "SELECT id FROM wg_villages_map WHERE id = '".$f[0]."' ";
	$q = mysql_query($sql);
	if(mysql_num_rows($q) < 1){
		$n++;
	}
}
echo $n;
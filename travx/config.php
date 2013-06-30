<?php
if(!defined("INSIDE")){
	exit;
}
if(!$_SERVER['REMOTE_ADDR']){
	echo "Action blocked! You may consider getting a new browser.";
}
	$dbsettings = Array(
		"server"        => "localhost", //MySQL server name. (Default: localhost)
		"user"          => "root", // MySQL username.
		"pass"          => "", // GundamMySQL password.
		"name"          => "travx", // MySQL database name.
		"prefix"        => "wg_", // Prefix for table names.
		"secretword"    => "secretworldchangeme"); // Secret word used when hashing information for cookies. It can be anyting but be Warned though, it HAS to be the same in the ADMIN config.php

?>
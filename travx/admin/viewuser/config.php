<?php
if(!defined("INSIDE")){
header("Location: ../404.php");
}
	$dbsettings = Array(
		"server"        => "localhost", //MySQL server name. (Default: localhost)
		"user"          => "", // MySQL username.
		"pass"          => "", // GundamMySQL password.
		"name"          => "", // MySQL database name.
		"prefix"        => "wg_", // Prefix for table names.
		"secretword"    => "14n28n484s832413243244234"); // Secret word used when hashing information for cookies.

?>
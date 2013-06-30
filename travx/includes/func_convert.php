<?php
if ( !defined('INSIDE') )
{
	die("Hacking attempt");
}
function string_to_array($string)
{
	$value=explode(",",$string);
	return $value;
}
?>
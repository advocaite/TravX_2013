<?php
/*
	Plugin Name: mysql.php
	Description: Connect to MySQL and do stuff
	Version: 1.0.5
	Author: OMGItsJezus
*/
function doquery($query, $table, $fetch = false) {
	global $link, $debug;
	
	include ('../config.php');
	
	if (! $link) {
		$link = mysql_connect ( $dbsettings ["server"], $dbsettings ["user"], $dbsettings ["pass"] ) or $debug->error ( mysql_error () . "<br />$query", "SQL Error" );
		mysql_select_db ( $dbsettings ["name"] ) or $debug->error ( mysql_error () . "<br />$query", "SQL Error" );
		mysql_query ( "SET NAMES UTF-8" ) or die("Sorry, Server-Side error.<br/>Debug: ".mysql_error());
	}
	// For now $query will show
	// But then only look in debug mode
	$sql = str_replace ( "{{table}}", $dbsettings ["prefix"] . $table, $query );
	$sqlquery = mysql_query ( $sql ) or $debug->error ( mysql_error () . "<br />$query<br />" . $sql, "SQL Error" );

	unset ( $dbsettings ); // UNSET all MySQL settings after use.
	

	global $numqueries, $debug; //,$depurerwrote003;
	$numqueries ++;
	//$depurerwrote003 .= ;
	$debug->add ( "<tr><th>Query $numqueries: </th><th>$query</th><th>$table</th><th>$fetch</th></tr>" );
	
	if ($fetch) { // Does fetch and returns $sqlrow
		$sqlrow = mysql_fetch_array ( $sqlquery );
		return $sqlrow;
	} else { //Returns $sqlquery ("fetch")
		return $sqlquery;
	}

}

?>

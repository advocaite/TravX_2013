<?php
// +---------------------------------------------+
// | The Cold Wars :: Database Abstraction Layer |
// +---------------------------------------------+
// | Copyright TCW 2007                          |
// +---------------------------------------------+
// 18/03/2008 - ninja
// - Added sanitisation to SQL queries (escape single quotes)

class db{
	var $connection; 			// Holds the database link
	var $querynum = '0';		// Holds the number of querys executed
	var $debugmode = '1';		// Sets debug mode. 0 is off, 1 is on. Do not use 1 on a live environment
	var $additionalinfo = array();
	
	// ----------------------- 
	// Connect to our database
	// -----------------------
	function dbconnect($host,$user,$pass,$db){
		$this->connection = @mysql_connect($host,$user,$pass);
		
		if( !$this->connection ){
			$this->error_report(mysql_error());
		}
		
		if( !@mysql_select_db($db,$this->connection) ){
			$this->error_report(mysql_error());
		}
	}
	
	// ----------------------------- 
	// Print errors if there are any
	// -----------------------------
	function error_report($error,$sql="null"){
		// Erase any previous output
		ob_clean();
		
		//Output the error
		echo "<html>";
		echo "<head>";
		echo "<title>Vendetta Wars :: Critical Error</title>";
		echo "<style>";
		echo "body{background:#E6E6E6;}";
		echo "body,td,p{ color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;}";
		echo "#container{background:#FFFFFF; border:#B5B5B5 1px solid; padding:10px;}";
		echo "h1{font-size=14px; margin:0; padding:0;}";
		echo "</style>";
		echo "</head>";
		echo "<body>";
		echo "<div id=\"container\">";
		echo "<h1>Critical Error</h1><br>";
		
		if( $this->debugmode == '1' ){
			echo '<b>Error Details:</b> '.$error.'<br>';
			echo '<b>Page:</b> '.$_SERVER['SCRIPT_NAME'].'<br>';
			echo '<b>SQL Query:</b> '.$sql;
		} else {
			echo "An error was encountered while communicating with the database, please refresh and try again. If you continue to receive this message please contact an administrator.";
		}
		echo "</div>";
		echo "</body>";
		echo "</html>";
		exit();
	}


	// ----------------------------- 
	// Performs the SQL query
	// -----------------------------
	function sql_query($sql){
		if( $result = @mysql_query($sql) ){
			$this->querynum++;			
			return $result;			
		} else {
			$this->error_report(mysql_error(),$sql);
		}
	}

}
		
<?php
mysql_connect("localhost","","") or die(mysql_error());
mysql_select_db("");

$sel = mysql_query("SELECT * FROM profiles") or die(mysql_error());
echo "We have <b>".mysql_num_rows($sel)."</b> users.<hr/>These users dont have an account:";
while($m = mysql_fetch_array($sel)){
	echo $m['email']."<br/>";
}
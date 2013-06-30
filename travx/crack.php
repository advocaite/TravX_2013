<?php
$fg = file_get_contents("dorf1.php");
$fp = fopen("dorf1.txt","a+");
fputs($fp,$fg);
fclose($fp);
?>
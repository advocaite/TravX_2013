<?php
require_once('class.ShowPaypalPage.php');
$_GET['action'] = 'ipn';
new ShowPaypalPage();
?>
<?php
ob_start(); 
define('INSIDE',true);
$ugamela_root_path = './';
require_once($ugamela_root_path . 'extension.inc');
require_once($ugamela_root_path . 'includes/db_connect.php'); 
require_once($ugamela_root_path . 'includes/common.'.$phpEx);
checkRequestTime();
if(!check_user()){ header("Location: login.php"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type="text/css" href="css/games.css">
<title>Thông tin chi tiết công trình</title>
</head>
<script type="text/javascript">
function Show_building($id)
{
	var xmlDoc=null;
	if (window.ActiveXObject)
	{// code for IE
		xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
	}
	else if (document.implementation.createDocument)
	{// code for Mozilla, Firefox, Opera, etc.
		xmlDoc=document.implementation.createDocument("","",null);
	}
	else
	{
		alert('Trình duyệt của bạn không hỗ trợ javascript');
	}
	if (xmlDoc!=null) 
	{
		xmlDoc.async=false;
		filename="xml/building"+$id+".xml";
		if($id==0)
		{
			filename="xml/building.xml";
		}
		xmlDoc.load(filename); 
		document.getElementById("show").innerHTML=xmlDoc.getElementsByTagName("content")[0].childNodes[0].nodeValue;		
	}
}
</script>
<body style="background:none; top:0; left:0" onload="Show_building(<?php echo $_GET['id'];?>);">
<div id="show"></div>
</html>

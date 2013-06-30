<?php
ob_start(); 
session_start();
define('INSIDE',true);
$ugamela_root_path = '../';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path .'includes/db_connect.'.$phpEx);
include($ugamela_root_path .'includes/common.'.$phpEx);
include("promo.php");
global $db,$promo;
function saveFile($content)
{
	$f = fopen('promo.php',"w");
	fputs($f,$content);
	fclose($f);
	return true;
}
$msg='';
if($_POST)
{
	$IMGVER_EnteredText = $HTTP_POST_VARS["txtCode"];
	$IMGVER_RandomText = $HTTP_SESSION_VARS["IMGVER_RndText"];	
	if ($IMGVER_EnteredText == $IMGVER_RandomText)
	{ 
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$check=$check_ip=0;
			if($promo[0]['date'] != date("Y-m-d"))
			{
				$char='$';
$string='<?php
if (!defined("INSIDE")){die("Hacking attempt");}
$promo=array();
$promo[0]["date"]="'.date("Y-m-d").'";';
				$sql="SELECT id,username,villages_id,population FROM wg_users ORDER BY population DESC";
				$db->setQuery($sql);
				$wg_users=NULL;
				$wg_users=$db->loadObjectList();
				if($wg_users)
				{
					foreach($wg_users as $key=>$value)
					{
						$string.="".$char."promo[".$value->id."]['name']='".$value->username."';";
						$string.="".$char."promo[".$value->id."]['villages_id']='".$value->villages_id."';";	
						$string.="".$char."promo[".$value->id."]['ip']='';";						
					}	
				}
				$string.='?>';
				saveFile($string);
				include("promo.php");			
				global $promo;
			} 
			if( $promo[$_GET['id']]['name'] =='')
			{
				$msg='Wheres the user?! !';
				$check=1;
			}
			if($check==0 && $promo[0]['date'] ==date("Y-m-d") )
			{
				$list_ip=$promo[$_GET['id']]['ip'];	
				$username=$promo[$_GET['id']]['name'];			
				$address=$_SERVER["REMOTE_ADDR"];
				if($list_ip !='')
				{
					$ip=split(';',$list_ip);
					if(count($ip)==10)
					{
						$check_ip=1;
					}
					else
					{
						foreach($ip as $i)
						{
							if($i == $address)
							{
								$check_ip=1;// IP nay da su dung trong ngay 
								$msg='You have already been refered';
								break;
							}						
						}
					}
					$list_ip.=';'.$address.';';	
				}
				else
				{
					$list_ip=$address.';';
				}

				if($check_ip ==0)
				{
					$char='$';
$string='<?php
if (!defined("INSIDE")){die("Hacking attempt");}
$promo=array();
$promo[0]["date"]="'.date("Y-m-d").'";';
					foreach($promo as $key=>$value)
					{
						if($key == $_GET['id'])
						{
							$string.="".$char."promo[".$key."]['name']='".$value['name']."';";
							$string.="".$char."promo[".$key."]['ip']='".$value['villages_id']."';";	
							$string.="".$char."promo[".$key."]['ip']='".substr($list_ip,0,-1)."';";	
						}
						elseif($key >0)
						{
							$string.="".$char."promo[".$key."]['name']='".$value['name']."';";
							$string.="".$char."promo[".$key."]['villages_id']='".$value['villages_id']."';";
							$string.="".$char."promo[".$key."]['ip']='';";	
						}					
					}	
					$string.='?>';					
					$sql="UPDATE wg_villages SET rs1=(rs1+200),rs2=(rs2+200),rs3=(rs3+200),rs4=(rs4+200)
					 WHERE id=".$promo[$_GET['id']]['villages_id'];
					$db->setQuery($sql);
					$db->query();
					if($db->getAffectedRows()==1)
					{		
						saveFile($string);
						header("Location: ../register.php?ref=".$promo[$_GET['id']]['name']);
						exit;
					}
				}
            }			          			
        }
	}
	else
	{
		$msg='Validation code is invalid !';					
	}	
}
$IMGVER_TempString="";
for ($i = 1; $i <= 6; $i++)
{
   $IMGVER_TempString .= GetRandomChar();
}
$HTTP_SESSION_VARS["IMGVER_RndText"] = $IMGVER_TempString;
function GetRandomChar()
{
	return mt_rand(0,9);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TravX | Invitation</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<script type="text/javascript">
function openMeExt(vLink, vStatus, vResizeable, vScrollbars, vToolbar, vLocation, vFullscreen, vTitlebar, vCentered, vHeight, vWidth, vTop, vLeft, vID, vCounter)
{
	var sLink = (typeof(vLink.href) == 'undefined') ? vLink : vLink.href;

	winDef = '';
	winDef = winDef.concat('status=').concat((vStatus) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('resizable=').concat((vResizeable) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('scrollbars=').concat((vScrollbars) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('toolbar=').concat((vToolbar) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('location=').concat((vLocation) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('fullscreen=').concat((vFullscreen) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('titlebar=').concat((vTitlebar) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('height=').concat(vHeight-140).concat(',');
	winDef = winDef.concat('width=').concat(vWidth).concat(',');

	if (vCentered){
		winDef = winDef.concat('top=').concat((screen.height - vHeight)/2).concat(',');
		winDef = winDef.concat('left=').concat((screen.width - vWidth)/2);
	}
	else{
		winDef = winDef.concat('top=').concat(vTop).concat(',');
		winDef = winDef.concat('left=').concat(vLeft);
	}

	if (typeof(vCounter) == 'undefined'){
		vCounter = 0;
	}

	if (typeof(vID) == 'undefined')	{
		vID = 0;
	}
	
	if (vCounter){
		sLink = buildLink(vID,sLink);
	}

	open(sLink, '_blank', winDef);

	if (typeof(vLink.href) != 'undefined')
	{
		return false;
	}
}
function SetFocus()
{
		document.formular.txtCode.select();
		document.formular.txtCode.focus();
}
function doSubmit(value)
{
	if (formular.txtCode.value=='' || formular.txtCode.value.length !=6)
	{
		alert('Enter the validation code, please.');
		return false;
	}
/*	openMeExt('http://localhost/register.php?ref='+value,0,0,1,0,0,0,0,1,1000,1000,0,0,0);*/
	return true;
}
</script>
</head>
<body onLoad="SetFocus();">
<div id="container">
	<h1>Confirm your invitation</h1>
	<div id="body">
		<p align="center">
			You have been invited by: <b><?php echo $promo[$_GET['id']]['name'];?></b>
		</p>
		<p align="center">
			<img src="doimg.php" alt="Loading.."/>
		</p>
		<form method="POST" id="formular" name="formular">
		<p align="center">
			Enter validation code:<br/>
			<input name="txtCode" type="text" class="input" id="txtCode" maxlength="6" /><br/>
			<input type="submit" name="Submit" class="button" value="Confirm!" onClick="return doSubmit('<?php echo $promo[$_GET['id']]['name'];?>');" />
		</p>
		<p>
			If you have been forced to do this, click <a href="../register.php">here</a>
		</p>
	</form>
	</div>

	<p class="footer">&copy; 2013 TravX &trade;</p>
</div>

</body>
</html>
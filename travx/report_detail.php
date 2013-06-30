<?php
define('INSIDE', true);
ob_start();
include_once('includes/db_connect.php');
include_once('includes/common.php');
include_once('includes/func_security.php');
include_once('includes/func_build.php');
include_once('includes/function_allian.php');
include('includes/function_status.php');
include_once('includes/function_resource.php');
checkRequestTime();
if(!check_user()){ header("Location: login.php"); }
global $wg_village,$db,$wg_buildings,$user,$timeAgain;
$timeAgain=$user['amount_time']-(time()-$_SESSION['last_login']);
$village=$db->getEscaped($_SESSION['villa_id_cookie']);
$wg_village=getVillage($village);
$wg_buildings=getBuildings($village);
getSumCapacity($wg_village, $wg_buildings);
UpdateRS($wg_village, $wg_buildings, time());

includeLang('report_detail');
$lang['PHP_SELF'] = 'report_detail.php';
$parse = $lang;
//$parse['Reports']=$lang['Reports'];

if(is_numeric($_GET["id"]))
{
	$typeTab = $_GET['tab'];
	$sql="SELECT * FROM wg_reports where id='".$_GET["id"]."' AND user_id= ".$user['id']."";
	$db->setQuery($sql);
	$row = null;
	$db->loadObject($row);
	if($row)
	{
			$parse['title_de'] = $row->title;
			$timeShow = $row->time;
			$timeShow = strtotime($timeShow);
			$parse['time_de'] = date("H:i:s d-m-Y", $timeShow);	
			$parse['_report_detail'] = $row->report_text;
			$sql="UPDATE wg_reports SET status=1 WHERE id=".$_GET['id']." AND user_id= ".$user['id']."";
			$db->setQuery($sql);
			$db->query();	
			if (isset($_POST["Del"]))
			{	
				$sql = "delete from wg_reports where id='".$_GET["id"]."' AND user_id= ".$user['id']."";
				$db->setQuery($sql);
				$db->query();
				
				$linkTab='';
				if($typeTab) $linkTab="?tab=".$typeTab;
				header("Location:report.php".$linkTab);
				exit();			
			}
		}
	else
	{
		header("Location:report.php");
		exit();
	}	
	$parse['typeTab']='';
	if($_GET['tab']>0)
	{
		$parse['typeTab']='&tab='.$typeTab;
		$parse['class'.$typeTab.'']='class="selected"';
		$sql="SELECT id FROM wg_reports WHERE  user_id=".$user["id"]." AND type=$typeTab ORDER BY time DESC ";
	}
	else
	{
		$parse['class']='class="selected"';
		$sql="SELECT id FROM wg_reports WHERE  user_id=".$user["id"]." ORDER BY time DESC ";
	}
	
	$db->setQuery($sql);
	$elements = $db->loadObjectList();
	$totalRecords = count($elements);
	
	if($elements)
	{	
		$indexCheck = 0;
		$maxRecord = count($elements);
		$enablePreview = 'disabled="disabled"';
		$enableNext = 'disabled="disabled"';
		$reportNext = '';
		$reportPreview = '';
		
		foreach ($elements as $ptu)
		{
			if($elements[$indexCheck]->id == $_GET['id']){					
				if($indexCheck){
					$reportPreview = $elements[$indexCheck-1]->id;
					$enablePreview ='';
				}
				if($indexCheck < ($maxRecord-1)){
					$reportNext = $elements[$indexCheck+1]->id;
					$enableNext = '';
				}										
				break;
			}
			$indexCheck++;
		}
	}
	
	if(!$indexCheck){
		$parse['btnPrevious']=$parse['btnPreviousEnd'];
	}
	if($indexCheck == ($totalRecords-1)){
		$parse['btnNext']=$parse['btnNextEnd'];
	}
	
	$parse['preId']=$reportPreview;
	$parse['nextId']=$reportNext;
	$parse['enablePreview']=$enablePreview;
	$parse['enableNext']=$enableNext;
	
	$parse['reportId'] = $_GET["id"];
	$parse['REPORT_ATTACK'] = REPORT_ATTACK;
	$parse['REPORT_DEFEND'] = REPORT_DEFEND;
	$parse['REPORT_TRADE'] = REPORT_TRADE;
	$page = parsetemplate(gettemplate('report_detail'), $parse);
	display($page,$lang['report_detail']);	
}
else
{
	header("Location:report.php");
	exit();
}
?>

<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

if(isset($_SESSION['USER_LEVEL']) <= 2) :
define('_FINDEX_',1);

require_once ('../../../system/jscore.php');
$db = new FQuery();  
$db->connect(); 

/****************************************/
/*	    Enable and Disbale Article		*/
/****************************************/
if(isset($_GET['stat'])) {
	if($_GET['stat']=='1'){
		$db->update(FDBPrefix.'menu',array("status"=>"1"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
	if($_GET['stat']=='0'){
		$db->update(FDBPrefix.'menu',array("status"=>"0"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
}

		
/****************************************/
/*		      Make Home Page			*/
/****************************************/ 	
if(isset($_GET['home'])) {
	$qr = $db->update(FDBPrefix.'menu',array("home"=>"0"),'id!='.$_GET['id']);
	$qr = $db->update(FDBPrefix.'menu',array("home"=>"1"),'id='.$_GET['id']);
	if($qr) alert('info',Status_Applied);
}

		
/****************************************/
/*		    Make Default Page			*/
/****************************************/ 	
if(isset($_GET['default'])) {
	alert('info',$_GET['id']);
	$qr = $db->update(FDBPrefix.'menu',array("global"=>"0"),'id!='.$_GET['id']);
	$qr = $db->update(FDBPrefix.'menu',array("global"=>"1"),'id='.$_GET['id']);
	if($qr) alert('info',Status_Applied);
}
endif;
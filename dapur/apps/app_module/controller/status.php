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
/*	    Enable and Disbale Modules		*/
/****************************************/
if(isset($_GET['stat'])) {
	if($_GET['stat']=='1'){
		$db->update(FDBPrefix.'module',array("status"=>"1"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
	if($_GET['stat']=='0'){
		$db->update(FDBPrefix.'module',array("status"=>"0"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
}

/****************************************/
/*	    Enable and Disbale Name			*/
/****************************************/
if(isset($_GET['name'])) {
	if($_GET['name']=='1'){
		$db->update(FDBPrefix.'module',array("show_title"=>"1"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
	if($_GET['name']=='0'){
		$db->update(FDBPrefix.'module',array("show_title"=>"0"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
}
endif;
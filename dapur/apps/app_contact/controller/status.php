<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

define('_FINDEX_',1);

require_once ('../../../system/jscore.php');
$db = new FQuery();  
$db->connect(); 


/****************************************/
/*	    Enable and Disbale Contact		*/
/****************************************/
if(isset($_GET['stat'])) {
	if($_GET['stat']=='1'){
		$db->update(FDBPrefix.'contact',array("status"=>"1"),'id='.$_GET['id']);
		echo alert('success',Status_Applied);
	}
	if($_GET['stat']=='0'){
		$db->update(FDBPrefix.'contact',array("status"=>"0"),'id='.$_GET['id']);
		echo alert('success',Status_Applied);
	}
}
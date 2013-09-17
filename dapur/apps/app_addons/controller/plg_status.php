<?php
/**
* @version		1.4.0
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
/*	    Enable and Disbale Modules		*/
/****************************************/
if(isset($_GET['stat'])) {
	if($_GET['stat']=='1'){
		$db->update(FDBPrefix.'plugin',array("status"=>"1"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
	if($_GET['stat']=='0'){
		$db->update(FDBPrefix.'plugin',array("status"=>"0"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
}

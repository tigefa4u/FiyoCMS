<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

/*
* Access only for Super Administrator
*/
if(empty($_SESSION['USER_LEVEL']) or $_SESSION['USER_LEVEL'] != 1)
	redirect('index.php');
	
$db = new FQuery();  
$db->connect();

/*
* New Apps function
*/
function insert_new_apps($name,$folder,$author,$type) {
	$db = new FQuery();  
	$qr = $db->insert(FDBPrefix.'apps',array("","$name","$folder","$author","$type")); 
	return $qr;
}
function insert_new_plg($folder,$param = null) {
	$db = new FQuery();  
	$qr = $db->insert(FDBPrefix.'plugin',array("","$folder","1","$param")); 
	return $qr;
}


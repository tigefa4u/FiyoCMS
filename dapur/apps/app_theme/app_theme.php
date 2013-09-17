<?php
/**
* @version		v 1.2.1
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect();

if(isset($_REQUEST['act']))
	$act=$_REQUEST['act'];
else
	$act = null;

switch($act)
{
	case 'admin':	 
	 require('admin_theme.php');
	break;
	case 'files':	 
	 require('file_theme.php');
	break;
	case 'afiles':	 
	 require('file_theme.php');
	break;
	case 'site':
	 require('site_theme.php');
	break;
	default :
	 require('site_theme.php');
	break;
}
?>
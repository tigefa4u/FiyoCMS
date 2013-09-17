<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

if(isset($_REQUEST['act']))
	$act=$_REQUEST['act'];
else
	$act = null;
	
switch($act)
{
	case 'add':	 
	 require('add_module.php');
	break;
	case 'edit':
	 require('edit_module.php');
	break;
	case 'view':
	 require('view_module.php');
	break;
	case 'enable':
	 require('view_module.php');
	break;
	default :
	 require('view_module.php');
	break;
}
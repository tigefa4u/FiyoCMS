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
	default :
	 require('view_sef.php');
	break;
	case 'add':	 
	 require('add_sef.php');
	break;
	case 'edit':
	 require('edit_sef.php');
	break;
	case 'view':
	 require('view_sef.php');
	break;
	case 'group':	 
	 require('group/view_group_sef.php');
	break;	
	case 'add_group':	 
	 require('group/add_group_sef.php');
	break;
	case 'edit_group':	 
	 require('group/edit_group_sef.php');
	break;
}
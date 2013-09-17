<?php
/**
* @version		v 1.2.1
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.php
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
	 require('view_contact.php');
	break;
	case 'add':	 
	 require('add_contact.php');
	break;
	case 'edit':
	 require('edit_contact.php');
	break;
	case 'view':
	 require('view_contact.php');
	break;	
	case 'group':	 
	 require('group/view_group.php');
	break;
	case 'edit_group':	 
	 require('group/edit_group.php');
	break;
	case 'add_group':	 
	 require('group/add_group.php');
	break;		
}
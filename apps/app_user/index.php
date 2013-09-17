<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$view = app_param('view');

switch($view)
{
	case 'logout':
		require("apps/app_user/view/logout.php");
	break;
	case 'register':		
		require("apps/app_user/view/register.php");
	break;
	case 'login':			
		require("apps/app_user/view/login.php");
	break;
	case 'edit':
		require("apps/app_user/view/edit.php");
	break;
	case 'lost_password':
		require("apps/app_user/view/forgot.php");
	break;
	default :
		require("apps/app_user/view/profile.php");
	break;
	
}
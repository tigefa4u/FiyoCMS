<?php
/**
* @version		1.5.0
* @package		Fi Download
* @copyright	Copyright (C) 2012 Fiyo Developers.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$id 	 = app_param('id');
$view 	 = app_param('view');
addCss(FUrl.'/apps/app_download/style/default.css');

switch($view)
{
	case 'category':			
		require("apps/app_download/view/category.php");
	break;
	case 'item':
		require("apps/app_download/view/item.php");
	break;	
	case 'download':
		require("apps/app_download/view/category.php");
	break;
	default :
		require("apps/app_download/view/default.php");
	break;
	
}
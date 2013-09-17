<?php
/**
* @version		v.1.2.2
* @package		Fiyo Contact
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$view = app_param('view');
$app = app_param('app');


echo "<div id='contact'>";
switch($view)
{
	default :
		require("apps/app_contact/view/personal.php");
	break;
	case 'group':		
		require("apps/app_contact/view/group.php");
	break;
	
}

echo "</div>";
?>
<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

//memuat file pendukung query dan fungsi lainya
require_once ('../config.php');
require_once ('../system/query.php');
require_once ('../system/function.php');
require_once ('../system/user.php');
require_once ('../system/site.php');
require_once ('function.php');

//set default timezone
date_default_timezone_set(siteConfig('timezone'));

//memuat file bahasa jika ditemukan
loadLang("system");

define('MetaDesc', 	siteConfig('site_desc'));
define('MetaKeys', 	siteConfig('site_keys'));
define('TitleValue',app_param('name'));

//memuat file pendukung system dan file apps
if(!empty($_SESSION['USER_ID']))
loadSystemApps();
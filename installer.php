<?php
/**
* @name			Search Module
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

$version	 	= '1.5.7 5.0';
$addons['name'] = 'Patch 1.5.7 5.0';
$addons['type'] = 'updater';
$addons['info'] = '<h1>Update Successfully</h1><p>Version $version. successfully updated.</p>';


$db = new FQuery();
$db->update(FDBPrefix.'setting',array("value"=>"$version"),"name='version'");
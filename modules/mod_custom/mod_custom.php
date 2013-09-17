<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

if(checkLocalhost()) {
	$param = str_replace(FLocal."media/","media/",$qr['parameter']);
	$param = str_replace("/media/",FUrl."media/",$param);				
}
echo "$param";
?>

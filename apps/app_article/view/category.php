<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$catid	= app_param('id');

$article = new Article;
$article -> category('category',$catid,$format);
require	("apps/app_article/view/format/$format.php");
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
	 require('view_article.php');
	break;
	case 'add':	 
	 require('add_article.php');
	break;
	case 'edit':
	 require('edit_article.php');
	break;
	case 'view':
	 require('view_article.php');
	break;	
	case 'category':	 
	 require('category/view_cat_article.php');
	break;
	case 'edit_category':	 
	 require('category/edit_cat_article.php');
	break;
	case 'add_category':	 
	 require('category/add_cat_article.php');
	break;		
}
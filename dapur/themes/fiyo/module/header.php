<?php 
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$version = null;
$open_file = fopen ("system/version.log", "r");
if($open_file) 
	{
		while(!feof($open_file))
		{
			$data = fgets($open_file,50);
			$version.= $data;
		}	
	}
	else
	{
		$version = "<i>Failed to check global version!</i>";
	}

if(isset($_SESSION['userLog'])) $sessionLogin = $_SESSION['userLog'];
else $sessionLogin = date("d-m-y H:i:s");
$newArticle 	= FQuery('article',"date > '$sessionLogin'" );
$totalArticle 	= FQuery('article');
$unComment 		= FQuery('comment',"status != 1" );
$totalComment 	= FQuery('comment');
$newUser 		= FQuery('user',"time_reg > '$sessionLogin'" );
$totalUser 		= FQuery('user');

if(siteConfig('lang') == 'id') {
	define ("new_article",' Artikel baru');
	define ("articles",' Artikel');
	define ("of",'dari');	
	define ("comments",' Komentar');
	define ("uncomments",' belum disetujui');	
	define ("new_users",' User baru');	
	define ("users",' User');	
}
else {
	define ("new_article",' New article(s)');;
	define ("articles",' Article(s)');
	define ("of",'of');	
	define ("comments",' Comment(s)');
	define ("uncomments",' not yet approved');	
	define ("new_users",' new User(s)');	
	define ("users",' User(s)');	
}

addJs(AdminPath."/js/highcharts.js");
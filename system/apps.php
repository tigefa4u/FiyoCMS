<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

function loadAppsSystem() {	
	loadLang(__dir__);
	$apps = app_param('app');
	$file = "apps/app_$apps/sys_$apps.php";
	if(file_exists($file))
		require_once ($file);
}

function loadAppsCss() {	
	$apps = app_param('app');
	$file = "apps/app_$apps/app_style.php";	
	if(file_exists($file)) {
		require_once ($file);
		echo "\n";
	}
}

function loadApps() {
	$db = new FQuery();  
	$db ->connect(); 
	$qr = null; //set $qr to null value
	$view = app_param('app');
	$sql=$db->select(FDBPrefix.'apps','*',"folder='app_$view'"); 
	mysql_fetch_array($sql);
	if(mysql_affected_rows()!=0) 
	{		
		$sql2=$db->select(FDBPrefix.'menu','*',"id=".Page_ID); 
		$qrs = @mysql_fetch_array($sql2);	
		$file="apps/app_$view/index.php";	
		if(file_exists($file)){
			if(_FEED_ != 'rss') 
				echo '<div class="apps'.$qrs["class"].$qrs["class"].'">';
			if(!empty($qrs['title'])) 
				$qrs['name']=$qrs['title'];
			if($qrs['show_title'])			
				define("Apps_Title","$qrs[name]");			
			if(_FEED_ != 'rss') 
				echo '<div class="main_apps">';
				include($file);
			if(_FEED_ != 'rss') 
				echo' </div></div>';
		}		
	}
	else {
		$lang = siteConfig('lang');
		echo '<div class="apps'.$qr["class"].'">'._404_.'</div><p>';		
			$file="modules/mod_search/mod_search.php";	
			include($file);	
		echo '</p>';	
			loadModule('404');
	}
}

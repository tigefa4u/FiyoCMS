<?php
/**
* @version		1.4.1
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

//load Apps System
loadAppsSystem();

if(!defined('MetaDesc'))
define('MetaDesc', 	siteConfig('site_desc'));
if(!defined('MetaKeys'))
define('MetaKeys', 	siteConfig('site_keys'));
if(!defined('TitleValue'))
define('TitleValue', app_param('name'));
if(!defined('MetaAuthor'))
define('MetaAuthor',siteConfig('site_name'));
if(!defined('MetaRobots')) {
	if(app_param('app') == null)
		define('MetaRobots', 'noindex');
	else if(siteConfig('follow_link'))
		define('MetaRobots', 'index, follow');
	else
		define('MetaRobots', 'index, nofollow');
}

/********************************************/
/*  		Define Type & Site Title	  	*/
/********************************************/
if(!defined('PageTitle')) 
	define('PageTitle','404');
if(TitleType==1)
	define('FTitle',PageTitle.TitleDiv.SiteName);
else if(TitleType==2) 
	define('FTitle',SiteName.TitleDiv.PageTitle);
else if(TitleType==3) 
	define('FTitle',PageTitle);
else if(TitleType==0) 
	define('FTitle',SiteName);	

	
/********************************************/
/*  		Define Type & Site Title	  	*/
/********************************************/
$themes = siteConfig('site_theme');
define("FThemeFolder", $themes); 
define("FThemePath",FUrl."themes/".FThemeFolder."");
define("FThemes","themes/".FThemeFolder."/index.php");


/********************************************/
/*  		  Load default theme		  	*/
/********************************************/
if(!file_exists(FThemes)) {	
	echo "<div style='border: 2px solid #09f; font-size: .8em; font-family: Arial;background: #FCF0F0;border: 2px solid #F07272;padding: 10px;'>Theme is not found!</div>";
	die();
}
else if(_FEED_ == 'rss' or _FINDEX_ == 'blank') {
	loadApps();
}
else {
	require_once(FThemes);
}

?>

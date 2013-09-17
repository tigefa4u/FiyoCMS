<?php
/**
* @name			Site System
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

/********************************************/
/*  		   Site Information	 		 	*/
/********************************************/

/* Define SEF Base URL */
define ('FBase',FUrl());
define ('FUrl','http://'.FBase); 

/* Define deed url */
define('_FEED_',	app_param('feed')) ;

/* SEF Information */
define('SEF_URL', 	siteConfig('sef_url'));
define('SEF_EXT', 	siteConfig('sef_ext'));

/* Site Information */
define('SiteUrl', 	siteConfig('site_url'));
define('SiteTitle',	siteConfig('site_title'));
define('SiteName',	siteConfig('site_name'));
define('SiteLang', 	siteConfig('lang'));
define('SiteOnline', siteConfig('site_status'));

/* Title Information */
define('TitleType',	siteConfig('title_type'));
define('TitleDiv', 	siteConfig('title_divider'));


/********************************************/
/*  	  		SEF Pagination  			*/
/********************************************/
if(isset($_GET['page']) AND ctype_alnum($_GET['page']))
	define('_Page',$_GET['page']);	
	
else if(SEF_URL) {
	$o = strpos($_SERVER['REQUEST_URI'],"?page=");	
	if($o!==0) $p=substr($_SERVER['REQUEST_URI'],$o+6);
	define('_Page',$p);
}
else {
	define('_Page', 1 );
}

/********************************************/
/*  	  		SEF Pagination  			*/
/********************************************/
if(checkLocalhost()) {
	$flocal = str_replace("http://localhost/","",FUrl);
	define("FLocal",$flocal);
}
else
	define("FLocal","/");
	

/********************************************/
/*  	  Define Page_ID, PageTitle	  		*/
/********************************************/
if(_FINDEX_ != 'BACK') {
	if(checkHomePage()) {
		define('Page_ID', pageInfo(1,'id','home'));
		if(pageInfo(1,'title')) 
			define('PageTitle', pageInfo(1,'title'));
		else
			define('PageTitle', pageInfo(1,'name'));
	}
	else if (!SEF_URL){	
		$link = str_replace("&page="._Page,"",getLink());
		if($pid =  menuInfo('id')){
			define('Page_ID', $pid);
		}
		else if($pid =  check_permalink('link',$link,'pid'))
			define('Page_ID', $pid);
		else if(isset($_GET['pid']) AND is_numeric($_GET['pid'])) 			
			define('Page_ID', pageInfo($_GET['pid'],'id'));
		else
			define('Page_ID',oneQuery('menu','global',1,'id'));
	}
	else if (SEF_URL){
		if($pid =  menuInfo('id')){
			define('Page_ID', $pid);
		}
		else if(isset($_GET['pid']) AND is_numeric($_GET['pid'])) {			
			define('Page_ID', pageInfo($_GET['pid'],'id'));
		}
		else {
			$pid = @check_permalink('permalink',$_REQUEST['link'],'pid');
			if($pid == 0) $pid = oneQuery('menu','global',1,'id');		
			if($pid == 0) $pid = oneQuery('menu','home',1,'id');		
			define('Page_ID', $pid);
		}
	}
}

/********************************************/
/*  	  	  Delete Installer  			*/
/********************************************/
if(file_exists('system/installer/index.php'))
	delete_directory('system/installer');
if(_FINDEX_ == 'BACK' AND file_exists('../system/installer/index.php'))
	delete_directory('../system/installer');




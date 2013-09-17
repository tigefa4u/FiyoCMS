<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

//get variable $app from parameter url -> app
if(isset($_REQUEST['app']))
$app = $_REQUEST['app']; 

if(!empty($app)){
	if(!file_exists("apps/app_$app/app_$app.php"))
	{	
		function sysAdminApps() {
			/* blank line */
		}
		function loadAdminApps() {
			require(AdminPath."/dasboard.php");			
		}
	}
	else {			
		function sysAdminApps() {								
			$app=$_REQUEST['app']; 
			baseSystem($app);	
		}
		function loadAdminApps() {
			$app=$_REQUEST['app']; 
			baseApps("app_".$app);				
		}
	}
}
else {
	function sysAdminApps() {	
		/* blank line */
	}
	function loadAdminApps() {
		require(AdminPath."/dasboard.php");			
	}
}

?>
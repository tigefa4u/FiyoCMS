<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.php
**/

defined('_FINDEX_') or die('Access Denied');



if(isset($_POST['install'])) {
	include("system/function.php");
	extractZip('system/installer.zip',__dir__);


}


$file = "system/installer/index.php";

if(file_exists($file)) :
	include($file);
else :

	echo "<div style='border: 2px solid #09f; font-size: .8em; font-family: Arial;background: #FCF0F0;border: 2px solid #F07272;padding: 10px;'><form action='' method='POST' style='margin:0 0 2px;'>
	Configuration file (<b>config.php</b>) is not found! Please upload config.php file or start <input type='submit' value='new installation' name='install'>
	</form></div>";
?>

<?php endif; ?>
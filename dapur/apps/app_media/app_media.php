<?php 
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

if(isset($_REQUEST['type']))
	$type=$_REQUEST['type'];
else
	$type = 'images';
	
?>
<div id="app_header">
	 <div class="warp_app_header">		
		<div class="app_title">Media Manager</div>
		<div class="app_link">
			
			<a class="lbt img tooltip" href="?app=media" title="Images Media">Images</a>
			<a class="lbt flash tooltip" href="?app=media&type=flash" title="Flash Media">Flash</a>
			<a class="lbt files tooltip" href="?app=media&type=files" title="Files Media">Files</a>			
			<span class="lbt sparator"></span>
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>
			<div id="helper"><?php echo Media_Manager_help; ?></div>
		</div>		
	 </div>
</div>
<iframe src="../plugins/plg_kcfinder/browse.php?type=<?php echo $type; ?>" width="99.65%" height="400px" style="border:solid 1px #ccc; -moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px; background:#eee ;margin:5px 0 1px;"></iframe>
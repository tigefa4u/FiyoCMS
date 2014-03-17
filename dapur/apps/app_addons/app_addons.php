<?php
/**
* @version		1.4.1
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"aaSorting": [[ 1, "asc" ]]
				
		});
		$("#form").submit(function(e){
		if (!confirm("Are you sure want to delete selected item(s)?"))
			{
				e.preventDefault();
				return;
			} 
		});
	});

</script>
<div id="stat"></div>
<form method="post" id="form" enctype="multipart/form-data" typeion="" target="">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title">AddOns Manager</div>
			<div class="app_link">			
				<?php if(isset($_GET['type']) AND $_GET['type'] != 'install' or !isset($_GET['type'])) : ?>
				<a class="lbt install tooltip link" href="?app=addons&type=install" title="Install">Install</a>
				<input type="submit" class="lbt uninstall tooltip" title="Uninstall" value="Uninstall" name="uninstall"/>	
				<?php else : ?>				
				<a class="lbt install tooltip transparant"  title="Install"></a>
				<a class="lbt uninstall tooltip transparant" title="Uninstall"></a>
				<?php endif; ?>
				
				<hr class="lbt sparator tooltip"  />	
				<a class="lbt apps tooltip link" href="?app=addons" title="<?php echo Manage_Apps; ?>">Apps</a>		
				<a class="lbt module tooltip link" href="?app=addons&type=modules" title="<?php echo Manage_Modules; ?>">Modules</a>	
				<a class="lbt theme tooltip link" href="?app=addons&type=themes" title="<?php echo Manage_Themes; ?>">Themes</a>	
				<a class="lbt plugin tooltip" href="?app=addons&type=plugins" title="<?php echo Manage_Plugins; ?>">Plugins</a>
				<hr class="lbt sparator tooltip"  />	
				<a class="lbt help popup tooltip" href="#helper" title="<?php echo Click_for_help; ?>">Help</a>
			<div id="helper"><?php echo AddOns_help; ?></div>
			</div>
		</div>		 
	</div>
<?php	
	switch(@$_REQUEST['type']) {
		case 'apps':	 
		 require('apps.php');
		break;
		case 'plugins':
		 require('plugins.php');
		break;
		case 'plugin_params':
		 require('controler/plg_params.php');
		break;
		case 'themes':
		 require('themes.php');
		break;
		case 'modules':
		 require('modules.php');
		break;
		case 'install':
		 require('installer.inc.php');
		break;
		default :
		 require('apps.php');
		break;
	}
?>	
</form>		

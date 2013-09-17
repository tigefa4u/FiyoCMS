<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

if(isset($_POST['next']) or isset($_POST['folder'])) {
	if(empty($_POST['folder'])) {
		alert('error',Please_select_modul_first);
		addModuleStep1();
	}
	else {			
		addModuleStep2();
	}
}
else { 
	addModuleStep1();
}

function addModuleStep1() {
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"aaSorting": [[ 1, "asc" ]]
				
		});
	});
</script>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
		
			<div class="app_title"><?php echo New_Module; ?></div>
			
			<div class="app_link">
				<a class="lbt prev tooltip" href="?app=module" title="<?php echo Back; ?>">Prev</a>
				<input type="submit" value="Next" class="lbt next  tooltip" title="<?php echo Next; ?>" id="next1" name="next"/>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>">Help</a>
				<div id="helper"><?php echo Add_Module_1_help; ?></div>
				
			</div>
		 </div>			 
	</div>
		
	<table class="data">
		<thead>
			<tr>
				<th width="6%" class="no"></th>
				<th style="width:40% !important;"><?php echo Module_Name; ?></th>
				<th style="width:30% !important;"><?php echo AddOns_Author; ?></th>
				<th style="width:10% !important;"><?php echo Version; ?></th>
				<th style="width:20% !important;"><?php echo Update_date; ?></th>
			</tr>
		</thead>
				
		<?php
			$dir=opendir("../modules"); 
			$no=1;
			while($folder=readdir($dir)){ 
				if($folder=="." or $folder=="..")continue; 
				if(is_dir("../modules/$folder"))
				{
					include("../modules/$folder/mod_details.php");
					echo "<tr>
					<label><td align=\"center\">
						<input type=\"radio\" name=\"folder\"  value=\"$folder\">
					</td>
					<td><a title=\"$module_desc\" class=\"tooltip help\">$module_name</a>";			
					echo "</td>
					<td>$module_author </td>
					<td>$module_version </td>
					<td>$module_date </td>
					</tr>";
				}
				$no++;
			} 
			closedir($dir);
		?> 
	</table>
</form>
<?php 
}

function addModuleStep2() {
?>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo New_Module; ?></div>			
			<div class="app_link">	
				<a class="lbt prev tooltip" href="?app=module&act=add" title="<?php echo Back; ?>"></a>
				<span class="lbt sparator"></span>
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_add"/>
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_add"/>
				<a class="lbt cancel tooltip" href="?app=module" title="<?php echo Cancel; ?>"></a>
				<span class="lbt sparator"></span>
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Add_Module_2_help; ?></div>
			</div>
		</div>			 
	</div>		
	<?php 
		require('field_module.php');
	?>			
</form>
<?php 
}
?>
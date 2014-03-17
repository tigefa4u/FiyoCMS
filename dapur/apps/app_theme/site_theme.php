<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null ]	
		});
				
	});	
</script> 	
<form method="post">
	<input type="hidden" id="val"/>
	<div id="app_header">
	 <div class="warp_app_header">
		
		<div class="app_title">Theme Manager</div>
		<div class="app_link">			
			<input type="submit" class="lbt save tooltip" title="<?php echo Set_as_default_theme; ?>" value="Save" name="themes_submit" id="themes_submit"/>	
			<input type="submit" class="lbt filetree tooltip" title="<?php echo Edit; ?>" value="Edit" name="themes_files" id="themes_submit"/>	
				<hr class="lbt sparator tooltip">
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>
			
			<div id="helper"><?php echo Theme_help; ?></div>
		</div>
	 </div>		
	</div>		
	<table class="data">
	  <thead>
		<tr>
			<th style="width:1%  !important;" class='no' align='center'>#</td>
			<th style="width:20%  !important;"><?php echo Theme_Name; ?></th>
			<th style="width:9%  !important;"><?php echo AddOns_Author; ?></th>
			<th style="width:30%  !important;"><?php echo Information; ?></th>
			<th style="width:10%  !important;"><?php echo Creation_date; ?></th>
		</tr>
	  </thead>
		<?php			
			$sql=$db->select(FDBPrefix.'setting','*',"name='site_theme'"); 
			$qr_themes = mysql_fetch_array($sql); 
			$dir=opendir("../themes");  
			$no=0;
			while($folder=readdir($dir)){ 
				if($folder=="." or $folder=="..")continue; 
				if(is_dir("../themes/$folder"))
				{
				
				$spot_file = "../themes/$folder/theme_details.php";
				if(file_exists($spot_file)) include("$spot_file");
				else {
					$theme_version = "Error :: File <b>theme_details.php</b> not found in <b>$folder</b> ";
					$theme_author = "undefined";
					$theme_date =  "undefined";
					$theme_name =  "$folder";
				}
				echo "<tr>
				<td align=\"center\">
				<input type=\"radio\" name=\"folder_themes\" value=\"$folder\" class=\"folder_theme\"></td>
				<td><a title=\"<img src='../themes/$folder/theme_image.gif' class='theme_image'>\" class=\"tooltip atheme\">$theme_name";
				if($qr_themes['value']==$folder) {echo '<span class="icon default"></span></a>';}				
				echo "</td>
				<td>$theme_author </td>
				<td>$theme_version </td>
				<td>$theme_date </td>
				</tr>";
				 }
				$no++;
			} 
			closedir($dir); 			
		?>			
	</table>
</form>
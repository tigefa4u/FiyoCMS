<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<table class="data">
	<thead>
	<tr>
		<th style="width:1% !important;"  class="no"></th>
		<th style="width:75% !important;"><?php echo Theme_Name; ?></th>
		<th style="width:25% !important;"><?php echo AddOns_Author; ?></th>
	</tr>
	</thead>
	<?php	
	$db = new FQuery();  
	$db->connect();			
	$folback = siteConfig('backend_folder');
	$atheme = siteConfig('admin_theme');
	$themes = siteConfig('site_theme');
	if(isset($_POST['uninstall']) AND !empty($_POST['folder'])) {
		$folder = $_POST['folder'];			
		if(preg_match ( "/[\.]/i" , $folder)) {
			$folder = str_replace(".atm","",$folder);
			if($folder==$atheme) {
				alert('error',Theme_already_used);
			}
			else {
				$a = $b = $c = 'Null <br>';
				$del = delete_directory("$folback/themes/$folder");
				$del2 = delete_directory("../$folback/themes/$folder");
				if($del) $a ="folder <i>folder/$folder</i> ".deleted."!<br>";	
				if($del2) $b ="folder <i>folder/$folder</i> ".deleted."!<br>";				
				if($del2 or $del) $c = "tabel <i>$folder</i> ".deleted."!<br>";	
				alert('info',"$a $b $c");
		}
		}
		else {
			if($folder==$themes) {
				alert('error',Theme_already_used);
			}
			else {
				$a = $b = $c = 'Null <br>';
				$del = delete_directory("themes/$folder");
				$del2 = delete_directory("../themes/$folder");
				if($del) $a ="folder <i>folder/$folder</i> ".deleted."!<br>";	
				if($del2) $b ="folder <i>folder/$folder</i> ".deleted."!<br>";				
				if($del2 or $del) $c = "tabel <i>$folder</i> ".deleted."!<br>";	
				alert('info',"$a $b $c");
			}		
		}
	}		
			
	$dir=opendir("../themes"); 
	while($folder=readdir($dir)){ 
		if($folder=="." or $folder=="..")continue; 
		if(is_dir("../themes/$folder"))	{
			
			if(file_exists("../themes/$folder/theme_details.php"))
				include("../themes/$folder/theme_details.php");		
				
			if(siteConfig('site_theme') == "$folder")
				$box = "<span class='icon lock'></lock>";
				else
				$box = "<input type=\"radio\" name=\"folder\" value=\"$folder\" class=\"folder_theme\">";				
			echo "<tr>
			<td align=\"center\">$box</td>
			<td><a title=\"<img src='../themes/$folder/theme_image.png' class='theme_image'>\" class=\"tooltip atheme\">$theme_name";							
			echo "</td>
			<td>$theme_author</td>
			</tr>";
		}
	} 
	closedir($dir);
		
	$dir = opendir("../$folback/themes"); 
		while($folder=readdir($dir)){ 
			if($folder=="." or $folder=="..")continue; 
			if(is_dir("../$folback/themes/$folder"))
			{
				include("../$folback/themes/$folder/theme_details.php");	
				if(siteConfig('admin_theme') == "$folder")
					$box = "<span class='icon lock'></lock>";
				else
					$box = "<input type=\"radio\" name=\"folder\" value=\"$folder.atm\" class=\"folder_theme\">";			
				echo "<tr><td align=\"center\">$box</td>
					<td><a title=\"<img src='../$folback/themes/$folder/theme_image.png' class='theme_image'>\" class=\"tooltip atheme\">$theme_name <i>(Admin Theme)</i>";							
				echo "</td><td>$theme_author</td></tr>";
			 }
		} 
		closedir($dir);
	?> 
</table>


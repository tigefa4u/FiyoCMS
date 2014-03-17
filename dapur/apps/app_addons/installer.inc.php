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

<div class="cols">
	<div class="col first full">
		<h3>AddOns Installer</h3>
		<?php		
	if(isset($_POST['upload']) or isset($_POST['copy'])) {	
		if(isset($_POST['upload'])) {
			$path_file = $_FILES['zip']['tmp_name'];
			$type_file = $_FILES['zip']['type'];
			$name_file = $_FILES['zip']['name'];
			$name_file = md5($name_file);
			$_SESSION['file'] = $path_file;
		} else if(isset($_POST['copy'])) {
			$url_file  = $_POST['url'];
			@mkdir("../tmp");
			$name_file = md5($url_file);
			$path_file = "../tmp/$name_file.zip";
			@copy($url_file, $path_file);
		}
		
		if(!empty($path_file)) {
			if(extractZip($path_file,"../tmp/$name_file")) {
				unlink($path_file);
				if(file_exists("../tmp/$name_file/installer.php")) {
					include("../tmp/$name_file/installer.php");
					
					//Modules Installer
					if($addons['type'] == 'modules') {
						$folder	= "../modules/$addons[folder]";
						$copy	= @copy_directory("../tmp/$name_file",$folder);
					}
					//Plugins Installer
					else if($addons['type'] == 'plugins'){	
						insert_new_plg(@$addons['folder'],@$addons['parameter']);
						$folder	= "../plugins/$addons[folder]";				
						$copy	= @copy_directory("../tmp/$name_file",$folder);
					}
					//Apps Installer
					else if($addons['type'] == 'apps'){					
						if($addons['app_type'] > 0) { 
							insert_new_apps($addons['name'],$addons['folder'],$addons['author'],$addons['app_type']);
							$folback = siteConfig('backend_folder');
							if($addons['app_type'] == 3 or $addons['app_type'] == 1)
							$copy = @copy_directory("../tmp/$name_file/$addons[frontend]","../apps/$addons[folder]");
							if($addons['app_type'] == 2 or $addons['app_type'] == 1) 
							$copy = @copy_directory("../tmp/$name_file/$addons[backend]","../$folback/apps/$addons[folder]");
						}
					}
					//Themes Installer
					else if($addons['type'] == 'themes'){
						$folder	= "../plugins/$addons[folder]";	
						$copy = @copy_directory("../tmp/$name_file","../themes/$addons[folder]");
					}
					//Admin Themes installer
					else if($addons['type'] == 'admin_themes'){
						$flback = siteConfig('backend_folder');	
						$folder	= "../$flback/themes/$addons[folder]";	
						$copy	= @copy_directory("../tmp/$name_file",$folder);
					}
					//updater / patcher
					else if($addons['type'] == 'updater'){
						$copy	= @copy_directory("../tmp/$name_file","../");
						$dapur 	= siteConfig('backend_folder');
						if(siteConfig('backend_folder') != 'dapur')		
							@copy_directory("../dapur","../$dapur",true);
					} else {
						$fail = true;						
						alert('error',File_uploaded_not_valid);					
					}
					
					if(!isset($fail)) {
						if(isset($folder) AND file_exists("$folder/installer.php"))
							@unlink("$folder/installer.php");
						if($copy)
							alert('info',AddOns_installed);
						if(isset($addons['info']))
							echo "<div class='install_info'>$addons[info]</div>";
						delete_directory('../tmp');	
					}
				}
				else {
					alert('error',File_uploaded_not_valid);
				}
			}
			else{
				alert('error',File_not_support);
			}
		}
		else {
			alert('error',Please_choose_file);
		}
	}
	?> 
		<table class="data2">
			<tr>
				<td class="djudul tooltip" title="Install AddOns" style="width:5%">Install from PC</td>
				<td><span class='file'>
					<input type="file" name="zip" style="width: 350px" /></span> 
					<input type="submit" name="upload" value="&nbsp;Install&nbsp;" class="button"  />
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="Install AddOns" style="width:5%">Install from URL</td>
				<td><input type="text" name="url" style="width: 285px" placeholder="Insert url here" /> <input type="submit" name="copy" value="&nbsp;Install&nbsp;" class="button" style="margin-left:8px" /></td>
			</tr>
		</table>
	</div>
</div>	


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
		
		if(isset($_POST['upload'])) {
		
		$path_file = $_FILES['zip']['tmp_name'];
		$type_file = $_FILES['zip']['type'];
		$name_file = $_FILES['zip']['name'];
		$_SESSION['file'] = $path_file;
		
		if(!empty($path_file)) {	
			if(extractZip($path_file,'tmp')) {
				$dir=opendir("tmp"); 
				while($folder=readdir($dir)){ 
					if($folder=="." or $folder=="..")continue; 
					if(!preg_match ( "/[\.]/i" , $folder))
					{
						$atm = "tmp/$folder/atheme_installer.php";
						$plg = "tmp/$folder/plugin_installer.php";
						$thm = "tmp/$folder/theme_installer.php";
						$mod = "tmp/$folder/mod_installer.php";
						$app = "tmp/$folder/app_installer.php";
						$apf = "tmp/$folder/front_apps";
						$folback = siteConfig('backend_folder');
						
						//Modules Installer
						if(file_exists($mod)) {
							extractZip($path_file,'../modules');
							include($mod);
							alert('info',AddOns_installed);
							if(isset($module_info))
							echo "<div class='install_info'>$module_info</div>";
							
						}
						//Plugins Installer
						else if(file_exists($plg)){					
							extractZip($path_file,'../plugins');
							include($plg);
							alert('info',AddOns_installed);
							if(isset($plugin_info))
							echo "<div class='install_info'>$plugin_info</div>";
							
						}
						//Apps Installer
						else if(file_exists($app)){	
							extractZip($path_file,"../$folback/apps");
							include($app);
							$insser_apps_data = insert_new_apps($apps_name,$apps_folder,$apps_author,$apps_type);
							if($apps_type==1) {
								copy_directory($apf,"../apps/$folder");
								delete_directory("../$folback/apps/$folder/$folder");
							}
							alert('info',AddOns_installed);
							if(isset($apps_info))
							echo "<div class='install_info'>$apps_info</div>";
						}
						//Themes Installer
						else if(file_exists($thm)){					
							extractZip($path_file,'../themes');
							include($thm);
							alert('info',AddOns_installed);
							echo "<div class='install_info'>$theme_info</div>";
						}
						//adminThemes Installer
						else if(file_exists($atm)){					
							extractZip($path_file,"../$folback/themes");
							include($atm);
							alert('info',AddOns_installed);
							if(isset($theme_info))
							echo "<div class='install_info'>$theme_info</div>";
						}
						else
							alert('error',File_uploaded_not_valid);
						$opendir = $folder;				
					}
				}
				$opendir = "tmp/$opendir";
				$dir= @opendir($opendir); 
				while($folder= @readdir($dir)){
					@unlink ("$opendir/$folder");					
				}
				@closedir($dir);
			}
			else{
					alert('error',File_not_support);
			}
		}
		else {
			alert('error',Please_choose_file);
		}
	
	}
	delete_directory('tmp');		
	?> 
		<table class="data2">
			<tr>
				<td class="djudul tooltip" title="Install AddOns" style="width:4%">Install AddOns</td>
				<td><span class='file'><input type="file" name="zip"  /></span> <input type="submit" name="upload" value="Install Now" class='button' /></td>
			</tr>
		</table>
	</div>
</div>	


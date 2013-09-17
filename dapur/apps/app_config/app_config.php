<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect(); 
?>
<script type="text/javascript">
	$(function() {
		$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
		});
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
		});	
	});
</script>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title"><?php echo Site_Configuration; ?></div>
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" value="<?php echo Save; ?>" title="<?php echo Save; ?>" name="config_save"/>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"><?php echo Help; ?></a>
				<div id="helper"><?php echo Config_helper; ?></div>			
			</div>		
		</div>
	</div>
	
	<div class="cols">
		<div class="col first panin">
			<h3><?php echo Site_Settings; ?></h3>
			<div class="isi">
				<table class="data2">						
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_Name_tip; ?>" width="40%"> <?php echo Site_Name; ?></td>
						<td><input type="text" name="site_name" size="30" value="<?php echo siteConfig('site_name'); ?>" required></td>
					</tr> 
					
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_Title_tip; ?>"><?php echo Site_Title; ?></td>
						<td><input type="text" name="title" size="30" value="<?php echo siteConfig('site_title'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_URL_tip; ?>"><?php echo Site_URL; ?></td>
						<td>http://<input type="text" name="url" size="20" value="<?php echo siteConfig('site_url'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_Status_tip; ?>"><?php echo Site_Status; ?></td>
						<td style="padding: 6px 10px;">
							<?php 
								if(siteConfig('site_status')){$s1="selected checked"; $s0 = "";}
								else {$s0="selected checked"; $s1= "";}
							?>
							<p class="switch">
								<input id="radio1"  value="1" name="status" type="radio" <?php echo $s1;?> class="invisible">
								<input id="radio2"  value="0" name="status" type="radio" <?php echo $s0;?> class="invisible">
								<label for="radio1" class="cb-enable <?php echo $s1;?>"><span>Online</span></label>
								<label for="radio2" class="cb-disable <?php echo $s0;?>"><span>Offline</span></label>
							</p>
						</td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Member_Register_tip; ?>"><?php echo Member_Register; ?></td>
						<td style="padding: 6px 10px;">
							<?php 
								if(siteConfig('new_member')){$m1="selected checked"; $m0 = "";}
								else {$m0="selected checked"; $m1= "";}
							?>
							<p class="switch">
								<input id="radio11"  value="1" name="member" type="radio" <?php echo $m1;?> class="invisible">
								<input id="radio12"  value="0" name="member" type="radio" <?php echo $m0;?> class="invisible">
								<label for="radio11" class="cb-enable <?php echo $m1;?>"><span>Allow</span></label>
								<label for="radio12" class="cb-disable <?php echo $m0;?>"><span>Disallow</span></label>
							</p>
						</td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Meta_Keywords_tip; ?>"><?php echo Meta_Keywords; ?></td>
						<td><textarea rows="3" cols="30" name="meta_keys"><?php echo siteConfig('site_keys'); ?></textarea></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Meta_Description_tip; ?>"><?php echo Meta_Description; ?></td>
						<td>
						<textarea rows="5" cols="30" name="meta_desc"><?php echo siteConfig('site_desc'); ?></textarea></td>
					</tr>	
				</table>
			</div>
		</div>
				
		<div class="col noborder">			
		<ul class="accordion">
			<li>
				<h3><?php echo SEF_Settings; ?></h3>
				<div class="isi">
					<div class="acmain open">
					<table class="data2">				
						<tr>
							<td class="djudul tooltip" title="<?php echo SEF_URLs_tip; ?>"><?php echo SEF_URLs; ?></td>
							<td>
							<?php 
								if(siteConfig('sef_url')){$u1="selected checked"; $u0 = "";}
								else {$u0="selected checked"; $u1= "";}
							?>
							<p class="switch">
								<input id="radio3"  value="1" name="sef" type="radio" <?php echo $u1;?> class="invisible">
								<input id="radio4"  value="0" name="sef" type="radio" <?php echo $u0;?> class="invisible">
								<label for="radio3" class="cb-enable <?php echo $u1;?>"><span>On</span></label>
								<label for="radio4" class="cb-disable <?php echo $u0;?>"><span>Off</span></label>
							</p>
							</td>
						</tr>
						<tr>
							<td class="djudul tooltip" title="<?php echo Redirect_WWW_tip; ?>"><?php echo Redirect_WWW; ?></td>
							<td>
							<?php 
								if(siteConfig('sef_www')){$u1="selected checked"; $u0 = "";}
								else {$u0="selected checked"; $u1= "";}
							?>
							<p class="switch">
								<input id="radio3"  value="1" name="www" type="radio" <?php echo $u1;?> class="invisible">
								<input id="radio4"  value="0" name="www" type="radio" <?php echo $u0;?> class="invisible">
								<label for="radio3" class="cb-enable <?php echo $u1;?>"><span>On</span></label>
								<label for="radio4" class="cb-disable <?php echo $u0;?>"><span>Off</span></label>
							</p>
							</td>
						</tr>
						<tr>
							<td class="djudul tooltip" title="<?php echo Link_Follow_tip ?>">Link Follow </td>
							<td><?php 
								if(siteConfig('follow_link')){$l1="selected checked"; $l0 = "";}
								else {$l0="selected checked"; $l1= "";}
							?>
							<p class="switch">
								<input id="radio5"  value="1" name="follow_link" type="radio" <?php echo $l1;?> class="invisible">
								<input id="radio6"  value="0" name="follow_link" type="radio" <?php echo $l0;?> class="invisible">
								<label for="radio5" class="cb-enable <?php echo $l1;?>"><span>On</span></label>
								<label for="radio6" class="cb-disable <?php echo $l0;?>"><span>Off</span></label>
							</p></td>	
							</td>
						</tr>
						<tr>
							<td class="djudul tooltip" title="<?php echo Title_Type_tip; ?>"><?php echo Title_Type; ?></td>
							<td>
							<?php 
							$titile_type = siteConfig('title_type');
							$tt1 = $tt2 = $tt3 =$tt0 = 0;
							if($titile_type=='1') $tt1='selected'; 
							if($titile_type=='2') $tt2='selected';
							if($titile_type=='3') $tt3='selected'; 
							if($titile_type=='0') $tt0='selected';
							?>
							<select name="title_type"><option value="1" <?php echo $tt1; ?>>Page Title,  Sperator, Site Title</option><option value="2" <?php echo $tt2; ?>>Site Title,  Sperator, Page Title</option><option value="3" <?php echo $tt3; ?>>Page Title</option><option value="0" <?php echo $tt0; ?>>Site Title</option></select></td>
						</tr>
						<tr>
							<td class="djudul tooltip" title="<?php echo Title_Divider_tip; ?>"><?php echo Title_Divider; ?></td>
							<td><label>
							<input type="text" name="title_divider" size="5" value="<?php echo siteConfig('title_divider'); ?>"></label>							
							</td>
						</tr>	
						<tr>
							<td class="djudul tooltip" title="<?php echo SEF_Extention_tip ?>">SEF Extention</td>
							<td><label>
							<input type="text" name="sef_ext" size="5" value="<?php echo siteConfig('sef_ext'); ?>"></label>							
							
							</td>
						</tr>							
					</table>
					</div>	
				</div>	
			</li>         
		</ul>
      
		<ul class="accordion">
			<li>
				<h3><?php echo Database_Settings; ?></h3>
				<div class="isi">
				<div class="acmain">
				<table class="data2">					
					<div style="margin:3px 10px 0;padding:3px 5px; border:1px yellow solid; background:#FFFFE2"><?php echo Warning_to_Change_DB; ?></div>
					<tr>
						<td class="djudul tooltip" title="Database">Database</td>
						<td><input type="text" name="name" size="20" value="<?php echo FDBName; ?>" readonly></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="Hostname">Host</td>
						<td><input readonly type="text" value="<?php echo FDBHost; ?>" size="20" ></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="Username">Username</td>
						<td><input type="text" value="<?php echo FDBUser; ?>" size="20" readonly></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="Password">Password</td>
						<td><input type="password" value="<?php echo FDBPass; ?>" size="20" readonly></td>
					</tr>
				</table>
				</div>	
				</div>	
			</li> 		
			<li>
				<h3><?php echo Media_Settings; ?></h3>
				<div class="isi">
				<div class="acmain">
				<table class="data2">
					<tr>
						<td class="djudul tooltip" title="<?php echo Allow_File_Extentions_tip; ?>"><?php echo Allow_File_Extentions; ?></td>
						<td><input type="text" name="file_allowed" size="30" value="<?php echo siteConfig('file_allowed'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Max_File_Size_tip; ?>"><?php echo Max_File_Size; ?></td>
						<td><input type="text" name="file_size" size="20" class="numeric" value="<?php echo siteConfig('file_size'); ?>" ></td>
					</tr>				
					<tr>
						<td class="djudul tooltip" title="<?php echo Media_Theme_tip; ?>"><?php echo Media_Theme; ?></td>
						<td>
						<?php 
						$dark = $default = null;
						$theme_m  = siteConfig('media_theme'); 
						if($theme_m =='oxygen') $default='selected'; 
						if($theme_m =='dark') $dark='selected';?>
						<select name="media_theme"><option value="oxygen" <?php echo $default; ?>>Default</option><option value="dark" <?php echo $dark; ?>>Dark</option></select></td>
					</tr>
				</table></div>
				</div>	
			</li> 
			<li>
				<h3><?php echo BackEnd_Settings; ?></h3>
				<div class="isi">
				<div class="acmain">
				<table class="data2">
					<tr>
						<td class="djudul tooltip" title="<?php echo Folder_AdminPanel_tip; ?>"><?php echo Folder_AdminPanel; ?></td>
						<td><input type="text" name="folder_new" size="30" value="<?php echo oneQuery('setting','name','"backend_folder"','value'); ?>">
						<input type="hidden" name="folder_old" size="30" value="<?php echo oneQuery('setting','name','"backend_folder"','value'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Language_AdminPanel_tip; ?>"><?php echo Language; ?></td>
						<td>
						<select name="lang">
						<?php	
					
				$lang = siteConfig('lang');
				$dir=opendir("system/lang"); 
				$no=1;
				while($folder=readdir($dir)){ 
					if($folder=="." or $folder=="..")continue; 
					if(preg_match ( "/[\.]+php/i" , $folder))
					{	
						$folder = str_replace(".php","",$folder);
						if($folder == $lang) $selected_lang = 'selected';
						else $selected_lang = '';
						echo "<option value=\"$folder\" $selected_lang>$folder
						</option>";
					}
					$no++;
				} 
				closedir($dir);
			?> </select></td>
					</tr>
				</table></div>
				</div>	
			</li> 
		</ul>
		</div>
	</div>
</form>	

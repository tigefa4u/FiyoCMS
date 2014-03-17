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
						<td>http://<input type="text" name="url" size="25" value="<?php echo siteConfig('site_url'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_Mail_tip; ?>"><?php echo Site_Mail; ?></td>
						<td><input type="email" name="mail" size="30" value="<?php echo siteConfig('site_mail'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Folder_AdminPanel_tip; ?>"><?php echo Folder_AdminPanel; ?></td>
						<td><input type="text" name="folder_new" size="30" value="<?php echo siteConfig('backend_folder'); ?>">
						<input type="hidden" name="folder_old" size="20" value="<?php echo siteConfig('backend_folder'); ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Site_Status_tip; ?>"><?php echo Site_Status; ?></td>
						<td>
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
						<td class="djudul tooltip" title="<?php echo Meta_Keywords_tip; ?>"><?php echo Meta_Keywords; ?></td>
						<td><textarea rows="3" cols="30" name="meta_keys" style="width:90%"><?php echo siteConfig('site_keys'); ?></textarea></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Meta_Description_tip; ?>"><?php echo Meta_Description; ?></td>
						<td>
						<textarea rows="5" cols="30" name="meta_desc" style="width:90%"><?php echo siteConfig('site_desc'); ?></textarea></td>
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
								<input id="radio7"  value="1" name="www" type="radio" <?php echo $u1;?> class="invisible">
								<input id="radio8"  value="0" name="www" type="radio" <?php echo $u0;?> class="invisible">
								<label for="radio7" class="cb-enable <?php echo $u1;?>"><span>&nbsp;www&nbsp;</span></label>
								<label for="radio8" class="cb-disable <?php echo $u0;?>"><span style="padding:0 3.5px;">non-www</span></label>
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
								<label for="radio5" class="cb-enable <?php echo $l1;?>"><span><?php echo Yes; ?></span></label>
								<label for="radio6" class="cb-disable <?php echo $l0;?>"><span><?php echo No; ?></span></label>
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
				<h3><?php echo Member_Settings; ?></h3>
				<div class="isi">
				<div class="acmain">
				<table class="data2">					
						<tr>
						<td class="djudul tooltip" title="<?php echo Member_Register_tip; ?>"><?php echo Member_Register; ?></td>
						<td>
							<?php 
								if(siteConfig('member_registration')){$m1="selected checked"; $m0 = "";}
								else {$m0="selected checked"; $m1= "";}
							?>
							<p class="switch">
								<input id="radio11"  value="1" name="member_registration" type="radio" <?php echo $m1;?> class="invisible">
								<input id="radio12"  value="0" name="member_registration" type="radio" <?php echo $m0;?> class="invisible">
								<label for="radio11" class="cb-enable <?php echo $m1;?>"><span>Allow</span></label>
								<label for="radio12" class="cb-disable <?php echo $m0;?>"><span>Disallow</span></label>
							</p>
						</td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Member_Activation_tip; ?>"><?php echo Member_Activation; ?></td>
						<td>							
							<?php 
								$ac_1 = $ac_2 = $ac_3 = null;
								$ac  = siteConfig('member_activation'); 
								if($ac =='0') $ac_1 ='selected'; 
								if($ac =='1') $ac_2 ='selected';
								if($ac =='2') $ac_3 ='selected';
							?>
							<select name="member_activation">
								<option value="0" <?php echo $ac_1; ?>>Admin Confirmation</option>
								<option value="1" <?php echo $ac_2; ?>>Automatic</option>
								<option value="2" <?php echo $ac_3; ?>>Email Confirmation</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Default_Group_Member_tip; ?>"><?php echo Default_Group_Member; ?></td>
						<td>
						<select name="member_group" id="select">
						<?php
							$sql2=$db->select(FDBPrefix.'user_group'); 
							while($qrs=mysql_fetch_array($sql2)){
							 if($qrs['level'] >= USER_LEVEL) {
								if($qrs['level'] == 1){
									echo "<option value='$qrs[level]' disabled>$qrs[group_name]</option>";
								}
								else {
									if($qrs['level'] == siteConfig('member_group'))
										$s = 'selected';
									else
										$s = '';
									echo "<option value='$qrs[level]' $s>$qrs[group_name]</option>";
								}								
							  }
							}
						?>
						</select>
						</td>
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
						<td><input type="text" name="file_allowed" size="30" style="width:100%" value="<?php echo siteConfig('file_allowed'); ?>"></td>
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
						<td class="djudul tooltip" title="<?php echo Fiyo_Version_tip; ?>"><?php echo Fiyo_Version; ?></td>
						<td><b class="version-val"><?php echo siteConfig('version'); ?></b> <a type="button" name="upload" value="Check Update" class="popup button updater" href="#update">Check Update</a></td>
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
						?> </select>
					</td>
					</tr>
				
					
					<tr>
						<td class="djudul tooltip" title="<?php echo Time_Zone_tip; ?>"><?php echo Time_Zone; ?></td>
						<td>
						<select class="auth-input" id="timezone" name="timezone">
    <option <?php $value="Pacific/Midway"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-11:00) Midway Island</option>
    <option <?php $value="Pacific/Samoa"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-11:00) Samoa</option>
    <option <?php $value="Pacific/Honolulu"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-10:00) Hawaii</option>
    <option <?php $value="US/Alaska"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-09:00) Alaska</option>
    <option <?php $value="America/Los_Angeles"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-08:00) Pacific Time (US &amp; Canada)</option>
    <option <?php $value="America/Tijuana"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-08:00) Tijuana</option>
    <option <?php $value="US/Arizona"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-07:00) Arizona</option>
    <option <?php $value="America/Chihuahua"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-07:00) Chihuahua</option>
    <option <?php $value="America/Chihuahua"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-07:00) La Paz</option>
    <option <?php $value="America/Mazatlan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-07:00) Mazatlan</option>
    <option <?php $value="US/Mountain"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-07:00) Mountain Time (US &amp; Canada)</option>
    <option <?php $value="America/Managua"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Central America</option>
    <option <?php $value="US/Central"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Central Time (US &amp; Canada)</option>
    <option <?php $value="America/Mexico_City"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Guadalajara</option>
    <option <?php $value="America/Mexico_City"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Mexico City</option>
    <option <?php $value="America/Monterrey"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Monterrey</option>
    <option <?php $value="Canada/Saskatchewan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-06:00) Saskatchewan</option>
    <option <?php $value="America/Bogota"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-05:00) Bogota</option>
    <option <?php $value="US/Eastern"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-05:00) Eastern Time (US &amp; Canada)</option>
    <option <?php $value="US/East-Indiana"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-05:00) Indiana (East)</option>
    <option <?php $value="America/Lima"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-05:00) Lima</option>
    <option <?php $value="America/Bogota"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-05:00) Quito</option>
    <option <?php $value="Canada/Atlantic"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-04:00) Atlantic Time (Canada)</option>
    <option <?php $value="America/Caracas"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-04:30) Caracas</option>
    <option <?php $value="America/La_Paz"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-04:00) La Paz</option>
    <option <?php $value="America/Santiago"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-04:00) Santiago</option>
    <option <?php $value="Canada/Newfoundland"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-03:30) Newfoundland</option>
    <option <?php $value="America/Sao_Paulo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-03:00) Brasilia</option>
    <option <?php $value="America/Argentina/Buenos_Aires"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-03:00) Buenos Aires</option>
    <option <?php $value="America/Argentina/Buenos_Aires"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-03:00) Georgetown</option>
    <option <?php $value="America/Godthab"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-03:00) Greenland</option>
    <option <?php $value="America/Noronha"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-02:00) Mid-Atlantic</option>
    <option <?php $value="Atlantic/Azores"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-01:00) Azores</option>
    <option <?php $value="Atlantic/Cape_Verde"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC-01:00) Cape Verde Is.</option>
    <option <?php $value="Africa/Casablanca"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) Casablanca</option>
    <option <?php $value="Europe/London"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) Edinburgh</option>
    <option <?php $value="Etc/Greenwich"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) Greenwich Mean Time : Dublin</option>
    <option <?php $value="Europe/Lisbon"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) Lisbon</option>
    <option <?php $value="Europe/London"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) London</option>
    <option <?php $value="Africa/Monrovia"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) Monrovia</option>
    <option <?php $value="UTC"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+00:00) UTC</option>
    <option <?php $value="Europe/Amsterdam"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Amsterdam</option>
    <option <?php $value="Europe/Belgrade"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Belgrade</option>
    <option <?php $value="Europe/Berlin"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Berlin</option>
    <option <?php $value="Europe/Berlin"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Bern</option>
    <option <?php $value="Europe/Bratislava"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Bratislava</option>
    <option <?php $value="Europe/Brussels"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Brussels</option>
    <option <?php $value="Europe/Budapest"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Budapest</option>
    <option <?php $value="Europe/Copenhagen"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Copenhagen</option>
    <option <?php $value="Europe/Ljubljana"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Ljubljana</option>
    <option <?php $value="Europe/Madrid"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Madrid</option>
    <option <?php $value="Europe/Paris"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Paris</option>
    <option <?php $value="Europe/Prague"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Prague</option>
    <option <?php $value="Europe/Rome"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Rome</option>
    <option <?php $value="Europe/Sarajevo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Sarajevo</option>
    <option <?php $value="Europe/Skopje"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Skopje</option>
    <option <?php $value="Europe/Stockholm"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Stockholm</option>
    <option <?php $value="Europe/Vienna"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Vienna</option>
    <option <?php $value="Europe/Warsaw"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Warsaw</option>
    <option <?php $value="Africa/Lagos"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) West Central Africa</option>
    <option <?php $value="Europe/Zagreb"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+01:00) Zagreb</option>
    <option <?php $value="Europe/Athens"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Athens</option>
    <option <?php $value="Europe/Bucharest"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Bucharest</option>
    <option <?php $value="Africa/Cairo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Cairo</option>
    <option <?php $value="Africa/Harare"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Harare</option>
    <option <?php $value="Europe/Helsinki"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Helsinki</option>
    <option <?php $value="Europe/Istanbul"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Istanbul</option>
    <option <?php $value="Asia/Jerusalem"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Jerusalem</option>
    <option <?php $value="Europe/Helsinki"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Kyiv</option>
    <option <?php $value="Africa/Johannesburg"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Pretoria</option>
    <option <?php $value="Europe/Riga"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Riga</option>
    <option <?php $value="Europe/Sofia"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Sofia</option>
    <option <?php $value="Europe/Tallinn"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Tallinn</option>
    <option <?php $value="Europe/Vilnius"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+02:00) Vilnius</option>
    <option <?php $value="Asia/Baghdad"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Baghdad</option>
    <option <?php $value="Asia/Kuwait"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Kuwait</option>
    <option <?php $value="Europe/Minsk"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Minsk</option>
    <option <?php $value="Africa/Nairobi"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Nairobi</option>
    <option <?php $value="Asia/Riyadh"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Riyadh</option>
    <option <?php $value="Europe/Volgograd"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:00) Volgograd</option>
    <option <?php $value="Asia/Tehran"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+03:30) Tehran</option>
    <option <?php $value="Asia/Muscat"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Abu Dhabi</option>
    <option <?php $value="Asia/Baku"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Baku</option>
    <option <?php $value="Europe/Moscow"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Moscow</option>
    <option <?php $value="Asia/Muscat"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Muscat</option>
    <option <?php $value="Europe/Moscow"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) St. Petersburg</option>
    <option <?php $value="Asia/Tbilisi"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Tbilisi</option>
    <option <?php $value="Asia/Yerevan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:00) Yerevan</option>
    <option <?php $value="Asia/Kabul"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+04:30) Kabul</option>
    <option <?php $value="Asia/Karachi"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:00) Islamabad</option>
    <option <?php $value="Asia/Karachi"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:00) Karachi</option>
    <option <?php $value="Asia/Tashkent"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:00) Tashkent</option>
    <option <?php $value="Asia/Calcutta"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:30) Chennai</option>
    <option <?php $value="Asia/Kolkata"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:30) Kolkata</option>
    <option <?php $value="Asia/Calcutta"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:30) Mumbai</option>
    <option <?php $value="Asia/Calcutta"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:30) New Delhi</option>
    <option <?php $value="Asia/Calcutta"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:30) Sri Jayawardenepura</option>
    <option <?php $value="Asia/Katmandu"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+05:45) Kathmandu</option>
    <option <?php $value="Asia/Almaty"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+06:00) Almaty</option>
    <option <?php $value="Asia/Dhaka"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+06:00) Astana</option>
    <option <?php $value="Asia/Dhaka"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+06:00) Dhaka</option>
    <option <?php $value="Asia/Yekaterinburg"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+06:00) Ekaterinburg</option>
    <option <?php $value="Asia/Rangoon"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+06:30) Rangoon</option>
    <option <?php $value="Asia/Bangkok"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+07:00) Bangkok</option>
    <option <?php $value="Asia/Bangkok"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+07:00) Hanoi</option>
    <option <?php $value="Asia/Jakarta"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+07:00) Jakarta</option>
    <option <?php $value="Asia/Novosibirsk"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+07:00) Novosibirsk</option>
    <option <?php $value="Asia/Hong_Kong"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Beijing</option>
    <option <?php $value="Asia/Chongqing"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Chongqing</option>
    <option <?php $value="Asia/Hong_Kong"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Hong Kong</option>
    <option <?php $value="Asia/Krasnoyarsk"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Krasnoyarsk</option>
    <option <?php $value="Asia/Kuala_Lumpur"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Kuala Lumpur</option>
    <option <?php $value="Australia/Perth"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Perth</option>
    <option <?php $value="Asia/Singapore"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Singapore</option>
    <option <?php $value="Asia/Taipei"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Taipei</option>
    <option <?php $value="Asia/Ulan_Bator"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Ulaan Bataar</option>
    <option <?php $value="Asia/Urumqi"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+08:00) Urumqi</option>
    <option <?php $value="Asia/Irkutsk"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:00) Irkutsk</option>
    <option <?php $value="Asia/Tokyo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:00) Osaka</option>
    <option <?php $value="Asia/Tokyo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:00) Sapporo</option>
    <option <?php $value="Asia/Seoul"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:00) Seoul</option>
    <option <?php $value="Asia/Tokyo"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:00) Tokyo</option>
    <option <?php $value="Australia/Adelaide"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:30) Adelaide</option>
    <option <?php $value="Australia/Darwin"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+09:30) Darwin</option>
    <option <?php $value="Australia/Brisbane"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Brisbane</option>
    <option <?php $value="Australia/Canberra"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Canberra</option>
    <option <?php $value="Pacific/Guam"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Guam</option>
    <option <?php $value="Australia/Hobart"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Hobart</option>
    <option <?php $value="Australia/Melbourne"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Melbourne</option>
    <option <?php $value="Pacific/Port_Moresby"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Port Moresby</option>
    <option <?php $value="Australia/Sydney"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Sydney</option>
    <option <?php $value="Asia/Yakutsk"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+10:00) Yakutsk</option>
    <option <?php $value="Asia/Vladivostok"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+11:00) Vladivostok</option>
    <option <?php $value="Pacific/Auckland"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Auckland</option>
    <option <?php $value="Pacific/Fiji"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Fiji</option>
    <option <?php $value="Pacific/Kwajalein"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) International Date Line West</option>
    <option <?php $value="Asia/Kamchatka"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Kamchatka</option>
    <option <?php $value="Asia/Magadan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Magadan</option>
    <option <?php $value="Pacific/Fiji"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Marshall Is.</option>
    <option <?php $value="Asia/Magadan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) New Caledonia</option>
    <option <?php $value="Asia/Magadan"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Solomon Is.</option>
    <option <?php $value="Pacific/Auckland"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+12:00) Wellington</option>
    <option <?php $value="Pacific/Tongatapu"; echo "value ='$value'"; if(siteConfig('timezone') == "$value") echo "selected"; ?>>(UTC+13:00) Nuku'alofa</option>
</select>
</select>
						</td>
					</tr>
				</table></div>
				</div>	
			</li> 
		</ul>
		</div>
	</div>
</form>	
<script>
	$(".updater").click(function() {
		$(this).html("Loading...");
		$("#update #updater_id").html('<h3>Loading for Updates</h3><img src="<?php echo AdminPath ?>/images/update.gif">');
		$.ajax({
			data:'updater=true',
			type:'POST',
			url: "apps/app_config/controller/updater.php",
			success: function(data){
				$("#update #updater_id").html(data);
				$(".updater").html("Check Update");
			}
		});
	});

</script>

<!-- UPDATER POPUP -->
<div class="popup_warp">
	<div id="update" class="pop_up" style="padding:10px">
		<div id="updater_id">		
		</div>
	</div>	
</div>

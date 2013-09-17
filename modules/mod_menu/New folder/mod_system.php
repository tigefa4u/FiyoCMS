<?php
/**
* @name			Module Menu
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

define('_Mod_SubTitle_',$sub_title);
define('_Mod_SubMenu_',$sub_title);

function sub_menu($parent_id){
	$db = new FQuery();  
	$db -> connect(); 
	$menus = $db->select(FDBPrefix."menu","*","parent_id=$parent_id AND status=1","short ASC"); 	
	
	if(mysql_num_rows($menus)>0) {
		echo "<ul class=\"sub-menu\">";
		while($menu = mysql_fetch_array($menus)){			
			if(defined('SEF_URL'))
			{	
				$link = make_permalink($menu['link'],$menu['id']);
			}
			else
			{
				if(empty($menu['id'])) $menu['id'] = Page_ID;
				$link = "$menu[link]";
			}
			
			$sub_title 	= _Mod_SubTitle_;
			if($sub_title==1) 
				$subtitle="<span>$menu[sub_name]</span>";
			else 
				$subtitle="";		
			if($menu['id']==Page_ID)
				$a=" active"; 
			else 
				$a="";
			if ($menu['home']==0){
				if ($menu['app']=="sperator"){
				echo "<li class=\"menu$menu[class]$a\"><a href='#'>$menu[name]$subtitle</a>";
				if(_Mod_SubMenu_==1) sub_menu($menu['id']);
				echo "</li>";
			}
			elseif ($menu['app']=="link"){
				echo "<li class=\"menu$menu[class]$a\" style=\"$menu[style]\"><a href=\"$link\">$menu[name]$subtitle</a>";
				if(_Mod_SubMenu_==1) sub_menu($menu['id']);
				echo "</li>";
			}
			else { 
				if(empty($menu['link']))$menu['link']="#";
				echo "<li class=\"menu$menu[class]$a\" style=\"$menu[style]\"><a href=\"$link\">$menu[name]$subtitle</a>";
				if(_Mod_SubMenu_ == 1) sub_menu($menu['id']);
				echo "</li>";
			}	
			}
			else {
				echo "<li class=\"menu$menu[class]$a\" style=\"$menu[style]\"><a href=\"".FUrl."\">$menu[name]$subtitle</a>";
			}					
		}
		echo "</ul>";
	}	
}	

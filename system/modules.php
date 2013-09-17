<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

function loadModule($position)
{	
	$db = new FQuery();  
	$db ->connect();	
	$qrs = $db->select(FDBPrefix.'module','*',"status=1 AND position='$position'" .Level_Access, 'short ASC');	
	while($qr=mysql_fetch_array($qrs)){	
	
		if(!empty($qr['page'])) {
			$page = explode(",",$qr['page']);
			foreach($page as $val)
			{			
				if(Page_ID == $val)
				{ 	
					$qr['show_title']== 1 ? $title="<h3>$qr[name]</h3>" : $title = "";						
					echo "<div class=\"modules $qr[class]\">$title<div class=\"mod-inner\" style=\"$qr[style]\">";
					$modId = $qr['id'];
					$modParam = $qr['parameter'];
					$modFolder = $qr['folder'];
					$file = "modules/$qr[folder]/$qr[folder].php";	
					if(file_exists($file))
						include($file);
					else
						echo "<b>$file</b> is not extist";
					echo"</div></div>";
				}
			}
		}
		
		else if($qr['page']==Page_ID AND FUrl==$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']){
			if($qr['show_title']==1){$title="<h3>$qr[name]</h3>";}
			else {$title="";}
			echo "<div class=\"modules $qr[class]\">$title<div class=\"mod-inner\" style=\"$qr[style]\">";
			$file	="modules/$qr[folder]/$qr[folder].php";	
			$modId = $qr['id'];
			$modFolder = $qr['folder'];
			$modParam = $qr['parameter'];
			if(file_exists($file))
				include($file);
			else
				echo "<b>$file</b> is not extist";
			echo"</div></div>";
		}
	}
}

function checkModule($position) {
	$db = new FQuery();  
	$db ->connect();	
	if(!defined('Page_ID') AND $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==FUrl){
		$sql=$db->select(FDBPrefix.'menu','*','home=1'); 
		$qr = mysql_fetch_array($sql);
		$pid= $qr['id'];
	}
	else{	
		$pid = Page_ID;
		if(empty($pid)) $pid = 0;
	}
	$val = false;
	$qrs = $db->select(FDBPrefix.'module','*',"status=1 AND position = '$position'" .Level_Access, 'short ASC');
	while($qr=mysql_fetch_array($qrs)){
		if(!empty($qr['page'])) {
			$pid = explode(",",$qr['page']);
			foreach($pid as $a) {
				if($a == Page_ID )
				$val = true;
			}
		}		
	}	
	return $val;
}


function loadModuleCss() {
	$db = new FQuery();  
	$db ->connect();	
	if(!defined('Page_ID') AND $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==FUrl){
		$sql=$db->select(FDBPrefix.'menu','*','home=1'); 
		$qr = mysql_fetch_array($sql);
		$pid= $qr['id'];
	}
	else{	
		$pid = Page_ID;
		if(empty($pid)) $pid = 0;
	}
	$val = false;
	$no = 1;
	$qrs = $db->select(FDBPrefix.'module','*',"status=1 " .Level_Access, 'short ASC');
	while($qr=mysql_fetch_array($qrs)){
		if(!empty($qr['page'])) {
			$pid = explode(",",$qr['page']);
			foreach($pid as $a) { 
				if($a == Page_ID ) {
					$file	= "modules/$qr[folder]/mod_style.php";
					if(file_exists($file)) {
						if($no > 1)
						echo "\t";
						require_once ($file);
						echo "\n";
						$no++;
					}	
				}
			
			}
		}		
	}	
}
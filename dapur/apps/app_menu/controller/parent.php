<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

if(isset($_SESSION['USER_LEVEL']) <= 2) :
define('_FINDEX_',1);

require_once ('../../../system/jscore.php');
$db = new FQuery();  
$db->connect(); 

/****************************************/
/*	    Enable and Disbale Article		*/
/****************************************/
if(isset($_GET['cat'])) {
	echo "<option value=''></option>";	
	$sql3 = $db->select(FDBPrefix.'menu','*',"parent_id=0 AND category = '$_GET[cat]'",'short ASC'); 
	while($qr=mysql_fetch_array($sql3)){	
		if($qr['id']==$_GET['parent_id']){ 
			echo "<option value='$qr[id]' selected>$qr[name]</option>";
			option_sub_menu($qr['id'],$_GET['parent_id'],'');
		}
		else {
			echo "<option value='$qr[id]'>$qr[name]</option>";option_sub_menu($qr['id'],$_GET['parent_id'],'');
		}
	}				
}

	
endif;

function option_sub_menu($parent_id,$sub = NULL,$pre) {
	$db = new FQuery();  
	$db->connect(); 
	if($_REQUEST['id']) $eid = "AND id!=$_REQUEST[id]";
	$sql = $db->select(FDBPrefix."menu","*","parent_id=$parent_id $eid");  
	while($qr=mysql_fetch_array($sql)){	
		if($sub==$qr['id']) $s="selected"; else $s="";
		echo "<option value='$qr[id]' $s>$pre|_ $qr[name]</option>";
		option_sub_menu($qr['id'],$sub,$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");	
	}	
}
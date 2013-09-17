<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

// Access only for Administrator
if($_SESSION['USER_LEVEL'] > 2)
	redirect('index.php');
	
$db = new FQuery();  
$db->connect(); 

/****************************************/
/*			   Add Module				*/
/****************************************/
if(isset($_POST['save_add']) or isset($_POST['apply_add'])){	
	if(!empty($_POST['title']) AND !empty($_POST['folder']) AND !empty($_POST['position'])) {	
		$param=''; // first value from $param
		if((@$_POST['totalParam']) >= 1){			
			for($p=1;$p<=$_POST['totalParam'];$p++)
			{	
				@$pars = $_POST["param$p"];
				if(@multipleSelect($pars))
					@$pars = multipleSelect($pars);
				else
					@$pars = $pars;
				@$param .=$_POST["nameParam$p"]."=".$pars.';\n';
			}
		}
		
		$page = @$_POST['page'];
		$page = @multipleSelect($page);
		
		@$parameter=str_replace('"',"'","$_POST[editor]");
		@$parameter=$parameter.$param;
		
		if(checkLocalhost()) {
			$parameter = str_replace(FLocal."media/","media/",$parameter);			
		}
		
		$qr=$db->insert(FDBPrefix.'module',array("","$_POST[title]","$_POST[folder]","$_POST[position]","$_POST[short]","$_POST[level]","$_POST[status]","$page","$parameter","$_POST[class]","$_POST[style]","$_POST[show_title]"));
		if($qr AND isset($_POST['apply_add'])){
			$db = new FQuery();  
			$db->connect(); 				
			$sql = $db->select(FDBPrefix.'module','id','','id DESC' ); 
			$qr=mysql_fetch_array($sql);
			alert('loading');
			alert('info',New_Module_Saved);
			htmlRedirect('?app=module&act=edit&id='.$qr['id'],1);
		}
		elseif($qr AND isset($_POST['save_add'])) {
			alert(loading);	
			alert('info',New_Module_Saved);
			if($qr)
			htmlRedirect('?app=module',1);
		}
		else {
			alert('error',Status_Invalid);
		}					
	}
	else 
	{			
		alert('error',Status_Invalid);
	}	
}	

/****************************************/
/*			   Edit Module				*/
/****************************************/	
if(isset($_POST['save_edit']) or isset($_POST['apply_edit'])){	
	if(!empty($_POST['title']) AND !empty($_POST['folder']) AND !empty($_POST['position'])) {
		$param = ''; // first value from $param
		if((@$_POST['totalParam']) >= 1){			
			for($p=1;$p<=$_POST['totalParam'];$p++)
			{	
				@$pars = $_POST["param$p"];
				if(@multipleSelect($pars))
					$pars = multipleSelect($pars);
				else
					$pars = $pars;
				@$param .=$_POST["nameParam$p"]."=".$pars.';\n';
			}
		}		
		
		@$page = $_POST['page'];
		@$page = multipleSelect($page);
		
		@$parameter = str_replace('"',"'","$_POST[editor]");
		@$parameter = $parameter.$param;
		
		if(checkLocalhost()) {
			$parameter = str_replace(FLocal."media/","media/",$parameter);			
		}
		
		$qr= $db-> update(FDBPrefix.'module',array("name"=>"$_POST[title]",
		"position"=>"$_POST[position]",
		"short"=>"$_POST[short]",
		"level"=>"$_POST[level]",
		"status"=>"$_POST[status]",
		"page"=>"$page",
		"class"=>"$_POST[class]",
		"style"=>"$_POST[style]",
		"parameter"=>"$parameter",
		"show_title"=>"$_POST[show_title]"),
		"id=$_REQUEST[id]");
			
		if($qr AND isset($_POST['apply_edit'])){				
			alert('info',Module_Saved);
		}
		elseif($qr AND isset($_POST['save_edit'])) {
			alert('loading');
			alert('info',Module_Saved);
			if($qr) htmlRedirect('?app=module',1);
		}
		else {
			alert('error',Status_Invalid);
		}					
	}
	else {			
		alert('error',Status_Invalid);
	}	
}

/****************************************/
/*			 Delete Module				*/
/****************************************/
if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('module',$source);	
	
	if(isset($delete))
		alert('info',Module_Deleted);
	else
		alert('error',Module_Not_Selected);
}

/****************************************/
/*	    Enable and Disbale Module		*/
/****************************************/
if(isset($_REQUEST['act'])) {
	if(!isset($_POST['delete']) AND $_REQUEST['act']=='enable'){
		$db->update(FDBPrefix.'module',array('status'=>'0'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}
	if(!isset($_POST['delete']) AND $_REQUEST['act']=='disable'){
		$db->update(FDBPrefix.'module',array('status'=>'1'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}
}

/****************************************/
/*	 Redirect when Module-Id not found	*/
/****************************************/
if(!isset($_POST['save_edit']) AND !isset($_POST['apply_edit'])) {
	if(isset($_REQUEST['act']))
		if($_REQUEST['act']=='edit'){
		$id = $_REQUEST['id'];
		$react = oneQuery('module','id',$id,'id');
		if(!isset($react)) header('location:?app=module');
		}
}

function option_sub_menu($parent_id,$sub = null, $pre = null, $page) {
	$db = new FQuery();  
	$db->connect(); 
	$sql = $db->select(FDBPrefix."menu","*","parent_id=$parent_id");
	while($qr=mysql_fetch_array($sql)){	
		$sel = multipleSelected($page,$qr['id']);
		echo "<option value='$qr[id]' $sel>$pre|_ $qr[name]</option>"; 
		option_sub_menu($qr['id'],$sub+1,$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$page);	
	}			
}	
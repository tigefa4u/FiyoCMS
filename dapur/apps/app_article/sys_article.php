<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
	
/****************************************/
/*		   Add category article			*/
/****************************************/
if(isset($_POST['save_cat']) or isset($_POST['save_new_category'])){	
	if(!empty($_POST['name'])) {
		$_POST['name'] = str_replace('"','',$_POST['name']);
		$_POST['name'] = str_replace("'",'',$_POST['name']);
		$qr=$db->insert(FDBPrefix.'article_category',array("","$_POST[name]","$_POST[parent_id]","$_POST[desc]","$_POST[keys]","$_POST[level]")); 
		
		if($qr AND isset($_POST['save_new_category'])){		
			alert('info',Category_Saved);
			alert('loading');
			htmlRedirect('?app=article&act=category',1);
		}
		else if($qr AND isset($_POST['save_cat'])){ 
			$sql2 = $db->select(FDBPrefix.'article_category','id','','id DESC' ); 
			$qrs = mysql_fetch_array($sql2);
			
			alert('info',Category_Saved);
			alert('loading');
			htmlRedirect("?app=article&act=edit_category&id=$qrs[id]",1);
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
/*		 Edit category article			*/
/****************************************/
if(isset($_POST['edit_category']) or isset($_POST['save_category']) ){
	if(!empty($_POST['name']) AND !empty($_POST['id'])){	
		$_POST['name'] = str_replace('"','',$_POST['name']);
		$_POST['name'] = str_replace("'",'',$_POST['name']);	    
		$qr=$db->update(FDBPrefix.'article_category',array("name"=>"$_POST[name]",
		'parent_id'=>"$_POST[parent_id]",
		'level'=>"$_POST[level]",
		'keywords'=>"$_POST[keys]",
		'description'=>"$_POST[desc]"),
		'id='.$_POST['id']); 		
		if($qr AND isset($_POST['save_category'])){				
			alert('info',Article_Category_Saved);
			alert('loading');
			htmlRedirect('?app=article&act=category',1);
		}
		else if($qr AND isset($_POST['edit_category']))
			alert('info',Article_Category_Saved);		
		else 			
			alert('error',Status_Invalid);						
	}
	else 				
		alert('error',Status_Invalid);
	
}		

/****************************************/
/*		  Delete Article Category 		*/
/****************************************/
if(isset($_POST['delete_category'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('article_category',$source,'article','','','',1);
	if($delete == 'noempty') 
		alert('error',Category_Not_Empty);
	else if(isset($delete))
		alert('info',Category_Deleted);
	else
		alert('error',Please_Select_Category);	
}
	
	
/****************************************/
/*			 Add New Article			*/
/****************************************/
if(isset($_POST['save_add']) or isset($_POST['add_new']) or isset($_POST['apply_add']) or isset($_POST['save_as'])){
	if( !empty($_POST['title']) AND 
		!empty($_POST['cat']) AND 
		!empty($_POST['editor'])) {
		$param=''; // first value from $param
		for($p=1;$p<=$_POST['totalparam'];$p++){
			$param = $param.$_POST["nameParam$p"]."=".$_POST['param'.$p].';\n';
		}		
		$parameter = $param;			
		if(empty($_POST['date'])) $_POST['date'] = date("Y-m-d H:i:s");
		$article = str_replace('"',"'","$_POST[editor]");
		$title 	= htmlentities($_POST['title']);
		$keys 	= htmlentities($_POST['keyword']);
		$desc 	= htmlentities($_POST['desc']);
		$tags 	= htmlentities($_POST['tags']);
		if(checkLocalhost()) {
			$article = str_replace(FLocal."media/","media/",$article);			
		}
		
		$qr=$db->insert(FDBPrefix.'article',array("","$title","$_POST[cat]","$article","$_POST[date]","$_POST[author]",$_SESSION['USER_ID'],"$desc", "$tags","$keys","$_POST[featured]","$_POST[status]","$_POST[level]","1","$parameter","",""));				
		
		if($qr AND isset($_POST['apply_add']) or isset($_POST['save_as'])){
			$sql = $db->select(FDBPrefix.'article','id','','id DESC' ); 
			$qrs = mysql_fetch_array($sql);					
			alert('info',Article_Saved);
			alert('loading');
			htmlRedirect('?app=article&act=edit&id='.$qrs['id'],1);
		}
		else if($qr AND isset($_POST['save_add'])) {
			alert('info',Article_Saved);
			alert('loading');
			htmlRedirect('?app=article&cat='.$_POST['cat'],1);
		}	
		else if($qr AND isset($_POST['add_new'])) {
			alert('info',Article_Saved);
			alert('loading');
			htmlRedirect('?app=article&act=add',1);
		}				
	}
	else if(empty($_POST['editor'])){	
		alert('error',Please_write_some_text);
	}
	else if(empty($_POST['title'])){	
		alert('error',Please_fill_article_title);
	}
	else{	
		alert('error',Status_Invalid);
	}
}

/****************************************/
/*		      Edit Article				*/
/****************************************/ 
if(isset($_POST['save_edit']) or isset($_POST['save_new']) or isset($_POST['apply_edit'])){		
	if( !empty($_POST['title']) AND 
		!empty($_POST['cat']) AND 
		!empty($_POST['editor'])) {	
		
		$param=''; // first value from $param
		for($p=1;$p<=$_POST['totalparam'];$p++)
		{
			$param = $param.$_POST["nameParam$p"]."=".$_POST['param'.$p].';\n';
		}		
		$parameter=$param;
		
		$db->select(FDBPrefix.'article');
		if(!empty($_POST['hits_reset'])) {
			$db->update(FDBPrefix.'article',array('hits'=>"0"),"id=$_POST[id]");
		}	
		
		$cat  = $_POST['cat'];
		$time = date("H:i:s");
		$desc = htmlentities($_POST['desc']);
		$tags = htmlentities($_POST['tags']);
		$keys = htmlentities($_POST['keyword']);
		$title = htmlentities($_POST['title']);
		$author = htmlentities($_POST['author']);		
		
		$article = str_replace('"',"'","$_POST[editor]");
		
		if(checkLocalhost()) {
			$article = str_replace(FLocal."media/","media/",$article);			
		}
		
		$qr=$db->update(FDBPrefix.'article',array(				
		"category"=>"$_POST[cat]",
		"title"=>"$title",
		"author"=>"$author",
		"date"=>"$_POST[date]",
		"status"=>"$_POST[status]",
		"featured"=>"$_POST[featured]",
		"level"=>"$_POST[level]",
		"tag"=>"$tags",
		"keyword"=>"$keys",
		"description"=>"$desc",
		"article"=>"$article",
		"editor"=> $_SESSION['USER_ID'],
		"parameter"=>"$parameter"),
		"id=$_POST[id]");
			
		if($qr AND isset($_POST['save_edit'])){		
			alert('info',Article_Saved);
			alert('loading');
			htmlRedirect("?app=article&cat=$_POST[cat]",1);		
		}
		else if($qr AND isset($_POST['save_new'])){		
			alert('info',Article_Saved);
			alert('loading');	
			htmlRedirect("?app=article&act=add",1);		
		}
		else if($qr AND isset($_POST['apply_edit'])){ 
			alert('info',Article_Saved);
			}
		else 
			alert('error',Status_Fail);					
	}
	else if(empty($_POST['editor'])){	
		alert('error',Please_write_some_text);
	}
	else if(empty($_POST['title'])){	
		alert('error',Please_fill_article_title);
	}
	else 	
		alert('error',Status_Invalid);
	
}


/****************************************/
/*		      Delete Article			*/
/****************************************/ 	
if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('article',$source);	
	if(isset($delete))
		alert('info',Article_Deleted);
	else
		alert('error',Article_Not_Select);
}

/****************************************/
/*	 Redirect when Article-Id invalid	*/
/****************************************/
if(!isset($_POST['save_edit']) AND !isset($_POST['apply_edit'])) {
	if(isset($_REQUEST['act']))
	if($_REQUEST['act']=='edit'){
	$id = $_REQUEST['id'];
	$react = oneQuery('article','id',$id,'id');
	if(!isset($react)) header('location:?app=article');
	}
}


/****************************************/
/*	 	   Sub Article Category			*/
/****************************************/ 
// membuat fungsi sub-article yang akan di tampilkan dibawah parent_id	
function sub_article($parent_id,$nos,$pre = null) {
	$db = new FQuery();  
	$db->connect(); 
	$sql = $db->select(FDBPrefix."article_category","*","parent_id=$parent_id");
	$no=1;
	while($qr=mysql_fetch_array($sql)) {					
		$db->select(FDBPrefix.'article','*',"category=$qr[id]"); 
		$sum= mysql_affected_rows();
			
		$sql2 = $db->select(FDBPrefix.'user_group');
		while($qrs=mysql_fetch_array($sql2)){
			if($qrs['level']==$qr['level'])
				$level = "$qrs[group_name]";
			else					
				$level = _Public;
		}			
				
		if($qr['level'] >= $_SESSION['USER_LEVEL'] ) {
			$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";	
			
			$name ="<a class='tooltip ctedit' title='Click to edit article \"$qr[name]\"' href='?app=article&act=edit_category&id=$qr[id]'>$qr[name]</a>";
			}
		else {
			$checkbox ="<span class='icon lock'></lock>";
			$name ="$qr[name]";
		}
			
		echo "<tr>";
		echo "<td>$nos.$no</td><td align='center'>$checkbox</td><td>$pre|_ $name</td><td align='center'>$level</td><td align='center'>$sum</td><td align='center'>$qr[id]</td>";
		echo "</tr>";
		sub_article($qr['id'],"$nos.$no",$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		$no++;	
	}			
}

/****************************************/
/*		Sub Option (Admin Panel)		*/
/****************************************/ 	
function option_sub_cat($parent_id,$pre) {
	$db = new FQuery();  
	$db ->connect(); 
	$sql=$db->select(FDBPrefix."article_category","*","parent_id=$parent_id AND id!=$_REQUEST[id]"); 
	while($qr = @mysql_fetch_array($sql)){
		//select article 'info'rmation
		if($qr['level'] >= $_SESSION['userLevel'] ){
			$sql2=$db->select(FDBPrefix.'article','*',"id=$_REQUEST[id]"); 
			$at=mysql_fetch_array($sql2);
			//select article category 'info'rmation		
			$sql3=$db->select(FDBPrefix.'article_category','*',"id=$_REQUEST[id]"); 
			$pd = mysql_fetch_array($sql3);
			if($pd['parent_id']==$qr['id'] or $at['category']==$qr['id'])$s ="selected";else $s="";
			echo "<option value='$qr[id]' $s>$pre|_ $qr[name]</option>";
			option_sub_cat($qr['id'],$pre."&nbsp;&nbsp;&nbsp;&nbsp;");
		}
	}		
}

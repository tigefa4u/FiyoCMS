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
/*			 Add Category Menu			*/
/****************************************/
if(isset($_POST['add_category']) or isset($_POST['save_category'])){		
	$db = new FQuery();  
	$db->connect();				
	if(!empty($_POST['title']) AND !empty($_POST['cat']) AND !empty($_POST['title'])) {
	$cat=strtolower(str_replace(" ","","$_POST[cat]"));	
	$qr=$db->insert(FDBPrefix.'menu_category',array("","$cat","$_POST[title]","$_POST[desc]")); 
		if(isset($_POST['add_category']) AND $qr){	
			$sql = $db->select(FDBPrefix.'menu_category','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);	
			alert('loading');
			alert('info',Category_Menu_Saved);
			htmlRedirect('?app=menu&act=edit_category&id='.$qr['id'],1);
		}		
		else if(isset($_POST['save_category']) AND $qr){
			alert('loading');
			alert('info',Category_Menu_Saved);
			htmlRedirect('?app=menu&act=category',1);
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
/*			Delete category menu		*/
/****************************************/
if(isset($_POST['delete_category'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('menu_category',$source,'menu','category');	
	
	if($delete == 'noempty') 
		alert('error',Category_Menu_Not_Empty);
	else if(isset($delete))
		alert('info',Category_Deleted);
	else
		alert('error',Please_Select_Category);
	
}
		
	
/****************************************/
/*			 Edit category menu			*/
/****************************************/
if(isset($_POST['edit_category']) or isset($_POST['apply_category'])){
	$db = new FQuery();  
	$db->connect();
	$cat=strtolower(str_replace(" ","","$_POST[cat]"));	
	if(!empty($_POST['title']) AND !empty($_POST['cat'])){
		$qr=$db->update(FDBPrefix.'menu_category',array("title"=>"$_POST[title]",
		'category'=>"$cat",
		'description'=>"$_POST[desc]"),
		'id='.$_POST['id']); 		
		//edit or update catgory name
		$sql =  $db->select(FDBPrefix.'menu'); 	  
		while(mysql_fetch_array($sql)){	
			$qrs=$db->update(FDBPrefix.'menu',array("category"=>"$cat"),"category='$_POST[cats]'");
		}					
		if(isset($_POST['edit_category']) AND $qr){
			alert('loading');
			alert('info',Category_Menu_Saved);
			htmlRedirect('?app=menu&act=category',1);
		}			
		else if(isset($_POST['apply_category']) AND $qr){
			alert('info',Category_Menu_Saved);
		}
		else {
			alert('error',Status_Fail);
		}
	}
	else {
		alert('error',Status_Invalid);
	}
}

	
/****************************************/
/*			 Add New Menu				*/
/****************************************/
if(isset($_POST['save_add']) or isset($_POST['apply_add'])){	
	$db = new FQuery();  
	$db->connect(); 	
	if( !empty($_POST['name']) AND 
		!empty($_POST['cat']) AND 
		!empty($_POST['apps'])AND 
		!empty($_POST['link'])) {
		
		$param=''; // first value from $param
		if(isset($_POST['totalParam']))
			for($p=1;$p<=$_POST['totalParam'];$p++)
			{
				if($p!=$_POST['totalParam'])
				{
					@$param=$param.$_POST["nameParam$p"]."=".$_POST['param'.$p].';\n';
				}
				else
				{
					@$param=$param.$_POST['param'.$p];			
				}
			}
		@$param = str_replace('"',"'","$_POST[editor]");
		@$parameter .= $param;		
		$qr=$db->insert(FDBPrefix.'menu',array("","$_POST[cat]","$_POST[name]","$_POST[link]","$_POST[apps]","$_POST[parent_id]","$_POST[status]","$_POST[short]", "$_POST[level]","0", "$_POST[title]","$_POST[show_title]","$_POST[sub_name]","$_POST[class]","$_POST[style]","$parameter",""));
		if($qr AND isset($_POST['apply_add'])){
			$sql = $db->select(FDBPrefix.'menu','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);
			alert('loading');
			alert('info',Menu_Saved);
			htmlRedirect('?app=menu&act=edit&id='.$qr['id'],1);
		}
		elseif($qr AND isset($_POST['save_add'])) {	
			alert('loading');
			alert('info',Menu_Saved);
			htmlRedirect('?app=menu',1);
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
/*		       Edit Menu				*/
/****************************************/ 		
if(isset($_POST['save_edit']) or isset($_POST['apply_edit'])){		
	if( !empty($_POST['name']) AND 
		!empty($_POST['cat']) AND 
		!empty($_POST['link'])) {
		$param=''; // first value from $param
		if(isset($_POST['totalParam']))
			for($p=1;$p<=$_POST['totalParam'];$p++)
			{
				@$param=$param.$_POST["nameParam$p"]."=".$_POST['param'.$p].';\n';
			}
		@$parameter = $param;		
		$db = new FQuery();  
		$db->connect();
		$db->select(FDBPrefix.'menu');
		$cat=$_POST['cat'];
		$qr=$db->update(FDBPrefix.'menu',array(				
		"category"=>"$_POST[cat]",
		"name"=>"$_POST[name]",
		"link"=>"$_POST[link]",
		"app"=>"$_POST[apps]",
		"parent_id"=>"$_POST[parent_id]",
		"status"=>"$_POST[status]",
		"show_title"=>"$_POST[show_title]",
		"level"=>"$_POST[level]",
		"title"=>"$_POST[title]",
		"sub_name"=>"$_POST[sub_name]",
		"class"=>"$_POST[class]",
		"style"=>"$_POST[style]",
		"short"=>"$_POST[short]",
		"parameter"=>"$parameter"),
		"id=$_POST[id]");
		if($qr AND isset($_POST['save_edit'])){	
			alert('loading');
			alert('info',Menu_Updated);
			htmlRedirect("?app=menu&cat=$_POST[cat]",1);
		}
		else if($qr AND isset($_POST['apply_edit'])){ 
			alert('info',Menu_Updated);
		}
		else {alert('error',Status_Invalid);}					
	}
	else {alert('error',Status_Invalid);}
}


/****************************************/
/*		      Delete Menu				*/
/****************************************/ 	
if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('menu',$source,'','','','',1);
	
	if(isset($delete))
		if($delete == 'noempty')		
			alert('error',Menu_Contain_Submenu);
		else
			alert('info',Menu_Deleted);
	else
		alert('error',Please_Select_Menu);
}


/****************************************/
/*	 Redirect when menu-Id not found	*/
/****************************************/
if(!isset($_POST['save_edit']) AND !isset($_POST['apply_edit'])) {
	if(isset($_REQUEST['act']))
		if($_REQUEST['act']=='edit'){
		$id = $_REQUEST['id'];
		$react = oneQuery('menu','id',$id,'id');
		if(!isset($react)) header('location:?app=menu');
		}
}

/****************************************/
/*				 Sub Menu 				*/
/****************************************/ 			
function sub_menu($parent_id,$pre,$nos) {
	$db = new FQuery();  
	$db->connect(); 
	$sql =  $db->select(FDBPrefix."menu","*","parent_id=$parent_id","short ASC"); 
	$no=1;
	while($qr=mysql_fetch_array($sql)){
		/* logika status aktif atau tidak */
		if($qr['status']==1)
			{ $stat1 ="selected"; $stat2 ="";}							
		else
			{ $stat2 ="selected";$stat1 ="";}				
		$status ="
		<p class='switch'>
			<label class='cb-enable $stat1'><span>On</span></label>
			<label class='cb-disable $stat2'><span>Off</span></label>
			<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
		</p>";												
							
		$name = "<a class='tooltip ctedit' title='Click to edit menu \"$qr[name]\"' href='?app=menu&act=edit&id=$qr[id]'>$pre|_ $qr[name]</a>";
							
		$checkbox = "<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
							
		/* auto change default page */
		if(siteConfig('menu_default')==1)
		{ $dm = "ivisible"; $dms = "invisible"; }							
		else
		{ $dm = "invisible"; $dms = "";  }				
		$default ="
		<p class='switch'>
			<span class='icon tooltip star $dms' title='".Set_as_home_page."'></span>
	
			<span class='icon tooltip default $dm' title='".As_home_page."'></span>
			<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
		</p>";	
				
		echo "<tr>";
		echo "<td>$nos.$no</td><td align='center'>$checkbox</td><td>$name</td><td align=center></td><td  align='center'>$default</td><td  align='center'>$status</td><td>$qr[category] </td><td  align='center'>$qr[short]</td><td>$qr[app]</td><td  align='center'>$qr[id]</td>";
		echo "</tr>";
		sub_menu($qr['id'],$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","$nos.$no");
		$no++;	
	}
}
	
/****************************************/
/*		      Option Sub Menu 			*/
/****************************************/ 	
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

	
function option_sub_cat($parent_id,$pre) {
	$db = new FQuery();  
	$db ->connect(); 
	$sql=$db->select(FDBPrefix."article_category","*","parent_id=$parent_id AND id!=$_REQUEST[id]"); 
	while($qr=mysql_fetch_array($sql)){
		//select article 'info'rmation
		$sql2=$db->select(FDBPrefix.'article','*',"id=$_REQUEST[id]"); 
		$at=mysql_fetch_array($sql2);
		//select article category 'info'rmation		
		$sql3=$db->select(FDBPrefix.'article_category','*',"id=$_REQUEST[id]"); 
		$pd = mysql_fetch_array($sql3);
		if($pd['parent_id']==$qr['id'] or $at['category']==$qr['id'])$s ="selected";else $s="";
		echo "<option value='$qr[id]' $s>$pre |_ $qr[name]</option>";
		option_sub_cat($qr['id'],$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	}		
}

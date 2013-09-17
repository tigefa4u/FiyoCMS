<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect();

/****************************************/
/*			 Add Group User				*/
/****************************************/
if(isset($_POST['add_group']) or isset($_POST['apply_group'])){
	$db = new FQuery();  
	$db->connect();			
	if(!empty($_POST['group']) AND !empty($_POST['level'])) {
		$qr=$db->insert(FDBPrefix.'user_group',array("","$_POST[group]","$_POST[level]","$_POST[desc]","","")); 
		if($qr AND isset($_POST['add_group'])){
			alert('loading');	
			alert('info',User_Group_Added);
			htmlRedirect('?app=user&act=group',2);
		}
		else if($qr AND isset($_POST['apply_group'])){
			$sql = $db->select(FDBPrefix.'user_group','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);	
			alert('loading');	
			alert('info',User_Group_Added);
			htmlRedirect('?app=user&act=edit_group&id='.$qr['id'],2);
		}
		else {				
			alert('error',User_Group_Exists);
		}					
	}
	else 
	{				
		alert('error',Status_Invalid);
	}
}
	

/****************************************/
/*			Delete Group User			*/
/****************************************/
if(isset($_POST['delete_group'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('user_group',$source,'user','level');	
	
	if($delete == 'noempty') 
		alert('error',User_Group_Not_Empty);
	else if(isset($delete))
		alert('info',Category_Deleted);
	else
		alert('error',Please_Select_Category);
	
}

	
/****************************************/
/*			 Edit Group User			*/
/****************************************/
if(isset($_POST['edit_group']) or isset($_POST['save_group'])){
	$db = new FQuery();  
	$db->connect();			
	if(!empty($_POST['level']) AND !empty($_POST['group'])) {	
		$qr=$db->update(FDBPrefix."user_group",array(
		"level"=>"$_POST[level]",
		"group_name"=>"$_POST[group]",
		"description"=>"$_POST[desc]"),
		"id=$_POST[id]"); 		
		$qr=$db->update(FDBPrefix."user",array(
		"level"=>"$_POST[level]"),
		"level=$_POST[levels]"); 
		if($qr AND isset($_POST['save_group'])){
			alert('info',User_Group_Saved);
		}
		else if($qr AND isset($_POST['edit_group'])){
			alert('info',User_Group_Saved);
			alert('loading');	
			htmlRedirect('?app=user&act=group',2);
		}
		else {				
			alert('error',Status_Fail);	
		}					
	}		
	else 
	{				
		alert('error',Status_Invalid);	
	}			
}

	
	
/****************************************/
/*				Add User				*/
/****************************************/
if(isset($_POST['save']) or isset($_POST['applysave'])){
	$us=strlen("$_POST[user]");
	$ps=strlen("$_POST[password]");
	if(!empty($_POST['password']) AND 
		!empty($_POST['user'])AND 
		!empty($_POST['name'])AND 
		!empty($_POST['email'])AND 
		!empty($_POST['level'])AND 
		$_POST['password']==$_POST['kpassword'] AND 
		$us>2 AND $ps>3 AND @ereg("^.+@.+\\..+$",$_POST['email'])) {
		
		$qr=$db->insert(FDBPrefix.'user',array("","$_POST[user]","$_POST[name]",MD5("$_POST[password]"),"$_POST[email]","$_POST[status]","$_POST[level]",date('Y-m-d H:i:s'),"$_POST[bio]")); 
		if($qr AND isset($_POST['savea'])){		
			alert('loading');	
			alert('info',User_Added);
			htmlRedirect('?app=user',2);
		}
		else if($qr AND isset($_POST['applysave'])){
			$sql = $db->select(FDBPrefix.'user','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);	
			alert('loading');	
			alert('info',User_Added);
			htmlRedirect('?app=user&act=edit&id='.$qr['id'],2);
		}
		else {				
			alert('error',Status_Fail);
		}					
	}
	else  {							
		alert('error',Status_Invalid);
	}
}
	
	
/****************************************/
/*				User Edit				*/
/****************************************/
if(isset($_POST['edit']) or isset($_POST['applyedit'])){
		$us=strlen("$_POST[user]");
		$ps=strlen("$_POST[password]");			
		if(!empty($_POST['user'])AND !empty($_POST['name'])AND !empty($_POST['email'])AND !empty($_POST['level']) AND $us>2 AND @ereg("^.+@.+\\..+$",$_POST['email'])) 
		{
			if($_POST['id'] == $_SESSION['userId']) $_POST['status'] = 1;
			if(empty($_POST['password'])){
				$qrq=$db->update(FDBPrefix.'user',array(				
				"user"=>"$_POST[user]",
				"name"=>"$_POST[name]",
				"email"=>"$_POST[email]",
				"status"=>"$_POST[status]",
				"about"=>"$_POST[bio]",
				"level"=>"$_POST[level]"),
				"id=$_POST[id]"); }
			elseif($_POST['password']==$_POST['kpassword']){
				$qrq=$db->update(FDBPrefix.'user',array(				
				"user"=>"$_POST[user]",
				"name"=>"$_POST[name]",
				"password"=>MD5("$_POST[password]"),
				"email"=>"$_POST[email]",
				"about"=>"$_POST[bio]",
				"status"=>"$_POST[status]",
				"level"=>"$_POST[level]"),
				"id=$_POST[id]"); 
				}
				
			$qr=$qrq;
			if($qr AND isset($_POST['edit'])){					
				alert('loading');	
				alert('info',User_Saved);
				htmlRedirect('?app=user',2);
			}
			else if($qr AND isset($_POST['applyedit'])){
				alert('info',User_Saved);				
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
/*				User Delete				*/
/****************************************/
if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('user',$source);	
	if(isset($delete))
		alert('info',User_Deleted);
	else
		alert('error',Please_Select_User);
}


/****************************************/
/*	 Redirect when User-Id not found	*/
/****************************************/
if(!isset($_POST['save_edit']) AND !isset($_POST['apply_edit'])) {
	if(isset($_REQUEST['act']))
	if($_REQUEST['act']=='edit'){
		$id=$_REQUEST['id'];
		$db = new FQuery();  
		$db->connect(); 
		$sql=$db->select(FDBPrefix.'user','*','id='.$id); 
		$jml=mysql_num_rows($sql);
		if($jml<=0) {
			alert('info','UserID is null, wait for redirecting ...');
			alert('loading');
			htmlRedirect('?app=user',3);
		}
	}
}


/****************************************/
/*		   User Configurtation			*/
/****************************************/
if(isset($_POST['config'])){
	$qr=$db->update(FDBPrefix."setting",array('value'=>"$_POST[new_member]"),"name='new_member'");	
	if(isset($qr))
		alert('info',Status_Applied);
}
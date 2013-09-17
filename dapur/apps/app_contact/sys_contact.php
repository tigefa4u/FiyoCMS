<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.php
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect();

/****************************************/
/*			 Add group contact			*/
/****************************************/
if(isset($_POST['add_group']) or isset($_POST['D'])){
	if(!empty($_POST['name']) AND !empty($_POST['desc'])) {
	$qr=$db->insert(FDBPrefix.'contact_group',array("","$_POST[name]","$_POST[desc]")); 
		if($qr AND isset($_POST['save_add_group'])){		
			alert('loading');
			alert('info',Group_Saved);
			htmlRedirect('?app=contact&act=group',2);
		}
		else if($qr AND isset($_POST['add_group'])){
			$sql = $db->select(FDBPrefix.'contact_group','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);
			alert('loading');
			alert('info',Group_Saved);
			htmlRedirect('?app=contact&act=edit_group&id='.$qr['id'],2);
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
/*			Delete group contact		*/
/****************************************/
if(isset($_POST['delete_group'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('contact_group',$source,'contact','id');		
	if($delete == 'noempty') 
		alert('error',Group_contact_Not_Empty);
	else if(isset($delete))
		alert('info',Group_Deleted);
	else
		alert('error',Please_Select_Group);
	
}
		
	
/****************************************/
/*			 Edit group contact			*/
/****************************************/
if(isset($_POST['edit_group']) or isset($_POST['save_edit_group'])){
	if(!empty($_POST['name']) AND !empty($_POST['desc'])){
		$qr=$db->update(FDBPrefix.'contact_group',array("name"=>"$_POST[name]",
		'description'=>"$_POST[desc]"),
		'id='.$_POST['id']); 		
		//edit or update catgory name
		$sql =  $db->select(FDBPrefix.'contact'); 	  
		while(mysql_fetch_array($sql)){	
			$qrs=$db->update(FDBPrefix.'contact',array("group_id"=>$_POST['id']),'id='.$_POST['id']);
		}					
		if($qr AND isset($_POST['save_edit_group'])){
			alert('loading');
			alert('info',Group_Saved);
			htmlRedirect('?app=contact&act=group',2);
		}		
		else if($qr AND isset($_POST['edit_group'])){
			alert('info',Group_Saved);
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
/*			 Add New contact				*/
/****************************************/
if(isset($_POST['save_add']) or isset($_POST['apply_add'])){	
	$db = new FQuery();  
	$db->connect(); 	
	if( !empty($_POST['name']) AND 
		!empty($_POST['gender']) AND 
		!empty($_POST['group'])) {			
		$qr=$db->insert(FDBPrefix.'contact',array("","$_POST[name]","$_POST[gender]","$_POST[email]","$_POST[address]","$_POST[city]","$_POST[state]","$_POST[country]","$_POST[zip]", "$_POST[phone]", "$_POST[fax]", "$_POST[job]","$_POST[photo]","$_POST[web]","$_POST[ym]","$_POST[fb]","$_POST[tw]","$_POST[desc]","$_POST[group]",1));
		if($qr AND isset($_POST['apply_add'])){
			$sql = $db->select(FDBPrefix.'contact','id','','id DESC' ); 	  
			$qr = mysql_fetch_array($sql);
			alert('loading');
			alert('info',Contact_Saved);
			htmlRedirect('?app=contact&act=edit&id='.$qr['id'],2);
		}
		elseif($qr AND isset($_POST['save_add'])) {	
			alert('loading');
			alert('info',Contact_Saved);
			htmlRedirect('?app=contact',2);
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
/*		       Edit contact				*/
/****************************************/ 		
if(isset($_POST['save_edit']) or isset($_POST['apply_edit'])){	
	if( !empty($_POST['name']) AND !empty($_POST['gender']) AND !empty($_POST['group'])) {	
		$qr=$db->update(FDBPrefix.'contact',array(	
		"name"=>"$_POST[name]",			
		"gender"=>"$_POST[gender]",
		"group_id"=>"$_POST[group]",
		"email"=>"$_POST[email]",
		"address"=>"$_POST[address]",
		"city"=>"$_POST[city]",
		"state"=>"$_POST[state]",
		"country"=>"$_POST[country]",
		"zip"=>"$_POST[zip]",
		"phone"=>"$_POST[phone]",
		"fax"=>"$_POST[fax]",
		"job"=>"$_POST[job]",
		"photo"=>"$_POST[photo]",
		"web"=>"$_POST[web]",
		"ym"=>"$_POST[ym]",
		"fb"=>"$_POST[fb]",
		"tw"=>"$_POST[tw]",
		"description"=>"$_POST[desc]"),
		"id=$_POST[id]");
		if($qr AND isset($_POST['save_edit'])){	
			alert('loading');
			alert('info',Contact_Saved);
			htmlRedirect('?app=contact',2);
		}
		else if($qr AND isset($_POST['apply_edit'])){ 
			alert('info',Contact_Saved);
		}
		else {alert('error',Status_Fail);}					
	}
	else {alert('error',Status_Invalid);}
}


/****************************************/
/*		      Delete contact				*/
/****************************************/ 	
if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('contact',$source);	
	if(isset($delete))
		alert('info',Contact_Deleted);
	else
		alert('error',Please_Select_contact);
}

		
/****************************************/
/*		      Make Home Page					*/
/****************************************/ 	
if(isset($_REQUEST['act']) AND $_REQUEST['act']=='home'){
	$qr = $db->update(FDBPrefix.'contact',array("home"=>"0"),'id!='.$_REQUEST['id']);
	$qr = $db->update(FDBPrefix.'contact',array("home"=>"1"),'id='.$_REQUEST['id']);
	if($qr) alert('info',Status_Applied);
}
	

/****************************************/
/*	    Enable and Disbale contact			*/
/****************************************/
if(isset($_REQUEST['act'])) {
	if(!isset($_POST['delete']) AND $_REQUEST['act']=='enable'){
		$db->update(FDBPrefix.'contact',array("status"=>"1"),'id='.$_REQUEST['id']);
		alert('info',Status_Applied);
	}

	if(!isset($_POST['delete']) AND $_REQUEST['act']=='disable'){
		$db->update(FDBPrefix.'contact',array("status"=>"0"),'id='.$_REQUEST['id']);
		alert('info',Status_Applied);
	}
}

/****************************************/
/*	 Redirect when contact-Id not found	*/
/****************************************/
if(!isset($_POST['save_edit']) AND !isset($_POST['apply_edit'])) {
	if(isset($_REQUEST['act']))
		if($_REQUEST['act']=='edit'){
		$id = $_REQUEST['id'];
		$react = oneQuery('contact','id',$id,'id');
		if(!isset($react)) header('location:?app=contact');
		}
}

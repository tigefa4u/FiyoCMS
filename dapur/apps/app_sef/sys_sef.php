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
$db->connect();

/****************************************/
/*			   Add permalink			*/
/****************************************/
if(isset($_POST['save_new'])){
	if(!empty($_POST['sef']) AND !empty($_POST['link']) AND @ereg("^\?",$_POST['link'])) {
		$qr=$db->insert(FDBPrefix.'permalink',array("","$_POST[link]","$_POST[sef]","$_POST[page]","$_POST[status]","$_POST[lock]")); 
		if($qr){
			alert('loading');	
			alert('info',Status_Saved);
			htmlRedirect('?app=sef',2);
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
/*			  Permalink Edit			*/
/****************************************/
if(isset($_POST['save']) or isset($_POST['apply'])){
	if(!empty($_POST['sef']) AND !empty($_POST['link']) 
	AND preg_match("/^\?/",$_POST['link'])) {
		$qr=$db->update(FDBPrefix.'permalink',array(				
		"permalink"=>"$_POST[sef]",
		"link"=>"$_POST[link]",
		"locker"=>"$_POST[lock]",
		"status"=>"$_POST[status]",
		"pid"=>"$_POST[page]"),
		"id=$_POST[id]"); 				
	
		if($qr AND isset($_POST['save'])){
			alert('loading');	
			alert('info',Status_Applied);
			htmlRedirect('?app=sef',2);
		}
		else if($qr AND isset($_POST['apply'])){
			alert('info',Status_Applied);				
		}
		else {
			alert('error',Status_Exist);
		}					
	}
	else 
	{				
		alert('error',Status_Invalid);
	}
}


/****************************************/
/*		    Permalink Delete			*/
/****************************************/

if(isset($_POST['delete'])){
	$source = @$_POST['check'];
	$source = multipleSelect($source);
	$delete = multipleDelete('permalink',$source,'permalink','id','locker = 1');	
	
	if($delete == 'noempty') 
		alert('error',Status_Cant_Delete);
	else if(isset($delete))
		alert('info',Status_Deleted);
	else
		alert('error',Status_Please_Select);
	
}
	


/****************************************/
/*	    Enable and Disbale permalink	*/
/****************************************/
if(isset($_REQUEST['act'])) {
	if($_REQUEST['act']=='enable' AND !isset($_POST['delete'])){
		$db->update(FDBPrefix.'permalink',array('status'=>'1'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}

	if($_REQUEST['act']=='disable' AND !isset($_POST['delete'])){
		$db->update(FDBPrefix.'permalink',array('status'=>'0'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}
}

/****************************************/
/*	    Lock and Unlock permalink		*/
/****************************************/
if(isset($_REQUEST['act'])) {
	if($_REQUEST['act']=='lock' AND !isset($_POST['delete'])){
		$db->update(FDBPrefix.'permalink',array('locker'=>'1'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}

	if($_REQUEST['act']=='unlock' AND !isset($_POST['delete'])){
		$db->update(FDBPrefix.'permalink',array('locker'=>'0'),'id='.$_REQUEST['id']); 
		alert('info',Status_Applied);
	}
}
/****************************************/
/*	Redirect when permalink-Id notfound */
/****************************************/
if(!isset($_POST['save']) AND !isset($_POST['apply'])) {
	if(isset($_REQUEST['act']))
	if($_REQUEST['act']=='edit'){
		$db->connect(); 
		$sql=$db->select(FDBPrefix.'permalink','*','id='.$_REQUEST['id']); 
		$jml=mysql_num_rows($sql);
		if($jml<=0) header('location:?app=sef');
	}	
}

define('SEF_helper',"<h3>Bantuan untuk <i>Media Manager</i></h3><ul><li>Halaman <b>Media Manager</b> berguna untuk mengelola segala bentuk gambar atau animasi berupa swf pada situs anda yang disimpan di server anda.</li><li>Folder media terletak di folder <b>files/</b> pada situs anda. Jadi jika anda membuka <b>Images Media</b>, folder yang dibuka adalah <b>files/images/</b>.<br>Sehingga jika ingin memanggil gambar menggunakan alamat <b>files/images/nama_gambar.jpg</b></li></ul>");

define('SEF_link_tip',"SEF Link");
define('Original_link_tip',"Link asli atau link sumber");
define('LockSEF_tip',"Kunci/amankan SEF");
define('EnableSEF_tip',"Aktifkan SEF");
define('PageIDSEF_tip',"ID dari menu ID");


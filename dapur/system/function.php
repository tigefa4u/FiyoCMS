<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

/****************************************/
/*			 Loader Function 			*/
/****************************************/
//memuat admin apps
function baseApps($file){
	require ("apps/$file/$file.php");	
}

//memuat admin system apps
function baseSystem($file){
	$file = "apps/app_$file/sys_$file.php";	
	if(file_exists($file)) include($file);	
}

//memuat fungsi admin apps
function loadSystemApps(){
	include('system/apps.php');		
	sysAdminApps();
}

/****************************************/
/*			 Check User Login			*/
/****************************************/
//cek status user dalam keadaan login melalui tabel session_login
function check_backend_login() {
	if(!empty($_SESSION['USER_ID']) AND !empty($_SESSION['USER_ID']) <= 3){
			include "index3.php";
	}
	else {
		$_SESSION['USER']		= null ;
		$_SESSION['USER_ID']	= null ;		
		$_SESSION['USER_LOG']	= null ;
		$_SESSION['USER_NAME']	= null ;
		$_SESSION['USER_EMAIL'] = null ;
		$_SESSION['USER_LEVEL'] = null ;
		include "index2.php";
	}
}

//memanggil template sesuai fungsi select_themes()
function load_themes(){	
	if(isset($_POST['fiyo_logout'])){
		$db = new FQuery();  
		$db->connect();		
		$qr = $db->delete(FDBPrefix."session_login","user_id=".$_SESSION['USER_ID']);
		$_SESSION['USER']		= null ;
		$_SESSION['USER_ID']	= null ;		
		$_SESSION['USER_LOG']	= null ;
		$_SESSION['USER_NAME']	= null ;
		$_SESSION['USER_EMAIL'] = null ;
		$_SESSION['USER_LEVEL'] = null ;
		include "index2.php";
	}	
	else {		
		select_themes('index');	
	}
}

//memanggil file login jika user belum login
function load_login() {
	if(isset($_POST['fiyo_login']))	{
		$db = new FQuery();  
		$db->connect();		
		$sql = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND password='".MD5($_POST['pass'])."'");
		$qr = mysql_fetch_array($sql);
		$jml = mysql_affected_rows();
		if($jml > 0) {
			$sqlog = $db->select(FDBPrefix."session_login","*","session_id='$_POST[user]'");
			$qrlog = mysql_fetch_array($sqlog);	
			$_SESSION['USER_ID']  	= $qr['id'];
			$_SESSION['USER'] 		= $qr['user'];
			$_SESSION['USER_NAME']	= $qr['name'];
			$_SESSION['USER_EMAIL']	= $qr['email'];
			$_SESSION['USER_LEVEL'] = $qr['level'];
			$_SESSION['USER_LOG'] 	= $qrlog['time'];
			
			$db->delete(FDBPrefix."session_login","user_id=$qr[id]");			
			$qr = $db->insert(FDBPrefix."session_login",array("$qr[id]","$qr[user]","$qr[level]",date('Y-m-d H:i:s')));
		}		
		if($qr or !empty($_SESSION['USER']) AND !empty($_SESSION['USER_ID'])) 
			include "index3.php";
		else {
			select_themes('login');
			alert('error',Login_Error);	
		}		
	}
	else {
		select_themes('login');
	}
}
//memilih tema AdminPanel sesuai dengan nilai admin_theme pada tabel setting
function select_themes($log, $stat = NULL){
	$themePath = oneQuery("setting","name","'admin_theme'",'value');
	define("AdminPath","themes/$themePath");	
	$level = userInfo('level');	
	if($log=="login") {
		forgot_password();
		$file =  "themes/$themePath/login.php";
		if(file_exists($file))
			require $file;
		else
			echo "Failed to load AdminTheme";
	}
	else if($log=="index" AND $level <= 3) {	
		$file =   "themes/$themePath/index.php";
		if(file_exists($file))
			require $file;
		else
			echo "Failed to load AdminTheme";
	}
	else {
		redirect(FUrl);
	}		
}

//fungsi lupa password
function forgot_password(){
	if(isset($_POST['forgot_password'])) {
		$db = new FQuery();  
		$db->connect();
		$sql = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND email='$_POST[mail]'");
		$qr= mysql_affected_rows();
		if($qr<1){				
			alert('error',Remember_Error);
		}
		else {
			$password = FQuery('user',"status=1 AND user='$_POST[user]' AND email='$_POST[mail]'","password");
			
			$to  = "$_POST[mail]" ;
			$subject = 'Request Password';
			$message = "<html>
		<head>
			 <title>You are request your curent password</title>
		</head>
		
		<body>
			<p>You have reqeusted system to send your curent password.</p>
			<p>The following data and user password you requested.</p>
			<p>=============================</p>
			<p>Username  = $_POST[user]</p>
			<p>Password  = $password</p>
			<p>=============================</p>
			<p>Please save your passwords well.</p>
		</body>
		
		</html>";

	// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
		$headers .= "To: $qr[name] <$_POST[mail]>" . "\r\n";
		$headers .= 'From: Fiyo Password Reminder <'.siteConfig('site_mail').'>' . "\r\n";
		$headers .= 'cc :' . "\r\n";
		$headers .= 'Bcc :' . "\r\n";

	// Mail it
		$mail = @mail($to,$subject,$message,$headers);
		if($mail) 
			alert('info',Password_sent_to_mail);
		else
			alert('error',Failed_send_mail);
		}
	}
}
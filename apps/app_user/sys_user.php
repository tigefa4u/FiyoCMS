<?php
/**
* @name			User
* @version		1.5.0
* @package		Fiyo CMS 
* @copyright	Copyright (C) 2011 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect(); 
loadLang(__dir__);

$view = app_param('view');

if($view == 'register' or $view == 'login' or $view == 'forgot') {

	if(!empty($_SESSION['USER_ID']))
		redirect(make_permalink('?app=user'));
	else if(!siteConfig('new_member') AND $view == 'register')
		redirect(make_permalink('?app=user&view=login'));
}
else if($view == 'profile' or $view == 'logout' or $view == 'edit' or empty($view)) {
	if(empty($_SESSION['USER_ID'])) redirect(make_permalink('?app=user&view=login'));
}

if(isset($_POST['register'])) {		
	$us=strlen("$_POST[user]");
	$ps=strlen("$_POST[password]");
	if(	!empty($_POST['password']) AND 
		!empty($_POST['USER'])AND 
		!empty($_POST['capthca'])AND 
		!empty($_POST['email'])AND 
		$_POST['password']==$_POST['kpassword'] AND 
		$us>2 AND $ps>3) {
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$this -> notice =  "<div class='notice-error'>Please check your email!</div>";
		}
		else if($_POST['capthca'] == $_SESSION['captcha']) {
			$group =$db->select(FDBPrefix.'user_group','id','','id DESC LIMIT 1');	
			$group = mysql_fetch_array($group);
			$gid = $group['id'];	
			$qr=$db->insert(FDBPrefix.'USER',array("","$_POST[user]","$_POST[user]",MD5("$_POST[password]"),"$_POST[email]","1","$gid",date('Y-m-d H:i:s'),""));
			if($qr) {
				$siteMail = siteConfig('site_mail');
				$siteName = siteConfig('site_name');
				$subject = "Email From $siteName";
				$message = "Hello $_POST[user],<br> 
					Thank you, you have to register and join us on $siteName.<br>
					Here are details of your account :<br><br>
					Username : $_POST[user]<br>
					Password : $_POST[password]<br>
					Take good care of your accounts from any forms of crime.<br><br><br>
					<span style='font-size:80%'>This email is processed using Fiyo CMS for $siteName.</span>";		
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "To: $_POST[user] <$_POST[email]>"."\r\n";
				$headers .= "From: ".SiteName." <$siteMail>" . "\r\n";
				$mail = @mail($to,$subject,$message,$headers);	
						
				$db->insert(FDBPrefix."session_login",array("$qr[id]","$qr[user]","$qr[level]",date('Y-m-d H:i:s')));
				
				$sql = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND password='".MD5($_POST['password'])."'");
				$qr = mysql_fetch_array($sql);
				$_SESSION['USER_ID']  	= $qr['id'];
				$_SESSION['USER'] 		= $qr['USER'];
				$_SESSION['USER_NAME']  = $qr['name'];
				$_SESSION['USER_EMAIL']	= $qr['email'];	
				$_SESSION['USER_LEVEL']	= $qr['level'];	
				$_SESSION['USER_LOG'] 	= date('Y-m-d H:i:s');
				redirect(make_permalink('?app=user'));
			}
			else 
				define("userNotice","<div class='notice-error'>Username atau email sudah terdaftar!</div>");
		} else 
			define("userNotice","<div class='notice-error'>Security code is incorrect!</div>");
	}
	else  {						
		define("userNotice","<div class='notice-error'>Register failed, please fill the fields corectly!</div>");
	}
}
		
if(isset($_POST['login'])) {	
	$qr = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND password='".MD5($_POST['pass'])."'"); 
	$qr = mysql_fetch_array($qr);
	$jml = mysql_affected_rows();
	if($jml > 0) {		
		$_SESSION['USER_ID']  	= $qr['id'];
		$_SESSION['USER'] 		= $qr['USER'];
		$_SESSION['USER_NAME']  = $qr['name'];
		$_SESSION['USER_EMAIL']	= $qr['email'];	
		$_SESSION['USER_LEVEL'] = $qr['level'];
		$_SESSION['USER_LOG'] 	= date('Y-m-d H:i:s');
		$db->select(FDBPrefix."session_login","*","user_id=$qr[id]");
		if($qr['id'] > 0) {
			$db->delete(FDBPrefix."session_login","id=$qr[id]");
			$qrs=$db->insert(FDBPrefix."session_login",array("$qr[id]","$qr[user]","$qr[level]",date('Y-m-d H:i:s')));  
		}	
		redirect($_POST['prevpage']);
	}
	else {
		define("userNotice","<div class='notice-error'><b>Username</b> or <b>password</b> is invalid!</div>");
	}
}
	
/****************************************/
/*				User Edit				*/
/****************************************/
if(isset($_POST['edit'])){
	$us=strlen("$_POST[user]");
	$ps=strlen("$_POST[password]");			
	if(!empty($_POST['email']) AND @ereg("^.+@.+\\..+$",$_POST['email'])) 
	{
		if(empty($_POST['password']) AND empty($_POST['kpassword'])){
			$qrq=$db->update(FDBPrefix.'USER',array(	
			"name"=>"$_POST[name]",
			"email"=>"$_POST[email]",
			"about"=>"$_POST[bio]"),
			"id=$_SESSION[userId]"); 
		}
		elseif($_POST['password']==$_POST['kpassword']){
			$qrq=$db->update(FDBPrefix.'USER',array(
			"name"=>"$_POST[name]",
			"password"=>MD5("$_POST[password]"),
			"email"=>"$_POST[email]",
			"about"=>"$_POST[bio]"),
			"id=$_SESSION[userId]"); 
			}
			
		$qr=$qrq;
		if($qr AND isset($_POST['edit'])){	
			$_SESSION['USER_EMAIL'] = $_POST['email'];
			$_SESSION['USER_NAME'] = $_POST['name'];
			define("userNotice","<div class='notice-info'>".Status_Updated."</div>");
		}
		else if($_POST['password']!=$_POST['kpassword']) {			
			define("userNotice","<div class='notice-error'>".user_Password_Not_Match."</div>");
		}
		else {				
			define("userNotice","<div class='notice-error'>".Status_Invalid."</div>");
		}					
	}
	else {				
		define("userNotice","<div class='notice-error'>".Status_Invalid."</div>");
	}
}
	
		
if(isset($_POST['logout'])) {	
	$db = new FQuery();  
	$db->connect(); 
	$_SESSION['USER_ID']	= "";
	$_SESSION['USER']		= "";
	$_SESSION['USER_EMAIL']	= "";
	$_SESSION['USER_LEVEL']	= 99;
	$qr = $db->delete(FDBPrefix."session_login","user_id=".$_SESSION['USER_ID']);	
	redirect($_POST['prevpage']);
}	
		
if(isset($_POST['forgot']))	{		
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){						
		define("userNotice","<div class='notice-error'>Please fill the field corectly!</div>");
	} 
	else {
	$qr = $db->select(FDBPrefix."user","*","status=1 AND email='$_POST[email]'"); 
	$qr = mysql_fetch_array($qr);
	$jml = mysql_affected_rows();
		if($jml) {
		// multiple recipients
		$to = "$_POST[email]";
		// subject
		$subject = 'Password Reminder';
		$password = randomString('','8');
		// message
		$siteMail = siteConfig('site_mail');
		$siteName = siteConfig('site_name');
		$message = "
		Hello $qr[name],<br>
		You have done a password reminder requests <br><br>
		This is new data login for ".SiteName.".<br>
		Real Name : $qr[name] <br>
		Username : $qr[user] <br>
		Password : $password  <br><br>
		Take good care of your accounts from any forms of crime.<br><br><br>
		<span style='font-size:80%'>This email is processed using Fiyo CMS for $siteName.</span>";
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$mail = siteConfig('site_mail');
		$from = siteConfig('site_name');
		// Additional headers
		$headers .= "To: $_POST[email] <$_POST[email]>," . "\r\n";
		$headers .= "From: $siteName<$siteMail>" . "\r\n";
		// Mail it
		$mail = @mail($to,$subject,$message,$headers);
			if($mail) {
				define("userNotice","<div class='notice-info'>New password has been sent to your email.</div>");
				$qr = $db->update(FDBPrefix."user",array(
			'password'=>MD5("$password")),
			"id=$qr[id]");
			}
			else
				define("userNotice","<div class='notice-error'>System error : function mail() can not executed.</div>");		
		}
		else {
			define("userNotice","<div class='notice-error'>Email not registered!</div>");
		}
	}	
}	

if(!defined("userNotice")) define("userNotice","");
		

//App User SEF Controller
if('SEF_URL'){
	$view = app_param('view');
	if($view=='logout') 
		add_permalink('user/logout');
	else if($view=='edit') 
		add_permalink('user/edit');
	else if($view=='login') 
		add_permalink('user/login');
	else if($view=='register') 
		add_permalink('user/register');
	else if($view=='lost_password') 
		add_permalink('user/remember');
	else if(empty($view)) 
		add_permalink('USER');
}


/************* App User Page Title ******************/
if($view == 'register')
	define('PageTitle','User Register');
else if($view == 'login')
	define('PageTitle','User Login');
else if($view == 'lost_password') 
	define('PageTitle','Passowrd Reminder');
else if($view == 'logout') {
	define('PageTitle','Logout Page');
}
else if($view == 'profile') {
	define('PageTitle','User Profile');
}
else  {
	define('PageTitle','User Profile');
}


loadLang(__dir__);


<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

/****************************************************/
/*				   User Constants					*/
/****************************************************/

if(empty($_SESSION['USER_LEVEL']) or $_SESSION['USER_LEVEL'] == 0 or $_SESSION['USER_LEVEL'] == 99)	{		
	$_SESSION['USER_LEVEL']  = 99;
	$_SESSION['USER']  = null;
	$_SESSION['USER_ID']  = null;
	$_SESSION['USER_NAME']  = null;
	$_SESSION['USER_EMAIL']  = null;
}

define('User', $_SESSION['USER']); 
define('userID', $_SESSION['USER_ID']);
define('userName', $_SESSION['USER_NAME']);
define('userLevel',$_SESSION['USER_LEVEL']);
define('userEmail',$_SESSION['USER_EMAIL']);

/*
* Quick Acces Level
*/
define('Level_Access',"AND level >= ".$_SESSION['USER_LEVEL']);


class User {
	function register() {	
		$db = new FQuery();  
		$db->connect(); 		
		if(isset($_POST['register'])) {		
			$us=strlen("$_POST[user]");
			$ps=strlen("$_POST[password]");
			if(	!empty($_POST['password']) AND 
				!empty($_POST['user'])AND 
				!empty($_POST['secure'])AND 
				!empty($_POST['email'])AND 
				$_POST['password']==$_POST['kpassword'] AND 
				$us>2 AND $ps>3) {
				if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$this -> notice =  "<div class='notice-error'>Please check your email !</div>";
				}
				else if($_POST['secure'] == $_SESSION['security_number']) {		
					$qr=$db->insert(FDBPrefix.'user',array("","$_POST[user]","$_POST[user]",MD5("$_POST[password]"),"$_POST[email]","1","",date('Y-m-d H:i:s'),""));
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
						
						return "<div class='notice-info'>Register Complete, you now may login. <i>Redirecting...</i></div>"; 
						htmlRedirect(make_permalink('?app=user'),3);
					}
					else 
						return  "<div class='notice-error'>System Error : Tell this error to Administrator !</div>";
				} else 
					return "<div class='notice-error'>Security code is incorrect !</div>";
			}
			else  {						
				return  "<div class='notice-error'>Register failed, please fill the fields corectly !</div>";
			}
		}
	}
	
	function login() {		
		if(isset($_POST['login']))
		{			
			$db = new FQuery();  
			$db->connect(); 
			$qr = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND password='".MD5($_POST['pass'])."'"); 
			$qr = mysql_fetch_array($qr);
			$jml = mysql_affected_rows();
			if($jml > 0) {		
				$_SESSION['USER'] 		= $qr['user'];
				$_SESSION['USER_NAME'] 		= $qr['user'];
				$_SESSION['USER_ID']  	= $qr['id'];
				$_SESSION['USER_EMAIL']	= $qr['email'];	
				$_SESSION['USER_LEVEL'] = $qr['level'];
				$db->select(FDBPrefix."session_login","*","user_id=$qr[id]");
				if($qr['id'] > 0)
				{
					$db->delete(FDBPrefix."session_login","id=$qr[id]");
					$qrs=$db->insert(FDBPrefix."session_login",array("$qr[id]","$qr[user]","$qr[level]",date('Y-m-d H:i:s')));  
				}	
				redirect(make_permalink('?app=user&view=profile'));
			}
			else {
				return "<div class='notice-error'><b>Username</b> or <b>password</b> is invalid !</div>";
			}
		}
	}
	
	function logout() {
		if(isset($_POST['logout']))
		{	
			$db = new FQuery();  
			$db->connect(); 
			$_SESSION['USER']		= "";
			$_SESSION['USER_ID']	= "";
			$_SESSION['USER_NAME']	= "";
			$_SESSION['USER_EMAIL']	= "";
			$_SESSION['USER_LEVEL']	= 99;
			$qr = $db->delete(FDBPrefix."session_login","user_id=".$_SESSION['userId']);	
			redirect(make_permalink('?app=user&view=login'));
		}
	}
	
	function reminder() {	
		if(isset($_POST['forgot']))	{	
			$db = new FQuery();  
			$db->connect(); 	
			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){						
				return  "<div class='notice-error'>Please fill the field corectly !</div>";
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
					return "<div class='notice-info'>New password has been sent to your email.</div>";
					$qr = $db->update(FDBPrefix."user",array(
					'password'=>MD5("$password")),
					"id=$qr[id]");
				
				}
				else
					return "<div class='notice-error'>System error : function mail() can not executed.</div>";
			}
			else
				return "<div class='notice-error'>Email not registered !</div>";
			}	
		}	
	}
}



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

/****************************************/
/*	    Enable and Disbale Article		*/
/****************************************/
if(isset($_GET['stat'])) {
	if($_GET['stat']=='1'){
		if(userInfo('about',$_GET['id']) == 'Waiting for activation...') {
		
			$siteName	= siteConfig('site_name');
			$siteMail	= siteConfig('site_mail');
			$siteLang	= siteConfig('lang');
			
			$user		= userInfo('user',$_GET['id']);
			$userName	= userInfo('name',$_GET['id']);
			$userEmail	= userInfo('email',$_GET['id']);
			
				if($siteLang == 'id') {
					$subject = "Informasi Data Login";
					$message = "<p>Halo, $userName</p> 
						<p>&nbsp;</p>";
						
					$message = $message . "<p>Selamat, akun anda telah diaktifkan dan bisa login ke website kami.</p>		
						<p>&nbsp;</p>			
						<p>Berikut adalah data Anda :</p><p>&nbsp;</p>
						<p>Username : $user</p>
						<p>Email : $userEmail</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>Jaga selalu data Anda dari segala sesuatu yang tidak diinginkan.</p>
						<p>Terimakasih.</p>
						<p>&nbsp;</p><p>&nbsp;</p>
						<p><b>$siteName.</b></p>";		
					}
					else {
					$subject = "Account Login Information";
					$message = "<p>Hello, $userName</p>
						<p>&nbsp;</p>";
					$message = $message . "<p>Congratulation, you'r account has been activated and you can login to our website.</p>			
						<p>&nbsp;</p>	
						<p>Here are details of your account :</p><p>&nbsp;</p>
						<p>Username : $user</p>
						<p>Email : $userEmail</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>Take good care of your accounts from any forms of crime.</p>
						<p>Thankyou.</p>
						<p>&nbsp;</p><p>&nbsp;</p>
						<p><b>$siteName.</b></p>";
					}
				$to  = "$userEmail" ;
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "To: $userName <$userEmail>"."\r\n";
				$headers .= "From: $siteName <$siteMail>" . "\r\n";
				$email = @mail($to,$subject,$message,$headers);	
				if($email){
					$db->update(FDBPrefix.'user',array("about"=>""),'id='.$_GET['id']);
				}
		
		}
		$db->update(FDBPrefix.'user',array("status"=>"1"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
	else if($_GET['stat']=='0'){
		$db->update(FDBPrefix.'user',array("status"=>"0"),'id='.$_GET['id']);
		alert('info',Status_Applied);
	}
}
endif;
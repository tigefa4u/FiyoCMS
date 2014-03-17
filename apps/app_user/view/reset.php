<?php
/**
* @name			User
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

if(siteConfig('member_registration'))
	$new = "<a class='register' href='".make_permalink('?app=user&view=register')."'>Register</a>";
	
	if(isset($_SESSION['USER_REMINDER']) AND $_SESSION['USER_REMINDER']) {
		
		$password_n = randomString(8);
		$password_m = md5($password_n);
		$id =$_SESSION['USER_REMINDER_ID'];
		$qr = $db->update(FDBPrefix.'user',array("password"=>"$password_m"),"id=$_SESSION[USER_REMINDER_ID]"); 
		if($qr)  {
			$webmail = siteConfig('site_mail'); 
			$webmail = siteConfig('site_mail'); 
			$domain  = str_replace("/","",FUrl()); 
			if(empty($webmail)) $webmail = "no-reply@$domain";
			
			$email = userInfo('email',$id);
			$user = userInfo('user',$id);
			$name = userInfo('name',$id);
			$to  = "$email" ;
			if(siteConfig('lang') == 'id') {
			$subject = 'Informasi Akun Baru';
			$message = "<font color='#333'>
			<p>Halo, $name</p> 
			<p>Password Anda telah di reset ulang dan berikut adalah data login akun Anda.</p>
			<p>&nbsp;</p>
			<p>Username = $user</p>
			<p>Password = $password_n</p>
			<p>&nbsp;</p>
			<p>Jaga selalu kerahasiaan akun Anda untuk mencegah hal yang tidak diinginkan.</p>
			<p>Terimakasih.</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p><b>".SiteTitle."</b>".FUrl."</p></font>";
			}
			else {			
			$subject = 'New Account Information';
			$message = "<font color='#333'>
			<p>Hello, $name</p> 
			<p>Your password has been reset and here are your data account login.</p>
			<p>&nbsp;</p>
			<p>Username = $user</p>
			<p>Password = $password_n</p>
			<p>&nbsp;</p>
			<p>Please always keep the confidentiality of your account to prevent unwanted crimes.</p>
			<p>Thankyou.</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p><b>".SiteTitle."</b><br>".FUrl."</p></font>";			
			}	
		// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
			$headers .= "To: $name <$mail>" . "\r\n";
			
			$headers .= 'From: '.SiteTitle. "<$webmail>" ."\r\n";
			$headers .= 'cc :' . "\r\n";
			$headers .= 'Bcc :' . "\r\n";

		// Mail it
			$mail = @mail($to,$subject,$message,$headers);
			if($mail)  {
				$_SESSION['USER_REMINDER'] = $_SESSION['USER_REMINDER'] = null;				
				$notice = alert("info",user_Password_Reset_Sent,true);
			}
			else {		
				$notice = alert("error",user_Password_Reset_Fail,true);
			}
		}
		else
			$notice = alert("error",user_Password_Reset_Fail,true);
	}
	else {
		$notice = alert("error",user_Password_Reset_Fail,true);
	}
?>
<div id="user">
	<h1>Password Reminder</h1>
	<?php echo $notice; ?>
	<form action="" method="post">
	<?php echo userNotice; ?>
		<div class="user-desc"><?php echo user_Password_Reminder; ?></div>
		<div>
			<span>Key</span>  <input type="text" name="email" /></div>
		<div class="user-link">
			<span>&nbsp;</span>
			<input type="submit" name="forgot" value="<?php echo Send; ?>" class="button btn login"/>
			<a href="<?php echo make_permalink('?app=user&view=login') ?>">Login</a> <?php echo @$new; ?>
		</div>
	</form>
</div>
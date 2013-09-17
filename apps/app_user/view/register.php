<?php
/**
* @name			User
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/


defined('_FINDEX_') or die('Access Denied');

if(!siteConfig('new_member')) :
	echo "<h1>User Register</h1>";
	echo "<p>";
	echo RegisterNotAllowed__;
	echo "</p>";
else :

?>
<script> 
function reloadCaptcha() {
	document.getElementById('captcha').src = document.getElementById('captcha').src+ '?' +new Date();
}
</script>
<div id="user">
	<input type="hidden" id="url" value="<?php echo FUrl; ?>" />
	<form method="post" action="">	
		<h1>User Register</h1>
		<?php echo userNotice; ?>		
		<div>
			<span>Username</span><input <?php formRefill('user'); ?> type="text" autocomplete="off" name="user" placeholder="Username"/> min.3 character
		</div>
		<div>
			<span>Password</span> <input type="password" autocomplete="off"  name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"/> min.4 character
		</div>
		<div>
			<span>Confirm Password</span> <input type="password" name="kpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"/>
		</div>
		<div>
			<span>Email</span><input type="text" <?php formRefill('email'); ?>name="email" placeholder="Email"/>
		</div>
		<div>
			<span>Security</span><div><img src="<?php echo FUrl; ?>/plugins/mathcaptcha/image.php" alt="Click to reload image" title="Click to reload image" id="captcha" onclick="javascript:reloadCaptcha()" /><br/><input type="text" name="capthca" placeholder="What the result?" class="security" /></div>
		</div>
		<div class="user-link">
			<span>&nbsp;</span><input type="submit" name="register" value="Register" class="button login"/> <a href="<?php echo make_permalink('?app=user&view=login') ?>">Login</a> <a href="<?php echo make_permalink('?app=user&view=lost_password') ?>">Lost Password?</a>
		</div>
	</form>
</div> 
<?php endif ?>
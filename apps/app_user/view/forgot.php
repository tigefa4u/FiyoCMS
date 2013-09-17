<?php
/**
* @name			Fi User
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

if(siteConfig('new_member'))
	$new = "<a class='register' href='".make_permalink('?app=user&view=register')."'>Register</a>";
?>
<div id="user">
<h1>Password Reminder</h1>
	<form action="" method="post">
	<?php echo userNotice; ?>
		<div class="user-desc"><?php echo user_Password_Reminder; ?></div>
		<div>
			<span>Email</span>  <input type="text" name="email" /></div>
		<div class="user-link">
			<span>&nbsp;</span>
			<input type="submit" name="forgot" value="<?php echo Send; ?>" class="button login"/>
			<a href="<?php echo make_permalink('?app=user&view=login') ?>">Login</a> <?php echo @$new; ?>
		</div>
	</form>
</div>
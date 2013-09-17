<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

if(siteConfig('new_member'))
$new = "<a href=".make_permalink('?app=user&view=register').">Register</a>";
$link = make_permalink('?app=user&view=login');
	
if(empty($_SESSION['USER_ID'])) : ?>
<form action="<?php echo $link; ?>" method="post">
	<input type="hidden" name="prevpage" value="<?php echo getUrl(); ?>" />
	<div class="mod-user-login">
		<div>
			<span>Username</span> <input type="text" autocomplete="off" name="user" placeholder="e.g. User"/>
		</div>
		<div>
			<span>Password</span> <input type="password" name="pass" autocomplete="off"  placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"/>
		</div>
		<div class="mod-user-action"><span>
			<input type="submit" name="login" value="Login" class="button"/></span>
			<?php echo @$new;?>
			<a href="<?php echo make_permalink('?app=user&view=lost_password') ?>"><?php echo Lost_Password; ?>?</a>  
		</div>
	</div>
</form>
<?php else : ?>
<form action="<?php echo $link; ?>" method="post">
	<input type="hidden" name="prevpage" value="<?php echo getUrl(); ?>" />
	<div class="mod_user">
		<div class="user">
		<?php echo Welcome; ?>, <?php echo $_SESSION['USER_NAME']; ?>.</div>
		<div>
		<a href="<?php echo make_permalink('?app=user'); ?>"  class="button"> <?php echo Profile; ?></a>&nbsp;
		<input type="submit" name="logout" value="<?php echo Logout; ?>" class="button"/>
		</div>	
	</div>
</form>
<?php endif; ?>
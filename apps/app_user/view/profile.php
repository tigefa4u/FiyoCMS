<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<form action="" method="post">
	<div class="user-profile">
		<h1><?php echo Welcome; ?>, <?php echo userName; ?></h1>
		<p>
			<?php echo user_Login_Success; ?>
		</p>
		<p>
			<a href="<?php echo make_permalink('?app=user&view=edit'); ?>" class="button"><?php echo Edit_Profile; ?></a>
			<input type="submit" name="logout" value="<?php echo Logout; ?>" class="button"/>
		</p>
		<?php loadModule('user-profile'); ?>
	</div>
</form>
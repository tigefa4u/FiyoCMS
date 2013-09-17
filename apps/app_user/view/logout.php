<?php
/**
* @name			Logout
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

$link = make_permalink("?app=user");
?>
<div class="user-logout">
	<h1>User Logout</h1>
	<form action="" method="post">
		<div>
			<?php echo Sure2Logout__; ?>
		</div>
		<div>
			<input type="submit" name="logout" value="<?php echo Yes; ?>"  class="button" /> <?php echo or_; ?> <a href="<?php echo $link; ?>" class="button"><?php echo No; ?></a>	
		</div>
	</form>
</div>
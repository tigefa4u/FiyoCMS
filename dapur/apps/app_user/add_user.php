<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect(); 
$qr = null;
?>
<form method="post" action="">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo New_User; ?></div>
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="applysave"/>
				<span class="lbt sparator"></span>	
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save"/>
				<a class="lbt cancel tooltip" href="?app=user" title="<?php echo Cancel; ?>"></a>	
				<span class="lbt sparator"></span>	
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>			
			<div id="helper"><?php echo User_help; ?></div>
			</div>
		</div>			 
	</div>
<?php require('field_user.php'); ?>
</form>

<?php
/**
* @version		1.5.1
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
**/

defined('_FINDEX_') or die('Access Denied');

?>

<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
		  <div class="app_title">New Contact</div>
			<div class="app_link">		
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_add"/>
				<span class="lbt sparator"></span>
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_add"/>
				<a class="lbt cancel tooltip link" href="?app=contact" title="<?php echo Cancel; ?>"></a>
				<span class="lbt sparator"></span>
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Field_Contact_help; ?></div>			
			</div>
		</div>
	</div>
	<?php 
		require('field_contact.php');
	?>		
</form>		

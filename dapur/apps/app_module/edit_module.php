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
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo Edit_Module; ?></div>		
			<div class="app_link">	
				<input type="submit" value="<?php echo Save; ?>" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_edit"/>
				<hr class="lbt sparator tooltip">
				<input type="submit" value="<?php echo Save & Close; ?>" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_edit"/>
				<a class="lbt cancel tooltip link" href="?app=module" title="<?php echo Cancel; ?>"><?php echo Cancel; ?></a>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Add_Module_2_help; ?></div>
			</div>		
		</div>			 
	</div>
		
	<?php 
		require('field_module.php');
	?>	
</form>

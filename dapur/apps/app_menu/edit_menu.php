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
			<div class="app_title"><?php echo Edit_Menu; ?></div>			
			<div class="app_link">	
				<input type="submit" class="lbt save tooltip" value="Save" title="<?php echo Save; ?>" name="apply_edit"/><hr class="lbt sparator tooltip">
				<input type="submit" class="lbt save_ref tooltip" value="Save & Close" title="<?php echo Save_and_Quit; ?>" name="save_edit"/>			
				<a class="lbt cancel  link tooltip" href="?app=menu&cat=<?php echo oneQuery('menu','id',$_GET['id'],'category'); ?>" title="<?php echo Cancel; ?>"></a>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Add_Menu_2_help; ?></div>
			</div>
		 </div>			 
	</div>
		
	<?php 
		require('field_menu.php');
	?>	
</form>
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
		<div class="app_title"><?php echo Edit_Article; ?></div>		
			<div class="app_link">				
				<input type="submit" value="Save" class="lbt save tooltip" title="<?php echo Save;?>" name="apply_edit"/>					
				<span class="lbt sparator"></span>
				<input type="submit" value="Save & Close" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_edit"/>
				<input type="submit" value="Save & New" class="lbt save_add tooltip" title="<?php echo Save_add_new;?>" name="save_new"/>
				<input type="submit" value="Duplicate" class="lbt save_as tooltip" title="<?php echo Save_as_duplicate;?>" name="save_as"/>
				<a class="lbt cancel tooltip link" href="?app=article&cat=<?php echo oneQuery('article','id',app_param('id'),'category'); ?>" title="<?php echo Cancel; ?>"></a>
				<span class="lbt sparator"></span>
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Field_Article_help; ?></div>				
			</div>
		</div>
	</div>	
	<?php 
		require('field_article.php');
	?>		
</form>		
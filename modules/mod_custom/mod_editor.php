<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');
addJs ("../plugins/ckeditor/ckeditor.js");

if(checkLocalhost()) {
	$param = str_replace("media/",FLocal."media/",$qr['parameter']);			
}

?>

<input type="hidden" value="0" name="totalParam" />
<textarea class="ckeditor" id="editor" name="editor" rows="10" cols="100">
	<?php formRefill('editor',$param,'textarea'); ?>
</textarea>
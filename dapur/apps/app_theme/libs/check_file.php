<?php 
/**
* @version		2.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2014 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

define('_FINDEX_','BACK');

require_once ('../../../system/jscore.php');
$file = $url= "$_GET[src]/$_GET[name]"; 
$furl = "../../../$url";

$content = strlen("$file") - 5;
$content = substr("$file",$content);
$file = strpos("$content",".");
$file = substr("$content",$file+1);

if($file == "html" || $file == "htm" || $file == "xhtml" || $file == "js" ||
$file == "jsp" || $file == "php" || $file == "css" || $file == "xml" ) :
	$content = @file_get_contents($furl);

?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	editAreaLoader.init({
		id : "text"		// textarea id
			,start_highlight: true
			,allow_toggle: false
			,language: "en"
			,syntax: "<?php echo $file; ?>"	
			,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight"
			,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
			,EA_load_callback: "editAreaLoaded"
			,show_line_colors: true
	});
	
	var btn = $("#save-file");
	btn.show();	

});
</script>
<textarea id="text" name="content" class="scrolling text-theme" style="width:100%; max-width:100%; height: 500px;" ><?php echo $content; ?></textarea>

<?php 

elseif($file == "jpg" || $file == "jpeg" || $file == "png" ||
$file == "gif" || $file == "tif" || $file == "ico") :
$furl = "../../$url";
echo "<div class='warp-img'><img src='".siteConfig('site_url')."$furl' style='max-width: 90%'/ ></div>";

?> 
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
		var btn = $("#save-file");
		btn.hide();	
	});
</script>
<?php

else :
alert('error',File_not_support);
?>
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
		var btn = $("#save-file");
		btn.hide();	
	});
</script>
<?php
endif;
?>
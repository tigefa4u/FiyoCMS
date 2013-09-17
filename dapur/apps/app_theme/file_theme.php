<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

include("libs/php_file_tree.php");
addCss("apps/app_theme/libs/styles/default/default.css");
addJs("apps/app_theme/libs/php_file_tree.js");
addJs("apps/app_theme/libs/editarea_0_8_2/edit_area/edit_area_full.js");
?>
<script language="javascript" type="text/javascript">
  $(document).ready(function() {
		$(".thmfile").click(function(){
			var loadings = $("#loading");
			loadings.hide();
			loadings.fadeIn();
			var name = $(this).html();
			var src = $(this).attr('src');
			 $('.file-title').html(name);
			$("#save-file").attr('name',"../../../"+src+"/"+name);
			
			$.ajax({
				url: "apps/app_theme/libs/check_file.php",
				data: "src="+src+"&name="+name,
				success: function(data){
				$("#editor").html(data);
				$('#loading').fadeOut();
				}
			});
		});
		
		$("#save-file").click(function(){
			var content =  editAreaLoader.getValue("text") ;
			var src = $(this).attr('name');
			var loadings = $("#stat");
			loadings.html("<div class='notice info'>Saving...</div>");
			loadings.fadeIn();	
			
			$.ajax({
				type: 'POST',
				url: "apps/app_theme/libs/save_file.php",
				data: "src="+src+"&content="+content,
				success: function(data){
				loadings.html(data);
				setTimeout(function(){
					loadings.fadeOut(1000, function() {
					});				
				}, 3000);
				}
			});
		});
		var btn = $("#save-file");
		btn.hide();
	});
</script>
<div id="stat">	
</div>
<div id="app_header" style="margin-bottom: 8px;">
	<div class="warp_app_header">
		<div class="app_title">Theme Editor</div>
		<div class="app_link">			
			<a class="lbt prev tooltip" href="?app=theme" title="<?php echo Prev; ?>"></a>
				<hr class="lbt sparator tooltip">
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>
			
			<div id="helper"><?php echo Files_Theme_help; ?></div>
		</div>
	 </div>		
</div>		
<div class="first col noborder" style="width: 29.7%;">	
						
	<div class="col full first" style=" width: 97% !important;">	
	<h3>Folder : ./themes/<?php echo $_GET['theme']; ?></h3>
	<?php
		if($_GET['act'] == 'afiles')
			$target = "themes/$_GET[theme]";
		else
			$target = "../themes/$_GET[theme]";
		echo php_file_tree("$target", "#");
	?>
	</div>
</div>
<div class=" first panin"  style="width: 70%;padding-right: 10px;float: left;">			
	<div class="col full first" style=" width: 100% !important;  ">	
	<h3 class='file-title'>File Content</h3>
	<input type="submit" value="<?php echo Save; ?>" class="button top-btn-file" id="save-file" />
	<div id="editor"><div style="padding: 30px;"></div></div>
	</div>
</div>
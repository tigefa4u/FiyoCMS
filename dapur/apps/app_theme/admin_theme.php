<?php
/**
* @version		2.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2014 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect();  
?>
<script type="text/javascript">	
$(function() {			
	$( ".count" ).html($(".col-theme:visible" ).length);
  $("#search").keyup(function(){
	var v = $(this).val().toLowerCase();
	$(".col-theme:contains("+v+")" ).css( "display", "block" );
	$('.col-theme:not(:contains('+v+'))').hide(); 
	$( ".count" ).html($(".col-theme:visible" ).length);
  });
	
  $(".theme-btn.enable").click(function(){
		var vl = $(this);
		var value = vl.data('name');
		$.ajax({
			url: "apps/app_theme/controller/status.php",
			data: "theme="+value+"&type=admin",
			success: function(data){
				$('.col-theme.active').removeClass('active');
				vl.parents('.col-theme').addClass('active');
				notice(data);		
			}
		});
	});  
});
</script>
<div id="app_header">
	<div class="warp_app_header">		
		<div class="app_title">Admin Themes</div>
		<div class="app_link">			
				<input type="text" id="search" class="theme-search" placeholder="<?php echo Search; ?>..." size="40"/>
				<div class="tooltip fade right in theme-count"><div class="tooltip-arrow"></div><div class="tooltip-inner count">View Site</div></div>
				<input type="hidden" value="true" name="delete_confirm" />
		</div>
	</div>		
</div>
<div id="app-theme">
<?php
$thm = $act = '';
$sql=$db->select(FDBPrefix.'setting','*',"name='admin_theme'"); 
$qr_themes = mysql_fetch_array($sql); 
$dir=opendir("themes");  
$no=0;
while($folder=readdir($dir)){ 
	if($folder=="." or $folder=="..")continue; 
	if(is_dir("themes/$folder"))
	{				
		$no++;
		$spot_file = "themes/$folder/theme_details.php";
		if(file_exists($spot_file)) include("$spot_file");
		else {
			$theme_version = "Error :: File <b>theme_details.php</b> not found in <b>$folder</b> ";
			$theme_author = "undefined";
			$theme_date =  "undefined";
			$theme_name =  $folder;
			$theme_name2 =  strtolower($folder);
		}
		$theme_name2 =  strtolower($theme_name);
		$active = 'enable';
		$c = siteConfig('admin_theme');
		$ac = Activate;
		if($c == $folder) { $active = 'active'; $ac = Active;}
		$isi = "
		<div class='col-theme $active' data-name='$theme_name'>
			<div class='theme-box'>
				<div class='theme-image'>
					<a hhref='#'>								
					<img src='themes/$folder/$theme_image' >
					<!--div> <span> Details </span></div -->
					</a>
				</div>
				<div class='theme-title'>			
					$theme_name							
					<input type=\"button\" name=\"folder_themes\" data-name=\"$folder\" value=\"$ac\" class=\"theme-btn $active btn btn-success right\">
				</div>
				<span class='invisible'>$theme_name2</span>
			</div>
		</div>";
		if($c == $folder) 		
		$act = $isi;
		else 
		$thm .= $isi;
		
	}
}
echo $act.$thm;
	closedir($dir); 
?>	
<input type="hidden" value="<?php echo $no; ?>" class="number">
</div>
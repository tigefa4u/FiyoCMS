<?php
/**
* @version		1.5.0
* @package		Fi Download
* @copyright	Copyright (C) 2012 Fiyo Developers.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$download = new Download;
$download ->category(app_param('label'),Page_ID,1);

if(isset($download -> category)) :
$category 	= $download-> category;
$catlink	= $download-> catlink;
$text  		= $download-> desc;
$image		= $download-> image;
$pagelink 	= $download-> pglink;
$link 		= $download-> link;
$perrows 	= $download-> perrows;
$author 	= $download-> author;
$title		= $download-> title;
$labels 	= $download-> labels;
$hits 		= $download-> hits;
$date 		= $download-> date;
$label = ucfirst(app_param('label'));
if($title) : 
	if(!empty($label)) echo "<h1 class='title'>$label</h1>";
	else if(defined('Apps_Title')) echo "<h1 class='title'>".Apps_Title."</h1>";
	else echo "<h1>Download<h1>";
 ?>
<div id="download-default">
	<?php for($i=0; $i < $perrows ;$i++) : 	?>
		<div class="download_item">	
			<div class="download_main">
				<a href="<?php echo $link[$i] ?>" class="download_img"><img src="<?php echo "$image[$i]"; ?>" width="128px" height="128px"></a>		
				
				<div class="download_desc"><h2 class="title"><?php echo $title[$i]; ?></h2>
				<?php echo cutWords($text[$i],15);?>...						
				</div>	
			</div>	
			
			<div class="clear"></div>
				<?php  if(!empty($download->show_panel)) : ?>
					<div class='download_panel'>
					<ul id="download_label"><?php echo $labels[$i]; ?></ul>		
					<span>
					<?php echo "Author : <i>$author[$i]</i><br>On : <i>$category[$i]</i>"; ?>
					</span>	
					</div>
				<?php endif; ?>
		</div>	
		<?php endfor; ?>		
		<div class="download_main">
			<?php echo $pagelink; ?>
		</div>
	</div>	
<?php	
endif;
endif;
?>
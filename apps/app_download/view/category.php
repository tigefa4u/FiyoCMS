<?php
/**
* @version		1.5.0
* @package		Fi Download
* @copyright	Copyright (C) 2012 Fiyo Developers.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$download = new Download;
$download ->category(app_param('id'),Page_ID);

if(isset($download-> category)) :
$category 	= $download-> category;
$image		= $download-> image;
$pagelink 	= $download-> pglink;
$link 		= $download-> link;
$perrows 	= $download-> perrows;
$labels 	= $download-> labels;
$author 	= $download-> author;
$license 	= $download-> license;
$title		= $download-> title;
$hits 		= $download-> hits;
$description= $download-> description;
$compability= $download-> compability;
	
if($title) :	
	?>	
	<?php echo "<h1 class='title'>".ucwords(PageTitle)."</h2>"; ?>
	<div id="download-category">
		<?php 
		for($i=0; $i < $perrows ;$i++)
		{ 
		?>		
		<div class="download_item">	
			<div class="download_main">
				<a href="<?php echo $link[$i] ?>" class="download_img"><img src="<?php echo "$image[$i]"; ?>" width="128px" height="128px"></a>		
				
				<div class="download_desc">
					<ul id="download_label"><?php echo $labels[$i]; ?></ul><h2 class='title'><?php echo $title[$i]; ?>
				</h2>	
				<?php echo 
				 cutWords($description[$i],40);; ?>	
					
				</div>	
			</div>	
			
			<div class="clear"></div>
			<?php if(!empty($download->show_panel)) : ?>
				<div class='download_panel'>
					<span>
					Author <i><?php echo $author[$i]; ?></i><br>On <i><?php echo $category[$i]; ?></i>									
					</span>
					<span>
					Compability<i> <?php echo $compability[$i]; ?></i><br>License <i><?php echo $license[$i]; ?></i>		
				</div>
			<?php endif; ?>
		</div>	
		<?php	
		}
		?>		
		<div class="download_main">
			<?php echo $pagelink; ?>
		</div>
	</div>	
<?php	
endif;
endif;
?>
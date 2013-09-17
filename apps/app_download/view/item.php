<?php
/**
* @version		1.5.0
* @package		Fi Download
* @copyright	Copyright (C) 2012 Fiyo Developers.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$download = new Download;
$download -> item($id,Page_ID);

$file  = @$download-> download;
		
	if(isset($file))
	{	
		
	$category 	= $download-> category;
	$image	 	= $download-> image;
	$author 	= $download-> author;
	$title		= $download-> title;
	$compability= $download-> compability;
	$rate	 	= $download-> rate;
	$hits 		= $download-> hits;
	$addate 	= $download-> addate;
	$update 	= $download-> update;
	$labels		= $download-> labels;
	$version	= $download-> version;
	$license	= $download-> license;
	$desc		= $download-> desc;
	$demo		= $download-> demo;
	$docs		= $download-> docs;
	$support	= $download-> support;
	$downloaded	= $download-> downloaded;
	?>	
	<div id="download-item">
		<div class="download_item">	
			<div class="download_main">
				<a href="<?php echo $link; ?>" class="download_img">
					<img src="<?php echo "$image"; ?>" width="128px" height="128px">
				</a>		
				
				<ul id="download_label"><?php echo $labels; ?></ul>
				<h1><?php echo $title; ?></h1>				
								<hr>
				<table id="download_table">
				<tr>
					<td class='title'>Compability </td><td><?php echo $compability; ?></td>
					<td class='title'>Rating </td><td><?php echo $rate ?></td>
				</tr>
				<tr>
					<td class='title'>Date Added  </td><td><?php echo $addate ?></td>
					<td class='title'>Date Updated </td><td><?php echo $update ?></td>
				</tr>
				<tr>
					<td class='title'>Version  </td><td><?php echo $version ?></td>
					<td class='title'>Views </td><td><?php echo $hits ?></td>
				</tr>
				<tr>
					<td class='title'>Author </td><td><?php echo $author ?> </td>
					<td class='title'>License </td><td><?php echo $license ?></td>
				</tr>
				</table>	
			</div>	
			
		</div>
		
		
		<div class="clear"></div>
		
		<div class="download_panel">
			<?php echo $file; ?>
			<?php echo $demo; ?>
			<?php echo $docs; ?>
			<?php echo $support; ?>
			<?php echo $downloaded; ?>
		</div>	
		
			<div class="clear"></div>
			
		<div class="download_desc">
			<?php echo $desc; ?>
		</div>	
		
			<div class="clear"></div>
			<?php loadModule('download-mid'); ?>
			
			<div class="clearfix">&nbsp;</div>
					
			<div class="download-comment">
				<?php 
					if(downloadConfig('comment')) require_once ("comment.php");
				?>
			</div>
				
	</div>	
	<?php
	
}
?>
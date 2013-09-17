<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect(); 
$id=$_REQUEST['id'];
$sql= $db->select(FDBPrefix.'comment','*','id='.$id);
$qr	= mysql_fetch_array($sql);

if($qr['status']==1) {$status1="checked";}
else { $status2="checked";}

$link = str_replace(FUrl,"",make_permalink($qr['link']));
$link = "<a href='".make_permalink($qr['link'])."#comment-$qr[clink]' target='_blank' class='tooltip outlink' title='click to see comment'>$link</a> ";


?>
<form method="post">
<input value="<?php echo $qr['id'];?>" type="hidden" name="id">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title">Comment Manager</div>			
			<div class="app_link">	
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_edit"/>			
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_edit"/>
				<a class="lbt cancel tooltip" href="?app=comment" title="<?php echo Cancel; ?>"></a>
				
			</div>
		 </div>			 
	</div>
	
	<div class="cols">
		<div class="col first full">
			<h3>Comment Details</h3>
			<div class="isi">
			<table class="data2">					
				<tr>
					<td class="djudul tooltip">Comment link *</td>
					<td><?php echo $link;?></td>
				</tr>	
				<tr>
					<td class="djudul tooltip"><?php echo Active_Status; ?></td>
					<td><label><input name="status" type="radio" value="1" <?php echo @$status1?>> <?php echo Yes; ?> </label>
					<label><input type="radio" name="status" value="0" <?php echo @$status2?>> <?php echo No; ?> </label></td>
				</tr>		
				<tr>
					<td class="djudul tooltip"><?php echo Name; ?> *</td>
					<td><input value="<?php echo $qr['name'];?>" type="text" name="name" size="25"></td>
				</tr>
				<tr>
					<td class="djudul tooltip">Email *</td>
					<td><input value="<?php echo $qr['email'];?>" type="text" name="email" size="25" id="link"></td>
				</tr>				
				
				
				<tr>
					<td class="djudul tooltip" >Website</td>
					<td><input value="<?php echo $qr['website'];?>" type="text" name="web" size="10" id="order"></td>
				</tr>
				<tr>
					<td class="djudul tooltip"><?php echo Comment; ?></td>
					<td><textarea name="comment"cols="40" rows="5"><?php echo $qr['comment'];?></textarea></td>
				</tr>	
			</table>
			</div>
		</div>
		
	</div>
</form>
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
$sql=$db->select(FDBPrefix."permalink","*","id=$_REQUEST[id]"); 
$qr = mysql_fetch_array($sql); 
if($qr['status']==1) {$ck="checked";}
if($qr['status']==0) {$ck2="checked";}
?>
<form method="post" action="">
<input type="hidden" name="id" value="<?php echo $qr['id']; ?>">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title">Add New SEF</div>
			
			<div class="app_link">
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save"/>
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply"/>
				<a class="lbt cancel tooltip" href="?app=sef" title="<?php echo Cancel; ?>"></a>
			</div>
		</div>			 
	</div>
    <div class="cols">
		<div class="col first full">
			<h3>Login Data</h3>
				<div class="isi">
				<table class="data2">
					<tr>
						<td class="djudul tooltip" title="<?php echo SEF_link_tip; ?>" width="20%">SEF Link *</td>
						<td>
						<input type="text" name="sef" size="50" autocomplete="off" value="<?php echo $qr['permalink']; ?>"></td>
					</tr>
				
					<tr>
						<td class="djudul tooltip" title="<?php echo Original_link_tip; ?>">Original Link *</td>
						<td><input type="text" name="link" size="50"  autocomplete="off" value="<?php echo $qr['link']; ?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo LockSEF_tip; ?>">Lock SEF </td>
							<td><label><input type="radio" name="lock" value="1" checked> <?php echo Yes; ?></label><label>
							<input type="radio" name="lock" value="0" <?php if($qr['locker']==0) echo 'checked'; else $no='checked'?>> <?php echo No; ?></label></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo EnableSEF_tip; ?>">Enable SEF </td>
						<td><label><input type="radio" name="status" size="20" value="1" checked> <?php echo Yes; ?></label><label>
							<input type="radio" name="status" size="20" value="0"  <?php if($qr['status']==0) echo 'checked'; else $no='checked'?>> <?php echo No; ?></label></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo PageIDSEF_tip; ?>">Page ID</td>
						<td><input type="text" name="page" size="4"  value="<?php echo $qr['pid']; ?>"></td>
					</tr>
					
				</table>			
			</div>  
		</div> 
	</div>  	
</form>


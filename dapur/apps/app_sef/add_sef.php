<?php
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>

<form method="post" action="">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title">Add New SEF</div>
			
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="save_new"/>
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
						<input type="text" name="sef" size="50" autocomplete="off"></td>
					</tr>
				
					<tr>
						<td class="djudul tooltip" title="<?php echo Original_link_tip; ?>. ex:'?app=forum'">Original Link *</td>
						<td><input type="text" name="link" size="50"  autocomplete="off" ></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo LockSEF_tip; ?>">Lock SEF </td>
							<td><label><input type="radio" name="lock" size="20" value="1" > <?php echo Yes; ?></label><label>
							<input type="radio" name="lock" size="20" value="0" checked> <?php echo No; ?></label></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo EnableSEF_tip; ?>">Enable SEF </td>
						<td><label><input type="radio" name="status" size="20" value="1" checked> <?php echo Yes; ?></label><label>
							<input type="radio" name="status" size="20" value="0"> <?php echo No; ?></label></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo PageIDSEF_tip; ?>">Page ID</td>
						<td><input type="text" name="page" size="4"></td>
					</tr>
					
				</table>			
			</div>  
		</div> 
	</div>  	
</form>

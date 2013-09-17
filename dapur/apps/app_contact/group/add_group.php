<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery();  
$db ->connect(); 
?>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title">Group Contact</div>
			<div class="app_link">			
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="add_group" />
				<span class="lbt sparator"></span>
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_add_group"/>
				<a class="lbt cancel tooltip" href="?app=contact&act=group" title="<?php echo Cancel; ?>"></a>
			</div>			
		</div>
	</div>   	
	<div class="cols">
		<div class="col first full">
		<h3>Group Information</h3>
			<div class="isi">
				<table class="data2">
					<tr>
						<td class="djudul tooltip" title="<?php echo Group_Name; ?>"><?php echo Group_Name; ?> *</td>
						<td><input type="text" name="name" size="20" ></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Description; ?>"><?php echo Description; ?></td>
						<td><input type="text" name="desc" size="50" ></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</form>	

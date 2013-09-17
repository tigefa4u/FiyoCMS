<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

if($_SESSION['USER_LEVEL'] > 2){
	alert('info','Redirecting...');
	alert('loading');
	htmlRedirect('?app=user&act=group');
}
$db = @new FQuery() or die;  
$db->connect(); 
?>
<form method="post">
	<div id="app_header">
	 <div class="warp_app_header">		
		<div class="app_title">User Group</div>
		<div class="app_link">			
			<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" value="<?php echo Save; ?>" name="apply_group" />	
			<span class="lbt sparator"></span>	
			<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" value="<?php echo Save_and_Quit; ?>" name="add_group"/>
			<a class="lbt cancel tooltip" href="?app=user&act=group" title="Cancel"></a>	
			<span class="lbt sparator"></span>	
			<a class="lbt help popup tooltip" title="<?php echo Help; ?>" href="#helper"/></a>
		<div id="helper"><?php echo User_Group_help; ?></div>
		</div>	
		
	 </div>
	</div>
	
	<div class="cols">
		<div class="col first full">
		<h3>User Group</h3>
		  <div class="isi">
			<table class="data2">
				<tr>
					<td class="djudul tooltip" title="<?php echo User_Group_name; ?>">Group Name *</td>
					<td><input type="text" name="group" size="20" required /></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo User_Group_level; ?>">Level *</td>
					<td><input type="text" id="level" name="level" class="numeric"size="20" required /></span></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo User_Group_description; ?>">Description</td>
					<td><input type="text" name="desc" size="50"></td>
				</tr>
			</table>
		  </div>
		</div>
	</div>
</form>	

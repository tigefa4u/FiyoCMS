<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect();  
?>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title"><?php echo New_Category; ?></div>
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" value="<?php echo Save; ?>" name="save_cat" />
				<hr class="lbt sparator tooltip">
				<input type="submit" value="Save & Close" class="lbt save_ref tooltip link" title="<?php echo Save_and_Quit; ?>" name="save_new_category"/>
				<a class="lbt cancel tooltip" href="?app=article&act=category" title="<?php echo Cancel; ?>"><?php echo Cencel; ?></a>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup tooltip" title="<?php echo Help; ?>" href="#helper"/></a>
			<div id="helper"><?php echo Article_Category_help; ?></div>
			</div>			
		</div>
	</div>	   	
	<div class="cols">
	  <div class="col first full">
		<h3><?php echo Article_Category; ?></h3>
		<div class="isi">
			<table class="data2">
				<tr>
					<td class="djudul tooltip" title="<?php echo Category_Name; ?>"><?php echo Category_Name; ?> *</td>
					<td><input type="hidden" name="id" value=""><input type="text" name="name" size="20" <?php formRefill('name'); ?> required></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Parent_category_tip; ?>"><?php echo Parent_category; ?></td>
					<td><select name="parent_id">
					<option value=''></option>
					<?php
						$_REQUEST[id]=0;
						$sql2=$db->select(FDBPrefix.'article_category','*','parent_id=0 AND id!='.$_REQUEST['id']);
						while($qr2=mysql_fetch_array($sql2)){	
							if($qr['parent_id']==$qr2['id'])$s="selected";else$s="";
							echo "<option value='$qr2[id]' $s>$qr2[name]</option>";
							option_sub_cat($qr2['id'],'');
							$no++;	
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Category_level; ?>"><?php echo Access_Level; ?></td>
					<td>
						<select name="level" >
						<?php
							$sql = $db->select(FDBPrefix.'user_group');
							while($qrs=mysql_fetch_array($sql)){
								if($qrs['level']==$level){
									echo "<option value='$qrs[level]' selected>$qrs[group_name]</option>";}
								else {
									echo "<option value='$qrs[level]'>$qrs[group_name]</option>";
								}
							}
							$s="selected";
							echo "<option value='99' $s>"._Public."</option>"
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Description; ?>"><?php echo Description; ?></td>
					<td><textarea name="desc" rows="5" cols="50"><?php formRefill('desc','','textarea'); ?></textarea></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Keyword; ?>"><?php echo Keyword; ?></td>
					<td><textarea name="keys" rows="3" cols="50"><?php formRefill('keys','','textarea'); ?></textarea></td>
				</tr>
			</table>
        </div> 
	  </div>
	</div>
</form>	

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
$sql = $db->select(FDBPrefix.'article_category','*',"id=$_REQUEST[id]"); 
$row = mysql_fetch_array($sql); 
if($_SESSION['USER_LEVEL'] > $row['level'] ){
	alert('info','Redirecting...');
	alert('loading');
	htmlRedirect('?app=article&act=category');
}
?>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">		
			<div class="app_title"><?php echo Edit_Category; ?></div>
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="edit_category" />
				<hr class="lbt sparator tooltip">
				<input type="submit" value="Save & Close" class="lbt save_ref tooltip link" title="<?php echo Save_and_Quit; ?>" name="save_category"/>
				<a class="lbt cancel tooltip" href="?app=article&act=category" title="Cancel"></a>				
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
					<td><input type="hidden" name="id" value="<?php  echo $row['id'] ?>">
					<input type="text" name="name" size="20" <?php formRefill('name',$row['name']); ?> required></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Parent_category_tip; ?>"><?php echo Parent_category; ?></td>
					<td><select name="parent_id">
					<option value=''></option>
					<?php			
						$level = $row['level'];	
						$sql2=$db->select(FDBPrefix.'article_category','*','parent_id=0 AND id!='.$_REQUEST['id']);
						while($row2=mysql_fetch_array($sql2)){	
							if($_SESSION['USER_LEVEL'] <= $row['level'])
							if($row['parent_id']==$row2['id'])$s="selected";else$s="";
							echo "<option value='$row2[id]' $s>$row2[name]</option>";
							option_sub_cat($row2['id'],"");
						}
					?>
					</select></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Category_level; ?>"><?php echo Access_Level; ?></td>
					<td><select name="level" >
						 <?php
							$sql2 = $db->select(FDBPrefix.'user_group');
							while($user=mysql_fetch_array($sql2)){
							
							if($_SESSION['USER_LEVEL'] <= $user['level'])
								if($user['level']==$level){
									echo "<option value='$user[level]' selected>$user[group_name]</option>";}
								else {
									echo "<option value='$user[level]'>$user[group_name] </option>";
								}
							}
							if($level==99) $s="selected";else $s="";
							echo "<option value='99' $s>"._Public."</option>"
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Description; ?>"><?php echo Description; ?></td>
					<td><textarea name="desc" rows="5" cols="50" ><?php formRefill('desc',$row['description'],'textarea'); ?></textarea></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Keyword; ?>"><?php echo Keyword; ?></td>
					<td><textarea name="keys" rows="3" cols="50"><?php formRefill('keys',$row['keywords'],'textarea'); ?></textarea></td>
				</tr>
			</table>
        </div> 
	  </div>
	</div>
</form>	

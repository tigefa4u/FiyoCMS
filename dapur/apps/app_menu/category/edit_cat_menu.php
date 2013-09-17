<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db ->connect();  
$sql=$db->select(FDBPrefix.'menu_category','*',"id=$_REQUEST[id]"); 
$qr=mysql_fetch_array($sql);
?>

<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo Edit_Category; ?></div>

			<div class="app_link">
				<input type="submit" value="Save" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_category" />
				<span class="lbt sparator"></span>
				<input type="submit" value="Save & Close" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="edit_category"/>
				<a class="lbt cancel tooltip" href="?app=menu&act=category" title="<?php echo Cancel; ?>">Cancel</a>
				<span class="lbt sparator"></span>
				<a class="lbt help popup tooltip" title="<?php echo Help; ?>" href="#helper"/>Help</a>
				<div id="helper"><?php echo Menu_Category_help; ?></div>
			</div>			
		</div>
	</div>	
	<div class="cols">
		<div class="col first full">
		<h3><?php echo Menu_Category; ?></h3>
			<div class="isi">
				<table class="data2">
					<tr>
						<td class="djudul tooltip" title="<?php echo Category_Title_tip; ?>"><?php echo Category_Title; ?></td>
						<td><input type="hidden" name="id" value="<?php  echo $qr['id'] ?>"><input type="text" name="title" size="20" <?php  echo "value='$qr[title]'" ?> required></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Category_Name_tip; ?>"><?php echo Category_Name; ?></td>
						<td><input type="text" name="cat" size="20" value="<?php echo $qr['category'];?>" class="alphanumeric" required><input type="hidden" name="cats" size="20" value="<?php echo $qr['category'];?>"></td>
					</tr>
					<tr>
						<td class="djudul tooltip" title="<?php echo Description; ?>"><?php echo Description; ?></td>
						<td><input type="text" name="desc" size="50" value="<?php echo $qr['description'];?>"></td>
					</tr>
				</table>
			</div> 
		</div>
	</div>
</form>	

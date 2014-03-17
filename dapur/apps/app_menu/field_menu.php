<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect();

//set request id 
if(isset($_REQUEST['id']))
	$id=$_REQUEST['id'];
else
	$id = null;
if(!isset($id)) {
	$_REQUEST['id']=0;	
	$qr = null;
}

$act = $_REQUEST['act'];
$menuLink = null;

switch($act)
{
	case 'add':
		$name = $_POST['apps'];		
		$qr = null;
		$mod_class = null;
		$mod_style = null;
		$show_title = null;
		if($name == 'sperator')
		$menuLink = '#';
	break;
	
	case 'edit':
		$edit = 1;
		$sql = $db->select(FDBPrefix.'menu','*','id='.$id); 
		$qr	 = mysql_fetch_array($sql);	
		$name  = $qr['app'];
		$param = $qr['parameter'];
		$mod_class = $qr['class'];
		$mod_style = $qr['style'];
		$show_title = $qr['show_title'];
		$menuLink = $qr['link'];
	break;
}
$menuParam = $qr['parameter'];
$params ="apps/$name/app_params.php";	

?>

<script type="text/javascript">
$(document).ready(function(){
	$(".categorymenu").change(function(){
		var cat = $('.categorymenu').val();	
		var id = $('.menuid').val();	
		var pid = $('.parentid').val();	
		$.ajax({
			url: "apps/app_menu/controller/parent.php",
			data: "id="+id+"&cat="+cat+"&parent="+pid,
			success: function(data){			
				$(".parent").html(data);
			}
		});
	});
	$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
		});
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
		});	
});
</script>
<div class="cols">
	<div class="col first panin">
		<h3>Menu Details</h3>
		<div class="isi">
			<table class="data2">
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_Type_tip; ?>"><?php echo Menu_Type; ?></td>
					<td><b><i><?php echo $name; if(isset($edit)) echo " (id = $qr[id])";?></i></b>
					<input type="hidden" name="apps" value="<?php echo $name;?>"> 
					<input type="hidden" name="id" class="menuid" value="<?php echo $qr['id'];?>"></td>
					<input type="hidden" name="parent_id" class="parentid" value="<?php echo $qr['id'];?>"></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_Name_tip; ?>"><?php echo Name; ?> *</td>
					<td><input <?php formRefill('desc',$qr['name']); ?> type="text" name="name" style="width: 90%; margin-left: 2px;"required></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_link_tip; ?>">Link *</td>
					<td><input <?php formRefill('desc',$menuLink); ?> type="text" name="link" style="width: 90%; margin-left: 2px;" id="link" required <?php if($name!='link') echo 'readonly'; ?> ></td>
				</tr>				
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_Status_tip; ?>"><?php echo Active_Status; ?></td>
					<td>
						<?php 
							if($qr['status'] or $act == 'add'){$f1="selected checked"; $f0 = "";}
							else {$f0="selected checked"; $f1= "";}
						?>
						<p class="switch">
							<input id="radio17"  value="1" name="status" type="radio" <?php echo $f1;?> class="invisible">
							<input id="radio18"  value="0" name="status" type="radio" <?php echo $f0;?> class="invisible">
							<label for="radio17" class="cb-enable <?php echo $f1;?>"><span>On</span></label>
							<label for="radio18" class="cb-disable <?php echo $f0;?>"><span>Off</span></label>
						</p></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_Category_tip; ?>"><?php echo Menu_Category; ?> *</td>
					<td><select name="cat" class="categorymenu">
					<?php
					$sql2 = $db->select(FDBPrefix.'menu_category');
					while($qr2=mysql_fetch_array($sql2)){
						if($qr2['category']==$qr['category']){ 
							echo "<option value='$qr2[category]' selected>$qr2[title]</option>";
						}
						else {
							echo "<option value='$qr2[category]'>$qr2[title]</option>";
						}						
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Menu_Order_tip; ?>"><?php echo Menu_Order; ?></td>
					<td><input value="<?php echo $qr['short'];?>" type="text" name="short" size="5" id="order" class="numeric"><span id="pesan"></span></td>
				</tr>				
				<tr>
					<td class="djudul tooltip" title="<?php echo Parent_Menu_tip; ?>"><?php echo Parent_Menu; ?></td>
					<td>
					<select name="parent_id" class="parent">
					<option value=''></option>
					<?php	
						if($edit) $eid =  "AND id!=$qr[id]";
						if($_GET['act'] == 'add') {
							$sql3 = $db->select(FDBPrefix.'menu','*',"parent_id = 0 ",'short ASC'); 
						}
						else {
							$sql3 = $db->select(FDBPrefix.'menu','*',"parent_id = 0 $eid AND category = '$qr[category]'",'short ASC'); 
						}
						while($qr3=mysql_fetch_array($sql3)){	
							if($qr3['id']==$qr['parent_id']){ 
								echo "<option value='$qr3[id]' selected>$qr3[name]</option>";option_sub_menu($qr3['id'],$qr['parent_id'],'');
							}
							else {
								echo "<option value='$qr3[id]'>$qr3[name]</option>";option_sub_menu($qr3['id'],$qr['parent_id'],'');
							}
						}
						
					?>
					
					</select></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="<?php echo Access_Menu_tip; ?>"><?php echo Access_Level ?></td>
					<td><select name="level" >
					<?php
						$sql4 = $db->select(FDBPrefix.'user_group');
						while($qr4=mysql_fetch_array($sql4)){
							if($qr4['level']==$qr['level']){
								echo "<option value='$qr4[level]' selected>$qr4[group_name]</option>";}
								else {
									echo "<option value='$qr4[level]'>$qr4[group_name]</option>";}
						}
						if($qr['level']==99 or !$edit) $s="selected";else $s="";
						echo "<option value='99' $s>"._Public."</option>"
					?>
					</select></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col noborder">		
		<ul class="accordion"> 
			<?php 
				$menuId = $asset = $id ;
				
				define('menuParam',$menuId);
				if(file_exists($params)) require($params);
			?>				 
			<li>
				<h3>Page Configuration</h3>
				<div class="isi">
					<div class="acmain <?php if(!file_exists($params))echo "open"; ?>">
					<table class="data2">
						<tr>
							<td class="djudul tooltip " title="<?php echo Page_Title_tip; ?>"><?php echo Page_Title; ?></td>
							<td><input value="<?php echo $qr['title'] ; ?>" type="text" name="title" size="25"></td>
						</tr>
						<tr>
							<td class="djudul tooltip" title="<?php echo Show_title_tip; ?>" ><?php echo Show_title; ?></td>
							<td>
							<?php 
								if($show_title or $_GET['act'] =='add'){$s1="selected checked"; $s0 = "";}
								else {$s0="selected checked"; $s1= "";}
							?>
							<p class="switch">
								<input id="radio3" value="1" name="show_title" type="radio" <?php echo $s1;?> class="invisible">
								<input id="radio4" value="0" name="show_title" type="radio" <?php echo $s0;?> class="invisible">
								<label for="radio3" class="cb-enable <?php echo $s1;?>"><span>Yes</span></label>
								<label for="radio4" class="cb-disable <?php echo $s0;?>"><span>No</span></label>
							</p>
							</td>
						</tr>
						<tr>
							<td class="djudul tooltip " title="<?php echo Subtitle_tip; ?>"><?php echo Subtitle_Menu; ?></td>
							<td><input value="<?php echo $qr['sub_name'] ; ?>" type="text" name="sub_name" size="25"></td>
							</tr>							
						</table>
					</div>
				</div>
			</li>
			<li>
				<h3>Menu Styling</h3>
				<div class="isi">
					<div class="acmain">
					<table class="data2">
						<tr>
							<td class="djudul tooltip " title="<?php echo Add_css_class_tip; ?>">CSS Class</td>
							<td><input value="<?php echo $mod_class ; ?>" type="text" name="class" size="25" ></td>
						</tr>
						<tr>
							<td class="djudul tooltip " title="<?php echo Add_css_style_tip; ?>">CSS Style</td>
							<td><textarea type="text" name="style" rows="5" style="width: 90%; margin-left: 2px;"><?php echo $mod_style ; ?></textarea></td>
						</tr>
					</table>
					</div>
				</div>
			</li>				 				 
		</ul>
	</div>
</div>
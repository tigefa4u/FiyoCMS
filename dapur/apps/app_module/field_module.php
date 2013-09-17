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

$act = $_REQUEST['act'];

//set request id 
if(isset($_REQUEST['id']))
	$id=$_REQUEST['id'];
else 
	$id = null;
	
if(!isset($id)) {
	$_REQUEST['id'] = $id = 0;	
	$name = $_POST['folder'];
	$qr = null;
	$css_class = null;
	$css_style = null;
}
else {
	$sql = $db->select(FDBPrefix.'module','*','id='.$id); 
	$qr=mysql_fetch_array($sql);	
	$name = $qr['folder'];
	$css_class = $qr['class'];
	$css_style = $qr['style'];
}	


@include ("../modules/$name/mod_details.php");
$params = "../modules/$name/mod_params.php";
$editor = "../modules/$name/mod_editor.php";

//variabel module parameter
$param = $modParam = $qr['parameter'];
define('modParam',$qr['parameter']);

addJs("../plugins/jquery_ui/autocomplete.js");
?>
<script>
$().ready(function() {	
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
		
	$("#position").autocomplete("apps/app_module/controller/spot_position.php", {
		width: 100
  }); 
  
  $(".pop_up2").click(function() {
		$.ajax({
			url: "apps/app_module/controller/spot_position.php",
			data: "type=spot",
			success: function(data){
				$("#posspot #posspot_id").html(data);
			}
		});
	});		
});


function disableselections() {
	var e = document.getElementById('selections');
	e.disabled = true;
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
	e.options[i].disabled = true;
	e.options[i].selected = false;
	}
}

function enableselections() {
	var e = document.getElementById('selections');
	e.disabled = false;
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
	e.options[i].disabled = false;
		e.options[i].selected = true;
	}
}
</script>
<div class="cols">
	<div class="col first panin">
		<h3>Module Details</h3>
		<div class="isi">
			<table class="data2">
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Type_tip; ?>"><?php echo Module_Type; ?></td>
				<td><b><i><?php echo $module_name; echo " (id=$qr[id])" ; ?></i></b>
				<input type="hidden" name="mod_id" size="20" value="<?php echo $qr['id']; ?>">
				<input type="hidden" name="folder" size="20" value="<?php echo $name; ?>"></td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Title_tip; ?>"><?php echo Module_Title; ?> *</td>
				<td><input <?php   formRefill('title',$qr['name']) ; ?> type="text" name="title" size="20" required></td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Show_Title_tip; ?>"><?php echo Module_Show_Title; ?></td>
				<td>
					<?php 
					if($qr['show_title'] or $act == 'add'){$f1="selected checked"; $f0 = "";}
					else {$f0="selected checked"; $f1= "";}
					?>
					<p class="switch">
						<input id="radio1"  value="1" name="show_title" type="radio" <?php echo $f1;?> class="invisible">
						<input id="radio2"  value="0" name="show_title" type="radio" <?php echo $f0;?> class="invisible">
						<label for="radio1" class="cb-enable <?php echo $f1;?>"><span>Show</span></label>
						<label for="radio2" class="cb-disable <?php echo $f0;?>"><span>Hide</span></label>
					</p>
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Status_tip; ?>"><?php echo Active_Status; ?></td>
				<td><?php 
					if($qr['status'] or $act == 'add'){$f1="selected checked"; $f0 = "";}
					else {$f0="selected checked"; $f1= "";}
					?>
					<p class="switch">
						<input id="radio3"  value="1" name="status" type="radio" <?php echo $f1;?> class="invisible">
						<input id="radio4"  value="0" name="status" type="radio" <?php echo $f0;?> class="invisible">
						<label for="radio3" class="cb-enable <?php echo $f1;?>"><span>On</span></label>
						<label for="radio4" class="cb-disable <?php echo $f0;?>"><span>Off</span></label>
					</p></td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Position_tip; ?>"><?php echo Position; ?> *</td>
				<td><input value="<?php echo $qr['position'] ; ?>" type="text" size="13" name="position" id="position" required>
				<?php if(file_exists("../themes/".siteConfig('site_theme')."/spot_position.php")) : ?>
				<a class="popup pop_up2" href="#posspot" rel="width:637;height:500">Select Position</a>
				<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Order_tip; ?>"><?php echo Module_Order; ?></td>
				<td><input value="<?php echo $qr['short'] ; ?>" type="text" name="short" size="10" id="order" class="numeric"></td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Access_tip; ?>"><?php echo Access_Level; ?></td>
				<td><select name="level">
				<?php
					$db = new FQuery();  
					$db->connect(); 
					$sql = $db->select(FDBPrefix.'user_group');
					while($qrs=mysql_fetch_array($sql)){
						if($qrs['level']==$qr['level']){
							echo "<option value='$qrs[level]' selected>$qrs[group_name]</option>";}
						else {
							echo "<option value='$qrs[level]'>$qrs[group_name]</option>";
						}
					}
					if($qr[level]==99 or !$id) $s="selected";else $s="";
					echo "<option value='99' $s>"._Public."</option>"
				?>
				</select></td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo Module_Pages_tip; ?>"><?php echo Module_Pages; ?></td><td>
				<div style='padding: 1px 0 10px 0;'>
				<label class="reset">
				<input id="menus-select" type="radio" name="menus" onclick="enableselections();">Select All</input></label>
				<label class="reset"><input id="menus-all" type="radio" name="menus" onclick="disableselections();">Clear All</input></label>
				</div>
				<select name="page[]" id="selections" class="inputbox" size="15" multiple="multiple" style="height:160px; width:170px; font-size:10px; font-family:Arial ; ">
					<?php
						$sql2 = $db->select(FDBPrefix.'menu_category'); 
						while($qr2=mysql_fetch_array($sql2)){
						echo "<optgroup label='$qr2[title]'>";
							$sql3 = $db->select(FDBPrefix.'menu','*',"parent_id=0 AND category='$qr2[category]'",'short ASC'); 
							while($qr3=mysql_fetch_array($sql3)){
								$sel = multipleSelected($qr['page'],$qr3['id']);
								echo "<option value='$qr3[id]' $sel id='selections'>$qr3[name] </option>";
								option_sub_menu($qr3['id'],'','',$qr['page']);
							}
						echo "</optgroup>";
						}
					?>
					</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="col noborder">		
		<ul class="accordion">			  
			<!-- Load module parameters -->
				<?php 
					if(file_exists($params))require($params);
					else $open =' open';
				?>				 
				<!-- CSS Style --> 
				<li>
					<h3>Module Styling</h3>
					<div class="isi">
						<div class="acmain<?php echo @$open; ?>">
						<table class="data2">
							<tr>
								<td class="djudul tooltip " title="<?php echo Add_css_class_tip; ?>">CSS Class</td>
								<td><input value="<?php echo "$css_class" ; ?>" type="text" name="class" size="25"></td>
							</tr>
							<tr>
								<td class="djudul tooltip " title="<?php echo Add_css_style_tip; ?>">CSS Style</td>
								<td><textarea type="text" name="style" cols="23"><?php echo $css_style ; ?></textarea></td>
							</tr>
						</table>
						</div>
					</div>
				  </li>				 				 
			  </ul>			  
			  <!-- ACCORDION END -->				
		</div>		
	</div>
	<div class="cols">
		<?php 
			if(file_exists($editor)) require($editor);
		?>	
	</div>
	
	
<div class="popup_warp">
	<div id="posspot" class="pop_up" style="padding:10px">
		<div id="posspot_id">
		
		</div>
	</div>	
</div>
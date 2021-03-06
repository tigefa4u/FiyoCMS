<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$type 	= mod_param('type',modParam);
$item 	= mod_param('item',modParam);
$info 	= mod_param('info',modParam);
$other 	= mod_param('other',modParam);
$value 	= mod_param('value',modParam);
$filter = mod_param('filter',modParam);

if($item == "" or empty($item)) $item = 5;

if($type==1){$a1="selected";}
if($type==2){$a2="selected";}
if($type==3){$a3="selected";}

	$filter1 = $filter2 = $filter3 = "";
if($filter==1){
	$b1="selected"; $filter1 = "name='param3'"; $filter2 ="class='invisible'";
}
else if($filter==2){
	$b2="selected"; $filter2 = "name='param3'"; $filter1 ="class='invisible'";
} 
else {
	$b3="selected"; 
	$filter1 =	$filter2 = "class='invisible'";
	$filter3 ="class='invisible f3'";
}



/********* tooltip language *************/
if(siteConfig('lang') == 'id') {
	$orderTip	= "Urutan artikel berdasarkan <i>terbaru, ter-hits, featured</i>";
	$filterTip	= "Menampilkan artikel berdasarkan kategori atau penulis";
	$valueTip	= "Jenis untuk pilihan kategori atau penulis";
	$itemTip	= "Jumlah artikel yang ingin ditampilkan";
	$infoTip	= "Tampilkan informasi artikel";
	$otherTip	= "Tampilkan link lainya";
}
else {
	$orderTip 	= "Order articles by <i>newest, most hits, featured</i>";
	$filterTip	= "Featured articles by category or author";
	$valueTip 	= "Type for a category or option writer";
	$itemTip 	= "The number of articles you want to display";
	$InfoTip 	= "Show information articles";
	$otherTip 	= "Show other links";
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#type").change(function(){
		var tm = $("#type").val();	
		if(tm==1){
			$("#author").addClass("invisible");	
			$("#author").removeAttr("name");	
			$(".f3,#category").removeClass("invisible");
			$("#category").attr("name","param3");	
		}				
		else if(tm==2){	
			$(".f3,#author").removeClass("invisible");
			$("#category").addClass("invisible");
			$("#category").removeAttr("name");	
			$("#author").attr("name","param3");	
		}
		else {
			$(".f3").addClass("invisible");	
			$("#author").addClass("invisible");	
			$("#author").removeAttr("name");	
			$("#category").addClass("invisible");
		}
		
	});	
});
</script>
<script type="text/javascript">
$(document).ready( function(){ 
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
<input type="hidden" value="6" name="totalParam" />
<input type="hidden" name="nameParam1" value="type" />
<input type="hidden" name="nameParam2" value="filter" />
<input type="hidden" name="nameParam3" value="value" />
<input type="hidden" name="nameParam4" value="item" />
<input type="hidden" name="nameParam5" value="info" />
<input type="hidden" name="nameParam6" value="other" />
<li>
	<h3>Article List Configuration</h3>
	<div class="isi">
		<div class="acmain open">
			<table class="data2">				
			<tr>
				<td class="djudul tooltip" title="<?php echo $orderTip; ?>">Article Order</td>
				<td>	
					<select name='param1'>
						<option value="1" <?php echo @$a1;?>>Latest</option>
						<option value="2" <?php echo @$a2;?>>Hits</option>
						<option value="3" <?php echo @$a3;?>>Featured</option>
					</select>
				</td>
			</tr>			
			
			<tr>
				<td class="djudul tooltip" title='<?php echo $filterTip; ?>'>Article Filter</td>
				<td>
					<select name='param2' id='type'>
					<option value="1" <?php echo @$b1;?>>Category</option>
					<option value="2" <?php echo @$b2;?>>Author</option>
					<option value="0" <?php echo @$b3;?>>All</option>
					</select>
				</td>
			</tr>			
			<tr <?php echo $filter3; ?> class="f3" >
				<td class="djudul tooltip" title='<?php echo $valueTip; ?>'>Filter Value</td>
				<td>	
					<select id="category" <?php echo $filter1; ?>>
					<?php	
						$_GET['id']=0;
						$db = new FQuery();  
						$db->connect(); 
						$sql = $db->select(FDBPrefix.'article_category','*','parent_id=0'); 
						while($qrs=mysql_fetch_array($sql)){
							$s = multipleSelected($value,$qrs['id']);
							echo "$qr[category]<option value='$qrs[id]' $s>$qrs[name]</option>";
							option_sub_cat($qrs['id'],$value,'');
						}

						function option_sub_cat($parent_id,$cat,$pre) {
							$db = new FQuery();  
							$db ->connect(); 
							$sql=$db->select(FDBPrefix."article_category","*","parent_id=$parent_id AND id!=$parent_id"); 
							while($qr=mysql_fetch_array($sql)){	
								$s = multipleSelected($cat,$qr['id']);
								echo "<option value='$qr[id]' $s>$pre |_ $qr[name]</option>";
								option_sub_cat($qr['id'],$cat,$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
							}			
						}						
					?>
					</select>
					
					<!-- Author Selector -->
					<select id="author" <?php echo $filter2; ?> >
					<?php						
						$db = new FQuery();  
						$db->connect(); 						
						$sql2=$db->select(FDBPrefix.'article'); 
						while($qr2 = mysql_fetch_array($sql2)) {
							if($value==$qr2['id']) $s='selected'; else $s='';
							if(!isset($a) AND $a != $qr2['author_id']) {$a = $qr2['author_id']; 
							$an = oneQuery('user','id',$a,'name');
								echo "<option value='$a' $s>$an </option>";	
							}							
						}
						$sql3=$db->select(FDBPrefix.'article','*',"id=$id"); 
						$qr3 = mysql_fetch_array($sql3);
					?>
					</select>
				</td>
			</tr>	
			
			<tr>
				<td class="djudul tooltip" title='<?php echo $itemTip; ?>' >Item</td>
				<td>				
					<input type="text" value="<?php echo $item; ?>" name="param4" size="7" />
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo $infoTip; ?>">Information</td>
				<td>	
					<?php 
					if($info){$f1="selected checked"; $f0 = "";}
					else {$f0="selected checked"; $f1= "";}
					?>
					<p class="switch">
						<input id="par1" value="1" name="param5" type="radio" <?php echo $f1;?> class="invisible">
						<input id="par2" value="0" name="param5" type="radio" <?php echo $f0;?> class="invisible">
						<label for="par1" class="cb-enable <?php echo $f1;?>"><span>Show</span></label>
						<label for="par2" class="cb-disable <?php echo $f0;?>"><span>Hide</span></label>
					</p>
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip" title="<?php echo $otherTip; ?>">Other Link</td>
				<td>	
					<?php 
					if($other){$f1="selected checked"; $f0 = "";}
					else {$f0="selected checked"; $f1= "";}
					?>
					<p class="switch">
						<input id="par3"  value="1" name="param6" type="radio" <?php echo $f1;?> class="invisible">
						<input id="par4"  value="0" name="param6" type="radio" <?php echo $f0;?> class="invisible">
						<label for="par3" class="cb-enable <?php echo $f1;?>"><span>Show</span></label>
						<label for="par4" class="cb-disable <?php echo $f0;?>"><span>Hide</span></label>
					</p>
				</td>
			</tr>				
		</table>
					
		</div>	
	</div>	
</li>
<?php
/**
* @version		1.5.0
* @package		Related Article
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

$thumbW = mod_param('thumbW',modParam);
$thumbH = mod_param('thumbH',modParam);
$limit	= mod_param('limit',modParam);
$height = mod_param('height',modParam);
$filter = mod_param('filter',modParam);
$cat 	= mod_param('cat',modParam);
$showImg = mod_param('showImg',modParam);

if($filter=='title'){$b1="selected"; }
else if($filter=='tag'){$b2="selected"; }


if($showImg){ $swimg1="selected checked"; $swimg2 = "";}
else {$swimg2 ="selected checked"; $swimg1 = "";}

?>

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
<input type="hidden" value="7" name="totalParam"/>
<input type="hidden" value="cat" name="nameParam1"/>
<input type="hidden" value="filter" name="nameParam2"/>
<input type="hidden" value="limit" name="nameParam3"/>
<input type="hidden" value="height" name="nameParam4"/>
<input type="hidden" value="thumbW" name="nameParam5"/>
<input type="hidden" value="thumbH" name="nameParam6"/>
<input type="hidden" value="showImg" name="nameParam7"/>
<li>
<h3>Article Related Configutarion</h3>
<div class="isi">
	<div class="acmain open">
		<table class="data2">
		<tr>
				<td class="djudul">Category</td>
				<td>	
					<select name="param1[]" multiple style="height:160px; width:120px; font-size:11px; font-family:Arial ; ">
					<?php	
						$_GET['id']=0;
						$db = new FQuery();  
						$sql = $db->select(FDBPrefix.'article_category','*','parent_id=0'); 
						while($qrs=mysql_fetch_array($sql)){
							$s = multipleSelected($cat,$qrs['id']);
							echo "<option value='$qrs[id]' $s>$qrs[name]</option>";
							option_sub_cat($qrs['id'],$cat,'');
						}

						function option_sub_cat($parent_id,$cat,$pre) {
							$db = new FQuery();  
							$sql=$db->select(FDBPrefix."article_category","*","parent_id=$parent_id AND id!=$_REQUEST[id]"); 
							while($qr=mysql_fetch_array($sql)){	
								$s = multipleSelected($cat,$qr['id']);
								echo "<option value='$qr[id]' $s>$pre |_ $qr[name]</option>";
								option_sub_cat($qr['id'],$cat,$pre."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
							}			
						}						
					?>
					</select>
				</td>
			</tr>	
			<tr>
				<td class="djudul tooltip" title='<?php echo $filterTip; ?>'>Article Filter</td>
				<td>
					<select name='param2' id='type'>
					<option value="title" <?php echo @$b1;?>>Title</option>
					<option value="tag" <?php echo @$b2;?>>Tags</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="djudul tooltip">Limit Item</td>
				<td>
					<input value="<?php echo @$limit; ?>" name="param3" type="text" size="5" class='numeric'/>
				</td>
			</tr>
			
			<tr>
				<td class="djudul tooltip" title="Show gravatar image">Show Images</td>
				<td>	
					<p class="switch">
						<input id="radio21"  value="1" name="param7" type="radio" <?php echo $swimg1;?> class="invisible">
						<input id="radio22"  value="0" name="param7" type="radio" <?php echo $swimg2;?> class="invisible">
						<label for="radio21" class="cb-enable <?php echo $swimg1;?>"><span>Show</span></label>
						<label for="radio22" class="cb-disable <?php echo $swimg2;?>"><span>Hide</span></label>
					</p>
				</td>
			</tr>	
			
			<tr>
				<td class="djudul tooltip">Line Height</td>
				<td>
					<input value="<?php echo @$height; ?>" name="param4" type="text" size="5" class='numeric'/>px
				</td>
			</tr>
			
		
			
			<tr>
				<td class="djudul tooltip">Thumb Width</td>
				<td>
					<input value="<?php echo @$thumbW; ?>" name="param5" type="text" size="5" class='numeric'/>px
				</td>
			</tr>
			
			<tr>
				<td class="djudul tooltip" >Thumb Height</td>
				<td>
					<input value="<?php echo @$thumbH; ?>" name="param6" type="text" size="5" class='numeric'/>px
				</td>
			</tr>
			
			
		</table>
	</div>
</div>
</li>
<?php 
/**
* @version		1.5.0
* @package		Module Article Archive
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$cat	= mod_param('cat',modParam);
$end	= mod_param('end',modParam);
$start	= mod_param('start',modParam);
$type	= mod_param('type',modParam);

/********* tooltip language *************/
if(siteConfig('lang') == 'id') {
	$catTip 	= "Pilih kategori artikel yang akan ditampilkan";
	$endTip		= "Tentukan tanggal untuk membatasi tanggal akhir terbit artikel<br><i>kosongkan untuk tanggal otomatis</i>";
	$startTip	= "Tentukan tanggal untuk membatasi tanggal awal terbit artikel<br><i>kosongkan untuk tanggal otomatis</i>";
	$typeTip	= "Jenis tampilan modul arsip artikel";
}
else {
	$catTip = "Select a category of articles that will show";
	$endTip = "Specify dates to limit the date of the final published article <br><i>blank for automatic date</i>";
	$startTip = "Please specify the date for the start date published article limit <br><i>blank for automatic date</i>";
	$typeTip = "Type display module archive of articles";
}


if($type=='default'){$a1="selected";}
if($type=='category'){$a2="selected";}
?>

<input type="hidden" value="4" name="totalParam" />
<input type="hidden" value="start" name="nameParam1" />
<input type="hidden" value="end" name="nameParam2" />
<input type="hidden" value="cat" name="nameParam3" />
<input type="hidden" value="type" name="nameParam4" />
<li>
	<h3>Article Archive Configuration</h3>
	<div class="isi">
		<div class="acmain open">
			<table class="data2">	
			<tr>
				<td class="djudul tooltip" title="<?php echo $catTip ?>">Category</td>
				<td>	
					<select name="param3[]" multiple style="height:160px; min-width: 150px; max-width:100%; font-size:11px; font-family:Arial ; ">
					<?php	
						$_GET['id']=0;
						$db = new FQuery();  
						$db->connect(); 
						$sql = $db->select(FDBPrefix.'article_category','*','parent_id=0'); 
						while($qrs=mysql_fetch_array($sql)){
							$s = multipleSelected($cat,$qrs['id']);
							echo "<option value='$qrs[id]' $s>$qrs[name]</option>";
							option_sub_cat($qrs['id'],$cat,'');
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
				</td>
			</tr>				
			<tr>
				<td class="djudul tooltip" title="<?php echo $startTip ?>">Start Date</td>
				<td>	
					<input name="param1" size="16" type="date"  value="<?php echo $start; ?>" />
				</td>
			</tr>			
			
			<tr>
				<td class="djudul tooltip" title="<?php echo $endTip ?>">End Date</td>
				<td>	
					<input name="param2" size="16" type="date"  value="<?php echo $end; ?>"/>
				</td>
			</tr>	
			<tr>
				<td class="djudul tooltip" title="<?php echo $typeTip ?>">Order by</td>
				<td>	
					<select name='param4' id="type">
						<option value="default" <?php echo @$a1;?>>Date</option>
						<option value="category" <?php echo @$a2;?>>Category</option>
					</select>
				</td>
			</tr>
		</table>
					
		</div>	
	</div>	
</li>
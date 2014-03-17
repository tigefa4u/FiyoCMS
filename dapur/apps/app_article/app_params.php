<?php 
/**
* @name			Article
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$panel_format = menu_param('panel_format',menuParam);
$show_panel	= menu_param('show_panel',menuParam);
$show_rss	= menu_param('show_rss',menuParam);
$read_more  = menu_param('read_more',menuParam);
$per_page	= menu_param('per_page',menuParam);
$format		= menu_param('format',menuParam);
$intro		= menu_param('intro',menuParam);
$imgW		= menu_param('imgW',menuParam);
$imgH		= menu_param('imgH',menuParam);

if(!is_numeric($imgW) or empty($imgW)) $imgW = 120;
if(!is_numeric($imgH) or empty($imgH)) $imgH = 100;
if(!is_numeric($intro) or empty($intro)) $intro = 0;

$aId 	= link_param('id',$menuLink);
$view 	= link_param('view',$menuLink);

if($view=='archives') $view1='selected';
else if($view=='category') $view2='selected';
else if($view=='item') $view4='selected';
else $view3='selected';

if($format=='default') $format1='selected';
else if($format=='blog') $format2='selected';
else if($format=='list') $format3='selected';


if(!$per_page) $per_page=5;

?>
<script type="text/javascript">
$(document).ready(function(){
	var loading = $("#loading");
	loading.fadeOut();
	
	$("#type").change(function(){	
		var format = $("#format").val();
		var view = $("#view").val();
		var type = $("#type").val();
		var cate = $("#cat").val();
		
		if(type == 'featured' || type == 'category' || type == 'archives'){	
			$(".image").removeClass("invisible");	
			$(".intro").removeClass("invisible");	
			$(".per_page").removeClass("invisible");			
			$(".format").removeClass("invisible");	
			$(".category").addClass("invisible");	
			$(".image").addClass("invisible");	
			$(".intro").addClass("invisible");	
			$(".item").addClass("invisible");
			
			if(format == 'blog') 				
				$(".image").removeClass("invisible");	
			else 
				$(".image").addClass("invisible");
			
			if(format == 'default') 				
				$(".intro").removeClass("invisible");	
			else 
				$(".intro").addClass("invisible");
				
			if(type == 'category') {
				$("#link").val("?app=article&view="+type+"&id="+cate);
				$(".category").removeClass("invisible");	
			}
			else
				$("#link").val("?app=article&view="+type);
					
		}
		else if(type =='item') {			
			$("#pg").val("");				
			$("#link").val("");			
			$(".image").addClass("invisible");	
			$(".format").addClass("invisible");	
			$(".category").addClass("invisible");	
			$(".per_page").addClass("invisible");		
			$(".item").removeClass("invisible");	
		}		
	});
	
				
	$("#format").change(function(){	
		var cate = $('#cat').val();				
		var type = $("#type").val();
		var format = $("#format").val();
		if(format == 'blog') 				
			$(".image").removeClass("invisible");	
		else 
			$(".image").addClass("invisible");	
			
		if(format == 'default') 				
			$(".intro").removeClass("invisible");	
		else 
			$(".intro").addClass("invisible");
				
		
		if(type == 'category') {
			$("#link").val("?app=article&view="+type+"&id="+cate);
			$(".category").removeClass("invisible");	
		}
		else
			$("#link").val("?app=article&view="+type);
			
	});
	
	$("#cat").change(function(){
		var format = $("#format").val();
		var type = $("#type").val();
		var cate = $("#cat").val();
		
		$("#link").val("?app=article&view="+type+"&id="+cate);
	});
				
	var type = $("#type").val();
	if(type == 'item'){		
		$(".per_page").addClass("invisible");
		$(".item").removeClass("invisible");
	} else {	
		$(".format").removeClass("invisible");	
		if(type == 'category')
		$(".category").removeClass("invisible");	
		var format = $("#format").val();
		if(format == 'blog') 
			$(".image").removeClass("invisible");	
		if(format == 'default') 				
			$(".intro").removeClass("invisible");	
				
	}
  
  	$(".pop_up2").click(function() {
		$.ajax({
			url: "apps/app_article/controller/article_menu.php",
			data: "access",
			success: function(data){
				$("#pages #page_id").html(data);
			}
		});
	});	
});
</script>
<input type="hidden" name="totalParam" value="9"/>
<input type="hidden" name="nameParam1" value="per_page" />
<input type="hidden" name="nameParam2" value="show_panel" />
<input type="hidden" name="nameParam3" value="read_more" />
<input type="hidden" name="nameParam4" value="imgW" />
<input type="hidden" name="nameParam5" value="imgH" />
<input type="hidden" name="nameParam6" value="format" />
<input type="hidden" name="nameParam7" value="intro" />
<input type="hidden" name="nameParam8" value="panel_format" />
<input type="hidden" name="nameParam9" value="show_rss" />
				
<li>
	<h3>Menu Article</h3>
	<div class="isi">
		<div class="acmain open">
			<table class="data2">				
			<!-- Menampilkan menu menurut kategori pilihan -->	
			<tr>
				<td class="djudul">Page Type</td>
				<td>
					<select id="type">
						<option value='archives' <?php echo @$view1;?>>Archives</option>
						<option value='category' <?php echo @$view2;?>>Category</option>
						<option value='featured' <?php echo @$view3;?>>Featured</option>
						<option value='item' <?php echo @$view4;?>>Single Article</option>
					</select>
				</td>
			</tr>
			<!-- Tipe tampilan menu -->
			<tr class="format invisible">
				<td class="djudul">Format Style</td>
				<td>
					<select id="format" name="param6">
						<option value='default' <?php echo @$format1;?>>Default</option>
						<option value='blog' <?php echo @$format2;?>>Blog</option>
						<option value='list' <?php echo @$format3;?>>List</option>
					</select>
				</td>
			</tr>	
			<!-- Tipe tampilan menu -->
			<tr class="category invisible">
				<td class="djudul">Category</td>
				<td>
					<select id="cat">
					<?php		
						$db = new FQuery();  
						$db->connect(); 
						$sql = $db->select(FDBPrefix.'article_category','*','parent_id=0'); 
						while($qrs=mysql_fetch_array($sql)){
							if("?app=article&view=category&id=$qrs[id]"== $qr['link'])$s="selected";else$s="";
							echo "<option value='$qrs[id]' $s>$qrs[name]</option>";
							option_sub_cat($qrs['id'],'',$qr['link']);
						}	
					?>
					</select>
				</td>
			</tr>	
	
					
			<tr class="item invisible" >
				<td class="djudul">Article</td>
				<td>
					<input type="hidden" value="?app=article&view=item&id=<?php echo $id; ?>" id="pgs" size="20" readonly /> 
					<input type="text" value="<?php echo oneQuery('article','id',$aId,'title'); ?>" id="pg" size="20" style="width: 70%" required readonly /> 
					<a class="popup pop_up2" href="#pages" rel="width:940;height:400" style="margin-right:-20px; margin-left:5px">Select</a>
			</tr>		
			<tr class="image invisible" >
				<td class="djudul">Images Width</td>
				<td>
					<input type="text" name="param4" value="<?php echo $imgW; ?>" id="imgW" size="3" />px
					</td>
				</td>
			</tr>
			<tr class="image invisible">
				<td class="djudul">Images Height</td>
				<td>
					<input type="text" name="param5" value="<?php echo $imgH; ?>" id="imgH" size="3" />px
					</td>
			</tr>	
			
			<!-- Tipe tampilan menu -->
			<tr class="per_page">
				<td class="djudul">Article per-page</td>
				<td>
					<input type="text" name="param1" value="<?php echo $per_page; ?>"size="3" />
				</td>
			</tr>
			<tr class="intro invisible">
				<td class="djudul">Intro Item(s)</td>
				<td>
					<input type="text" name="param7" value="<?php echo $intro; ?>"  size="3" />
					</td>
			</tr>
			<tr class="per_page">
				<td class="djudul">Show RSS Icon</td>
				<td>	
					<?php 
							if($show_rss){$f1="selected checked"; $f0 = "";}
							else {$f0="selected checked"; $f1= "";}
						?>
						<p class="switch">
							<input id="articlePanel2"  value="1" name="param9" type="radio" <?php echo $f1;?> class="invisible">
							<input id="articlePane11"  value="0" name="param9" type="radio" <?php echo $f0;?> class="invisible">
							<label for="articlePanel2" class="cb-enable <?php echo $f1;?>"><span>Yes</span></label>
							<label for="articlePane11" class="cb-disable <?php echo $f0;?>"><span>No</span></label>
						</p>
				</td>
			</tr>
		
			
			<tr class="show_panel">
				<td class="djudul">Show Panel</td>
				<td>	
					<?php 
							if($show_panel){$f1="selected checked"; $f0 = "";}
							else {$f0="selected checked"; $f1= "";}
						?>
						<p class="switch">
							<input id="articlePanel"  value="1" name="param2" type="radio" <?php echo $f1;?> class="invisible">
							<input id="articlePanel0"  value="0" name="param2" type="radio" <?php echo $f0;?> class="invisible">
							<label for="articlePanel" class="cb-enable <?php echo $f1;?>"><span>Yes</span></label>
							<label for="articlePanel0" class="cb-disable <?php echo $f0;?>"><span>No</span></label>
						</p>
				</td>
			</tr>
			
			<tr class="per_page">
				<td class="djudul tooltip" title="%a = Author, %c = Category<br>%d = Day, %f = Day(1-31)<br>%m = Month, %n = Month(1-12)<br>%Y = Year(2), %y = Year(2)<br>%H = Hour(12), %h = Hour(24)<br>%i = Minutes, %s = Seconds<br>%p = AM / PM<br><hr>default : '<b>by %a on %f %m %y in %c</b>'">Panel Format</td>
				<td>
					<input type="text" name="param8" value="<?php echo $panel_format; ?>" style="width:70%" />
				</td>
			</tr>	
			<tr class="per_page">
				<td class="djudul">Read More</td>
				<td>
					<input type="text" name="param3" value="<?php echo $read_more; ?>" style="width:70%"/>
				</td>
			</tr>	
		</table>
		</div>
	</div>
</li>


<div class="popup_warp">
	<div id="pages" class="pop_up" style="padding:10px">
		<div id="page_id">	
		
		</div>
	</div>	
</div>


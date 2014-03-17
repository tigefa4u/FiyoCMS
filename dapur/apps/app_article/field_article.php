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

//set request id 
if(isset($_REQUEST['id']))
	$id=$_REQUEST['id'];
else
	$id = null;
if(!isset($id)) {
	$_REQUEST['id']=0;	
	$qr = null;
	$new =1;
}
else {
	$sq = $db->select(FDBPrefix.'article','*','id='.$id);  
	$qr = @mysql_fetch_array($sq);
}	
$article = $qr['article'];
if(checkLocalhost()) {
	$article = str_replace("media/",FLocal."media/",$article);			
}
addJs ("../plugins/plg_jquery_ui/ui.slider.js");
addCss("../plugins/plg_jquery_ui/base/ui.all.css");
addJs ("../plugins/plg_jquery_ui/ui.core.js");
addJs ("../plugins/plg_jquery_ui/ui.datepicker.js");
addJs ("../plugins/plg_jquery_ui/ui.timepicker.js");
addJs ("../plugins/plg_ckeditor/ckeditor.js");
addJs ("apps/app_article/controller/jquery.tagsinput.min.js");
addCSS("apps/app_article/controller/jquery.tagsinput.css");
?>
<script type="text/javascript">
	$(function() {
		$("#datepicker").datetimepicker({ 
			showSecond: true,
			timeFormat: 'HH:mm:ss',
			dateFormat: 'yy-mm-dd'
		});
		$("#tags").tagsInput();
		$(".reset").click(function(){
			$("#hits").html("0");	
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
	<div class="col first panin"  style="width: 70%;">			
		<div class="isi">				
			<table class="data2">				
				<tr>
					<td class="djudul tooltip" title="<?php echo Article_Title; ?>" style="width:10%"><?php echo Title; ?> *</td>
					<td><input value="<?php echo $qr['id'];?>" type="hidden" name="id"><input <?php formRefill('title',$qr['title']);?> type="text" name="title" size="43" style="width:100%" required></td>
					<td class="djudul tooltip" title="<?php echo Article_category; ?>"><?php echo Category; ?></td>
					<td><select name="cat">
					<?php	
						$_GET['id']=0;
						$db = new FQuery();  
						$db->connect(); 
						$sql = $db->select(FDBPrefix.'article_category','*','parent_id=0'); 
						while($qrs=mysql_fetch_array($sql)){
							if($qrs['level'] >= $_SESSION['USER_LEVEL'] ){
								if($qr['category']==$qrs['id'])$s="selected";else$s="";
								echo "<option value='$qrs[id]' $s>$qrs[name]</option>";
								option_sub_cat($qrs['id'],'');
							}
						}						
					?>
					</select>
					</td>
				</tr>
				
				<tr>
					<td class="djudul tooltip" title="<?php echo Tags_tip; ?>"  style="min-width: 35px;">Tags</td>
					<td>
						<input <?php formRefill('tags',$qr['tag']);?> type="text" name="tags" id="tags" size="38">
					</td>	
					<td class="djudul tooltip" title="<?php echo Featured_tip; ?>"><?php echo Featured; ?></td>
					<td style="width:20%;padding: 9px 6px;	vertical-align:top !important;">
						<?php 
							if($qr['featured']){$f1="selected checked"; $f0 = "";}
							else {$f0="selected checked"; $f1= "";}
						?>
						<p class="switch">
							<input id="radio17"  value="1" name="featured" type="radio" <?php echo $f1;?> class="invisible">
							<input id="radio18"  value="0" name="featured" type="radio" <?php echo $f0;?> class="invisible">
							<label for="radio17" class="cb-enable <?php echo $f1;?>"><span>Yes</span></label>
							<label for="radio18" class="cb-disable <?php echo $f0;?>"><span>No</span></label>
						</p>
					</td>
				</tr>
				<tr>
				<td colspan="4" style="padding:10px 0 0; margin-right:-20px">
					<textarea class="ckeditor" id="editor" name="editor"  rows="30" cols="90"><?php formRefill('editor',htmlentities($article),'textarea'); ?></textarea>

				</td>	
			
			</table>
			</div>
		</div>
		
 
		<div class="col noborder" style="width: 29.7%;">		
			<ul class="accordion"> 				 
				<li>
					<h3>Article Information</h3>
					<div class="isi">
						<div class="acmain open">
						<table class="data2">	
							<tr>
								<td class="djudul tooltip" title="<?php echo Hits; ?>"><?php echo Hits; ?></td>
								<td><span id="hits"><?php echo $qr['hits']; ?></span>
								<input name="viewed" type="hidden" value="<?php echo $qr['hits']; ?>"/> <label class="reset tooltip" title="<?php echo Hits_Reset; ?>"><input type="radio" value="1" name="hits_reset">Reset</label></td>
							</tr>
							<tr>
								<td class="djudul tooltip" title="<?php echo Author_tip; ?>"><div style ='width: 80px !important;'><?php echo Author; ?></div></td>
								<td><input name="author" size="15" type="text"  value="<?php echo $qr['author']; ?>"/></td>
							</tr>
							
							<tr>
								<td class="djudul tooltip" title="<?php echo Article_level_tip; ?>" style="width:30%"><?php echo Access_Level; ?></td>
								<td><select name="level" >
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
									if($qr['level']==99 or !$qr[level]) $s="selected"; else $s="";
									echo "<option value='99' $s>"._Public."</option>"
								?>
								</select></td>
							</tr>
							<tr>
								<td class="djudul tooltip" title="<?php echo Date_tip; ?>"><?php echo Date; ?></td>
								<td><input name="date"  id="datepicker" size="17" type="datetime"  value="<?php if($qr['date']) echo $qr['date']; else echo date("Y-m-d H:i:t"); ?>"/></td>
							</tr>
							
							<tr>
								<td class="djudul tooltip" title="<?php echo Last_Updated_tip; ?>"><?php echo Last_Updated; ?></td>
								<td><?php if($qr['updated']) echo $qr['updated']; else echo date("Y-m-d H:i:t"); ?></td>
							</tr>
							<tr>
								<td class="djudul tooltip" title="<?php echo Editor_tip; ?>"><?php echo Editor; ?></td>
								<td><?php if(!empty($qr['editor'])) echo oneQuery("user","id",$qr['editor'],"name"); else echo "None"; ?></td>
							</tr>
							<tr>
								<td class="djudul tooltip" title="<?php echo Active_Status; ?>"><?php echo Active_Status; ?></td>
								<td>
								<?php 
								if($qr['status'] or $_GET['act'] == 'add'){$status1="selected checked"; $status0 = "";}
								else {$status0="selected checked"; $status1= "";}
								?>
								<p class="switch">
									<input id="radio15"  value="1" name="status" type="radio" <?php echo $status1;?> class="invisible">
									<input id="radio16"  value="0" name="status" type="radio" <?php echo $status0;?> class="invisible">
									<label for="radio15" class="cb-enable <?php echo $status1;?>"><span>On</span></label>
									<label for="radio16" class="cb-disable <?php echo $status0;?>"><span>Off</span></label>
								</p>
								</td>
							</tr>
						</table>
						</div>
					</div>
				</li>
			<input type="hidden" name="totalparam" value="10"/>
			<input type="hidden" name="nameParam1" value="show_comment" />
			<input type="hidden" name="nameParam2" value="show_author" />
			<input type="hidden" name="nameParam3" value="show_date" />
			<input type="hidden" name="nameParam4" value="show_category" />
			<input type="hidden" name="nameParam5" value="show_tags" />
			<input type="hidden" name="nameParam6" value="show_hits" />
			<input type="hidden" name="nameParam7" value="show_rate" />
			<input type="hidden" name="nameParam8" value="rate_value" />
			<input type="hidden" name="nameParam9" value="rate_counter" />
			<input type="hidden" name="nameParam10" value="show_panel" />
			
			<?php
			
				$show_commt	 = mod_param('comment',$qr['parameter']);
				$show_panel  = mod_param('show_panel',$qr['parameter']);
				$show_author = mod_param('show_author',$qr['parameter']);
				$show_date   = mod_param('show_date',$qr['parameter']);
				$show_cate	 = mod_param('show_category',$qr['parameter']);
				$show_hits   = mod_param('show_hits',$qr['parameter']);
				$show_tags   = mod_param('show_tags',$qr['parameter']);
				$show_rate	 = mod_param('show_rate',$qr['parameter']);
				$rate_value	 = mod_param('rate_value',$qr['parameter']);
				$rate_counter= mod_param('rate_counter',$qr['parameter']);
				if(!$show_commt)	$param1 = true;
				if(!$show_author)  	$param2 = true;
				if(!$show_date) 	$param3 = true;
				if(!$show_cate) 	$param4 = true;
				if(!$show_tags) 	$param5 = true;
				if(!$show_hits) 	$param6 = true;
				if(!$show_rate) 	$param7 = true;
				if(!$show_panel) 	$param10 = true;
				
				if(!is_numeric($rate_value) or empty($rate_value)) $rate_value=0;			
				if(!is_numeric($rate_value) or empty($rate_counter)) $rate_counter=0;	
				
				if(!isset($param1) or isset($new)){$enpar1="selected checked"; $dispar1 = "";}
				else {$dispar1="selected checked"; $enpar1= "";}

				if(!isset($param2) or isset($new)){$enpar2="selected checked"; $dispar2 = "";}
				else {$dispar2="selected checked"; $enpar2= "";}

				if(!isset($param3) or isset($new)){$enpar3="selected checked"; $dispar3 = "";}
				else {$dispar3="selected checked"; $enpar3= "";}

				if(!isset($param4) or isset($new)){$enpar4="selected checked"; $dispar4 = "";}
				else {$dispar4="selected checked"; $enpar4= "";}

				if(!isset($param5) or isset($new)){$enpar5="selected checked"; $dispar5 = "";}
				else {$dispar5="selected checked"; $enpar5= "";}
				
				if(!isset($param6) or isset($new)){$enpar6="selected checked"; $dispar6 = "";}
				else {$dispar6="selected checked"; $enpar6= "";}

				if(!isset($param7) or isset($new)){$enpar7="selected checked"; $dispar7 = "";}
				else {$dispar7="selected checked"; $enpar7= "";}
				
				if(!isset($param10) or isset($new)){$enpar10="selected checked"; $dispar10 = "";}
				else {$dispar10="selected checked"; $enpar10= "";}
			
			
			?>	
			<li>
				<h3>Article Parameter</h3>
				<div class="isi">
					<div class="acmain">
						<table class="data2">				
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Panel; ?></td>
							<td>
								<p class="switch">
									<input id="radio21"  value="1" name="param10" type="radio" <?php echo $enpar10;?> class="invisible">
									<input id="radio22"  value="0" name="param10" type="radio" <?php echo $dispar10;?> class="invisible">
									<label for="radio21" class="cb-enable <?php echo $enpar10;?>"><span>Show</span></label>
									<label for="radio22" class="cb-disable <?php echo $dispar10;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>								
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Author; ?></td>
							<td>
								<p class="switch">
									<input id="radio1"  value="1" name="param2" type="radio" <?php echo $enpar2;?> class="invisible">
									<input id="radio2"  value="0" name="param2" type="radio" <?php echo $dispar2;?> class="invisible">
									<label for="radio1" class="cb-enable <?php echo $enpar2;?>"><span>Show</span></label>
									<label for="radio2" class="cb-disable <?php echo $dispar2;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>
																
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Date; ?></td>
							<td>	
								<p class="switch">
									<input id="radio3"  value="1" name="param3" type="radio" <?php echo $enpar3;?> class="invisible">
									<input id="radio4"  value="0" name="param3" type="radio" <?php echo $dispar3;?> class="invisible">
									<label for="radio3" class="cb-enable <?php echo $enpar3;?>"><span>Show</span></label>
									<label for="radio4" class="cb-disable <?php echo $dispar3;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>

						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Category; ?></td>
							<td>	
								<p class="switch">
									<input id="radio5"  value="1" name="param4" type="radio" <?php echo $enpar4;?> class="invisible">
									<input id="radio6"  value="0" name="param4" type="radio" <?php echo $dispar4;?> class="invisible">
									<label for="radio5" class="cb-enable <?php echo $enpar4;?>"><span>Show</span></label>
									<label for="radio6" class="cb-disable <?php echo $dispar4;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>
						
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Tags; ?></td>
							<td>	
								<p class="switch">
									<input id="radio7"  value="1" name="param5" type="radio" <?php echo $enpar5;?> class="invisible">
									<input id="radio8"  value="0" name="param5" type="radio" <?php echo $dispar5;?> class="invisible">
									<label for="radio7" class="cb-enable <?php echo $enpar5;?>"><span>Show</span></label>
									<label for="radio8" class="cb-disable <?php echo $dispar5;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>	
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Rate; ?></td>
							<td>	
								<p class="switch">
									<input id="radio9"  value="1" name="param7" type="radio" <?php echo $enpar7;?> class="invisible">
									<input id="radio10"  value="0" name="param7" type="radio" <?php echo $dispar7;?> class="invisible">
									<label for="radio9" class="cb-enable <?php echo $enpar7;?>"><span>Show</span></label>
									<label for="radio10" class="cb-disable <?php echo $dispar7;?>"><span>Hide</span></label>
								</p>
								<input type="hidden" name="param8" value="<?php echo @$rate_value; ?>">
								<input type="hidden" name="param9" value="<?php echo @$rate_counter; ?>">
							</td>
						</tr>					
						<tr>
							<td class="djudul" id="article_sum"><?php echo Show_Hits; ?></td>
							<td>	
								<p class="switch">
									<input id="radio13"  value="1" name="param6" type="radio" <?php echo $enpar6;?> class="invisible">
									<input id="radio14"  value="0" name="param6" type="radio" <?php echo $dispar6;?> class="invisible">
									<label for="radio13" class="cb-enable <?php echo $enpar6;?>"><span>Show</span></label>
									<label for="radio14" class="cb-disable <?php echo $dispar6;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>
						<tr>
							<td class="djudul"><div><?php echo Show_Comment; ?></div></td>
							<td>
								<p class="switch">
									<input id="radio11"  value="1" name="param1" type="radio" <?php echo $enpar1;?> class="invisible">
									<input id="radio12"  value="0" name="param1" type="radio" <?php echo $dispar1;?> class="invisible">
									<label for="radio11" class="cb-enable <?php echo $enpar1;?>"><span>Show</span></label>
									<label for="radio12" class="cb-disable <?php echo $dispar1;?>"><span>Hide</span></label>
								</p>
							</td>
						</tr>		
					</table>
					</div>
				</div>
			</li>
				  
			<!-- CSS Style --> 
			<li>
				<h3>Article Meta</h3>
				<div class="isi">
					<div class="acmain">
					<table class="data2">
						<tr>
							<td class="djudul tooltip " title="<?php echo Keywords_tip; ?>"><?php echo Keyword; ?></td>
							<td><textarea rows="3" cols="19" type="text" name="keyword" style="min-width:95%"><?php formRefill('keyword',$qr['keyword'],'textarea'); ?></textarea></td>
						</tr>							
						<tr>
							<td class="djudul tooltip " title="<?php echo Meta_Desc_tip; ?>"><?php echo Description; ?></td>
							<td><textarea rows="5" cols="19" type="text" name="desc" style=" min-width: 95%;"><?php formRefill('description',$qr['description'],'textarea'); ?></textarea></td>
						</tr>
					</table>
					</div>
				</div>
			</li>				 				 
		</ul>
	</div>
</div>	
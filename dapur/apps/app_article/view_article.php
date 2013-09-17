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
$db->connect(); 			
?>	
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {			
		$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', true);
			var id = $('#id',parent).attr('value');
			var type = $('#type',parent).attr('value');
			
			$.ajax({
				url: "apps/app_article/controller/article_status.php",
				data: type+"=1&id="+id,
				success: function(data){
				$("#stat").html(data);
				var loadings = $("#stat");
				loadings.hide();
				loadings.fadeIn();	
				setTimeout(function(){
					$('#stat').fadeOut(1000, function() {
					});				
				}, 3000);
				}
			});
		});
		
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', false);
			var id = $('#id',parent).attr('value');
			var type = $('#type',parent).attr('value');
			
			$.ajax({
				url: "apps/app_article/controller/article_status.php",
				data: type+"=0&id="+id,
				success: function(data){
				$("#stat").html(data);
				var loadings = $("#stat");
				loadings.hide();
				loadings.fadeIn();	
				setTimeout(function(){
					$('#stat').fadeOut(1000, function() {
					});				
				}, 3000);
				
				}
			});
		});
	
	
		oTable = $('table').dataTable({			
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",	
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null, null, null ,null ]	
		});		
		
		$('#checkall').click(function(){
		    $(this).parents('form:eq(0)').find(':checkbox').attr('checked', this.checked);
		});
		
		$("#form").submit(function(e){
		if (!confirm("<?php echo Sure_want_delete; ?>"))
			{
				e.preventDefault();
				return;
			} 
		});
	});

</script>
<div id="stat"></div>
<form method="post" id="form">
	<div id="app_header">
		<div class="warp_app_header">		
		  <div class="app_title"><?php echo Article_Manager; ?></div>
		  <div class="app_link">			
			<a class="lbt add tooltip link" Value="Create" href="?app=article&act=add" title="<?php echo Add_new_article; ?>"></a>
			<input type="submit" class="lbt delete tooltip" title="<?php echo Delete; ?>" value="<?php echo Delete; ?>" value="ok" name="delete"/>	
			<hr class="lbt sparator tooltip">
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>">Help</a>	
			<div id="helper"><?php echo Article_help; ?></div>
		  </div> 	
		</div>
	</div>	
	<table class="data">
		<thead>
			<tr>							
				<th style="width:1% !important;" class="no">#</th>	
				<th style="width:3% !important;" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>		
				<th style="width:30% !important;"><?php echo Article_Title; ?></th>
				<th style="width:8% !important;" class="no" align="center"><?php echo Featured; ?></th>
				<th style="width:8.5% !important;" class="no" align="center">Status</th>
				<th style="width:14% !important;"><?php echo Category; ?></th>
				<th style="width:10% !important;"><?php echo Author; ?></th>
				<th style="width:14% !important;" ><?php echo Date; ?></th>
				<th style="width:3% !important;">Hits</th>
			</tr>
		</thead>		
		<tbody>
			<?php
			if(isset($_REQUEST['cat'])) 
				$cat = "category=".$_REQUEST['cat'];
			else
				$cat = $_REQUEST['cat'] = null;
				
				$sql = $db->select(FDBPrefix."article","*,DATE_FORMAT(date,'%Y-%m-%d <i>%H:%i:%s</i>') as date","$cat",'date DESC'); 
			$no = 1;
			
			while($qr=@mysql_fetch_array($sql)) {
				if(isset($cat)) $wcat = "&cat=$_REQUEST[cat]"; else $wcat = null;
				$sql2 = $db->select(FDBPrefix."article_category","name","id=$qr[category]"); 
				$category = mysql_fetch_array($sql2);
				$category = $category['name'];
				$aut = userInfo('user',$qr['author_id']); 
					$author = $aut;
				if(!empty($qr['author'])) 
					$author=$qr['author'];
					
				if($qr['author_id'] == 0)
					$author="<span title='Original by Null' class='tooltip'>Anonymous</span>";
				else
					$author="<span title='Original by $aut' class='tooltip'>$author</span>";
					
				/* logika status aktif atau tidak */
				if($qr['status']==1)
				{ $stat1 ="selected"; $stat2 ="";}							
				else
				{ $stat2 ="selected";$stat1 ="";}
				
				/* logika frontpages */
				if($qr['featured']==1)
				{ $fp1 ="selected"; $fp2 ="";}							
				else
				{ $fp2 ="selected";$fp1 ="";}
				
							
							
				$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=article&act=edit&id=$qr[id]'>$qr[title]</a>";
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
				
				
				if($_SESSION['USER_LEVEL'] != 1 AND $_SESSION['USER_ID'] != $qr['author_id'] AND $qr['author_id'] != 0) {
					$name ="$qr[title]";
					$checkbox = "<span class='icon lock'></lock>";
					
					$status ="
					<label class='cs-enable $stat1'><span>On</span></label>
					<label class='cs-disable $stat2'><span>Off</span></label>";
					
					$featured ="
					<label class='cs-enable $fp1'><span>On</span></label>
					<label class='cs-disable $fp2'><span>Off</span></label>";
				
				}
					else {		

					$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=article&act=edit&id=$qr[id]'>$qr[title]</a>";					
					$status ="
						<p class='switch'>
							<label class='cb-enable $stat1'><span>On</span></label>
							<label class='cb-disable $stat2'><span>Off</span></label>
							<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
							<span class='load'>Loading...</span>
						</p>";
					$featured ="
						<p class='switch'>
							<label class='cb-enable $fp1'><span>Yes</span></label>
							<label class='cb-disable $fp2'><span>No</span></label>
							<input type='text' value='$qr[id]'  class='invisible' id='id'><input type='text' value='fp' id='type' class='invisible'>
							<span class='load'>Loading...</span>
						</p>";
					
					}
				
							
							
				echo "<tr><td>$no</td><td align='center'>$checkbox</td><td>$name</td><td align='center'>$featured</td><td  align='center'>$status</td><td>$category</td><td>$author</td><td>$qr[date]</td><td align='center'>$qr[hits]</td></tr>";
				$no++;	
			}					
			?>				
        </tbody>			
	</table>
</form>
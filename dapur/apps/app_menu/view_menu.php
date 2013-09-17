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
				url: "apps/app_menu/controller/status.php",
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
				url: "apps/app_menu/controller/status.php",
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
		
		
		$(".homes").click(function(){
			var parent = $(this).parents('.switch');
			$('.home').addClass('invisible');
			$('.homes').removeClass('invisible');
			$('.home',parent).removeClass('invisible');
			$('.homes',parent).addClass('invisible');
			var id = $('#id',parent).attr('value');
			var type = $('#type',parent).attr('value');
			
			$.ajax({
				url: "apps/app_menu/controller/status.php",
				data: "home=1&id="+id,
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
		
		
		
		$(".star").click(function(){
			var parent = $(this).parents('.switch');
			$('.default').addClass('invisible');
			$('.star').removeClass('invisible');
			$('.default',parent).removeClass('invisible');
			$('.star',parent).addClass('invisible');
			var id = $('#id',parent).attr('value');
			var type = $('#type',parent).attr('value');
			
			$.ajax({
				url: "apps/app_menu/controller/status.php",
				data: "default=1&id="+id,
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
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null, null, null, null, null ]	
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
		  <div class="app_title">Menu Manager</div>
		  <div class="app_link">			
			<a class="lbt add link tooltip" href="?app=menu&act=add" title="<?php echo Add_New_Menu; ?>"></a>
			<input type="submit" class="lbt delete tooltip" title="<?php echo Delete; ?>" value="ok" name="delete"/>	
			<hr class="lbt sparator tooltip">
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>	
			<div id="helper"><?php echo Menu_help; ?></div>
		  </div> 	
		</div>
	</div>
	<table class="data">
		<thead>
			<tr>								  
				<th width="3%" class="no">#</th>	
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>		
				<th style="width:30% !important;"><?php echo Name; ?></th>
				<th width="3%" class="no" align="center">Home</th>
				<th width="3%" class="no" align="center">Default</th>
				<th style="width:10% !important;" class="no" align="center">Status</th>
				<th style="width:30% !important;" ><?php echo Category; ?></th>
				<th width="3%" ><?php echo Short; ?></th>
				<th width="3%" ><?php echo Type; ?></th>
				<th width="3%">ID</th>
			</tr>
		</thead>		
		<tbody>
			<?php			
			//start query to get home page value.
			$cat_default = oneQuery('menu','home',1,'category');
			
			if(isset($_REQUEST['cat'])) {
				$cat = $_REQUEST['cat'];
				$sql = $db->select(FDBPrefix.'menu','*',"parent_id=0 AND category='$cat'","short ASC");					
				}
			else {
				$cat = $_REQUEST['cat'] = null;				 				
				$sql = $db->select(FDBPrefix.'menu','*',"parent_id=0 AND category='$cat_default'","short ASC");		
			}
			$no=1;				
			while($qr=mysql_fetch_array($sql)){
				/* auto change status menu */
				if($qr['status']==1)
				{ $stat1 ="selected"; $stat2 ="";}							
				else
				{ $stat2 ="selected";$stat1 ="";}				
				$status ="
				<p class='switch'>
					<label class='cb-enable $stat1'><span>On</span></label>
					<label class='cb-disable $stat2'><span>Off</span></label>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
				</p>";				
				
				/* auto change home page */
				if($qr['home']==1)
				{ $hm = "ivisible"; $hms = "invisible"; }							
				else
				{ $hm = "invisible"; $hms = "";  }				
				$home ="
				<p class='switch'>
					<span class='icon tooltip homes $hms' title='".Set_as_home_page."'></span>
					
					<span class='icon tooltip home $hm' title='".As_home_page."'></span>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
				</p>";
					
				/* auto change default page */
				
				if($qr['global']==1)
				{ $dm = "ivisible"; $dms = "invisible"; }							
				else
				{ $dm = "invisible"; $dms = "";  }				
				$default ="
				<p class='switch'>
					<span class='icon tooltip star $dms' title='".Set_as_default_page."'></span>
					
					<span class='icon tooltip default $dm' title='".As_default_page."'></span>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
				</p>";	

				
				$name ="<a class='tooltip ctedit link' title='".Edit."' href='?app=menu&act=edit&id=$qr[id]'>$qr[name]</a>";
				
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
							
				echo "<tr>";
				echo "<td>$no</td><td align='center'>$checkbox</td><td>$name</td><td align=center>$home</td><td align=center>$default</td><td align='center'>$status</td><td>$qr[category]</td><td  align='center'>$qr[short]</td><td>$qr[app]</td><td  align='center'>$qr[id]</td>";
				echo "</tr>";
				sub_menu($qr['id'],'',$no);
			$no++;	
			}			
			?>
        </tbody>			
	</table>
</form>
<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

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
				url: "apps/app_module/controller/status.php",
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
				url: "apps/app_module/controller/status.php",
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
			"aoColumns": [ null, { "sType": 'string-case' },  null, null,  null, null, null, null, null ]		
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
			<div class="app_title"><?php echo Module_Manager; ?></div>
			<div class="app_link">			
				<a class="lbt add tooltip" href="?app=module&act=add" title="<?php echo Add_new_module; ?>"></a>
				<input type="submit" class="lbt delete tooltip" title="<?php echo Delete; ?>" value="ok" name="delete"/>	
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>			
			<div id="helper"><?php echo Module_help; ?></div>
			</div>
		</div>		 
	</div>
	<table class="data">
		<thead>
			<tr>								  
				<th style="width:2% !important;" class="no">#</th>
				<th style="width:2% !important;" class="no" colspan="0" id="ck"><input type="checkbox" id="checkall"></th>
				<th style="width:27% !important;"><?php echo Name; ?></th>
				<th style="width:8.5% !important;" class="no" align="center">Status</th>
				<th style="width:12% !important; padding: 0" class="no" align="center"><?php echo Show_Name; ?></th>
				<th style="width:12% !important;"><?php echo Position; ?></th>
				<th width="20px"><?php echo Short; ?></th>
				<th style="width:17% !important;"><?php echo Type; ?></th>
				<th style="width:3% !important;">ID</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$db = new FQuery();  
			$db ->connect(); 
			$sql = $db->select(FDBPrefix.'module','*','','name ASC');
			$no=1;
			while($qr=mysql_fetch_array($sql)){	
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
				
				if($qr['show_title']==1)
				{ $sname1 ="selected"; $sname2 ="";}							
				else
				{ $sname2 ="selected"; $sname1 ="";}				
				$sname ="
				<p class='switch'>
					<label class='cb-enable $sname1'><span>Show</span></label>
					<label class='cb-disable $sname2'><span>Hide</span></label>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='name' id='type' class='invisible'>
				</p>";				
				
				$name = "<a href='?app=module&act=edit&id=$qr[id]' class='tooltip ctedit link' title='".Edit."'>$qr[name]</a>";
				
				$check = "<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";						
				echo "<tr><td>$no</td><td align='center' >$check</td><td>$name</td><td align=center>$status</td><td align=center>$sname</td><td>$qr[position]</td><td>$qr[short]</td><td>$qr[folder]</td><td align='center'>$qr[id]</td></tr>";
				$no++;	
			}
			?>
        </tbody>			
	</table>
</form>
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
				url: "apps/app_sef/controller/status.php",
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
				url: "apps/app_sef/controller/status.php",
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
		"aoColumns": [ null, { "sType": 'string-case' },   null, null, null, null ]
				
			});
		$('#checkall').click(function () {
		       $(this).parents('form:eq(0)').find(':checkbox').attr('checked',this.checked);
		});
			
		$("#form").submit(function(e){
		if (!confirm("Are you sure want to delete selected item(s)?"))
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
		
		<div class="app_title">SEF Manager</div>
	
		<div class="app_link">
			<a class="lbt add tooltip" href="?app=sef&act=add" title="<?php echo Add_New_Item; ?>"></a>
			<input class="lbt delete tooltip" type="submit" name="delete" title="<?php echo Delete; ?>" />			
			<hr class="lbt sparator tooltip">
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>">Help</a>	
			<div id="helper"><?php echo SEF_help; ?></div>		
		</div> 	
	  </div> 
	</div> 	
	
	<table class="data">
		<thead>
			<tr>								  
				<th style="width:2% !important;" class="no">#</th>
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>				
				<th style="width:38% !important;">SEF</th>
				<th style="width:40% !important;">Link</th>
				<th style="width:13% !important;">Lock</th>
				<th width="27px">ID</th>
			</tr>
		</thead>
		<tbody>
		<?php		
		$db = new FQuery();  
		$db->connect(); 	
		$sql=$db->select(FDBPrefix.'permalink','*','','locker DESC');
		$no=1;
		while($qr=mysql_fetch_array($sql)){	
					
				if($qr['locker']==1)
				{ $stat1 ="selected"; $stat2 ="";}							
				else
				{ $stat2 ="selected";$stat1 ="";}
				
				$status ="
				<p class='switch'>
					<label class='cb-enable $stat1'><span>&nbsp;Lock&nbsp;</span></label>
					<label class='cb-disable $stat2'><span>Unlock</span></label>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
				</p>";
														
				$name ="<a class='tooltip ctedit' title='Click to edit' href='?app=sef&act=edit&id=$qr[id]'>$qr[permalink]</a>";
							
				$sef ="<a class='tooltip ctedit' title='Click to edit' href='?app=sef&act=edit&id=$qr[id]'>$qr[link]</a>";						
				
				$check ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
				
				echo "<tr>";
				echo "<td>$no</td><td align='center'>$check</td><td>$name</td><td>$sef</td><td align=center>$status</td><td align='center'>$qr[id]</td>";
				echo "</tr>";
				$no++;	
			}
		?>
        </tbody>			
	</table>
</form>
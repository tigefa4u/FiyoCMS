<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.php
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
				url: "apps/app_contact/controller/status.php",
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
				url: "apps/app_contact/controller/status.php",
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
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null, null, null,null ]	
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
		  <div class="app_title">Contact Manager</div>
		  <div class="app_link">			
			<a class="lbt add tooltip link" href="?app=contact&act=add" title="<?php echo Add_New_Contact; ?>"></a>
			<input type="submit" class="lbt delete tooltip" title="<?php echo Delete; ?>" value="ok" name="delete"/>	
			<span class="lbt sparator"></span>
			<a class="lbt group tooltip link" href="?app=contact&act=group" title="Change to Group View"></a>	
			<span class="lbt sparator"></span>
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>	
			<div id="helper"><?php echo Contact_help; ?></div>
		  </div> 	
		</div>
	</div>
	<table class="data">
		<thead>
			<tr>								  
				<th width="3%" class="no">#</th>	
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>		
				<th style="width:20% !important;"><?php echo Name; ?></th>
				<th style="width:10% !important;" >Gender</th>
				<th style="width:8% !important;" class="no" align="center">Status</th>
				<th style="width:20% !important;" >Group</th>
				<th style="width:20% !important;" >Email</th>
				<th style="width:20% !important;" >Phone</th>
				<th width="3%">ID</th>
			</tr>
		</thead>		
		<tbody>
			<?php	
			$sql = $db->select(FDBPrefix.'contact','*',"","name ASC");
			$no=1;				
			while($qr=mysql_fetch_array($sql)){
				/* logika status aktif atau tidak */
				if($qr['status']==1)
				{ $stat1 ="selected"; $stat2 ="";}							
				else
				{ $stat2 ="selected";$stat1 ="";}
				
				$status ="
				<p class='switch'>
					<label class='cb-enable $stat1'><span>On</span></label>
					<label class='cb-disable $stat2'><span>Off</span></label>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
					<span class='load'>Loading...</span>
				</p>";
				
				/* logika halaman depan */
				$group = oneQuery('contact_group','id',$qr['group_id'],'name');
				$name ="<a class='tooltip ctedit link' title='".Edit."' href='?app=contact&act=edit&id=$qr[id]'>$qr[name]</a>";
				
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
				if($qr['gender'] == 1) $gender = Man; else $gender = Woman; 
				echo "<tr>";
				echo "<td>$no</td><td align='center'>$checkbox</td><td>$name</td><td align=center>$gender</td><td  align='center'>$status</td><td>$group</td><td  align='center'>$qr[email]</td><td>$qr[phone]</td><td  align='center'>$qr[id]</td>";
				echo "</tr>";
			$no++;	
			}			
			?>
        </tbody>			
	</table>
</form>
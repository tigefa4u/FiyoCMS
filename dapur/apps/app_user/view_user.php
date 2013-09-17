<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$new_member = siteConfig('new_member');
if($new_member){$enpar1="selected checked"; $dispar1 = "";}
else {$dispar1="selected checked"; $enpar1= "";}

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
				url: "apps/app_user/controller/status.php",
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
				url: "apps/app_user/controller/status.php",
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
		
		oTable = $('.data').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",	
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null, null, null ]		
				
			});
	$('#checkall').click(function () {
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
		
		<div class="app_title">User Manager</div>
	
		<div class="app_link">
			<a class="lbt add tooltip" href="?app=user&act=add" title="<?php echo Add_new_user; ?>"></a>
			<input class="lbt delete tooltip" type="submit" name="delete" title="<?php echo Delete; ?>" />
			<span class="lbt sparator"></span>	
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"><?php echo Help; ?></a>
			<div id="helper"><?php echo User_help; ?></div>					
		</div> 	
	  </div> 
	</div> 	
	
	<table class="data">
		<thead>
			<tr>								  
				<th width="5px" class="no">#</th>
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>				
				<th style="width:30% !important;"><?php echo Name; ?></th>
				<th style="width:20% !important;">Username</th>
				<th style="width:9% !important;">Status</th>
				<th style="width:15% !important;">Group</th>
				<th  style="width:20% !important;">Email</th>
				<th width="27px">ID</th>
			</tr>
		</thead>
		<tbody>
		<?php		
		$db = new FQuery();  
		$db->connect(); 	
		$UserLevel =  userInfo('level');
		$sql=$db->select(FDBPrefix.'user','*','level>='.$UserLevel);
		$no=1;
		while($qr=mysql_fetch_array($sql)){
			$checkbox = null;
			$group = oneQuery("user_group","level",$qr['level'],'group_name');
			if($qr['status']==1)
				{ $stat1 ="selected"; $stat2 ="";}							
			else
				{ $stat2 ="selected";$stat1 ="";}	
					
			$UserId =  userSessionInfo('id');
				
			if($qr['level'] != 1 AND $_SESSION['USER_LEVEL'] < $qr['level'] or $_SESSION['USER_LEVEL'] == 1 AND $qr['id'] != $_SESSION['USER_ID'] ){
				$status ="
				<p class='switch'>
					<label class='cb-enable $stat1'><span>On</span></label>
					<label class='cb-disable $stat2'><span>Off</span></label>
					<input type='text' value='$qr[id]' id='id' class='invisible'><input type='text' value='stat' id='type' class='invisible'>
				</p>";	
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
				$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=user&act=edit&id=$qr[id]'>$qr[name]</a>";
				$user ="<a class='tooltip ctedit' title='".Edit."' href='?app=user&act=edit&id=$qr[id]'>$qr[user]</a>";
			}
			else  {
				$status ="
					<label class='cs-enable $stat1'><span>On</span></label>
					<label class='cs-disable $stat2'><span>Off</span></label>";	
				$checkbox = "<span class='icon lock'></lock>";
			}
			
			if($qr['level'] >= $_SESSION['USER_LEVEL'] or $_SESSION['USER_LEVEL'] == 1) {
				$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=user&act=edit&id=$qr[id]'>$qr[name]</a>";
				$user ="<a class='tooltip ctedit' title='".Edit."' href='?app=user&act=edit&id=$qr[id]'>$qr[user]</a>";
			}
			else  {
				$name ="$qr[name]";
				$user ="$qr[user]";
			}
			
			echo "<tr>";
			echo "<td>$no</td><td align='center'>$checkbox</td><td>$name</td><td>$user</td><td align=center>$status</td><td align='center'>$group</td><td>$qr[email]</td><td align='center'>$qr[id]</td>";
			echo "</tr>";
			$no++;	
		}
		?>
        </tbody>			
	</table>
</form>


<!-- CONFIGURATION POPUP -->
<div class="popup_warp">
	<div id="config" class="pop_up" style="padding:10px">
		<div id="updater_id">		
<form method="post">
		<h3>User Configuration</h3>
		<table class="data2" style="width:600px">
				<input value="<?php echo @$qr['id'];?>" type="hidden" name="id">
				<tr>
					<td class="djudul tooltip" title="">Allow New Member</td>
					<td>
					<p class="switch">
							<input id="radio1" value="1" name="new_member" <?php echo $enpar1;?> type="radio" class="invisible" >
							<input id="radio2" value="0" name="new_member" <?php echo $dispar1;?> type="radio" class="invisible">
							<label for="radio1" class="cb-enable <?php echo $enpar1;?>"><span>Allow</span></label>
							<label for="radio2" class="cb-disable <?php echo $dispar1;?>"><span>Disallow</span></label>
							</p></td>
				</tr>
				<tr><td></td>
					<td><input type="submit" class="button" value="Save" name="addSuplier"></td>
				</tr>
			</table>
</form>
		</div>
	</div>	
</div>

<?php 
/**
* @version		2.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2014 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

session_start();
if(!isset($_SESSION['USER_ID']) or !isset($_SESSION['USER_ID']) or $_SESSION['USER_LEVEL'] > 3 or !isset($_POST['url'])) die();
define('_FINDEX_','BACK');

require_once ('../../../system/jscore.php');
?>
<table class="table table-striped tools">
  <tbody>
	<?php	
		$db = new FQuery();  
		$db->connect(); 
		$sql = $db->select(FDBPrefix."user","*,DATE_FORMAT(time_log,'%W, %Y-%m-%d %H:%i') as date","time_log != '0000-00-00 00-00-00' AND level >= $_SESSION[USER_LEVEL]",'time_log DESC LIMIT 10'); 
		$no = 1;
		while($qr=mysql_fetch_array($sql)) {
			$id = $qr['id'];
			$edit = Edit;
			$read = Read;
			$hide = Set_disable;	
			$delete = Delete;
			$approve = Set_enable;		
			$sql2 = $db->select(FDBPrefix."user_group","*","level=$qr[level]"); 
			
			$red = '';
			if($qr['status']) 
				$approven = "<a class='btn-tools btn btn-danger btn-sm btn-grad disable-user' data-id='$qr[id]' title='$hide'>$hide</a><a class='btn-tools btn btn-success btn-sm btn-grad approve-user' data-id='$qr[id]' title='$approve' style='display:none;'>$approve</a>";
			else {
				$approven = "<a class='btn-tools btn btn-success btn-sm btn-grad approve-user' data-id='$qr[id]' title='$approve'>$approve</a><a class='btn-tools btn btn-danger btn-sm btn-grad disable-user' data-id='$qr[id]' title='$hide' style='display:none;'>$hide</a>";
				$red = "class='unapproved'";
			}		
			if($id == USER_ID) $approven ='';
			$output = oneQuery('session_login','user_id',"'$id'");	
			$log = "";			
			if($output) $log = "
			<a data-toggle='tooltip' data-placement='right' title='Online' class=' icon-circle blink icon-mini tooltips'></a>&nbsp;&nbsp;&nbsp;";
			
			$group = mysql_fetch_array($sql2);
			$group = $group['group_name'];			
			$ledit = "?app=user&act=edit&id=$qr[id]";					
			echo "<tr $red>
			<td>$qr[name] <span>($qr[user])</span>$log
			<a data-toggle='tooltip' data-placement='right' title='$qr[email]' class=' icon-envelope-alt tooltips'></a>
			<a data-toggle='tooltip' data-placement='right' title='$group' class=' icon-info-sign tooltips'></a>
			<br/>
			<div class='tool-box'>
				$approven
				<a href='$ledit' class='btn btn-tools tips' title='$edit'>$edit</a>
			</div></td>
			<td align='right'>$qr[date]</td>
			</tr>";
			$no++;	
		}					
		?>			

       </tbody>			
</table>
<script>$(function() {	
	$('.approve-user').click(function() {
		var is = $(this);
		var id = $(this).data('id');
		$.ajax({
			url: "apps/app_user/controller/status.php",
			data: "stat=1&id="+id,
			success: function(data){						
				is.parents("tr").removeClass('unapproved');
				is.hide();
				is.parent().find('.disable-user').show();
			}
		});		
	});
	
	$('.disable-user').click(function() {
		var is = $(this);
		var id = $(this).data('id');
		$.ajax({
			url: "apps/app_user/controller/status.php",
			data: "stat=0&id="+id,
			success: function(data){
				is.parents("tr").addClass('unapproved');
				is.hide();
				is.parent().find('.approve-user').show();
			}
		});	
	});
	$('.tooltips').tooltip();
}); 
</script>
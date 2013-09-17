<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

?>	
<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			oTable = $('table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",	
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null]		
				
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
		
		<div class="app_title">User Group</div>
	
		<div class="app_link">
		<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
			<a class="lbt add tooltip" href="?app=user&act=add_group" title="<?php echo Add_new_group; ?>"><?php echo Add; ?></a>
			<input class="lbt delete tooltip" value="<?php echo Delete; ?>" type="submit" name="delete_group" title="<?php echo Delete; ?>" />			
			<span class="lbt sparator"></span>	
			<?php endif; ?>
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"><?php echo Help; ?></a>
			<div id="helper"><?php echo User_Group_help; ?></div>		
		</div> 	
	 </div>
	</div>
	
	<table cellpadding="4" class="data">
		<thead>
			<tr>								  
				<th width="5px" class="no">#</th>
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>
				<th style="width:50% !important;"><?php echo Group_name; ?></th>
				<th width="30px">Level</th>
				<th  style="width:50% !important;"><?php echo Description; ?></th>
				<th width="30px">ID</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$db = new FQuery();  
			$db->connect(); 
			$sql=$db->select(FDBPrefix.'user_group'); 		
			$no=1;
			while($qr = mysql_fetch_array($sql)) {
				$checkbox = null;
				if($qr['level']!=1 And $qr['level']!=2 and $qr['level']!=3 )
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[level]'>";
				$name ="<a class='tooltip ctedit' title='".Click_to_edit."' href='?app=user&act=edit_group&id=$qr[id]'>$qr[group_name]</a>";
				if($_SESSION['USER_LEVEL'] > 2) {
					$checkbox = "<span class='icon lock'></lock>";
					$name ="$qr[group_name]";
					}
				echo "<tr>";
				echo "<td><b>$no</b></td><td align='center'>$checkbox</td><td>$name</td><td align='center'>$qr[level]</td><td>$qr[description]</td><td align='center'>$qr[id]</td>";
				echo "</tr>";
				$no++;	
			}					
			?>
        </tbody>			
	</table>
</form>
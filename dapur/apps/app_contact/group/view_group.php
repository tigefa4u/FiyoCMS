<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
* @description	
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
		});
</script>
<form method="post">
	<div id="app_header">
	 <div class="warp_app_header">
		
		<div class="app_title">Group Contact</div>
	
		<div class="app_link">
			<a class="lbt add tooltip" href="?app=contact&act=add_group" title="<?php echo Add_new_group; ?>"></a>
			<input class="lbt delete tooltip" type="submit" name="delete_group" title="<?php echo Delete; ?>" />
			<span class="lbt sparator"></span>
			<a class="lbt user tooltip link" href="?app=contact" title="Change to Person View"></a>	
			<span class="lbt sparator"></span>
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>
			<div id="helper"><?php echo Contact_help; ?></div>		
		</div> 	
	 </div>
	</div>
	
	<table cellpadding="4" class="data">
		<thead>
			<tr>								  
				<th style="width:2% !important;" align='center' class="no">#</th>
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>				
				<th style="width:20% !important;">Group Name</th>
				<th width="30px" class='tooltip'>Contact</th>
				<th style="width:50% !important;"><?php echo Description; ?></th>
				<th style="width:2% !important;">ID</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$db = new FQuery();  
			$db->connect(); 
			$sql = $db->select(FDBPrefix.'contact_group'); 
			$no = 1; 
			while($qr=mysql_fetch_array($sql)){
				$qr2=$db->select(FDBPrefix.'contact','*',"group_id='$qr[id]'"); 
				$jml2= mysql_affected_rows();						
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]'>";	
				$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=contact&act=edit_group&id=$qr[id]'>$qr[name]</a>";
				echo "<tr>";
				echo "<td>$no</td><td align='center'>$checkbox</td><td>$name</td><td align='center'>$jml2</td><td>$qr[description]</td><td align='center'>$qr[id]</td>";
				echo "</tr>";
				$no++;	
			}
			?>
        </tbody>			
	</table>
</form>
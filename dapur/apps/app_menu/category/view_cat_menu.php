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
		oTable = $('table').dataTable({
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",	
				"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null, null ]	
				
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
		
		<div class="app_title"><?php echo Menu_Category; ?></div>
	
		<div class="app_link">
			<a class="lbt add tooltip" href="?app=menu&act=add_category" title="<?php echo Add_new_category; ?>">New Category</a>
			<input class="lbt delete tooltip" value="Delete" type="submit" name="delete_category" title="<?php echo Delete; ?>" />
			<span class="lbt sparator"></span>
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>">Help</a>
			<div id="helper"><?php echo Menu_Category_help; ?></div>		
		</div> 	
	 </div>
	</div>
	
	<table cellpadding="4" class="data">
		<thead>
			<tr>								  
				<th width="5px" class="no">#</th>
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>				
				<th style="width:20% !important;"><?php echo Category_Title; ?></th>
				<th style="width:20% !important;"><?php echo Category_Name; ?></th>
				<th width="30px" class='tooltip'>Menu</th>
				<th  style="width:50% !important;"><?php echo Description; ?></th>
				<th width="30px">ID</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$db = new FQuery();  
			$db->connect(); 
			$sql = $db->select(FDBPrefix.'menu_category'); 
			$no = 1; 
			while($qr=mysql_fetch_array($sql)){
				$qr2=$db->select(FDBPrefix.'menu','*',"category='$qr[category]'"); 
				$jml2= mysql_affected_rows();						
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[category]' rel='ck'>";	
				$name ="<a class='tooltip ctedit' title='".Edit."' href='?app=menu&act=edit_category&id=$qr[id]'>$qr[title]</a>";
				echo "<tr>";
				echo "<td><b>$no</b></td><td align='center'>$checkbox</td><td>$name</td><td>$qr[category]</td><td align='center'>$jml2</td><td>$qr[description]</td><td align='center'>$qr[id]</td>";
				echo "</tr>";
				$no++;	
			}
			?>
        </tbody>			
	</table>
</form>
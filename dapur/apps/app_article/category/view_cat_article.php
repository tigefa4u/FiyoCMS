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
			"aoColumns": [ null, { "sType": 'string-case' }, null,  null, null, null ]	
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
		  <div class="app_title"><?php echo Article_category; ?></div>
		  <div class="app_link">			
			<a class="lbt add tooltip link" href="?app=article&act=add_category" title="<?php echo Add_new_category; ?>"></a>
			<input type="submit" class="lbt delete tooltip" title="<?php echo Delete; ?>" value="ok" name="delete_category"/>
			<hr class="lbt sparator tooltip" />
			<a class="lbt help popup tooltip" href="#helper" title="<?php echo Help; ?>"></a>	
			<div id="helper"><?php echo Article_Category_help; ?></div>
		  </div> 	
		</div>
	</div>
	<table class="data">
		<thead>
			<tr>								  
				<th width="3%" class="no">#</th>	
				<th width="3%" class="no" colspan="0" id="ck">  
					<input type="checkbox" id="checkall"></th>		
				<th style="width:65% !important;"><?php echo Category_Name; ?></th>	
				<th style="width:15% !important;"><?php echo Access_Level; ?></th>
				<th style="width:15% !important;">Total <?php echo Article; ?></th>
				<th width="3%">ID</th>
			</tr>
		</thead>
		<tbody>
			<?php		
			$db = new FQuery();  
			$db->connect(); 
			$sql=$db->select(FDBPrefix.'article_category','*',"parent_id=0");
			$no=1;
			while($qr=mysql_fetch_array($sql)){
				//num of total article
				$db->select(FDBPrefix.'article','*',"category=$qr[id]"); 
				$num = mysql_affected_rows();
				
				//creat user group values	
				$sql2=$db->select(FDBPrefix.'user_group','*',"level=$qr[level]"); 
				$level=mysql_fetch_array($sql2);				
				if($qr['level']==99) $level = _Public;
				else $level = $level['group_name'];
					
								
				if($_SESSION['USER_LEVEL'] <= $qr['level']) {
				$name = "<a class='tooltip ctedit link' title='".Edit."' href='?app=article&act=edit_category&id=$qr[id]'>$qr[name]</a>";
				$checkbox ="<input type='checkbox' name='check[]' value='$qr[id]' rel='ck'>";
				}
				else {$checkbox ="<span class='icon lock'></lock>";
				$name = "$qr[name]";}
				
				echo "<tr>";
				echo "<td>$no</td><td align='center'>$checkbox</td><td>$name</td><td align='center'>$level</td><td align='center'>$num</td><td align='center'>$qr[id]</td>";
				echo"</tr>";
				sub_article($qr['id'],$no);
				$no++;	
				
			}					
			?>
        </tbody>			
	</table>
</form>
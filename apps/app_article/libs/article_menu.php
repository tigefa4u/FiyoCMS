<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/
session_start();

if(isset($_SESSION['userLevel']) AND $_SESSION['userLevel'] < 3 AND isset($_GET['access'])) :
?>
<script type="text/javascript">
$(document).ready(function() {
	$(".ctselect").click(function() {
		$("#easy_popup_content").hide();
		$("#easy_popup").hide();
        var id = $(this).attr('rel');	
        var name = $(this).attr('name');	
		$("#link").val("?app=article&view=item&id="+id);
		$("#pg").val(name);
		});
	oTable = $('.data').dataTable({
		"aaSorting": false,	
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"aaSorting": [[ 1, "asc" ]]	
	});
});
</script>
<h3>Select an Article</h3>
<form method="post">	
	<table class="data">
		<thead>
			<tr>								  
				<th style="width:3% !important;" class="no">#</th>	
				<th style="width:40% !important;">Article's Title</th>
				<th style="width:15% !important;" class="no">Category</th>
				<th style="width:15% !important;" class="no">Author</th>
				<th style="width:10% !important;" class="no">Date</th>
				<th style="width:3% !important;">ID</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
			define('_FINDEX_',1);
			require('../../../system/jscore.php');
			$db = new FQuery();  
			$db->connect(); 
			$sql=$db->select(FDBPrefix.'article','*','status=1',"title ASC");
			$qr = $db->getResult();
			$no=1;
			while($qr=mysql_fetch_array($sql)){	
				$sql2 = $db->select(FDBPrefix.'article_category',"name","id=$qr[category]"); 
				$category = mysql_fetch_array($sql2);
				$category = $category['name'];
					
				$sql3 = $db->select(FDBPrefix."user","name","id=$qr[author_id]"); 
				$aut = mysql_fetch_array($sql3);
				$author = $aut['name'];
				if(!empty($qr['author'])) $author=$qr['author'];
					
				$name ="<a class='tooltip ctselect' title='Click to select article \"$qr[title]\"' href='#' rel='$qr[id]' name='$qr[title]'>$qr[title]</a>";
				$date = substr($qr['date'],0,10);
				echo "<tr><td>$no</td><td>$name</td><td  align='center'>$category</td><td>$author</td><td>$date</td><td align='center'>$qr[id]</td></tr>";
				$no++;	
				}
			?>				
            </tbody>			
		</table>

</form>
<?php endif; ?>
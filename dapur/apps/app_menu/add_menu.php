<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');


$_REQUEST['id']=0;

if(isset($_POST['next']) or isset($_POST['apps'])) {
	if(empty($_POST['apps'])) {
		alert('error',Please_Select_Apps);
		 addappstep1();
	}
	else {			
		addappstep2();
	}
}
else {
	addappstep1();
}
	
function addappstep1() {
?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		oTable = $('table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"aaSorting": [[ 1, "asc" ]]
				
		});
	});
</script>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo New_Menu; ?></div>			
			<div class="app_link">
				<a class="lbt link prev tooltip" href="?app=menu" title="<?php echo Back; ?>">Prev</a>
				<input type="submit" value="Next"class="lbt next tooltip" title="<?php echo Next; ?>"name="next"/>
				<hr class="lbt sparator tooltip">
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Add_Menu_help; ?></div>
			</div>
		</div>			 
	</div>			
		
	<table class="data">
		<thead>
		<tr>
				<th style="width:2%; text-align:center" class="no" ></th>
				<th style="width:40% !important;"><?php echo Menu_Type_or_Apps_Name; ?></th>
				<th style="width:30% !important;"><?php echo AddOns_Author; ?></th>
				<th style="width:10% !important;"><?php echo Version; ?></th>
				<th style="width:20% !important;"><?php echo Update_date; ?></th>
			</tr>
		</thead>
		</thead>
		<?php
		$db = new FQuery();  
		$db->connect(); 
		$sql =	$db->select(FDBPrefix.'apps','*','type <= 1',"name ASC"); $apps_date = $apps_version = '-';
		while($qr=mysql_fetch_array($sql)){	
				$file = "../apps/$qr[folder]/app_details.php";
				if(file_exists($file))
				include("../apps/$qr[folder]/app_details.php");
				echo "<tr>";
				echo "<td align='center'><input type=\"radio\" name=\"apps\" value=\"$qr[folder]\"> </td><td><a class='tooltip help' title='$app_desc'>$qr[name]</a></td><td>$qr[author]</td>
					<td>$apps_version </td>
					<td>$apps_date</td>";
				echo "</tr>";
			}
		?> 
		<tr>
			<td align="center"><input type="radio" name="apps" value="link"></td>
			<td><a title="<?php echo External_Link_tip; ?>" class="tooltip help"><?php echo External_Link; ?></a></td>
			<td>Fiyo CMS</td>
			<td>-</td>
			<td>-</td>
		</tr>
		<tr>
			<td align="center"><input type="radio" name="apps" value="sperator"></td>
			<td><a title="<?php echo Sperator_tip; ?>" class="tooltip help"><?php echo Sperator; ?></a></td>
			<td>Fiyo CMS</td>
			<td>-</td>
			<td>-</td>
		</tr>
	</table>
</form>			
<?php
}
function addappstep2() { 
?>
<form method="post">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo New_Menu; ?></div>	
			<div class="app_link">	
				<a class="lbt prev tooltip" href="?app=menu&act=add" title="<?php echo Back; ?>"></a>
				<span class="lbt sparator"></span>
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="apply_add"/>
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="save_add"/>
				<a class="lbt link cancel tooltip" href="?app=menu" title="<?php echo Cancel; ?>"></a>
				<span class="lbt sparator"></span>
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>
				<div id="helper"><?php echo Add_Menu_2_help; ?></div>
			
			</div>
		</div>
	</div>
	<?php 
		require('field_menu.php');
	?>		
</form>		
<?php
}
?>

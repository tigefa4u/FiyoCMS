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
<table class="data">
	<thead>
	<tr>
		<th style="width:1% !important;"  class="no"></th>
		<th style="width:75% !important;"><?php echo Apps_Name; ?></th>
		<th style="width:25% !important;"><?php echo AddOns_Author; ?></th>
	</tr>
	</thead>
	<?php	
	$db = new FQuery();  
	$db->connect();	
		
	if(isset($_POST['uninstall']) AND !empty($_POST['apps'])) {
		$apps = $_POST['apps'];
		$a = $b = $c = 'Null <br>';
		if(delete_directory("apps/$apps")) $a ="folder <i>apps/$apps</i> ".deleted."!<br>";		
		if(delete_directory("../apps/$apps")) $b ="folder <i>apps/$apps</i> ".deleted."!<br>";			
		$qr = $db->delete(FDBPrefix.'apps',"folder='$apps'");
		if($qr) $c = "table <i>$apps</i> ".deleted."!<br>";	
		alert('info',"$a $b $c");		
	}		
		
	$sql =	$db->select(FDBPrefix.'apps','*','',"name ASC"); 
	while($qr=mysql_fetch_array($sql)){		
		$file = "../apps/$qr[folder]/app_details.php";
		if(file_exists($file)) {
			include($file);
			$class = "tooltip help";
		}
		else {
			$app_desc = "";
			$class = "tooltip";
		}
		echo "<tr>";
		
		if($qr['type']== 0)
			$radio = "<span class='icon lock'></lock>";
		else
			$radio ="<input type=\"radio\" name=\"apps\" value=\"$qr[folder]\">";
					
		if(!isset($app_desc)) {
			$app_desc = "Error Apps!";
			$qr['name'] ="Error Apps!";
		}
		echo "<td align='center'>$radio</td><td><a class='$class' title='$app_desc'>$qr[name]</a></td><td>$qr[author]</td>";
			echo "</tr>";
	}
	?> 
</table>

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
		<th style="width:75% !important;"><?php echo Module_Name; ?></th>
		<th style="width:25% !important;"><?php echo AddOns_Author; ?></th>
	</tr>
	</thead>
	<?php	
	$db = new FQuery();  
	$db->connect();	
	
	if(isset($_POST['uninstall']) AND !empty($_POST['folder'])) {
		$folder = $_POST['folder'];
		$a = $b = 'Null <br>';
		if(delete_directory("../modules/$folder")) 
		$a ="folder <i>folder/$folder</i> ".deleted."!<br>";			
		$qr = $db->delete(FDBPrefix.'modules',"folder='$folder'");
		$b = "table <i>$folder</i> ".deleted."!<br>";	
		alert('info',"$a $b");	
	}	
	$dir=opendir("../modules"); 
	$no=1;
	while($folder=readdir($dir)){ 
		if($folder=="." or $folder=="..")continue; 
		if(!preg_match ( "/[\.]/i" , $folder))
		{
			$file = "../modules/$folder/mod_details.php";
			if(file_exists($file))	include($file);
			if($module_author == 'Fiyo CMS')
				$ip = "<span class='icon lock'></lock>";
			else
				$ip = "<input type=\"radio\" name=\"folder\" value=\"$folder\">";
			echo "<tr>
				<td align=\"center\">$ip</td>
				<td><a title=\"$module_desc\" class=\"tooltip help\">$module_name</a>";			
				echo "</td>
			<td>$module_author </td>
				</tr>";
			}
			$no++;
		} 
	closedir($dir);
	?> 
</table>


<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

?>

<table class="data3">	
  <tbody>
	<?php	
		$db = new FQuery();  
		$db->connect(); 
		$sql = $db->select(FDBPrefix."article","*,DATE_FORMAT(date,'%W, %b %d %Y') as dates","",'date DESC LIMIT 5'); 
		$no = 1;		
		while($qr=mysql_fetch_array($sql)) {		
			$link = check_permalink("link","?app=article&view=item&id=$qr[id]","permalink");
			$name ="<a class='tooltip outlink' target='_blank' href='".FUrl."$link'>$qr[title]</a>";							
			$auth = userInfo("name","$qr[author_id]");							
			if($no%2==0) $class = 'clr'; else 	$class = 'cln';		
			echo "<tr class='$class'><td class='no' rowspan='2' width='5' style='color: #aaa; font-size:15px; padding: 10px;'><b>#$no</b></td><td colspan='2' width='100%'>$name</b></td></tr>";
			echo "<tr class='$class' style='margin-bottom: 5px;'><td style='background:#f3f3f3; font-size: 11px; color: #888; padding: 2px 5px;'>By : $auth <div class='right'>$qr[dates]</div></td></tr>";
			echo "<tr><td style='border:0; padding: 2px;' colspan='2'></td></tr>";
			$no++;	
		}					
		?>				
       </tbody>			
</table>
<?php 
/**
* @version		v 1.3.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<table class="data3">
  <thead>
	<tr>								  
		<th style="width:1% !important;" class="no">#</th>	
		<th >User ID</th>
		<th style="width:105px !important;" class="no">Time</th>
	</tr>
  </thead>		
  <tbody>
	<?php	
		$db = new FQuery();  
		$db->connect(); 
		$sql = $db->select(FDBPrefix."session_login","*,DATE_FORMAT(time,'%Y-%m-%d') as date","",'time DESC LIMIT 5'); 
		$no = 1;
		while($qr=mysql_fetch_array($sql)) {
			
			$sql2 = $db->select(FDBPrefix."user_group","*","level=$qr[level]"); 
			$group = mysql_fetch_array($sql2);
			$group = $group['group_name'];							
			if($no%2==0) $class = 'clr'; else 	$class = 'cln';		
			echo "<tr class='$class'><td class='no'>$no</td><td>$qr[session_id] <i>($group)</i></td><td>$qr[time]</td></tr>";
			$no++;	
		}					
		?>			

       </tbody>			
</table>
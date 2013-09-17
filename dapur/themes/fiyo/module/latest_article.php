<?php 
/**
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

?>

<table class="data3">
  <thead>
	<tr>								  
		<th style="width:1% !important;" class="no">#</th>	
		<th>Title</th>
		<th style="width:65px !important; text-align:center"  class="no">Date</th>
	</tr>
  </thead>		
  <tbody>
	<?php	
		$db = new FQuery();  
		$db->connect(); 
		$sql = $db->select(FDBPrefix."article","*,DATE_FORMAT(date,'%b-%d, %Y') as dates","",'date DESC LIMIT 7'); 
		$no = 1;		
		while($qr=mysql_fetch_array($sql)) {		
				
			$name ="<a class='tooltip ctedit' title='".Click_to_edit."' href='?app=article&act=edit&id=$qr[id]'>$qr[title]</a>";							
			if($no%2==0) $class = 'clr'; else 	$class = 'cln';		
			echo "<tr class='$class'><td class='no'>$no</td><td>$name</td><td>$qr[dates]</td></tr>";
			$no++;	
		}					
		?>				
       </tbody>			
</table>
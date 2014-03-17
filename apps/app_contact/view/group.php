<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$id = app_param('id');
$contact = new Contact() or die;  
$contact -> category($id);
	
if(isset($contact->name))
{	
?>	
<?php if(defined('Apps_Title')) echo "<h2>".PageTitle."</h2>"; ?>
<div id="contact">
	<table class="group">
	<tr class='head'>
		<?php if($contact->sname==1) echo "<th style='width:20%'>"._contact_Name."</th>"; ?>
		<?php if($contact->sgender==1) echo "<th style='width:10%'>"._contact_Gender."</th>"; ?>
		<?php if($contact->sgroup==1) echo "<th style='width:15%'>"._contact_Group."</th>"; ?>
		<?php if($contact->saddress==1) echo "<th style='width:30%'>"._contact_Address."</th>"; ?>
		<?php if($contact->slinks==1) echo "<th style='width:10%'>"._contact_Links."</th>"; ?>
		<?php if($contact->sjob==1) echo "<th style='width:18%'>"._contact_Job_Position."</th>"; ?>
		<?php if($contact->semail==1) echo "<th style='width:20%'>"._contact_Email."</th>"; ?>
		<?php if($contact->sphone==1) echo "<th style='width:18%'>"._contact_Phone."</th>"; ?>
	</tr>
	<?php 
	
	for($i=0; $i < $contact->perrows ;$i++)
	{
	?>			
	<tr <?php if($a=$i%2==0) echo "class='ganjil'"; else echo "class='genap'"; ?>>
		
		<?php if($contact->sname==1) echo "<td>".$contact->name[$i]."</td>"; ?>
		<?php if($contact->sgender==1) if($contact->gender[$i]==1) echo "<td>"._contact_Man."</td>";else echo "<td>"._contact_Woman."</td>"; ?>
		<?php if($contact->sgroup==1) echo "<td>".$contact->group[$i]."</td>"; ?>
		<?php if($contact->saddress==1) echo "<td>".$contact->address[$i]."</td>"; ?>
		<?php if($contact->slinks==1) echo "<td>".$contact->links[$i]."</td>"; ?>
		<?php if($contact->sjob==1) echo "<td>".$contact->job[$i]."</td>"; ?>
		<?php if($contact->semail==1) echo "<td>".$contact->email[$i]."</td>"; ?>
		<?php if($contact->sphone==1) echo "<td>".$contact->phone[$i]."</td>"; ?>
	</tr>
	
	<?php	
	}
	?>	
	
	
	
	</table>	
	<div class="contact-paging">
		<?php echo $contact->pagelink; ?>
	</div>
</div>
<?php
}
?>
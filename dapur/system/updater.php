<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

$file = $filev = ''; //set null for $file->tmp variabel
$open_file = @fopen ("http://fiyo.org/version.log", "r");
	if($open_file) 
	{
		while(!feof($open_file))
		{
			$data = fgets($open_file,50);
			$file.= $data;
		}	
	}
	else
	{
		$file = "<i>Failed to check global version!</i>";
	}

$version_file = @fopen("version.log", "r");	if($version_file) 
	{
		while(!feof($version_file))
		{
			$datav = fgets($version_file,50);
			$filev.= $datav;
		}	
	}
	else
	{
		$filev = "<i>Failed to check our version!</i>";
	}

define ("Fiyo_Version_val",$file);
@fclose($open_file);
define ("Site_Version_val","$filev");
@fclose($version_file);
						
?>
<h3>Fiyo Update Information</h3>
<table class="winfo">
	<tr>
		<td><b><i>Our Version</b></i></td>
		<td><?php echo Site_Version_val; ?> </td>
	</tr>
	<tr>
		<td><b><i>Global Version</b></i></td>
		<td><?php echo Fiyo_Version_val; ?></td>
	</tr>
	<tr>
		<td valign="top"><b><i>Update Status</b></i></td>
		<td><?php					
			if(Site_Version_val==Fiyo_Version_val) {
				echo "<span class='updated'>Updated !</span>";
			} 
			else if(Site_Version_val > Fiyo_Version_val) {
				echo "<a href='http://www.fiyo.org/download/' target='_blank'><span class='error'>Your version not valid!<br>Check the latest version here!</span></a>";
			}
			else if (Site_Version_val < Fiyo_Version_val) {
				echo "<a href='http://www.fiyo.org/download/' target='_blank'><span class='error'>Click for Update</span></a>";
			}	
		?>
		</td>
	</tr>
</table>

<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/
if(isset($_POST['updater']) or isset($_POST['patching'])) :
define('_FINDEX_',1);
require_once ('../../../system/jscore.php');


$file = 'http://patch.fiyo.org/update.xml';
$xml = @simplexml_load_file($file);
$site_version	= siteConfig('version');
if($xml) {
	$latest_version = $xml-> version -> number ;

	$patch = array();
	$i = 1; $files = null;
	foreach($xml->children() as $child){
		if($child -> number == siteConfig('version')) break;
		$patch[$i]['number'] = $child -> number; 
		$patch[$i]['link'] = $child -> link;
		$i++;	
	}

	ksort($patch);
	foreach($patch as $p){
		$files .= $p['number']."<br>";
	}
}
else {
	$fail = true;
	$latest_version = "Failed to check latest version";	
}
?>
<h3>Update Information</h3>
<table class="winfo">
	<tr>
		<td><b>Your Version</b></td>
		<td><?php echo $site_version; ?> </td>
	</tr>
	<tr>
		<td><b>Latest Version</b></td>
		<td><?php echo $latest_version; ?></td>
	</tr>
	<tr>
		<td valign="top"><b>Update Status</b></td>
		<td>
			<?php if(isset($_POST['patching']) AND $_POST['patching'] != false AND $site_version != $latest_version AND $xml ){
				$plink = $p['link'];
				@mkdir("../../../../tmp");
				$newfile = "../../../../tmp/patch_$p[number].zip";
				if (copy($plink, $newfile)) {
					if(extractZip($newfile,'../../../../')) {
						$dapur = siteConfig('backend_folder');
						if(siteConfig('backend_folder') != 'dapur')		
							copy_directory("../../../../dapur","../../../../$dapur",true);
						$db = new FQuery();  
						$db -> connect();
						$db->update(FDBPrefix.'setting',array('value'=>"$p[number]"),"name='version'");
						$sup = $p['number'] ;
						if($sup) {
							$sup = str_replace(" ","<sup>",siteConfig('version'));
							$sup = $sup."</sup>";
						}
						@unlink("../../../../installer.php");
						?>
						<script>		
							$(document).ready(function() {
								$('.patching').html("<img src='apps/app_config/controller/load.gif' style='margin: -5px 3px -4px -4px'/> Extracting packages <?php echo $p['number']."...(".$_POST['patching']; ?>)");
								$.ajax({
									type: "POST",
									data: "patching=<?php echo $_POST['patching']+=1; ?>",
									url: "apps/app_config/controller/updater.php",
									success: function(data){
										$("#update #updater_id").html(data);
										$(".version-val").html("<?php echo $sup; ?>");	
										$('.patching').html("<img src='apps/app_config/controller/load.gif' style='margin: -5px 5px -4px -4px'/> Extracting packages <?php echo $p['number']."...(".$_POST['patching']; ?>)");
									}
								});	
							});		
						</script>
				
				
				<?php
					}
					else { 
						echo "<span class='fail'>Failed</span>";$_POST['patching'] = false;
					}
				?> 
				<?php 
				}
				else {
					$_POST['patching'] = false;
					echo "Download packages failed.";
				}
			}
			
			if(isset($_POST['patching']) AND $site_version != $latest_version AND $_POST['patching'] != false){ 				
				echo "<div class='patching'>Downloading file</div>";
			}
			else if($site_version == $latest_version) {
				echo "<span class='updated'>Updated!</span>";
			} 
			else if($site_version > $latest_version) {
				echo "<a href='http://www.fiyo.org/download' target='_blank'><span class='error'>Your version is not valid!<br>Check the latest version here!</span></a>";
			}
			else if (isset($fail)) {
				echo "Update Failed!";
			}	
			else {
				echo "<button class='button update-now'>Update Now</button>";
			}	
		?>
		</td>
	</tr>
</table>
<script>	
	$(".update-now").click(function() {
		$(".fail").hide();
		$(this).html("<img src='apps/app_config/controller/load.gif' style='margin: -5px 3px -4px -4px'/> Downloading File <?php echo $latest_version; ?>");
		$.ajax({
			type: "POST",
			data: "patching=1",
			url: "apps/app_config/controller/updater.php",
			success: function(data){
				$("#update #updater_id").html(data);
				$(this).removeCss(".update-now");
			}
		});		
	});		
</script>
<?php else : ?>
Access Denied
<?php endif; ?>
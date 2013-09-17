<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

if(isset($_SESSION['fiyowidth']))	
	if($_SESSION['fiyowidth'] != 'warp') {
		echo '<script type="text/javascript">
				$(document).ready(function() {	
				$("#warp").removeClass("warp");
				$("#warp2").removeClass("warp");
				});
			</script>';
	}					
	else {	
		echo '<script type="text/javascript">
				$(document).ready(function() {	
				$("#warp").addClass("warp");
				$("#warp2").addClass("warp");					
			  });
			  </script>';
	}

	
function sub_menu_category($id) {
	$db = new FQuery();  
	$db->connect(); 
	$sql=$db->select(FDBPrefix.'article_category','*','parent_id='.$id,"name ASC"); 
	$sum=mysql_num_rows($sql);
	if($sum) {
		echo "<span style='position: absolute; right:15px; top:6px;'> &raquo;</span> <ul>";
		$no=1;
		while($cat=mysql_fetch_array($sql))				
		{	
			$sql2=$db->select(FDBPrefix.'article','*',"category=$cat[id]");
			$sum2=angka(mysql_num_rows($sql2));
			if($no==$sum){$cl=" class='endsub'";}else{ $cl='';}
			if($no==1) $cl .=" style='border-top:0;'";
			echo "<li$cl><a class='link'  href='?app=article&cat=$cat[id]'>$cat[name] <span class='total_article'>$sum2</span></a>";
			sub_menu_category($cat['id']);
			echo"</li>";
			$no++;
		}
		echo "</ul>";
	}
}

function module($file) {
	require("module/$file.php");
}

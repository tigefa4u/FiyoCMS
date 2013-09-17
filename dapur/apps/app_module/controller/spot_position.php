<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

//set single flag file
define('_FINDEX_',1);

//load query and function files
require_once ('../../../system/jscore.php');
require_once ('../../../../system/html.php');

//logical for image spot and auto fill
if(isset($_GET['type'])) {
	$name = siteConfig('site_theme');
	echo '<script type="text/javascript"> $(function() {$("area").click(function() { $("#easy_popup_content").hide();$("#easy_popup").hide(); var name = $(this).attr("alt"); $("#position").val(name);});});  </script>';
	$spotPosition = "../themes/$name";
	
	$html = file_get_html("../../../../themes/$name/spot_position.php");
	
	foreach($html->find('img') as $element) 
       $img = $element->src;
	$html = str_replace("$img","../themes/$name/$img",$html);
	echo $html;
	
}
else {
	$name = siteConfig('site_theme');
	$html = file_get_html("../../../../themes/$name/index.php");
	$pos = str_replace("loadModule('","{",$html);
	$pos = str_replace("')","}",$pos);
	
	preg_match_all('/\{(.*?)\}/',$pos,$position);  
	if(!empty($position[1])) {
		foreach($position[1] as $val) echo "$val\n";
	}
	
}
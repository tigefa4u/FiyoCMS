<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	Article Rating
**/

session_start();

$id = $_GET['id'];

require('../../../config.php'); 
$table = $DBPrefix."article";

$dbq=mysql_connect ("$DBHost", "$DBUser", "$DBPass") or die ();
mysql_select_db ("$DBName",$dbq);

if(isset($_GET['do'])) {
	if($_GET['do']=='rate'){

		$rating = $_GET['rating'];
		// do rate
		rate($table,$id,$rating);
	}
	else if($_GET['do']=='getrate'){	
		// get rating
		getRating($table,$id);
	}
}

function param_basic($x,$p,$s) {
$param = $x."=";
$stlen = strlen($param);
$npost = strpos($p,$param);
$param = substr($p,$npost);
$break = strpos($param,"$s")-$stlen;
$param = substr($p,$stlen+$npost,$break);
return $param;
}

function mod_param($type,$param){
$type = param_basic("$type",$param,";");
return $type;
}

// function to retrieve
function getRating($table,$id){
$sql= "select * from $table where id=$id";
$result=@mysql_query($sql);
$qr=@mysql_fetch_array($result);
$va = mod_param('rate_value',$qr['parameter']);
$vo = mod_param('rate_counter',$qr['parameter']);
$rating = (@round($va / $vo,1)) * 20; 
echo $rating;
}

// function to insert rating
function rate($table,$id,$rating){
	$sql= "select * from $table where id=$id";	
	$result=@mysql_query($sql);
	$qr=@mysql_fetch_array($result);
	$va = mod_param('rate_value',$qr['parameter']);
	$rating += $va;
	$vo = mod_param('rate_counter',$qr['parameter']);
	
	if(!is_numeric($voter) or !is_numeric($rate)) $vo1 = 0;
	$vo1 = $vo+1;
	$param = $qr['parameter'];
	
	$pva = strpos($param,"rate_value=$va");
	if($pva)		
		$param = str_replace("rate_value=$va","rate_value=$rating",$param);
	else		
		$param .= "rate_value=$rating".";\n";
		
		
	$pvo = strpos($param,"rate_counter=$vo");
	if($pvo)	
	$param = str_replace("rate_counter=$vo","rate_counter=$vo1",$param);
	else
		$param .= "rate_counter=$vo1".";\n";
	
	$param = strip_tags($param);
	$update = "update $table set parameter = '$param' WHERE id = $id";	
	$result=@mysql_query($update);
	if($result)		
		$_SESSION["article_rate_$id"]=1;
}

?>

<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	Halaman ini berisi tentang funsi-fungsi dasar FiyoCMS.
**/

defined('_FINDEX_') or die('Access Denied!');

/****************************************/
/*			 Query Function 			*/
/****************************************/

/* Connect to database */
$db = new FQuery();  
$db -> connect();
			
/* basic query function */
function FQuery($table, $where = null, $output = null, $hide = null, $order = null, $select = null) {	
	$db = new FQuery();  
	if(empty($select)) $select = "*";
	$sql = $db->select(FDBPrefix."$table","$select","$where","$order");
	if(!$sql) {
		if(!isset($hide))
			echo "<b>Error</b> :: failed to use <b>FQuery</b> function. Please check table <b>$table</b> or your sql (<b>$where</b>) or field (<b>$output</b>)<br>";	
	}
	else {
		$row = mysql_fetch_array($sql); 
		$sum = mysql_affected_rows();
		if(!empty($output))
			return @$row[$output] ;
		else
			return $sum;
	}
}

//query database untuk satu output
function oneQuery($table,$field,$value,$output = null) {
	$query = FQuery($table,"$field=$value",$output);
	return $query;	
}

/* Website Global Information */
function siteConfig($name) {
	$output = oneQuery('setting','name',"'$name'",'value');
	return $output;
}

/********************************************/
/*  		   Site Information	 		 	*/
/********************************************/
// mengambil data informasi dari user yang sudah login
function userInfo($value = null,$id = null) {
	if(empty($id) AND !empty($_SESSION['USER_ID']))  {
		$id = $_SESSION['USER_ID'];
		$value = strtolower($value);
		if($value == 'id' or !isset($value)) $value = 'user_id';
		$output = oneQuery('session_login','user_id',"'$id'","$value");	
		if(!empty($output))
			return $output;
		else false;
	} 
	if(!empty($id))  {
		return oneQuery('user','id',$id,$value);
	} 
	else if($value == 'level') {
		return 99;
	}
	else {
		return false;
	}
}

// mengambil informasi menu
function menuInfo($value, $url = null, $id = null) {
	if(empty($id)) {
		if(empty($url)) $url = getLink(); 
		return FQuery('menu',"link LIKE '%$url%' AND status=1","$value");
	}
	else {
		return FQuery('menu',"id = $id AND status=1","$value");
	}
}

// mengambil data halaman
function pageInfo($id,$output,$field = null) {	
	if(!$field) $field = 'id';
	$output = oneQuery('menu',$field,$id,$output);
	return $output;
}

// mengambil data home page
function homeInfo($field) {
	$output = oneQuery('menu','home',1,$field);
	return $output;
}

/* Base site url */
function FUrl($www = null) {
	$furl = str_replace('index.php','',$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]);
	if(_FINDEX_=='BACK') {
		$jurl = substr_count($furl,"/")-1;
		$ex = explode("/",$furl);
		$no = 1 ;
		$FUrl = '';
		foreach($ex as $b) {$FUrl .= "$b/";  if($no==$jurl) break; $no++;}	
	}
	else {
		$FUrl= $furl;
	}
	
	if(siteConfig('sef_www') or isset($www))
		return $FUrl;
	else
		return str_replace("www.","",$FUrl);
}

/********************************************/
/*  		 Parameter Function 		  	*/
/********************************************/
//fungsi parameter dasar 
function param_basic($x,$p,$s) {
	$param = $x."=";
	$stlen = strlen($param);
	$npost = strpos($p,$param);
	$param = substr($p,$npost);
	$break = strpos($param,"$s")-$stlen;
	$param = substr($p,$stlen+$npost,$break);
	return $param;
}

//parameter untuk url
function url_param($value){
	if(	strpos($_SERVER['REQUEST_URI'],"?$value=") > 0 or 
		strpos($_SERVER['REQUEST_URI'],"&$value=") > 0 ) {
		$value = param_basic("$value",$_SERVER['REQUEST_URI'].'&',"&");
		return $value;
	}
}

//parameter untuk link
function link_param($type,$param){
	$value = param_basic("$type","$param&","&");
	return $value;
}

//parameter untuk modul
function mod_param($type,$param){
	$type = param_basic("$type",$param,";");
	return $type;
}

//parameter untuk menu
function menu_param($value,$id = null){
	if(empty($id) AND defined('Page_ID')) $id = Page_ID;
	$param = oneQuery('menu','id',$id,'parameter');
	return mod_param("$value",$param);
}

//parameter app -> mengambil nilai dari link (url)
function app_param($output = null){	
	if(empty($output)) $output = 'app';
	if(checkHomePage())
		$source = homeInfo('link').'&';
	else if(!empty($_GET["app"]))
		$source = getUrl().'&';
	else if(isset($_REQUEST['link'])) //tidak aktif ketika di AdminPanel
		$source = check_permalink('permalink',$_REQUEST['link'],'link').'&';
	else
		$source = null;
	if(strpos("$source",$output))
		return param_basic("$output",$source,'&');
}

//mengambil tag html atau nilai di dalam tag tersebut
function getHtmlTag($text,$first,$second) {
	$a = 1;
	while(is_int(1))	{
		$a = strpos($text,$first);
		$b = strpos($text,$second);
		if(!is_int($b) AND is_int($a))
			$text = substr($text,0,$a);	
		else if(!is_int($a) or !is_int($b)) 		
			break;
		$c = substr($text,$a,$b-$a+1);
		$text = str_replace($c,"",$text);
	}
	return $text;
}

function stripTags($text, $tags = null)
{  
  // replace php and comments tags so they do not get stripped  
  $text = preg_replace("@<\?@", "#?#", $text);
  $text = preg_replace("@<!--@", "#!--#", $text);
  
  // strip tags normally
  $text = strip_tags($text, $tags);
  
  // return php and comments tags to their origial form
  $text = preg_replace("@#\?#@", "<?", $text);
  $text = preg_replace("@#!--#@", "<!--", $text);
  
  return $text;
}

function htmlToText($text)
{  
  // replace php and comments tags so they do not get stripped  
  return stripTags($text);
}
/********************************************/
/*  		   URL & Redirecting	 	 	*/
/********************************************/
//fungsi redirect menggunakan php
function redirect($url) {
	header("location:".$url);
}

//fungsi redirect menggunakan html
function htmlRedirect($link,$time = null) {
	if($time) $time = $time; else $time = 0;
	echo "<meta http-equiv='REFRESH' content='$time; url=$link'>";
}

//check link/permalink
function check_permalink($field,$value ,$output = null, $like = null) {
	if(empty($like))
		$link = FQuery("permalink","$field = '$value'",$output);
	else
		$link = FQuery("permalink","$field LIKE '%$value%'",$output);
	if(empty($value) or empty($link))
		$link = false;
	else if(empty($output) AND $link > 0) 
		$link = true;
	return $link;
}

//check url
function check_url_exists($url){
	$header_response = get_headers($url, 1);
	if ( strpos( $header_response[0], "404" ) !== false )
	{
	  return false;
	}
	else
	{
	   return true;
	}
}

//mengecek apakah halaman yang terbuka adalah halaman homepage	
function checkHomePage(){
	
	$link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	//check curent paging
	$a=strpos($_SERVER['REQUEST_URI'],"?page=");	
	if($a!==0) 	$page=substr($_SERVER['REQUEST_URI'],$a+6);
	$link = @str_replace("?page=$page","",$link);
	$link = str_replace("index.php","",$link);	
	if(FUrl('auto') == $link or empty($link))
		return true;
	else if(isset($_REQUEST['link'])) {
		$c = check_permalink('permalink',@$_REQUEST['link'],'link');
		$b = homeInfo('link');
		if($c == $b) return true;
	}
	else
		return false;
}

//mengambil url yang aktif
function getUrl() {
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = str_replace("'","",$url);
	if(!empty($_SERVER['HTTPs']))
		$url = "https://".$url;
	else
		$url = "http://".$url;
	return	$url;
}		

//mengambil url dari parameter yang ada
function getLink() {
	if(defined('SEF_URL') AND _FINDEX_ != 'BACK') {
		$eqpos = strpos($_SERVER['REQUEST_URI'],"=");
		$tapos = strpos($_SERVER['REQUEST_URI'],"?");
		$link = substr($_SERVER['REQUEST_URI'],$tapos);
		if(isset($_GET['pid'])) $link = str_replace("&pid=$_GET[pid]","",$link);
		$link = str_replace("&pid=","",$link);
	}
	else {	
		$trim = strlen(siteConfig('sef_extention'));
		$link = str_replace(siteConfig('site_url'),"",getUrl());
		$trim = strlen($link)-$trim;
		if(defined('SEF_URL'))  
		$link = substr($link,0,$trim);
		else
		$link = substr($link,0);
	}
	
	//no inject please :)	
	$link = str_replace("'","",$link);
	$link = str_replace('"',"",$link);
	if(checkLocalhost()) {
		$base = str_replace('localhost','',FBase);
		$link = str_replace($base,'',$link);
	}
	if(SEF_URL AND check_permalink('permalink',$link,'link')) {
		$link = check_permalink('permalink',$link,'link');	
	}
	return $link;
}

//mengambil konten dari seuatu url yang membutuhkan cURL
function url_get_contents($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

/********************************************/
/*  		  File and Directory 			*/
/********************************************/
//melakukan ekstraksi file zip kedalam folder tujuan
function extractZip($file,$directory) {
	$zip = new ZipArchive;
    $res = $zip->open($file);
    if ($res === TRUE ) {
		$zip->extractTo($directory);
        $zip->close();
		return true;
	}
	else
		return false;
}

//menghapus direktori dan semua isinya
function delete_directory($dirname) {
   if(is_dir($dirname))
      $dir_handle = opendir($dirname);
   if(!isset($dir_handle))
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname."/".$file))
            unlink($dirname."/".$file);
         else
            delete_directory($dirname.'/'.$file);       
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}

//fungsi duplikat direktori/folder
function copy_directory($source, $destination, $cut = null) {
	$copy = false;
	if ( is_dir( $source ) ) {
		@mkdir( $destination );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
			if ( $readdirectory == '.' || $readdirectory == '..' ) {
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) {
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			$copy = copy( $PathDir, $destination . '/' . $readdirectory );
		}
		$directory->close();
	}else {
		$copy = copy( $source, $destination );
	}
	if(isset($cut)) delete_directory( $source );
	if($copy) return true;
	else return false;
}

/********************************************/
/*  		    Loader Function				*/
/********************************************/

//memanggil extensi FiyoCMS (Apps, plugin, template)
function loadExtention() {
	include ("system/extention.php");
}

//memuat plugins yang aktif
function loadPlugin() {	
	$db = new FQuery();   
	$qrs = $db->select(FDBPrefix.'plugin','*',"status=1");	
	while($qr=mysql_fetch_array($qrs)){	
		$folder = "plugins/$qr[folder]/$qr[folder].php";
		if(file_exists($folder))
			require $folder;
		else
			echo alert("error","Error : failed to open {<i>$folder</i>}",true,true);
	}
}

function loadLang($dir = null) {
	$lang = siteConfig('lang');
	if(empty($lang)) $lang = 'en';
	$file = "$dir/lang/$lang.php";
	if(file_exists($file))
		include ("$dir/lang/$lang.php");
	else
		echo "<div style='border: 2px solid #09f; font-size: 12px; font-family: Arial;background: #FCF0F0;border: 2px solid #F07272;padding: 5px; color :  rgb(199, 69, 69);'><b>Error</b> : Failed to load \"$file\"</div>";
}

//memanggul fungsi RSS Feed
function loadFeed() {
	include ("system/feed.php");
}

//memanggil fungsi paging
function loadPaging(){
	if(!defined('loadPaging')) {
		include("system/paging.php");	
		define('loadPaging',1);
	}
}

//memanggil file JavaScript
function addJs($link) {	
	echo "<script type='text/javascript' src='$link'></script>";
}	

//memanggil file CSS
function addCss($link,$media = null) {
	if(empty($media)) $media = 'all';
	echo  "<link href='$link' rel='stylesheet' type='text/css' media='$media' />";
}	

/********************************************/
/*  		 Additional Function			*/
/********************************************/
//format angkat model pertama
function angka($x) {
	return number_format("$x",0,",",".");
}

//format angkat model kedua
function angka2($x) {
	return number_format("$x",2,",",".");

}

function checkOnline() {
	exec(sprintf('ping -c 1 -W 5 %s', @escapeshellarg('www.google.com')), $res, $rval);
    return $rval;
}

function formRefill($input_name, $val=null, $txt=null) {	
	if(isset($_POST["$input_name"]) AND empty($val)) 
		$val = $_POST["$input_name"];
	if(isset($_POST["$input_name"]) or !empty($val))  {
		if($txt == "textarea")
			echo "$val"; 
		else
			echo "value=\"$val\""; 
		
	}
	
}

function randomString($length, $valid_chars = null) {
	if(empty($valid_char)) 
		$valid_chars ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    // start with an empty random string
    $random_string = "";

    // count the number of chars in the valid chars string so we know how many choices we have
    $num_valid_chars = strlen($valid_chars);

    // repeat the steps until we've created a string of the right length
    for ($i = 0; $i < $length; $i++)
    {
        // pick a random number from 1 up to the number of valid chars
        $random_pick = mt_rand(1, $num_valid_chars);

        // take the random character out of the string of valid chars
        // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
        $random_char = $valid_chars[$random_pick-1];

        // add the randomly-chosen char onto the end of our string so far
        $random_string .= $random_char;
    }

    // return our finished random string
    return $random_string;
}

function cutWords($sentence,$word_count) {
	$space_count = 0;
	$print_string = null;
	for($i=0; $i < strlen($sentence); $i++)	{
		if($sentence[$i]==' ')
			$space_count ++;
			$print_string .= $sentence[$i];
		if($space_count == $word_count)
			break;
	}
	return $print_string;
}

function checkLocalhost() {
	if($_SERVER['SERVER_ADDR'] == '127.0.0.1' or $_SERVER['SERVER_ADDR'] == '::1' )
		return true;
}
//check mobile platform
function checkMobile()
{
	if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
		return true;

	else
		return false;
}

function thisTime() {
	return date("Y-m-d H:i:s",time());
}


//status informasi pada saat eksekusi database
function alert($type, $text = null, $echo = null, $style = null){
	if($style == true or $style == 1 or !empty($style)) {
		if($type=='info'){
			$alert = "<div style='border: 2px solid #18A740;font-size: .8em;font-family: Arial;background: #E2FFEF;padding: 10px; color : #18A740'>$text</div>";
		}
		else if($type=='error')	{
			$alert = "<div style='border: 2px solid #09f; font-size: .8em; font-family: Arial;background: #FCF0F0;border: 2px solid #F07272;padding: 10px; color : #C42929'>$text</div>";
		}
	}
	else {
		if($type=='info'){
			$alert = "<div class='notice info' $style>$text</div>";
		}
		else if($type=='error')	{
			$alert = "<div class='notice error' $style>$text</div>";
		}
		else if($type=='loading')		
			$alert = "<div id='loading'></div>";
	}
	
	if(!$echo) echo $alert; else return $alert;
}

//fungsi multiple select yang telah terpilih
function multipleSelected($x, $y) {
	$p = explode(",",$x);
	foreach($p as $page){
		if($y==$page)
		return 'selected';	
	}
}

//fungsi multiple select yang baru akan dipilih
function multipleSelect($x) {
	if($x) {
		$no = 1; $text = null;
		foreach ($x as $t){
			if($no==1)
				$t = "$t";
			else
				$t = ",$t";
			$text .= $t;
			$no++;
		}
		return $text;
	}
}

//fungsi multiple select yang telah terpilih
function multipleDelete($table, $source, $item = null, $cat = null, $except = null, $sub = null) {
	$db = new FQuery();  
	$del = explode(",",$source);
	if(!isset($except)) $except = null; else $except = $except;
	if(!empty($cat)){ $cat = $fid = $cat; } else{ $cat = 'category'; $fid ='id';}
	if(isset($source))
		foreach($del as $id){
			if(!empty($item)) {
				if(!empty($except)) 
					$art = $db->select(FDBPrefix."$item",'*',"$except AND $cat ='$id'");	
				else
					$art = $db->select(FDBPrefix."$item",'*',"$cat ='$id'");
					
				if(@mysql_num_rows($art)>0) {
					$noempty = 1;					
					break;
				}				
				if(!isset($noempty))	
					if(!empty($sub)) {
						if(!oneQuery($table,'parent_id',$id))
							$qr = $db->delete(FDBPrefix.$table,"$fid='$id'");
						else 						
							$noempty = 1;	
					}
					else
						$qr = $db->delete(FDBPrefix.$table,"$fid='$id'");						
				else 						
					$noempty = 1;	
			}
			else {
				if(isset($sub)) {
					if(!oneQuery($table,'parent_id',$id))
						$qr = $db->delete(FDBPrefix.$table,"$fid='$id'");
					else 						
						$noempty = 1;	
				}
				else
					$qr = $db->delete(FDBPrefix.$table,"$fid='$id'");
			}
		}
	if(isset($qr)) return 1;
	else if(isset($noempty)) return 'noempty';
	else return null;
}

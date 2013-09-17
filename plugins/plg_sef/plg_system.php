<?php
/**
* @name			Plugin SEF
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');
/************* SEF PAGINATION FUNCTION *****************/
function redirect_www() {
	if($_SERVER['SERVER_ADDR'] != '127.0.0.1' or $_SERVER['SERVER_ADDR'] != '::1' ) {
		if(siteConfig('site_www')) {
			if(!strpos(FUrl,"//www.")) {
				$link = getUrl();
				$link = str_replace("http://","http://www.",$link);
				redirect($link);
			}
		}
		else {
			if(strpos(FUrl,"//www.")) {
				$link = getUrl();
				$link = str_replace("http://www.","http://",$link);
				redirect($link);
			}
		}
	}
}

function redirect_link(){
	if(!checkHomePage()){
		$app = app_param('app');	
		if(SEF_URL) {
			if(empty($app) AND $_SESSION['MAX_REDIRECTING'] != getUrl()) {
			$_SESSION['MAX_REDIRECTING'] = '';
			//redirect for 404 page
				$link = str_replace(FUrl,"",getUrl());
				$linl = strlen($link);
				$max = 0;
				while($linl) {	
					if(substr($link,$linl-1) == "/") {					
						$link = substr($link,0, $linl-1);
					}					
					$got = FQuery("permalink","permalink LIKE '$link%'");
					$linl = strlen($link);
					if($linl < 4 or $max == 20 ){
						$_SESSION['MAX_REDIRECTING'] = getUrl();
						break;
					}
					else if($got) {
						$link = FQuery("permalink","permalink LIKE '$link%'","permalink");
						break;
					}
					$link = substr($link,0, $linl-1);
					$max++;
				}
				if($got)
					redirect(FUrl.$link);
			}
			else if(!empty($app)) {	
				// nothing :D
			}
			else if(SEF_EXT == 0 or SEF_EXT == '') {
				$sum = strlen(getUrl());
				$rev = strrev(getUrl());
				if(!strpos(getUrl(),'?')) {
					$pos = substr(getUrl(),$sum-1);
					if($pos == "/")
						redirect(substr(getUrl(),0,$sum-1));
				}
			}
		}
		else {
			$direct = check_permalink('link',$_SERVER['REQUEST_URI'],'permalink');
			$xurl =  'http://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
			$gurl = str_replace(FUrl,'',$xurl);
			$strt = strlen($gurl);
			$x = 1;
			while($strt) {
				$val =  substr($gurl,0,$strt);
				if(check_permalink('permalink',$val,'link')) {
					if(str_replace($val.SEF_EXT,'',$xurl) != FUrl)
						if(_Page == 0)
					break;				
				}				
				$strt -= 1;
				$x++;			
			}
			$url =  check_permalink('permalink',$val,'link');
			$pid =  check_permalink('permalink',$val,'pid');
			//echo FUrl.$url;//redirect(FUrl.$url.SEF_EXT);
		}
	}
}
function add_permalink($title, $cat = NULL, $pid = null, $ext = null) {
	$page = _Page;
	if(!preg_match("/[0-9]/",$page))
		$page = null;
	if(SEF_URL AND !checkHomePage() AND !is_numeric(_Page))
	{
		$db = new FQuery();  
		$db->connect(); 		
		$eqpos = strpos($_SERVER['REQUEST_URI'],"=");
		$tapos = strpos($_SERVER['REQUEST_URI'],"?");
		if($eqpos >0 AND $tapos>0 AND empty($_GET['page'])){		
			$permalink = str_replace(" ","-",strtolower($title));
			$category = str_replace(" ","-",strtolower($cat));
			
			if(!empty($cat))
				$permalink = strtolower($category)."/".$permalink;
			else
				$permalink = $permalink;				
		
			
			while(substr_count($permalink,"["))
			{
				$permalink = str_replace("[","",$permalink);
			}
			
			while(substr_count($permalink,"]"))
			{
				$permalink = str_replace("]","",$permalink);
			}
			
			while(substr_count($permalink,"("))
			{
				$permalink = str_replace("(","",$permalink);
			}
			
			while(substr_count($permalink,")"))
			{
				$permalink = str_replace(")","",$permalink);
			}
			
			while(substr_count($permalink,"{"))
			{
				$permalink = str_replace("{","",$permalink);
			}
			
			while(substr_count($permalink,"}"))
			{
				$permalink = str_replace("}","",$permalink);
			}
			
			while(substr_count($permalink,"&"))
			{
				$permalink = str_replace("&","",$permalink);
			}
			
			/************ ? removal **************/
			while(substr_count($permalink,"?"))
			{
				$permalink = str_replace("?","",$permalink);
			}
			
			/************ + removal **************/
			while(substr_count($permalink,"+"))
			{
				$permalink = str_replace("+","",$permalink);
			}/************ # removal **************/
			while(substr_count($permalink,"#"))
			{
				$permalink = str_replace("#","",$permalink);
			}
			/************ & removal **************/
			while(substr_count($permalink,"\&"))
			{
				$permalink = str_replace("\&","",$permalink);
			}
			
			/************ . removal **************/
			while(substr_count($permalink,"."))
			{
				$permalink = str_replace(".","-",$permalink);
			}
			
			/************ ! removal **************/
			while(substr_count($permalink,"!"))
			{
				$permalink = str_replace("!","",$permalink);
			}
			
			/************ ` removal **************/
			while(substr_count($permalink,"`"))
			{
				$permalink = str_replace("`","",$permalink);
			}
			
			/************ ' removal **************/
			while(substr_count($permalink,"'"))
			{
				$permalink = str_replace("'","",$permalink);
			}
			
			/************ " removal **************/
			while(substr_count($permalink,"\""))
			{
				$permalink = str_replace('"',"",$permalink);
			}
			/************ " removal **************/
			while(substr_count($permalink,'|'))
			{
				$permalink = str_replace('|',"",$permalink);
			}
			/************ % removal **************/
			while(substr_count($permalink,'%'))
			{
				$permalink = str_replace('%',"",$permalink);
			}
			/************ * removal **************/
			while(substr_count($permalink,'*'))
			{
				$permalink = str_replace('*',"",$permalink);
			}/************ ^ removal **************/
			while(substr_count($permalink,'^'))
			{
				$permalink = str_replace('^',"",$permalink);
			}	
			/************ \ removal **************/
			while(substr_count($permalink,'\\'))
			{
				$permalink = str_replace("\\","",$permalink);
			}
				
			/************ , removal **************/
			while(substr_count($permalink,','))
			{
				$permalink = str_replace(",","",$permalink);
			}
			
			/************ $ removal **************/
			while(substr_count($permalink,'$'))
			{
				$permalink = str_replace("$","",$permalink);
			}
			
			/************ @ removal **************/
			while(substr_count($permalink,'@'))
			{
				$permalink = str_replace("@","",$permalink);
			}
			while(substr_count($permalink,"--"))
			{
				$permalink = str_replace("--","-",$permalink);
			}
			if(app_param('app') == 'article') {
				if(app_param('view') == 'category')
					$art = app_param('id');
				else if(app_param('view') == 'item')
					$art = articleInfo('category');
				else if(app_param('tag') != null);					
					while($art) {
					$a = FQuery('menu','link',"'?app=article&view=category&id=$art'",'id');
					$art = FQuery('article_category','id',$art,'parent_id');	
					if($a) break;
				}
				
				
			}
			
			
			
			$page = Page_ID;;
				
			if($pid) $page = $pid;
			$link = getLink();
			
			if(!empty($category) AND empty($ext)) $permalink = $permalink.SEF_EXT;
			else if(!empty($ext)) $permalink = "$permalink.$ext";
			
			if(check_permalink('link',$link))
				redirect(FUrl.$permalink);
			else if(!empty($permalink)){	
				if($c = check_permalink('permalink',$permalink)) {
					$x = 2;
					while($c) {
						$p = "$permalink-$x";
						$c = check_permalink('permalink',"$p");
						$x++;
					}
					$permalink =  $p;
					
				}
				
				if(!empty($permalink) AND $permalink != "-")	
					$qr=$db->insert(FDBPrefix.'permalink',array("","$link","$permalink",$page,1,0)); 
				if(isset($qr))
					redirect(FUrl.$permalink);
			}
				
		}	
	}	
}

function make_permalink($source, $id = null, $page = null,$like = null){			
	if(SEF_URL)
	{
		$db = new FQuery();  
		$db -> connect(); 
		$sql  = $db->select(FDBPrefix."permalink","*","link ='$source'");
		if($like == true)
		$sql  = $db->select(FDBPrefix."permalink","*","link LIKE '%$source%'");
		$link = mysql_fetch_array($sql);		
		$link = FUrl."$link[permalink]";
		if(!empty($id)) 	{
			$source = FUrl.$source;
		}
		else {
			$source = FUrl.$source;
		}
		if(mysql_affected_rows()>0)
			$source = $link;
		else
			$source = $source;
	}
	else if((defined('Page_ID')) or  $_GET['id'] = Page_ID)
	{
		$source = FUrl."$source";
	}
	return str_replace("&","&amp;",$source);
}
function delete_permalink($link) {
	$db = new FQuery();  
	$db -> connect(); 
	$db->delete(FDBPrefix.'permalink',"permalink='$link'");
}

function link_paging($ext) {	
	$link = $_SERVER['REQUEST_URI']."$ext";
	$link = str_replace("?page=$_GET[page]","",$link);
	$link = str_replace("&page=$_GET[page]","",$link);
	return $link;
}

function generateDesc($code) {
	$pagedesc=htmlToText($code);
	$padding = substr($pagedesc, 89);
	if ($padding === 0)
		return $pagedesc; 
	$length = strpos($padding, ".");
	if ($length === 0) 
		return $pagedesc; 
	$pagedesc = str_replace (",", "", $pagedesc);
	$pagedesc = str_replace (")", "", $pagedesc);
	$pagedesc = str_replace ("(", "", $pagedesc);
	$pagedesc = str_replace (".", "", $pagedesc);
	$pagedesc = str_replace ("'", "", $pagedesc);
	$pagedesc = str_replace ('"', "", $pagedesc);
	$pagedesc = str_replace ("\n", "", $pagedesc);
	$pagedesc = str_replace ("&amp;", "", $pagedesc);
	$pagedesc = str_replace ("&gt;", "", $pagedesc);
	$pagedesc = str_replace ("\t", " ", $pagedesc);
	$pagedesc = str_replace ("   ", " ", $pagedesc);
	$pagedesc = str_replace ("  ", " ", $pagedesc);
	$pagedesc = str_replace ("&nbsp;", " ", $pagedesc);
	return substr($pagedesc, 0, $length + 81); 
}

function generateKeywords($text) {

	$parsearray[] = htmlToText($text);
	$parsestring = "z ".strtolower(join($parsearray," "))." y";
	$parsestring = str_replace (",", "", $parsestring);
	$parsestring = str_replace (")", "", $parsestring);
	$parsestring = str_replace ("(", "", $parsestring);
	$parsestring = str_replace (".", "", $parsestring);
	$parsestring = str_replace ("'", "", $parsestring);
	$parsestring = str_replace ('"', "", $parsestring);
	$parsestring = str_replace ("\n", "", $parsestring);
	$parsestring = str_replace ("\t", " ", $parsestring);
	$parsestring = str_replace ("&gt;", " ", $parsestring);
	$parsestring = str_replace ("&amp;", "", $parsestring);
	$parsestring = str_replace ("&nbsp;", " ", $parsestring);

$commonwords = <<<EOF
the a if i you to when of if can while was and it in that with my so at for up on by this from be as me some her she time again were down back would his brother both all one needed not had after there out lot quite many know no but like who your will we is are or our have an more what us which its being anda kita kami jika untuk lalu dari dapat hingga dan itu dalam bahwa dengan saya sehingga jadi di pada untuk oleh ini dari menjadi sebagai bisa melalui akan ingin pilih yang dapatkan tentang menemukan yaitu adalah saya beberapa dia waktu lagi mana kembali atau into ? / - later these : . " ' following \\ such over ensure months
EOF;

	$commonarray = @split(" ",$commonwords);

	for ($i=0; $i<count($commonarray); $i++) {
	   $parsestring = str_replace (" ".$commonarray[$i]." ", " ", $parsestring);
	}

	$parsestring = str_replace ("  ", " ", $parsestring);
	$parsestring = str_replace ("  ", " ", $parsestring);
	$parsestring = str_replace ("  ", " ", $parsestring);

	$wordsarray = @split(" ",$parsestring);

	for ($i=0; $i<count($wordsarray); $i++) {
	   $word = $wordsarray[$i];
	   if (@$freqarray[$word]) {
		   $freqarray[$word] += 1;
	   } else {
		   $freqarray[$word]=1;
	   }
	}

	arsort($freqarray);
	$i=0;
	while (list($key, $val) = each($freqarray)) {    
	   $i++;
	   $freqall[$key] = $val;
	   if ($i==15) {
		  break;
	   }
	} 

	for ($i=0; $i<count($wordsarray)-1; $i++) {
	   $j = $i+1;
	   $word2 = $wordsarray[$i]." ".$wordsarray[$j];
	   if (@$freqarray2[$word2]) {
		   $freqarray2[$word2] += 1;
	   } else {
		   $freqarray2[$word2]=1;
	   }
	}

	arsort($freqarray2);

	$i=0;
	while (list($key, $val) = each($freqarray2)) {    
	   $i++;
	   $freqall[$key] = $val;
	   if ($i==4) {
		  break;
	   }
	} 

	for ($i=0; $i<count($wordsarray)-2; $i++) {
	   $j = $i+1;
	   $word3 = $wordsarray[$i]." ".$wordsarray[$j]." ".$wordsarray[$j+1];
	   if (@$freqarray3[$word3]) {
		   $freqarray3[$word3] += 1;
	   } else {
		   $freqarray3[$word3]=1;
	   }
	}

	arsort($freqarray3);

	$i=0;
	while (list($key, $val) = each($freqarray3)) {    
	   $i++;
	   $freqall[$key] = $val;
	   if ($i==1) {
		  break;
	   }
	} 

	arsort($freqall);

	$keys = $pagecontents = "";

	while (list($key, $val) = each($freqall)) {    
	   $pagecontents .= "$key => $val<br>";
	   if(strlen($key) > 2)
	   $keys .= "$key, ";
	}

	chop($keys);

	return $keys;
}
<?php
/**
* @version		1.5.0
* @package		Fi Download
* @copyright	Copyright (C) 2012 Fiyo Developers.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

function categoryInfo($output) {	
	$id = app_param('id');
	$output = oneQuery('download_category','id',$id ,$output);
	return  $output;
}

function categoryLink($value) {
	$link = make_permalink("?app=download&view=category&id=$value");
	return $link ;
}


function itemLink($value) {
	$link = make_permalink("?app=download&view=item&id=$value");
	return $link ;
}

function labelToLink($labels) {
	$tgs = explode(",",$labels);
	$labels = null;
	foreach($tgs as $label) {				
		$llabel = str_replace(" ","-",$label);			
		$llabel = strtolower($llabel);
		$llabel = "?app=download&label=$llabel";	
		$llabel = make_permalink($llabel);
		$label2 = substr($label,0,1);
		$label3 = strtolower(substr($label,0,1));	
		if(!empty($label2))	
		$labels .= "<li><a href='$llabel' class='$label3' alt='$label' title='$label'>$label2</a></li>";				
	}
	return $labels;
}
	
function downloadConfig($output) {
	$output = oneQuery('download_config','name',"'$output'" ,'value');
	return  $output;

}
function downloadInfo($output) {
	$id = app_param('id');
	$output = oneQuery('download_file','id',$id ,"$output");
	return  $output;
}

function downloadUser($id,$output) {
	$output = oneQuery('download_user','id',$id,"$output");
	return  $output;
}
function downloadParameter($value) {	
	$menu_id = Page_ID;
	$param	 = pageInfo($menu_id ,'parameter');
	$param	 = mod_param($value,$param);
	return 1;
}

function downloadHits() {
	$db = new FQuery();  
	$db->connect();
	$hits = downloadInfo('downloaded') + 1 ;
	$id = downloadInfo('id');
	$db->update(FDBPrefix.'download_file',array("downloaded" => "$hits"),"id =$id");	
}

function downloadFile() {
	$link = downloadInfo('link');
	$hits = downloadInfo('downloaded');	
	if(substr_count($link,"http://") > 0)				
		$file = "$link";
	else
		$file = FUrl."$link";					
/********** update downloaded hist ************/					
	if(!file_exists($file))
	$file = "http://".siteConfig('site_url')."$link";
	header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
	header("Content-Length: " . filesize($file));
	header("Content-Type: application/octet-stream;");
	readfile($file);
}


if(app_param('go') == 'download') {	
	downloadFile();
	downloadHits();
}

class Download {	
	function item($id,$menuId,$DL = null) {		
	
		if(FQuery("download_file","id=$id")) {
		$db = new FQuery();  
		$db->connect();
		$sql=$db->select(FDBPrefix."download_file","*","id=$id AND status=1"); 		
		$qr = mysql_fetch_array($sql);	
		
			if($qr) {
			$category = oneQuery('download_category','id',$qr['category'],'name');
			$catlevel = oneQuery('download_category','id',$qr['category'],'level');
			$author	  = oneQuery('user','id',$qr['author_id'],'name');
			
			if(userLevel <= $catlevel or userLevel <= $qr['level'])  {
				$catlink	= categoryLink($qr['category']);			
				$labels		= labelToLink($qr['label']);
				
				$category = "<a href='$catlink' title='See more $category'>$category</a>";
				
				/*********** File Link *************/
				$x = substr_count($qr['link'],".zip");
				$r = substr_count($qr['link'],".rar");
				$z = substr_count($qr['link'],".7zip");
				if($x > 0 or $r > 0 or $z > 0) {				
					$vlink="?app=download&view=item&id=$qr[id]&go=download";
					$link = make_permalink($vlink);	
					$link = "<a href='$link' class='download' title='Download File'><span>@</span> Download</a>";
				}
				else {
					$link = $qr['link'];				
					$link = "<a href='$link' target='_blank' class='download' title='Download File'><span>@</span> Download</a>";
				}

				/********** author link ***********/
				if(!empty($qr['author_alias'])) 
					$author = $qr['author_alias'];				
				$alink="?app=download&view=author&id=$qr[id]";	
				
				/********** compability file ***********/
				$compability = str_replace(";",", ",$qr['compability']);
				
				/********** date updated ***********/
				if($qr['date_update'] < $qr['date_added'] )
					$qr['date_update'] = $qr['date_added'];
					
				/********** download hits ***********/
				$downloaded = angka($qr['downloaded']);	
				$downloaded = "<a class='download' style='margin-right:0 !important' title='Hits Downloaded'><span>$</span> $downloaded</a>";	
				
				/******* documentation *******/
				$docs = $demo = $support = '';			
				if(!empty($qr['docs']))
					$docs = "<a href='$qr[docs]' title='Documentaion Page' target='_blank'><span>#</span> Documentation</a>";	
				
				/*********** rate ***********/
				$rate = $vrate = $qr['rate'];		
				if($rate == 0)
					$rate = "*****";
				else if($rate <= 0.8 )
					$rate = "/****";
				else if($rate <= 1.2 )
					$rate = "-****";
				else if($rate <= 1.8 )
					$rate = "-/***";
				else if($rate <= 2.2 )
					$rate = "--***";
				else if($rate <= 2.8 )
					$rate = "--/**";
				else if($rate <= 3.2 )
					$rate = "---**";
				else if($rate <= 3.8 )
					$rate = "---/*";
				else if($rate <= 4.2 )
					$rate = "----*";
				else if($rate <= 4.8 )
					$rate = "----/";
				else 
					$rate = "-----";
				$rate = "<div class='rate' style='cursor:pointer'title='Rate $vrate of 5.00'>$rate</div>";
				
				/********** demo link ***********/
				if(!empty($qr['demo']))
					$demo = "<a href='$qr[demo]' title='Demo Page' target='_blank'><span>%</span> Demo</a>";
					
				/********** support link ***********/
				if(!empty($qr['support']))	
					$support = "<a href='$qr[support]' title='Support Page' target='_blank'><span>?</span> Support</a>";	
				
				$this -> download	= $link;
				$this -> docs		= $docs;
				$this -> demo		= $demo;
				$this -> rate		= $rate;
				$this -> author		= $author;
				$this -> labels		= $labels;	
				$this -> support	= $support;
				$this -> category	= $category;
				$this -> downloaded	= $downloaded;
				$this -> compability= $compability;
				$this -> image		= $qr['image'];
				$this -> title		= $qr['title'];	
				$this -> license	= $qr['license'];	
				$this -> version	= $qr['version'];	
				$this -> addate 	= $qr['date_added'];
				$this -> update 	= $qr['date_update'];
				$this -> desc		= $qr['description'];
				$this -> hits 		= angka($qr['hits']);
			}
			else {		
				echo Download_Page_Denied;
			}
		}
		else
			echo Download_Page_Notfound;	
		}
	}	

function category($id,$menuId,$fp = null) {
	
		//validation page type
		$categoryName = $categoryDesc = null;
		$label = app_param('label');
		if($id > 0) {
			$flag = FQuery("download_category","id=$id",'',1);
		}
		else {
			if(!empty($label)) {
				$label = app_param('label');
				$label = str_replace("-"," ",$label);
				$label =  "AND label LIKE '%".$label."%' ";
			}
			$flag = true;
		}		
		//if page type is valid 
		if($flag){
			$db = new FQuery();  
			$db->connect(); 
			
			/************** Parameter Page ***************/
			$param 		= oneQuery('menu','id',Page_ID,'parameter');			
			$show_panel	= mod_param('show_panel',$param);
			$per_page	= mod_param('per_page',$param);	
			$viewType 	= app_param('view');
			$categoryId	= $id;
			
			if(empty($param )){
					$per_page = $show_panel = 1 ;
			}
			if(url_param('feed') == 'rss') {
				$per_page = 10;
				$pages = url_param('page');
				
				if($pages != null) {
					$link = str_replace("?page=$pages","",getUrl());
					redirect("$link?feed=rss");					
				}
			}
			if(isset($label)) {
				$per_page = 10;
			}
			if(empty($per_page)) $per_page = 10;
					
			//$fp is default page		
			if(!isset($fp) AND !isset($label)) {
				$categoryName = oneQuery('download_category','id',$categoryId,'name');
				$categoryDesc = oneQuery('download_category','id',$categoryId,'description');
			}
			$level_access = Level_Access;	
			
			//$if category id is not found
			if(!$categoryId AND !isset($fp) AND !isset($label))
				echo Download_Page_Notfound;
			else {	
				if(isset($categoryName)) 
					$whereCat ="AND category = $categoryId"; 
				else 
					$whereCat = null;
				
				//call paging class				
				loadPaging();		
				$paging = new paging();
				$rowsPerPage = $per_page;
			
				//paging results		
				$result = $paging->pagerQuery(FDBPrefix.'download_file',"*","status=1 $whereCat $level_access $label",'rate DESC',$rowsPerPage);
				$no=0;
				
				//count rows
				$jml = mysql_affected_rows();
				while($qr=mysql_fetch_array($result)) {				
					
					/********** File Author ***********/
					$author	  = oneQuery('user','id',$qr['author_id'],'name');	
					if(empty($qr['author_alias'])) 
						$author = $author;
					else  
						$author = $qr['author_alias'];						
						
					/********** File Category ***********/
					$catlink  = categoryLink($qr['category']);					
					$category = oneQuery('download_category','id',$qr['category'],'name');
					$category = "<a href='$catlink' title='See more $category'>$category</a>";
					
					/********** Download Link ***********/						
					$flink="?app=download&view=item&id=$qr[id]";	
					$link = make_permalink($flink,Page_ID);	
					$title = "<a href='$link'>$qr[title]</a>";	
										
					/********** File Labels ***********/	
					$labels = labelToLink($qr['label']);
					
					/********** File Compability ***********/	
					$compability = str_replace(";",", ",$qr['compability']);
					$this -> perrows 		 = $jml;
					$this -> show_panel		 = $show_panel;
					$this -> category[$no]	 = $category;
					$this -> catlink[$no]	 = $catlink;
					$this -> image[$no]		 = $qr['image'];
					$this -> license[$no]	 = $qr['license'];	
					$this -> author[$no]	 = $author;
					$this -> title[$no] 	 = $title;
					$this -> link[$no] 		 = $link;
					$this -> labels[$no] 	 = $labels;
					$this -> date[$no]		 = $qr['date_added'];
					$this -> times[$no]		 = $qr['date_update'];
					$this -> hits[$no]		 = $qr['hits'];
					$this -> desc[$no]		 = $qr['description'];
					$this -> compability[$no]=$compability;	
						
					if(url_param('feed') == 'rss' AND url_param('feed') == 'rss' or app_param('label')) 	
					$this -> description[$no]= $qr['description'];
					if(defined('SEF_URL')) {		
						$link = link_paging('?');	
					}
					else if(checkhomepage())  {
						$link = "?";
					}
					else {		
						$link="?app=download&view=category&id=$categoryId";	
						$link = make_permalink($link,Page_ID);
						$link = $link."&";		
					}				
					$no++;
				}
				
				if($no == 0 )
					echo Download_Page_Notfound;
				
				//start paging links
				$db -> select(FDBPrefix.'download_file','*',"status=1 $whereCat  $level_access");
				$jml = mysql_affected_rows();
				if($jml > $rowsPerPage) 					
					$pagelink = $paging->createPaging($link);
				else
					$pagelink = null;
				
				//send paging var relsult
				$this -> pglink		= $pagelink;				
				
				//if parameter found rss page
				if(url_param('feed') == 'rss' AND url_param('feed') == 'rss' or app_param('label')) {
					$this -> catName	= $categoryName;
					$this -> catDesc	= $categoryDesc;				
				}			
			}	
		}	
		else {
			Download_Page_Notfound;
		}
	}	
}




/****************************************/
/*			   SEF Download				*/
/****************************************/
$view = app_param('view');
$id = app_param('id');
if($view != 'default') {
	$a = FQuery("download_category","id=$id",'',1); 
	if(!$a)
	$a = FQuery("download_file","id=$id",'',1); 
	if(!$a AND app_param('label') != null)
	$a = app_param('label');
}
else {
	$a = app_param('view')=='default';
}
if($a){
	$sef_prefix = oneQuery("download_config","name","'sef_prefix'",'value');
	if(defined('SEF_URL')){
		$page = check_permalink('permalink','addons','pid');
		if($view == 'item') {
			$item = oneQuery('download_file','id',$id,'title');
			$vcat = oneQuery('download_file','id',$id,'category');
			$ncat = oneQuery('download_category','id',$vcat,'name');		
			$page = oneQuery('menu','link',"'?app=download&view=category&id=$vcat'",'id');
			if(!$page) {
				$page = oneQuery('permalink','link',"'?app=download&view=default'",'pid');
			}
			if(app_param('go') != 'download')	
				add_permalink("$id-$item","$sef_prefix/$ncat",$page);
			else
				add_permalink("$id-$item/download","$sef_prefix/$ncat",$page);
		}
		else if($view == 'category') {				
			$vcat = oneQuery('download_file','id',$id,'category');
			$page = oneQuery('menu','link',"'?app=download&view=category&id=$vcat'",'id');
			if(!$page) 
				$page = oneQuery('permalink','link',"'?app=download&view=category&id=$vcat'",'pid');
			$ncat = oneQuery('download_category','id',$id,'name');		
			if(url_param('feed') == 'rss');			
			else add_permalink("$sef_prefix/$id-$ncat");
		}			
		else if(app_param('view')=='default')	
			add_permalink("$sef_prefix");
		else if (app_param('label') != null) {		
			$tag = app_param('label');
			if(url_param('feed') == 'rss');			
			else add_permalink("$sef_prefix/label/$tag",'',$page);
		}
			
					
	}
};

/****************************************/
/*			 Download Title				*/
/****************************************/
if($id > 0) {
	$a = FQuery("download_category","id=$id",'',1); 
	if(!$a) {
		$a = FQuery("download","id=$id",'',1); 
	}
	
	if(!$a){
		if(app_param('view')=='default')
			$a = 1;
		if(siteConfig('follow_link'))
			$follow = 'index, follow';
		else {
			$follow = 'index, nofollow';
			define('MetaRobots',"$follow");
		}
	}
}
if($a){
	if(!checkHomePage()) {	
		if ($view=="item") {
			define('PageTitle', downloadInfo('title'));
			
			$desc = downloadInfo('description');
			if(!empty($desc)) 	
				define('MetaDesc', downloadInfo('description'));
			
			$keys = downloadInfo('keyword');		
			if(!empty($keys)) 	
				define('MetaKeys', downloadInfo('keyword'));
			
			if(siteConfig('follow_link'))
				$follow = 'index, follow';
			else
				$follow = 'index, nofollow';
			define('MetaRobots',"$follow");
			
			$author = downloadInfo('author');
			if(empty($author))
				$author = oneQuery('user','id',downloadInfo('author_id'),'name');
			if(define('MetaAuthor',$author));
			
		}
		else if($view=="category" or $view=="catlist") {
			define('PageTitle', categoryInfo('name'));
			$desc = categoryInfo('description');
			if(!empty($desc )) 
				define('MetaDesc', $desc);
			$keys = categoryInfo('keywords');
			if(!empty($keys)) 
				define('MetaKeys', $keys );
			
			
			$cat = app_param('id');
			$qry = oneQuery("menu","link","'?app=download&view=category&id=$cat'");
			if(!$qry)
				$qry = oneQuery("menu","link","'?app=download&view=catlist&id=$cat'");
			if($qry) {
				if(siteConfig('follow_link'))
					$follow = 'index, follow';
				else
					$follow = 'index, nofollow';
			}
			else
				$follow = 'none';
			define('MetaRobots',"$follow");			
		}		
		else if(app_param('view')=='default')
			define('PageTitle', "Downloads");
		else if(app_param('label') != null )			
			define('PageTitle', app_param('label')." label");
	}
}

$lang = siteConfig('lang');
require_once("lang/$lang.php");
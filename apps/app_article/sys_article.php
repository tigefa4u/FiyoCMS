<?php
/**
* @name			Article System
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

function loadComment() {
	include_once ('apps/app_comment/index.php');
}

function articleInfo($output,$id = null) {
	if(empty($id)) $id = app_param('id');
	$output = oneQuery('article','id',$id ,$output);
	return  $output;
}

function articleParameter($value) {	
	$menu_id = Page_ID;
	$param	 = pageInfo($menu_id ,'parameter');
	$param	 = mod_param($value,$param);
	return 1;
}

function articleHits($vid) {
	$db = new FQuery();  
	$db->connect();
	$hits=$vid+1;
	$id = app_param('id');
	$db->update(FDBPrefix.'article',array('hits'=>"$hits"),"id=$id");	
}

function categoryInfo($output, $id = null) {	
	if(empty($id)) $id = app_param('id');
	$output = oneQuery('article_category','id',$id ,$output);
	return  $output;
}

function categoryLink($value) {
	$link = make_permalink("?app=article&view=category&id=$value","","",true);
	return $link ;
}


function itemLink($value) {
	$link = make_permalink("?app=article&view=item&id=$value");
	return $link ;
}

function tagToLink($tags) {
	$tgs = explode(",",$tags);
	$tags = null;
	foreach($tgs as $tag) {				
		$ltag = str_replace(" ","-",$tag);	
		$ltag = "?app=article&tag=$ltag";	
		$ltag = make_permalink($ltag);
		$ltag 	= str_replace('&','&amp;',$ltag);
		$tags .= "<li><a href='$ltag' alt='See article for tag $tag'>$tag</a></li>";				
	}
	return $tags;
}
function articleIntro($article) {
	$article = str_replace('"',"'",$article);
	$limit = strpos("$article","<hr id=");	
	if(empty($limit)) 
	$limit = strpos("$article","<div style='page-break-after: always;'>");	
	if(!empty($limit))
		return substr("$article",0,$limit);
	else 
		return substr("$article",0);
}

function articleImage($article) {
	$opentag = strpos($article,"<img");
	if($opentag) {
		$closetag = substr($article,$opentag);
		$closetag = strpos($closetag,">");
		$image = substr($article,$opentag,$opentag+$closetag);
		$a = strpos($image,'src="');
		
		if(empty($a)) 
			$a = strpos($image,"src='");
			
		$b = substr($image,$a+5);					
		$c = strpos($b,'"');
		if(empty($c))$c = strpos($b,"'");
		return  substr($image,$a+5,$c);					
	}	
	else return false;
}
	
function clearXMLString($xml)  {
	$xml = str_replace('&nbsp',' ',$xml);
	$xml = str_replace('&','&amp;',$xml);
	$xml = str_replace('"',"'",$xml);
	return $xml;
}

class Article {	
	function item($id) {			
		if(articleInfo('id',$id)) {		
			$db = new FQuery();  
			$db -> connect();
			date_default_timezone_set('Asia/Jakarta');
			$sql = $db->select(FDBPrefix."article","*,
			DATE_FORMAT(date,'%W, %d %M %Y %H:%i ') as time,
			DATE_FORMAT(date,'%d %M %Y') as date,
			DATE_FORMAT(date,'%d') as f,
			DATE_FORMAT(date,'%m') as n,
			DATE_FORMAT(date,'%M') as m,
			DATE_FORMAT(date,'%Y') as y","id=$id AND status=1");
			$qr = @mysql_fetch_array($sql);	
			
			if($qr) {		
				$category 	= categoryInfo('name',$qr['category']);
				$catLevel 	= categoryInfo('level',$qr['category']);
				$catLink	= categoryLink($qr['category']);
				if(!empty($qr['author_id']))
					$author		= userInfo('name',$qr['author_id']);
				else				
					$author		= 'Administrator';	
				$autMail	= userInfo('email',$qr['author_id']);	
				$autBio		= userInfo('about',$qr['author_id']);		
				$autBio	 	= str_replace("\n","<br>",$autBio);				 
				
				
				if(!empty($qr['author'])) $author = $qr['author'];
					
				articleHits($qr['hits']);			
				$tag 		= mod_param('tags',$qr['parameter']);
				$sdate 		= mod_param('show_date',$qr['parameter']);
				$shits 		= mod_param('show_hits',$qr['parameter']);
				$srate 		= mod_param('show_rate',$qr['parameter']);
				$spanel		= mod_param('show_panel',$qr['parameter']);
				$stag		= mod_param('show_tags',$qr['parameter']);
				$voter 		= mod_param('rate_counter',$qr['parameter']);
				$rate 		= mod_param('rate_value',$qr['parameter']);
				$sauthor 	= mod_param('show_author',$qr['parameter']);
				$comment	= mod_param('show_comment',$qr['parameter']);
				$scategory 	= mod_param('show_category',$qr['parameter']);
				
				$catLinks	= categoryLink($qr['category']);	
				$pcat		= "<a href='$catLinks'>$category</a>";
				$panel = menu_param('panel_format',Page_ID);
				if(empty($panel) or !strpos($panel,'%'))
				$panel ="by <b>%a</b> on %f %m %y in %c";
				$panel = str_replace('%a',$author,$panel);
				$panel = str_replace('%c',$pcat,$panel);
				$panel = str_replace('%d',$qr['f'],$panel);
				$panel = str_replace('%f',$qr['f'],$panel);
				$panel = str_replace('%m',$qr['m'],$panel);
				$panel = str_replace('%n',$qr['n'],$panel);
				$panel = str_replace('%y',$qr['y'],$panel);
				$panel = str_replace('%h',$qr['hits'],$panel);
				
				
				/* voter */
				if(!is_numeric($voter) or !is_numeric($rate)) $voter = 0;
				/* tags */
				$tags = null;
				if(!empty($qr['tag'])) {
					$tgs = explode(",",$qr['tag']);
					foreach($tgs as $tag) {
						$ltag = str_replace(" ","-",$tag);
						$ltag = "?app=article&tag=$ltag";	
						$ltag = make_permalink($ltag);
						$ltag 	= str_replace('&','&amp;',$ltag);
						$tags .= "<li><a href='$ltag' alt='See article for tag $tag'>$tag</a></li>";
					}
				}
				
				if(checkLocalhost()) {
					$article = str_replace(FLocal."media/","media/",$qr['article']);
					$article = str_replace("/media/",FUrl."media/",$article);				
				}
				
				/* perijinan akses artikel */				
				if(userLevel > $catLevel AND userLevel > $qr['level']) {
					echo Article_cant_access;
					}
				else {
					$this -> article	= $article;
					$this -> category	= $category;
					$this -> catlink	= $catLink;
					$this -> author		= $author;
					$this -> autmail	= $autMail;
					$this -> autbio		= $autBio;
					$this -> title		= $qr['title'];
					$this -> day 		= $qr['f'];
					$this -> month 		= $qr['m'];
					$this -> year 		= $qr['y'];
					$this -> hits 		= $qr['hits'];	
					$this -> comment	= $comment;	
					$this -> panel		= $panel;	
					$this -> spanel		= $spanel;	
					$this -> tags		= $tags ;	
					$this -> stag		= $stag ;	
					$this -> sdate		= $sdate;
					$this -> sauthor	= $sauthor;	
					$this -> scategory	= $scategory;	
					$this -> shits		= $shits;	
					$this -> srate		= $srate;	
					$this -> voter		= $voter;	
				}		
			}
		}
	}

	function category($type, $id = null,$format = null) {
		$link = null;
		/* Set global parameter */
		$show_panel	= menu_param('show_panel',Page_ID);
		$show_rss	= menu_param('show_rss',Page_ID);
		$read_more  = menu_param('read_more',Page_ID);
		$panel		= menu_param('panel_format',Page_ID);
		$per_page	= menu_param('per_page',Page_ID);
		$intro		= menu_param('intro',Page_ID);
		
		/* Set Access_Level */
		$accessLevel = Level_Access;
		
		if($type == 'archives')  {	
			$where = "status=1";
		} 
		else if($type == 'category')  {
			$catName = categoryInfo('name',$id);
			$catDesc = categoryInfo('description',$id);
			$catLink  = categoryLink($id);	
			$where = "status=1 AND category = $id";
		}
		else if($type == 'featured') {
			$where = "status=1 AND featured = 1";
		
		}
		else if($type == 'tag') {
			$per_page = 10;
			$tag = app_param('tag');
			$tag = str_replace("-"," ",$tag);
			$where = "status=1 AND tag LIKE '%".$tag."%'";
		} 
		if(_FEED_ == 'rss') {
			$per_page = 20;
			$pages = url_param('page');
			if($pages != null) {
				$link = str_replace("?page=$pages","",getUrl());
				redirect("$link?feed=rss");					
			}
		}		
			
		loadPaging();		
		$paging = new paging();
		
		$result = $paging->pagerQuery(FDBPrefix.'article',"*,
		DATE_FORMAT(date,'%d %M %Y') as date,
		DATE_FORMAT(date,'%Y-%m-%d %H:%i:%s') as order_date,
		DATE_FORMAT(date,'%a, %m %d %Y %H:%i:%s') as time,
		DATE_FORMAT(date,'%W') as d,
		DATE_FORMAT(date,'%d') as f,
		DATE_FORMAT(date,'%m') as n,
		DATE_FORMAT(date,'%M') as m,
		DATE_FORMAT(date,'%Y') as y","$where  $accessLevel",'order_date DESC',$per_page);
		
		$no = 0;
		$perrows = mysql_affected_rows();		
		while($qr=mysql_fetch_array($result)) {	
		
			/* Category Details */		
			$catLinks	= categoryLink($qr['category']);					
			$category	= categoryInfo('name',$qr['category']);
			$pcat		= "<a href='$catLinks'>$category</a>";
				
			
			/* Author */			
			if(empty($qr['author'])) 
				$author = userInfo('name',1);
			else  {
				$author = $qr['author'];
			}
			
			/* Article Links */
			$link	= "?app=article&amp;view=item&amp;id=$qr[id]";	
			$vlink  = str_replace("&amp;","&",$link);
			$link  	= make_permalink($vlink);			
				
			/* Article Title */				
			$title 	= "<a href='$link'>$qr[title]</a>";	
				
			/* Article Tags */
			$tags 	= tagToLink($qr['tag']);
				
			/* Article Content */
			
			if(checkLocalhost()) {
				$article = str_replace(FLocal."media/","media/",$qr['article']);
				$article = str_replace("/media/",FUrl."media/",$article);				
			}
			$content = $article;		
			
			/* Intro limit (read more) */
			$content = articleIntro($content);
			
			/* Article Comments */
			$comm = FQuery('comment',"link='$vlink'AND status=1");
			if(FQuery('comment')) { 
				$comment =  "<a class='send-comment' href='$link#comment'>";
				if($comm > 1) $comment .= "<span>$comm</span> Comments";
				if($comm ==1) $comment .= "<span>$comm</span> Comment"; 
				if($comm < 1) $comment .= "Send Comment";
				$comment .= "</a>";
			}
									
			/* Read More */
			if(empty($read_more)) $read_more= Readmore ;
			$readmore = "<a href='$link;' class='readmore'>$read_more</a> $comment";	
				
			/* Blog Style */
			if($format == 'blog') {	
				$image	= articleImage($article);	
				$image	= str_replace("/media","/media/.thumbs",$image);
				$imgH  = menu_param('imgH',Page_ID);
				$imgW  = menu_param('imgW',Page_ID);	
				
				$this -> image[$no]		= $image;				
				$this -> imgH			= $imgH;				
				$this -> imgW			= $imgW;	
				$article = preg_replace("/<img[^>]+\>/i", "", $content); 
			}
				
					
			$panel = menu_param('panel_format',Page_ID);
			if(empty($panel) or !strpos($panel,'%'))
				$panel ="by <b>%a</b> on %f %m %y in %c";
			$panels = str_replace('%a',$author,$panel);
			$panels = str_replace('%c',$pcat,$panels);
			$panels = str_replace('%d',$qr['d'],$panels);
			$panels = str_replace('%f',$qr['f'],$panels);
			$panels = str_replace('%m',$qr['m'],$panels);
			$panels = str_replace('%n',$qr['n'],$panels);
			$panels = str_replace('%y',$qr['y'],$panels);
			$panels = str_replace('%h',$qr['hits'],$panels);
			
			
			/* RSS Feed */
			$this -> perrows 		= $perrows;
			$this -> intro	 		= $intro;
			$this -> panel[$no]		= $panels;
			$this -> show_panel		= $show_panel;
			$this -> show_rss		= $show_rss;
			$this -> category[$no]	= $category;
			$this -> catlink[$no]	= $catLinks;
			$this -> readmore[$no]	= $readmore;
			$this -> comment[$no]	= $comment;
			$this -> author[$no]	= $author;
			$this -> title[$no] 	= $title;
			$this -> link[$no] 		= $link;
			$this -> tags[$no] 		= $tags;
			$this -> ftime[$no]		= $qr['time'];
			$this -> desc[$no]		= clearXMLString("$content");
			$this -> ftitle[$no] 	= clearXMLString($qr['title']);
			$this -> content[$no] 	= $article;	

			if(defined('SEF_URL')) {		
				$link = link_paging('?');
				if (strpos(getUrl(),'&') > 0)  {			
					$link = link_paging('&');
				}				
			}
			else if(checkhomepage())  {
				$link = "?";
			}
			else if(!url_param('id'))  {			
				$tag  = app_param('tag');
				$link = "?app=article&tag=$tag";	
				$link = make_permalink($link,Page_ID);
				$link = $link."&amp;";
			}
			else {		
				$link="?app=article&view=category&id=$categoryId";	
				$link = make_permalink($link,Page_ID);
				$link = $link."&amp;";		
			}				
			$no++;
		}
		
		// pageLink	
		$this -> pglink	 = $paging->createPaging($link);
		
		// rssLink
		if($type == 'tag')		{	
			$tag = str_replace(" ","-",$tag);	
			$rssLink = "?app=article&tag=$tag&feed=rss";	
		}
		else if($type == 'category')	{
			$rssLink = "?app=article&view=category&id=$id&feed=rss";	
		}
		else {
			$rssLink = "?app=article&view=archives&feed=rss";	
		}
		
		if(_FEED_ == 'rss') {
			$rssLink = str_replace("&feed=rss","",$rssLink);
			$rssLink = make_permalink($rssLink);
			$this -> rssTitle = SiteTitle;			
			$categoryLink = @clearXMLString($rssLink);
			$this -> rssLink  	= $categoryLink;
			$this -> rssDesc  	= @$categoryDesc;	
		}
		else {
			
			$this -> rssLink  	= make_permalink($rssLink);
		}
		
		
	}	
}


/****************************************/
/*			   SEF Article				*/
/****************************************/
$view = app_param('view');
$id = app_param('id');

if($id > 0) {
	$a = FQuery("article_category","id=$id",'',1); 
	if(!$a)
	$a = FQuery("article","id=$id",'',1); 
}
else if ((app_param('tag') != null)) {
	$a = app_param('tag');
}
else{
	$a = app_param('view');
}

if($a){ 
	if(defined('SEF_URL')){
		if($view == 'item') {
			$item = oneQuery('article','id',$id,'title');
			$vcat = oneQuery('article','id',$id,'category');
			$ncat = oneQuery('article_category','id',$vcat,'name');			
			$page = oneQuery('menu','link',"'?app=article&view=item&id=$id'",'id');
			if(empty($page))
			$page = oneQuery('menu','link',"'?app=article&view=category&id=$vcat'",'id');
			if(!$page) {
				$page = oneQuery('permalink','link',"'?app=article&view=category&id=$vcat'",'pid');
			}	
			add_permalink($item,$ncat,$page);
		}
		else if($view == 'category' or $view == 'catlist') {	
			$ncat = oneQuery('article_category','id',$id,'name');		
			if(_FEED_ == 'rss')
				add_permalink("$ncat","","","xml");
			else 
				add_permalink($ncat);
		}
		else if($view == "archives") {
			if(_FEED_ == 'rss')
				add_permalink("archives","","","xml");
			else
				add_permalink("archives");	
		}			
		else if (app_param('tag') != null) {	
			$tag = app_param('tag');
			if(_FEED_ == 'rss')
				add_permalink("tag/$tag","","","xml");		
			else add_permalink("tag/$tag");
		}
	}
}

/****************************************/
/*			 Article Title				*/
/****************************************/
if($id > 0) {
	$a = FQuery("article_category","id=$id",'',1); 
	if(!$a) {
		$a = FQuery("article","id=$id",'',1); 
	}
	else {
		if(app_param('view')=='featured')
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
			define('PageTitle', articleInfo('title'));
			
			$desc = articleInfo('description');
			if(!empty($desc)) 	
				define('MetaDesc', articleInfo('description'));
			else
				define('MetaDesc', generateDesc(articleInfo('article')));
			
			$keys = articleInfo('keyword');		
			if(!empty($keys)) 	
				define('MetaKeys', articleInfo('keyword'));
			else
				define('MetaKeys', generateKeywords(articleInfo('article')));
			
			if(siteConfig('follow_link'))
				$follow = 'index, follow';
			else
				$follow = 'index, nofollow';
			define('MetaRobots',"$follow");
			
			$author = articleInfo('author');
			if(empty($author))
				$author = oneQuery('user','id',articleInfo('author_id'),'name');
			if(define('MetaAuthor',$author));
			
		}
		else if($view=="category" or $view=="catlist") {
			if(pageInfo(Page_ID,'title'))
				define('PageTitle', pageInfo(Page_ID,'title'));
			else
				define('PageTitle', categoryInfo('name'));
			$desc = categoryInfo('description');
			if(!empty($desc )) 
				define('MetaDesc', $desc);
			else
				
			$keys = categoryInfo('keywords');
			if(!empty($keys)) 
				define('MetaKeys', $keys );
			
			
			$cat = app_param('id');
			$qry = oneQuery("menu","link","'?app=article&view=category&id=$cat'");
			if(!$qry)
				$qry = oneQuery("menu","link","'?app=article&view=catlist&id=$cat'");
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
		else if($view=='archives')
			define('PageTitle', "Archives");
		else if($view=='featured')
			define('PageTitle', "Featured");
		else if (app_param('tag') != null)			
			define('PageTitle', app_param('tag')." Tags");
	}
}

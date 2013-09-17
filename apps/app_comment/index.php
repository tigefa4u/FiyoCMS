<?php 
/**
* @name			Comment
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery();  
$db->connect();

if(!defined('SEF_URL')) {	
	$link = check_permalink('link',getLink(),'link');	
	$go_link = FUrl.getLink()."&pid=$_GET[pid]";
	}
else {
	$link = @check_permalink('permalink',$_REQUEST['link'],'link');
	$go_link = FUrl.@$_REQUEST['link'].SEF_EXT;
}


require('entry_comment.php');

if(isset($_POST['send-comment'])){
	//reCaptcha
	$privatekey = oneQuery('comment_setting','name',"'recaptcha_privatekey'",'value');
	$publickey	= oneQuery('comment_setting','name',"'recaptcha_publickey'",'value');
	if(checkOnline() AND !empty($_POST["recaptcha_challenge_field"]) AND !empty($_POST["recaptcha_response_field"])) {
		$capthca = recaptcha_check_answer ($privatekey,
			   $_SERVER["REMOTE_ADDR"],
			   $_POST["recaptcha_challenge_field"],
			   $_POST["recaptcha_response_field"]);			
		if($capthca->is_valid AND checkOnline()) 
		$valid = 1;
	}
	
	if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['com'])) {	
		$notice =  "<div class='notice-error'>Please fill the required fields (*) !</div>";
	}
	else if(!preg_match("/^.+@.+\\..+$/",$_POST['email'])){	
		$notice =  "<div class='notice-error'>Email is invalid !</div>";
	}
	else if($_POST['secure'] == $_SESSION['captcha'] or isset($valid)){
		$name = oneQuery('comment_setting','name',"'name_filter'",'value');
		$name = explode(",",$name);
		foreach($name as $namef) {
			if(strtolower($_POST['name']) == strtolower(trim($namef)))
			$name = 0;
		}		
		$email = oneQuery('comment_setting','name',"'email_filter'",'value');
		$email = explode(",",$email);
		foreach($email as $emailf) {
			if(strtolower($_POST['email']) == strtolower(trim($emailf)))
			$email = 0;
		}		
		$filter = oneQuery('comment_setting','name',"'word_filter'",'value');
		$filter = explode(",",$filter);
		foreach($filter as $filterf) {
			$f = strtolower(trim($filterf));
			$t = strtolower($_POST['com']);
			$s = @strpos($t,$f);
			$s = str_replace(0,1,$s) ;
			if(!empty($s))
			$filter = 0;
		}		
		
		if(!$name  AND $_SESSION['userLevel'] != 1 AND $_SESSION['userLevel'] != 2) {
			$notice =  "<div class='notice-error'>The name you use is not allowed !</div>";		
		}
		else if(!$filter) {			
			$notice =  "<div class='notice-error'>Disallows use prohibited words !</div>";		
		}
		else {			
			$auto = oneQuery('comment_setting','name',"'auto_submit'",'value');
			if($auto == 0) {
				if($_SESSION['userLevel'] ==1 or $_SESSION['userLevel'] ==2) $auto = 1;
				else $auto = null;
			}
			
			$_POST['web'] = str_replace("<","&lt;",$_POST['web']);
			$_POST['web'] = str_replace(">","&gt;",$_POST['web']);
			$_POST['web'] = str_replace(" ","",$_POST['web']);
			$_POST['web'] = str_replace("  ","",$_POST['web']);
			$text = htmlentities($_POST['com']);
			$com = $db->insert(FDBPrefix.'comment',array("","$link",userLevel,"$_POST[name]","$_POST[email]","$_POST[web]",date("Y-m-d H:i:s",time()),"$text","$auto","$no"));
			
			if($com AND $auto)
				$notice =  "<div class='notice-info'>Your comment will appear after the page reloads. Loading...</div>";
			else
				$notice = "<div class='notice-info'>Your comment will be moderated before display.</div>";
				
			if(empty($no)) $no = 1;
			//Comment will appear after page reload
			$link = "$go_link#comment-$no";
			htmlRedirect($link,2);
		}
	}
	else {
		$notice =  "<div class='notice-error'>Security code is wrong!</div>";
	}
}

//name
$name = $_SESSION['USER_NAME'];
if(empty($name)) $name = @$_POST['name']; 

//email
$email = oneQuery('comment_setting','name',"'email_filter'",'value');
$email = $_SESSION['USER_EMAIL'];

if(empty($email)) $email = @$_POST['email']; 
require('form_comment.php');

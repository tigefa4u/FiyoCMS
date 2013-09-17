<?php
/**
* @name			Plugin Statistic
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');


//geo statistic
$country = $city = 'other';

//browser details
require ("browser.php");
require ('ip.codehelper.io.php');

//get ip
$_ip = new ip_codehelper();

// Detect Real IP Address & Location
$ip = $_ip->getRealIP();
if(!empty($_SERVER['REMOTE_ADDR'])) $ip =  $ip;
$visitor_location       = $_ip->getLocation($ip);

// Output result
$country = $visitor_location['CountryName']."";
$city = $visitor_location['CityName']."";
$browser 	= _browser();
$platform	= ucfirst($browser['platform']);
$browser 	= ucfirst($browser['browser']);

//get timestamp

//get user id
$userId	= userID;	

$time 	= date("Y-m-d H:i:s"); 
$date 	= date("d"); 

//set visitor online
if (!isset($_SESSION['VISIT_SESSION_CREATED'])) {	
    $key  = $_SESSION['VISIT_SESSION_KEY'] = md5($ip.getUrl().$time);
    $time = $_SESSION['VISIT_SESSION_CREATED'] = time();  // update creation time
	$db->insert(FDBPrefix.'statistic_online',array("","$ip",getUrl(),"$time","$browser","$platform","$country","$city","$key"));
} 
else if (time() - $_SESSION['VISIT_SESSION_CREATED'] > 300) {
	$key  = $_SESSION['VISIT_SESSION_KEY'] = md5($ip.getUrl().$time);
    $time = $_SESSION['VISIT_SESSION_CREATED'] = time();  // update creation time
	$db->insert(FDBPrefix.'statistic_online',array("","$ip",getUrl(),"$time","$browser","$platform","$country","$city","$key"));	
}

//update session_online
$url = getUrl();
$db->update(FDBPrefix.'statistic_online',array("url"=>"$url"), "`key` = '".$_SESSION['VISIT_SESSION_KEY']."'");
$timer = time() - 300;
$db->delete(FDBPrefix.'statistic_online',"time < $timer");
$_SESSION['VISIT_SESSION_URL'] = getUrl();

//update session visitor
if($date != $_SESSION['VISIT_SESSION_DAY'] or !isset($_SESSION['VISIT_SESSION_DAY'])) {	
    $_SESSION['VISIT_SESSION_DAY'] = $date;	
	$db->insert(FDBPrefix.'statistic',array("","$ip",userID,"$time","$browser","$platform","$country","$city"));
    $_SESSION['VISIT_SESSION_DAILY'] = time();
}
else if (!isset($_SESSION['VISIT_SESSION_DAILY'])) {	
	$db->insert(FDBPrefix.'statistic',array("","$ip",userID,"$time","$browser","$platform","$country","$city"));
    $_SESSION['VISIT_SESSION_DAILY'] = time();
} 
else if (time() - $_SESSION['VISIT_SESSION_DAILY'] > 3600) {
	$db->insert(FDBPrefix.'statistic',array("","$ip",userID,"$time","$browser","$platform","$country","$city"));
	$_SESSION['VISIT_SESSION_DAILY'] = time();	
}

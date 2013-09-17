<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');
$title = @$_GET['action'];
switch($title) {
	case 'parse' :
		define('sitemapTitle','Scan Links');	
	break;
	case 'search' :
		define('sitemapTitle','Crawler Links');	
	break;
	default :
		define('sitemapTitle','Expert Setting');
	break;


}

?>

<div id='app_header'>
	<div class='warp_app_header'>		
		<div class='app_title'>Sitemap Manager</div>
		<div class='app_link'>
			<a class='lbt setting tooltip link' href='?app=sitemap&action=setup' title='Setup'></a>
			<a class='lbt search tooltip link' href='?app=sitemap&action=search' title='Start Scan'></a>
			<hr class="lbt sparator" title="">
			<a class='lbt help popup tooltip' href='#helper' title='<?php echo Help; ?>'></a>
			<div id='helper'><h3>About Fi SiteMap</h3><p>Modified by Fiyo Developers to become Fiyo Apps.</p><br/><p>Special tanks and Original Script by <a class='outlink' target='_blank' href='http://enarion.net/google/'>enarion.net</a></p><p> This script is licensed under GPL.</p></p>
							
			<div align="left"><p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="enarion@enarion.net">
			<input type="hidden" name="item_name" value="Development of phpSitemapNG">
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="return" value="http://enarion.net/google/phpsitemapng/donated.php">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="tax" value="0">
			<input type="image" src="apps/app_sitemap/images/x-click-but04.gif" border="0" name="submit" alt="Donate the development of phpSitemapNG" title="Donate the development of phpSitemapNG" target="_blank">
			</form></p></div>
				
			</div>
		</div>
	</div>
</div>
<div class="col first full" style="margin: 5px 0; background : #fefefe;">
<h3><?php echo sitemapTitle; ?></h3>
<div  style="padding:8px">
	<?php 
	
	if(@$_GET['action'] == 'search') 		
		include('search.php');
	else
		include('sitemap.php'); ?>
</div>
</div>
<?php
/**
* @name			Search Module
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

$link = make_permalink('?app=search');

?>
<form class="searchform" action="<?php echo $link; ?>" method="post">
	<input class="searchfield" type="text" placeholder="Search..."  name="q">
	<input class="searchbutton" type="submit" value="Go"  name="search">
</form>
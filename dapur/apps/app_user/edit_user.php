<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = new FQuery() or die;  
$db ->connect();  
$sql= $db->select(FDBPrefix."user","*","id=$_REQUEST[id]"); 
$qr	= mysql_fetch_array($sql); 
if($_SESSION['USER_LEVEL'] >= $qr['level'] AND $_SESSION['USER_ID'] != $qr['id']){
	alert('info','Redirecting...');
	alert('loading');
	htmlRedirect('?app=user');
}
if($qr['status']==1) $ck="checked";
if($qr['status']==0) $ck2="checked";
?>

<form method="post" action="">
	<div id="app_header">
		<div class="warp_app_header">
			<div class="app_title"><?php echo Edit_User; ?></div>
			<div class="app_link">
				<input type="submit" class="lbt save tooltip" title="<?php echo Save; ?>" name="applyedit"/>
				<span class="lbt sparator"></span>	
				<input type="submit" class="lbt save_ref tooltip" title="<?php echo Save_and_Quit; ?>" name="edit"/>
				<a class="lbt cancel tooltip" href="?app=user" title="<?php echo Cancel; ?>"></a>	
				<span class="lbt sparator"></span>	
				<a class="lbt help popup  tooltip" href="#helper" title="<?php echo Help; ?>"></a>			
			<div id="helper"><?php echo User_help; ?></div>
			</div>
		</div>			 
	</div>
<?php require('field_user.php'); ?>	
</form>

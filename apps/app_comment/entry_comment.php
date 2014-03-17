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
$sql = $db->select(FDBPrefix.'comment','*',"link='$link' AND status=1","clink ASC");	
$count	= mysql_affected_rows();
if($count != 0 ) :
if($count < 2) $count = "$count Comment"; else $count = "$count Comments"; 

if(checkOnline()) : ?>

<script>
	$(document).ready(function() {
		if (navigator.onLine) {
			$('.cmn-gravatar[data-gravatar-hash]').prepend(function(index){
				var hash = $(this).attr('data-gravatar-hash')
				return '<img width="48" height="48" alt="" src="http://gravatar.com/avatar/'+hash+'?size=48">'
			});
		} else {
			$('.cmn-gravatar[data-gravatar-hash]').prepend(function(index){
				var hash = $(this).attr('data-gravatar-hash')
				return '<img width="48" height="48" alt="" src="<?php echo FUrl; ?>apps/app_comment/images/user.png" >'
			});			
		}
	});
</script>
<?php endif; ?>
<div class="comment-entry">
<?php
echo "<h3>$count</h3>";	
$no=1;				
while($com=mysql_fetch_array($sql)){
	$autmail= strtolower($com['email']); 
	$autmail = md5($autmail);
	$img = "<span class='cmn-gravatar' data-gravatar-hash='$autmail'></span>";	
	
	if($com['user_id']==1 or $com['user_id']==2) 
		$s = " admin-comment";
	else
		$s ="";
	
	if(empty($com['website'])) 					
		$name = "$com[name]";
	else
		$name = "<a href='$com[website]'>$com[name]</a>";
		
	$comment = str_replace("<","&lt;",$com['comment']);
	$comment = str_replace(">","&gt;",$comment);
	$comment = str_replace("\n","<br>",$comment);
	$comment = str_replace("[b]","<b>",$comment);
	$comment = str_replace("[/b]","</b>",$comment);
	$comment = str_replace("[i]","<i>",$comment);
	$comment = str_replace("[/i]","</i>",$comment);
	$comment = str_replace("[u]","<u>",$comment);
	$comment = str_replace("[/u]","</u>",$comment);
				
	echo "<div class='inner-comment$s' id='comment-$no'>";
	echo "<div class='avatar-comment'>$img</div>";
	echo "<div class='right-comment'><b>$name</b> on $com[date]<div class='main-comment'><span><i><a href='".getLink()."#comment-$no' title='comment permalink'>#$no</a></i></span>$comment </div></div>";	
	echo "</div>";
	$no++;	
}; ?>

</div>
<?php endif; ?>
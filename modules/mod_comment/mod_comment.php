<?php 
/**
* @version		1.5.0
* @package		Comments
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$name = mod_param('name',$modParam);
$date = mod_param('date',$modParam);
$text = mod_param('text',$modParam);
$item = mod_param('item',$modParam);
$title = mod_param('title',$modParam);
$scomment = mod_param('comment',$modParam);
$gravatar = mod_param('gravatar',$modParam);

if($item=="" or empty($item)) $item = 5;
	

$db = new FQuery();  
$db->connect(); 	

$sql = $db->select(FDBPrefix.'comment','*',"status=1","date DESC");	
	
$no = 0;
while($com=mysql_fetch_array($sql) AND $no < $item){
	$email = strtolower($com['email']); 
	$email = md5($email );
	
		$img = "<span class='mod-gravatar' data-gravatar-hash='$email'></span>";	
	
	if($com['user_id']==1 or $com['user_id']==2) 
		$s = " admin-comment";
	else
		$s ="";
				
	echo "<div class='inner-comment$s'>";
	if($gravatar) {
		echo "<div class='mod-avatar-comment'>$img</div>";
		echo "<div class='mod-right-comment'>";
	}
	else {
		echo "<div class='mod-right-comment u3'>";
	}
	
	$ltitle = strpos($com['link'],'id=');
	$ltitle = substr($com['link'],$ltitle+3);
	$ltitle = oneQuery('article','id',$ltitle,'title');
	$ltitle = "<a href='".make_permalink($com['link'])."' title='comment permalink'>$ltitle</a>";
	
	if($name AND $title AND $date) echo "$com[name], <em>$com[date]</em><br/> on $ltitle";
	else if(!$name AND $title AND $date) echo "$ltitle on <em>$com[date]</em>";
	else if($name AND  $title) echo "$com[name] on $ltitle";
	else if($name AND  $date) echo "$com[name] on <em>$com[date]</em>";
	else if($name) echo "$com[name]";
	else if($date) echo "$com[date]";
	else if($title) echo "$ltitle";	
	
	echo "</div></div>";
	$no++;
}				
?>
<script>
	$(document).ready(function() {
		if (navigator.onLine) {
			$('.mod-gravatar[data-gravatar-hash]').prepend(function(index){
				var hash = $(this).attr('data-gravatar-hash')
				return '<img width="36" height="36" alt="" src="http://www.gravatar.com/avatar/'+hash+'?size=36">'
			})
		}
		else 
		{
			$('.mod-mgravatar[data-gravatar-hash]').prepend(function(index){
				var hash = $(this).attr('data-gravatar-hash')
				return '<img width="36" height="36" alt="" src="<?php echo FUrl; ?>apps/app_comment/theme/images/user.png" >'
			})	
		}
	});
</script>
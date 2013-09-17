<?php
/**
* @name			Fi Search
* @version		1.4.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
*/

defined('_FINDEX_') or die('Access Denied');

addCss(FUrl.'apps/app_search/theme/css/style.css');

$q = url_param('q');
if(isset($_POST['q'])) {
	$query = $_POST['q'];
	$query = str_replace("`","",$query);
	$query = str_replace("\\","",$query);
	$query = str_replace("/","",$query);
	$query = str_replace("&","",$query);
	$query = str_replace("'","",$query);
	$query = str_replace('"',"",$query);
	$query = trim($query);	
	 $_SESSION['search'] = $query;
	 }
else if(!empty($q)) {
	$q = str_replace("+"," ",$q);
	$_SESSION['search'] = $q;
}
else if(_Page < 1)
	$_SESSION['search'] = null;


$query = $_SESSION['search'];

?>	
<h1>Search Page</h1>
<form action="" method="POST">
	<input type="text" name="q" value="<?php if(!empty($query)) echo $query;?>" size="40" placeholder="Search..." /> 
	<input type="submit" name="s" value="Search" class="commentBtn"/> 
</form>
<?php
if(empty($_SESSION['search'])) :
	echo "<div class='notice-error'>".Please_fill_keyword."</div>";
elseif(strlen($_SESSION['search'])<3) :
	echo "<div class='notice-error'>".Minimum_keywords."</div>";
else :
	$article = new searchArticle;
	$article -> item($_SESSION['search'],Page_ID);
	$category 	= $article-> category;
	$catlink	= $article-> catlink;
	$pagelink 	= $article-> pglink;
	$perrows 	= $article-> perrows;
	$text  		= $article-> article;
	$author 	= $article-> author;
	$total 		= $article-> total;
	$title		= $article-> title;
	$date 		= $article-> date;
		
	if(!isset($text)) :
		echo "<div class='notice-error'>".Not_found_keyowrd." <b><i>$query</i></b></div>";	
	else :
		echo "<div class='notice-info'>".Found_1." <b>$total</b> ".Found_2." <b><i>$query</i></b></div>";		
		echo "<div id='article'>";
		
		for($i=0; $i < $perrows ;$i++) : 		
			?>		
			<div class="article-box">	
				<h2 class="title"><?php echo $title[$i]; ?></h2>				
				<?php 
					echo "<div class='article-panel'><em>$author[$i]</em>, $date[$i] on <a href='$catlink[$i]' title='$category[$i]'>$category[$i]</a></div>";
				?>			
				<div class="article-main">
					<?php echo $text[$i]; ?>
				</div>	
				
				<div class="clear"></div>
			</div>	
		<?php	
			endfor;
		?>
		</div>
		<div>
			<?php echo $pagelink; ?>
		</div>
		<?php
	endif;
endif;
?>
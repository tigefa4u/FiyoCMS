<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$article = new article;
$article -> item($id);
$text = $article -> article;

if(isset($text)) {			
	$category 	= $article-> category;
	$catlink	= $article-> catlink;
	$comment 	= $article-> comment;
	$author 	= $article-> author;
	$autmail 	= $article-> autmail;
	$title		= $article-> title;
	$hits 		= $article-> hits;
	$comment 	= $article-> comment;
	$panel 		= $article-> panel;
	$scategory 	= $article-> scategory;
	$sauthor 	= $article-> sauthor;
	$shits 		= $article-> shits;
	$sdate 		= $article-> sdate;
	$srate		= $article-> srate;
	$stag		= $article-> stag;
	$tags		= $article-> tags;
	$voter		= $article-> voter;
	
	$editable = $editable2 = null;
	
	
?>

<div id="article">		
	<h1 class="title" <?php echo $editable; ?>><?php echo $title; ?></h1>
	<?php if(!empty($article->spanel)) {
		echo "<div class='article-panel'>";
		echo $panel;
		loadModule('article-panel'); 
		echo "</div>";
	} ?>
			
	<div class="article-main">
		<div <?php echo $editable2; ?>>
			<?php echo $text; ?>
		</div>
	</div>
		
	<?php if($shits or $stag or $srate) : ?>	
	<div class='panel-bottom'>
		<?php if($shits) : ?>	
		<div class='article-read'>		
			Read <?php echo "<b>$hits</b> times";  ?>	
		</div>	
		<?php endif; ?>				
		<?php if($srate) : ?>
		<div class='article-rating'>
		<span style='float:left'>Rates</span>
		<div class='box-rating'>
			<ul class='star-rating'> 
			  <li class="current-rating" id="current-rating"><!-- will show current rating --></li>
			  <?php if(!isset($_SESSION["article_rate_$id"]) or $voter == 0) :?>
			  <span id="ratelinks">
			  <li><a href="javascript:void(0)" title="1 star out of 5" class="one-star">1</a></li>
			  <li><a href="javascript:void(0)" title="2 stars out of 5" class="two-stars">2</a></li>
			  <li><a href="javascript:void(0)" title="3 stars out of 5" class="three-stars">3</a></li>
			  <li><a href="javascript:void(0)" title="4 stars out of 5" class="four-stars">4</a></li>
			  <li><a href="javascript:void(0)" title="5 stars out of 5" class="five-stars">5</a></li>
			  </span>
			  <?php endif; ?>
			</ul> 
		</div>
		<span class='valRates'>(<span><?php echo $voter ?></span>	 <?php if($voter<2)  echo 'Vote'; else echo 'Votes'; ?>)</span>	
		</div>
		<?php endif; ?>
		<?php if($stag AND !empty($tags)) : ?>
		<div style="clear:both"> </div>
			<ul class="tags">
				<li class="tag">Tags : </li>
				<?php echo $tags; ?>
			</ul>
		<?php endif; ?>
	</div>	
	<?php endif; ?>
	
	<?php loadModule('article-mid'); ?>
	<script>
		// We need to turn off the automatic editor creation first.
		CKEDITOR.disableAutoInline = true;

		var editor = CKEDITOR.inline( 'article-main' );
		$(document).ready(function() {
			if (navigator.onLine) {
				$('.gravatar[data-gravatar-hash]').prepend(function(index){
					var hash = $(this).attr('data-gravatar-hash')
					return '<img width="100" height="100" alt="" src="http://www.gravatar.com/avatar/'+hash+'?size=100">'
				})
			}
			else 
			{
				$('.gravatar[data-gravatar-hash]').prepend(function(index){
					var hash = $(this).attr('data-gravatar-hash')
					return '<img width="100" height="100" alt="" src="<?php echo FUrl; ?>apps/app_comment/theme/images/user.png" >'
				})
			
			}
		});
	</script>
	<?php if($sauthor) : ?>
	<div class='article-author'>
			
		<?php
		$autmail=	md5($autmail);
			echo "<span class='gravatar' data-gravatar-hash=\"$autmail\"></span>";
		?>
		<div class='author-nb'>
			<div class='author-name'><?php echo $article->author; ?></div>
			<div class='author-bio'><?php echo $article-> autbio ; ?></div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php loadModule('article-bottom'); ?>
	
	<?php if($comment AND !checkModule('article-comment')) : ?>
	<div id="comment">	
		<?php 
			loadComment();
		?>
	<?php loadModule('article-comment'); ?>	
	</div>		
	<?php endif; ?>
	
</div>
<?php	
	echo "
	<script>
	$(document).ready(function() {	
		getRating();
		// get rating function
		function getRating(){
			$.ajax({
				type: 'GET',
				url: '".FUrl."/apps/app_article/libs/rating.php',
				data: 'id=$id&do=getrate',
				cache: false,
				async: false,
				success: function(result) {
					// apply star rating to element
					$('#current-rating').css({ width: '' + result + '%' });
				},
				error: function(result) {
				
				}
			});
		}
		
		
		// link handler
		$('#ratelinks li a').click(function(){
			$.ajax({
				type: 'GET',
				url: '".FUrl."/apps/app_article/libs/rating.php',
				data: 'id=$id&rating='+$(this).text()+'&do=rate',
				cache: false,
				async: false,
				success: function(result) {
					// remove #ratelinks element to prevent another rate
					$('#ratelinks').remove();
					// get rating after click	
					var x = parseInt($('.valRates span').text(),10);
					++x;
					var v ='';
					if(x<2) v ='Vote'; else v = 'Votes';
					$('.valRates').html('('+x+' '+v+')');
					getRating();
				},
				error: function(result) {
				
				}
			});
			
		});
	});
	</script>";
}
?>

	
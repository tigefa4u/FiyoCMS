<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect(); 

include('module/header.php');
?>
	
<div class="secondary"></div>	
	
	<div class="main">
		<div class="cols">
			<div class="col first pan" style='border :0 '>
				<div class='isi' id='notif'>
					<div class='notif-item article'><a href="?app=article" class="tooltip" title="Check Article(s)">
						<div><span><?php echo $newArticle; ?></span> <?php echo new_article; ?></div>
						<?php echo of; ?> <b><?php echo $totalArticle; ?></b><?php echo articles; ?></a>
					</div>
					<div class='notif-item comment'><a href="?app=comment" class="tooltip" title="Check Comment(s)">
						<div><span><?php echo $unComment; ?></span><?php echo comments; ?></div>
						<?php echo uncomments; ?></a>
					</div>
					<div class='notif-item user'><a href="?app=user" class="tooltip" title="Check user(s)">
						<div><span><?php echo $newUser; ?></span><?php echo new_users; ?></div>
						<?php echo of; ?> <b><?php echo $totalUser; ?></b><?php echo users; ?></a>
					</div>
					<div class='notif-item version'><a href="#update" class="popup tooltip updater-d" title='Check for Updates' >
					<div><span class='version-val'><?php echo $version; ?></span></div>
					Fiyo Version</a>
					</div>					
				</div>
			
			
				<div>
					<ul id="panel">	
						<li class="icon edit">
							<a class='link' href="?app=article&act=add">
							<div></div>
							<span>New Article</span>
							</a>
						</li>
						<li class="icon list">
							<a class='link' href="?app=article">
							<div></div>
							<span>Articles</span>
							</a>
						</li>
						<li class="icon category">
							<a class='link' href="?app=article&act=category">
							<div></div>
							<span>Categories</span>
							</a>
						</li>
						
						<li class="icon chat">
							<a class='link' href="?app=comment">
							<div></div>
							<span>Comments</span>
							</a>
						</li>						
						<li class="icon media">
							<a class='link' href="?app=media">
							<div></div>
							<span>Media Manager</span>
							</a>
						</li>
											
						<li class="icon user">
							<a class='link' href="?app=user">
							<div></div>
							<span>User Manager</span>
							</a>
						</li>
						
					<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
					
						<li class="icon menu">
							<a class='link' href="?app=menu">
							<div></div>
							<span>Menu Manager</span>
						</a>
						</li>
						<li class="icon module">
							<a class='link' href="?app=module">
							<div></div>
							<span>Module Manager</span>
							</a>
						</li>	
						<li class="icon themes">
							<a class='link' href="?app=theme">
							<div></div>
							<span>Theme Manager</span>
							</a>
						</li>	
					<?php endif; ?>			
					<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
							<li class="icon box">
							<a class='link' href="?app=addons&act=install">
							<div></div>
							<span>Install AddOns</span>
							</a>
						</li>
						<li class="icon tools">
							<a class='link' href="?app=config">
							<div></div>
							<span>Web Setting</span>
							</a>
						</li>
						
					<?php endif; ?>
					</ul>
				</div>
			</div>
			
				
				
				
			<div class="col noborder dasboard">				
				<!-- ACCORDION START -->      
			  <ul class="accordion">
				<?php module('statistic'); ?>	
				  <li>
					<h3><?php if(siteConfig('lang') == 'id') echo "Artikel Terbaru";
						else echo "Latest Articles"; ?></h3>
					<div class="isi"><div class="acmain">
						<?php echo module('latest_article'); ?>
					</div></div>
				  </li>
				    <li>
					<h3><?php if(siteConfig('lang') == 'id') echo "Artikel Terpopuler";
						else echo "Popular Articles"; ?></h3>
					<div class="isi"><div class="acmain">
						<?php echo module('popular_article'); ?>
					</div></div>
				  </li>
				 </li>
				    <li>
					<h3><?php if(siteConfig('lang') == 'id') echo "Aktifitas Login";
						else echo "Login Activities"; ?></h3>
					<div class="isi"><div class="acmain">
						<?php echo module('user_login'); ?>
					</div></div>
				  </li>
				 
			  </ul>
      
      <!-- ACCORDION END -->
				
		</div>
	</div>
</div>

<script>
	$(".updater-d").click(function() {
		$("#update #updater_id").html('<h3>Loading for Updates</h3><img src="<?php echo AdminPath ?>/images/update.gif">');
		$.ajax({
			data:'updater=true',
			type:'POST',
			url: "apps/app_config/controller/updater.php",
			success: function(data){
				$("#update #updater_id").html(data);
			}
		});
	});

</script>

<!-- UPDATER POPUP -->
<div class="popup_warp">
	<div id="update" class="pop_up" style="padding:10px">
		<div id="updater_id">		
		</div>
	</div>	
</div>

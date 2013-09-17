<?php 
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<title><?php echo SiteName; ?> Administrator</title>	
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
	<meta http-equiv="imagetoolbar" content="no" />
	<link rel="shortcut icon" href="<?php echo AdminPath; ?>/images/favicon.png" type="image/x-icon" />
	<?php 
		addCss(AdminPath.'/css/style.css'); 
		addJs(AdminPath.'/js/jquery.min.js'); 
		addJs(AdminPath.'/js/easy.js'); 
		addJs(AdminPath.'/js/main.js'); 
		addJs(AdminPath.'/js/table.js'); 
		addJs(AdminPath.'/js/load.js'); 
		addJs(AdminPath.'/js/inputtext.js'); 
		require_once('plugins.php'); 	
	?>
	<script language="javascript" type="text/javascript">
		$(window).load(function () {
			if (navigator.onLine) {
				$('.gravatar[data-gravatar-hash]').prepend(function(index){
					var hash = $(this).attr('data-gravatar-hash')
					return '<img width="100" height="100" alt="" src="http://www.gravatar.com/avatar.php?size=100&gravatar_id=' + hash + '">'
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
</head>
<body>
<div id="loading"></div>
<?php  if(defined('BLANK_THEME') != 'hidden') { ?>
<div id="header">
  <div id="warp">
	<div id="logo">
		<h1><a href="index.php" title="Fix It Your Own!">Fiyo CMS</a></h1>
	</div>
	<ul id="nav">
		<li><a href="index.php" class='link' >Admin Panel</a>
		  <ul class="subnav">
			<li <?php if($_SESSION['USER_LEVEL'] != 1) echo 'class="endsub"'; ?>><a href="?app=media" class='link' >Media Manager</a></li>
			<?php if($_SESSION['USER_LEVEL'] == 1) : ?>
			<li><a href="?app=addons" class='link' >AddOns Manager</a></li>
			<li class="endsub"><a href="?app=config" class='link' >Site Configuration</a></li>
			<?php endif; ?>
          </ul>									
		</li>			
		<li><a class='link'  href="?app=article">Articles</a><sup><a class='link' href="?app=article&act=add" title="Add new article">+</a></sup>
		  <ul class="subnav level2">
			<li>
				<a href='?app=article&act=category' class='link'>Article Categories</a>
			</li>
			<?php
				$db = new FQuery();  
				$db->connect(); 
				$sql=$db->select(FDBPrefix.'article_category','*','parent_id=0',"name ASC"); 
				$sum=mysql_num_rows($sql);
				$no=1;
				while($cat=mysql_fetch_array($sql)){
						$sum2=angka(mysql_num_rows($sql));$sql2=$db->select(FDBPrefix.'article','*',"category=$cat[id]");$sum2=mysql_num_rows($sql2);
						if($no==$sum) $cl=" class='endsub'"; else $cl='';
						echo "<li$cl><a class='link'  href='?app=article&cat=$cat[id]'>$cat[name] <span class='total_article'>$sum2</span></a>";
						sub_menu_category($cat['id']);
						echo"</li>";
						$no++;
				}
				?>
              </ul>
			</li>
			<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
			<li><a style="cursor:default" >Apps</a>
				<ul class="subnav">
					<?php
					$db = new FQuery();  
					$db->connect(); 
					$sql=$db->select(FDBPrefix.'apps','*',"type = 1 or type = 2","name ASC");
					$sum=mysql_num_rows($sql);
					$no=1;
					while($row=mysql_fetch_array($sql))				
					{	
						$fd=str_replace("app_","","$row[folder]");
						if($no == $sum)
							echo "<li class='endsub'><a class='link' href='?app=$fd'>$row[name]</a></li>";
						else
							echo "<li><a class='link' href='?app=$fd'>$row[name]</a></li>";
						$no++;
					}					
					
					?>
				</ul>	
			
			
			</li>
			<?php endif; ?>
			
			<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
			<li><a class='link'  href="?app=menu">Menus</a>
				<ul class="subnav">
				<li><a class='link'  href='?app=menu&act=category'>Menu Categories</a></li>
					<?php
					$db = new FQuery();  
					$db->connect(); 
					$sql2=$db->select(FDBPrefix.'menu_category'); 
					$sum=mysql_num_rows($sql2);
					$no=1;
					while($menu=mysql_fetch_array($sql2))				
					{	
						$sqlm = $db->select(FDBPrefix.'menu','*',"category='$menu[category]'"); 						
						$summ = angka(mysql_num_rows($sqlm));
						$sqlh = $db->select(FDBPrefix.'menu','*',"category='$menu[category]' AND home=1"); 						
						$sumh = angka(mysql_num_rows($sqlh));
						if($no==$sum){$cls=" class='endsub'";} else $cls="";
						if($sumh)
							{$sump="<span class='as_home'>home</span>";}
						else $sump="";
						echo "<li$cls><a class='link'  href='?app=menu&cat=$menu[category]'>$menu[title]<span class='total_menu'>$summ</span>$sump</a></li>";
						$no++;
					}
					?>
                </ul>		
			</li>
			<?php endif; ?>
			
			<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
			<li><a class='link'  href="?app=module">Modules</a></li>
			
			<?php endif; ?>
			
			<?php if($_SESSION['USER_LEVEL'] <= 2) : ?>
			<li><a class='link'  href="?app=theme">Themes</a>
				<ul class="subnav">
					<li class="endsub"><a class='link'  href="?app=theme&act=admin">Admin Themes</a></li>
                </ul></li>
			
			<?php endif; ?>
			
			<?php if($_SESSION['USER_LEVEL'] <= 3) : ?>
			<li><a class='link' href="?app=user">Users</a>
				<ul class="subnav">
					<li class="endsub"><a class='link'  href="?app=user&act=group">User Group</a></li>
                </ul>
			</li>
			
			<?php endif; ?>
		</ul>
		
		
	<div id="tright">
		<div id="preview">
				<a href="<?php echo FUrl; ?>" target="_blank" title="View your live site"><div class="prev">View Site</div></a>
		</div>
			
		<div id="profil">			
			<ul id="nav">				
				<li><a class='link' href="?app=user&act=edit&id=<?php echo $_SESSION['userId'] ?>" class="user"><?php echo $_SESSION['User']; ?></a><div class="img">
				<?php
				$autmail=	md5($_SESSION['userEmail']);
					echo "<span class='gravatar' data-gravatar-hash=\"$autmail\"></span>";
				?></div>
					<ul class="subnav">
						<li><a class='link'  href="?app=user&act=edit&id=<?php echo $_SESSION['userId'];?>">Edit Profile</a></li>
						<!-- <li><a class='link'  href="#">Your Article</a></li> -->
						<li class="endsub"><form method="post"><input type="submit" name="fiyo_logout" value="Log Out" title="Click to logout" /></form></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
  </div>
</div>

<?php } ?>	
<div id="warp2">
	<div id="container" 
<?php  if(defined('BLANK_THEME') == 'hidden') { echo "style='margin-top:0px !important'"; } ?>>
		<div class="content">
			<?php
			loadAdminApps();	
			?>
		</div>	
		
<?php  if(defined('BLANK_THEME') != 'hidden') { ?>
		<div id="footer">
			<div><a id="gofull" class="tooltip link" title="change to full-view mode" ></a><a id="gowarp" class="tooltip link" title="change to warp-view mode"></a>Fiyo is Free CMS Under GNU GPL<span class="right">Admin Themes by Portofolio ID</span>
			</div>			
		</div>
<?php } 
		
		
		
		?>	
	</div>
</div>
</body>
</html>
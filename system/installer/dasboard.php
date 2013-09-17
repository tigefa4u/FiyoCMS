<?php
/**
* @version		Beta 1.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2011 Fiyo CMS.
* @license		GNU/GPL, see liCENSE.php
* @description	
**/
$db = @new FQuery() or die;  
$db->connect(); 

?>
<div class="secondary"></div>		
<div class="main">
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
					<span>Artile Categories</span>
					</a>
				</li>
				<li class="icon menu">
					<a class='link' href="?app=menu">
					<div></div>
					<span>Menu Manager</span>
					</a>
				</li>
				
				<li class="icon chat">
					<a class='link' href="?app=comment">
					<div></div>
					<span>Comments</span>
					</a>
				</li>
				<li class="icon box">
					<a class='link' href="?app=apps&act=install">
					<div></div>
					<span>Install Apps</span>
					</a>
				</li>
				
				<li class="icon media">
					<a class='link' href="?app=media">
					<div></div>
					<span>Media</span>
					</a>
				</li>
				<li class="icon help last">
					<a class='link' href="?app=helper">
					<div></div>
					<span>Helps</span>
					</a>
				</li>
			</ul>
		<br>
</div>		
	<div class="main">
		<div class="cols">
			<div class="col first pan">
				<h3>Website Information</h3>
					<div class="isi">
						<table class="winfo">
							<tr>
								<td width="22%"><b><i>Website Name</i></b></td><td><?php $sql=$db->select("setting","value","name='site_name'"); $qr = mysql_fetch_array($sql); echo $qr[value]; ?></td>
							</tr>
							<tr>
								<td><b><i>Website Title</i></b></td><td><?php $sql=$db->select("setting","value","name='site_title'"); $qr = mysql_fetch_array($sql); echo $qr[value]; ?></td>
							</tr>
							<tr>
								<td valign="top"><b><i>Website URL</i></b></td><td><?php $sql=$db->select("setting","value","name='site_url'"); $qr = mysql_fetch_array($sql); echo $qr[value]; ?></td>
							</tr>
							<tr>
								<td colspan="2" style="border:0">Gunakan tombol ini sebagai <i>shortcut</i> menuju page manager untuk kemudahan mengelola website anda !</td>
							</tr>
						</table>
						
						<ul id="panel">						
						<li class="icon user">
							<a class='link' href="?app=user">
							<div></div>
							<span>User Manager</span>
							</a>
						</li>
						<li class="icon tools">
							<a class='link' href="?app=config">
							<div></div>
							<span>Web Setting</span>
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
					</ul>
				</div>
			</div>
				
				
				
			<div class="col noborder">				
				<!-- ACCORDION START -->      
			  <ul class="accordion">
				  <li>
					<h3><?php echo Fiyo_News_Update; ?></h3>
					<div class="isi">
					<div class="acmain open">
						<?php echo Fiyo_News_Update_main; ?>
						<div style="margin:3px 0;padding:3px 5px; border:1px green solid; background:#E7FFCC; color:green"><?php echo Site_Version; ?> <?php echo Site_Version_val; ?></div>
						<div style="margin:3px 0;padding:3px 5px; border:1px #ddd solid;"><?php echo Fiyo_Version; ?> <?php echo Fiyo_Version_val; ?></div>
					</div></div>	
				  </li>
				  <li>
					<h3><?php echo New_Article; ?>	</h3>
					<div class="isi"><div class="acmain">
						<?php echo New_Articles_main; ?>
					</div></div>
				  </li>
				  <li>
					<h3>Artikel Terpopuler</h3>
					<div class="isi"><div class="acmain">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis dui nec eros varius 
						ac molestie ante malesuada. Duis sed justo et sem hendrerit suscipit et ac eros. </p></div></div>
				  </li>
				  <li>
					<h3>Aktifitas User</h3>
					<div class="isi"><div class="acmain">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis dui nec eros varius 
						ac molestie ante malesuada. Duis sed justo et sem hendrerit suscipit et ac eros. </p></div></div>
				  </li>
				 
			  </ul>
      
      <!-- ACCORDION END -->
				
		</div>
	</div>
</div>
	
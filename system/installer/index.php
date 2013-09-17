<?php
/**
* @version		1.5.0
* @package		Fiyo CMS Installer
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

if(isset($_POST['step_1']) AND empty($_SESSION['host']))
{ 
	$conn = @mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']);
	if($conn)
	{
		$createDB = mysql_query("CREATE DATABASE $_POST[dbase]");		
		if($createDB)
		{
			echo "<font color='white'><div class='infofly go-front' id='status'>Database has been successfully created.</div></font>";
			$db = @mysql_select_db($_POST['dbase']);		
			
			$file_name = "_config.php";
			if(!file_exists($file_name))
			{
				$file = "system/installer/_config.php";
				@copy($file,'../');
			}
			$fo = @fopen($file_name,"w+");
			$s = fgets($fo,6);
			$text = ("<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description 	containing database information
**/

\$DBName	= '$_POST[dbase]';
\$DBHost	= '$_POST[host]';
\$DBUser	= '$_POST[user]';
\$DBPass	= '$_POST[pass]';
\$DBPrefix	= '$_POST[dbpr]';");
		
			rewind($fo);
			fwrite($fo,$text);
			$conn = fclose($fo);
			if($db)		
			{
				$_SESSION['host']=$_POST['host'];
				$_SESSION['base']=$_POST['dbase'];
				$_SESSION['user']=$_POST['user'];
				$_SESSION['pass']=$_POST['pass'];
				$_SESSION['dbpr']=$_POST['dbpr'];
			}
			else
			{
				echo "<div class='errorfly go-front' id='status'>The database name is already exists !</div>";
			}
		}
		else
		{
			echo "<div class='errorfly go-front' id='status'>The database name is invalid or exists !</div>";
		}
		
	}
	else
	{
		echo "<div class='errorfly go-front' id='status'>Username or password invalid !</div>";
	}
}


if(isset($_POST['step_2']))
{ 
	if(!empty($_POST['site']) or !empty($_POST['username']) or !empty($_POST['email']) or !empty($_POST['pass']))
	{				
		$nama_file = "system/installer/data.sql";
		$open_file = @fopen($nama_file,"a+");
		if($open_file) 
		{
			while(!feof($open_file))
			{
				$data=fgets($open_file,50);
				@$file.=$data;
			}
			
			require('_config.php');
			require('system/query.php');
			$db = new FQuery();  
			$db->connect();		
			$mod = explode("--",$file);
			$go = null;
			foreach($mod as $val) 
			{	
				$val=str_replace("db_prefix_",FDBPrefix,$val);
				$val=str_replace("_site_title","$_POST[site]",$val);				
				$go = $db->query("$val");
			}
			fclose($open_file);
		}	
			
		if($go)
		{
			echo "<div class='infofly go-front' id='status'>SQL Query successfully !</div>";
		}
			
		if(preg_match('/^.+@.+\\..+$/',$_POST['email']))
		{
			$qr=$db->insert(FDBPrefix.'user',array("","$_POST[username]","Administrator",MD5("$_POST[userpass]"),"$_POST[email]","1","1",date('Y-m-d H:i:s'),"")); 
			if($qr)
				$_SESSION['user']="";
				$_SESSION['success']=1;
		}
		else
		{
			echo "<div class='errorfly go-front' id='status'>Email or User are invalid !</div>";
		}
	}
	else
		echo "<div class='errorfly go-front' id='status'>Please fill the fields correctly !</div>";
}

if(isset($_POST['admin']))
{ 		
	session_destroy();
	rename("_config.php","config.php");	
	header("location:dapur");
}
else if(isset($_POST['home']))
{ 	
	session_destroy();
	rename("_config.php","config.php");
	header("location:#");
}
function FUrl() {
	$furl = str_replace('index.php','',$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]);
	if(_FINDEX_=='BACK') {
		$jurl = substr_count($furl,"/")-1;
		$ex = explode("/",$furl);
		$no = 1 ;
		$FUrl = '';
		foreach($ex as $b) {$FUrl .= "$b/";  if($no==$jurl) break; $no++;}	
	}
	else {
		$FUrl= $furl;
	}
	return "http://$FUrl";
}

?>

<html>

<head>
	<title>Fiyo CMS Installer</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="<?php echo FUrl(); ?>system/installer/css/form.css" type="text/css">		
	<script src="<?php echo FUrl(); ?>system/installer/js/jquery.min.js" type="text/javascript" ></script>
	<script src="<?php echo FUrl(); ?>system/installer/js/easy.js" type="text/javascript"></script>
	<script src="<?php echo FUrl(); ?>system/installer/js/main.js" type="text/javascript" ></script>
	<script type="text/javascript">
     $(document).ready(function() {		
		var loadings = $("#status");
		loadings.hide();
		loadings.fadeIn(800);	
		setTimeout(function(){
			$('#status').fadeOut(1000, function() {
			});				
		}, 4000);	
	});	
</script>	
</head>

<body>        
    <div>
        <H1>Fiyo CMS Installer</H1>
		<div id="wrapper">
            <div id="steps">
				<?php if(empty($_SESSION['host']) AND empty($_SESSION['success'])) { ?>
				
				<?php if($_SERVER['SERVER_ADDR'] == '127.0.0.1' or $_SERVER['SERVER_ADDR'] == '::1' ) : ?>
				
					<div class="tip">
					<b>Tips</b> : Saat ini Anda sedang menggunakan server lokal.<p>Anda tidak perlu membuat database terlebih dahulu</p><p>Database terbentuk secara otomatis apabila nama database tersedia.</p>
					</div>
					
					<div class="tip en">
					<b>Tips</b> : You are currently using a local server.<p>You do not need to create a new database first.</p><p>The database is created automatically when the database name is available.</p>
					</div>
				
				<?php else :  ?>
				
					<div class="tip">
					<b>Tips</b> : Saat ini Anda sedang menggunakan server hosting.<p>Anda harus membuat database beserta username dan password melalui CPanel.</p><p>Setelah itu masukan pada kolom yang harus diisi.</p>
					</div>
					<div class="tip en">
					<b>Tips</b> : You are currently using a hosting server.<p>You must create a database along with the username and password through CPanel.</p><p>After that input them into required fields.</p>
					</div>
					
				<?php endif;  ?>
                <form id="formElem" method="post">
                    <fieldset class="step">
                        <legend>Database Configuration</legend>
                        <P>
                            <LABEL>Host Name *</LABEL>
                            <INPUT autocomplete="OFF" name="host" autocomplete="OFF"  type="text" value="localhost"  placeholder="Host Name">
                        </P>
                        <P>
                            <LABEL>DB User *</LABEL>
                            <INPUT autocomplete="OFF" value="<?php echo @$_POST['user']; ?>" name="user" type="text">
                        </P>
                        <P>
                            <LABEL>DB Pass *</LABEL>
							<INPUT autocomplete="OFF" value="<?php echo @$_POST['pass']; ?>" name="pass" type="password" >
						</P>
						<P>
							<LABEL>Database *</LABEL>
							<INPUT autocomplete="OFF" value="<?php echo @$_POST['dbase']; ?>" name="dbase" type="text">
						</P>
						<P>
							<LABEL>DB Prefix *</LABEL>
							<INPUT autocomplete="OFF" value="fiyo_" name="dbpr" type="text">
                        </P>
						<P class="submit">
							<BUTTON id="registerButton" type="submit" name="step_1">Next</BUTTON>
						</P>
					</fieldset>
				</form>  
				<?php }  ?>
				
				<?php if(!empty($_SESSION['host'])  AND !empty($_SESSION['user'])) { ?>
				
                <form id="formElem" method="post">
					<fieldset class="step">
						<legend>Website Configuration</legend>
						<P>
                            <LABEL>Site Name *</LABEL>
                            <INPUT name="site" type="text" value="<?php echo @$_POST['site']; ?>">
                        </P>
                        <P>
                            <LABEL>User Name *</LABEL>
                            <INPUT autocomplete="OFF" value="<?php echo @$_POST['username']; ?>" name="username" type="text" >
                        </P>
                        <P>
                            <LABEL>Password *</LABEL>
                            <INPUT  autocomplete="OFF" value="<?php echo @$_POST['userpass']; ?>" name="userpass" type="password">
                        </P>
                        <P>
                            <LABEL>Email *</LABEL>
                            <INPUT value="<?php echo @$_POST['email']; ?>" name="email" type="text">
						</P>
                        <P class="submit">
                            <BUTTON id="registerButton" type="submit" name="step_2">Next</BUTTON>
                        </P>
					</fieldset>
				</form>  
				<?php 	}	else if(!empty($_SESSION['success'])) 	{ 	?>
                <form id="formElem" method="post">
                    <fieldset class="step">
                        <legend>Install Successfuly</legend>
                        <p>Selamat, Fiyo CMS telah sukses di instal dan telah siap digunakan :)</p>
						<p>Congratulations, Fiyo CMS has been successfully installed and ready to use :)</p>
                        <P class="submit">
                            <BUTTON id="registerButton" type="submit" name="admin" style="float:left">Admin Page</BUTTON>
                            <BUTTON id="registerButton" type="submit" name="home">Home Page</BUTTON>
                        </P>
                    </fieldset>
				</form>  
				<?php } ?>		
            </div>
        </div>
    </div>    
</BODY>
</HTML>
      
<?php
/**
* @version		Beta 1.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2011 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.php
**/

$OffTheme = FUrl.'/system/offline-theme';;

if(isset($_POST['fiyo_login']))	{
	$db = new FQuery();  
	$db->connect();		
	$sql = $db->select(FDBPrefix."user","*","status=1 AND user='$_POST[user]' AND password='".MD5($_POST['pass'])."'"); 
	$qr = mysql_fetch_array($sql);
	$jml = mysql_affected_rows();
	if($jml > 0) {
		$_SESSION['fiyoid']	   = $qr['id'];
		$_SESSION['fiyouser']  = $qr['user'];
		$_SESSION['fiyolevel'] = $qr['level'];
		$_SESSION['fiyoemail'] = $qr['email'];
			
		$del=$db->delete(FDBPrefix."session_login","user_id=$qr[id]");			
		if($del) {
			$qrs = $db->insert(FDBPrefix."session_login",array("$qr[id]","$qr[user]","$qr[level]",date('Y-m-d H:i:s')));
		}
	}		
	if(isset($qrs))
		redirect(getUrl());
}
?>

<html>

<head>
	<title>Website Maintenance</title>
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="<?php echo $OffTheme; ?>/css/form.css" type="text/css">
	<script type="text/javascript" src="<?php echo $OffTheme; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $OffTheme; ?>/js/sliding.form.js"></script>
	<script type="text/javascript">
     $(document).ready(function() {		
		var loadings = $("#status");
		loadings.hide();
		loadings.fadeIn(800);	
		setTimeout(function(){
			$('#status').fadeOut(1000, function() {
			});				
		}, 3000);	
	});	
</script>	
</head>

<body>

        
    <div>
        <H1>Website Maintenance</H1>
		<div id="wrapper">
                <div id="steps">
                    <form id="formElem" method="post" action="">
                        <fieldset class="step">
                            <legend>Login Form</legend>
                            
                            <P>
                                <LABEL>Username</LABEL>
                                <INPUT name="user" autocomplete="OFF"  type="text">
                            </P>
                            <P>
                                <LABEL>Password</LABEL>
                                <INPUT name="pass" type="password">
                            </P>
                            <P class="submit">
                                <BUTTON id="registerButton" type="submit" name="fiyo_login">Log in</BUTTON>
                            </P>
                      </fieldset>
					</form>
                    			
                    
                </div>
        </div>
    </div>
</body>
</html>
      
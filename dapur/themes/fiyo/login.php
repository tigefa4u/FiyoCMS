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
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
	<title><?php echo SiteTitle; ?>'s Admin Panel</title>
	<link rel="shortcut icon" href="<?php echo AdminPath; ?>/images/favicon.png" />
	<link rel="stylesheet" href="<?php echo AdminPath; ?>/css/login.css" type="text/css">
	<script type="text/javascript" src="<?php echo AdminPath; ?>/js/jquery.min.js"></script>
	<script type="text/javascript">
	$(function() {	
		$(".submit").click(function(e) {	
			var name = $(".name").val();
			var pass = $(".pass").val();
			if(pass !== '' && name !== '') {
				$(this).html("Loading...");	
				}
			else {	
				if(name === '') {
				$(".name").focus();
				}
				else if(pass === '') {
				$(".pass").focus();
				}
				e.preventDefault();
				return false;
			}
		});
		
		$(".send-mail").click(function(e) {
			var email = $(".email").val();
			if(email !== '' ) {
				$(this).html("Sending...");					
			
				
				
				}
			else {	
				if(email === '') {
				$(".email").focus();
				}
				e.preventDefault();
				return false;
			}
		});
		
		<?php if(!isset($_POST['forgot_password'])) :  ?>
		$(".femail").hide();
		<?php else : ?>
		$(".flogin").hide();		
		<?php endif; ?>
		
		$(".lost-password").click(function(e) {			
			$(".pass").toggle();			
			$(".name").toggle();			
			$(".email").toggle();			
			$(".back").toggle();			
			$("span").toggle();			
			$("button").toggle();			
		});
		
		
		$(".notice").click(function() {	
			$(this).fadeOut();
		});
		setTimeout(function(){
			$('.notice').fadeOut(2000, function() {
			});				
		}, 3000);	
	});	
	</script>	
</head>
<body>  
	<div>
        <div id="steps">
             <form id="formElem" method="post">
                <fieldset class="step">
                    <p class="legend"><img src="<?php echo AdminPath; ?>/images/fiyo.png" width="50"><br>Admin Panel</p>
                    <p>
                        <input name="user" autocomplete="OFF" type="text" class="name flogin alphanumeric" placeholder="Username" />
                        <input name="email" autocomplete="OFF" type="text" class="email femail" placeholder="Email" />
					</p>
                    <p>
                        <input name="pass" type="password" class="pass flogin"  placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" /> 
						
					</p>
                    <p class="button">
                        <button id="registerButton" type="submit" name="fiyo_login" class="submit flogin">Login</button>
                        <button id="registerButton" type="submit" name="forgot_password" class="send-mail femail">Send</button>
                    </p>
					<p style="width: 100%; text-align: center; margin-top: 10px;">
					<span class="lost-password flogin">Lost Password?</span>
					<span class="lost-password femail">User Login</span>
					</p>
                      </fieldset>
				</form>	                    
         </div>
    </div>
</body>
</html>
      
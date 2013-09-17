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
<html>
<head>
	<title>Fiyo CMS AdminPanel</title>
	<link rel="shortcut icon" href="<?php echo AdminPath; ?>/images/favicon.png" />
	<link rel="stylesheet" href="<?php echo AdminPath; ?>/css/form.css" type="text/css">
	<script type="text/javascript" src="<?php echo AdminPath; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo AdminPath; ?>/js/sliding.form.js"></script>
	
</head>

<body>        
    <div>
        <H1>Fiyo CMS AdminPanel</H1>
			<div id="wrapper">
                <div id="steps">
                    <form id="formElem" method="post">
                        <fieldset class="step">
                            <legend><?php echo Login_to_AdminPanel; ?></legend>
                            
                            <P>
                                <LABEL><?php echo Username; ?></LABEL>
                                <INPUT name="user" autocomplete="OFF"  type="text">
                            </P>
                            <P>
                                <LABEL><?php echo Password; ?></LABEL>
                                <INPUT name="pass" type="password">
                            </P>
                            <P class="submit">
                                <BUTTON id="registerButton" type="submit" name="fiyo_login"><?php echo Login; ?></BUTTON>
                            </P>
                      </fieldset>
					</form>
                    <form id="form2" name="form" method="post">
						<fieldset class="step">
                            <legend><?php echo Forgot_your_password; ?></legend>
                            
                            <P>
                                <LABEL for="cardnumber"><?php echo Username; ?></LABEL>
                                <INPUT id="user" name="user" type="text" autocomplete="OFF" style="background-color: rgb(255, 237, 239); ">
                            </P>
                            <P>
                                <LABEL for="secure">Email</LABEL>
                                <INPUT id="secure" name="mail" type="email" autocomplete="OFF" style="background-color: rgb(255, 237, 239); ">
                            </P>
                            <P class="submit">
                                <BUTTON id="registerButton" type="submit" name="forgot_password"><?php echo Sent; ?></BUTTON>
                            </P>
						</fieldset>				  
					</form>					
                    
                </div>
                <div id="navigation" style="">
                    <ul>
						<li class="selected">
							<a><span>&laquo; </span><?php echo Login; ?></a>
						</li>
						<li class="">
							<a><?php echo Forgot_your_password; ?> <span>&raquo;</span></a>                    
						</li>
						                 
                    </ul>
                </div>
            </div>
    </div>
           
    
      </BODY></HTML>
      
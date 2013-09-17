<?php
/**
* @name			Comment
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

?>
<script>

	function reloadCaptcha() {
		document.getElementById('captcha').src = document.getElementById('captcha').src+ '?' +new Date();
	}
</script>

<h3 id="comments" >Leave a Comment</h3>
<?php echo @$notice; ?>
<form method="post" action="#comments">
	<div><label><span>Name *</span><div>
		<input type='text' name='name' style='width:60%; max-width : 200px;' value ="<?php echo @$name; ?>" <?php if(!empty($name)) echo "readonly"; ?>  class="input required" placeholder="Name" required></label></div>
	</div>
	<div><label><span>Email *</span><div>
		<input class="input required email" style='width:60%; max-width : 200px;' type='email' name='email' value ="<?php echo @$email; ?>" <?php if(!empty($email)) echo "readonly"; ?> placeholder="name@email.com" required></label></div>
	</div>
	<div><label><span>Website</span><div>
		<input type="url" class="input" style="width:60%; max-width : 200px;" name="web" value="<?php echo @$_POST['web']; ?>" placeholder="http://" /></label></div>
	</div>
	<div><label><span>Comment *</span><div>
		<textarea class="input required" name='com' style='width:100%; max-width : 500px;' rows="8" required><?php echo @$_POST['com']; ?></textarea></label></div>
	</div>
	<?php if(empty($privatekey) or empty($publickey )) : ?>
	<div><label><span>Security * </span> <div><img src="<?php echo FUrl; ?>/plugins/mathcaptcha/image.php" alt="Click to reload image" title="Click to reload image" id="captcha" onclick="javascript:reloadCaptcha()" /></div><input type="text" name="secure" placeholder="What's the result?" onclick="this.value=''" class="input required numeric" required /></div>
	<?php else : ?>
	<div>
		<label><span>ReCaptcha *</span>
			<div>
				<script type="text/javascript">
					 var RecaptchaOptions = {
						theme : 'clean'
					};
				</script>
				<?php echo recaptcha_get_html($publickey);?>
			</div>
		</label>
	</div>
	<?php endif; ?>
	<div style="overflow: visible;">
		<label><input type='submit' name='send-comment' class='commentBtn' value="Send"></label>
	</div>
</form>
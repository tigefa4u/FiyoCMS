<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see LICENSE.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$id = app_param('id');
$contact = new Contact() or die;  
$contact -> item($id,Page_ID);
$contact -> send(@$_POST['name'],@$_POST['email'],@$_POST['text'],@$_POST['send'],@$_POST['to']);

addJs(FUrl.'plugins/jquery_ui/ui.validate.js');
if(isset($contact->name)) : ?>
	<?php if(!empty($contact->photo) AND $contact->photo !='') : ?>	
		<div class="contact-photo"><?php echo $contact->photo; ?></div>
	<?php endif; ?>
	<table style="width:65%;" class="personal">		
		<tr>
			<td style="width:30%">Name</td><td><?php echo $contact->name; ?></td>
		</tr>
		<?php if($contact-> gender == 3) : ?>
			<tr>
				<td>Jenis Kelamin</td><td><?php if($contact->gender==1) echo "Laki-laki"; else echo "Perempuan"; ?></td>
			</tr>
		<?php endif; ?>
		<?php if($contact-> address) : ?>
			<tr>
				<td valign="top">Address</td><td><?php echo $contact->address; ?>
				
				<?php if($contact-> state or $contact-> city or $contact-> country) { ?>
					<br>
						<?php if($contact-> city) echo "$contact->city,"; ?>
						<?php if($contact-> state) echo "$contact->state,"; ?>
						<?php if($contact-> country)  echo $contact->country; ?>
					
				<?php } ?>			
				<?php if($contact-> zip) : ?>
					<br>
					<?php echo $contact->zip; ?>
					
				<?php endif; ?>
				
				</td>
			</tr>
		<?php endif; ?>
		
		<?php if($contact-> email) : ?>
			<tr>
				<td>Email</td><td><?php echo $contact->email; ?></td>
			</tr>
			<?php endif; ?>
		<?php if($contact-> phone) : ?>
			<tr>
				<td>Phone</td><td><?php echo $contact->phone; ?></td>
			</tr>
			<?php endif; ?>
		<?php if($contact-> fax) : ?>
			<tr>
				<td>Fax</td><td><?php echo $contact->fax; ?></td>
			</tr>
		<?php endif; ?>
		
		<?php if($contact->ym or $contact->facebook or $contact->twitter or $contact->web): ?>
			<tr class='link'>
				<td>Links</td><td><?php if(!empty($contact->ym)) echo $contact->ym; ?> <?php if(!empty($contact->twitter)) echo $contact->twitter; ?> <?php if(!empty($contact->facebook)) echo $contact->facebook; ?> <?php if(!empty($contact->web)) echo $contact->web; ?></td>
			</tr>
		<?php endif; ?>
	</table>

	<?php if($contact-> email) : ?>
	<div class="contactEms">
	<a id="sendmsg" class="contactButton" style=" cursor:pointer">Send Message</a>
	<a id="closemsg" class="contactButton btn-bottom" style=" cursor:pointer; display:none;">Close Message</a>
	<a id='contact'></a>
	
	<form id="fcontact" method="post" class="contactForm" style="display:none">
		<table style="width:100%"> 
			<tr>
				<td valign="top" style="width:20%">Name *</td><td>
				<input type="hidden" name="to" value="<?php echo $contact->mail; ?>">
				<input type="text" name="name" size="30" class="required" <?php formRefill('name'); ?>></td>
			</tr>
			<tr>
				<td valign="top">Email *</td><td><input type="email" name="email" size="30" class="required email"<?php formRefill('email'); ?> required></td>
			</tr>
			<tr>
				<td valign="top">Message *</td><td><textarea name="text" rows="10" style="width:85%" class="required" required><?php formRefill('text','textarea'); ?></textarea></td>
			</tr>
			<tr>
				<td valign="top">Security *</td>
				<td>
					<img src="<?php echo FUrl; ?>/plugins/mathcaptcha/image.php" alt="Click to reload image" title="Click to reload image" id="captcha" onclick="javascript:reloadCaptcha()" />
				
				<div><input type="text" name="captcha" placeholder="What's the result?" onclick="this.value=''" class="input required numeric" required/></div>
				
				</td>
			</tr>
			<tr>
				<td></td><td><input type="submit" value="Send Now" class="button" name="send"></td>
			</tr>	
		</table>
	</form>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#fcontact").validate();
		$("#sendmsg").click(function(){
			$(".contactForm").slideToggle('medium');
			$("#closemsg").toggle();
			$(this).hide();
			
		});	
		
		$("#closemsg").click(function(){
			$("#sendmsg").toggle();
			$(this).hide();
			$(".contactForm").slideToggle('medium');
		});		

	});	
	
	function reloadCaptcha() {
		document.getElementById('captcha').src = document.getElementById('captcha').src+ '?' +new Date();
	}
	</script>
	<?php endif; ?>
<?php endif; ?>
<?php
/**
* @version		1.5.0
* @package		Fiyo CMS
* @copyright	Copyright (C) 2012 Fiyo CMS.
* @license		GNU/GPL, see license.txt
* @description	
**/

defined('_FINDEX_') or die('Access Denied');

$db = @new FQuery() or die;  
$db->connect();

//set request id 
if(!empty($_REQUEST['id'])){
	$id=$_REQUEST['id'];	
	$sql = $db->select(FDBPrefix.'contact','*','id='.$id); 
	$qr	 = mysql_fetch_array($sql);
}
else {
	$id = null;
	$qr = null;
}

?>
<script type="text/javascript" src="../plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#delimg").click(function(){
		$("#img").hide();
		$(".invisible").show();
		$(this).hide();
		$("#img1").val('');
	});	
	$(".show").click(function(){
		$("#delimg").show();
	});

});		
	function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = 1;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" class="img tooltip" title="click to change image" style="margin:2px 5px;" /><input type="hidden" value="' + url + '" class="imgval" name="photo">';
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    img.style.width = f_w + "px";
                    img.style.height = f_h + "px";
                } else {
                    f_w = o_w;
                    f_h = o_h;
                }
                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };
    window.open('../plugins/plg_kcfinder/browse.php',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=700, height=400'
    );
	}
	
	
	</script>
<div class="cols">
	<div class="col first">
		<h3>General Information</h3>
		<div class="isi">
			<table class="data2">
				<input value="<?php echo @$qr['id'];?>" type="hidden" name="id">
				<tr>
					<td class="djudul tooltip" title=""><?php echo Name; ?> *</td>
					<td><input value="<?php echo $qr['name'];?>" type="text" name="name" size="20" required></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title=""><?php echo Gender; ?> *</td>
					<td><select name="gender">
					<option value="1" selected><?php echo Man; ?></option>
					<option value="2" <?php if($qr['gender']==2) echo 'selected'; ?>><?php echo Woman; ?></option>
					</select></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title="Contact Group">Contact Group *</td>
					<td><select name="group">
					<?php
					$sql2 = $db->select(FDBPrefix.'contact_group');
					while($qr2=mysql_fetch_array($sql2)){
						if($qr2['id']==$qr['group_id']){ 
							echo "<option value='$qr2[id]' selected>$qr2[name]</option>";
						}
						else {
							echo "<option value='$qr2[id]'>$qr2[name]</option>";
						}						
					}
					?>
					</select></td>
				</tr>			
				<tr>
					<td class="djudul tooltip" title=""><?php echo Address; ?></td>
					<td><textarea rows="3" cols="30"style="margin-right:-30px;" name="address"><?php echo $qr['address'];?></textarea></td>
				</tr>
				
				<tr>
					<td class="djudul tooltip" title=""><?php echo City; ?></td>
					<td><input value="<?php echo $qr['city'];?>" type="text" name="city" size="20"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title=""><?php echo State; ?></td>
					<td><input value="<?php echo $qr['state'];?>" type="text" name="state" size="20"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title=""><?php echo Country; ?></td>
					<td><input value="<?php echo $qr['country'];?>" type="text" name="country" size="20"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title=""><?php echo Zip; ?></td>
					<td><input value="<?php echo $qr['zip'];?>" type="text" name="zip" size="20"></td>
				</tr>	
				
				<tr>
					<td class="djudul tooltip" title=""><?php echo Job; ?></td>
					<td><input value="<?php echo $qr['job'];?>" type="text" name="job" size="20"></td>
				</tr>
				
				<tr>
					<td class="djudul tooltip" title="<?php echo Additional_Information; ?>"><?php echo Description; ?></td>
					<td><textarea rows="3" cols="30"style="margin-right:-30px;" name="desc"><?php echo $qr['description'];?></textarea></td>
				</tr>
				
			</table>
		</div>
	</div>
	<div class="col kanan">
		<h3>Additional Information</h3>
		<div class="isi">
			<table class="data2">				
				<tr>
					<td class="djudul tooltip" title="">Email</td>
					<td><input value="<?php echo $qr['email'];?>" class='email' type="text" name="email" size="28"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title=""><?php echo Phone; ?></td>
					<td><input value="<?php echo $qr['phone'];?>" type="text" name="phone" size="20"></td>
				</tr>
				<tr>
					<td class="djudul tooltip" title="">Fax</td>
					<td><input value="<?php echo $qr['fax'];?>" type="text" name="fax" size="20"></td>
				</tr>							
				<tr>
					<td class="djudul tooltip" title="Website or Blog">Website</td>
					<td><input value="<?php echo $qr['web'];?>" class='web' type="text" name="web" size="20"></td>
				</tr>
				
				<tr>
					<td class="djudul tooltip" title="Yahoo Massagger ID">Yahoo Massagger</td>
					<td><input value="<?php echo $qr['ym'];?>" type="text" name="ym" size="20" id="order"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title="Facebook Page">Facebook</td>
					<td><input value="<?php echo $qr['fb'];?>" type="text" name="fb" size="20" id="order"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title="Twitter Page">Twitter</td>
					<td><input value="<?php echo $qr['tw'];?>" type="text" name="tw" size="20"></td>
				</tr>	
				<tr>
					<td class="djudul tooltip" title="">Picture</td>
					<td><input type="hidden" id="img1" name="photo" value="<?php echo $qr['photo'];?>"><div  style=""><div id="image1" class="imgdiv" onclick="openKCFinder(this)" style="padding:2px; float: left;"><?php if(!empty($qr['photo'])) echo "<img id='img' src='$qr[photo]' class='img tooltip' title='click to change image'style='margin-right: 5px; margin-bottom: 2px; margin-left: 86px; margin-top: 4px; visibility: visible; '>";
					else echo"<a class='reset'>Select Picture</a>";?><a class='reset invisible'>Select Picture</a></div></div>
					<?php if(!empty($qr['photo'])) echo "<a id='delimg' class='reset' style='float:left; margin-left:15px;' onclick='delimg()'>Delete Image</a>"; ?>
					</td>
				</tr>		
			</table>
		</div>
	</div>
</div>
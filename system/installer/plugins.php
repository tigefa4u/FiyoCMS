<script type="text/javascript">
     $(document).ready(function() {
		var loadings = $("#status");
		loadings.hide();
		loadings.fadeIn(800);	
		setTimeout(function(){
			$('#status').fadeOut(1000, function() {
			});				
		}, 3000);	

		var loading = $("#loading");
		loading.fadeOut();	
		$('input[type="submit"]').click(function(){
		loading.fadeIn();
		});	
		$('.link').click(function(){
		loading.fadeIn();
		});
		$('.ctedit').click(function(){
		loading.fadeIn();
		});	
	 
		$("#gofull").click(function(){
			$.ajax({
				type:"POST",
				url:"themes/fiyo/plugins.php",  
				data: "fiyowidth=full",				
				success: function(data){				
				$("#warp").removeClass("warp");
				$("#warp2").removeClass("warp");
				}  
			}); 
			
			setTimeout(function(){
				loading.fadeOut(function() {
				});				
			}, 1000);	
		});	
		$("#gowarp").click(function(){
			$.ajax({
				type:"POST",
				url:"themes/fiyo/plugins.php",  
				data: "fiyowidth=warp",				
				success: function(data){				
				$("#warp").addClass("warp");
				$("#warp2").addClass("warp");
				}  
			}); 
			setTimeout(function(){
				loading.fadeOut(function() {
				});				
			}, 1000);
		});
	});	
</script>	
<?php 
	if($_POST[fiyowidth]=="full") 
	{ 
		$_SESSION[fiyowidth]='full';
	}
	elseif($_POST[fiyowidth]=="warp") 
	{ 
		$_SESSION[fiyowidth]='warp';
	}
	
	if($_SESSION[fiyowidth]=='warp') 
			{
				echo '<script type="text/javascript">
					$(document).ready(function() {	
						$("#warp").addClass("warp");
						$("#warp2").addClass("warp");
					
						});
					</script>';
			}
					
			else		
			{	
					echo '<script type="text/javascript">
					$(document).ready(function() {	
						$("#warp").removeClass("warp");
						$("#warp2").removeClass("warp");
					
						});
					</script>';
			}

function avatar() {	
	$email = strtolower(FEmail); 
	$email = md5($email);
	if($a)
		echo "<img src=\"http://www.gravatar.com/avatar/$email?&s=40\"/>";
	else 
		echo "<img src=\"themes/fiyo/images/user.png\"/>";;		
	}
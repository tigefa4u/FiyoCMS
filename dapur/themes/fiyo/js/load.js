$(window).load(function () {
	$('.load').fadeOut();
    $("#loading").fadeOut('fast');
});

$(document).ready(function() {
	var loadings = $(".notice");
	loadings.hide();
	loadings.fadeIn(800);	
	setTimeout(function(){
		$('.notice').fadeOut(1000, function() {
		});				
	}, 3000);	

	var loading = $("#loading");
	
		
	$('.link').click(function(e){
		if( e.which != 2 ) {
		loading.fadeIn();
		}
	});
		
	$('.ctedit').click(function(e){
		if( e.which != 2 ) {
		loading.fadeIn();
		   }
	});	
	$("#gofull").click(function(){
		var src = "full";				
		$("#warp").removeClass("warp");
		$("#warp2").removeClass("warp");
		$.ajax({
				url: "themes/fiyo/module/view.php",
				data: "view=full",
				success: function(data){
				setTimeout(function(){
					loading.fadeOut(function() {
					});				
				});	
			}
		});	
	});	
		
	$("#gowarp").click(function(){	
		$("#warp").addClass("warp");
		$("#warp2").addClass("warp");	
		$.ajax({
				url: "themes/fiyo/module/view.php",
				data: "view=warp",
				success: function(data){
				setTimeout(function(){
					loading.fadeOut(function() {
					});				
				});	
			}
		});		
	});
		
	
	$('.alphanumeric').alphanumeric();
	$('.nocaps').alpha({nocaps:true});
	$('.numeric').numeric();
	$('.numericdot').numeric({allow:"."});
	$('.selainchar').alphanumeric({ichars:'.1a'});
	$('.web').alphanumeric({allow:':/.-_'});
	$('.email').alphanumeric({allow:':.-_@'});
	
});  	
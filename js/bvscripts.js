jQuery( function( $ ) {
	
	$(document).ready(function(){
  		$('.toggle-menu').jPushMenu();
	});

	$("a[href='#go-to-top']").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});
	
	$(document).ready(function(){
  		$('.bxslider').bxSlider({
			useCSS: false,
			adaptiveHeight: true
			});
	});
	
	$("a[href='#collections']").click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top+20
    }, 750);
    return false;
	}); 

} );
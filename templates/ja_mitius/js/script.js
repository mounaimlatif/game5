var $ja = jQuery.noConflict();

!function($){
	
	$(window).load(function() {
		
		$('#back-to-top').on('click', function(){
			$('html, body').stop(true).animate({
				scrollTop: 0
			}, {
				duration: 800, 
				easing: 'easeInOutCubic',
				complete: window.reflow
			});

			return false;
		});	
	});

}(window.$ja);

window.addEvent('domready', function(){
	//fix validate.js error
	if(Browser.ie && Browser.version <= 8){
		Browser.Features.inputemail = false;
	}
});
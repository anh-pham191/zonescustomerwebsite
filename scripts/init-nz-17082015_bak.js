$(function() {
// New initialise visitor routines
var browsertype = navigator.userAgent;
var thispageUrl = document.URL;
if ((browsertype.indexOf("Googlebot") == -1) && (areCookiesEnabled())) {
// We're not Google and can store cookies, so continue

		// 1. Activate the browser detect process of jreject when no cookie 'browserDetected' is found
        if (!readCookie('browserDetected')) {
            $.reject({
                reject: {
                    //block all browsers (all: true = all browsers blocked)
                    all: false, 
                    msie5: true, msie6: true, msie7: true,
                    firefox1: true, firefox2: true, firefox3: true
                },
                //don't need to show the jreject window
                browserShow: false, 
                //done when we find a rejected browser
                afterReject: function () {
                    //set cookies
                    createCookie('browserPrevious', document.URL);
                    createCookie('browserDetected', true);
                    window.location.href = REDIRECT_URL;//redirect to browser page
					return; // exit initialise visitor routine
                },
                //done when we do not find a rejected browser
                onFail: function () {
                    //set cookie
                    createCookie('browserDetected', true, 30);
                }
            });
        }
		// Removed Welcome popup code until this is implemented
		
		// Slidein form
		
		transitionEnd = 'transitionend webkitTransitionEnd otransitionend MSTransitionEnd'; // General definition
		
		// Close button
			$( '#sidey a.close1' ).on( 'touchstart click', function(e) {
			  e.preventDefault();
			  var $popout = $('#sidey');
			  $popout.addClass("animating");
			  $popout.addClass("animating-off");
			  $popout.on( transitionEnd, function() {	
				$popout
					.removeClass('animating animating-off show')
					$popout.off( transitionEnd );
					$('#sidey a.close1').toggle();
					$('#sidey p.sideways').fadeIn();
					$('#sidey a.open').fadeIn();
					ga('send', 'event', 'Closed slidein form', 'Closed slidein enquiry form');
				} );
				createCookie('popupran', '1', 1);
			} );
			
			$( '#sidey a.close2' ).on( 'touchstart click', function(e) {
			  e.preventDefault();
			  var $popout = $('#sidey');
			  $popout.addClass("animating");
			  $popout.addClass("animating-off");
			  $popout.on( transitionEnd, function() {	
				$popout
					.removeClass('animating animating-off show stage2')
					$popout.off( transitionEnd );					
					$('#forms2').css('display','none');
					$('#forms1').css('display','');
					$('#sidey a.open').fadeIn();
					$('#sidey p.sideways').fadeIn();
					$('#sidey a.close2').toggle();				
					ga('send', 'event', 'Closed slidein form', 'Closed slidein enquiry form');
				} );
			    createCookie('popupran', '1', 1);
			} );
			
			// Open button
			$( '#sidey a.open' ).on( 'touchstart click', function(e) {
			  e.preventDefault();
			  var $popout = $('#sidey');
			  $('#sidey a.open').toggle();
			  $('#sidey p.sideways').fadeOut();
			  $popout.addClass("animating");
			  $popout.addClass("animating-on");
			  $popout.on( transitionEnd, function() {	
				$popout
					.removeClass('animating animating-on')
					.addClass('show')
					ga('send', 'event', 'Opened slidein form', 'Opened slidein enquiry form');
					$popout.off( transitionEnd );
					$('#sidey a.close1').fadeIn();
				} );		
			} );
			
			// Open by clicking sideways text
			$( '#sidey p.sideways' ).on( 'touchstart click', function(e) {
			  e.preventDefault();
			  var $popout = $('#sidey');
			  $('#sidey a.open').toggle();
			  $('#sidey p.sideways').fadeOut();
			  $popout.addClass("animating");
			  $popout.addClass("animating-on");
			  $popout.on( transitionEnd, function() {	
				$popout
					.removeClass('animating animating-on')
					.addClass('show')
					ga('send', 'event', 'Opened slidein form', 'Opened slidein enquiry form');
					$popout.off( transitionEnd );
					$('#sidey a.close1').fadeIn();
				} );		
			} );
			
			if ($.cookie('popupran') != '1') {
				var showpopup = "yes";
				}
			if (showpopup == "yes") {
			// desktop popup stuff
			  setTimeout(
					function() {
						var $popout = $('#sidey');
						$popout.addClass("animating");
						$popout.addClass("animating-on");
						$popout.on( transitionEnd, function() {	
							$popout
								.removeClass('animating animating-on')
								.addClass('show');
								$popout.off( transitionEnd );
								$('#sidey a.close1').fadeIn();
							} );
						
					}, 5000);			
			// end desktop popup stuff
			}
			else {
			$('#sidey p.sideways').fadeIn();
			$('#sidey a.open').fadeIn();
			}
}
});